<?php
// $Id: webform-submission-information.tpl.php,v 1.1 2010/01/14 06:12:47 quicksketch Exp $

/**
 * @file
 * Customize the header information shown when editing or viewing submissions.
 *
 * Available variables:
 * - $node: The node object for this webform.
 * - $submission: The contents of the webform submission.
 * - $account: The user that submitted the form.
 */
?>
<div class="submission-info">
  <div>
    <?php if ($node->nid == 24) {
      switch ($submission->data[255]['value'][0]) {
        case 'oil':
          $title = t('EHC Remittance');
          $q = array('type' => 'oil');
          break;

        case 'oil_oem':
          $title = t('Oil & OEM EHC Remittance');
          $q = array('type' => 'oil_oem');
          break;

        case 'antifreeze_oem':
          $title = t('Antifreeze & OEM EHC Remittance');
          $q = array('type' => 'antifreeze_oem');
          break;

        default:
          $title = t('Oil and Antifreeze Remittance');
          $q = array('type' => 'combined');
          break;
      }
      print t('Form: !form', array('!form' => l($title, 'node/' . $node->nid, array('query' => $q))));
    }
    else {
      print t('Form: !form', array('!form' => l($node->title, 'node/' . $node->nid)));
    } ?>
  </div>
  <div><?php print t('Submitted by !name', array('!name' => theme('username', $account))); ?></div>
  <div><?php print format_date($submission->submitted, 'large'); ?></div>
  <div><?php print $submission->remote_addr; ?></div>
</div>
