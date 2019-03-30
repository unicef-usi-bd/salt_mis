<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});


//Route::get('/', 'DashboardController@index');

//Route::get('/home', 'HomeController@index')->name('home');
//Auth::routes();
//Route::group(['middleware' => ['auth']], function() {
//    Route::get('/', 'DashboardController@index')->name('admin');
//});


//======================================================================================


Auth::routes();
Route::group(['middleware' => ['auth']], function() {
    Route::get('/', 'DashboardController@index');
    Route::get('/dashboard', 'DashboardController@index')->name('admin');
    Route::resource('users', 'UserController'); //Rubiyat



// Security Access Control
    Route::resource('user-groups', 'UserGroupController');
    Route::resource('user-group-levels', 'UserGroupLevelController');
    Route::get('get-user-group-levels', 'UserGroupLevelController@getUserGroupLevelsByAjax');
    Route::get('user-group-levels/create-data/{id}', 'UserGroupLevelController@createData');
    Route::resource('modules', 'ModuleController');
    Route::resource('module-links', 'ModuleLinkController');

    Route::resource('organization-modules', 'OrganizationModuleController');
    Route::get('org-asign-modules/{id}', 'OrganizationModuleController@assignModulesOrganization');
    Route::get('org-assign-mdl-ajax/{id}', 'OrganizationModuleController@addModules');
    Route::get('org-remove-mdl-ajax/{id}', 'OrganizationModuleController@removeModules');

    Route::get('org-add-pages/{id}', 'OrganizationModuleController@addPagesOrganization');
    Route::get('add-remove-pages', 'OrganizationModuleController@addRemovePagesByAjax');
    Route::get('get-link', 'OrganizationModuleController@getLink');

    Route::resource('user-modules', 'UserModuleController');
    Route::get('user-group-level', 'UserModuleController@getUserGroupLevelByAjax');
    Route::get('user-group-level-permission', 'UserModuleController@userGroupLevelPermissionAjax');
    Route::get('action-user-permission', 'UserModuleController@addRemovePermissionByAjax');

    // Setup
    Route::resource('lookup-groups', 'LookupGroupController'); //Rubiyat
    Route::resource('lookup-groups-data', 'LookupGroupDataController'); //Rubiyat
    Route::get('lookup-groups-data/create-data/{id}', 'LookupGroupDataController@createData'); //Rubiyat

    Route::resource('bsti-test-standard','BstiTestStandardController');//jalal
    Route::resource('require-chemical-per-kg','RequireChemicalPerKgController');//jalal
    Route::resource('seller-distributor-profile','SellerDistributorProfileController');//jalal

    Route::resource('crude-salt-details', 'CrudeSaltDetailsController'); //Azharul

    Route::resource('monitoring', 'MonitoringController'); //Azharul



});

