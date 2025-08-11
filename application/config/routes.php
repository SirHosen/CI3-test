<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'auth';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// Auth routes
$route['login'] = 'auth/login';
$route['register'] = 'auth/register';
$route['logout'] = 'auth/logout';

// Dashboard
$route['dashboard'] = 'dashboard/index';

// User Profile routes - PERBAIKI ROUTE INI
$route['profile'] = 'user/profile';
$route['user/profile'] = 'user/profile';
$route['user/edit_profile'] = 'user/edit_profile';
$route['user/update_profile'] = 'user/update_profile';
$route['user/change_password'] = 'user/change_password';

// Admin routes dengan parameter
$route['admin/users/view/(:num)'] = 'admin/view/$1';
$route['admin/users/edit/(:num)'] = 'admin/edit/$1';
$route['admin/users/delete/(:num)'] = 'admin/delete/$1';
$route['admin/edit/(:num)'] = 'admin/edit/$1';
$route['admin/view/(:num)'] = 'admin/view/$1';
$route['admin/delete/(:num)'] = 'admin/delete/$1';

// Tambahkan route ini
$route['admin/toggle_status/(:num)'] = 'admin/toggle_status/$1';
