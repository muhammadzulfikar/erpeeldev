<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] 			= "forum/login";
$route['register']						= "forum/registration";

$route['404_override'] 					= 'forum/error404';

// route untuk ke halaman index / login forum
$route['forum/index']					= 'forum/login';
// rute untuk ke halaman kategori forum
$route['forum/category/(:any)']			= 'category/index/$1';
// rute untuk ke halaman kategori forum
$route['forum/talk/(:any)']				= 'post/talk/$1';
// rute untuk ke halaman user profile
$route['forum/user_profile/(:any)']		= 'user/user_profile/$1';
// rute untuk melihat thread user
$route['forum/thread_user/(:any)']		= 'thread/thread_user/$1';
// rute untuk melihat post user
$route['forum/post_user/(:any)']		= 'post/post_user/$1';


// rute untuk membuat thread baru
$route['forum/thread_create/(:any)']	= 'thread/thread_create/$1';
// rute untuk mengubah thread
$route['forum/thread_edit/(:any)']		= 'thread/thread_edit/$1';
// rute untuk menghapus thread
$route['forum/thread_delete/(:any)']	= 'thread/thread_delete/$1';
// rute untuk membuat komentar pada thread
$route['forum/reply/(:any)']			= 'post/reply/$1';
// rute untuk mengedit komentar pada thread
$route['forum/reply_edit/(:any)']		= 'post/reply_edit/$1';
// rute untuk menghapus komentar pada thread
$route['forum/reply_delete/(:any)']		= 'post/reply_delete/$1';

$route['forum/library_user/(:any)']		= 'library/library_user/$1';
$route['forum/library_create']			= 'library/library_create';
$route['forum/library_edit/(:any)']		= 'library/library_edit/$1';
$route['forum/library_delete/(:any)']	= 'library/library_delete/$1';

$route['admin/library_view']			= 'library/library_admin_view';


// rute untuk kategori admin
$route['admin/category_view']			= 'category/category_view';
$route['admin/category_create']			= 'category/category_create';
$route['admin/category_edit/(:any)']	= 'category/category_edit/$1';
$route['admin/category_delete/(:any)']	= 'category/category_delete/$1';

// rute untuk thread admin
$route['admin/thread_view']				= 'thread/thread_admin_view';
$route['admin/thread_edit/(:any)']		= 'thread/thread_admin_edit/$1';
$route['admin/thread_delete/(:any)']	= 'thread/thread_admin_delete/$1';

// rute untuk thread admin
$route['admin/user_view']				= 'user/user_view';
$route['admin/user_create']				= 'user/user_create';
$route['admin/user_edit/(:any)']		= 'user/user_edit/$1';
$route['admin/user_delete/(:any)']		= 'user/user_delete/$1';



/* End of file routes.php */
/* Location: ./application/config/routes.php */