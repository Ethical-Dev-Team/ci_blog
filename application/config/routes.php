<?php
defined('BASEPATH') OR exit('No direct script access allowed');



$route['default_controller'] = 'pages/view';


//user routes
$route['users/register'] = 'users/register';
$route['users/dashboard'] = 'users/dashboard';

$route['categories'] = 'category/index';
$route['categories/create'] = 'category/create';
$route['categories/posts/(:any)'] = 'category/posts/$1';
$route['categories/delete/(:any)'] = 'category/delete/$1';

$route['view_galleries']='galleries/view_get_gallery_images';
$route['posts/index'] = 'posts/index';
$route['posts/update'] = 'posts/update';
$route['posts/delete/(:any)'] = 'posts/delete/$1';
$route['posts/create'] = 'posts/create';
$route['posts/(:any)'] = 'posts/view/$1';
$route['posts'] = 'posts/index';





//admin routs
$route['administrator'] = 'administrator/view';
$route['administrator/home'] = 'administrator/home';
$route['administrator/index'] = 'administrator/view';
$route['administrator/forget-password'] = 'administrator/forget_password';

$route['administrator/dashboard'] = 'administrator/dashboard';

$route['administrator/change-password'] = 'administrator/get_admin_data';
$route['administrator/update-profile'] = 'administrator/update_admin_profile';

$route['administrator/users/add-user'] = 'administrator/add_user';
$route['administrator/users'] = 'administrator/users';
$route['administrator/users/update-user/(:any)'] = 'administrator/update_user/$1';

$route['administrator/blogs/add-blog'] = 'administrator/add_blog';
$route['administrator/blogs/list-blog'] = 'administrator/list_blog';
$route['administrator/blogs/update-blog'] = 'administrator/update_blog';


$route['administrator/faq-categories/create'] = 'administrator/create_faq_category';
$route['administrator/faq-categories/update/(:any)'] = 'administrator/update_faq_category/$1';
$route['administrator/faq-categories'] = 'administrator/faq_categories';

$route['administrator/faq/create'] = 'administrator/create_faq';
$route['administrator/faqs'] = 'administrator/get_faqs';
$route['administrator/faqs/update/(:any)'] = 'administrator/update_faqs/$1';


$route['administrator/galleries/add'] = 'galleries/galleriesLoad';
$route['administrator/galleries'] = 'galleries/get_gallery_images';










$route['(:any)'] = 'pages/view/$1';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;










