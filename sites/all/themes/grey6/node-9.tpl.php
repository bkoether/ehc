<?php
/**
 *	the EHC Remittance Form
 **/

include('remittance_header.php');

?>


<div id="node-<?php print $node->nid; ?>" class="node<?php if ($sticky) { print ' sticky'; } ?><?php if (!$status) { print ' node-unpublished'; } ?>">

  <div class="content clear-block">
    <?php print $content ?>
  </div>

</div>
