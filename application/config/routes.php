<?php
defined('BASEPATH') or exit('No direct script access allowed');

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
|	https://codeigniter.com/userguide3/general/routing.html
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
$route['default_controller'] = 'dashboard';
$route['public'] = "dashboard/index";
$route['berita/(:num)'] = "dashboard/newsDetails/$1";
$route['hapusBerita/(:num)'] = "dashboard/hapusBerita/$1";
$route['simpanEditBerita/(:num)'] = "dashboard/simpanEditBerita/$1";
$route['editBerita/(:num)'] = "dashboard/editBerita/$1";
$route['hapusUmkm/(:num)'] = "dashboard/hapusUmkm/$1";
$route['simpanEditUmkm/(:num)'] = "dashboard/simpanEditUmkm/$1";
$route['editUmkm/(:num)'] = "dashboard/editUmkm/$1";
$route['hapusPD/(:num)'] = "dashboard/hapusPD/$1";
$route['simpanEditPD/(:num)'] = "dashboard/simpanEditPD/$1";
$route['editPD/(:num)'] = "dashboard/editPD/$1";
$route['modeRahasia'] = "dashboard/daftarKKN/";
$route['tambahModeRahasia'] = "dashboard/tambahKKN/";
$route['simpanModeRahasia'] = "dashboard/simpanKKN/";
$route['hapusModeRahasia/(:num)'] = "dashboard/hapusKKN/$1";
$route['simpanEditModeRahasia/(:num)'] = "dashboard/simpanEditKKN/$1";
$route['editModeRahasia/(:num)'] = "dashboard/editKKN/$1";
$route['(:any)'] = "dashboard/$1";
$route['404_override'] = 'errors/page_missing.php';
$route['translate_uri_dashes'] = FALSE;
