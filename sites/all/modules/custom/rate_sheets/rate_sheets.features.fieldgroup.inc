<?php

/**
 * Implementation of hook_fieldgroup_default_groups().
 */
function rate_sheets_fieldgroup_default_groups() {
  $groups = array();

  // Exported group: group_glycol
  $groups['rate_sheet-group_glycol'] = array(
    'group_type' => 'standard',
    'type_name' => 'rate_sheet',
    'group_name' => 'group_glycol',
    'label' => 'Glycol',
    'settings' => array(
      'form' => array(
        'style' => 'fieldset_collapsible',
        'description' => '',
      ),
      'display' => array(
        'weight' => '0',
        'label' => 'hidden',
        'teaser' => array(
          'format' => 'fieldset',
          'exclude' => 0,
        ),
        'full' => array(
          'format' => 'simple',
          'exclude' => 0,
        ),
        'description' => '',
        '4' => array(
          'format' => 'fieldset',
          'exclude' => 0,
        ),
        '2' => array(
          'format' => 'fieldset',
          'exclude' => 0,
        ),
        '3' => array(
          'format' => 'fieldset',
          'exclude' => 0,
        ),
        'token' => array(
          'format' => 'fieldset',
          'exclude' => 0,
        ),
      ),
    ),
    'weight' => '0',
    'fields' => array(
      '0' => 'field_glycol_concentrate',
      '1' => 'field_glycol_premix',
      '2' => 'field_glycol_containers',
    ),
  );

  // Exported group: group_oem
  $groups['rate_sheet-group_oem'] = array(
    'group_type' => 'standard',
    'type_name' => 'rate_sheet',
    'group_name' => 'group_oem',
    'label' => 'OEM',
    'settings' => array(
      'form' => array(
        'style' => 'fieldset_collapsed',
        'description' => '',
      ),
      'display' => array(
        'description' => '',
        'teaser' => array(
          'format' => 'fieldset',
          'exclude' => 0,
        ),
        'full' => array(
          'format' => 'fieldset',
          'exclude' => 0,
        ),
        '4' => array(
          'format' => 'fieldset',
          'exclude' => 0,
        ),
        '2' => array(
          'format' => 'fieldset',
          'exclude' => 0,
        ),
        '3' => array(
          'format' => 'fieldset',
          'exclude' => 0,
        ),
        'token' => array(
          'format' => 'fieldset',
          'exclude' => 0,
        ),
        'label' => 'above',
      ),
    ),
    'weight' => '1',
    'fields' => array(
      '0' => 'field_oem_automotive',
      '1' => 'field_oem_utility',
      '2' => 'field_oem_agricultural',
      '3' => 'field_oem_construction',
      '4' => 'field_oem_forestry',
    ),
  );

  // Exported group: group_oil
  $groups['rate_sheet-group_oil'] = array(
    'group_type' => 'standard',
    'type_name' => 'rate_sheet',
    'group_name' => 'group_oil',
    'label' => 'Oil',
    'settings' => array(
      'form' => array(
        'style' => 'fieldset_collapsible',
        'description' => '',
      ),
      'display' => array(
        'weight' => '-1',
        'label' => 'hidden',
        'teaser' => array(
          'format' => 'fieldset',
          'exclude' => 0,
        ),
        'full' => array(
          'format' => 'simple',
          'exclude' => 0,
        ),
        'description' => '',
        '4' => array(
          'format' => 'fieldset',
          'exclude' => 0,
        ),
        '2' => array(
          'format' => 'fieldset',
          'exclude' => 0,
        ),
        '3' => array(
          'format' => 'fieldset',
          'exclude' => 0,
        ),
        'token' => array(
          'format' => 'fieldset',
          'exclude' => 0,
        ),
      ),
    ),
    'weight' => '-1',
    'fields' => array(
      '0' => 'field_oil',
      '1' => 'field_oil_containers',
      '2' => 'field_oil_filter_small',
      '3' => 'field_oil_filter_large',
    ),
  );

  // Exported group: group_rates
  $groups['rate_sheet-group_rates'] = array(
    'group_type' => 'standard',
    'type_name' => 'rate_sheet',
    'group_name' => 'group_rates',
    'label' => 'Tax Rates',
    'settings' => array(
      'form' => array(
        'style' => 'fieldset_collapsible',
        'description' => '',
      ),
      'display' => array(
        'weight' => '-2',
        'label' => 'hidden',
        'teaser' => array(
          'format' => 'fieldset',
          'exclude' => 0,
        ),
        'full' => array(
          'format' => 'simple',
          'exclude' => 0,
        ),
        'description' => '',
        '4' => array(
          'format' => 'fieldset',
          'exclude' => 0,
        ),
        '2' => array(
          'format' => 'fieldset',
          'exclude' => 0,
        ),
        '3' => array(
          'format' => 'fieldset',
          'exclude' => 0,
        ),
        'token' => array(
          'format' => 'fieldset',
          'exclude' => 0,
        ),
      ),
    ),
    'weight' => '-2',
    'fields' => array(
      '0' => 'field_hst_selector',
      '1' => 'field_hst',
      '2' => 'field_gst',
      '3' => 'field_pst',
    ),
  );

  // Translatables
  // Included for use with string extractors like potx.
  t('Glycol');
  t('OEM');
  t('Oil');
  t('Tax Rates');

  return $groups;
}
