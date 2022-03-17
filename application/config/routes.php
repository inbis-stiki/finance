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


// AUTH
$route['login'] = 'Auth/login';
$route['logout'] = 'Auth/logout';

// PROFILE
$route['profile/change-pass'] = 'Profile/changePass';
$route['profile/update']      = 'Profile/update';
$route['profile/(:any)']      = 'Profile/edit/$1';

// ========== MANAGEMENT ==========
$route['management']                                = 'management/Dashboard';
$route['management/set-saldo']                      = 'management/Dashboard/setSaldo';
$route['management/cost-kendaraan/(:any)/(:any)']   = 'management/Dashboard/costKendaraan/$1/$2';
$route['management/ajxUpdateGlobalCost']            = 'management/Dashboard/ajxUpdateGlobalCost';
$route['management/ajxUpdateCostArea']              = 'management/Dashboard/ajxUpdateCostArea';
$route['management/ajxUpdateSparepart']             = 'management/Dashboard/ajxUpdateSparepart';
$route['management/ajxUpdateJenisBiayaSparepart']   = 'management/Dashboard/ajxUpdateJenisBiayaSparepart';
$route['management/ajxUpdateJenisPengeluaran']      = 'management/Dashboard/ajxUpdateJenisPengeluaran';
$route['management/ajxUpdateCostPT']                = 'management/Dashboard/ajxUpdateCostPT';
// ========== END MANAGEMENT ========== 

// ========== ADMIN ==========
$route['admin'] = 'admin/Dashboard';
// peminjaman
$route['admin/peminjaman']          = 'admin/Peminjaman';
$route['admin/peminjaman/store']    = 'admin/Peminjaman/store';
$route['admin/peminjaman/ajxGetKendaraanPeminjaman']    = 'admin/Peminjaman/ajxGetKendaraanPeminjaman';
// transaksi
$route['admin/transaksi']                         = 'admin/Transaksi';
$route['admin/transaksi/store-administrasi']      = 'admin/Transaksi/storeAdministrasi';
$route['admin/transaksi/store-maintenance']       = 'admin/Transaksi/storeMaintenance';
$route['admin/transaksi/store-expense']           = 'admin/Transaksi/storeExpense';
$route['admin/transaksi/ajxKdBarang']             = 'admin/Transaksi/ajxKdBarang';
// report
$route['admin/report/administrasi/(:any)']  = 'admin/Report/administrasi/$1';
$route['admin/report/maintenance/(:any)']   = 'admin/Report/maintenance/$1';
// ========== END ADMIN ==========

// ========== MASTER ==========
// driver
$route['master/driver']                     = 'master/Driver';
$route['master/driver/add']                 = 'master/Driver/vAdd';
$route['master/driver/edit/(:any)']         = 'master/Driver/vEdit/$1';
$route['master/driver/store']               = 'master/Driver/store';
$route['master/driver/update']              = 'master/Driver/update';
$route['master/driver/assign']              = 'master/Driver/assign';
$route['master/driver/destroy']             = 'master/Driver/destroy';
// klien
$route['master/klien']              = 'master/Klien';
$route['master/klien/store']        = 'master/Klien/store';
$route['master/klien/update']       = 'master/Klien/update';
$route['master/klien/destroy']      = 'master/Klien/destroy';
$route['master/klien/ajxGetKlien']  = 'master/Klien/ajxGetKlien';
// dropdown
$route['master/dropdown']           = 'master/Dropdown';
$route['master/dropdown/store']     = 'master/Dropdown/store';
$route['master/dropdown/update']    = 'master/Dropdown/update';
$route['master/dropdown/destroy']   = 'master/Dropdown/destroy';
// sparepart
$route['master/sparepart']           = 'master/Sparepart';
$route['master/sparepart/store']     = 'master/Sparepart/store';
$route['master/sparepart/update']    = 'master/Sparepart/update';
$route['master/sparepart/destroy']   = 'master/Sparepart/destroy';
// kendaraan
$route['master/kendaraan']              = 'master/Kendaraan';
$route['master/kendaraan/add']          = 'master/Kendaraan/vAdd';
$route['master/kendaraan/edit/(:any)']  = 'master/Kendaraan/vEdit/$1';
$route['master/kendaraan/store']        = 'master/Kendaraan/store';
$route['master/kendaraan/update']       = 'master/Kendaraan/update';
$route['master/kendaraan/change-stnk']  = 'master/Kendaraan/changeSTNK';
$route['master/kendaraan/ajxGet']       = 'master/Kendaraan/ajxGetKendaraan';
$route['master/kendaraan/destroy']      = 'master/Kendaraan/destroy';
// jenis pengeluaran
$route['master/pengeluaran']           = 'master/Pengeluaran';
$route['master/pengeluaran/store']     = 'master/Pengeluaran/store';
$route['master/pengeluaran/update']    = 'master/Pengeluaran/update';
$route['master/pengeluaran/destroy']   = 'master/Pengeluaran/destroy';
// ========== END MASTER ==========

// ========== SUPER ==========
$route['super/pengguna']                    = 'super/Pengguna';
$route['super/pengguna/store']              = 'super/Pengguna/store';
$route['super/pengguna/update']             = 'super/Pengguna/update';
$route['super/pengguna/reset-password']     = 'super/Pengguna/resetPassword';
$route['super/pengguna/destroy']            = 'super/Pengguna/destroy';
// ========== END SUPER ==========

// ========== CRONJOB ==========
$route['cronjob/report'] = 'Cronjob/JobReport';
