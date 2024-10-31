<?php
require_once 'AmazonECS.class.php';
$amazonEcs = new AmazonECS(get_option('aws_api_key'), get_option('aws_secret_key'), 'com', get_option('aws_associate_tag'));
$amazonEcs->associateTag(get_option('aws_associate_tag'));