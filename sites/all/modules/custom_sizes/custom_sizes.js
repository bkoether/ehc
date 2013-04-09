/**
 *	Loads the last custom sizes you had on your EHC Form
 *	@TODO: it's using functions that are in the template scripts.js file
 *  I can't do this in drupal behaviours, so i'm using document ready so it only runs once
 **/

Drupal.customSizes = {
  attach: function(){
    if (!$('body').hasClass('cs_processed')) {

      // if you are on a oil page
      if($("#webform-component-containers").length > 0){
        //get the custom oil sizes
        var osizes = Drupal.settings.custom_sizes.prev_sizes;
        //explode on the ;'s
        if(osizes){
          var sizeArr = osizes.split(';');
          var sizeLen = sizeArr.length;
          for(var i=0; i<sizeLen; i++){
            //add each custom size
            //console.log(sizeArr[i], 'oil');
            add_field_item(sizeArr[i], 'oil');
          }
        }
      }

      //if you are on a glycol form
      if($("#webform-component-glycol-containers").length > 0){
        //get the custom glycol sizes
        var gsizes = Drupal.settings.custom_sizes.prev_sizes_glycol;
        //explode on the ;'s
        if(gsizes){
          var sizeArr = gsizes.split(';');
          var sizeLen = sizeArr.length;
          for(var i=0; i<sizeLen; i++){
            //add each custom size
            //console.log(sizeArr[i], 'glycol');
            add_field_item(sizeArr[i], 'glycol');
          }
        }
      }
      $('body').addClass('cs_processed');
    }
  }
};


// commented this out and just have it running as an onclick attribute

// Drupal.behaviors.custom_sizes_removeCustomSizes = function(context){
// 	$('a.customDel').click(function(){
// 		var id = $(this).parent().attr('id');
// 		//strip the non numbers
// 		id = id.replace('custom-div-','');
//
// 		return !remove_field(id);
//
// 	});
// }
