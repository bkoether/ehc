

<?php
// $Id: user-profile.tpl.php,v 1.2.2.2 2009/10/06 11:50:06 goba Exp $

/**
 * @file user-profile.tpl.php
 * Default theme implementation to present all user profile data.
 *
 * This template is used when viewing a registered member's profile page,
 * e.g., example.com/user/123. 123 being the users ID.
 *
 * By default, all user profile data is printed out with the $user_profile
 * variable. If there is a need to break it up you can use $profile instead.
 * It is keyed to the name of each category or other data attached to the
 * account. If it is a category it will contain all the profile items. By
 * default $profile['summary'] is provided which contains data on the user's
 * history. Other data can be included by modules. $profile['user_picture'] is
 * available by default showing the account picture.
 *
 * Also keep in mind that profile items and their categories can be defined by
 * site administrators. They are also available within $profile. For example,
 * if a site is configured with a category of "contact" with
 * fields for of addresses, phone numbers and other related info, then doing a
 * straight print of $profile['contact'] will output everything in the
 * category. This is useful for altering source order and adding custom
 * markup for the group.
 *
 * To check for all available data within $profile, use the code below.
 * @code
 *   print '<pre>'. check_plain(print_r($profile, 1)) .'</pre>';
 * @endcode
 *
 * Available variables:
 *   - $user_profile: All user profile data. Ready for print.
 *   - $profile: Keyed array of profile categories and their items or other data
 *     provided by modules.
 *
 * @see user-profile-category.tpl.php
 *   Where the html is handled for the group.
 * @see user-profile-item.tpl.php
 *   Where the html is handled for each item in the group.
 * @see template_preprocess_user_profile()
 */

global $base_url;
//$remitURL = $base_url . '/ehc-remittance';

profile_load_profile($user);
?>

<div class="profile">
  <?php print $profile['Company Information']; ?>
 
</div>

<?php

	$cachebreak = "&nocache=" . time();
	//$cachebreak	= "";
	//	http://ehcform.com/environmental-handling-charge-ehc-form?type=combined

switch($user->profile_province){
	
	case 'British Columbia':
		$thebutton = '<button onclick="location.href=\'/environmental-handling-charge-ehc-form?type=combined' . $cachebreak . '\'">Begin an Oil, Antifreeze and OEM EHC Remittance</button>';
		break;
	case 'Alberta':
		$thebutton = '<button onclick="location.href=\'/environmental-handling-charge-ehc-form?type=oil_oem' . $cachebreak . '\'">Begin an Oil and OEM EHC Remittance</button>';
		break;
	case 'Saskatchewan':
	default:
		$thebutton  = '<strong>Use the new combined form for EHC Remittance</strong><br>';
		$thebutton .= '<button onclick="location.href=\'/environmental-handling-charge-ehc-form?type=combined' . $cachebreak . '\'">Begin an EHC Remittance</button>';
		break;
	case 'Manitoba':
		$thebutton  = '<button onclick="location.href=\'/environmental-handling-charge-ehc-form?type=oil_oem' . $cachebreak . '\'">Begin an Oil and OEM EHC Remittance</button></p><p style="margin:12px;">';
		$thebutton .= '<button onclick="location.href=\'/environmental-handling-charge-ehc-form?type=antifreeze_oem' . $cachebreak . '\'">Begin an Antifreeze and OEM EHC Remittance</button>';
		break;
	
}

?>

<p style="margin:12px"><?php print $thebutton;?></p>

<!--
<?php
  //print_r($user);
?>
-->