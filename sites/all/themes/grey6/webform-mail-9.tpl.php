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

// Calculate Non-HDPE custom sizes
$hdpe_other_totals = 0;
$hdpe_other_litres = 0;
$hdpe_items = explode(';', $submission->data[254]['value'][0]);
foreach ($hdpe_items as $line) {
  $hdpe_other_totals += $line;
}
if ($hdpe_other_totals) {
  $hdpe_sizes = explode(';', $submission->data[251]['value'][0]);
  $hdpe_qty = explode(';', $submission->data[252]['value'][0]);
  foreach ($hdpe_sizes as $id => $size) {
    $hdpe_other_litres += $size * $hdpe_qty[$id];
  }
}


//the user stuff
global $user;
profile_load_profile($user);

$company_name = $user->profile_company_name;

// the association stuff

$tax_prefix = 'GST';
// Get the rate sheet
$rs = remittance_json_data($submission->data[79]['value'][0], $submission->data[73]['value'][0], $submission->data[107]['value'][0], 3, FALSE);
if ($rs['hst'] || $rs['pst'] || $rs['gst']) {
  if ($rs['hst']) {
    $tax_prefix = 'HST';
  }
  else if($user->profile_pst_applicable && !$rs['hst']) {
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
<h2><?php print $title;?><br>
Environmental Handling Charge Payment Schedule<br>
Remittance Form</h2>

<p>
<table cellspacing="0" class="remit-table" style="margin:0 10px;width:500px;border-collapse:collaspe">
<thead>
	<tr>
		<td style="text-align:left" valign="top" colspan="5">
			<strong><?php print $company_name?></strong><br>
			<?php print $user->profile_contact_name;?><br>
			<?php print $user->profile_phone;?><br>
			<?php print $user->mail;?>
		</td>
		<td valign="top">%username</td>
	</tr>
	<tr>
		<td colspan="5">Period: <?php print $submission->data[73][value][0];?><br/>
		to <?php print $submission->data[107][value][0];?></td>
		<td colspan="1">Payment by: <?php print $submission->data[116][value][0];?></td>
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
		<th colspan="3">3.788 Litre</th>
		<td colspan="2"><?php print cleannum($submission->data[123][value][0]) * 3.788;?></td>
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

<?php if ($submission->data[243]['value'][0] || $submission->data[247]['value'][0]): ?>
  <thead>
  <tr style="padding-top:5px">
    <th colspan="3">Non-HDPE Container</th>
    <th colspan="2">Units Sold (in litres)</th>
    <th>Remittance</th>
  </tr>
  </thead>
  <tbody>
  <tr>
    <th colspan="3">0.946 Litre</th>
    <td colspan="2"><?php print cleannum($submission->data[243]['value'][0]) * 0.946;?></td>
    <td><?php print $submission->data[245][value][0];?></td>
  </tr>
  <tr>
    <th colspan="3">22.7 Litre</th>
    <td colspan="2"><?php print cleannum($submission->data[247]['value'][0]) * 22.7;?></td>
    <td><?php print $submission->data[249][value][0];?></td>
  </tr>
  <tr>
    <th colspan="3">Other Sizes</th>
    <td colspan="2"><?php print $hdpe_other_litres;?></td>
    <td><?php print money_format('%!i',$hdpe_other_totals);?></td>
  </tr>
  <tr>
    <th colspan="3">&nbsp;</th>
    <td colspan="2"></td>
    <td></td>
  </tr>
  </tbody>
<?php endif; ?>

<thead>
	<tr style="padding-top:5px">
	<th colspan="3">Antifreeze Liquid</th>
	<th colspan="2">Litres Sold</th>
	<th>Remittance</th>
	</tr>
</thead>
<tbody>
	<tr>
		<th colspan="3">Concentrate</th>
		<td colspan="2"><?php print $submission->data[178][value][0];?></td>
		<td><?php print $submission->data[180][value][0];?></td>
	</tr>
	<tr>
		<th colspan="3">Premix</th>
		<td colspan="2"><?php print $submission->data[183][value][0];?></td>
		<td><?php print $submission->data[185][value][0];?></td>
	</tr>
	<tr>
		<th colspan="6">&nbsp;</th>
	</tr>
</tbody>

<thead>
	<tr style="padding-top:5px">
	<th colspan="3">Antifreeze Containers</th>
	<th colspan="2">Units Sold (in litres)</th>
	<th>Remittance</th>
	</tr>
</thead>
<tbody>
	<tr>
		<th colspan="3">1 Litre</th>
		<td colspan="2"><?php print cleannum($submission->data[141][value][0]) * 1;?></td>
		<td><?php print $submission->data[143][value][0];?></td>
	</tr>
	<tr>
		<th colspan="3">1.5 Litre</th>
		<td colspan="2"><?php print cleannum($submission->data[145][value][0]) * 1.5;?></td>
		<td><?php print $submission->data[147][value][0];?></td>
	</tr>
	<tr>
		<th colspan="3">1.89 Litre</th>
		<td colspan="2"><?php print cleannum($submission->data[149][value][0]) * 1.89;?></td>
		<td><?php print $submission->data[151][value][0];?></td>
	</tr>
	<tr>
		<th colspan="3">3.78 Litre</th>
		<td colspan="2"><?php print cleannum($submission->data[153][value][0]) * 3.78;?></td>
		<td><?php print $submission->data[155][value][0];?></td>
	</tr>
	<tr>
		<th colspan="3">4 Litre</th>
		<td colspan="2"><?php print cleannum($submission->data[157][value][0]) * 4;?></td>
		<td><?php print $submission->data[159][value][0];?></td>
	</tr>
	<tr>
		<th colspan="3">5 Litre</th>
		<td colspan="2"><?php print cleannum($submission->data[161][value][0]) * 5;?></td>
		<td><?php print $submission->data[163][value][0];?></td>
	</tr>
	<tr>
		<th colspan="3">9.46 Litre</th>
		<td colspan="2"><?php print cleannum($submission->data[165][value][0]) * 9.46;?></td>
		<td><?php print $submission->data[167][value][0];?></td>
	</tr>
	<tr>
		<th colspan="3">18.9 Litre</th>
		<td colspan="2"><?php print cleannum($submission->data[169][value][0]) * 18.9;?></td>
		<td><?php print $submission->data[171][value][0];?></td>
	</tr>
	<tr>
		<th colspan="3">Other Sizes  <!-- sizes: <?php print $submission->data[187][value][0] . " quantity:" . $submission->data[190][value][0];?> --></th>
		<td colspan="2"><?php print $glycol_in_litres;?></td>
		<td><?php print money_format('%!i',$glycol_other_totals);?></td>
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


// Wee need to get the tree differently as we don't have the renderable array available.
$page = 1;
$oem_tree = array();
_webform_components_tree_build($node->webform['components'], $oem_tree, 191, $page);

$display_oem = FALSE;
$rows = array();
if (!empty($oem_tree)) {
  $categories = $oem_tree['children'];
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

<p style="margin:10px">If paying by cheque, please remit to:<br>
	<address style="padding:10px"><?php print $remitto;?><br>
	<?php print $assphone;?><address>
	<?php print $moreinfo;?>
</p>


<p style="margin:10px"><a href="%submission_url">view online</a></p>