<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'auth';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// -------------------------------------------------------------------------
// AUTH ROUTES
// -------------------------------------------------------------------------
$route['login'] = 'auth/login';
$route['register'] = 'auth/register';
$route['logout'] = 'auth/logout';
$route['auth/login_process'] = 'auth/login_process';
$route['auth/register_process'] = 'auth/register_process';

// -------------------------------------------------------------------------
// DASHBOARD ROUTES
// -------------------------------------------------------------------------
$route['dashboard'] = 'dashboard/index';

// -------------------------------------------------------------------------
// USER PROFILE ROUTES - PERBAIKAN
// -------------------------------------------------------------------------
$route['profile'] = 'user/profile';
$route['profile/edit'] = 'user/edit_profile';
$route['profile/update'] = 'user/update_profile';  // <-- Route yang hilang
$route['profile/change-password'] = 'user/change_password';

// Alternative routes (untuk kompatibilitas)
$route['user/profile'] = 'user/profile';
$route['user/edit_profile'] = 'user/edit_profile';
$route['user/update_profile'] = 'user/update_profile';
$route['user/change_password'] = 'user/change_password';

// -------------------------------------------------------------------------
// ADMIN ROUTES
// -------------------------------------------------------------------------
$route['admin'] = 'admin/dashboard';
$route['admin/dashboard'] = 'admin/dashboard';
$route['admin/users'] = 'admin/users';
$route['admin/logs'] = 'admin/logs';
$route['admin/reports'] = 'admin/reports';

// Admin user management
$route['admin/view/(:num)'] = 'admin/view/$1';
$route['admin/edit/(:num)'] = 'admin/edit/$1';
$route['admin/delete/(:num)'] = 'admin/delete/$1';
$route['admin/toggle_status/(:num)'] = 'admin/toggle_status/$1';
