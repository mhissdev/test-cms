<?php defined('BASEPATH') OR exit('No direct script access allowed');

// Site name
$config['site_name'] = 'Test CMS';

// Default group for new users
$config['deafult_user_group'] = 'Admin';

// Deny login to groups
$config['deny_login_groups'] = array('pending', 'suspended');

// Login page releative to base URL
$config['login_url'] = 'account/';

// Image upload directory
$config['image_upload_dir'] = '/uploads/images/';