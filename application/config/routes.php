<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/


$route['default_controller'] = 'offsicks/index';

// Auth
$route['auth/login']['get'] = 'auth/login_pre';
$route['auth/login']['post'] = 'auth/login_post';
$route['auth/password_reset']['get'] = 'auth/password_reset_pre';
$route['auth/password_reset']['post'] = 'auth/password_reset_post';
$route['auth/logout'] = 'auth/logout';

// Nutrition API
$route['api/nutrition/store'] = 'nutritions/store';
$route['api/nutrition/(:num)/update'] = 'nutritions/update/$1';
$route['api/nutrition/(:num)/delete'] = 'nutritions/destroy/$1';

// Teams
$route['teams'] = 'teams/index';


$route['teams/create'] = 'teams/create';
$route['teams/(:num)/edit'] = 'teams/edit/$1';
$route['teams/(:num)/update'] = 'teams/update/$1';
$route['teams/(:num)/delete'] = 'teams/destroy/$1';
$route['teams/store'] = 'teams/store';

// Teams API
$route['api/teams'] = 'teams/all';
$route['api/teams/(:num)/delete'] = 'teams/destroy/$1';

// Injuries API
$route['api/injuries/store'] = 'injuries/store';
$route['api/injuries/(:num)/update'] = 'injuries/update/$1';
$route['api/injuries/(:num)/delete'] = 'injuries/destroy/$1';

// Players
$route['players'] = 'players/index';


$route['players/create'] = 'players/create';
$route['players/(:num)/edit'] = 'players/edit/$1';
$route['players/(:num)/show'] = 'players/show/$1';
$route['players/(:num)/update'] = 'players/update/$1';
$route['players/(:num)/delete'] = 'players/destroy/$1';
$route['players/(:num)/history/pdf'] = 'players/history_to_pdf/$1';
$route['players/store'] = 'players/store';

// Players API
$route['api/players'] = 'players/all';
$route['api/players/(:num)/delete'] = 'players/destroy/$1';
$route['api/players/(:num)/offsick'] = 'players/offsick/$1';
$route['api/players/(:num)/offsick/stage']['post'] = 'offsicks/set_current_stage/$1';
$route['api/players/(:num)/upsick'] = 'players/upsick/$1';
$route['api/players/(:num)/history'] = 'players/injuries/$1';
$route['api/players/(:num)/nutrition'] = 'players/nutrition/$1';
$route['api/players/(:num)/offsicks'] = 'offsicks/for_player/$1';

// Offsicks
$route['offsick/'] = 'offsicks/index';
$route['offsick/create'] = 'offsicks/create';
$route['offsicks/store'] = 'offsicks/store';

// Offsicks API
$route['api/offsicks/all'] = 'offsicks/get_all_offsicks';


$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
