<?php

 global $user;
 profile_load_profile($user);
 
switch($user -> profile_province){
	case('British Columbia'):
		$prov = 'BC';
		$remitto = 	"<strong>British Columbia Used Oil Management Association</strong><br>Administration Office<br>Suite 1008, 10080 Jasper Ave. NW<br>Edmonton, AB T5J 1V9";
		$taxreg = 	"HST (#89254 4701 RT)";
		$assphone = "1 (866) 254-0555";		
	break;
	case('Alberta'):
		$prov = 'AB';
		$remitto = 	"<strong>Alberta Used Oil Management Association</strong><br>Administration Office<br>Suite 1008, 10080 Jasper Ave. NW<br>Edmonton, AB T5J 1V9";
		$taxreg = 	"GST (#140327479RT)";
		$assphone = "1 (866) 414-1510";		
	break;
  case('Manitoba'):
  	$prov = 'MN';
		$remitto = 	"<strong>KPMG</strong><br>Attention: Linda Weseen<br>Suite 2000, One Lombard Place<br>Winnipeg, MB R3B 0X3";
		$taxreg = 	"GST (#88264 5989 RT)";	
		$assphone = "1 (204) 957-2273";
  break;
  case('Saskatchewan'):
  	$prov = 'SK';
		$remitto = 	"<strong>KPMG</strong><br>500 – 475 Second Avenue South<br>Saskatoon, SK S7K 1P4";
		$taxreg = 	"GST (#89176 3542 RT)";
		$assphone = "ph: 1 (306) 934-6200";
		$faxphone = "fx: 1 (306) 934-6233";
  break;	
	default:
	$prov = 'UOMA';
	break;
}


//drupal_set_message(print_r($user));
if($user->profile_override_total == "1"){
	$body_classes .= " total-override";
} 


 ?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
		<title><?php print $head_title ?></title>
    <?php print $head ?>
    <?php print $styles ?>
    <!--[if lt IE 8]>
			<script type="text/javascript" src="<?php print base_path() . path_to_theme(); ?>/json2.js"></script>
		<![endif]-->
    <?php print $scripts ?>
  </head>
  <body class="<?php print $body_classes?>">

<div id="ctr">

	<div id="header">
		<div id="shadow"><div class="header-img"><div id="<?php print $prov;?>" class="location"></div></div></div>
	</div>
	
	<div id="center-content">
		<div id="column_left">
			<?php if ($left): print $left; endif; ?>
		</div>	
		<div id="center">
	    <?php if ($tabs): print $tabs; endif; ?>
	    <?php if ($tabs2): print $tabs2; endif; ?>
		
			<?php if ($node->type == "webform"){
				print '<div id="user-profile-webform"><span class="user_name">'.$user->profile_company_name.'</span>';
	      print '<span class="user_uid">'.$user->name.'</span></div>';
			} ?>
		
			<?php if ($title): print '<h2>'. $title .'</h2>'; endif; ?>
	    <?php if ($show_messages && $messages): print $messages; endif; ?>
	    <?php print $help; ?>
	    <?php print $content ?>
	
	
		<?php if($remitto && arg(1) != 7):?>
			<p style="margin:12px 12px 0 12px;border-top:1px solid #fff">Questions or concerns? Please contact:</p>
		<address style="margin:3px 24px"><?php print $remitto."<br>".$assphone."<br>".$faxphone;?></address>
		<?php endif; ?>
		</div>
	</div>
	<div id="footer">&nbsp;<?php print $footer_message . $footer ?></div>
	
</div>

  <?php print $closure;
	//print_r($user);
 ?>
  </body>
</html>
