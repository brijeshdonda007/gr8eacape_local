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
|	$route['default_controller'] = 'home';
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

$route['default_controller'] = "home";
$route['404_override'] = '';
//route for pages
$route['search/(:any)'] = 'search/$1';
$route['search'] = 'search';
$route['login'] = 'login';
$route['login/(:any)'] = 'login/$1';

//ADD ESCAPE
$route['addescape']                      = 'addescape';
$route['Addescape/saveInformation']      = 'addescape/saveInformation';
$route['Addescape/updateEscape']      	 = 'addescape/updateEscape';
$route['addescape/(:any)']               = 'addescape/$1';
$route['addescape/(:any)/(:any)']        = 'addescape/$1/$2';
$route['Addescape/getImageGallery']      = 'addescape/getImageGallery';
$route['Addescape/uploadEscapeImages']   = 'addescape/uploadEscapeImages';
$route['Addescape/deleteEscapeImages/(:any)'] 	 = 'addescape/deleteEscapeImages/$1';
$route['Addescape/insertEscape']      	 = 'addescape/insertEscape';


//ajax
$route['ajax'] = 'ajax';
$route['ajax/(:any)'] = 'ajax/$1';
$route['ajax/(:any)/(:any)'] = 'ajax/$1/$2';

//booking
$route['booking'] = 'booking';
$route['booking/(:any)'] = 'booking/$1';
$route['booking/(:any)/(:any)'] = 'booking/$1/$2';


//buyer
$route['buyer'] = 'buyer';
$route['buyer/(:any)'] = 'buyer/$1';
$route['buyer/(:any)/(:any)'] = 'buyer/$1/$2';

//cancellationpolicy
$route['cancellationpolicy'] = 'cancellationpolicy';
$route['cancellationpolicy/(:any)'] = 'cancellationpolicy/$1';
$route['cancellationpolicy/(:any)/(:any)'] = 'cancellationpolicy/$1/$2';


//category
$route['category'] = 'category';
$route['category/(:any)'] = 'category/$1';
$route['category/(:any)/(:any)'] = 'category/$1/$2';


//city
$route['city']               = 'city';
//$route['city/(:any)']        = 'city/$1';
//$route['city/(:any)/(:any)'] = 'city/$1/$2';


//location
$route['region/(:any)/city/(:any)'] = 'city/city/index';
$route['country/(:any)']            = 'country/country/index/$1';
$route['region/(:any)']             = 'region/region/index';




//dashboard
$route['dashboard'] = 'dashboard';
$route['dashboard/(:any)'] = 'dashboard/$1';
$route['dashboard/(:any)/(:any)'] = 'dashboard/$1/$2';


//destination
$route['destination'] = 'destination';
$route['destination/(:any)'] = 'destination/$1';
$route['destination/(:any)/(:any)'] = 'destination/$1/$2';


//forgotpassword
$route['forgotpassword'] = 'forgotpassword';
$route['forgotpassword/(:any)'] = 'forgotpassword/$1';
$route['forgotpassword/(:any)/(:any)'] = 'forgotpassword/$1/$2';


//groups
$route['groups'] = 'groups';
$route['groups/(:any)'] = 'groups/$1';
$route['groups/(:any)/(:any)'] = 'groups/$1/$2';

//login
$route['login'] = 'login';
$route['login/(:any)'] = 'login/$1';
$route['login/(:any)/(:any)'] = 'login/$1/$2';


//register
$route['register'] = 'register';
$route['register/(:any)'] = 'register/$1';
$route['register/(:any)/(:any)'] = 'register/$1/$2';


//user
$route['user'] = 'user';
$route['user/(:any)'] = 'user/$1';
$route['user/(:any)/(:any)'] = 'user/$1/$2';
$route['user/editProfile'] = 'user/user/editProfile';
$route['owner/editProfile'] = 'user/user/editProfile';
$route['guest/editProfile'] = 'user/user/editProfile';

$route['user/account/billing']  = 'user/account/billing';
$route['guest/account/billing'] = 'user/account/billing';
$route['owner/account/billing'] = 'user/account/billing';

$route['owner/account/company'] = 'user/account/company';
$route['user/account/company']  = 'user/account/company';



$route['user/escapeList']   = 'user/user/escapeList';
$route['guest/escapeList']  = 'user/user/escapeList';
$route['owner/escapeList']  = 'user/user/escapeList';

$route['owner/bookingRequests']     = 'user/user/bookingRequests';
$route['guest/bookingRequests']     = 'user/user/bookingRequests';
$route['user/bookingRequests']      = 'user/user/bookingRequests';

$route['user/allTransCurrMnth']      = 'user/user/allTransCurrMnth';
$route['guest/allTransCurrMnth']      = 'user/user/allTransCurrMnth';
$route['owner/allTransCurrMnth']      = 'user/user/allTransCurrMnth';

$route['guest/allrequestBuyer']      = 'user/user/allrequestBuyer';
$route['owner/allrequestBuyer']      = 'user/user/allrequestBuyer';
$route['user/allrequestBuyer']       = 'user/user/allrequestBuyer';

$route['guest/notifications']      = 'user/user/notifications';
$route['owner/notifications']      = 'user/user/notifications';
$route['user/notifications']       = 'user/user/notifications';

$route['guest/changePassword']      = 'user/user/changePassword';
$route['owner/changePassword']      = 'user/user/changePassword';
$route['user/changePassword']       = 'user/user/changePassword';

$route['user/allPendingTransCurrMnth']       = 'user/user/allPendingTransCurrMnth';
$route['owner/allPendingTransCurrMnth']       = 'user/user/allPendingTransCurrMnth';


$route['user/allTransCurrMnth']      = 'user/user/allTransCurrMnth';
$route['owner/allTransCurrMnth']     = 'user/user/allTransCurrMnth';


$route['user/mainEarning']          = 'user/owner/mainEarning';
$route['owner/mainEarning']         = 'user/owner/mainEarning';


$route['user/changePassword']       = 'user/user/changePassword';
$route['owner/changePassword']      = 'user/user/changePassword';
$route['guest/changePassword']      = 'user/user/changePassword';

//User profile page
$route['owner']                     = 'user/owner/index';
$route['guest']                     = 'user/guest/index';

//settings
$route['settings']                  = 'settings';
$route['settings/(:any)']           = 'settings/$1';
$route['settings/(:any)/(:any)']    = 'settings/$1/$2';


//verification
$route['verification'] = 'verification';
$route['verification/(:any)'] = 'verification/$1';
$route['verification/(:any)/(:any)'] = 'verification/$1/$2';

//verification
$route['suburb'] = 'suburb';
$route['suburb/(:any)'] = 'suburb/$1';
//$route['suburb/index/(:any)'] = 'suburb/index/$1';


$route['search'] = 'search';
$route['company'] = 'company/index';


$route['home'] = 'home';
$route['register'] = 'register';
$route['logout'] = 'logout';

//$route['city/index/(:any)'] = 'city/index/$1';
//$route['region/index/(:any)'] = 'region/index/$1';

$route['category/lists']            = 'category/lists';
$route['escapedetails/(:any)']      = 'escapedetails/index/$1';
$route['migrate/(:any)']	        = 'migrate/index/$1';
$route['addescape/(:any)']          = 'addescape/index/$1';
$route['addescape/delete']          = 'addescape/addescape/deleteEscape';

$route['admin/pages/list'] = 'admin/page_list';
$route['admin/pages/add'] = 'admin/page_loadform';
$route['admin/pages/edit/(:any)'] = 'admin/editpage/$1';

$route['admin/admins/list'] = 'admin/admins_lists';
$route['admin/admins/add'] = 'admin/addadmin';
$route['admin/admins/edit/(:any)'] = 'admin/editAdmin/$1';

$route['admin/users/list'] = 'admin/users_lists';
$route['admin/users/add'] = 'admin/adduser';
$route['admin/users/edit/(:any)'] = 'admin/editUser/$1';
$route['admin'] = 'admin/index';
$route['admin/(:any)'] = 'admin/$1';
$route['admin/(:any)/(:any)'] = 'admin/$1/$2';
$route['admin/(:any)/(:any)/(:any)'] = 'admin/$1/$2/$3';
$route['admin/index'] = 'admin/index';
$route['admin/login'] = 'admin/login';
$route['admin/logout'] = 'admin/logout';


$route['admin/groups/list'] = 'admin/group_lists';
$route['admin/groups/add'] = 'admin/addgroup';
$route['admin/groups/edit/(:any)'] = 'admin/editGroup/$1';

$route['admin/booking/list'] = 'admin/order_lists';

$route['admin/location/country/list'] = 'admin/countryList';
$route['admin/location/country/add'] = 'admin/newCountry';
$route['admin/location/country/edit/(:any)'] = 'admin/editCountry/$1';

$route['admin/location/region/list'] = 'admin/regionList';
$route['admin/location/region/add'] = 'admin/newRegion';
$route['admin/location/region/edit/(:any)'] = 'admin/editRegion/$1';

$route['admin/location/city/list'] = 'admin/cityList';
$route['admin/location/city/add'] = 'admin/newCity';
$route['admin/location/city/edit/(:any)'] = 'admin/editCity/$1';

$route['admin/location/suburb/list'] = 'admin/suburbList';
$route['admin/location/suburb/add'] = 'admin/newsuburb';
$route['admin/location/suburb/edit/(:any)'] = 'admin/editsuburb/$1';

$route['admin/escapes/list'] = 'admin/escapeList';
$route['admin/escapes/detail/(:any)'] = 'admin/escapeDetail/$1';

$route['admin/categories/list'] = 'admin/categoryList';
$route['admin/categories/add'] = 'admin/loadcategoryform';
$route['admin/categories/edit/(:any)'] = 'admin/editCategory/$1';

$route['admin/categories/escapes/facilities'] = 'admin/propertyFacilities';
$route['admin/categories/escapes/skychannels'] = 'admin/skyChannels';

$route['admin/banners/list'] = 'admin/banner_list';
$route['admin/banners/add'] = 'admin/loadBannerForm';
$route['admin/banners/edit/(:any)'] = 'admin/editbanner/$1';

/*$route['admin/earning/list'] = 'admin/earning_lists';*/
//$route['admin/report/(:any)'] = 'admin/report/$1';

$route['admin/testimonials/list'] = 'admin/view_all_testi';
$route['admin/testimonials/add'] = 'admin/newTesti';
$route['admin/testimonials/edit/(:any)'] = 'admin/editTesti/$1';

$route['admin/subscribers/list'] = 'admin/subscriber_all';

$route['admin/menu/edit/(:any)'] = 'admin/editmenu/$1';
$route['admin/menu/section/list'] = 'admin/section_list';
$route['admin/menu/section/add'] = 'admin/section_add';

$route['admin/email_template/list']                      = 'admin/list_mail_templates';
$route['admin/email_template/forget']                    = 'admin/forget_mail_template';
$route['admin/email_template/register']                  = 'admin/reg_confirm_mail_template';
$route['admin/email_template/activated']                 = 'admin/activated_mail_template';
$route['admin/email_template/booking_request_to_buyer']  = 'admin/booking_mail_template_to_buyer';
$route['admin/email_template/booking_request_to_owner']  = 'admin/booking_mail_template_to_owner';
$route['admin/email_template/booking_to_buyer']          = 'admin/booking_direct_mail_template_to_buyer';
$route['admin/email_template/booking_to_owner']          = 'admin/booking_direct_mail_template_to_owner';
$route['admin/email_template/pre_confirmation_email']    = 'admin/pre_confirmation_email';
$route['admin/email_template/post_confirmation_email']   = 'admin/post_confirmation_email';


$route['(:any)']                                         = 'content/view/$1';

//Mail Module
$route['mail/message/new']                               = 'mail/mail/newMessage';
$route['mail/message/save']                              = 'mail/mail/saveMessage';
$route['mail/message/read']                              = 'mail/mail/readMessage';
$route['mail/message/inbox']                             = 'mail/mail/inbox';
$route['mail/message/outbox']                            = 'mail/mail/outbox';
$route['mail/message/delete']                            = 'mail/mail/deleteMessage';
$route['mail/message/bulkDelete']                        = 'mail/mail/deleteBulkMessage';




/* End of file routes.php */
/* Location: ./application/config/routes.php */