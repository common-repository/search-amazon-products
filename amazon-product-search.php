<?php
/*
    Plugin Name: Amazon Product Search
    Description: Amazon Product Search Plugin using AWS API
    Version:     1.0
    Author:      Kashyap Padh
*/
define('VERSION', 1.0);

function apsInstall(){
    add_menu_page('Amazon API Settings', 'Amazon Product Search Settings', 'manage_options', plugin_dir_path(__FILE__) .'/views/apiSettings.php', '');
}

add_action('admin_menu',  'apsInstall');

function saveAwsSettings(){
    register_setting('aws_settings', 'aws_api_key');
    register_setting('aws_settings', 'aws_secret_key');
    register_setting('aws_settings', 'aws_associate_tag');
    register_setting('aws_settings', 'aws_search_asin_flag');
    register_setting('aws_settings', 'aws_search_parent_asin_flag');
    register_setting('aws_settings', 'aws_search_image_flag');
    register_setting('aws_settings', 'aws_search_title_flag');
    register_setting('aws_settings', 'aws_search_manufacturer_flag');
    register_setting('aws_settings', 'aws_search_product_price_flag');    
    register_setting('aws_settings', 'aws_search_category_flag');
    register_setting('aws_settings', 'aws_search_price_flag');
    register_setting('aws_settings', 'aws_search_response_group');
    register_setting('aws_settings', 'aws_search_condition_flag');
    register_setting('aws_settings', 'aws_search_text_class');
    register_setting('aws_settings', 'aws_search_category_class');
    register_setting('aws_settings', 'aws_search_minmax_class');
    register_setting('aws_settings', 'aws_search_condition_class');
    register_setting('aws_settings', 'aws_search_button_class');
}

add_action('admin_init','saveAwsSettings');

function renderSearchForm() {
    include (plugin_dir_path(__FILE__) .'views/searchProduct.php');
    return;
}
add_shortcode( 'amzSearchForm', 'renderSearchForm' );