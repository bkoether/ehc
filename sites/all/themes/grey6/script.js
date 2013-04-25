Drupal.behaviors.readonly = function(context){

	$('input[readonly]').addClass('readonly').focus(function(){
		$(this).blur();
	});

}

Drupal.behaviors.noColons = function(context){
    $('form label[class!="option"]').each(
        function() {
       var myText = $(this);
       myText.text( myText.text().replace(':','') );
     }
   );
}

//set tab index for the page
Drupal.behaviors.indexSet = function(context){

	var tabindex = 1;
		$('.node input, .node select').each(function() {
			if ($(this).attr('type') != "hidden" && !$(this).attr('readonly')) {

				//console.log( $(this).attr('readonly') );
				$(this).attr("tabindex", tabindex);
				tabindex++;
			}
		});

}


//disable form submit
Drupal.behaviors.submitCheck = function(context){

	$('.node #edit-submit').click(function(){
		var n = $(".node input:checked, .node input:radio:checked").length;
		if(n == 3){
      var fid = $('form.webform-client-form').attr('id');
      localStorage.removeItem(fid + '_rs');
      localStorage.removeItem(fid + '_values');
      localStorage.removeItem(fid + '_html');

			return true;
		}else{
			return false;
		}
	});

	$(".node input:checkbox, .node input:radio").click(function(){
		checkCheckboxCheck();
	});

	checkCheckboxCheck();

}

Drupal.behaviors.addOne = function(context){
	if($("#edit-submitted-oils-oil-fieldset-total-litres-wrapper").length != 0){
		$("#edit-submitted-oils-oil-fieldset-total-litres-wrapper").find('label').html('Oil<sup>1</sup>');
	}

}

Drupal.behaviors.defLists = function(context){
	if($(".node dl dt").length != 0){
		$(".node dl dd").hide();

		$(".node dl dt").click(function(){
			$(this).next('dd').slideToggle();
		});

	}

}

/**
 *	Round filters and maybe every container?
 *
 */
Drupal.behaviors.filterWatch = function(context){
//	$("#edit-submitted-filters-filters-8-fieldset-less-than-8-inches, #edit-submitted-filters-filters--8-fieldset-greater-than-8-inches, #edit-submitted-filters-filters-sump-fieldset-sump-type").change(function(){
$('#webform-component-containers input, #webform-component-filters input, #webform-component-glycol-containers input').not('.readonly, .liter-size-input-input').change(function(){
		$(this).val( Math.round( $(this).cleannum().val() ) );
	});
}

/**
 * Setup listeners.
 */
//Drupal.behaviors.changeListeners = function(context) {
//  if (jQuery.datepicker) {
//    jQuery.datepicker._defaults.onClose = function () {
//      checkReady();
//    };
//  }
//
//  for (var field in fieldsArray) {
//    $("#" + fieldsArray[field]).change( function () {
//      var thisID = $(this).attr('id');
//
//      //clear out any non-numbers
//      $("#" + thisID).cleannum();
//      var total = $("#" + thisID).val() * $("#" + thisID + "-rate").val();
//      //add commas back
//      $("#" + thisID).digits();
//
//      if (check_decimals(total, 2, 9999)) {
//        total = roundNumber(total, 2);
//      }
//      total = numberToFixed(total, 2);
//      $("#" + thisID + "-remittance").val(total);
//
//      do_totals();
//      $("#" + thisID + "-remittance").digits();
//
//      saveFormState();
//    });
//  }
//
//  //the tax applicable sales and admin fees
//  $('#edit-submitted-totals-tax-applicable-sales, #edit-submitted-totals-interest-admin-fees').change(function(){
//    var total = $(this).cleannum().val();
//
//    do_totals();
//
//    if (check_decimals(total, 2, 9999)) {
//      total = roundNumber(total, 2);
//    }
//    total = numberToFixed(total, 2);
//
//    $(this).val(total).digits();
//  });
//}

/**
 * Check if there are values for an unsaved form.
 */
Drupal.behaviors.checkSavedForm = function(context) {
  if (!$('body').hasClass('saved-form-processed')) {
    $('body').addClass('saved-form-processed');
    var fid = $('form.webform-client-form').attr('id');
    var saved = localStorage.getItem(fid + '_values');
    if (saved != null) {
      getFormState();
    }
  }
}


/**
 * The other functions for the form
 **/

function checkCheckboxCheck() {
	var n = $(".node input:checked, .node input:radio:checked").length;
	if(n == 3){
		$('.node #edit-submit').removeAttr('disabled').removeClass('submit-disabled');
		return true;
	}else{
		$('.node #edit-submit').addClass('submit-disabled').attr('disabled','disabled').attr('alt','You must select the choices above before submitting this form');
	}
}

/**
 *	Updates the fields for the custom sized items
 * 	trying to make it work for oil and glycol
 */
function do_hidden_update(type) {

	//the parent container, assume oil if type is not set
	var parentCtr = $("#webform-component-containers");
	//the fields
	var customSizeField = $("#edit-submitted-custom-size");
	var containersField = $("#edit-submitted-custom-size-number-of-cans-bottles");
	var rateField = $("#edit-submitted-custom-size-rate");
	var totalField = $("#edit-submitted-custom-size-remittance");

	if(type == 'glycol'){
		//the parent container
		parentCtr = $("#webform-component-glycol-containers");
		//the fields
		customSizeField = $("#edit-submitted-custom-size-glycol");
		containersField = $("#edit-submitted-custom-size-number-of-cans-bottles-gly");
		rateField = $("#edit-submitted-custom-size-rate-glycol");
		totalField = $("#edit-submitted-custom-size-remittance-glycol");
	}

	var customField = $(".custom-size-fieldset").length;

	/* Cycle through all the 4 custom field entries and create a delimited string and then insert into hidden form values */
	var sizes = "";
	var entries = "";
	var rates = "";
	var remits = "";

	parentCtr.find(".liter-size-input").each( function () {
		sizes += $(this).val().replace(' Litre','') + ";";
		customSizeField.val(sizes);
	});
	parentCtr.find(".number-of-entries").each( function () {
		var val = (isNaN($(this).val()) ) ? 0 : $(this).val();
		entries += $(this).val() + ";";
		containersField.val(entries);
	});
	parentCtr.find(".each-rate").each( function () {
		rates += $(this).val() + ";";
		rateField.val(rates);
	});
	parentCtr.find(".total-remittance").each( function () {
		remits += $(this).val() + ";";
		totalField.val(remits);
	});

	do_totals();
}

//calculate totals
function do_totals() {

	//
	// calculate subtotal
	//
	var subTotal = 0;
	for (var field in fieldsArray) {
//    console.log(field);
		//take out commas
		$("#" + fieldsArray[field] + "-remittance").cleannum();

		//add to subtotal variable
		if ( ($("#" + fieldsArray[field] + "-remittance").val() != '' || typeof parseFloat($("#" + fieldsArray[field] + "-remittance").val()) !== 'undefined') && !isNaN($("#" + fieldsArray[field] + "-remittance").val()) ) {
			// try{console.log("decomma'd: "+ fieldsArray[field] + " - " + $("#" + fieldsArray[field] + "-remittance").val() + " " + isNaN($("#" + fieldsArray[field] + "-remittance").val()) );}catch(e){}
			subTotal = parseFloat(subTotal) + parseFloat($("#" + fieldsArray[field] + "-remittance").val());
			// console.log("parsed:" + parseFloat($("#" + fieldsArray[field] + "-remittance").val()) );
		}
		//put commas back
		$("#" + fieldsArray[field] + "-remittance").digits();
	}
	if (check_decimals(subTotal, 2, 9999)) {
		subTotal = roundNumber(subTotal, 2);
	}
	subTotal = numberToFixed(subTotal, 2);
	//put commas in
	$("#edit-submitted-totals-subtotal").val(subTotal).digits();


	//
	//	calculate tax
	//

	//check if override is allowed
	var override = ($('body.total-override').length > 0)? true : false;

	var taxCharged = 0;
	if(override){
		var apptax = ($('#edit-submitted-totals-tax-applicable-sales').cleannum().val() == "")? 0 : parseFloat($('#edit-submitted-totals-tax-applicable-sales').cleannum().val());
		taxCharged =  apptax * parseFloat($("#edit-submitted-totals-tax-rate").val());
	}else{
		taxCharged = subTotal * parseFloat($("#edit-submitted-totals-tax-rate").val());
	}
	if (check_decimals(taxCharged, 2, 9999)) {
		taxCharged = roundNumber(taxCharged, 2);
	}
	taxCharged = numberToFixed(taxCharged, 2);
	$("#edit-submitted-totals-tax").val(taxCharged).digits();

	var adminfees = ($('#edit-submitted-totals-interest-admin-fees').cleannum().val() == "")? 0 : parseFloat($('#edit-submitted-totals-interest-admin-fees').cleannum().val());

	var total = parseFloat(taxCharged) + parseFloat(subTotal) + adminfees;
	if (check_decimals(total, 2, 9999)) {
		total = roundNumber(total, 2);
	}
	total = numberToFixed(total, 2);
	$("#edit-submitted-totals-total").val('$'+total).digits();

	//fix the others
	$('#edit-submitted-totals-interest-admin-fees, #edit-submitted-totals-tax-applicable-sales').digits();

}

function add_field(type){
//	var customField = $(".custom-size-fieldset").size();
//	  customField++;
	if(!arguments){
		var type = 'oil';
	}

	var customField = getCustomField();

	var qt = "'";
	var html = '<div id="custom-div-new-' + customField + '" class="add-new-fieldset"><fieldset class="webform-component-fieldset-custom-set"><input type="text" name="liter-size-' + customField + '" id="custom-field-' + customField + '-size" class="liter-size-input-input" /><span class="add-new-item-desc">Add numerical values in litres only (i.e. "15", "0.5").</span><input onclick="add_field_run(' + customField + ', ' + qt + type + qt + ');" type="button" value="add" class="add-new-item-button"/></fieldset></div>';

	if(type == 'glycol'){
		$("#webform-component-glycol-containers").append(html);
	}else{
		$("#webform-component-containers").append(html);
	}
	// $("#webform-component-containers---another-size").before(html);
	$("#custom-field-" + customField + "-size").focus();
	Drupal.attachBehaviors($(".node"));


	return false;
}

function add_field_run(customField, type) {

	if(!type){
		var type = 'oil';
	}

    $('#custom-field-' + customField + '-size').cleannum();
    var user_input = $('#custom-field-' + customField + '-size').attr('value');
    if (user_input > 0) {
        $('#custom-div-new-' + customField).remove();
        add_field_item(user_input, type);
    } else {
			return false;
    }
}

function blur(customField){
var quant = $('#custom-field-' + customField + '-entries').cleannum().val();
//console.log('quantity: ' + quant);
var rate = $('#custom-field-' + customField + '-rate').val();
var total = quant * rate;
$('#custom-field-' + customField + '-remittance').val(total).digits();

$('#custom-field-' + customField + '-entries').digits();

}

function add_field_item(user_input, type) {
	// var customField = $(".custom-size-fieldset").size();
	// console.log(customField);
	// customField++;
	if(!type){
		var type = 'oil';
	}

	var customField = getCustomField();


	//try{console.log(customField);}catch(e){}

    // var currentProvince = $("#edit-submitted-province-select-province").val();
    // var currentPArray = pRates[currentProvince];
	// oil is default
  	var computed_input = user_input * Drupal.settings.currentRates.oil_containers;
	//glycol
	if(type == 'glycol'){
		computed_input = user_input * Drupal.settings.currentRates.glycol_containers;
	}



	var qt = "'";

	var html = '<fieldset id="custom-div-' + customField + '" class="custom-size-fieldset webform-component-fieldset"><a href="#" onclick="return !remove_field(' + customField + ', ' + qt + type + qt + ')" class="customDel" title="click to remove the ' + user_input + ' Liter size">x</a><input readonly="readonly" type="text" value="' + user_input +' Litre" name="liter-size-' + customField + '" id="custom-field-' + customField + '-size" class="liter-size-input" /><input onblur="blur(' + qt + customField + qt + ')" type="text" value="" name="custom-field-' + customField + '-entries" id="custom-field-' + customField + '-entries" class="number-of-entries" /><input value="' + computed_input +'" readonly="readonly" type="text" readonly name="each-' + customField + '-rate" id="custom-field-' + customField + '-rate" class="each-rate" /><div style="display:inline;margin:1px 5px 2px 0"><span class="field-suffix">/ea</span></div><input value="0.00" readonly="readonly" type="text" readonly name="total-' + customField + '-remittance" id="custom-field-' + customField + '-remittance" class="total-remittance" /></fieldset>';

	if(type == 'glycol'){
		$("#webform-component-glycol-containers").append(html);
	}else{
		$("#webform-component-containers").append(html);
	}


	//nice rates
	$('#custom-field-' + customField + '-rate').niceRates();
	//reset tab index
	Drupal.attachBehaviors($(".node"));

	fieldsArray.push( 'custom-field-' + customField );

	//run this to populate the custom size hidden fields
	//do_hidden_update(type);

	/* Now implement the new inputs */
	$("#custom-field-" + customField + "-size").change( function () {
		var size = parseFloat($(this).val());
		if (size > 0) {
//			var currentProvince = $("#edit-submitted-province-select-province").val();
//			var currentPArray = pRates[currentProvince];
			var ratePer = Drupal.settings.currentRates.oil_containers * size;
			if(type == 'glycol'){
				ratePer = currentPArray[10] * Drupal.settings.currentRates.glycol_containers;
			}
			$("#custom-field-" + customField + "-rate").val(ratePer).niceRates();
		}
	});

	$("#custom-field-" + customField + "-entries").change( function () {
		$(this).cleannum();
		var num = parseFloat($(this).attr('value'));
		var rate = parseFloat($("#custom-field-" + customField + "-rate").attr('value'));
		var total = num * rate;

		//add commas
		$(this).digits();


		if (check_decimals(total, 2, 9999)) {
			total = roundNumber(total, 2);
		}

		total = numberToFixed(total, 2);

		$("#custom-field-" + customField + "-remittance").val(total);

		do_hidden_update(type);
    saveFormState();
	});



	return false;
}

/**
 *	figures out what the next number of the custom fields would be
 * new theory is that the oil and glycol ones can mix together,
 * serious code reduction here...
 */
function getCustomField(type){

	//return $(".custom-size-fieldset").length;

	// 	var parentCtr = "#webform-component-containers";
	// if(type == 'glycol'){
	// 	parentCtr = "#webform-component-glycol-containers";
	// }

	var customField = 0;
	if( $(".custom-size-fieldset").size() >  0 ){
		 var last = $(".custom-size-fieldset").size();
		//var last = $(".custom-size-fieldset:last").attr('id').replace('custom-div-','');
		last++;
		customField = last;
	}
	return customField;
}

/**
 * remove the custom size
 *
 */
function remove_field(num, type) {

	if(!type){
		var type = 'oil';
	}

	//remove the items from the array
	for (var field in fieldsArray) {
		if (fieldsArray[field] == "custom-field-" + num) {
			fieldsArray.splice(field, 1);
		}
	}
	//remove the custom fields
	$("#custom-div-" + num).remove();
	//reset tab index
	Drupal.attachBehaviors($('.node'));
   //update
	do_hidden_update(type);

	return true;
}

function check_decimals(value,min,max) {
  //Accepts number with decimal but it must have at least the min and at most the max places after the decimal
  var re = new RegExp("^-?\\d+\\.\\d{" + min + "," + max + "}?$");
  return re.test(value);
}

function roundNumber(num, dec) {
	//var result = Math.round(num*Math.pow(10,dec))/Math.pow(10,dec);
	result = Math.round(num*100)/100;
	return result;
}

function makeWholeNum(val){
	//console.log(val + " becomes " + Math.round(Number(val)));
	return Math.round(Number(val));
}

var numberToFixed =
(function() {
  return toFixedString;

  function toFixedString(n, digits) {
    var unsigned = toUnsignedString(Math.abs(n), digits);
    return (n < 0 ? "-" : "") + unsigned;
  }

  function toUnsignedString(m, digits) {
    var t, s = Math.round(m * Math.pow(10, digits)) + "",
        start, end;
    if (/\D/.test(s)) {
      return "" + m;
    }
    s = padLeft(s, 1 + digits, "0");
    start = s.substring(0, t = (s.length - digits));
    end = s.substring(t);
    if(end) {
      end = "." + end;
    }
    return start + end; // avoid "0."
  }
  /**
   * @param {string} input: input value converted to string.
   * @param {number} size: desired length of output.
   * @param {string} ch: single character to prefix to s.
   */
  function padLeft(input, size, ch) {
    var s = input + "";
    while(s.length < size) {
      s = ch + s;
    }
    return s;
  }
})();


function checkSheetDates() {
    var check = false;
    // Check the start date
    $('select[name*="start_date"]').each(function(){
        if ($(this).val()) {
            check = true;
        }
        else {
            check = false;
        }
    });
    if (check) {
        $('select[name*="end_date"]').each(function(){
            if ($(this).val()) {
                check = true;
            }
            else {
                check = false;
            }
        });
    }
    return check;
}


function saveFormState() {

  var form = $('form.webform-client-form');
  var fid = $(form).attr('id');
  // First get the form values
  sel = {};
  $('[name^="custom-field"], [name^="submitted"], .custom-size-fieldset input[name^="total"]').each(function(){
    sel[this.id] = $(this).val();
  });

  localStorage.setItem(fid + '_values', JSON.stringify(sel));

  // Save the rate sheet
  localStorage.setItem(fid + '_rs', JSON.stringify(currentRates));

  // Save the html
  var htm = $(form).html();
  localStorage.setItem(fid + '_html', JSON.stringify(htm));
}

function getFormState() {
  var form = $('form.webform-client-form');
  var fid = $(form).attr('id');

  // Load the rate sheet back in
  currentRates = JSON.parse(localStorage.getItem(fid + '_rs'));
  // Load the HTML back in
  var htm = JSON.parse(localStorage.getItem(fid + '_html'));
  $(form).html(htm);

  // Load the values back in
  var formValues = JSON.parse(localStorage.getItem(fid + '_values'));
  // console.log(formValues);
  for (var field in formValues) {
//    console.log(formValues[field]);
    $('#' + field).val(formValues[field]);
  }
  // We need to make sure the custom size feature is not triggered twice
  $('body').addClass('cs_processed');
  Drupal.attachBehaviors();
}
/**
 * So Console.log doesn't screw up IE anymore
 **/
// usage: log('inside coolFunc', this, arguments);
// paulirish.com/2009/log-a-lightweight-wrapper-for-consolelog/
// window.log = function(){
//   log.history = log.history || [];   // store logs to an array for reference
//   log.history.push(arguments);
//   if(this.console) {
//     arguments.callee = arguments.callee.caller;
//     var newarr = [].slice.call(arguments);
//     (typeof console.log === 'object' ? log.apply.call(console.log, console, newarr) : console.log.apply(console, newarr));
//   }
// };

// // make it safe to use console.log always
// (function(b){function c(){}for(var d="assert,count,debug,dir,dirxml,error,exception,group,groupCollapsed,groupEnd,info,log,timeStamp,profile,profileEnd,time,timeEnd,trace,warn".split(","),a;a=d.pop();){b[a]=b[a]||c}})((function(){try
// {console.log();return window.console;}catch(err){return window.console={};}})());


//a simpler way

/**
 * So Console.log doesn't screw up IE anymore
 **/

if (typeof console == "undefined") {
    window.console = {
        log: function () {}
    };
}