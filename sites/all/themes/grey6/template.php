<?php

/**
* Override or insert variables into the node templates.
*
* @param $vars
*   An array of variables to pass to the theme template.
* @param $hook
*   The name of the template being rendered ("node" in this case.)
*/
function grey6_preprocess_node(&$vars, $hook) {
  $node = $vars['node'];
  $vars['template_file'] = 'node-'. $node->nid;
}

//	watchdog('debug',$variable);


/**
 * Theme the headers when sending an email from webform.
 *
 * @param $node
 *   The complete node object for the webform.
 * @param $submission
 *   The webform submission of the user.
 * @param $email
 *   If you desire to make different e-mail headers depending on the recipient,
 *   you can check the $email['email'] property to output different content.
 *   This will be the ID of the component that is a conditional e-mail
 *   recipient. For the normal e-mails, it will have the value of 'default'.
 * @return
 *   An array of headers to be used when sending a webform email. If headers
 *   for "From", "To", or "Subject" are set, they will take precedence over
 *   the values set in the webform configuration.
 */
function grey6_webform_mail_headers($node, $submission, $email) {

	//drupal_set_message(print_r($submission));

	switch($submission->data[79]['value'][0]){
		case 'AB':
			$admin_email = 'AUOMAremittance@usedoilrecycling.ca'; //andrew+AB@mellenger.com
		break;
		case 'BC':
			$admin_email = 'BCUOMAremittance@usedoilrecycling.ca'; //bhewko@usedoilrecycling.ca
		break;
		case 'SK':
			// mat leave $admin_email = 'lglubis@kpmg.ca';
			$admin_email = 'krwhite@kpmg.ca';
		break;
		case 'MB':
			$admin_email = 'lweseen@kpmg.ca'; //
		break;
		default:
			$admin_email = 'andrew.mellenger@greyvancouver.com';
		break;
	}
	//let me test in peace
	if($submission->name == 'admin'){
    	//$admin_email = 'andrew@mellenger.com';
//		$admin_email = 'marty@michetti.com';
    $admin_email = 'ben.koether@gmail.com';
	}


  $headers = array(
    'X-Mailer' => 'EHC Remittance Form (PHP/' . phpversion() . ')',
		'BCC' => $admin_email,
		'Reply-To' => 'do-not-reply@ehcform.com',
		'Return-Path' => 'do-not-reply@ehcform.com'
  );
  return $headers;
}



function cleannum($str){
	return ereg_replace( '[^0-9\.-]+', '', $str );
}




