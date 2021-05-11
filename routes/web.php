<?php

Route::get('/', function () { return redirect('/lala'); });
Route::get('lala','HomeController@home')->name('lala');
Route::get('/home', function () { return view('login'); });

Route::get('/pageAksesKhusus', function(){ return view('pageAksesKhusus'); });
Route::get('/MyProfile','users\ProfilController@show')->name('MyProfile');
Route::patch('/updateprof','users\ProfilController@update')->name('updateprof');

/** Auth */
Route::post('postLogin', 'LoginController@postLogin')->name('postLogin');
Route::post('add', [
    'uses'=> 'RegistrationController@registrationPost',
    'as' => 'add']);
 
Route::get('daftar', 'RegistrationController@create');
Route::get('signin', 'LoginController@getLogin')->name('signin');
Route::get('signout', function(){
    Auth::logout();
    return redirect('/home');
})->name('signout');

/****** ADMIN**/
// perubahan data form
Route::post('edittuser/{id_project}','pv\PKPController@edituser')->name('edittuser');
Route::post('editt/{id_project}','pv\PKPController@edit')->name('editt');
Route::post('sentpkp/{id_project}/{revisi}/{turunan}','pv\PKPController@sentpkp')->name('sentpkp');

/*User Approval*/
Route::get('/userapproval', 'admin\ApprovalController@index')->name('userapproval');
Route::get('userapproval/{id}/update', [
    'uses'=>'admin\ApprovalController@update',
    'as' =>'ua.update']);
Route::get('userapproval/{id}/destroy', [
    'uses'=>'admin\ApprovalController@destroy',
    'as' =>'ua.destroy']);
    
/*User Management*/
Route::get('usermanagement','admin\UserListController@index')->name('usermanagement');
Route::get('showuser/{id}','admin\UserListController@show')->name('showuser');
Route::get('userblok/{id}','admin\UserListController@blok')->name('userblok');
Route::get('openblok/{id}','admin\UserListController@open')->name('openblok');
Route::patch('userupdate/{id}','admin\UserListController@update')->name('userupdate');

/*Data Master*/
Route::patch('storeupdatedept/{id}','datamaster\DepartementController@saveupdateDept')->name('storeupdatedept');
Route::patch('storeupdateBahanBaku/{id}','datamaster\BahanBakuController@saveupdateBahan')->name('storeupdatebahan');

Route::post('AddDepartement','datamaster\DepartementController@adddept')->name('adddept');
Route::post('addbahanrd','datamaster\BahanBakuController@addbahanrd')->name('addbahanrd');
Route::post('AddBahanBaku','datamaster\BahanBakuController@addbahan')->name('addbahan');
Route::post('checktabulasi','datamaster\TabulasiController@pilih')->name('checktabulasi');
Route::post('update_bahan','datamaster\TabulasiController@update_bahan')->name('update_bahan');
Route::post('brand/store','datamaster\BrandController@store')->name('brand.store');
Route::post('brand/{id}/update', 'datamaster\BrandController@update')->name('brand.update');
Route::post('editsubbrand/{id}','datamaster\SubBrandController@update')->name('update.subbrand');

Route::post('editpangan/{id}','datamaster\MasterController@editbpom')->name('editpangan');
Route::post('editsku/{id}','datamaster\MasterController@editsku')->name('editsku');
Route::post('editklaim/{id}','datamaster\MasterController@editklaim')->name('editklaim');
Route::post('edit_allergen/{id}','datamaster\MasterController@edit_allergen')->name('edit_allergen');
Route::post('edit_principal/{id}','datamaster\MasterController@edit_principal')->name('edit_principal');
Route::post('edit_supplier/{id}','datamaster\MasterController@edit_supplier')->name('edit_supplier');
Route::post('uom','datamaster\MasterController@uom')->name('uom');
Route::post('ses','datamaster\MasterController@ses')->name('ses');
Route::post('tambahsku','datamaster\MasterController@tambahsku')->name('tambahsku');
Route::post('add_allergen','datamaster\MasterController@add_allergen')->name('add_allergen');
Route::post('add_principal','datamaster\MasterController@add_principal')->name('add_principal');
Route::post('add_supplier','datamaster\MasterController@add_supplier')->name('add_supplier');

Route::get('DataDepartement','datamaster\DepartementController@dept')->name('dept');
Route::get('DeleteDepartement/{id}','datamaster\DepartementController@deldept')->name('deldept');
Route::get('bahan_rd','datamaster\BahanBakuController@bahanrd')->name('bahan_rd');
Route::get('edit_bahan/{id}','datamaster\BahanBakuController@edit_bahan')->name('edit_bahan');
Route::get('registrasi_bb_rd','datamaster\BahanBakuController@registrasi')->name('registrasi_bb_rd');
Route::get('DataBahanBaku','datamaster\BahanBakuController@bahan')->name('bahanbaku');
Route::get('ActiveBahan/{id}', 'datamaster\BahanBakuController@active')->name('activebahan');
Route::get('NonActiveBahan/{id}','datamaster\BahanBakuController@nonactive')->name('nonactivebahan');

Route::get('tabulasibb','datamaster\TabulasiController@tabulasi')->name('tabulasibb');
Route::get('edittabulasi','datamaster\TabulasiController@edittabulasi')->name('edittabulasi');
Route::get('hapustabulasibb','datamaster\TabulasiController@hapustabulasibb')->name('hapustabulasibb');
Route::get('brand', 'datamaster\BrandController@index')->name('brand.index');
Route::get('brand/{id}/destroy', 'datamaster\BrandController@destroy')->name('brand.destroy');
Route::get('datauom','datamaster\MasterController@datauom')->name('datauom');
Route::get('datases','datamaster\MasterController@datases')->name('datases');
Route::get('inactive_supplier/{id}','datamaster\MasterController@inactive_supplier')->name('inactive_supplier');
Route::get('active_supplier/{id}','datamaster\MasterController@active_supplier')->name('active_supplier');
Route::get('inactive_principal/{id}','datamaster\MasterController@inactive_principal')->name('inactive_principal');
Route::get('active_principal/{id}','datamaster\MasterController@active_principal')->name('active_principal');

Route::get('klaim','datamaster\MasterController@klaim')->name('klaim');
Route::get('sku','datamaster\MasterController@sku')->name('sku');
Route::get('datapangan','datamaster\MasterController@index')->name('datapangan');
Route::get('allergen','datamaster\MasterController@allergen')->name('allergen');
Route::get('principal','datamaster\MasterController@principal')->name('principal');
Route::get('supplier','datamaster\MasterController@supplier')->name('supplier');

Route::resource('subbrand', 'datamaster\SubBrandController',['except' => [ 'show','create' ]]);
Route::resource('curren', 'datamaster\CurrensController',['except' => [ 'show','create' ]]);
Route::resource('satuan', 'datamaster\SatuanController',['except' => [ 'show','create' ]]);
Route::resource('kategori', 'datamaster\KategoriController',['except' => [ 'show','create' ]]);
Route::resource('subkategori', 'datamaster\SubkategoriController',['except' => [ 'show','create' ]]);
Route::resource('tarkon', 'datamaster\TarkonController',['except' => [ 'show','create' ]]);

//email
Route::post('sendEmail/{id}', 'users\EmailController@sendEmail');
Route::post('sendEmailreject/{id}', 'users\EmailController@sendEmailreject');
Route::post('emailpkp/{id}/{revisi}/{turunan}', 'users\EmailController@emailpkp');
Route::post('emailpromo/{id}/{revisi}/{turunan}', 'users\EmailController@emailpromo');
Route::post('emailpdf/{id}/{revisi}/{turunan}', 'users\EmailController@emailpdf');

Route::get('/email', function () { return view('send_email');});
Route::get('approveemailpkp\{id}','users\EmailController@approveemailpkp')->name('approveemailpkp');
Route::get('rejectemailpkp\{id}','users\EmailController@rejectemailpkp')->name('rejectemailpkp');
Route::get('approveemailpdf\{id}','users\EmailController@approveemailpdf')->name('approveemailpdf');
Route::get('rejectemailpdf\{id}','users\EmailController@rejectemailpdf')->name('rejectemailpdf');
Route::get('approveemailpromo\{id}','users\EmailController@approveemailpromo')->name('approveemailpromo');
Route::get('rejectemailpromo\{id}','users\EmailController@rejectemailpromo')->name('rejectemailpromo');
Route::get('REmail','users\EmailController@REmail')->name('REmail');

// Report
Route::post('notulenpkpp','report\ReportController@notulenpkpp')->name('notulenpkpp');
Route::post('notulenpdff','report\ReportController@notulenpdff')->name('notulenpdff');
Route::post('notulenpromoo','report\ReportController@notulenpromoo')->name('notulenpromoo');
Route::post('check','report\ReportController@checkpkp')->name('check');
Route::post('checkpdf','report\ReportController@checkpdf')->name('checkpdf');
Route::post('checkpromo','report\ReportController@checkpromo')->name('checkpromo');
Route::post('update_pkp','report\ReportController@update_pkp')->name('update_pkp');
Route::post('notulen_pkp','report\ReportController@notulen_pkp')->name('notulen_pkp');
Route::post('update_pdf','report\ReportController@update_pdf')->name('update_pdf');
Route::post('update_promo','report\ReportController@update_promo')->name('update_promo');

Route::get('datapengajuan','pv\PKPController@pengajuan')->name('datapengajuan');
Route::get('notulenpdf','report\ReportController@notulenpdf')->name('notulenpdf');
Route::get('indexnotulenpromo','report\ReportController@indexnotulenpromo')->name('indexnotulenpromo');
Route::get('notulenpkp','report\ReportController@notulenpkp')->name('notulenpkp');
Route::get('tabulasi','report\ReportController@tabulasi')->name('tabulasi');
Route::get('editpkpall','report\ReportController@editpkpall')->name('editpkpall');
Route::get('hapuscheck','report\ReportController@hapuscheck')->name('hapuscheck');
Route::get('hapuscheckpdf','report\ReportController@hapuscheckpdf')->name('hapuscheckpdf');
Route::get('hapuscheckpromo','report\ReportController@hapuscheckpromo')->name('hapuscheckpromo');
Route::get('editpdfall','report\ReportController@editpdfall')->name('editpdfall');
Route::get('hapuspdf1/{id}','report\ReportController@deletepdf1')->name('hapuspdf1');
Route::get('deletepkp1/{id}','report\ReportController@deletepkp1')->name('deletepkp1');
Route::get('deletepromo1/{id}','report\ReportController@deletepromo1')->name('deletepromo1');
Route::get('editpromoall','report\ReportController@editpromoall')->name('editpromoall');
Route::get('datareport','report\ReportController@data')->name('datareport');

Route::get('reportnotulen','report\ReportController@reportnotulen')->name('reportnotulen');
Route::get('cetak','report\CetakController@download_project')->name('cetak');
Route::get('cetak_my_project','report\CetakController@download_my_project')->name('cetak_my_project');
Route::get('cetak_pdf','report\CetakController@download_project_pdf')->name('cetak_pdf');
Route::get('download_my_project_pdf','report\CetakController@download_my_project_pdf')->name('download_my_project_pdf');
Route::post('editnotulen','report\ReportController@editnote')->name('editnotulen');
Route::get('FOR_pkp/{formula}','report\DownloadFORController@FOR_pkp')->name('FOR_pkp');
Route::get('FOR_pdf/{formula}','report\DownloadFORController@FOR_pdf')->name('FOR_pdf');
Route::get('nutfact_bayangan_pkp/{formula}','report\DownloadFORController@nutfact_bayangan_pkp')->name('nutfact_bayangan_pkp');

/***** PV */
Route::get('dasboardpv','pv\PKPController@dasboardpv')->name('dasboardpv');

// PKP
Route::post('datapkp','pv\PKPController@datapkp')->name('datapkp');
Route::post('closeproject/{id}','pv\PKPController@closeproject')->name('closeproject');
Route::post('freeze/{id}','pv\PKPController@freeze')->name('freeze');
Route::post('infogambar','pv\PKPController@infogambar')->name('infogambar');
Route::post('ubahTMpkp/{id}','pv\PKPController@ubahTMpkp')->name('ubahTMpkp');
Route::post('TMubahpkp/{id}','pv\PKPController@TMubah')->name('TMubahpkp');
Route::post('edittype/{id_project}','pv\PKPController@edittype')->name('edittype');
Route::post('uploadpkp','pv\PKPController@uploaddatapkp')->name('uploadpkp');
Route::post('tippp','pv\PKPController@tipp')->name('tippp');
Route::post('updatetipp/{id_pkp}/{revisi}/{turunan}', 'pv\PKPController@updatetipp')->name('updatetipp');
Route::post('updatetipp2/{id_pkp}/{revisi}/{turunan}', 'pv\PKPController@updatetipp2')->name('updatetipp2');

Route::get('download/{id}/{revisi}/{turunan}','pv\PKPController@downloadpkp')->name('download');
Route::get('formpkp','pv\PKPController@formpkp')->name('formpkp');
Route::get('drafpkp','pv\PKPController@drafpkp')->name('drafpkp');
Route::get('listpkp','pv\PKPController@listpkp')->name('listpkp');
Route::get('buatpkp/{id_project}/{revisi}/{turunan}','pv\PKPController@buatpkp')->name('buatpkp');
Route::get('buatpkp1/{id_project}','pv\PKPController@buatpkp1')->name('buatpkp1');
Route::get('lihatpkp/{id_project}/{revisi}/{turunan}','pv\PKPController@lihatpkp')->name('lihatpkp');
Route::get('temppkp/{id}','pv\TemplateController@templatepkp')->name('temppkp');

Route::get('getpangan/{id}','ajax\AjaxController@getpangan')->name('getpangan');
Route::get('getolahan/{id}','ajax\AjaxController@getolahan')->name('getolahan');
Route::get('getkatpangan/{id}','ajax\AjaxController@getkatpangan')->name('getkatpangan');
Route::get('getkomponen/{id}','ajax\AjaxController@getkomponen')->name('getkomponen');
Route::get('getdetail/{id}','ajax\AjaxController@getdetailklaim')->name('getdetail');
Route::get('getbahan/{id}','ajax\AjaxController@getbahan')->name('getbahan');
Route::get('subkategori/{id}','ajax\AjaxController@subkategori')->name('subkategori');
Route::get('jenismikroba/{id}','ajax\AjaxController@getjenismikro')->name('jenismikroba');

Route::get('konfigurasi/{id}/{revisi}/{turunan}','pv\PKPController@konfigurasi')->name('konfigurasi');
Route::get('hapuspkp/{id}','pv\PKPController@hapuspkp')->name('hapuspkp');
Route::get('merk/{id}','pv\PKPController@merkAjax')->name('merk');
Route::get('activepkp/{id}','pv\PKPController@activepkp')->name('activepkp');
Route::get('rekappkp/{id_project}','pv\PKPController@rekappkp')->name('rekappkp');
Route::get('datatambahanpkp/{id}/{revisi}/{turunan}','pv\PKPController@uploadpkp')->name('datatambahanpkp');
Route::get('bagian1/{id_project}/{revisi}/{turunan}','pv\PKPController@step1')->name('bagian1');
Route::get('bagian2/{id_project}','pv\PKPController@step2')->name('bagian2');
Route::get('naikversipkp/{id}/{revisi}/{turunan}','pv\PKPController@upversionpkp')->name('naikversipkp');
Route::get('hapuslaunch/{id}/{revisi}/{turunan}','pv\PKPController@deletelaunch')->name('hapuslaunch');

//PKP PROMO
Route::post('isipromo','pv\PromoController@isipromo')->name('isipromo');
Route::post('ubahTM/{id}','pv\PromoController@ubahTM')->name('ubahTM');
Route::post('TMubah/{id}','pv\PromoController@TMubah')->name('TMubah');
Route::post('infogambarpromo','pv\PromoController@infogambarpromo')->name('infogambarpromo');
Route::post('freezepromo/{id}','pv\PromoController@freeze')->name('freezepromo');
Route::post('uploadpromo','pv\PromoController@uploaddatapkp')->name('uploadpromo');
Route::post('edituser/{id_project_pdf}','pv\PromoController@edituser')->name('edituser');
Route::post('sentpromo/{id_project}/{revisi}/{turunan}','pv\PromoController@sentpromo')->name('sentpromo');
Route::post('editpromo/{id_project}/{revisi}/{turunan}','pv\PromoController@edit')->name('editpromo');
Route::post('allocation','pv\PromoController@postSave')->name('allocation');
Route::post('edittypepromo/{id}','pv\PromoController@edittype')->name('edittypepromo');
Route::post('datapromo1','pv\PromoController@datapromo')->name('datapromo1');
Route::post('applicationpromo','pv\PromoController@applicationpromo')->name('applicationpromo');
Route::post('editdatapromo2/{id_pkp_promo}/{revisi}/{turunan}','pv\PromoController@editdatapromo2')->name('editdatapromo2');
Route::post('editdatapromo/{id_pkp_promo}/{revisi}/{turunan}','pv\PromoController@editdatapromo')->name('editdatapromo');
Route::post('editdatastep4/{id_product_allocation}/{turunan}','pv\PromoController@editdatastep4')->name('editdatastep4');
Route::post('approvepromo1/{id}','pv\PromoController@approve1')->name('approvepromo1');
Route::post('approvepromo2/{id}','pv\PromoController@approve2')->name('approvepromo2');

Route::get('downloadpromo/{id}/{revisi}/{turunan}','pv\PromoController@downloadpromo')->name('downloadpromo');
Route::get('promo','pv\PromoController@promo')->name('promo');
Route::get('datapromo/{id_project}','pv\PromoController@buatpromo')->name('datapromo');
Route::get('datapromo11/{id_project}/{revisi}/{turunan}','pv\PromoController@buatpromo1')->name('datapromo11');
Route::get('activepromo/{id}','pv\PromoController@active')->name('activepromo');
Route::get('drafpromo','pv\PromoController@drafpromo')->name('drafpromo');
Route::get('rekappromo/{id_pkp_promo}','pv\PromoController@daftarpromo')->name('rekappromo');
Route::get('promo4/{id_pkp_promo}/{revisi}/{turunan}','pv\PromoController@step4')->name('promo4');
Route::get('uploadpkppromo/{id_pkp_promo}/{revisi}/{turunan}','pv\PromoController@uploadpromo')->name('uploadpkppromo');
Route::get('listpromo','pv\PromoController@listpromo')->name('listpromo');
Route::get('lihatpromo/{id}/{revisi}/{turunan}','pv\PromoController@lihatpromo')->name('lihatpromo');
Route::get('naikversipromo/{id}/{revisi}/{turunan}','pv\PromoController@upversionpromo')->name('naikversipromo');
Route::get('deletedatastep4/{id_pkp_promo}/{turunan}','pv\PromoController@deletedatastep4')->name('deletedatastep4');
Route::get('hapuspromo/{id}','pv\PromoController@hapuspromo')->name('hapuspromo');

// PDF
Route::post('sentpdf/{id_project_pdf}/{revisi}/{turunan}','pv\PDFController@sentpdf')->name('sentpdf');
Route::post('datapdf','pv\PDFController@datapdf')->name('datapdf');
Route::post('infogambarpdf','pv\PDFController@infogambarpdf')->name('infogambarpdf');
Route::post('pos','pv\PDFController@coba')->name('pos');
Route::post('eedit/{id_project_pdf}/{revisi}/{turunan}','pv\PDFController@edit')->name('eedit');
Route::post('freezepdf/{id}','pv\PDFController@freeze')->name('freezepdf');
Route::post('ubahTMpdf/{id}','pv\PDFController@ubahTMpdf')->name('ubahTMpdf');
Route::post('pdf/{id}','pv\PDFController@TMubah')->name('TMubahpdf');
Route::post('eedituser/{id_project_pdf}','pv\PDFController@edituser')->name('eedituser');

Route::post('approvepdf1/{id}','pv\PDFController@approve1')->name('approvepdf1');
Route::post('approvepdf2/{id}','pv\PDFController@approve2')->name('approvepdf2');
Route::post('prioritaspdf/{id}','pv\PDFController@prioritas')->name('prioritaspdf');
Route::post('updatepdf/{id_pdf}/{revisi}/{turunan}','pv\PDFController@updatecoba')->name('updatepdf');
Route::post('updatepdf2/{id_pdf}/{revisi}/{turunan}','pv\PDFController@updatecoba2')->name('updatepdf2');
Route::post('uploadpdf','pv\PDFController@uploaddatapdf')->name('uploadpdf');

Route::get('konfig/{id}','pv\PDFController@konfigurasi')->name('konfig');
Route::get('drafpdf','pv\PDFController@drafpkp')->name('drafpdf');
Route::get('listpdf','pv\PDFController@listpdf')->name('listpdf');
Route::get('downloadpdf/{id_project_pdf}/{revisi}/{turunan}','pv\PDFController@downloadpdf')->name('downloadpdf');
Route::get('buatpdf/{id_project_pdf}','pv\PDFController@buatpdf')->name('buatpdf');
Route::get('buatpdf1/{id_project_pdf}/{revisi}/{turunan}','pv\PDFController@buatpdf1')->name('buatpdf1');
Route::get('formpdf','pv\PDFController@formpdf')->name('formpdf');
Route::get('lihatpdf/{id_project_pdf}/{revisi}/{turunan}','pv\PDFController@lihatpdf')->name('lihatpdf');
Route::get('hapuspdf/{id}','pv\PDFController@hapuspdf')->name('hapuspdf');
Route::get('activepdf/{id}','pv\PDFController@activepdf')->name('activepdf');
Route::get('temppdf/{id}','pv\TemplateController@template')->name('temppdf');
Route::get('destroydata/{id_pictures}','pv\PDFController@destroydata')->name('destroydata');
Route::get('datatambahanpdf/{id_project_pdf}/{revisi}/{turunan}','pv\PDFController@uploadpdf')->name('datatambahanpdf');
Route::get('naikversipdf/{id}/{recisi}/{turunan}','pv\PDFController@upversionpdf')->name('naikversipdf');
Route::get('rekappdf/{id_project_pdf}','pv\PDFController@daftarpdf')->name('rekappdf');

// ***************Manager
Route::post('approve1/{id}','manager\ManagerController@approve1')->name('approve1');
Route::post('approve2/{id}','manager\ManagerController@approve2')->name('approve2');
Route::post('pengajuan','manager\ManagerController@pengajuan')->name('pengajuan');
Route::post('pengajuanpdf','manager\ManagerController@pengajuanpdf')->name('pengajuanpdf');
Route::post('pengajuanpromo','manager\ManagerController@pengajuanpromo')->name('pengajuanpromo');
Route::post('alihkan/{id}','manager\ManagerController@alihkan')->name('alihkan');
Route::post('alihkanpdf/{id}','manager\ManagerController@alihkanpdf')->name('alihkanpdf');
Route::post('alihkanpromo/{id}','manager\ManagerController@alihkanpromo')->name('alihkanpromo');

Route::get('listpkprka','manager\ManagerController@listpkp')->name('listpkprka');
Route::get('listpdfrka','manager\ManagerController@listpdf')->name('listpdfrka');
Route::get('listpromoo','manager\ManagerController@listpromo')->name('listpromoo');
Route::get('dasboardmanager','manager\ManagerController@dasboardmanager')->name('dasboardmanager');
Route::get('daftarpkp/{id_project}','manager\ManagerController@daftarpkp')->name('daftarpkp');
Route::get('daftarpdf/{id}','manager\ManagerController@daftarpdf')->name('daftarpdf');
Route::get('daftarpromo/{id}','manager\ManagerController@daftarpromo')->name('daftarpromo');
Route::get('pdflihat/{id}/{revisi}/{turunan}','manager\ManagerController@lihatpdf')->name('pdflihat');
Route::get('pkplihat/{id}/{revisi}/{turunan}','manager\ManagerController@lihatpkp')->name('pkplihat');
Route::get('promolihat/{id}/{revisi}/{turunan}','manager\ManagerController@lihatpromo')->name('promolihat');

// ***************user_rd_produk
Route::get('dasboardawal','devwb\ListProjectController@dasboard')->name('dasboardawal');
Route::get('listprojectpkp','devwb\ListProjectController@listpkp')->name('listprojectpkp');
Route::get('listprojectpdf','devwb\ListProjectController@listpdf')->name('listprojectpdf');
Route::get('listprojectpromo','devwb\ListProjectController@listpromo')->name('listprojectpromo');

// FEASIBILITY
Route::get('PengajuanSelesai','feasibility\ListFormulaController@sudah')->name('formula.selesai');
Route::get('deletefs/{id}', 'feasibility\ListFeasibilityController@deletefs')->name('deletefs');

/***** Workbook Development**/
Route::post('addformula','devwb\FormulaController@new')->name('addformula');
Route::post('uploadfile/{id}','devwb\FormulaController@uploadfile')->name('uploadfile');
Route::post('uploadfile_pdf/{id}','devwb\FormulaController@uploadfile_pdf')->name('uploadfile_pdf');
Route::post('updateformula/{wb}/{id}','formula\Step1Controller@update')->name('step1update');
Route::post('GantiBase/{id}','formula\ScaleController@gantibase')->name('gantibase');
Route::post('savechanges/{id}','formula\ScaleController@savechanges')->name('savechanges');
Route::post('savechanges2/{id}','formula\ScaleController@savechanges2')->name('savechanges2');
Route::post('savedosis/{id}','formula\ScaleController@savedosis')->name('savedosis');

Route::post('cekscale/{id}/{formula}','formula\ScaleController@cekscale')->name('cekscale');
Route::post('savescale/{id}','formula\ScaleController@savescale')->name('savescale');
Route::post('insertbahan/{id}','formula\Step2Controller@insert')->name('step2insert');
Route::post('updatebahan/{id}','formula\Step2Controller@update')->name('step2update');
Route::post('GantiBase/{id}','formula\ScaleController@gantibase')->name('gantibase');
Route::post('header/{formula}','formula\SummaryFormulaController@header')->name('header');
Route::post('overage/{id}','formula\SummaryFormulaController@overage')->name('overage');

Route::get('upversion/{id}/{wb}','devwb\UpVersionController@upversion')->name('upversion');
Route::get('upversion2/{id}/{rev}','devwb\UpVersionController@upversion2')->name('upversion2');
Route::get('tambahformula/{id}','devwb\UpVersionController@tambahformula')->name('tambahformula');
Route::get('DetailFormula/{id}/{for}','devwb\FormulaController@detail')->name('formula.detail');
Route::get('DestroyFormula/{id}','devwb\FormulaController@deleteformula')->name('deleteFormula');
Route::get('hapusupload/{id}','devwb\FormulaController@hapus_upload')->name('hapus_upload');
Route::get('hapus_upload_pdf/{id}','devwb\FormulaController@hapus_upload_pdf')->name('hapus_upload_pdf');

Route::get('formulainformation/{wb}/{id}','formula\Step1Controller@create')->name('step1');
Route::get('formulainformation_pdf/{wb}/{id}','formula\Step1Controller@step1_pdf')->name('step1_pdf');
Route::get('hapus_file/{id}','formula\Step1Controller@hapus_file')->name('hapus_file');
Route::get('HapusBase/{id}','formula\ScaleController@hapusbase')->name('hapusbase');
Route::get('HapusBase/{id}','formula\ScaleController@hapusbase')->name('hapusbase');
Route::get('penyusunanbahan/{id}/{id_formula}','formula\Step2Controller@create')->name('step2');
Route::get('bahan/{id}/{vf}/delete','formula\Step2Controller@destroy')->name('step2destroy');
Route::get('hapusall/{formula}','formula\Step2Controller@hapusall')->name('hapusall');
Route::get('getAlternatif/{id}','ajax\AjaxController@getAlternatif');
Route::get('getTemplate/{id}/{formula}','devwb\TemplateFormulaController@index')->name('getTemplate');
Route::get('InsertTemplate/{ftujuan}/{fasal}','devwb\TemplateFormulaController@template')->name('insertTemplate');
Route::get('EditDetailPenyusunan/{id}/{for}','formula\EditFortailController@index')->name('editfortail');
Route::get('summarryformula/{id}/{formula}','formula\SummaryFormulaController@summarry')->name('summarry');

Route::patch('SaveDetailPenyusunan/{idf}/{id}','formula\EditFortailController@update')->name('updatefortail');
Route::patch('updatenote/{wb}/{id}','formula\Step2Controller@update')->name('updatenote');

// Ajukan Formula ke PV
Route::post('rejectsample/{id}','devwb\SampleController@rejectsample')->name('rejectsample');
Route::post('approvesample/{id}','devwb\SampleController@approvesample')->name('approvesample');
Route::get('ajukanvp/{wb}/{id}','devwb\SampleController@vp')->name('ajukanvp');
Route::get('finalsample/{sample}','devwb\SampleController@finalsample')->name('finalsample');
Route::get('unfinalsample/{sample}','devwb\SampleController@unfinalsample')->name('unfinalsample');

// panel
Route::post('hasilpanel','formula\PanelController@hasil')->name('hasilpanel');
Route::post('editpanel/{id}','formula\PanelController@editpanel')->name('editpanel');
Route::get('panel/{id}/{formula}','formula\PanelController@panel')->name('panel');
Route::get('deletepanel/{id}','formula\PanelController@hapuspanel')->name('deletepanel');
Route::get('ajukanpanel/{id}/{panel}','formula\PanelController@ajukanpanel')->name('ajukanpanel');

// Storage
Route::post('hasilstorage','formula\StorageController@hasilnya')->name('hasilstorage');
Route::post('updatedst/{id}','formula\StorageController@editdata')->name('updatedst');
Route::post('progress','formula\StorageController@proses')->name('progress');
Route::get('st/{id}/{formula}','formula\StorageController@st')->name('st');
Route::get('deletest/{id}','formula\StorageController@delete')->name('deletest');
Route::get('ajukanstorage/{id}/{storage}','formula\StorageController@ajukanstorage')->name('ajukanstorage');

// forgot password
Route::post('reset_password_without_token', 'AccountsController@validatePasswordRequest')->name('reset_password_without_token');
Route::patch('/forgotpass','AccountsController@update')->name('forgotpass');
Route::get('reset/{id}','LoginController@reset')->name('reset');

// Marketing
Route::get('dasboardnr','pv\PKPController@dasboardnr')->name('dasboardnr');