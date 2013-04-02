<?php
/**
 *	the EHC Remittance Form
 **/

//this is not needed because it's in the Drupal.settings js now
//if($previous_sizes){print $previous_sizes;}

profile_load_profile($user);
?>

<script type="text/javascript" charset="utf-8">
	
var pRates = new Array();
<?php

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
//oil liquid
fieldsArray.push( 'edit-submitted-oils-oil-fieldset-total-litres' );
//filters
fieldsArray.push( 'edit-submitted-filters-filters-8-fieldset-less-than-8-inches' );
fieldsArray.push( 'edit-submitted-filters-filters--8-fieldset-greater-than-8-inches' );
fieldsArray.push( 'edit-submitted-filters-filters-sump-fieldset-sump-type' );
//oil containers
fieldsArray.push( 'edit-submitted-containers-size-wrapper-500-ml' );
fieldsArray.push( 'edit-submitted-containers-size-wrapper-2-1-liter' );
fieldsArray.push( 'edit-submitted-containers-size-wrapper-3-4-liter' );
fieldsArray.push( 'edit-submitted-containers-size-wrapper-4-10-liter' );
fieldsArray.push( 'edit-submitted-containers-size-wrapper-5-18-942-liter' );
fieldsArray.push( 'edit-submitted-containers-size-wrapper-6-20-liter' );
fieldsArray.push( 'edit-submitted-containers-size-wrapper-0947-l-0947-liter' );
fieldsArray.push( 'edit-submitted-containers-size-wrapper-3788-l-3788-liter' );
fieldsArray.push( 'edit-submitted-containers-size-wrapper-5-l-5-liter' );
//glycol liquid
fieldsArray.push( 'edit-submitted-glycol-concentrate-fieldset-concentrate-total-litres' );
fieldsArray.push( 'edit-submitted-glycol-premix-fieldset-premix-total-litres' );
//glycol containers
fieldsArray.push( 'edit-submitted-glycol-containers-antifreeze-wrapper-1000-ml-1000-ml' );
fieldsArray.push( 'edit-submitted-glycol-containers-antifreeze-wrapper-1500-ml-1500-ml' );
fieldsArray.push( 'edit-submitted-glycol-containers-antifreeze-wrapper-1890-ml-1890-ml' );
fieldsArray.push( 'edit-submitted-glycol-containers-antifreeze-wrapper-3780-ml-3780-ml' );
fieldsArray.push( 'edit-submitted-glycol-containers-antifreeze-wrapper-4000-ml-4000-ml' );
fieldsArray.push( 'edit-submitted-glycol-containers-antifreeze-wrapper-5000-ml-5000-ml' );
fieldsArray.push( 'edit-submitted-glycol-containers-antifreeze-wrapper-9460ml-9460-ml' );
fieldsArray.push( 'edit-submitted-glycol-containers-antifreeze-wrapper-18900-ml-18900-ml' );




function setup_defaults() {
	<?php if (isset($user->profile_province)) : ?>
	<?php foreach ($provinces as $key => $value) { if ($value == $user->profile_province) { ?>
	var currentProvince = "<?php print $key; ?>";
	$("#edit-submitted-province-select-province").val("<?php print $key; ?>");
	<?php } } ?>
	<?php else : ?>
	var currentProvince = $("#edit-submitted-province-select-province").val();
	<?php endif; ?>
	//set current array to the province above
  var currentPArray = pRates[currentProvince];
  //load rates
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
	//concentrate
	$("#" + fieldsArray[13] + "-rate").val(currentPArray[8]).niceRates();
	//premix
	$("#" + fieldsArray[14] + "-rate").val(currentPArray[9]).niceRates();
  //containers
	var start = 15;
	//containers
	while (22 >= start) {
		//get the glycol container rate from the provincial rates array
		var value = currentPArray[10];
		//multiply by the rate
		if (start == 15) { value = value * 1; }
		if (start == 16) { value = value * 1.5; }
		if (start == 17) { value = value * 1.89; }
		if (start == 18) { value = value * 3.78; }
		if (start == 19) { value = value * 4; }
		if (start == 20) { value = value * 5; }
		if (start == 21) { value = value * 9.46; }
		if (start == 22) { value = value * 18.9; }
		//push into form
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