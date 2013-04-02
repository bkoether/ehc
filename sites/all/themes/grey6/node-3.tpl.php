<?php
/**
 *	the EHC Remittance Form
 **/

//this is not needed because it's in the Drupal.settings js now
//if($previous_sizes){print $previous_sizes;}

?>

<script type="text/javascript" charset="utf-8">
	
var pRates = new Array();
<?php

profile_load_profile($user);


$provinces = array(
	'BC' => 'British Columbia',
	'AB' => 'Alberta',
	'MB' => 'Manitoba',
	'SK' => 'Saskatchewan'
);
$charges = array(
	'PST' => 0,
	'GST' => 0,
	'HST' => 0,
	'Oil' => 0,
	'Oil Containers' => 0,
	'Oil Filter <= 8in' => 0,
	'Oil Filter > 8in' => 0,
	'Oil Filter Sump' => 0,
	'Glycol Concentrate' => 0,
	'Glycol Premix' => 0,
	'Glycol Containers' => 0
);
// $charges = array(
// 	'PST' => 0.075,
// 	'GST' => 0.05,
// 	'HST' => 0.125,
// 	'Oil' => 0.05,
// 	'Oil Containers' => 0.05,
// 	'Oil Filter <= 8in' => 0.08,
// 	'Oil Filter > 8in' => 0.08,
// 	'Oil Filter Sump' => 0.10,
// 	'Glycol Concentrate' => 0.50,
// 	'Glycol Premix' => 0.50,
// 	'Glycol Containers' => 0.50
// );
foreach ($provinces as $short => $long) {
	print "\n"."pRates['".$short."'] = new Array();\n";
	$b = 0;
	foreach ($charges as $name => $rate) {
		if ($short == 'BC' AND ($type == 'GST' OR $type == 'PST')) {
			continue;
		} else if ($type == 'HST') {
			continue;
		}
		
		$name = str_replace( array(" ", "(" ,")" ,"."), "-", $name);
		// $name = str_replace(, "-", $name);
		// $name = str_replace(, "-", $name);
		// $name = str_replace(".", "-", $name);
		$price = variable_get($short . "_" . $name, $rate);
		print "pRates['".$short."'][".$b."] = ".$price.";\n";
		$b++;
	}
}
?>

var fieldsArray = new Array();
fieldsArray.push( 'edit-submitted-oils-oil-fieldset-total-litres' );
fieldsArray.push( 'edit-submitted-filters-filters-8-fieldset-less-than-8-inches' );
fieldsArray.push( 'edit-submitted-filters-filters--8-fieldset-greater-than-8-inches' );
fieldsArray.push( 'edit-submitted-filters-filters-sump-fieldset-sump-type' );
// fieldsArray.push( 'edit-submitted-filters-less-than-8-inches' );
// fieldsArray.push( 'edit-submitted-filters-greater-than-8-inches' );
// fieldsArray.push( 'edit-submitted-filters-sump-type' );
fieldsArray.push( 'edit-submitted-containers-size-wrapper-500-ml' );
fieldsArray.push( 'edit-submitted-containers-size-wrapper-2-1-liter' );
fieldsArray.push( 'edit-submitted-containers-size-wrapper-3-4-liter' );
fieldsArray.push( 'edit-submitted-containers-size-wrapper-4-10-liter' );
fieldsArray.push( 'edit-submitted-containers-size-wrapper-5-18-942-liter' );
fieldsArray.push( 'edit-submitted-containers-size-wrapper-6-20-liter' );
fieldsArray.push( 'edit-submitted-containers-size-wrapper-0947-l-0947-liter' );
fieldsArray.push( 'edit-submitted-containers-size-wrapper-3788-l-3788-liter' );
fieldsArray.push( 'edit-submitted-containers-size-wrapper-5-l-5-liter' );





function setup_defaults() {
	<?php if (isset($user->profile_province)) : ?>
	<?php foreach ($provinces as $key => $value) { if ($value == $user->profile_province) { ?>
	var currentProvince = "<?php print $key; ?>";
	$("#edit-submitted-province-select-province").val("<?php print $key; ?>");
	<?php } } ?>
	<?php else : ?>
	var currentProvince = $("#edit-submitted-province-select-province").val();
	<?php endif; ?>
	var currentPArray = pRates[currentProvince];
	//oil
	$("#" + fieldsArray[0] + "-rate").val(currentPArray[3]).niceRates();
	//filters
	$("#" + fieldsArray[1] + "-rate").val(currentPArray[5]).niceRates();
	$("#" + fieldsArray[2] + "-rate").val(currentPArray[6]).niceRates();
	$("#" + fieldsArray[3] + "-rate").val(currentPArray[7]).niceRates();
	var start = 4;
	var currentOilContainer = currentPArray[4];
	while (12 >= start) {
		var value = currentOilContainer;
		if (start == 4) { value = value * 0.5; }
		if (start == 6) { value = value * 4; }
		if (start == 7) { value = value * 10; }
		if (start == 8) { value = value * 18.942; }
		if (start == 9) { value = value * 20; }
		if (start == 10) { value = value * 0.947; }
		if (start == 11) { value = value * 3.788; }
		if (start == 12) { value = value * 5; }
		$("#" + fieldsArray[start] + "-rate").val(value).niceRates();
		
		start++;
	}
	
	if (currentPArray[2] != 0) {
		$("#edit-submitted-totals-tax-rate").val(currentPArray[2]);
			$("#edit-submitted-totals-tax-wrapper").find('label').text('HST @ ' + (currentPArray[2]*100) + '%');
	} else {
		var tax = parseFloat(currentPArray[0]) + parseFloat(currentPArray[1]);
		$("#edit-submitted-totals-tax-rate").val(tax);
		$("#edit-submitted-totals-tax-wrapper").find('label').text('GST @ ' + (tax*100) + '%');
	}
}

</script>

<script type="text/javascript" charset="utf-8">
/**
 *	the initialization
**/

$(document).ready( function () {
	setup_defaults();

	for (var field in fieldsArray) {
		$("#" + fieldsArray[field]).change( function () {
			var thisID = $(this).attr('id');
			
			//clear out any non-numbers
			$("#" + thisID).cleannum();
			var total = $("#" + thisID).val() * $("#" + thisID + "-rate").val();
			//add commas back
			$("#" + thisID).digits();
			
			if (check_decimals(total, 2, 9999)) {
				total = roundNumber(total, 2);
			}
			total = numberToFixed(total, 2);
			$("#" + thisID + "-remittance").val(total);

			do_totals();
			$("#" + thisID + "-remittance").digits();
		});
	}

	//the tax applicable sales and admin fees
	$('#edit-submitted-totals-tax-applicable-sales, #edit-submitted-totals-interest-admin-fees').change(function(){
		//console.log($(this).val());
		 var total = $(this).cleannum().val();
		//console.log(total);
		
		do_totals();
		
		if (check_decimals(total, 2, 9999)) {
			total = roundNumber(total, 2);
		}
		total = numberToFixed(total, 2);
		
		$(this).val(total).digits();
		//console.log(total);
		//console.log($(this).val());
	});


});
</script>

<div id="node-<?php print $node->nid; ?>" class="node<?php if ($sticky) { print ' sticky'; } ?><?php if (!$status) { print ' node-unpublished'; } ?>">


<?php if ($page == 0): ?>
  <h2><a href="<?php print $node_url ?>" title="<?php print $title ?>"><?php print $title ?></a></h2>
<?php endif; ?>


  <div class="content clear-block">
    <?php print $content ?>
  </div>

</div>
