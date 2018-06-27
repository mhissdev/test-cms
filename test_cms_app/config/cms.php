<?php defined('BASEPATH') OR exit('No direct script access allowed');

// Default group for new users
$config['deafult_user_group'] = 'Pending';

// Deny login to groups - USE LOWER CASE
$config['deny_login_groups'] = array('pending', 'suspended');