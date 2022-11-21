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
$route['dashboard'] = 'DashboardController/index';
$route['default_controller'] = $route['dashboard'];
// $route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

//login
$route['login'] = 'LoginController/index';
$route['admin-logout'] = 'LoginController/signout';
$route['change-pass'] = 'LoginController/changePWD';
$route['change-password'] = 'LoginController/changePassword';


//banner
$route['edit-banner']="MasterController/updateBanner";
$route['delete-banner']="MasterController/deleteBanner";
$route['banner']="MasterController/banner";
$route['show-banner']="MasterController/showBanners";
$route['add-banner']="MasterController/addBanner";

//category
$route['edit-category']="MasterController/updateCategory";
$route['delete-category']="MasterController/deleteCategory";
$route['category']="MasterController/category";
$route['show-category']="MasterController/ShowCategory";
$route['add-category']="MasterController/addCategory";

//products
$route['edit-product']="MasterController/updateProduct";
$route['delete-product']="MasterController/deleteProduct";
$route['products']="MasterController/products";
$route['show-product']="MasterController/ShowProducts";
$route['add-product']="MasterController/addProduct";
$route['select-category']="MasterController/selectCategory";

//advertise
$route['left-advertise']="AdvertiseController/leftAdvertise";
$route['show-left-advertise']="AdvertiseController/showLeftAdvertise";
$route['add-left-advertise']="AdvertiseController/addLeftAdvertise";
$route['edit-left-advertise']="AdvertiseController/updateLeftAdvertise";
$route['delete-left-advertise']="AdvertiseController/deleteLeftAdvertise";

$route['company']="AdminController/list";
$route['show-company']="AdminController/showCompany";
$route['add-company']="AdminController/addCompany";
$route['edit-company']="AdminController/updateCompany";
$route['delete-company']="AdminController/deleteCompany";
$route['contactList']="AdminController/contactList";



$route['contact']="CompanyController/list";
$route['show-contact']="CompanyController/showContacts";
$route['add-contact']="CompanyController/addContact";
$route['edit-contact']="CompanyController/updateContact";
$route['delete-contact']="CompanyController/deleteContact";
$route['own-profile']="CompanyController/companyProfile";
$route['edit-company-profile']="CompanyController/updateCompanyProfile";
//user
$route['employees-profile']="EmployeeController/employeeProfile";
$route['employees']="EmployeeController/employees";
$route['show-employee']="EmployeeController/showEmployees";
$route['select-department']="EmployeeController/selectDepartment";
$route['add-employee']="EmployeeController/addEmployee";
$route['delete-employee']="EmployeeController/deleteEmployee";
$route['check-email']="EmployeeController/checkEmail";
$route['edit-employee']="EmployeeController/updateEmployee";

//order
$route['orders']="OrderController/orders";
$route['show-orders']="OrderController/ShowOrders";
$route['view-order']="OrderController/getorderById";

//shop setting
$route['general-setting']="MasterController/shopSetting";
$route['shop-setting']="MasterController/updateSetting";
