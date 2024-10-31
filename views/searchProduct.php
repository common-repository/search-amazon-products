<?php
$productDisplayArr = array();
$productDisplayArr['Image'] = (get_option('aws_search_image_flag') == 1) ? 1 : 0;
$productDisplayArr['Title'] = (get_option('aws_search_title_flag') == 1) ? 1 : 0;
$productDisplayArr['ASIN'] = (get_option('aws_search_asin_flag') == 1) ? 1 : 0;
$productDisplayArr['Parent'] = (get_option('aws_search_parent_asin_flag') == 1) ? 1 : 0;
$productDisplayArr['Manufacturer'] = (get_option('aws_search_manufacturer_flag') == 1) ? 1 : 0;
$productDisplayArr['Price'] = (get_option('aws_search_product_price_flag') == 1) ? 1 : 0;

if (isset($_POST['submit'])) {
    require ( plugin_dir_path(__FILE__) . '../lib/settings.php' );
    $keyword = (isset($_POST['productSearchTerm']) && $_POST['productSearchTerm'] != '') ? strip_tags($_POST['productSearchTerm']) : '';
    $category = (isset($_POST['category']) && $_POST['category'] != '') ? strip_tags($_POST['category']) : 'All';
    $condition = (isset($_POST['condition']) && $_POST['condition'] != '') ? strip_tags($_POST['condition']) : 'New';
    $minPrice = (isset($_POST['minPrice']) && $_POST['minPrice'] != '') ? strip_tags($_POST['minPrice']) : '';
    $maxPrice = (isset($_POST['maxPrice']) && $_POST['maxPrice'] != '') ? strip_tags($_POST['maxPrice']) : '';

    if (!empty($_POST['productSearchTerm'])) {
        try {
            $amazonEcs->returnType(AmazonECS::RETURN_TYPE_ARRAY);
            $amazonEcs->category($category);
            $optionalParams = array(
                'Condition' => $condition,
                'MinimumPrice' => !empty($minPrice) ? $minPrice : 0,
                'MaximumPrice' => !empty($maxPrice) ? $maxPrice : $minPrice,
            );
            $amazonEcs->optionalParameters($optionalParams);
            $amazonEcs->responseGroup('Large');
            $response = $amazonEcs->search($keyword);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
?>
<form action="" method="POST" name="searchProduct">
<table class="widefat fixed" cellspacing="0">
    <tr>
        <td width="100%" align="center" colspan="2">
            <input class="<?php echo get_option('aws_search_text_class'); ?>" type="text" size="50" name="productSearchTerm" value="<?php echo isset($keyword) ? $keyword : '';?>" placeholder="Enter Product Term To Search On Amazon.com"/>
        </td>
    </tr>
    <tr>
        <?php if(get_option('aws_search_category_flag') == 1) :?>
            <td width="30%">Search Category</td>
            <td>
                <select name="category" class="<?php echo get_option('aws_search_category_class'); ?>">
                    <option value="">Select Search Category</option>
                    <option <?php echo (isset($category) && $category == 'Apparel') ? 'selected' : '';?> value="Apparel">Apparel</option>
                    <option <?php echo (isset($category) && $category == 'Automotive') ? 'selected' : '';?> value="Automotive">Automotive</option>
                    <option <?php echo (isset($category) && $category == 'Books') ? 'selected' : '';?> value="Books">Books</option>
                    <option <?php echo (isset($category) && $category == 'DVD') ? 'selected' : '';?> value="DVD">DVD</option>
                    <option <?php echo (isset($category) && $category == 'Electronics') ? 'selected' : '';?> value="Electronics">Electronics</option>
                    <option <?php echo (isset($category) && $category == 'Music') ? 'selected' : '';?> value="Music">Music</option>
                    <option <?php echo (isset($category) && $category == 'Video') ? 'selected' : '';?> value="Video">Video</option>
                    <option <?php echo (isset($category) && $category == 'Watch') ? 'selected' : '';?> value="Watch">Watch</option>
                </select>
            </td>
        <?php endif;
        if(get_option('aws_search_price_flag') == 1) :?>
            <tr>
                <td>
                    <input class="<?php echo get_option('aws_search_minmax_class'); ?>" placeholder="Minimum Price" size="20" type="text" id="minPrice" name="minPrice" value="<?php echo isset($minPrice) ? $minPrice : ''; ?>"/>
                </td>
                <td>
                    <input class="<?php echo get_option('aws_search_minmax_class'); ?>" size="20" placeholder="Maximum Price" type="text" id="maxPrice" name="maxPrice" value="<?php echo isset($maxPrice) ? $maxPrice : ''; ?>"/>
                </td>
            </tr>
        <?php endif;?>
    </tr>
    <?php if(get_option('aws_search_condition_flag') == 1) :?>
    <tr>
        <td>Product Condition</td>
        <td>
            <select name="condition" class="<?php echo get_option('aws_search_condition_class'); ?>">
                <option <?php echo (isset($condition) && $condition == 'New') ? 'selected' : ''; ?> value="New">New</option>
                <option <?php echo (isset($condition) && $condition == 'Used') ? 'selected' : ''; ?> value="Used">Used</option>
                <option <?php echo (isset($condition) && $condition == 'Refurbished') ? 'selected' : ''; ?> value="Refurbished">Refurbished</option>
            </select>
        </td>
    </tr>
    <?php endif;?>
    <tr>
        <td colspan="2" align="center">
            <input type="submit" name="submit" value="Search" class="<?php echo get_option('aws_search_button_class'); ?>"/>
        </td>
    </tr>
</table>
</form>
<table class="widefat fixed" cellspacing="0">
    <tr>
        <?php foreach($productDisplayArr as $k=>$param) :
            echo ($param == 1) ? '<th>'.$k.'</th>' : '';
            endforeach;?>
    </tr>
    <?php
    if (isset($response['Items']['TotalResults']) && $response['Items']['TotalResults'] != 0):
        $html = '';
        foreach ($response['Items']['Item'] as $item):
            $asin = isset($item['ASIN']) ? $item['ASIN'] : '';
            $parentAsin = isset($item['ParentASIN']) ? $item['ParentASIN'] : '';
            $title = isset($item['ItemAttributes']['Title']) ? $item['ItemAttributes']['Title'] : '';
            $manufacturer = isset($item['ItemAttributes']['Manufacturer']) ? $item['ItemAttributes']['Manufacturer'] : '';
            $thumbImage = isset($item['SmallImage']['URL']) ? $item['SmallImage']['URL'] : '';
            $detailsLink = isset($item['ItemLinks']['ItemLink'][0]['URL']) ? $item['ItemLinks']['ItemLink'][0]['URL'] : 'https://www.amazon.com/s?field-keywords='.$asin;
            $price = isset($item['ItemAttributes']['ListPrice']['FormattedPrice']) ? $item['ItemAttributes']['ListPrice']['FormattedPrice'] : '';
            $html.= '<tr>';
            $html .= (isset($productDisplayArr['Image']) && $productDisplayArr['Image'] == 1 && !empty($thumbImage)) ? '<td><img src="'.$thumbImage.'" alt="'.$title.'"></td>' : '';
            $html .= (isset($productDisplayArr['ASIN']) && $productDisplayArr['ASIN'] == 1) ? '<td><a href="'.$detailsLink.'" target="_blank">' . $asin . '</a></td>' : '';
            $html .= (isset($productDisplayArr['Parent']) && $productDisplayArr['Parent'] == 1) ? '<td>' . $parentAsin . '</td>' : '';
            $html .= (isset($productDisplayArr['Title']) && $productDisplayArr['Title'] == 1) ?'<td><a href="'.$detailsLink.'" target="_blank">' . $title . '</a></td>' : '';
            $html .= (isset($productDisplayArr['Price']) && $productDisplayArr['Price'] == 1) ?'<td><a href="'.$detailsLink.'" target="_blank">' . $price . '</a></td>' : '';
            $html .= (isset($productDisplayArr['Manufacturer']) && $productDisplayArr['Manufacturer'] == 1) ? '<td>' . $manufacturer . '</td>' : '';

            $html .= '</tr>';
        endforeach;
        echo $html;
    endif;
    ?>
</table>