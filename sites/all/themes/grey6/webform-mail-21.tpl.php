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
global $user;
profile_load_profile($user);

$company_name = $user->profile_company_name;

// the association stuff

$tax_prefix = 'GST';
// Get the rate sheet
$rs = remittance_json_data($submission->data[79]['value'][0], $submission->data[73]['value'][0], $submission->data[107]['value'][0], 2, FALSE);
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
		<td colspan="4">Period: <?php print $submission->data[73][value][0];?><br/>
		to <?php print $submission->data[107][value][0];?></td>
		<td colspan="2">Payment by: <?php print $submission->data[116][value][0];?></td>
	</tr>
</thead>
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
		<td colspan="2"><?php print $submission->data[2][value][0];?></td>
		<td><?php print $submission->data[10][value][0];?></td>
	</tr>
	<tr>
		<th colspan="3">Premix</th>
		<td colspan="2"><?php print $submission->data[139][value][0];?></td>
		<td><?php print $submission->data[141][value][0];?></td>
	</tr>
	<tr>
		<th colspan="4">&nbsp;</th>
		<td></td>
		<td></td>
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
		<th colspan="3">150 ml</th>
		<td colspan="2"><?php print cleannum($submission->data[8][value][0]) * 0.15;?></td>
		<td><?php print $submission->data[16][value][0];?></td>
	</tr>
	<tr>
		<th colspan="3">1 Litre</th>
		<td colspan="2"><?php print cleannum($submission->data[80][value][0]) * 1;?></td>
		<td><?php print $submission->data[82][value][0];?></td>
	</tr>
	<tr>
		<th colspan="3">1.5 Litre</th>
		<td colspan="2"><?php print cleannum($submission->data[143][value][0]) * 1.5;?></td>
		<td><?php print $submission->data[158][value][0];?></td>
	</tr>
	<tr>
		<th colspan="3">1.89 Litre</th>
		<td colspan="2"><?php print cleannum($submission->data[119][value][0]) * 1.89;?></td>
		<td><?php print $submission->data[121][value][0];?></td>
	</tr>
	<tr>
		<th colspan="3">2 Litre</th>
		<td colspan="2"><?php print cleannum($submission->data[160][value][0]) * 2;?></td>
		<td><?php print $submission->data[162][value][0];?></td>
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
		<th colspan="3">7.56 Litre</th>
		<td colspan="2"><?php print cleannum($submission->data[154][value][0]) * 7.56;?></td>
		<td><?php print $submission->data[156][value][0];?></td>
	</tr>
	<tr>
		<th colspan="3">9.46 Litre</th>
		<td colspan="2"><?php print cleannum($submission->data[151][value][0]) * 9.46;?></td>
		<td><?php print $submission->data[153][value][0];?></td>
	</tr>
	<tr>
		<th colspan="3">10 Litre</th>
		<td colspan="2"><?php print cleannum($submission->data[86][value][0]) * 10;?></td>
		<td><?php print $submission->data[88][value][0];?></td>
	</tr>
	<tr>
		<th colspan="3">15 Litre</th>
		<td colspan="2"><?php print cleannum($submission->data[148][value][0]) * 15;?></td>
		<td><?php print $submission->data[150][value][0];?></td>
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
		<th colspan="3">Other Sizes <?php //print $submission->data[96][value][0];?></th>
		<td colspan="2"><?php print $in_litres;?></td>
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


<?php
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
$totals['total'] += $submission->data[$field['cid']]['value'][0];
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

<pre><?php //print_r($submission);?></pre>
<pre><?php //print_r($user);?></pre>