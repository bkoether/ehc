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
fieldsArray.push( 'edit-submitted-liquid-concentrate-fieldset-concentrate-total-litres' );
fieldsArray.push( 'edit-submitted-liquid-premix-fieldset-premix-total-litres' );

fieldsArray.push( 'edit-submitted-containers-size-wrapper-150-ml-150-ml' );
fieldsArray.push( 'edit-submitted-containers-size-wrapper-1000-ml-1-litre' );
fieldsArray.push( 'edit-submitted-containers-size-wrapper-1500-ml-1500-ml' );
fieldsArray.push( 'edit-submitted-containers-size-wrapper-1890-ml-189-litre' );
fieldsArray.push( 'edit-submitted-containers-size-wrapper-2000-ml-2-litre' );
fieldsArray.push( 'edit-submitted-containers-size-wrapper-3788-ml-3788-litre' );
fieldsArray.push( 'edit-submitted-containers-size-wrapper-4000-ml-4-litre' );
fieldsArray.push( 'edit-submitted-containers-size-wrapper-5-l-5-litre' );
fieldsArray.push( 'edit-submitted-containers-size-wrapper-7560-ml-756-litre' );
fieldsArray.push( 'edit-submitted-containers-size-wrapper-9460-ml-946-litre' );
fieldsArray.push( 'edit-submitted-containers-size-wrapper-10000-ml-10-litre' );
fieldsArray.push( 'edit-submitted-containers-size-wrapper-15000-ml-15-litre' );
fieldsArray.push( 'edit-submitted-containers-size-wrapper-18900-ml-18-942-litre' );
fieldsArray.push( 'edit-submitted-containers-size-wrapper-20000-ml-20-litre' );



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
	//concentrate
	$("#" + fieldsArray[0] + "-rate").val(currentPArray[8]).niceRates();
	//premix
	$("#" + fieldsArray[1] + "-rate").val(currentPArray[9]).niceRates();
  //containers
	var start = 2;
	//var currentOilContainer = currentPArray[4];
	while (15 >= start) {
		var value = currentPArray[10];
		if (start == 2) { value = value * 0.15; }
		if (start == 3) { value = value * 1; }
		if (start == 4) { value = value * 1.5; }
		if (start == 5) { value = value * 1.89; }
		if (start == 6) { value = value * 2; }
		if (start == 7) { value = value * 3.788; }
		if (start == 8) { value = value * 4; }
		if (start == 9) { value = value * 5; }
		if (start == 10) { value = value * 7.56; }
		if (start == 11) { value = value * 9.46; }
		if (start == 12) { value = value * 10; }
		if (start == 13) { value = value * 15; }
		if (start == 14) { value = value * 18.942; }
		if (start == 15) { value = value * 20; }
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