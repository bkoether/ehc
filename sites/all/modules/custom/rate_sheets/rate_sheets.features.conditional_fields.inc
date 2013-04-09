<?php

/**
 * Implementation of hook_conditional_fields_default_fields().
 */
function rate_sheets_conditional_fields_default_fields() {
$items = array();
$items[] = array (
  'control_field_name' => 'field_hst_selector',
  'field_name' => 'field_gst',
  'type' => 'rate_sheet',
  'trigger_values' => 
  array (
    0 => '0',
  ),
);
$items[] = array (
  'control_field_name' => 'field_hst_selector',
  'field_name' => 'field_hst',
  'type' => 'rate_sheet',
  'trigger_values' => 
  array (
    1 => '1',
  ),
);
$items[] = array (
  'control_field_name' => 'field_hst_selector',
  'field_name' => 'field_pst',
  'type' => 'rate_sheet',
  'trigger_values' => 
  array (
    0 => '0',
  ),
);
return $items;
}
