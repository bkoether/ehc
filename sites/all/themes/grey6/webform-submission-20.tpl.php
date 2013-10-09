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
$rs = remittance_json_data($submission->data[79]['value'][0], $submission->data[73]['value'][0], $submission->data[107]['value'][0], 3, FALSE);
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
    $assphone = "ph: 1 (306) 934-6200 fx: 1 (306) 934-6233 email: <a href='mailto:krwhite@kpmg.ca'>krwhite@kpmg.ca</a>";
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
		<td style="text-align:left" valign="top" colspan="5">
			<strong><?php print $company_name?></strong><br>
			<?php print $submission->profile_contact_name;?><br>
			<?php print $submission->profile_phone;?><br>
			<?php print $submission->data[109][value][0];?>
		</td>
		<td valign="top"><?php print $submission->name;?></td>
	</tr>
	<tr><td colspan="6">&nbsp;</td></tr>
	<tr valign="top">
		<td colspan="5" style="padding-bottom:20px">Period:<br/><strong><?php print $submission->data[73][value][0];?>
		to <?php print $submission->data[107][value][0];?></strong></td>
		<td colspan="1" style="padding-bottom:20px">Payment by:<br /><strong><?php print $submission->data[116][value][0];?></strong></td>
	</tr>
</thead>
<thead>
	<tr style="padding-top:5px">
	<th colspan="3">Oil</th>
	<th colspan="2">Litres Sold</th>
	<th>Remittance</th>
	</tr>
</thead>
<tbody>
	<tr>
		<th colspan="3">&nbsp;</th>
		<td colspan="2"><?php print $submission->data[2][value][0];?></td>
		<td><?php print $submission->data[10][value][0];?></td>
	</tr>
	<tr>
		<th colspan="3">&nbsp;</th>
		<td colspan="2">&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
</tbody>

<thead>
	<tr style="padding-top:5px">
	<th colspan="3">Oil Container Size</th>
	<th colspan="2">Units Sold (in litres)</th>
	<th>Remittance</th>
	</tr>
</thead>
<tbody>
	<tr>
		<th colspan="3">500 ml</th>
		<td colspan="2"><?php print cleannum($submission->data[8][value][0]) * 0.5;?></td>
		<td><?php print $submission->data[16][value][0];?></td>
	</tr>
	<tr>
		<th colspan="3">947 ml</th>
		<td colspan="2"><?php print cleannum($submission->data[119][value][0]) * 0.947;?></td>
		<td><?php print $submission->data[121][value][0];?></td>
	</tr>
	<tr>
		<th colspan="3">1 Litre</th>
		<td colspan="2"><?php print cleannum($submission->data[80][value][0]) * 1;?></td>
		<td><?php print $submission->data[82][value][0];?></td>
	</tr>
	<tr>
		<th colspan="3">3.78 Litre</th>
		<td colspan="2"><?php print cleannum($submission->data[123][value][0]) * 3.78;?></td>
		<td><?php print $submission->data[125][value][0];?></td>
	</tr>
	<tr>
		<th colspan="3">4 Litre</th>
		<td colspan="2"><?php print cleannum($submission->data[83][value][0]) * 4;?></td>
		<td><?php print $submission->data[85][value][0];?></td>
	</tr>
	<tr>
		<th colspan="3">5 Litre</th>
		<td colspan="2"><?php print cleannum($submission->data[127][value][0]) * 5;?></td>
		<td><?php print $submission->data[129][value][0];?></td>
	</tr>
	<tr>
		<th colspan="3">10 Litre</th>
		<td colspan="2"><?php print cleannum($submission->data[86][value][0]) * 10;?></td>
		<td><?php print $submission->data[88][value][0];?></td>
	</tr>
	<tr>
		<th colspan="3">18.942 Litre</th>
		<td colspan="2"><?php print cleannum($submission->data[89][value][0]) * 18.942;?></td>
		<td><?php print $submission->data[91][value][0];?></td>
	</tr>
	<tr>
		<th colspan="3">20 Litre</th>
		<td colspan="2"><?php print cleannum($submission->data[92][value][0]) * 20;?></td>
		<td><?php print $submission->data[94][value][0];?></td>
	</tr>
	<tr>
		<th colspan="3">Other Sizes <!-- sizes: <?php print $submission->data[96][value][0] . " quantity:" . $submission->data[106][value][0];?> --></th>
		<td colspan="2"><?php print $oil_in_litres;?></td>
		<td><?php print money_format('%!i',$oil_other_totals);?></td>
	</tr>
	<tr>
		<th colspan="3">&nbsp;</th>
		<td colspan="2">&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
</tbody>

<thead>
	<tr style="padding-top:5px">
	<th colspan="3">Oil Filters</th>
	<th colspan="2">Units Sold</th>
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
		<th colspan="3">Under 8 inches (203mm) and all sump type filter</th>
		<td colspan="2"><?php print $filter_small_qty;?></td>
		<td><?php print $filter_small_val;?></td>
	</tr>
	<tr>
		<th colspan="3">8 inches (203mm) and over</th>
		<td colspan="2"><?php print $submission->data[5][value][0];?></td>
		<td><?php print $submission->data[14][value][0];?></td>
	</tr>
	<tr>
		<th colspan="3">&nbsp;</th>
		<td colspan="2">&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
</tbody>

<?php
// Check if we have OEM values set
$totals = array(
  'oil' => 0,
  'coolant' => 0,
  'filter_small' => 0,
  'filter_large' => 0,
  'total' => 0,
);

$display_oem = FALSE;
$rows = array();
if (isset($renderable['oem'])) {
  $categories = $renderable['oem']['#webform_component']['children'];
  foreach ($categories as $category) {

    $row = array();
    $row['name'] = $category['name'];

    foreach ($category['children'] as $field) {
      switch ($field['form_key']){
        case $category['form_key'] . '_oil':
          if (isset($submission->data[$field['cid']])){
            $display_oem = TRUE;
            $row['oil'] = $submission->data[$field['cid']]['value'][0];
            $totals['oil'] += $submission->data[$field['cid']]['value'][0];
          }
          break;

        case $category['form_key'] . '_coolant':
          if (isset($submission->data[$field['cid']])){
            $display_oem = TRUE;
            $row['coolant'] = $submission->data[$field['cid']]['value'][0];
            $totals['coolant'] += $submission->data[$field['cid']]['value'][0];
          }
          break;

        case $category['form_key'] . '_filter_small':
          if (isset($submission->data[$field['cid']])){
            $display_oem = TRUE;
            $row['filter_small'] = $submission->data[$field['cid']]['value'][0];
            $totals['filter_small'] += $submission->data[$field['cid']]['value'][0];
          }
          break;

        case $category['form_key'] . '_filter_large':
          if (isset($submission->data[$field['cid']])){
            $display_oem = TRUE;
            $row['filter_large'] = $submission->data[$field['cid']]['value'][0];
            $totals['filter_large'] += $submission->data[$field['cid']]['value'][0];
          }
          break;

        case $category['form_key'] . '_total':
          if (isset($submission->data[$field['cid']])){
            $display_oem = TRUE;
            $row['total'] = $submission->data[$field['cid']]['value'][0];
            $totals['total'] += str_replace(',', '', $row['total']);
          }
          break;

        default:
          continue;
          break;
      }
    }
    $rows[] = $row;
  }

}

?>
<?php if ($display_oem): ?>
  <thead>
    <tr>
      <th>OEM</th>
      <th>Oil (l)</th>
      <th>Coolant (l)</th>
      <th>Small Filters</th>
      <th>Large Filters</th>
      <th>Remittance</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($rows as $line): ?>
      <tr>
        <th><?php print $line['name']; ?></th>
        <td><?php print $line['oil']; ?></td>
        <td><?php print $line['coolant']; ?></td>
        <td><?php print $line['filter_small']; ?></td>
        <td><?php print $line['filter_large']; ?></td>
        <td><?php print $line['total']; ?></td>
      </tr>
    <?php endforeach; ?>
    <tr class="sub-total">
      <th style="text-align: right;">Subtotal</th>
      <td><?php print $totals['oil']; ?></td>
      <td><?php print $totals['coolant']; ?></td>
      <td><?php print $totals['filter_small']; ?></td>
      <td><?php print $totals['filter_large']; ?></td>
      <td><?php print number_format($totals['total'],2); ?></td>
    </tr>
    <tr><td colspan="6">&nbsp;</td></tr>
  </tbody>
<?php endif; ?>


<tfoot>
	<tr>
		<td colspan="5">Subtotal</td>
		<td><?php print $submission->data[68][value][0];?></td>
	</tr>
<?php if($submission->data[135][value][0] > 0):?>
	<tr>
		<td colspan="5">Tax applicable sales</td>
		<td><?php print $submission->data[135][value][0];?></td>
	</tr>
<?php endif;?>
	<tr>
		<td colspan="5"><?php print $taxreg;?></td>
		<td><?php print $submission->data[69][value][0];?></td>
	</tr>
	<tr>
		<td colspan="5">Interest and admin charges</td>
		<td><?php print $submission->data[136][value][0];?></td>
	</tr>
	<tr>
		<td colspan="5">Total</td>
		<td><?php print $submission->data[72][value][0];?></td>
	</tr>
	<tr>
		<th colspan="6">Comments:<br><span style="font-weight:normal"><?php print $submission->data[137][value][0];?></span></th>
	</tr>
</tfoot>
</table>
</div>