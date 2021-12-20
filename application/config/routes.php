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
$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['adm_login'] = 'admin/Auth';
$route['admin/dashboard'] = 'admin/Admin';
$route['admin/form_pengajuan'] = 'admin/Admin/form_pengajuan';
$route['admin/master_sparepart'] = 'admin/Admin/master_sparepart';
$route['admin/master_region'] = 'admin/Admin/master_region';
$route['admin/master_klien'] = 'admin/Admin/master_klien';
$route['admin/master_pengeluaran'] = 'admin/Admin/master_pengeluaran';
$route['admin/master_kendaraan'] = 'admin/Admin/master_kendaraan';
$route['admin/master_dropdown'] = 'admin/Admin/master_dropdown';
$route['admin/master_driver'] = 'admin/Admin/master_driver';
$route['master_region'] = 'admin/Master_region';
$route['simpan_region'] = 'admin/Master_region/simpan_region';
$route['add_region'] = 'admin/Master_region/addRegion';
$route['admin/master_kendaraan/add_kendaraan'] = 'admin/Admin/tambah_kendaraan';

// Driver
$route['admin/tambah_driver']       = 'admin/Admin/tambah_driver';
$route['admin/ubah_driver/(:any)']  = 'admin/Admin/ubah_driver/$1';
$route['admin/aksiTambahDriver']    = 'admin/Driver/aksiTambahDriver';
$route['admin/aksiUbahDriver']      = 'admin/Driver/aksiUbahDriver';

// Kendaraan
$route['admin/aksiTambahKendaraan']      = 'admin/Master_kendaraan/aksiTambahKendaraan';
$route['admin/ubah_kendaraan/(:any)']  = 'admin/Admin/ubah_kendaraan/$1';
$route['admin/aksiUbahKendaraan']      = 'admin/Master_kendaraan/aksiUbahKendaraan';
$route['admin/ubah_stnk/(:any)']  = 'admin/Admin/ubah_stnk/$1';
$route['admin/aksiUbahStnk']      = 'admin/Master_kendaraan/aksiUbahStnk';

// Pencatatan
$route['admin/form_pengajuan/unit_kendaraan'] = 'admin/Admin/unit_kendaraan';
$route['admin/form_pengajuan/jenis_biaya'] = 'admin/Admin/jenis_biaya';
