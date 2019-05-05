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
    Route::resource('organization','OrganizationController');//Rubiyat




    Route::resource('entrepreneur-info', 'EntrepreneurController'); //Azharul
    Route::get('entrepreneur-info/createEntrepreneur/{millInfoId}', 'EntrepreneurController@createEntrepreneur'); //Azharul

    Route::resource('association-setup', 'AssociationSetupController'); //Rubiyat
    Route::get('association-setup/create/{id}', 'AssociationSetupController@create'); //Rubiyat
    Route::resource('item', 'ItemController'); //Rubiyat
    Route::resource('crude-salt-procurement', 'CrudeSaltProcurementController'); //Rubiyat

    Route::resource('certificate-info', 'CertificateController'); //Azharul
    Route::get('certificate-info/createCertificate/{millInfoId}', 'CertificateController@createCertificate'); //Azharul
    Route::resource('qc-info', 'QcController'); //Azharul
    Route::get('qc-info/createQc/{millInfoId}', 'QcController@createQc'); //Azharul
    Route::resource('employee-info', 'EmployeeController'); //Azharul
    Route::get('employee-info/createEmployee/{millInfoId}', 'EmployeeController@createEmployee'); //Azharul
    Route::get('deactivate-mill-profile','MillerInfoController@deactivateMillProfile');


    // modal edit mill information
    Route::post('edit-mill-info', 'MillerInfoController@updateMillInfo'); //Azharul
    Route::post('edit-employee-info', 'EmployeeController@updateEmployeeInfo'); //Azharul
    Route::post('edit-qc-info', 'QcController@updateQcInfo'); //Azharul
    Route::post('edit-certificate-info', 'CertificateController@updateCertificateInfo'); //Azharul
    Route::post('edit-certificate-info-normal', 'CertificateController@updateCertificateInfoNormal'); //Azharul
    Route::post('edit-entrepreneur-info', 'EntrepreneurController@updateEntrepreneurInfo'); //Azharul
    // modal edit mill information

    //transaction
    Route::resource('chemical-purchase','ChemicalPurchaseController');//jalal
    Route::resource('washing-crushing','WashingAndCrushingController');//Rubiyat
    Route::get('crude-salt-stock','WashingAndCrushingController@getCrudeSaltStock');//Rubiyat
    Route::resource('iodized','IodizedController');//jalal
    Route::get('chemical-stock','IodizedController@getChemicalStock');//Rubiyat
    Route::resource('quality-control-testing','QulityControlTestingController');//jalal
    Route::resource('sales-distribution','SalesDistributionController');//jalal
    Route::get('washing-crashing-stock','SalesDistributionController@getWashingCrashingSalt');//jalal
    Route::get('iodize-stock','SalesDistributionController@getIodizeSalt');//jalal

    //Profile
    Route::resource('mill-info', 'MillerInfoController'); //Azharul
    Route::resource('seller-distributor-profile','SellerDistributorProfileController');//jalal
    Route::resource('supplier-profile', 'SupplierProfileController'); //Azharul
    Route::get('supplier-profile/get-district/{id}', 'SupplierProfileController@getDistrictByAjax'); //Azharul

    //Route::get('supplier-profile/get-district', 'SupplierProfileController@getDistrictByAjax'); //Azharul

    Route::get('supplier-profile/get-upazila/{id}', 'SupplierProfileController@getUpazilaByAjax'); //Azharul
    Route::get('supplier-profile/get-union/{id}', 'SupplierProfileController@getUnionByAjax'); //Azharul


    //chemical setup
    Route::resource('crude-salt-details', 'CrudeSaltDetailsController'); //Azharul
    Route::resource('require-chemical-per-kg','RequireChemicalPerKgController');//jalal
    Route::resource('require-chemical-mst','RequireChemicalMstController');//jalal
    Route::resource('require-chemical-chd','RequireChemicalChdController');//
    Route::get('require-chemical-chd/create-data/{id}', 'RequireChemicalChdController@createData'); //jalal

    //monitor
    Route::resource('monitoring', 'MonitoringController'); //Azharul

    //Report
    Route::resource('report-dashboard', 'ReportController');
    Route::resource('test-report', 'ReportTestController');
    Route::get('association-list','ReportController@getAssociationList');//jalal
    Route::get('miller-list/{activStatus}','ReportController@getMillerList');//jalal
    Route::get('monitor-association','ReportController@getMonitorAssociationList');//jalal
    //Route::get('association-list-unicef','ReportController@getAssociationListForUnicef');//jalal
    //Route::get('supplier-list','ReportController@getSupplierList');//jalal
    Route::get('purchase-salt-list','ReportController@getPurchaseSalteList');//jalal
    Route::get('purchase-salt-amount/{itemType}','ReportController@getPurchaseSaltAmount');//jalal
    Route::get('purchase-salt-stock','ReportController@getPurchaseSaltStock');//jalal
    Route::get('process-report','ReportController@getProcessReport');//jalal
    Route::get('sales-item-report','ReportController@getSalesList');//jalal

    Route::get('chemical-item-list','ReportTestController@getChemicalItemList');//Rubiyat
    Route::get('chemical-purchase-report','ReportTestController@getChemicalPurchase');//Rubiyat
    Route::get('chemical-purchase-stock','ReportTestController@getChemicalPurchaseStock');//Rubiyat
    Route::get('monitor-supplier','ReportTestController@getMonitorSupplier');//Rubiyat
    Route::get('supplier-list/{division}/{district}/{value}','ReportTestController@getSupplierList');//Rubiyat

    Route::get('process-stock-report','ReportTestController@getProcessStockReport');//Rubiyat

    Route::get('purchase-salt-item', 'ReportAssociationController@getPurchaseSaltItem'); //azharul
    Route::get('purchase-salt-total', 'ReportAssociationController@getPurchaseSaltTotal');//azharul
    Route::get('purchase-salt-total-stock', 'ReportAssociationController@getPurchaseSaltTotalStock');//azharul

    Route::get('purchase-chemical-item', 'ReportAssociationController@getPurchaseChemicalItem');//azharul
    Route::get('purchase-chemical-total', 'ReportAssociationController@getPurchaseChemicalTotal');//azharul
    Route::get('purchase-chemical-total-stock', 'ReportAssociationController@getPurchaseChemicalTotalStock');//azharul

    Route::get('association-total-miller', 'ReportAssociationController@getTotalMiller');//azharul

    //Report reportPdf
    Route::get('association-list-reportPdf','ReportController@getAssociationListPdf');//jalal
    Route::get('miller-list-pdf/{activStatus}','ReportController@getMillerListPdf');//jalal
    Route::get('chemical-item-list-pdf','ReportTestController@getChemicalItemListPdf');//Rubiyat
    Route::get('chemical-purchase-pdf','ReportTestController@getChemicalPurchasePdf');//Rubiyat
    Route::get('chemical-purchase-stock-pdf','ReportTestController@getChemicalPurchaseStockPdf');//Rubiyat

    Route::get('purchase-salt-list-pdf','ReportController@getPurchaseSalteListPdf');//jalal
    Route::get('purchase-salt-amount-pdf/{itemType}','ReportController@getPurchaseSaltAmountPdf');//jalal
    Route::get('purchase-salt-stock-pdf','ReportController@getPurchaseSaltStockPdf');//jalal

    Route::get('monitor-supplier-pdf','ReportTestController@getMonitorSupplierPdf');//Rubiyat
    Route::get('supplier-list-pdf/{division}/{district}/{value}','ReportTestController@getSupplierListPdf');//Rubiyat
    Route::get('monitor-association-pdf','ReportController@getMonitorAssociationListPdf');//jalal
    Route::get('process-report-pdf','ReportController@getProcessReportPdf');//jalal
    Route::get('sales-item-report-pdf','ReportController@getSalesListPdf');//jalal


});


