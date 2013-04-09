<?php
// $Id: webform-submission.tpl.php,v 1.1.2.1 2010/08/30 17:01:54 quicksketch Exp $

/**
 * @file
 * Customize the display of a webform submission.
 *
 * Available variables:
 * - $node: The node object for this webform.
 * - $submission: The Webform submission array.
 * - $email: If sending this submission in an e-mail, the e-mail configuration
 *   options.
 * - $format: The format of the submission being printed, either "html" or
 *   "text".
 * - $renderable: The renderable submission array, used to print out individual
 *   parts of the submission, just like a $form array.
 */

$bulk_rate = $submission->data[41][value][0];

//setlocale(LC_MONETARY, 'en_US');
setlocale(LC_MONETARY, 'en_US.UTF-8');


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
//global $user;
profile_load_profile($submission);

$company_name = $submission->profile_company_name;

// the association stuff
$tax_prefix = 'GST';
// Get the rate sheet
$rs = remittance_json_data($submission->data[79]['value'][0], $submission->data[73]['value'][0], $submission->data[107]['value'][0], FALSE);
if ($rs['hst'] || $rs['pst'] || $rs['gst']) {
  if ($rs['hst']) {
    $tax_prefix = 'HST';
  }
  else if($submission->profile_pst_applicable && !$rs['hst']) {
    $tax_prefix = 'GST + PST';
  }
}
// Fallback to defaults if there is no rate sheet avaibale.
else if ($submission->data[79]['value'][0] == 'BC') {
  $tax_prefix = 'HST';
}

switch($submission->data[79][value][0]){
  case 'SK':
    $title = 		"Saskatchewan Association for Resource Recovery Corp.";
    $remitto = 	"Make cheque payable to: KPMG in trust for SARRC<br><strong>KPMG</strong><br>#600 128 4th Avenue South<br>Saskatoon, SK S7K 1M8";
    $taxreg = 	$tax_prefix . " (#89176 3542 RT)";
    $assphone = "ph: 1 (306) 934-6200 fx: 1 (306) 934-6233 email: <a href='mailto:lglubis@kpmg.ca'>lglubis@kpmg.ca</a>";
    break;
  case 'MB':
    $title = 		'Manitoba Association for Resource Recovery Corp.';
    $remitto = 	"Make cheque payable to: KPMG in trust for MARRC<br><strong>KPMG</strong><br>Attention: Linda Weseen<br>Suite 2000, One Lombard Place<br>Winnipeg, MB R3B 0X3";
    $taxreg = 	$tax_prefix . " (#88264 5989 RT)";
    $assphone = "1 (204) 957-2273";
    break;
  case 'AB':
    $title = 		'Alberta Used Oil Management Association';
    $remitto = 	"<strong>Alberta Used Oil Management Association</strong><br>Administration Office<br>Suite 1008, 10080 Jasper Ave. NW<br>Edmonton, AB T5J 1V9";
    $taxreg = 	$tax_prefix . " (#140327479RT)";
    $assphone = "1 (866) 414-1510";
    break;
  case 'BC':
    $title = 		'British Columbia Used Oil Management Association';
    $remitto = 	"<strong>British Columbia Used Oil Management Association</strong><br>Administration Office<br>Suite 1008, 10080 Jasper Ave. NW<br>Edmonton, AB T5J 1V9";
    $taxreg = 	$tax_prefix . " (#89254 4701 RT)";
    $assphone = "1 (866) 254-0555";
    break;
}

 ?>
<div class="table-ctr">
<table cellspacing="0" class="remit-table">
<thead>
	<tr>
		<td style="text-align:left" valign="top" colspan="2">
			<strong><?php print $company_name?></strong><br>
			<?php print $submission->profile_contact_name;?><br>
			<?php print $submission->profile_phone;?><br>
			<?php print $submission->data[109][value][0];?>
		</td>
		<td valign="top"><?php print $submission->name;?></td>
	</tr>
	<tr><td colspan="3">&nbsp;</td></tr>
	<tr valign="top">
		<td colspan="2" style="padding-bottom:20px">Period:<br/><strong><?php print $submission->data[73][value][0];?>
		to <?php print $submission->data[107][value][0];?></strong></td>
		<td colspan="1" style="padding-bottom:20px">Payment by:<br /><strong><?php print $submission->data[116][value][0];?></strong></td>
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
		<th>3.78 Litre</th>
		<td><?php print cleannum($submission->data[123][value][0]) * 3.78;?></td>
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
		<?php
		$filter_small_qty =  $submission->data[4][value][0];
		$filter_small_val = $submission->data[13][value][0];
		if ($submission->data[6][value][0]) {
			$qty_sum = (int)str_replace(',', '', $filter_small_qty) + (int)str_replace(',', '', $submission->data[6][value][0]);
			$qty_val = (float)str_replace(',', '', $filter_small_val) + (float)str_replace(',', '', $submission->data[15][value][0]);
			$filter_small_qty = number_format($qty_sum);
			$filter_small_val = money_format('%!i', $qty_val);
		}
		?>
		<th>Under 8 inches (203mm) and all sump type filter</th>
		<td><?php print $filter_small_qty;?></td>
		<td><?php print $filter_small_val;?></td>
	</tr>
	<tr>
		<th>8 inches (203mm) and over</th>
		<td><?php print $submission->data[5][value][0];?></td>
		<td><?php print $submission->data[14][value][0];?></td>
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
		<th>18.942 Litre</th>
		<td><?php print cleannum($submission->data[169][value][0]) * 18.942;?></td>
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
</div>
<!--
<?php print_r($submission);?>
-->