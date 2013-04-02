<?php
// $Id: webform-mail.tpl.php,v 1.3.2.3 2010/08/30 20:22:15 quicksketch Exp $

/**
 * @file
 * Customize the e-mails sent by Webform after successful submission.
 *
 * This file may be renamed "webform-mail-[nid].tpl.php" to target a
 * specific webform e-mail on your site. Or you can leave it
 * "webform-mail.tpl.php" to affect all webform e-mails on your site.
 *
 * Available variables:
 * - $node: The node object for this webform.
 * - $submission: The webform submission.
 * - $email: The entire e-mail configuration settings.
 * - $user: The current user submitting the form.
 * - $ip_address: The IP address of the user submitting the form.
 *
 * The $email['email'] variable can be used to send different e-mails to different users
 * when using the "default" e-mail template.
 */


$bulk_rate = $submission->data[41][value][0];

setlocale(LC_MONETARY, 'en_US');

//calculate the other sizes
//base this from the stored "rate" for 1L containers
$oil_ctr_rate = $submission->data[81][value][0];
$glycol_ctr_rate = $submission->data[142][value][0];

//the other prices, added together and multiplied by the ctr_rate

//oil custom containers
$oil_other_totals = 0;

$oitems = explode(';', $submission->data[98][value][0]);
foreach($oitems as $item){
	$oil_other_totals += cleannum($item);
}
$oil_in_litres = $oil_other_totals / $oil_ctr_rate;

//antifreeze custom containers
$glycol_other_totals = 0;

$gitems = explode(';',$submission->data[189][value][0]);
foreach($gitems as $item){
	$glycol_other_totals += cleannum($item);
}
$glycol_in_litres = $glycol_other_totals / $glycol_ctr_rate;

//the user stuff
global $user;
profile_load_profile($user);

$company_name = $user->profile_company_name;

// the association stuff



switch($submission->data[79][value][0]){
	case 'SK':
	$title = 		"Saskatchewan Association for Resource Recovery Corp.";
	$remitto = 	"Make cheque payable to: KPMG in trust for SARRC<br><strong>KPMG</strong><br>500 – 475 Second Avenue South<br>Saskatoon, SK S7K 1P4";
	$taxreg = 	"GST (#89176 3542 RT)";
	$assphone = "1 (306) 934-6200";
	$moreinfo = "Please contact <a href='mailto:krwhite@kpmg.ca'>krwhite@kpmg.ca</a> if you have any questions.";
	break;
	case 'MB':
	$title = 		'Manitoba Association for Resource Recovery Corp.';
	$remitto = 	"Make cheque payable to: KPMG in trust for MARRC<br><strong>KPMG</strong><br>Attention: Linda Weseen<br>Suite 2000, One Lombard Place<br>Winnipeg, MB R3B 0X3";
	$taxreg = 	"GST (#88264 5989 RT)";	
	$assphone = "1 (204) 957-2273";
	break;
	case 'AB':
	$title = 		'Alberta Used Oil Management Association';
	$remitto = 	"<strong>Alberta Used Oil Management Association</strong><br>Administration Office<br>Suite 1008, 10080 Jasper Ave. NW<br>Edmonton, AB T5J 1V9";
	$taxreg = 	"GST (#140327479RT)";
	$assphone = "1 (866) 414-1510";
	break;
	case 'BC':
	$title = 		'British Columbia Used Oil Management Association';
	$remitto = 	"<strong>British Columbia Used Oil Management Association</strong><br>Administration Office<br>Suite 1008, 10080 Jasper Ave. NW<br>Edmonton, AB T5J 1V9";
	$taxreg = 	"HST (#89254 4701 RT)";
	$assphone = "1 (866) 254-0555";
	break;		
}

 ?>
<h2><?php print $title;?><br>
Environmental Handling Charge Payment Schedule<br>
Remittance Form</h2>

<p>
<table cellspacing="0" class="remit-table" style="margin:0 10px;width:500px;border-collapse:collaspe">
<thead>
	<tr>
		<td style="text-align:left" valign="top" colspan="2">
			<strong><?php print $company_name?></strong><br>
			<?php print $user->profile_contact_name;?><br>
			<?php print $user->profile_phone;?><br>
			<?php print $user->mail;?>
		</td>
		<td valign="top">%username</td>
	</tr>
	<tr>	
		<td colspan="1">Period: <?php print $submission->data[73][value][0];?><br/>
		to <?php print $submission->data[107][value][0];?></td>
		<td colspan="2">Payment by: <?php print $submission->data[116][value][0];?></td>
	</tr>		
</thead>

<thead>
	<tr style="padding-top:5px">
	<th>Oil</th>
	<th>Litres Sold</th>
	<th>Remittance</th>
	</tr>	
</thead>	
<tbody>
	<tr>
		<th>&nbsp;</th>
		<td><?php print $submission->data[2][value][0];?></td>
		<td><?php print $submission->data[10][value][0];?></td>
	</tr>
	<tr>
		<th>&nbsp;</th>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>	
</tbody>

<thead>
	<tr style="padding-top:5px">
	<th>Oil Container Size</th>
	<th>Units Sold (in litres)</th>
	<th>Remittance</th>
	</tr>	
</thead>	
<tbody>
	<tr>
		<th>500 ml</th>
		<td><?php print cleannum($submission->data[8][value][0]) * 0.5;?></td>
		<td><?php print $submission->data[16][value][0];?></td>
	</tr>
	<tr>
		<th>947 ml</th>
		<td><?php print cleannum($submission->data[119][value][0]) * 0.947;?></td>
		<td><?php print $submission->data[121][value][0];?></td>
	</tr>	
	<tr>
		<th>1 Litre</th>
		<td><?php print cleannum($submission->data[80][value][0]) * 1;?></td>
		<td><?php print $submission->data[82][value][0];?></td>
	</tr>
	<tr>
		<th>3.788 Litre</th>
		<td><?php print cleannum($submission->data[123][value][0]) * 3.788;?></td>
		<td><?php print $submission->data[125][value][0];?></td>
	</tr>
	<tr>
		<th>4 Litre</th>
		<td><?php print cleannum($submission->data[83][value][0]) * 4;?></td>
		<td><?php print $submission->data[85][value][0];?></td>
	</tr>
	<tr>
		<th>5 Litre</th>
		<td><?php print cleannum($submission->data[127][value][0]) * 5;?></td>
		<td><?php print $submission->data[129][value][0];?></td>
	</tr>
	<tr>
		<th>10 Litre</th>
		<td><?php print cleannum($submission->data[86][value][0]) * 10;?></td>
		<td><?php print $submission->data[88][value][0];?></td>
	</tr>
	<tr>
		<th>18.942 Litre</th>
		<td><?php print cleannum($submission->data[89][value][0]) * 18.942;?></td>
		<td><?php print $submission->data[91][value][0];?></td>
	</tr>
	<tr>
		<th>20 Litre</th>
		<td><?php print cleannum($submission->data[92][value][0]) * 20;?></td>
		<td><?php print $submission->data[94][value][0];?></td>
	</tr>
	<tr>
		<th>Other Sizes <!-- sizes: <?php print $submission->data[96][value][0] . " quantity:" . $submission->data[106][value][0];?> --></th>
		<td><?php print $oil_in_litres;?></td>
		<td><?php print money_format('%!i',$oil_other_totals);?></td>
	</tr>	
	<tr>
		<th>&nbsp;</th>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>	
</tbody>

<thead>
	<tr style="padding-top:5px">
	<th>Oil Filters</th>
	<th>Units Sold</th>
	<th>Remittance</th>
	</tr>	
</thead>	
<tbody>
	<tr>
		<th>Under 8 inches (203mm)</th>
		<td><?php print $submission->data[4][value][0];?></td>
		<td><?php print $submission->data[13][value][0];?></td>
	</tr>
	<tr>
		<th>8 inches (203mm) and over</th>
		<td><?php print $submission->data[5][value][0];?></td>
		<td><?php print $submission->data[14][value][0];?></td>
	</tr>
	<tr>
		<th>Sump type</th>
		<td><?php print $submission->data[6][value][0];?></td>
		<td><?php print $submission->data[15][value][0];?></td>
	</tr>
	<tr>
		<th>&nbsp;</th>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>		
</tbody>

<thead>
	<tr style="padding-top:5px">
	<th>Antifreeze Liquid</th>
	<th>Litres Sold</th>
	<th>Remittance</th>
	</tr>	
</thead>	
<tbody>
	<tr>
		<th>Concentrate</th>
		<td><?php print $submission->data[178][value][0];?></td>
		<td><?php print $submission->data[180][value][0];?></td>
	</tr>
	<tr>
		<th>Premix</th>
		<td><?php print $submission->data[183][value][0];?></td>
		<td><?php print $submission->data[185][value][0];?></td>
	</tr>	
	<tr>
		<th>&nbsp;</th>
		<td></td>
		<td></td>
	</tr>	
</tbody>

<thead>
	<tr style="padding-top:5px">
	<th>Antifreeze Containers</th>
	<th>Units Sold (in litres)</th>
	<th>Remittance</th>
	</tr>	
</thead>	
<tbody>
	<tr>
		<th>1 Litre</th>
		<td><?php print cleannum($submission->data[141][value][0]) * 1;?></td>
		<td><?php print $submission->data[143][value][0];?></td>
	</tr>
	<tr>
		<th>1.5 Litre</th>
		<td><?php print cleannum($submission->data[145][value][0]) * 1.5;?></td>
		<td><?php print $submission->data[147][value][0];?></td>
	</tr>	
	<tr>
		<th>1.89 Litre</th>
		<td><?php print cleannum($submission->data[149][value][0]) * 1.89;?></td>
		<td><?php print $submission->data[151][value][0];?></td>
	</tr>
	<tr>
		<th>3.78 Litre</th>
		<td><?php print cleannum($submission->data[153][value][0]) * 3.78;?></td>
		<td><?php print $submission->data[155][value][0];?></td>
	</tr>
	<tr>
		<th>4 Litre</th>
		<td><?php print cleannum($submission->data[157][value][0]) * 4;?></td>
		<td><?php print $submission->data[159][value][0];?></td>
	</tr>	
	<tr>
		<th>5 Litre</th>
		<td><?php print cleannum($submission->data[161][value][0]) * 5;?></td>
		<td><?php print $submission->data[163][value][0];?></td>
	</tr>
	<tr>
		<th>9.46 Litre</th>
		<td><?php print cleannum($submission->data[165][value][0]) * 9.46;?></td>
		<td><?php print $submission->data[167][value][0];?></td>
	</tr>	
	<tr>
		<th>18.9 Litre</th>
		<td><?php print cleannum($submission->data[169][value][0]) * 18.9;?></td>
		<td><?php print $submission->data[171][value][0];?></td>
	</tr>
	<tr>
		<th>Other Sizes  <!-- sizes: <?php print $submission->data[187][value][0] . " quantity:" . $submission->data[190][value][0];?> --></th>
		<td><?php print $glycol_in_litres;?></td>
		<td><?php print money_format('%!i',$glycol_other_totals);?></td>
	</tr>	
</tbody>

<tfoot>
	<tr>
		<td colspan="2">Subtotal</td>
		<td><?php print $submission->data[68][value][0];?></td>
	</tr>
<?php if($submission->data[135][value][0] > 0):?>
	<tr>
		<td colspan="2">Tax applicable sales</td>
		<td><?php print $submission->data[135][value][0];?></td>
	</tr>
<?php endif;?>		
	<tr>
		<td colspan="2"><?php print $taxreg;?></td>
		<td><?php print $submission->data[69][value][0];?></td>
	</tr>
	<tr>
		<td colspan="2">Interest and admin charges</td>
		<td><?php print $submission->data[136][value][0];?></td>
	</tr>	
	<tr>
		<td colspan="2">Total</td>
		<td><?php print $submission->data[72][value][0];?></td>
	</tr>	
	<tr>
		<th colspan="3">Comments:<br><span style="font-weight:normal"><?php print $submission->data[137][value][0];?></span></th>
	</tr>
</tfoot>
</table>

<p style="margin:10px">If paying by cheque, please remit to:<br>
	<address style="padding:10px"><?php print $remitto;?><br>
	<?php print $assphone;?><address>
	<?php print $moreinfo;?>	
</p>


<p style="margin:10px"><a href="%submission_url">view online</a></p>

<pre><?php //print_r($submission);?></pre>
<pre><?php //print_r($user);?></pre>