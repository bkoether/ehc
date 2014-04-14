<?php
/**
 * Combines all remittance code.
 *
 * $_GET[type]
 * - combined:        Oil and Antifreeze Remittance   [BC]
 * - oil:             EHC Remittance                  [SK]
 * - oil_oem:         Oil & OEM EHC Remittance        [AB, MB]
 * - antifreeze_oem:  Antifreeze & OEM EHC Remittance [MB]
 *
 * - 3 or 20: EHC Remittance
 * - 8 or 21: Antifreeze Remittance
 * - 9: Oil and Antifreeze Remittance
 *
 */

// If the type is not set redirect to the account page.
if (!isset($_GET['type'])) {
  drupal_set_message(t('An error has occurred. (No type defined)'), 'error');
  drupal_goto('user');
}


$nid = arg(1);
$form_type = $_GET['type'];
profile_load_profile($user);

$provinces = array(
	'AB' => 'Alberta',
	'BC' => 'British Columbia',
	'MB' => 'Manitoba',
	'NB' => 'New Brunswick',
	'NL' => 'Newfoundland And Labrador',
	'NS' => 'Nova Sotia',
	'NT' => 'Northwest Territories',
	'NU' => 'Nunavt',
	'ON' => 'Ontario',
	'PE' => 'Prince Edward Island',
  'QC' => 'Quebec',
  'SK' => 'Saskatchewan',
  'YT' => 'Yukon',
);
?>

<script type="text/javascript" charset="utf-8">
  // Set the current user id.
  // NOTE: When major changes happen increment the currentVersion number in order to avoid
  // conflicts with what is in local storage.

  var formType = '<?php echo $form_type; ?>';

  var currentUser = <?php echo $user->uid; ?>;
  var currentVersion = '<?php echo $form_type; ?>_6';

  var currentRates;
  var oemLevel;

	var fieldsArray = [];
	// Fields for oil values standalone and combined form
	<?php if ($form_type == 'combined' || $form_type == 'oil' || $form_type == 'oil_oem'): ?>
    oemLevel = 1;

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
	<?php endif; ?>

	// Glycol combined form
	<?php if ($form_type == 'combined'): ?>
    oemLevel = 3;

    // Non-HDPE Containers
    fieldsArray.push( 'edit-submitted-non-hdpe-containers-hdpe-wrapper-946ml-0946-litre' );
    fieldsArray.push( 'edit-submitted-non-hdpe-containers-hdpe-wrapper-227l-227-litre' );

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

    fieldsArray.push( 'edit-submitted-def-containers-def-size-wrapper-378-def-378-l' );
    fieldsArray.push( 'edit-submitted-def-containers-def-size-wrapper-757-l-def-757-liter' );
    fieldsArray.push( 'edit-submitted-def-containers-def-size-wrapper-946-def-946-liter' );
	<?php endif; ?>

	// Glycol standalone
	<?php if ($form_type == 'antifreeze_oem'): ?>
    oemLevel = 2;

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
	<?php endif; ?>

	function setup_defaults() {
		// Remove warning message.
		$('.error-warning').remove();

    // Clear out form elements not needed
    switch (formType) {
      case "oil":
        $('#webform-component-glycol, ' +
          '#webform-component-glycol-containers, ' +
          '#field-toggle-glycol, #webform-component--another-antifreeze-size, ' +
          '#webform-component--another-antifreeze-size, ' +
          '#field-toggle-oem,' +
          '#webform-component-oem').remove();
        break;

      case "oil_oem":
        $('#webform-component-glycol, ' +
          '#webform-component-glycol-containers, ' +
          '#field-toggle-glycol, #webform-component--another-antifreeze-size, ' +
          '#webform-component--another-antifreeze-size,').remove();
        break;

      case "antifreeze_oem":
        $('#field-toggle-oil,' +
          '#webform-component-oils,' +
          '#webform-component-containers,' +
          '#webform-component--another-size,' +
          '#webform-component-non-hdpe-containers,' +
          '#webform-component--another-non-hdpe-size,' +
          '#webform-component-filters').remove();
        break;
    }

		var provinceSelector = $("#edit-submitted-province-select-province");
		var currentProvince;
		<?php if (isset($user->profile_province)): ?>
			<?php foreach ($provinces as $key => $value): ?>
				<?php if ($value == $user->profile_province): ?>
					currentProvince = "<?php print $key; ?>";
					$(provinceSelector).val(currentProvince);
				<?php endif; ?>
			<?php	endforeach; ?>
		<?php else : ?>
			currentProvince = $(provinceSelector).val();
		<?php endif; ?>

		// Get start and end date
		var start = $('input[type="image"]').eq(0).val();
		var end = $('input[type="image"]').eq(1).val();
    // the backup way
    if(start == "" || start == undefined){
      start = $('#edit-submitted-start-date-year').val() + "-" + $('#edit-submitted-start-date-month').val() + "-" + $('#edit-submitted-start-date-day').val();
    }
    if(end == "" || end == undefined){
      end = $('#edit-submitted-end-date-year').val() + "-" + $('#edit-submitted-end-date-month').val() + "-" + $('#edit-submitted-end-date-day').val();
    }


    // Load rates
		var url = location.protocol + '//' + location.host + Drupal.settings.basePath + 'json/resource-sheet/' + currentProvince + '/' + start + '/' + end + '/' + oemLevel;

    $.get(url, function(data) {
			currentRates = JSON.parse(data);
			if (currentRates.error) {
				$('#webform-component-end-date').nextAll().hide();
				$('#center h2:first').after('<div class="error-warning">A rate adjustment has occurred during the time period you defined. Please submit your values from <em>' + currentRates.start + '</em> to <em>' + currentRates.end + '</em> and then complete another submission for the remainder of the period.</div>');
			}
			else {
        // Add the results to the Drupal settings so that it can be accessed.
        Drupal.settings.currentRates = currentRates;

				// Show the form
				$('#webform-component-province').nextAll().show();

        // Attach custom sizes.
        Drupal.customSizes.attach();

				// Oil Values
				<?php if ($form_type == 'combined' || $form_type == 'oil' || $form_type == 'oil_oem'): ?>
					//oil
					$("#" + fieldsArray[0] + "-rate").val(currentRates.oil).niceRates();
					//filters
					$("#" + fieldsArray[1] + "-rate").val(currentRates.oil_filter_small).niceRates();
					$("#" + fieldsArray[2] + "-rate").val(currentRates.oil_filter_large).niceRates();
					$("#" + fieldsArray[3] + "-rate").val(currentRates.oil_filter_small).niceRates();
					var start = 4;
					var currentOilContainer = currentRates.oil_containers;
					while (12 >= start) {
						var value = currentOilContainer;
						if (start == 4) { value = value * 0.5; }
						if (start == 6) { value = value * 4; }
						if (start == 7) { value = value * 10; }
						if (start == 8) { value = value * 18.9271; }
						if (start == 9) { value = value * 20; }
						if (start == 10) { value = value * 0.946353; }
						if (start == 11) { value = value * 3.78541; }
						if (start == 12) { value = value * 5; }
						$("#" + fieldsArray[start] + "-rate").val(value).niceRates();
						start++;
					}

				<?php endif; ?>

				// Antifreeze combined form
				<?php if ($form_type == 'combined'): ?>
          // non-HDPE containers

          $("#" + fieldsArray[13] + "-rate").val(currentRates.non_hdpe_container * 0.946353).niceRates();
          $("#" + fieldsArray[14] + "-rate").val(currentRates.non_hdpe_container * 22.7).niceRates();
					//concentrate
					$("#" + fieldsArray[15] + "-rate").val(currentRates.glycol_concentrate).niceRates();
					//premix
					$("#" + fieldsArray[16] + "-rate").val(currentRates.glycol_premix).niceRates();
					//containers
					var start = 17;
					//containers
					while (24 >= start) {
						//get the glycol container rate from the provincial rates array
						var value = currentRates.glycol_containers;
						//multiply by the rate
						if (start == 17) { value = value * 1; }
						if (start == 18) { value = value * 1.5; }
						if (start == 19) { value = value * 1.89271; }
						if (start == 20) { value = value * 3.78541; }
						if (start == 21) { value = value * 4; }
						if (start == 22) { value = value * 5; }
						if (start == 23) { value = value * 9.46353; }
						if (start == 24) { value = value * 18.9271; }
						//push into form
						$("#" + fieldsArray[start] + "-rate").val(value).niceRates();
						start++;
					}
          $("#" + fieldsArray[25] + "-rate").val(currentRates.def_container * 3.78541).niceRates();
          $("#" + fieldsArray[26] + "-rate").val(currentRates.def_container * 7.571).niceRates();
          $("#" + fieldsArray[27] + "-rate").val(currentRates.def_container * 9.46353).niceRates();

        <?php endif; ?>

				// Antifreeze standalone values
				<?php if ($form_type == 'antifreeze_oem'): ?>
					//concentrate
					$("#" + fieldsArray[0] + "-rate").val(currentRates.glycol_concentrate).niceRates();
					//premix
					$("#" + fieldsArray[1] + "-rate").val(currentRates.glycol_premix).niceRates();
					//containers
					var start = 2;
					//var currentOilContainer = currentPArray[4];
					while (9 >= start) {
						var value = currentRates.glycol_containers;
						if (start == 2) { value = value * 1; }
						if (start == 3) { value = value * 1.5; }
						if (start == 4) { value = value * 1.89271; }
						if (start == 5) { value = value * 3.78541; }
						if (start == 6) { value = value * 4; }
						if (start == 7) { value = value * 5; }
						if (start == 8) { value = value * 9.46353; }
						if (start == 9) { value = value * 18.9271; }
						$("#" + fieldsArray[start] + "-rate").val(value).niceRates();
						start++;
					}
				<?php endif; ?>

				if (currentRates.hst != 0) {
					$("#edit-submitted-totals-tax-rate").val(currentRates.hst);
					$("#edit-submitted-totals-tax-wrapper").find('label').text('HST @ ' + (currentRates.hst*100) + '%');
				} else {
					<?php if ($user->profile_pst_applicable): ?>
						var tax = (currentRates.pst + currentRates.gst);
						var label = 'GST @ ' + Math.round(currentRates.gst * 100) + '% + PST @ ' + Math.round(currentRates.pst * 100) + '%';
					<?php else: ?>
						var tax = currentRates.gst;
						var label = 'GST @ ' + Math.round(currentRates.gst * 100) + '%';
					<?php endif; ?>
					$("#edit-submitted-totals-tax-rate").val(tax);
					$("#edit-submitted-totals-tax-wrapper").find('label').text(label);
				}

        // Add OEMs only for the combined form.
        <?php if ($form_type == 'combined' || $form_type == 'antifreeze_oem' || $form_type == 'oil_oem'): ?>
          // Check if there are values in the construction array. If not, hide the form elements.
          if (Object.keys(currentRates.oem.automotive).length > 0){ //typeof currentRates.oem.automotive[1].rate !== 'undefined'){ // &&  currentRates.oem.automotive[1].rate.length > 0) {
            // Create the fields if this is a new form
            oemFields.init($('body').hasClass('oem_processed'));
            oemFields.attachListener();
            collapseFields.oil('closed');
            <?php if ($form_type == 'antifreeze_oem') : ?>
              collapseFields.glycol('closed');
            <?php else: ?>
              collapseFields.glycol('closed');
            <?php endif; ?>
            collapseFields.oem('closed');
          }
          else {
            $('#webform-component-oem').hide();
          }
        <?php endif; ?>

        // Remove Non-HDPE fields if they are not set in the rate sheet
        if (currentRates.non_hdpe_container == 0 || formType != 'combined') {
          $('#webform-component-non-hdpe-containers, #webform-component--another-non-hdpe-size').remove();
        }

        // Remove DEF field if they are not set. Otherwise create the drop-down.
        if (currentRates.def_container == 0 || formType != 'combined') {
          $('#webform-component-def-containers, #webform-component--another-def-size').remove();
        }
        else {
          collapseFields.def('closed');
        }

      }
		}, "json");
	}

	function checkReady() {
		if (checkSheetDates()) {
			setup_defaults();
		}
	}

  // Functions for the OEM fields
  var oemFields = {

    init: function(skipHtml){
      for (var cat in currentRates.oem) {
        var currentCat = currentRates.oem[cat];
        var container = $('#webform-component-oem--oem-' + cat);
        for (var i in currentCat) {
          if (currentCat[i].rate.length > 0) {
            fieldsArray.push( 'rh-oem-field-' + cat + '-' + i );
            if (!skipHtml){
              $(container).append(Drupal.theme('oemLine', currentCat[i], cat, i));
            }
          }
        }
      }

      $('body').addClass('oem_processed');
      Drupal.behaviors.indexSet($('#webform-client-form-9'));
    },

    attachListener: function() {
      $('.rh-oem-fieldset .info').each(function(){
        $(this).simpletip({
          content: $(this).find('.tt').html(),
          fixed: true,
          position: 'bottom'
        });
      });

      $('.rh-oem-field').blur(function(){
        $(this).val( Math.round( $(this).cleannum().val() ) );
        oemFields.calcLine($(this));
//        $(this).digits();
      });
    },

    calcLine: function(field) {
      var targetName = $(field).attr('name') + '-remittance';
      var cat = $(field).attr('data-oem-cat');
      var catPos = $(field).attr('data-oem-cat-id');
      var newCount = $(field).val();
      var newSum = numberToFixed(newCount * currentRates.oem[cat][catPos].rate, 2);
      $('input[name="' + targetName + '"]').val(newSum).digits();
      do_totals();
      oemFields.catTotals(cat);
      saveFormState();
    },

    catTotals : function(oemCat) {
      var oemClass = '.rh-oem-fields-' + oemCat;
      var oilTotal = 0;
      var coolantTotal = 0;
      var smallFilterTotal = 0;
      var largeFilterTotal = 0;
      var remittanceTotal = 0;
      var lines = "";

      $(oemClass).each(function(){
        var lineId = $(this).attr('data-oem-cat-id');
        var line = currentRates.oem[oemCat][lineId]['title'] + '|';

        var lineCount = $(this).cleannum().val();
        var lineOil =  lineCount * currentRates.oem[oemCat][lineId]['oil'];
        var lineCoolant = lineCount * currentRates.oem[oemCat][lineId]['coolant'];
        var lineSmallFilter = lineCount * currentRates.oem[oemCat][lineId]['filter_s'];
        var lineLargeFilter = lineCount * currentRates.oem[oemCat][lineId]['filter_l'];
        var lineTotal = $('#rh-oem-field-' + oemCat + '-' + lineId + '-remittance').cleannum().val();
//        var lineTotal = parseFloat($('#rh-oem-field-' + oemCat + '-' + lineId + '-remittance').val());

        line = line + 'Qty:' + lineCount + '|Oil:' + lineOil + '|Coolant:' + lineCoolant + '|Small Filter:' + lineSmallFilter + '|Large Filter:' + lineLargeFilter + '|Total:' + lineTotal;
        lines = lines + line + "\n";

        oilTotal = oilTotal + lineOil;
        coolantTotal = coolantTotal + lineCoolant;
        smallFilterTotal = smallFilterTotal + lineSmallFilter;
        largeFilterTotal = largeFilterTotal + lineLargeFilter;
        remittanceTotal = parseFloat(remittanceTotal) + parseFloat(lineTotal);

        $(this).digits();
      });

      $('#edit-submitted-oem-oem-' + oemCat + '-oem-' + oemCat + '-oil').val(oilTotal);
      $('#edit-submitted-oem-oem-' + oemCat + '-oem-' + oemCat + '-coolant').val(coolantTotal);
      $('#edit-submitted-oem-oem-' + oemCat + '-oem-' + oemCat + '-filter-small').val(smallFilterTotal);
      $('#edit-submitted-oem-oem-' + oemCat + '-oem-' + oemCat + '-filter-large').val(largeFilterTotal);
      $('#edit-submitted-oem-oem-' + oemCat + '-oem-' + oemCat + '-total').val(remittanceTotal.toFixed(2)).digits();
//      $('#edit-submitted-oem-oem-' + oemCat + '-oem-' + oemCat + '-total').val(remittanceTotal).digits();
      $('#edit-submitted-oem-oem-' + oemCat + '-oem-' + oemCat + '-lines').val(lines);
    }
  }

  // Functions for the collapsible fieldsets.
  var collapseFields = {
    oil: function(currentClass){
      if(!$('#field-toggle-oil').length){
        $('#webform-component-oils').before('<h2 id="field-toggle-oil" class="field-toggle ' + currentClass + '">Oil<span>&ndash;</span></h2>');
      }

      var targets = $(
        '#webform-component-oils, ' +
        '#webform-component-containers, ' +
        '#webform-component--another-size, ' +
        '#webform-component-filters, ' +
        '#webform-component-non-hdpe-containers, ' +
        '#webform-component--another-non-hdpe-size'
      );
      var indicator = $('#field-toggle-oil span');

      if (currentClass != 'open') {
        collapseFields.showHide('close', targets, indicator);
        $('#field-toggle-oil').removeClass('open');
      }
      else {
        collapseFields.showHide('open', targets, indicator);
        $('#field-toggle-oil').addClass('open');
      }

      $('#field-toggle-oil').click(function(){
        if ($(this).hasClass('open')) {
          collapseFields.showHide('close', targets, indicator);
        }
        else {
          collapseFields.showHide('open', targets, indicator);
        }

        $(this).toggleClass('open')
      });
    },

    glycol: function(currentClass){
      if(!$('#field-toggle-glycol').length){
        if ($('#webform-component-glycol').length > 0) {
          $('#webform-component-glycol').before('<h2 id="field-toggle-glycol" class="field-toggle ' + currentClass + '">Antifreeze<span>&ndash;</span></h2>');
        }
        else {
          $('#webform-component-liquid').before('<h2 id="field-toggle-glycol" class="field-toggle ' + currentClass + '">Antifreeze<span>&ndash;</span></h2>');
        }

      }
      var indicator = $('#field-toggle-glycol span');
      var targets = $(
        '#webform-component-glycol, ' +
        '#webform-component-glycol-containers, ' +
        '#webform-component--another-antifreeze-size, ' +
        '#webform-component-liquid, ' +
        '#webform-client-form-21 #webform-component-containers, ' +
        '#webform-client-form-21 #webform-component--another-size'
      );
      if (currentClass != 'open') {
        collapseFields.showHide('close', targets, indicator);
        $('#field-toggle-glycol').removeClass('open');
      }

      $('#field-toggle-glycol').click(function(){
        if ($(this).hasClass('open')) {
          collapseFields.showHide('close', targets, indicator);
        }
        else {
          collapseFields.showHide('open', targets, indicator);
        }

        $(this).toggleClass('open');
      });

    },

    oem: function (currentClass){
      var targets = $('#webform-component-oem');
      if(!$('#field-toggle-oem').length){
        $(targets).before('<h2 id="field-toggle-oem" class="field-toggle ' + currentClass + '">OEM<span>&ndash;</span></h2>');
      }
      var indicator = $('#field-toggle-oem span');

      if (currentClass != 'open') {
        collapseFields.showHide('close', targets, indicator);
        $('#field-toggle-oem').removeClass('open');
      }

      $('#field-toggle-oem').click(function(){
        if ($(this).hasClass('open')) {
          collapseFields.showHide('close', targets, indicator);
        }
        else {
          collapseFields.showHide('open', targets, indicator);
        }

        $(this).toggleClass('open');
      });
    },

    def: function(currentClass) {
      if(!$('#field-toggle-def').length){
        $('#webform-component-def-containers').before('<h2 id="field-toggle-def" class="field-toggle ' + currentClass + '">Diesel Exhaust Fluid<span>&ndash;</span></h2>');
      }

      var targets = $(
        '#webform-component-def-containers, ' +
        '#webform-component--another-def-size'
      );
      var indicator = $('#field-toggle-def span');

      if (currentClass != 'open') {
        collapseFields.showHide('close', targets, indicator);
        $('#field-toggle-def').removeClass('open');
      }
      else {
        collapseFields.showHide('open', targets, indicator);
        $('#field-toggle-def').addClass('open');
      }

      $('#field-toggle-def').click(function(){
        if ($(this).hasClass('open')) {
          collapseFields.showHide('close', targets, indicator);
        }
        else {
          collapseFields.showHide('open', targets, indicator);
        }
        $(this).toggleClass('open')
      });
    },

    showHide: function(op, targets, indicator){
      if (op == 'open'){
        $(targets).slideDown();
        $(indicator).html('&ndash;');
      }
      else {
        $(targets).slideUp();
        $(indicator).html('+');
      }
    }
  }
</script>


<script type="text/javascript" charset="utf-8">
  Drupal.theme.prototype.oemLine = function(vals, cat, count) {
    var id = cat + '-' + count;
    var ret;
    ret = '<fieldset class="rh-oem-fieldset webform-component-fieldset">';
    ret += '<div class="form-item">';

    ret += '<label for="rh-oem-field-' + id + '">' + vals.title + '</label>';
//    ret += '<input readonly="readonly" class="readonly label" type="text" value="' + vals.title + '">';
    ret += '<span class="info">&nbsp;<span style="display: none;" class="tt">Oil: '+vals.oil+' Litres, Coolant: '+vals.coolant+' Litres, Small Filter: '+vals.filter_s+', Large Filter: '+vals.filter_l+'<br>'+vals.info+'</span></span>';
    ret += '<input value="" data-oem-cat="' + cat + '" data-oem-cat-id="' + count + '" class="rh-oem-field rh-oem-fields-' + cat + '" name="rh-oem-field-' + id + '" id="rh-oem-field-' + id + '">';
    ret += '<span class="field-suffix" style="width: 87px;">$'+vals.rate+'/ea</span>';
    ret += '<input value="0.00" readonly="readonly" type="text" name="rh-oem-field-' + id + '-remittance" id="rh-oem-field-' + id + '-remittance" class="readonly total-remittance">';
    ret += '</div>';
    ret += '</fieldset>';
    return ret;
  }

  Drupal.behaviors.changeListeners = function(context) {
    if (jQuery.datepicker) {
      jQuery.datepicker._defaults.onClose = function () {
        checkReady();
      };
      $('.webform-component-date select').change(function(){
        if($('#edit-submitted-start-date-year').val() != "" && $('#edit-submitted-start-date-month').val() != "" && $('#edit-submitted-start-date-day').val() != "" && $('#edit-submitted-end-date-year').val() != "" && $('#edit-submitted-end-date-month').val() != "" && $('#edit-submitted-end-date-day').val() != ""){
          checkReady();
        }
      });
    }

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

        saveFormState();
      });
    }

    //the tax applicable sales and admin fees
    $('#edit-submitted-totals-tax-applicable-sales, #edit-submitted-totals-interest-admin-fees').change(function(){
      var total = $(this).cleannum().val();

      do_totals();

      if (check_decimals(total, 2, 9999)) {
        total = roundNumber(total, 2);
      }
      total = numberToFixed(total, 2);

      $(this).val(total).digits();
    });
  }


  $(document).ready( function () {
  	// Hide the form until a date is set
		$('#webform-component-end-date').nextAll().hide();
    checkReady();
	});
</script>

