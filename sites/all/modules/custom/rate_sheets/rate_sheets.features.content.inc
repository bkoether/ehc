<?php

/**
 * Implementation of hook_content_default_fields().
 */
function rate_sheets_content_default_fields() {
  $fields = array();

  // Exported field: field_glycol_concentrate
  $fields['rate_sheet-field_glycol_concentrate'] = array(
    'field_name' => 'field_glycol_concentrate',
    'type_name' => 'rate_sheet',
    'display_settings' => array(
      'weight' => '6',
      'parent' => 'group_glycol',
      'label' => array(
        'format' => 'inline',
      ),
      'teaser' => array(
        'format' => 'default',
        'exclude' => 0,
      ),
      'full' => array(
        'format' => 'default',
        'exclude' => 0,
      ),
      '4' => array(
        'format' => 'default',
        'exclude' => 0,
      ),
      '2' => array(
        'format' => 'default',
        'exclude' => 0,
      ),
      '3' => array(
        'format' => 'default',
        'exclude' => 0,
      ),
      'token' => array(
        'format' => 'default',
        'exclude' => 0,
      ),
    ),
    'widget_active' => '1',
    'type' => 'number_float',
    'required' => '0',
    'multiple' => '0',
    'module' => 'number',
    'active' => '1',
    'prefix' => '',
    'suffix' => '',
    'min' => '',
    'max' => '',
    'allowed_values' => '',
    'allowed_values_php' => '',
    'widget' => array(
      'default_value' => array(
        '0' => array(
          'value' => '0',
          '_error_element' => 'default_value_widget][field_glycol_concentrate][0][value',
        ),
      ),
      'default_value_php' => NULL,
      'label' => 'Glycol Concentrate Rate',
      'weight' => '6',
      'description' => '',
      'type' => 'number',
      'module' => 'number',
    ),
  );

  // Exported field: field_glycol_containers
  $fields['rate_sheet-field_glycol_containers'] = array(
    'field_name' => 'field_glycol_containers',
    'type_name' => 'rate_sheet',
    'display_settings' => array(
      'weight' => '8',
      'parent' => 'group_glycol',
      'label' => array(
        'format' => 'inline',
      ),
      'teaser' => array(
        'format' => 'default',
        'exclude' => 0,
      ),
      'full' => array(
        'format' => 'default',
        'exclude' => 0,
      ),
      '4' => array(
        'format' => 'default',
        'exclude' => 0,
      ),
      '2' => array(
        'format' => 'default',
        'exclude' => 0,
      ),
      '3' => array(
        'format' => 'default',
        'exclude' => 0,
      ),
      'token' => array(
        'format' => 'default',
        'exclude' => 0,
      ),
    ),
    'widget_active' => '1',
    'type' => 'number_float',
    'required' => '0',
    'multiple' => '0',
    'module' => 'number',
    'active' => '1',
    'prefix' => '',
    'suffix' => '',
    'min' => '',
    'max' => '',
    'allowed_values' => '',
    'allowed_values_php' => '',
    'widget' => array(
      'default_value' => array(
        '0' => array(
          'value' => '0',
          '_error_element' => 'default_value_widget][field_glycol_containers][0][value',
        ),
      ),
      'default_value_php' => NULL,
      'label' => 'Glycol Containers Rate',
      'weight' => '8',
      'description' => '',
      'type' => 'number',
      'module' => 'number',
    ),
  );

  // Exported field: field_glycol_premix
  $fields['rate_sheet-field_glycol_premix'] = array(
    'field_name' => 'field_glycol_premix',
    'type_name' => 'rate_sheet',
    'display_settings' => array(
      'weight' => '7',
      'parent' => 'group_glycol',
      'label' => array(
        'format' => 'inline',
      ),
      'teaser' => array(
        'format' => 'default',
        'exclude' => 0,
      ),
      'full' => array(
        'format' => 'default',
        'exclude' => 0,
      ),
      '4' => array(
        'format' => 'default',
        'exclude' => 0,
      ),
      '2' => array(
        'format' => 'default',
        'exclude' => 0,
      ),
      '3' => array(
        'format' => 'default',
        'exclude' => 0,
      ),
      'token' => array(
        'format' => 'default',
        'exclude' => 0,
      ),
    ),
    'widget_active' => '1',
    'type' => 'number_float',
    'required' => '0',
    'multiple' => '0',
    'module' => 'number',
    'active' => '1',
    'prefix' => '',
    'suffix' => '',
    'min' => '',
    'max' => '',
    'allowed_values' => '',
    'allowed_values_php' => '',
    'widget' => array(
      'default_value' => array(
        '0' => array(
          'value' => '0',
          '_error_element' => 'default_value_widget][field_glycol_premix][0][value',
        ),
      ),
      'default_value_php' => NULL,
      'label' => 'Glycol Premix Rate',
      'weight' => '7',
      'description' => '',
      'type' => 'number',
      'module' => 'number',
    ),
  );

  // Exported field: field_gst
  $fields['rate_sheet-field_gst'] = array(
    'field_name' => 'field_gst',
    'type_name' => 'rate_sheet',
    'display_settings' => array(
      'weight' => '6',
      'parent' => 'group_rates',
      'label' => array(
        'format' => 'inline',
      ),
      'teaser' => array(
        'format' => 'default',
        'exclude' => 0,
      ),
      'full' => array(
        'format' => 'default',
        'exclude' => 0,
      ),
      '4' => array(
        'format' => 'default',
        'exclude' => 0,
      ),
      '2' => array(
        'format' => 'default',
        'exclude' => 0,
      ),
      '3' => array(
        'format' => 'default',
        'exclude' => 0,
      ),
      'token' => array(
        'format' => 'default',
        'exclude' => 0,
      ),
    ),
    'widget_active' => '1',
    'type' => 'number_float',
    'required' => '0',
    'multiple' => '0',
    'module' => 'number',
    'active' => '1',
    'prefix' => '',
    'suffix' => '',
    'min' => '',
    'max' => '',
    'allowed_values' => '',
    'allowed_values_php' => '',
    'widget' => array(
      'default_value' => array(
        '0' => array(
          'value' => '0',
          '_error_element' => 'default_value_widget][field_gst][0][value',
        ),
      ),
      'default_value_php' => NULL,
      'label' => 'GST Rate',
      'weight' => '6',
      'description' => '',
      'type' => 'number',
      'module' => 'number',
    ),
  );

  // Exported field: field_hst
  $fields['rate_sheet-field_hst'] = array(
    'field_name' => 'field_hst',
    'type_name' => 'rate_sheet',
    'display_settings' => array(
      'weight' => '5',
      'parent' => 'group_rates',
      'label' => array(
        'format' => 'inline',
      ),
      'teaser' => array(
        'format' => 'default',
        'exclude' => 0,
      ),
      'full' => array(
        'format' => 'default',
        'exclude' => 0,
      ),
      '4' => array(
        'format' => 'default',
        'exclude' => 0,
      ),
      '2' => array(
        'format' => 'default',
        'exclude' => 0,
      ),
      '3' => array(
        'format' => 'default',
        'exclude' => 0,
      ),
      'token' => array(
        'format' => 'default',
        'exclude' => 0,
      ),
    ),
    'widget_active' => '1',
    'type' => 'number_float',
    'required' => '0',
    'multiple' => '0',
    'module' => 'number',
    'active' => '1',
    'prefix' => '',
    'suffix' => '',
    'min' => '',
    'max' => '',
    'allowed_values' => '',
    'allowed_values_php' => '',
    'widget' => array(
      'default_value' => array(
        '0' => array(
          'value' => '0',
          '_error_element' => 'default_value_widget][field_hst][0][value',
        ),
      ),
      'default_value_php' => NULL,
      'label' => 'HST Rate',
      'weight' => '5',
      'description' => '',
      'type' => 'number',
      'module' => 'number',
    ),
  );

  // Exported field: field_hst_selector
  $fields['rate_sheet-field_hst_selector'] = array(
    'field_name' => 'field_hst_selector',
    'type_name' => 'rate_sheet',
    'display_settings' => array(
      'weight' => '4',
      'parent' => 'group_rates',
      'label' => array(
        'format' => 'inline',
      ),
      'teaser' => array(
        'format' => 'default',
        'exclude' => 1,
      ),
      'full' => array(
        'format' => 'default',
        'exclude' => 1,
      ),
      '4' => array(
        'format' => 'default',
        'exclude' => 0,
      ),
      '2' => array(
        'format' => 'default',
        'exclude' => 0,
      ),
      '3' => array(
        'format' => 'default',
        'exclude' => 0,
      ),
      'token' => array(
        'format' => 'default',
        'exclude' => 0,
      ),
    ),
    'widget_active' => '1',
    'type' => 'number_integer',
    'required' => '1',
    'multiple' => '0',
    'module' => 'number',
    'active' => '1',
    'prefix' => '',
    'suffix' => '',
    'min' => '',
    'max' => '',
    'allowed_values' => '0|GST
1|HST',
    'allowed_values_php' => '',
    'widget' => array(
      'default_value' => array(
        '0' => array(
          'value' => '0',
        ),
      ),
      'default_value_php' => NULL,
      'label' => 'HST/GST',
      'weight' => '4',
      'description' => 'Select if this province uses the HST or a combination of GST/PST.',
      'type' => 'optionwidgets_buttons',
      'module' => 'optionwidgets',
    ),
  );

  // Exported field: field_oem_agricultural
  $fields['rate_sheet-field_oem_agricultural'] = array(
    'field_name' => 'field_oem_agricultural',
    'type_name' => 'rate_sheet',
    'display_settings' => array(
      'label' => array(
        'format' => 'above',
        'exclude' => 0,
      ),
      'teaser' => array(
        'format' => 'default',
        'exclude' => 0,
      ),
      'full' => array(
        'format' => 'default',
        'exclude' => 0,
      ),
      '4' => array(
        'format' => 'default',
        'exclude' => 0,
      ),
      '2' => array(
        'format' => 'default',
        'exclude' => 0,
      ),
      '3' => array(
        'format' => 'default',
        'exclude' => 0,
      ),
      'token' => array(
        'format' => 'default',
        'exclude' => 0,
      ),
    ),
    'widget_active' => '1',
    'type' => 'tablefield',
    'required' => '0',
    'multiple' => '0',
    'module' => 'tablefield',
    'active' => '1',
    'cell_processing' => '0',
    'count_cols' => '',
    'count_rows' => '',
    'widget' => array(
      'default_value' => array(
        '0' => array(
          'tablefield' => array(
            'cell_0_0' => 'Description',
            'cell_0_1' => 'Oil (l)',
            'cell_0_2' => 'Coolant (l)',
            'cell_0_3' => 'Filter (s)',
            'cell_0_4' => 'Filter (l)',
            'cell_0_5' => 'Total $',
            'cell_0_6' => 'Add. Info',
            'cell_1_0' => '',
            'cell_1_1' => '',
            'cell_1_2' => '',
            'cell_1_3' => '',
            'cell_1_4' => '',
            'cell_1_5' => '',
            'cell_1_6' => '',
            'cell_2_0' => '',
            'cell_2_1' => '',
            'cell_2_2' => '',
            'cell_2_3' => '',
            'cell_2_4' => '',
            'cell_2_5' => '',
            'cell_2_6' => '',
            'cell_3_0' => '',
            'cell_3_1' => '',
            'cell_3_2' => '',
            'cell_3_3' => '',
            'cell_3_4' => '',
            'cell_3_5' => '',
            'cell_3_6' => '',
            'cell_4_0' => '',
            'cell_4_1' => '',
            'cell_4_2' => '',
            'cell_4_3' => '',
            'cell_4_4' => '',
            'cell_4_5' => '',
            'cell_4_6' => '',
            'cell_5_0' => '',
            'cell_5_1' => '',
            'cell_5_2' => '',
            'cell_5_3' => '',
            'cell_5_4' => '',
            'cell_5_5' => '',
            'cell_5_6' => '',
            'cell_6_0' => '',
            'cell_6_1' => '',
            'cell_6_2' => '',
            'cell_6_3' => '',
            'cell_6_4' => '',
            'cell_6_5' => '',
            'cell_6_6' => '',
            'count_cols' => '7',
            'count_rows' => '7',
            'rebuild' => 'Rebuild Table',
          ),
        ),
      ),
      'default_value_php' => NULL,
      'label' => 'Agricultural Equipment',
      'weight' => '13',
      'description' => '',
      'type' => 'tablefield',
      'module' => 'tablefield',
    ),
  );

  // Exported field: field_oem_automotive
  $fields['rate_sheet-field_oem_automotive'] = array(
    'field_name' => 'field_oem_automotive',
    'type_name' => 'rate_sheet',
    'display_settings' => array(
      'label' => array(
        'format' => 'above',
        'exclude' => 0,
      ),
      'teaser' => array(
        'format' => 'default',
        'exclude' => 0,
      ),
      'full' => array(
        'format' => 'default',
        'exclude' => 0,
      ),
      '4' => array(
        'format' => 'default',
        'exclude' => 0,
      ),
      '2' => array(
        'format' => 'default',
        'exclude' => 0,
      ),
      '3' => array(
        'format' => 'default',
        'exclude' => 0,
      ),
      'token' => array(
        'format' => 'default',
        'exclude' => 0,
      ),
    ),
    'widget_active' => '1',
    'type' => 'tablefield',
    'required' => '0',
    'multiple' => '0',
    'module' => 'tablefield',
    'active' => '1',
    'cell_processing' => '0',
    'count_cols' => '',
    'count_rows' => '',
    'widget' => array(
      'default_value' => array(
        '0' => array(
          'tablefield' => array(
            'cell_0_0' => 'Description',
            'cell_0_1' => 'Oil (l)',
            'cell_0_2' => 'Coolant (l)',
            'cell_0_3' => 'Filters (s)',
            'cell_0_4' => 'Filters (l)',
            'cell_0_5' => 'Total $',
            'cell_0_6' => 'Add. Info',
            'cell_1_0' => '',
            'cell_1_1' => '',
            'cell_1_2' => '',
            'cell_1_3' => '',
            'cell_1_4' => '',
            'cell_1_5' => '',
            'cell_1_6' => '',
            'cell_2_0' => '',
            'cell_2_1' => '',
            'cell_2_2' => '',
            'cell_2_3' => '',
            'cell_2_4' => '',
            'cell_2_5' => '',
            'cell_2_6' => '',
            'cell_3_0' => '',
            'cell_3_1' => '',
            'cell_3_2' => '',
            'cell_3_3' => '',
            'cell_3_4' => '',
            'cell_3_5' => '',
            'cell_3_6' => '',
            'cell_4_0' => '',
            'cell_4_1' => '',
            'cell_4_2' => '',
            'cell_4_3' => '',
            'cell_4_4' => '',
            'cell_4_5' => '',
            'cell_4_6' => '',
            'count_cols' => '7',
            'count_rows' => '5',
            'rebuild' => 'Rebuild Table',
          ),
        ),
      ),
      'default_value_php' => NULL,
      'label' => 'Automotive',
      'weight' => '11',
      'description' => '',
      'type' => 'tablefield',
      'module' => 'tablefield',
    ),
  );

  // Exported field: field_oem_construction
  $fields['rate_sheet-field_oem_construction'] = array(
    'field_name' => 'field_oem_construction',
    'type_name' => 'rate_sheet',
    'display_settings' => array(
      'label' => array(
        'format' => 'above',
        'exclude' => 0,
      ),
      'teaser' => array(
        'format' => 'default',
        'exclude' => 0,
      ),
      'full' => array(
        'format' => 'default',
        'exclude' => 0,
      ),
      '4' => array(
        'format' => 'default',
        'exclude' => 0,
      ),
      '2' => array(
        'format' => 'default',
        'exclude' => 0,
      ),
      '3' => array(
        'format' => 'default',
        'exclude' => 0,
      ),
      'token' => array(
        'format' => 'default',
        'exclude' => 0,
      ),
    ),
    'widget_active' => '1',
    'type' => 'tablefield',
    'required' => '0',
    'multiple' => '0',
    'module' => 'tablefield',
    'active' => '1',
    'cell_processing' => '0',
    'count_cols' => '',
    'count_rows' => '',
    'widget' => array(
      'default_value' => array(
        '0' => array(
          'tablefield' => array(
            'cell_0_0' => 'Description',
            'cell_0_1' => 'Oil (l)',
            'cell_0_2' => 'Coolant (l)',
            'cell_0_3' => 'Filter (s)',
            'cell_0_4' => 'Filter (l)',
            'cell_0_5' => 'Total $',
            'cell_0_6' => 'Add. Info',
            'cell_1_0' => '',
            'cell_1_1' => '',
            'cell_1_2' => '',
            'cell_1_3' => '',
            'cell_1_4' => '',
            'cell_1_5' => '',
            'cell_1_6' => '',
            'cell_2_0' => '',
            'cell_2_1' => '',
            'cell_2_2' => '',
            'cell_2_3' => '',
            'cell_2_4' => '',
            'cell_2_5' => '',
            'cell_2_6' => '',
            'cell_3_0' => '',
            'cell_3_1' => '',
            'cell_3_2' => '',
            'cell_3_3' => '',
            'cell_3_4' => '',
            'cell_3_5' => '',
            'cell_3_6' => '',
            'cell_4_0' => '',
            'cell_4_1' => '',
            'cell_4_2' => '',
            'cell_4_3' => '',
            'cell_4_4' => '',
            'cell_4_5' => '',
            'cell_4_6' => '',
            'cell_5_0' => '',
            'cell_5_1' => '',
            'cell_5_2' => '',
            'cell_5_3' => '',
            'cell_5_4' => '',
            'cell_5_5' => '',
            'cell_5_6' => '',
            'cell_6_0' => '',
            'cell_6_1' => '',
            'cell_6_2' => '',
            'cell_6_3' => '',
            'cell_6_4' => '',
            'cell_6_5' => '',
            'cell_6_6' => '',
            'count_cols' => '7',
            'count_rows' => '7',
            'rebuild' => 'Rebuild Table',
          ),
        ),
      ),
      'default_value_php' => NULL,
      'label' => 'Construction Equipment',
      'weight' => '14',
      'description' => '',
      'type' => 'tablefield',
      'module' => 'tablefield',
    ),
  );

  // Exported field: field_oem_forestry
  $fields['rate_sheet-field_oem_forestry'] = array(
    'field_name' => 'field_oem_forestry',
    'type_name' => 'rate_sheet',
    'display_settings' => array(
      'label' => array(
        'format' => 'above',
        'exclude' => 0,
      ),
      'teaser' => array(
        'format' => 'default',
        'exclude' => 0,
      ),
      'full' => array(
        'format' => 'default',
        'exclude' => 0,
      ),
      '4' => array(
        'format' => 'default',
        'exclude' => 0,
      ),
      '2' => array(
        'format' => 'default',
        'exclude' => 0,
      ),
      '3' => array(
        'format' => 'default',
        'exclude' => 0,
      ),
      'token' => array(
        'format' => 'default',
        'exclude' => 0,
      ),
    ),
    'widget_active' => '1',
    'type' => 'tablefield',
    'required' => '0',
    'multiple' => '0',
    'module' => 'tablefield',
    'active' => '1',
    'cell_processing' => '0',
    'count_cols' => '',
    'count_rows' => '',
    'widget' => array(
      'default_value' => array(
        '0' => array(
          'tablefield' => array(
            'cell_0_0' => 'Description',
            'cell_0_1' => 'Oil (l)',
            'cell_0_2' => 'Coolant (l)',
            'cell_0_3' => 'Filter (s)',
            'cell_0_4' => 'Filter (l)',
            'cell_0_5' => 'Total $',
            'cell_0_6' => 'Add. Info',
            'cell_1_0' => '',
            'cell_1_1' => '',
            'cell_1_2' => '',
            'cell_1_3' => '',
            'cell_1_4' => '',
            'cell_1_5' => '',
            'cell_1_6' => '',
            'cell_2_0' => '',
            'cell_2_1' => '',
            'cell_2_2' => '',
            'cell_2_3' => '',
            'cell_2_4' => '',
            'cell_2_5' => '',
            'cell_2_6' => '',
            'cell_3_0' => '',
            'cell_3_1' => '',
            'cell_3_2' => '',
            'cell_3_3' => '',
            'cell_3_4' => '',
            'cell_3_5' => '',
            'cell_3_6' => '',
            'cell_4_0' => '',
            'cell_4_1' => '',
            'cell_4_2' => '',
            'cell_4_3' => '',
            'cell_4_4' => '',
            'cell_4_5' => '',
            'cell_4_6' => '',
            'count_cols' => '7',
            'count_rows' => '5',
            'rebuild' => 'Rebuild Table',
          ),
        ),
      ),
      'default_value_php' => NULL,
      'label' => 'Forestry Equipment',
      'weight' => '15',
      'description' => '',
      'type' => 'tablefield',
      'module' => 'tablefield',
    ),
  );

  // Exported field: field_oem_utility
  $fields['rate_sheet-field_oem_utility'] = array(
    'field_name' => 'field_oem_utility',
    'type_name' => 'rate_sheet',
    'display_settings' => array(
      'label' => array(
        'format' => 'above',
        'exclude' => 0,
      ),
      'teaser' => array(
        'format' => 'default',
        'exclude' => 0,
      ),
      'full' => array(
        'format' => 'default',
        'exclude' => 0,
      ),
      '4' => array(
        'format' => 'default',
        'exclude' => 0,
      ),
      '2' => array(
        'format' => 'default',
        'exclude' => 0,
      ),
      '3' => array(
        'format' => 'default',
        'exclude' => 0,
      ),
      'token' => array(
        'format' => 'default',
        'exclude' => 0,
      ),
    ),
    'widget_active' => '1',
    'type' => 'tablefield',
    'required' => '0',
    'multiple' => '0',
    'module' => 'tablefield',
    'active' => '1',
    'cell_processing' => '0',
    'count_cols' => '',
    'count_rows' => '',
    'widget' => array(
      'default_value' => array(
        '0' => array(
          'tablefield' => array(
            'cell_0_0' => 'Description',
            'cell_0_1' => 'Oil (l)',
            'cell_0_2' => 'Coolant (l)',
            'cell_0_3' => 'Filter (s)',
            'cell_0_4' => 'Filter (l)',
            'cell_0_5' => 'Total $',
            'cell_0_6' => 'Add. Info',
            'cell_1_0' => '',
            'cell_1_1' => '',
            'cell_1_2' => '',
            'cell_1_3' => '',
            'cell_1_4' => '',
            'cell_1_5' => '',
            'cell_1_6' => '',
            'cell_2_0' => '',
            'cell_2_1' => '',
            'cell_2_2' => '',
            'cell_2_3' => '',
            'cell_2_4' => '',
            'cell_2_5' => '',
            'cell_2_6' => '',
            'count_cols' => '7',
            'count_rows' => '3',
            'rebuild' => 'Rebuild Table',
          ),
        ),
      ),
      'default_value_php' => NULL,
      'label' => 'Riding Mowers & Utility Vehicles',
      'weight' => '12',
      'description' => '',
      'type' => 'tablefield',
      'module' => 'tablefield',
    ),
  );

  // Exported field: field_oil
  $fields['rate_sheet-field_oil'] = array(
    'field_name' => 'field_oil',
    'type_name' => 'rate_sheet',
    'display_settings' => array(
      'weight' => 0,
      'parent' => 'group_oil',
      'label' => array(
        'format' => 'inline',
      ),
      'teaser' => array(
        'format' => 'default',
        'exclude' => 0,
      ),
      'full' => array(
        'format' => 'default',
        'exclude' => 0,
      ),
      '4' => array(
        'format' => 'default',
        'exclude' => 0,
      ),
      '2' => array(
        'format' => 'default',
        'exclude' => 0,
      ),
      '3' => array(
        'format' => 'default',
        'exclude' => 0,
      ),
      'token' => array(
        'format' => 'default',
        'exclude' => 0,
      ),
    ),
    'widget_active' => '1',
    'type' => 'number_float',
    'required' => '0',
    'multiple' => '0',
    'module' => 'number',
    'active' => '1',
    'prefix' => '',
    'suffix' => '',
    'min' => '',
    'max' => '',
    'allowed_values' => '',
    'allowed_values_php' => '',
    'widget' => array(
      'default_value' => array(
        '0' => array(
          'value' => '0',
          '_error_element' => 'default_value_widget][field_oil][0][value',
        ),
      ),
      'default_value_php' => NULL,
      'label' => 'Oil Rate',
      'weight' => 0,
      'description' => '',
      'type' => 'number',
      'module' => 'number',
    ),
  );

  // Exported field: field_oil_containers
  $fields['rate_sheet-field_oil_containers'] = array(
    'field_name' => 'field_oil_containers',
    'type_name' => 'rate_sheet',
    'display_settings' => array(
      'weight' => '1',
      'parent' => 'group_oil',
      'label' => array(
        'format' => 'inline',
      ),
      'teaser' => array(
        'format' => 'default',
        'exclude' => 0,
      ),
      'full' => array(
        'format' => 'default',
        'exclude' => 0,
      ),
      '4' => array(
        'format' => 'default',
        'exclude' => 0,
      ),
      '2' => array(
        'format' => 'default',
        'exclude' => 0,
      ),
      '3' => array(
        'format' => 'default',
        'exclude' => 0,
      ),
      'token' => array(
        'format' => 'default',
        'exclude' => 0,
      ),
    ),
    'widget_active' => '1',
    'type' => 'number_float',
    'required' => '0',
    'multiple' => '0',
    'module' => 'number',
    'active' => '1',
    'prefix' => '',
    'suffix' => '',
    'min' => '',
    'max' => '',
    'allowed_values' => '',
    'allowed_values_php' => '',
    'widget' => array(
      'default_value' => array(
        '0' => array(
          'value' => '0',
          '_error_element' => 'default_value_widget][field_oil_containers][0][value',
        ),
      ),
      'default_value_php' => NULL,
      'label' => 'Oil Containers Rate',
      'weight' => '1',
      'description' => '',
      'type' => 'number',
      'module' => 'number',
    ),
  );

  // Exported field: field_oil_filter_large
  $fields['rate_sheet-field_oil_filter_large'] = array(
    'field_name' => 'field_oil_filter_large',
    'type_name' => 'rate_sheet',
    'display_settings' => array(
      'weight' => '3',
      'parent' => 'group_oil',
      'label' => array(
        'format' => 'inline',
      ),
      'teaser' => array(
        'format' => 'default',
        'exclude' => 0,
      ),
      'full' => array(
        'format' => 'default',
        'exclude' => 0,
      ),
      '4' => array(
        'format' => 'default',
        'exclude' => 0,
      ),
      '2' => array(
        'format' => 'default',
        'exclude' => 0,
      ),
      '3' => array(
        'format' => 'default',
        'exclude' => 0,
      ),
      'token' => array(
        'format' => 'default',
        'exclude' => 0,
      ),
    ),
    'widget_active' => '1',
    'type' => 'number_float',
    'required' => '0',
    'multiple' => '0',
    'module' => 'number',
    'active' => '1',
    'prefix' => '',
    'suffix' => '',
    'min' => '',
    'max' => '',
    'allowed_values' => '',
    'allowed_values_php' => '',
    'widget' => array(
      'default_value' => array(
        '0' => array(
          'value' => '0',
          '_error_element' => 'default_value_widget][field_oil_filter_large][0][value',
        ),
      ),
      'default_value_php' => NULL,
      'label' => 'Oil Filter > 8in Rate',
      'weight' => '3',
      'description' => '',
      'type' => 'number',
      'module' => 'number',
    ),
  );

  // Exported field: field_oil_filter_small
  $fields['rate_sheet-field_oil_filter_small'] = array(
    'field_name' => 'field_oil_filter_small',
    'type_name' => 'rate_sheet',
    'display_settings' => array(
      'weight' => '2',
      'parent' => 'group_oil',
      'label' => array(
        'format' => 'inline',
      ),
      'teaser' => array(
        'format' => 'default',
        'exclude' => 0,
      ),
      'full' => array(
        'format' => 'default',
        'exclude' => 0,
      ),
      '4' => array(
        'format' => 'default',
        'exclude' => 0,
      ),
      '2' => array(
        'format' => 'default',
        'exclude' => 0,
      ),
      '3' => array(
        'format' => 'default',
        'exclude' => 0,
      ),
      'token' => array(
        'format' => 'default',
        'exclude' => 0,
      ),
    ),
    'widget_active' => '1',
    'type' => 'number_float',
    'required' => '0',
    'multiple' => '0',
    'module' => 'number',
    'active' => '1',
    'prefix' => '',
    'suffix' => '',
    'min' => '',
    'max' => '',
    'allowed_values' => '',
    'allowed_values_php' => '',
    'widget' => array(
      'default_value' => array(
        '0' => array(
          'value' => '0',
          '_error_element' => 'default_value_widget][field_oil_filter_small][0][value',
        ),
      ),
      'default_value_php' => NULL,
      'label' => 'Oil Filter <= 8in Rate',
      'weight' => '2',
      'description' => '',
      'type' => 'number',
      'module' => 'number',
    ),
  );

  // Exported field: field_province
  $fields['rate_sheet-field_province'] = array(
    'field_name' => 'field_province',
    'type_name' => 'rate_sheet',
    'display_settings' => array(
      'weight' => '-4',
      'parent' => '',
      'label' => array(
        'format' => 'inline',
      ),
      'teaser' => array(
        'format' => 'default',
        'exclude' => 0,
      ),
      'full' => array(
        'format' => 'default',
        'exclude' => 0,
      ),
      '4' => array(
        'format' => 'default',
        'exclude' => 0,
      ),
      '2' => array(
        'format' => 'default',
        'exclude' => 0,
      ),
      '3' => array(
        'format' => 'default',
        'exclude' => 0,
      ),
      'token' => array(
        'format' => 'default',
        'exclude' => 0,
      ),
    ),
    'widget_active' => '1',
    'type' => 'text',
    'required' => '1',
    'multiple' => '0',
    'module' => 'text',
    'active' => '1',
    'text_processing' => '0',
    'max_length' => '',
    'allowed_values' => 'AB|Alberta
BC|British Columbia
MB|Manitoba
NB|New Brunswick
NL|Newfoundland And Labrador
NS|Nova Sotia
NT|Northwest Territories
NU|Nunavt
ON|Ontario
PE|Prince Edward Island
QC|Quebec
SK|Saskatchewan
YT|Yukon',
    'allowed_values_php' => '',
    'widget' => array(
      'default_value' => array(
        '0' => array(
          'value' => '',
        ),
      ),
      'default_value_php' => NULL,
      'label' => 'Province',
      'weight' => '-4',
      'description' => '',
      'type' => 'optionwidgets_select',
      'module' => 'optionwidgets',
    ),
  );

  // Exported field: field_pst
  $fields['rate_sheet-field_pst'] = array(
    'field_name' => 'field_pst',
    'type_name' => 'rate_sheet',
    'display_settings' => array(
      'weight' => '7',
      'parent' => 'group_rates',
      'label' => array(
        'format' => 'inline',
      ),
      'teaser' => array(
        'format' => 'default',
        'exclude' => 0,
      ),
      'full' => array(
        'format' => 'default',
        'exclude' => 0,
      ),
      '4' => array(
        'format' => 'default',
        'exclude' => 0,
      ),
      '2' => array(
        'format' => 'default',
        'exclude' => 0,
      ),
      '3' => array(
        'format' => 'default',
        'exclude' => 0,
      ),
      'token' => array(
        'format' => 'default',
        'exclude' => 0,
      ),
    ),
    'widget_active' => '1',
    'type' => 'number_float',
    'required' => '0',
    'multiple' => '0',
    'module' => 'number',
    'active' => '1',
    'prefix' => '',
    'suffix' => '',
    'min' => '',
    'max' => '',
    'allowed_values' => '',
    'allowed_values_php' => '',
    'widget' => array(
      'default_value' => array(
        '0' => array(
          'value' => '0',
          '_error_element' => 'default_value_widget][field_pst][0][value',
        ),
      ),
      'default_value_php' => NULL,
      'label' => 'PST Rate',
      'weight' => '7',
      'description' => '',
      'type' => 'number',
      'module' => 'number',
    ),
  );

  // Exported field: field_start_date
  $fields['rate_sheet-field_start_date'] = array(
    'field_name' => 'field_start_date',
    'type_name' => 'rate_sheet',
    'display_settings' => array(
      'weight' => '-3',
      'parent' => '',
      'label' => array(
        'format' => 'inline',
      ),
      'teaser' => array(
        'format' => 'default',
        'exclude' => 0,
      ),
      'full' => array(
        'format' => 'default',
        'exclude' => 0,
      ),
      '4' => array(
        'format' => 'default',
        'exclude' => 0,
      ),
      '2' => array(
        'format' => 'default',
        'exclude' => 0,
      ),
      '3' => array(
        'format' => 'default',
        'exclude' => 0,
      ),
      'token' => array(
        'format' => 'default',
        'exclude' => 0,
      ),
    ),
    'widget_active' => '1',
    'type' => 'datestamp',
    'required' => '1',
    'multiple' => '0',
    'module' => 'date',
    'active' => '1',
    'granularity' => array(
      'year' => 'year',
      'month' => 'month',
      'day' => 'day',
    ),
    'timezone_db' => '',
    'tz_handling' => 'none',
    'todate' => '',
    'repeat' => 0,
    'repeat_collapsed' => '',
    'default_format' => 'medium',
    'widget' => array(
      'default_value' => 'now',
      'default_value_code' => '',
      'default_value2' => 'blank',
      'default_value_code2' => '',
      'input_format' => 'm/d/Y - g:ia',
      'input_format_custom' => '',
      'increment' => '1',
      'text_parts' => array(),
      'year_range' => '-3:+3',
      'label_position' => 'above',
      'label' => 'Effective On',
      'weight' => '-3',
      'description' => '',
      'type' => 'date_popup',
      'module' => 'date',
    ),
  );

  // Translatables
  // Included for use with string extractors like potx.
  t('Agricultural Equipment');
  t('Automotive');
  t('Construction Equipment');
  t('Effective On');
  t('Forestry Equipment');
  t('GST Rate');
  t('Glycol Concentrate Rate');
  t('Glycol Containers Rate');
  t('Glycol Premix Rate');
  t('HST Rate');
  t('HST/GST');
  t('Oil Containers Rate');
  t('Oil Filter <= 8in Rate');
  t('Oil Filter > 8in Rate');
  t('Oil Rate');
  t('PST Rate');
  t('Province');
  t('Riding Mowers & Utility Vehicles');

  return $fields;
}
