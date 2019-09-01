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
    Route::get('email-duplicate','UserController@getEmailDuplicateOrNot');//jalal


    // Setup
    Route::resource('lookup-groups', 'LookupGroupController'); //Rubiyat
    Route::resource('lookup-groups-data', 'LookupGroupDataController'); //Rubiyat
    Route::get('lookup-groups-data/create-data/{id}', 'LookupGroupDataController@createData'); //Rubiyat

    Route::resource('bsti-test-standard','BstiTestStandardController');//jalal
    Route::resource('organization','OrganizationController');//Rubiyat
    Route::resource('bsti-test-result-range','BstiTestResultRangeController');//jalal
   // Route::get('bsti-test-result-range','BstiTestStandardController@editBstitestResutlRange');//jalal

    Route::get('users-change-password','UserController@userPasswordChange');//jalal
    Route::post('users-change-password-create','UserController@userChangePasswordPost');//jalal
    Route::put('reset-password','UserController@resetPassword');//jalal



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

    Route::resource('brand', 'BrandController'); //Rubiyat

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
    Route::get('get-packsize','SalesDistributionController@getpackSizeData');//jalal
    Route::get('trading-list','SellerDistributorProfileController@getTradingList');//rubiyat
    Route::get('crude-salt-invoice-list','CrudeSaltDetailsController@getInvoiceList');//rubiyat

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
    Route::get('association-list','ReportController@getAssociationList');//jalal
    Route::get('miller-list/{activStatus}','ReportController@getMillerList');//jalal
    Route::get('monitor-association','ReportController@getMonitorAssociationList');//jalal
    //Route::get('association-list-unicef','ReportController@getAssociationListForUnicef');//jalal
    //Route::get('supplier-list','ReportController@getSupplierList');//jalal
    Route::get('purchase-salt-list','ReportController@getPurchaseSalteList');//jalal
    Route::get('purchase-salt-amount','ReportController@getPurchaseSaltAmount');//jalal
    Route::get('purchase-salt-stock','ReportController@getAdminSaltStock');//jalal
    Route::get('miller-purchase-salt-stock','ReportController@getMillerSaltStock');//jalal
    Route::get('monitor-salt-report','ReportController@getMonitorSaltsupplierList');//jalal
    Route::get('process-report','ReportController@getProcessReport');//jalal
    Route::get('sales-item-report','ReportController@getSalesList');//jalal
    Route::get('sales-item-report-all','ReportController@getSalesListAll');//jalal
    Route::get('miller-license-report/{zone}','ReportController@getListofMillerLicenses');//jalal
    Route::get('qc-report/{zone}','ReportController@getQcreport');//jalal
    Route::get('hr-report/{zone}','ReportController@getHrreport');//jalal
    Route::get('purchase-salt-supplier-miller','ReportController@getListSupplierForMiller');//jalal
    Route::get('purchase-salt-supplier-miller-type','ReportController@getListSupplierWithNameForMiller');//jalal
    Route::get('clint-list-miller','ReportController@getClintListFormiller');//jalal
    Route::get('sale-clint-list-miller','ReportController@getSaleClintList');//jalal
    Route::get('monitor-clint-list-miller','ReportController@getMonitorClintListMiller');//jalal
    Route::get('item-stock-miller','ReportController@getItemStockMiller');//jalal
    Route::get('hr-employee-miller','ReportController@getTotalMillerEmployee');//jalal
    Route::get('admin-hr-employee-miller','ReportController@getAdminHrEmployee');//jalal
    Route::get('admin-association-list','ReportController@getAssociationListForAdmin');//jalal
    Route::get('total-sale-admin','ReportController@getTotalSaleAdmin');//jalal
    route::get('miller-under-association','ReportController@getListOfMiller');//jala
    route::get('process-stock-admin','ReportController@getProcessReportAdmin');//jalal
    route::get('qc-miller','ReportController@getQcformiller');//jalal


    Route::get('chemical-item-list','ReportController@getChemicalItemList');//Rubiyat
    Route::get('chemical-purchase-report','ReportController@getChemicalPurchase');//Rubiyat
    Route::get('chemical-purchase-stock','ReportController@getChemicalPurchaseStock');//Rubiyat
    Route::get('miller-chemical-purchase-stock','ReportController@getMillerChemicalPurchaseStock');//Rubiyat
    Route::get('monitor-supplier','ReportController@getMonitorSupplier');//Rubiyat



    Route::get('miller-process-stock-report','ReportController@getMillerProcessStockReport');//Rubiyat
    Route::get('miller-process-stock-pdf/{starDate}/{endDate}','ReportController@getMillerProcessStockPdf');//Rubiyat
    Route::get('miller-process-list-report','ReportController@getMillerProcessListReport');//Rubiyat
    Route::get('miller-process-list-pdf/{processType}/{starDate}/{endDate}','ReportController@getMillerProcessListPdf');//Rubiyat

    // Report and PDF for Association
    Route::get('purchase-salt-item', 'ReportAssociationController@getPurchaseSaltItem'); //azharul
    Route::get('purchase-salt-item-pdf', 'ReportAssociationController@getPurchaseSaltItemPdf');//azharul
    Route::get('purchase-salt-total', 'ReportAssociationController@getPurchaseSaltTotal');//azharul
    Route::get('purchase-salt-total-pdf/{starDate}/{endDate}/{itemTypeAssoc}', 'ReportAssociationController@getPurchaseSaltTotalPdf');//azharul
    Route::get('purchase-salt-total-stock', 'ReportAssociationController@getPurchaseSaltTotalStock');//azharul
    Route::get('purchase-salt-total-stock-pdf/{starDate}/{endDate}', 'ReportAssociationController@getPurchaseSaltTotalStockPdf');//azharul
    Route::get('purchase-chemical-item', 'ReportAssociationController@getPurchaseChemicalItem');//azharul
    Route::get('purchase-chemical-item-pdf', 'ReportAssociationController@getPurchaseChemicalItemPdf');//azharul
    Route::get('purchase-chemical-total', 'ReportAssociationController@getPurchaseChemicalTotal');//azharul
    Route::get('purchase-chemical-total-pdf/{starDate}/{endDate}', 'ReportAssociationController@getPurchaseChemicalTotalPdf');//azharul
    Route::get('purchase-chemical-total-stock', 'ReportAssociationController@getPurchaseChemicalTotalStock');//azharul
    Route::get('purchase-chemical-total-stock-pdf/{starDate}/{endDate}', 'ReportAssociationController@getPurchaseChemicalTotalStockPdf');//azharul
    Route::get('association-total-miller', 'ReportAssociationController@getTotalMiller');//azharul
    Route::get('association-total-miller-pdf/{activStatus}', 'ReportAssociationController@getTotalMillerPdf');//azharul
    Route::get('association-miller-type', 'ReportAssociationController@getMillerType');//azharul
    Route::get('association-miller-type-pdf', 'ReportAssociationController@getMillerTypePdf');//azharul
    Route::get('association-monitor-miller', 'ReportAssociationController@getMonitorMiller');//azharul
    Route::get('association-monitor-miller-pdf', 'ReportAssociationController@getMonitorMillerPdf');//azharul
    Route::get('list-of-miller', 'ReportAssociationController@getListOfMiller');//azharul
    Route::get('list-of-miller-pdf', 'ReportAssociationController@getListOfMillerPdf');//azharul
    Route::get('association-miller-list', 'ReportAssociationController@getMillerListForHr');//azharul
    Route::get('association-miller-list-pdf', 'ReportAssociationController@getMillerListForHrPdf');//azharul
    Route::get('qc-miller-list', 'ReportAssociationController@getQcMillerList');//azharul
    Route::get('qc-miller-list-pdf', 'ReportAssociationController@getQcMillerListPdf');//azharul
    Route::get('license-miller-list', 'ReportAssociationController@getLicenseMillerList');//azharul
    Route::get('license-miller-list-pdf/{issueby}/{renawlDate}/{failDate}', 'ReportAssociationController@getLicenseMillerListPdf');//azharul
    Route::get('sale-item-list', 'ReportAssociationController@getSaleItemList');//azharul
    Route::get('sale-item-list-pdf', 'ReportAssociationController@getSaleItemListPdf');//azharul
    Route::get('sale-item-stock', 'ReportAssociationController@getSaleItemStock');//azharul
    Route::get('sale-item-stock-pdf', 'ReportAssociationController@getSaleItemStockPdf');//azharul
    Route::get('assoc-process-stock', 'ReportAssociationController@assocProcessStock');//azharul
    Route::get('assoc-process-stock-pdf', 'ReportAssociationController@assocProcessStockPdf');//azharul
    Route::get('association-sale', 'ReportAssociationController@assocSale');//azharul
    Route::get('association-sale-pdf/{divisionId}/{districtId}', 'ReportAssociationController@assocSalePdf');//azharul
    // Report and PDF for Association End

    //Report reportPdf
    Route::get('association-list-reportPdf','ReportController@getAssociationListPdf');//jalal
    Route::get('miller-list-pdf/{activStatus}','ReportController@getMillerListPdf');//jalal
    Route::get('chemical-purchase-pdf/{starDate}/{endDate}/{itemTypeId}','ReportController@getChemicalPurchasePdf');//Rubiyat
    Route::get('chemical-purchase-stock-pdf/{starDate}/{endDate}','ReportController@getChemicalPurchaseStockPdf');//Rubiyat


    Route::get('purchase-salt-list-pdf','ReportController@getPurchaseSalteListPdf');//jalal
    Route::get('purchase-salt-amount-pdf/{itemType}/{starDate}/{endDate}','ReportController@getPurchaseSaltAmountPdf');//jalal
    Route::get('purchase-salt-stock-pdf/{starDate}/{endDate}','ReportController@getAdminSaltStockPdf');//jalal
    Route::get('miller-purchase-salt-stock-pdf/{starDate}/{endDate}/{itemType}','ReportController@getMillerSaltStockPdf');//jalal
    Route::get('monitor-salt-report-pdf/{starDate}/{endDate}','ReportController@getMonitorSaltsupplierListPdf');//jalal


    Route::get('monitor-supplier-pdf/{starDate}/{endDate}','ReportController@getMonitorSupplierPdf');//Rubiyat
    Route::get('monitor-association-pdf','ReportController@getMonitorAssociationListPdf');//jalal
    Route::get('process-report-pdf/{starDate}/{endDate}','ReportController@getProcessReportPdf');//jalal
    Route::get('sales-item-report-pdf','ReportController@getSalesListPdf');//jalal
    Route::get('sales-item-report-all-pdf','ReportController@getSalesListAllpdf');//jalal
    Route::get('miller-license-report-pdf/{zone}/{issuerId}/{renawlDate}/{failDate}','ReportController@getListofMillerLicensesPdf');//jalal
    Route::get('qc-report-pdf/{zone}','ReportController@getQcreportPdf');//jalal
    Route::get('hr-report-pdf/{zone}','ReportController@getHrreportpdf');//jalal
    Route::get('purchase-salt-supplier-miller-pdf/{divisionId}/{districtId}','ReportController@getListSupplierForMillerPdf');//jalal
    Route::get('purchase-salt-supplier-miller-type-pdf/{divisionId}/{districtId}','ReportController@getListSupplierWithNameForMillerPdf');//jalal
    Route::get('clint-list-miller-pdf/{divisionId}/{districtId}','ReportController@getClintListFormillerPdf');//jalal
    Route::get('sale-clint-list-miller-pdf/{customerId}/{itemTypeId}','ReportController@getSaleClintListPdf');//jalal
    Route::get('monitor-clint-list-miller-pdf','ReportController@getMonitorClintListMillerPdf');//jalal
    Route::get('item-stock-miller-pdf','ReportController@getItemStockMillerPdf');//jalal
    Route::get('hr-employee-miller-pdf','ReportController@getTotalMillerEmployeePdf');//jalal
    Route::get('admin-hr-employee-miller-pdf','ReportController@getAdminHrEmployeePdf');//jalal
    Route::get('admin-association-list-pdf','ReportController@getAssociationListForAdminPdf');//jalal
    Route::get('total-sale-admin-pdf/{divisionId}/{districtId}','ReportController@getTotalSaleAdminPdf');//jalal
    route::get('miller-under-association-pdf/{zone}','ReportController@getListOfMillerpdf');//jala
    route::get('process-stock-admin-pdf/{starDate}/{endDate}','ReportController@getProcessReportAdminPdf');//jalal
    Route::get('chemical-item-list-pdf','ReportController@getChemicalItemListPdf');//Rubiyat
    route::get('qc-miller-pdf','ReportController@getQcformillerPdf');//jalal



});


