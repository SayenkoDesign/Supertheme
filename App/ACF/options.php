<?php
if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array (
'key' => 'group_56de3dd7f321d',
'title' => 'Options Page',
'fields' => array (
array (
'key' => 'field_56de3df196018',
'label' => 'Universal Analytics',
'name' => 'universal_analytics',
'type' => 'true_false',
'instructions' => '',
'required' => 0,
'conditional_logic' => 0,
'wrapper' => array (
'width' => 25,
'class' => '',
'id' => '',
),
'message' => '',
'default_value' => 1,
),
array (
'key' => 'field_56de3e7096019',
'label' => 'Analytics ID',
'name' => 'analytics_id',
'type' => 'text',
'instructions' => '',
'required' => 0,
'conditional_logic' => 0,
'wrapper' => array (
'width' => 75,
'class' => '',
'id' => '',
),
'default_value' => '',
'placeholder' => '',
'prepend' => '',
'append' => '',
'maxlength' => '',
'readonly' => 0,
'disabled' => 0,
),
),
'location' => array (
array (
array (
'param' => 'options_page',
'operator' => '==',
'value' => 'theme-general-settings',
),
),
),
'menu_order' => 0,
'position' => 'normal',
'style' => 'default',
'label_placement' => 'top',
'instruction_placement' => 'label',
'hide_on_screen' => '',
'active' => 1,
'description' => '',
));

endif;