<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<form action="options.php" method="POST">
    <?php
        settings_fields('aws_settings');
        do_settings_sections('aws_settings');
    ?>
    <table class="form-table">
        <tbody>
            <tr>
                <th scope="row"><label for="blogname">AWS API Key</label></th>
                <td><input name="aws_api_key" id="aws_api_key" value="<?php echo get_option('aws_api_key');?>" class="regular-text" type="text"></td>
            </tr>
            <tr>
                <th scope="row"><label for="blogname">AWS Secret Key</label></th>
                <td><input name="aws_secret_key" id="aws_secret_key" value="<?php echo get_option('aws_secret_key');?>" class="regular-text" type="text"></td>
            </tr>
            <tr>
                <th scope="row"><label for="blogname">AWS Associate Tag</label></th>
                <td><input name="aws_associate_tag" id="aws_associate_tag" value="<?php echo get_option('aws_associate_tag');?>" class="regular-text" type="text"></td>
            </tr>
            <tr>
                <th colspan="2" scope="row"><hr/></th>
            </tr>
            <tr>
                <th colspan="2" scope="row"><label for="blogname">Display Parameters Options</label></th>
            </tr>
            <tr>
                <th scope="row"><label for="blogname">Display Product ASIN</label></th>
                <td><input name="aws_search_asin_flag" id="aws_search_asin_flag" value="1" <?php echo (get_option('aws_search_asin_flag') == 1) ? 'checked' : '';?> class="regular-text" type="checkbox"></td>
            </tr>
            <tr>
                <th scope="row"><label for="blogname">Display Product Parent ASIN</label></th>
                <td><input name="aws_search_parent_asin_flag" id="aws_search_parent_asin_flag" value="1" <?php echo (get_option('aws_search_parent_asin_flag') == 1) ? 'checked' : '';?> class="regular-text" type="checkbox"></td>
            </tr>
            <tr>
                <th scope="row"><label for="blogname">Display Product Image</label></th>
                <td><input name="aws_search_image_flag" id="aws_search_image_flag" value="1" <?php echo (get_option('aws_search_image_flag') == 1) ? 'checked' : '';?> class="regular-text" type="checkbox"></td>
            </tr>
            <tr>
                <th scope="row"><label for="blogname">Display Product Title</label></th>
                <td><input name="aws_search_title_flag" id="aws_search_title_flag" value="1" <?php echo (get_option('aws_search_title_flag') == 1) ? 'checked' : '';?> class="regular-text" type="checkbox"></td>
            </tr>
            <tr>
                <th scope="row"><label for="blogname">Display Product Manufacturer</label></th>
                <td><input name="aws_search_manufacturer_flag" id="aws_search_manufacturer_flag" value="1" <?php echo (get_option('aws_search_manufacturer_flag') == 1) ? 'checked' : '';?> class="regular-text" type="checkbox"></td>
            </tr>
            <tr>
                <th scope="row"><label for="blogname">Display Product Price</label></th>
                <td><input name="aws_search_product_price_flag" id="aws_search_product_price_flag" value="1" <?php echo (get_option('aws_search_product_price_flag') == 1) ? 'checked' : '';?> class="regular-text" type="checkbox"></td>
            </tr>
            <tr>
                <th colspan="2" scope="row"><hr/></th>
            </tr>
            <tr>
                <th colspan="2" scope="row"><label for="blogname">Search Parameters Options</label></th>
            </tr>
            <tr>
                <th scope="row"><label for="blogname">Search By Category Flag</label></th>
                <td><input name="aws_search_category_flag" id="aws_search_category_flag" value="1" <?php echo (get_option('aws_search_category_flag') == 1) ? 'checked' : '';?> class="regular-text" type="checkbox"></td>
            </tr>
            <tr>
                <th scope="row"><label for="blogname">Search By Price Flag</label></th>
                <td><input name="aws_search_price_flag" id="aws_search_price_flag" value="1" <?php echo (get_option('aws_search_price_flag') == 1) ? 'checked' : '';?> class="regular-text" type="checkbox"></td>
            </tr>
            <tr>
                <th scope="row"><label for="blogname">Search By Condition Flag</label></th>
                <td><input name="aws_search_condition_flag" id="aws_search_condition_flag" value="1" <?php echo (get_option('aws_search_condition_flag') == 1) ? 'checked' : '';?> class="regular-text" type="checkbox"></td>
            </tr>
            <tr>
                <th scope="row"><label for="blogname">Response Group Type</label></th>
                <td>
                    <select name="aws_search_response_group" id="aws_search_response_group" class="regular-text">
                        <option value="Large" <?php echo (get_option('aws_search_response_group') == 'Large') ? 'selected' : '';?>>Large</option>
                        <option value="Small" <?php echo (get_option('aws_search_response_group') == 'Small') ? 'selected' : '';?>>Small</option>
                        <option value="Images" <?php echo (get_option('aws_search_response_group') == 'Images') ? 'selected' : '';?>>Images</option>
                    </select>
                </td>
            </tr>
            <tr>
                <th colspan="2" scope="row"><hr/></th>
            </tr>
            <tr>
                <th colspan="2" scope="row"><label for="blogname">CSS Settings</label></th>
            </tr>
            <tr>
                <th scope="row"><label for="blogname">Search Text Box CSS Class</label></th>
                <td>
                    <input name="aws_search_text_class" id="aws_search_text_class" value="<?php echo get_option('aws_search_text_class') ;?>" class="regular-text" type="text">
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="blogname">Search Category CSS Class</label></th>
                <td>
                    <input name="aws_search_category_class" id="aws_search_category_class" value="<?php echo get_option('aws_search_category_class') ;?>" class="regular-text" type="text">
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="blogname">Search Min / Max Price CSS Class</label></th>
                <td>
                    <input name="aws_search_minmax_class" id="aws_search_minmax_class" value="<?php echo get_option('aws_search_minmax_class') ;?>" class="regular-text" type="text">
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="blogname">Search Condition CSS Class</label></th>
                <td>
                    <input name="aws_search_condition_class" id="aws_search_condition_class" value="<?php echo get_option('aws_search_condition_class') ;?>" class="regular-text" type="text">
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="blogname">Search Button CSS Class</label></th>
                <td>
                    <input name="aws_search_button_class" id="aws_search_button_class" value="<?php echo get_option('aws_search_button_class') ;?>" class="regular-text" type="text">
                </td>
            </tr>
            <tr>
                <td><?php submit_button(); ?></td>
            </tr>
        </tbody>
    </table>
</form>