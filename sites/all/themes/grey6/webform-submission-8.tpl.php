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

//%email_values
//      2= oil #
//      4 = <8inches #
//      5 = >= 8 inches #
//      6 = sump #
//      8 = 500ml #
//      10 = 0.05
//      13 = <8 inches total
//      14 = >=8 inches total
//      15 = sump total
//      16 = 500ml total
//      41 = 0.05
//      42 = <inches rate
//      43 = >= 8inches rate
//      44 = sump rate
//      45 = 0.05
//      68 = subtotal total
//      69 = tax rate total
//      72 = total total
//      73 = start date
//      79 = location
//      80 = 1 litre #
//      81 = 0.1
//      82 = 1 litre total
//      83 = 4 litre #
//      84 = 4 litre rate
//      85 = 4 litre total
//      86 = 10 litre #
//      87 = 10 litre rate
//      88 = 10 litre rate
//      89 = 18.9 litre #
//      90 = 18.9 rate
//      91 = 18.9 total
//      92 = 20 litre #
//      93 = 20 litre rate
//      94 = 20 litre total
//      95 = tax rate
//      96 = custom names
//      97 =  custom rates
//      98 = custom total
//      106 = custom #s
//      107 = end date
//      109 = email
//      115 = certify;
//      116 = EFT
//      119 = 0.94 #
//      120 = 0.94 rate
//      121 = 0.94 total
//      123 = 3.7 #
//      124 = 3.7 rate
//      125 = 3.7 total
//      127 = 5 litre #
//      128 = 5 litre rate
//      129 = 5 litre total
//      134 = yes;

setlocale(LC_MONETARY, 'en_US');

//calculate the other sizes
$bulk_rate = $submission->data[41][value][0];
$ctr_rate = $submission->data[81][value][0];


//the other prices, added together and multiplied by the ctr_rate
$other_totals = 0;

$items = explode(';',$submission->data[98][value][0]);

foreach($items as $item){
	$other_totals += cleannum($item);
}

$in_litres = $other_totals / $ctr_rate;

//the user stuff
//global $user;
profile_load_profile($submission);

$company_name = $submission->profile_company_name;

// the association stuff


$tax_prefix = 'GST';
// Get the rate sheet
$rs = remittance_json_data($submission->data[79]['value'][0], $submission->data[73]['value'][0], $submission->data[107]['value'][0], 2, FALSE);
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
    $remitto = 	"Make cheque payable to: KPMG in trust for SARRC<br><strong>KPMG</strong><br>500 – 475 Second Avenue South<br>Saskatoon, SK S7K 1P4";
    $taxreg = 	$tax_prefix . " (#89176 3542 RT)";
    $assphone = "ph: 1 (306) 934-6200 fx: 1 (306) 934-6233 email: <a href='mailto:kgusikoski@kpmg.ca'>kgusikoski@kpmg.ca</a>";
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
	<th>Antifreeze Liquid</th>
	<th>Litres Sold</th>
	<th>Remittance</th>
	</tr>
</thead>
<tbody>
	<tr>
		<th>Concentrate</th>
		<td><?php print $submission->data[2][value][0];?></td>
		<td><?php print $submission->data[10][value][0];?></td>
	</tr>
	<tr>
		<th>Premix</th>
		<td><?php print $submission->data[139][value][0];?></td>
		<td><?php print $submission->data[141][value][0];?></td>
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
		<th>150 ml</th>
		<td><?php print cleannum($submission->data[8][value][0]) * 0.5;?></td>
		<td><?php print $submission->data[16][value][0];?></td>
	</tr>
	<tr>
		<th>1 Litre</th>
		<td><?php print cleannum($submission->data[80][value][0]) * 1;?></td>
		<td><?php print $submission->data[82][value][0];?></td>
	</tr>
	<tr>
		<th>1.5 Litre</th>
		<td><?php print cleannum($submission->data[143][value][0]) * 1.5;?></td>
		<td><?php print $submission->data[158][value][0];?></td>
	</tr>
	<tr>
		<th>1.89 Litre</th>
		<td><?php print cleannum($submission->data[119][value][0]) * 1.89;?></td>
		<td><?php print $submission->data[121][value][0];?></td>
	</tr>
	<tr>
		<th>2 Litre</th>
		<td><?php print cleannum($submission->data[160][value][0]) * 2;?></td>
		<td><?php print $submission->data[162][value][0];?></td>
	</tr>
	<tr>
		<th>3.78 Litre</th>
		<td><?php print cleannum($submission->data[127][value][0]) * 3.78;?></td>
		<td><?php print $submission->data[125][value][0];?></td>
	</tr>
	<tr>
		<th>4 Litre</th>
		<td><?php print cleannum($submission->data[83][value][0]) * 4;?></td>
		<td><?php print $submission->data[85][value][0];?></td>
	</tr>
	<tr>
		<th>5 Litre</th>
		<td><?php print cleannum($submission->data[10][value][0]) * 5;?></td>
		<td><?php print $submission->data[129][value][0];?></td>
	</tr>
	<tr>
		<th>7.56 Litre</th>
		<td><?php print cleannum($submission->data[154][value][0]) * 7.56;?></td>
		<td><?php print $submission->data[156][value][0];?></td>
	</tr>
	<tr>
		<th>9.46 Litre</th>
		<td><?php print cleannum($submission->data[151][value][0]) * 9.46;?></td>
		<td><?php print $submission->data[153][value][0];?></td>
	</tr>
	<tr>
		<th>10 Litre</th>
		<td><?php print cleannum($submission->data[86][value][0]) * 10;?></td>
		<td><?php print $submission->data[88][value][0];?></td>
	</tr>
	<tr>
		<th>15 Litre</th>
		<td><?php print cleannum($submission->data[89][value][0]) * 15;?></td>
		<td><?php print $submission->data[150][value][0];?></td>
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
		<th>Other Sizes <?php //print $submission->data[96][value][0];?></th>
		<td><?php print $in_litres;?></td>
		<td><?php print money_format('%!i',$other_totals);?></td>
	</tr>
</tbody>

<!-- <thead>
  <tr style="padding-top:5px">
  <th>Filters</th>
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
</tbody> -->
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