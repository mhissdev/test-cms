<?php defined('BASEPATH') OR exit('No direct script access allowed');

// Default group for new users
$config['deafult_user_group'] = 'Pending';

// Deny login to groups
$config['deny_login'] = array('Pending', 'Suspended');