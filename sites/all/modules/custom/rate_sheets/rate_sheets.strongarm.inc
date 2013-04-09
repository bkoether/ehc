<?php

/**
 * Implementation of hook_strongarm().
 */
function rate_sheets_strongarm() {
  $export = array();

  $strongarm = new stdClass;
  $strongarm->disabled = FALSE; /* Edit this to true to make a default strongarm disabled initially */
  $strongarm->api_version = 1;
  $strongarm->name = 'ant_pattern_rate_sheet';
  $strongarm->value = 'RS - [field_province-raw] [field_start_date-date]';
  $export['ant_pattern_rate_sheet'] = $strongarm;

  $strongarm = new stdClass;
  $strongarm->disabled = FALSE; /* Edit this to true to make a default strongarm disabled initially */
  $strongarm->api_version = 1;
  $strongarm->name = 'ant_php_rate_sheet';
  $strongarm->value = 0;
  $export['ant_php_rate_sheet'] = $strongarm;

  $strongarm = new stdClass;
  $strongarm->disabled = FALSE; /* Edit this to true to make a default strongarm disabled initially */
  $strongarm->api_version = 1;
  $strongarm->name = 'ant_rate_sheet';
  $strongarm->value = '1';
  $export['ant_rate_sheet'] = $strongarm;

  $strongarm = new stdClass;
  $strongarm->disabled = FALSE; /* Edit this to true to make a default strongarm disabled initially */
  $strongarm->api_version = 1;
  $strongarm->name = 'content_extra_weights_rate_sheet';
  $strongarm->value = array(
    'title' => '-5',
    'revision_information' => '2',
    'author' => '3',
    'options' => '4',
    'menu' => '1',
    'path' => '5',
  );
  $export['content_extra_weights_rate_sheet'] = $strongarm;

  $strongarm = new stdClass;
  $strongarm->disabled = FALSE; /* Edit this to true to make a default strongarm disabled initially */
  $strongarm->api_version = 1;
  $strongarm->name = 'date:rate_sheet:full:field_start_date_fromto';
  $strongarm->value = 'both';
  $export['date:rate_sheet:full:field_start_date_fromto'] = $strongarm;

  $strongarm = new stdClass;
  $strongarm->disabled = FALSE; /* Edit this to true to make a default strongarm disabled initially */
  $strongarm->api_version = 1;
  $strongarm->name = 'date:rate_sheet:full:field_start_date_multiple_from';
  $strongarm->value = '';
  $export['date:rate_sheet:full:field_start_date_multiple_from'] = $strongarm;

  $strongarm = new stdClass;
  $strongarm->disabled = FALSE; /* Edit this to true to make a default strongarm disabled initially */
  $strongarm->api_version = 1;
  $strongarm->name = 'date:rate_sheet:full:field_start_date_multiple_number';
  $strongarm->value = '';
  $export['date:rate_sheet:full:field_start_date_multiple_number'] = $strongarm;

  $strongarm = new stdClass;
  $strongarm->disabled = FALSE; /* Edit this to true to make a default strongarm disabled initially */
  $strongarm->api_version = 1;
  $strongarm->name = 'date:rate_sheet:full:field_start_date_multiple_to';
  $strongarm->value = '';
  $export['date:rate_sheet:full:field_start_date_multiple_to'] = $strongarm;

  $strongarm = new stdClass;
  $strongarm->disabled = FALSE; /* Edit this to true to make a default strongarm disabled initially */
  $strongarm->api_version = 1;
  $strongarm->name = 'date:rate_sheet:full:field_start_date_show_repeat_rule';
  $strongarm->value = 'show';
  $export['date:rate_sheet:full:field_start_date_show_repeat_rule'] = $strongarm;

  $strongarm = new stdClass;
  $strongarm->disabled = FALSE; /* Edit this to true to make a default strongarm disabled initially */
  $strongarm->api_version = 1;
  $strongarm->name = 'date:rate_sheet:teaser:field_start_date_fromto';
  $strongarm->value = 'both';
  $export['date:rate_sheet:teaser:field_start_date_fromto'] = $strongarm;

  $strongarm = new stdClass;
  $strongarm->disabled = FALSE; /* Edit this to true to make a default strongarm disabled initially */
  $strongarm->api_version = 1;
  $strongarm->name = 'date:rate_sheet:teaser:field_start_date_multiple_from';
  $strongarm->value = '';
  $export['date:rate_sheet:teaser:field_start_date_multiple_from'] = $strongarm;

  $strongarm = new stdClass;
  $strongarm->disabled = FALSE; /* Edit this to true to make a default strongarm disabled initially */
  $strongarm->api_version = 1;
  $strongarm->name = 'date:rate_sheet:teaser:field_start_date_multiple_number';
  $strongarm->value = '';
  $export['date:rate_sheet:teaser:field_start_date_multiple_number'] = $strongarm;

  $strongarm = new stdClass;
  $strongarm->disabled = FALSE; /* Edit this to true to make a default strongarm disabled initially */
  $strongarm->api_version = 1;
  $strongarm->name = 'date:rate_sheet:teaser:field_start_date_multiple_to';
  $strongarm->value = '';
  $export['date:rate_sheet:teaser:field_start_date_multiple_to'] = $strongarm;

  $strongarm = new stdClass;
  $strongarm->disabled = FALSE; /* Edit this to true to make a default strongarm disabled initially */
  $strongarm->api_version = 1;
  $strongarm->name = 'date:rate_sheet:teaser:field_start_date_show_repeat_rule';
  $strongarm->value = 'show';
  $export['date:rate_sheet:teaser:field_start_date_show_repeat_rule'] = $strongarm;

  $strongarm = new stdClass;
  $strongarm->disabled = FALSE; /* Edit this to true to make a default strongarm disabled initially */
  $strongarm->api_version = 1;
  $strongarm->name = 'language_content_type_rate_sheet';
  $strongarm->value = '0';
  $export['language_content_type_rate_sheet'] = $strongarm;

  $strongarm = new stdClass;
  $strongarm->disabled = FALSE; /* Edit this to true to make a default strongarm disabled initially */
  $strongarm->api_version = 1;
  $strongarm->name = 'node_options_rate_sheet';
  $strongarm->value = array(
    0 => 'status',
  );
  $export['node_options_rate_sheet'] = $strongarm;

  return $export;
}
