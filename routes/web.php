<?php

Route::get('/', function () { return redirect('/lala'); });
Route::get('lala','HomeController@home')->name('lala');
Route::get('/home', function () { return view('login'); });

Route::get('/pageAksesKhusus', function(){ return view('pageAksesKhusus'); });
Route::get('/MyProfile','users\ProfilController@show')->name('MyProfile');
Route::patch('/updateprof','users\ProfilController@update')->name('updateprof');

/** Auth */
Route::post('postLogin', 'LoginController@postLogin')->name('postLogin');
Route::post('add', [ 'uses'=> 'RegistrationController@registrationPost', 'as' => 'add']);
 
Route::get('daftar', 'RegistrationController@create');
Route::get('signin', 'LoginController@getLogin')->name('signin');
Route::get('signout', function(){ Auth::logout(); return redirect('/home');})->name('signout');

// forgot password
Route::post('reset_password_without_token', 'AccountsController@validatePasswordRequest')->name('reset_password_without_token');
Route::patch('/forgotpass','AccountsController@update')->name('forgotpass');
Route::get('reset/{id}','LoginController@reset')->name('reset');

/*User Approval*/
Route::get('/userapproval', 'admin\ApprovalController@index')->name('userapproval');
Route::get('userapproval/{id}/update', [ 'uses'=>'admin\ApprovalController@update', 'as' =>'ua.update']);
Route::get('userapproval/{id}/destroy', [ 'uses'=>'admin\ApprovalController@destroy', 'as' =>'ua.destroy']);
    
/*User Management*/
Route::get('usermanagement','admin\UserListController@index')->name('usermanagement');
Route::get('showuser/{id}','admin\UserListController@show')->name('showuser');
Route::get('userblok/{id}','admin\UserListController@blok')->name('userblok');
Route::get('openblok/{id}','admin\UserListController@open')->name('openblok');
Route::patch('userupdate/{id}','admin\UserListController@update')->name('userupdate');

/*Data Master*/
Route::post('editpangan/{id}','datamaster\masterController@editbpom')->name('editpangan');
Route::post('editsku/{id}','datamaster\masterController@editsku')->name('editsku');
Route::post('editklaim/{id}','datamaster\masterController@editklaim')->name('editklaim');
Route::post('edit_allergen/{id}','datamaster\masterController@edit_allergen')->name('edit_allergen');
Route::post('edit_principal/{id}','datamaster\masterController@edit_principal')->name('edit_principal');
Route::post('edit_supplier/{id}','datamaster\masterController@edit_supplier')->name('edit_supplier');
Route::post('tambahsku','datamaster\masterController@tambahsku')->name('tambahsku');
Route::post('addmesin','datamaster\masterController@addmesin')->name('addmesin');
Route::post('addoh','datamaster\masterController@addoh')->name('addoh');

Route::post('add_allergen','datamaster\masterController@add_allergen')->name('add_allergen');
Route::post('add_principal','datamaster\masterController@add_principal')->name('add_principal');
Route::post('add_supplier','datamaster\masterController@add_supplier')->name('add_supplier');
Route::post('uom','datamaster\masterController@uom')->name('uom');
Route::post('ses','datamaster\masterController@ses')->name('ses');
Route::get('datauom','datamaster\masterController@datauom')->name('datauom');
Route::get('datases','datamaster\masterController@datases')->name('datases');
Route::get('mesin','datamaster\masterController@mesin')->name('mesin');
Route::get('oh','datamaster\masterController@oh')->name('oh');

Route::get('inactive_supplier/{id}','datamaster\masterController@inactive_supplier')->name('inactive_supplier');
Route::get('active_supplier/{id}','datamaster\masterController@active_supplier')->name('active_supplier');
Route::get('inactive_principal/{id}','datamaster\masterController@inactive_principal')->name('inactive_principal');
Route::get('active_principal/{id}','datamaster\masterController@active_principal')->name('active_principal');
Route::get('klaim','datamaster\masterController@klaim')->name('klaim');
Route::get('sku','datamaster\masterController@sku')->name('sku');
Route::get('datapangan','datamaster\masterController@index')->name('datapangan');
Route::get('allergen','datamaster\masterController@allergen')->name('allergen');
Route::get('principal','datamaster\masterController@principal')->name('principal');
Route::get('supplier','datamaster\masterController@supplier')->name('supplier');

//Departement
Route::patch('storeupdatedept/{id}','datamaster\DepartementController@saveupdateDept')->name('storeupdatedept');
Route::post('AddDepartement','datamaster\DepartementController@adddept')->name('adddept');
Route::get('DataDepartement','datamaster\DepartementController@dept')->name('dept');
Route::get('DeleteDepartement/{id}','datamaster\DepartementController@deldept')->name('deldept');

// Dasboard
Route::get('dasboardnr','pv\dasboardController@dasboardnr')->name('dasboardnr');
Route::get('dasboardpv','pv\dasboardController@dasboardpv')->name('dasboardpv');
Route::get('dasboardmanager','pv\dasboardController@dasboardmanager')->name('dasboardmanager');
Route::get('dasboardawal','pv\dasboardController@dasboard')->name('dasboardawal');

//Bahan Baku
Route::patch('storeupdateBahanBaku/{id}','datamaster\BahanBakuController@saveupdateBahan')->name('storeupdatebahan');
Route::post('addbahanrd','datamaster\BahanBakuController@addbahanrd')->name('addbahanrd');
Route::post('AddBahanBaku','datamaster\BahanBakuController@addbahan')->name('addbahan');
Route::get('bahan_rd','datamaster\BahanBakuController@bahanrd')->name('bahan_rd');
Route::get('edit_bahan/{id}','datamaster\BahanBakuController@edit_bahan')->name('edit_bahan');
Route::get('registrasi_bb_rd','datamaster\BahanBakuController@registrasi')->name('registrasi_bb_rd');
Route::get('DataBahanBaku','datamaster\BahanBakuController@bahan')->name('bahanbaku');
Route::get('ActiveBahan/{id}', 'datamaster\BahanBakuController@active')->name('activebahan');
Route::get('NonActiveBahan/{id}','datamaster\BahanBakuController@nonactive')->name('nonactivebahan');

//tabulasi
Route::post('checktabulasi','datamaster\TabulasiController@pilih')->name('checktabulasi');
Route::post('update_bahan','datamaster\TabulasiController@update_bahan')->name('update_bahan');
Route::get('tabulasibb','datamaster\TabulasiController@tabulasi')->name('tabulasibb');
Route::get('edittabulasi','datamaster\TabulasiController@edittabulasi')->name('edittabulasi');
Route::get('hapustabulasibb','datamaster\TabulasiController@hapustabulasibb')->name('hapustabulasibb');

//Brand Subrand
Route::resource('subbrand', 'datamaster\subbrandController',['except' => [ 'show','create' ]]);
Route::post('brand/store','datamaster\BrandController@store')->name('brand.store');
Route::post('brand/{id}/update', 'datamaster\BrandController@update')->name('brand.update');
Route::post('editsubbrand/{id}','datamaster\subbrandController@update')->name('update.subbrand');
Route::get('brand', 'datamaster\BrandController@index')->name('brand.index');
Route::get('brand/{id}/destroy', 'datamaster\BrandController@destroy')->name('brand.destroy');

Route::resource('curren', 'datamaster\CurrensController',['except' => [ 'show','create' ]]);
Route::resource('satuan', 'datamaster\SatuanController',['except' => [ 'show','create' ]]);
Route::resource('kategori', 'datamaster\KategoriController',['except' => [ 'show','create' ]]);
Route::resource('subkategori', 'datamaster\SubkategoriController',['except' => [ 'show','create' ]]);

//email
Route::post('emailpkp/{id}', 'users\EmailController@emailpkp');
Route::post('sendEmail/{id}', 'users\EmailController@sendEmail');
Route::post('sendEmailreject/{id}', 'users\EmailController@sendEmailreject');
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
Route::post('notulenpkpp','report\reportController@notulenpkpp')->name('notulenpkpp');
Route::post('notulenpdff','report\reportController@notulenpdff')->name('notulenpdff');
Route::post('notulenpromoo','report\reportController@notulenpromoo')->name('notulenpromoo');
Route::post('check','report\reportController@checkpkp')->name('check');
Route::post('checkpdf','report\reportController@checkpdf')->name('checkpdf');
Route::post('checkpromo','report\reportController@checkpromo')->name('checkpromo');
Route::post('update_pkp','report\reportController@update_pkp')->name('update_pkp');
Route::post('notulen_pkp','report\reportController@notulen_pkp')->name('notulen_pkp');
Route::post('update_pdf','report\reportController@update_pdf')->name('update_pdf');
Route::post('updateUser', 'report\reportController@updateUser')->name('updateUser');
Route::post('update_promo','report\reportController@update_promo')->name('update_promo');
Route::post('konfirmasi_notulen','report\reportController@konfirmasi_notulen')->name('konfirmasi_notulen');

Route::get('notulenpdf','report\reportController@notulenpdf')->name('notulenpdf');
Route::get('indexnotulenpromo','report\reportController@indexnotulenpromo')->name('indexnotulenpromo');
Route::get('notulenpkp/{info}','report\reportController@notulenpkp')->name('notulenpkp');
Route::get('tabulasi','report\reportController@tabulasi')->name('tabulasi');
Route::get('editpkpall','report\reportController@editpkpall')->name('editpkpall');
Route::get('hapuscheck','report\reportController@hapuscheck')->name('hapuscheck');
Route::get('hapuscheckpdf','report\reportController@hapuscheckpdf')->name('hapuscheckpdf');
Route::get('hapuscheckpromo','report\reportController@hapuscheckpromo')->name('hapuscheckpromo');
Route::get('editpdfall','report\reportController@editpdfall')->name('editpdfall');
Route::get('hapuspdf1/{id}','report\reportController@deletepdf1')->name('hapuspdf1');
Route::get('deletepkp1/{id}','report\reportController@deletepkp1')->name('deletepkp1');

Route::get('deletepromo1/{id}','report\reportController@deletepromo1')->name('deletepromo1');
Route::get('editpromoall','report\reportController@editpromoall')->name('editpromoall');
Route::get('reportnotulen','report\reportController@reportnotulen')->name('reportnotulen');
Route::get('cetak','report\cetakController@download_project')->name('cetak');
Route::get('cetak_my_project','report\cetakController@download_my_project')->name('cetak_my_project');
Route::get('cetak_pdf','report\cetakController@download_project_pdf')->name('cetak_pdf');
Route::get('download_my_project_pdf','report\cetakController@download_my_project_pdf')->name('download_my_project_pdf');
Route::get('FOR_pkp/{formula}','report\downloadFORController@FOR_pkp')->name('FOR_pkp');
Route::get('FOR_pdf/{formula}','report\downloadFORController@FOR_pdf')->name('FOR_pdf');
Route::get('nutfact_bayangan_pkp/{formula}','report\downloadFORController@nutfact_bayangan_pkp')->name('nutfact_bayangan_pkp');
Route::post('editnotulen','report\reportController@editnote')->name('editnotulen');
Route::post('export_notulen_pkp','report\cetakController@notulenpkp')->name('export_notulen_pkp');

/***** PV */
// PKP
Route::post('edittuser/{id_project}','pv\pkpController@edituser')->name('edittuser');
Route::post('editt/{id_project}','pv\pkpController@edit')->name('editt');
Route::post('sentpkp/{id_project}','pv\pkpController@sentpkp')->name('sentpkp');
Route::post('datapkp','pv\pkpController@datapkp')->name('datapkp');
Route::post('closeproject/{id}','pv\pkpController@closeproject')->name('closeproject');
Route::post('freeze/{id}','pv\pkpController@freeze')->name('freeze');
Route::post('infogambar','pv\pkpController@infogambar')->name('infogambar');
Route::post('ubahTMpkp/{id}','pv\pkpController@ubahTMpkp')->name('ubahTMpkp');
Route::post('TMubahpkp/{id}','pv\pkpController@TMubah')->name('TMubahpkp');
Route::post('edittype/{id_project}','pv\pkpController@edittype')->name('edittype');
Route::post('uploadpkp','pv\pkpController@uploaddatapkp')->name('uploadpkp');
Route::post('tippp/{id}','pv\pkpController@tipp')->name('tippp');
Route::post('activepkp/{id}','pv\pkpController@activepkp')->name('activepkp');
Route::post('updatetipp/{id_pkp}/{revisi}/{turunan}', 'pv\pkpController@updatetipp')->name('updatetipp');
Route::post('updatetipp2/{id_pkp}/{revisi}/{turunan}/{kemas}', 'pv\pkpController@updatetipp2')->name('updatetipp2');
Route::post('improve/{id}/{revisi}/{turunan}/{kemas}','pv\templateController@improve')->name('improve');

Route::get('download/{id}','pv\pkpController@downloadpkp')->name('download');
Route::get('datapengajuan','pv\pkpController@pengajuan')->name('datapengajuan');
Route::get('formpkp','pv\pkpController@formpkp')->name('formpkp');
Route::get('drafpkp','pv\pkpController@drafpkp')->name('drafpkp');
Route::get('listpkp','pv\pkpController@listpkp')->name('listpkp');
Route::get('droppkp/{id}','pv\pkpController@drop')->name('droppkp');
Route::get('buatpkp/{id_project}','pv\pkpController@buatpkp')->name('buatpkp');
Route::get('buatpkp1/{id_project}/{id_pkp}','pv\pkpController@buatpkp1')->name('buatpkp1');
Route::get('lihatpkp/{id_project}','pv\pkpController@lihatpkp')->name('lihatpkp');
Route::get('temppkpumum/{id}/{revisi}/{turunan}/{kemas}','pv\templateController@templatepkpumum')->name('temppkpumum');
Route::get('temppkpbaku/{id}/{revisi}/{turunan}/{kemas}','pv\templateController@templatepkpbaku')->name('temppkpbaku');
Route::get('temppkpkemas/{id}/{revisi}/{turunan}/{kemas}','pv\templateController@templatepkpkemas')->name('temppkpkemas');

Route::get('konfigurasi/{id}','pv\pkpController@konfigurasi')->name('konfigurasi');
Route::get('hapuspkp/{id}','pv\pkpController@hapuspkp')->name('hapuspkp');
Route::get('merk/{id}','pv\pkpController@merkAjax')->name('merk');
Route::get('rekappkp/{id_project}/{id_pkp}','pv\pkpController@rekappkp')->name('rekappkp');
Route::get('datatambahanpkp/{id}','pv\pkpController@uploadpkp')->name('datatambahanpkp');
Route::get('bagian1/{id_project}/{revisi}/{turunan}','pv\pkpController@step1')->name('bagian1');
Route::get('bagian2/{id_project}','pv\pkpController@step2')->name('bagian2');
Route::get('naikversipkp/{id}/{revisi}/{turunan}/{kemas}','pv\templateController@upversionpkp')->name('naikversipkp');
Route::get('hapuslaunch/{id}/{revisi}/{turunan}','pv\pkpController@deletelaunch')->name('hapuslaunch');

//PKP PROMO
Route::post('isipromo','pv\promoController@isipromo')->name('isipromo');
Route::post('ubahTM/{id}','pv\promoController@ubahTM')->name('ubahTM');
Route::post('TMubah/{id}','pv\promoController@TMubah')->name('TMubah');
Route::post('infogambarpromo','pv\promoController@infogambarpromo')->name('infogambarpromo');
Route::post('freezepromo/{id}','pv\promoController@freeze')->name('freezepromo');
Route::post('uploadpromo','pv\promoController@uploaddatapkp')->name('uploadpromo');
Route::post('edituser/{id_project_pdf}','pv\promoController@edituser')->name('edituser');
Route::post('sentpromo/{id_project}/{revisi}/{turunan}','pv\promoController@sentpromo')->name('sentpromo');
Route::post('editpromo/{id_project}/{revisi}/{turunan}','pv\promoController@edit')->name('editpromo');

Route::post('allocation','pv\promoController@postSave')->name('allocation');
Route::post('edittypepromo/{id}','pv\promoController@edittype')->name('edittypepromo');
Route::post('datapromo1','pv\promoController@datapromo')->name('datapromo1');
Route::post('applicationpromo','pv\promoController@applicationpromo')->name('applicationpromo');
Route::post('editdatapromo2/{id_pkp_promo}/{revisi}/{turunan}','pv\promoController@editdatapromo2')->name('editdatapromo2');
Route::post('editdatapromo/{id_pkp_promo}/{revisi}/{turunan}','pv\promoController@editdatapromo')->name('editdatapromo');
Route::post('editdatastep4/{id_product_allocation}/{turunan}','pv\promoController@editdatastep4')->name('editdatastep4');
Route::post('approvepromo1/{id}','pv\promoController@approve1')->name('approvepromo1');
Route::post('approvepromo2/{id}','pv\promoController@approve2')->name('approvepromo2');

Route::get('downloadpromo/{id}/{revisi}/{turunan}','pv\promoController@downloadpromo')->name('downloadpromo');
Route::get('promo','pv\promoController@promo')->name('promo');
Route::get('datapromo/{id_project}','pv\promoController@buatpromo')->name('datapromo');
Route::get('datapromo11/{id_project}/{revisi}/{turunan}','pv\promoController@buatpromo1')->name('datapromo11');
Route::get('activepromo/{id}','pv\promoController@active')->name('activepromo');
Route::get('drafpromo','pv\promoController@drafpromo')->name('drafpromo');
Route::get('rekappromo/{id_pkp_promo}','pv\promoController@daftarpromo')->name('rekappromo');
Route::get('promo4/{id_pkp_promo}/{revisi}/{turunan}','pv\promoController@step4')->name('promo4');

Route::get('uploadpkppromo/{id_pkp_promo}/{revisi}/{turunan}','pv\promoController@uploadpromo')->name('uploadpkppromo');
Route::get('listpromo','pv\promoController@listpromo')->name('listpromo');
Route::get('lihatpromo/{id}/{revisi}/{turunan}','pv\promoController@lihatpromo')->name('lihatpromo');
Route::get('naikversipromo/{id}/{revisi}/{turunan}','pv\templateController@upversionpromo')->name('naikversipromo');
Route::get('deletedatastep4/{id_pkp_promo}/{turunan}','pv\promoController@deletedatastep4')->name('deletedatastep4');
Route::get('hapuspromo/{id}','pv\promoController@hapuspromo')->name('hapuspromo');

// PDF
Route::post('sentpdf/{id_project_pdf}/{revisi}/{turunan}','pv\pdfController@sentpdf')->name('sentpdf');
Route::post('datapdf','pv\pdfController@datapdf')->name('datapdf');
Route::post('infogambarpdf','pv\pdfController@infogambarpdf')->name('infogambarpdf');
Route::post('pos','pv\pdfController@coba')->name('pos');
Route::post('eedit/{id_project_pdf}/{revisi}/{turunan}','pv\pdfController@edit')->name('eedit');
Route::post('freezepdf/{id}','pv\pdfController@freeze')->name('freezepdf');
Route::post('ubahTMpdf/{id}','pv\pdfController@ubahTMpdf')->name('ubahTMpdf');
Route::post('pdf/{id}','pv\pdfController@TMubah')->name('TMubahpdf');
Route::post('eedituser/{id_project_pdf}','pv\pdfController@edituser')->name('eedituser');

Route::post('approvepdf1/{id}','pv\pdfController@approve1')->name('approvepdf1');
Route::post('approvepdf2/{id}','pv\pdfController@approve2')->name('approvepdf2');
Route::post('prioritaspdf/{id}','pv\pdfController@prioritas')->name('prioritaspdf');
Route::post('updatepdf/{id_pdf}/{revisi}/{turunan}','pv\pdfController@updatecoba')->name('updatepdf');
Route::post('updatepdf2/{id_pdf}/{revisi}/{turunan}','pv\pdfController@updatecoba2')->name('updatepdf2');
Route::post('uploadpdf','pv\pdfController@uploaddatapdf')->name('uploadpdf');

Route::get('konfig/{id}','pv\pdfController@konfigurasi')->name('konfig');
Route::get('drafpdf','pv\pdfController@drafpdf')->name('drafpdf');
Route::get('listpdf','pv\pdfController@listpdf')->name('listpdf');
Route::get('downloadpdf/{id_project_pdf}/{revisi}/{turunan}','pv\pdfController@downloadpdf')->name('downloadpdf');
Route::get('buatpdf/{id_project_pdf}','pv\pdfController@buatpdf')->name('buatpdf');
Route::get('buatpdf1/{id_project_pdf}/{revisi}/{turunan}','pv\pdfController@buatpdf1')->name('buatpdf1');
Route::get('formpdf','pv\pdfController@formpdf')->name('formpdf');
Route::get('lihatpdf/{id_project_pdf}/{revisi}/{turunan}','pv\pdfController@lihatpdf')->name('lihatpdf');
Route::get('hapuspdf/{id}','pv\pdfController@hapuspdf')->name('hapuspdf');
Route::get('activepdf/{id}','pv\pdfController@activepdf')->name('activepdf');
Route::get('temppdf/{id}','pv\templateController@template')->name('temppdf');
Route::get('destroydata/{id_pictures}','pv\pdfController@destroydata')->name('destroydata');
Route::get('datatambahanpdf/{id_project_pdf}/{revisi}/{turunan}','pv\pdfController@uploadpdf')->name('datatambahanpdf');
Route::get('naikversipdf/{id}/{recisi}/{turunan}','pv\templateController@upversionpdf')->name('naikversipdf');
Route::get('rekappdf/{id_project_pdf}','pv\pdfController@daftarpdf')->name('rekappdf');

// ***************Manager
Route::post('approve1/{id}','manager\managerController@approve1')->name('approve1');
Route::post('approve2/{id}','manager\managerController@approve2')->name('approve2');
Route::post('pengajuan','manager\managerController@pengajuan')->name('pengajuan');
Route::post('pengajuanpdf','manager\managerController@pengajuanpdf')->name('pengajuanpdf');
Route::post('pengajuanpromo','manager\managerController@pengajuanpromo')->name('pengajuanpromo');
Route::post('alihkan/{id}','manager\managerController@alihkan')->name('alihkan');
Route::post('alihkanpdf/{id}','manager\managerController@alihkanpdf')->name('alihkanpdf');
Route::post('alihkanpromo/{id}','manager\managerController@alihkanpromo')->name('alihkanpromo');

Route::get('listpkprka','manager\managerController@listpkp')->name('listpkprka');
Route::get('listpdfrka','manager\managerController@listpdf')->name('listpdfrka');
Route::get('listpromoo','manager\managerController@listpromo')->name('listpromoo');
Route::get('daftarpkp/{id_project}','manager\managerController@daftarpkp')->name('daftarpkp');
Route::get('daftarpdf/{id}','manager\managerController@daftarpdf')->name('daftarpdf');
Route::get('daftarpromo/{id}','manager\managerController@daftarpromo')->name('daftarpromo');
Route::get('pdflihat/{id}/{revisi}/{turunan}','manager\managerController@lihatpdf')->name('pdflihat');
Route::get('pkplihat/{id_project}','manager\managerController@lihatpkp')->name('pkplihat');
Route::get('promolihat/{id}/{revisi}/{turunan}','manager\managerController@lihatpromo')->name('promolihat');

// ***************user_rd_produk
Route::get('listprojectpkp','RDproduct\listprojectController@listpkp')->name('listprojectpkp');
Route::get('listprojectpdf','RDproduct\listprojectController@listpdf')->name('listprojectpdf');
Route::get('listprojectpromo','RDproduct\listprojectController@listpromo')->name('listprojectpromo');

/***** Workbook**/
// Formula
Route::get('DetailFormula/{id}/{wb}/{for}','formula\FormulaController@detail')->name('formula.detail');
Route::get('DestroyFormula/{id}','formula\FormulaController@deleteformula')->name('deleteFormula');
Route::get('hapusupload/{id}','formula\FormulaController@hapus_upload')->name('hapus_upload');
Route::get('hapus_upload_pdf/{id}','formula\FormulaController@hapus_upload_pdf')->name('hapus_upload_pdf');
Route::post('addformula','formula\FormulaController@new')->name('addformula');
Route::post('uploadfile/{id}','formula\FormulaController@uploadfile')->name('uploadfile');
Route::post('uploadfile_pdf/{id}','formula\FormulaController@uploadfile_pdf')->name('uploadfile_pdf');

//Step1
Route::post('updateformula/{for}/{pkp}/{project}','formula\Step1Controller@update')->name('step1update');
Route::get('formulainformation/{for}/{pkp}/{project}','formula\Step1Controller@create')->name('step1');
Route::get('formulainformation_pdf/{for}/{pdf}','formula\Step1Controller@step1_pdf')->name('step1_pdf');
Route::get('hapus_file/{id}','formula\Step1Controller@hapus_file')->name('hapus_file');

//Step2
Route::patch('updatenote/{wb}/{id}','formula\Step2Controller@update')->name('updatenote');
Route::post('insertbahan/{id}','formula\Step2Controller@insert')->name('step2insert');
Route::post('updatebahan/{id}','formula\Step2Controller@update')->name('step2update');
Route::get('penyusunanbahan/{for}/{pkp}/{project}','formula\Step2Controller@create')->name('step2');
Route::get('bahan/{id}/{vf}/delete','formula\Step2Controller@destroy')->name('step2destroy');
Route::get('hapusall/{formula}','formula\Step2Controller@hapusall')->name('hapusall');

// Summary
Route::post('header/{formula}','formula\SummaryFormulaController@header')->name('header');
Route::post('overage/{id}','formula\SummaryFormulaController@overage')->name('overage');
Route::get('summarryformula/{for}/{pkp}/{pro}','formula\SummaryFormulaController@summarry')->name('summarry');

//Scale
Route::post('GantiBase/{id}','formula\ScaleController@gantibase')->name('gantibase');
Route::post('savechanges/{id}','formula\ScaleController@savechanges')->name('savechanges');
Route::post('savechanges2/{id}','formula\ScaleController@savechanges2')->name('savechanges2');
Route::post('savedosis/{id}','formula\ScaleController@savedosis')->name('savedosis');
Route::post('cekscale/{for}/{pkp}/{pro}','formula\ScaleController@cekscale')->name('cekscale');
Route::post('savescale/{id}/{pkp}','formula\ScaleController@savescale')->name('savescale');
Route::post('GantiBase/{id}','formula\ScaleController@gantibase')->name('gantibase');

Route::get('HapusBase/{id}','formula\ScaleController@hapusbase')->name('hapusbase');
Route::get('HapusBase/{id}','formula\ScaleController@hapusbase')->name('hapusbase');
Route::get('upversion/{for}/{pkp}/{pro}','formula\UpVersionController@upversion')->name('upversion');
Route::get('upversion2/{for}/{pkp}/{pro}','formula\UpVersionController@upversion2')->name('upversion2');
Route::get('tambahformula/{id}','formula\UpVersionController@tambahformula')->name('tambahformula');

Route::get('getAlternatif/{id}','ajax\AjaxController@getAlternatif');
Route::get('getTemplate/{for}/{pkp}/{pro}','formula\TemplateFormulaController@index')->name('getTemplate');
Route::get('InsertTemplate/{ftujuan}/{wb}/{fasal}','formula\TemplateFormulaController@template')->name('insertTemplate');
Route::get('EditDetailPenyusunan/{id}/{for}','formula\EditFortailController@index')->name('editfortail');
Route::patch('SaveDetailPenyusunan/{idf}/{id}','formula\EditFortailController@update')->name('updatefortail');

// Ajukan Formula ke PV
Route::post('rejectsample/{id}','formula\SampleController@rejectsample')->name('rejectsample');
Route::post('approvesample/{id}','formula\SampleController@approvesample')->name('approvesample');
Route::get('ajukanvp/{wb}/{id}','formula\SampleController@vp')->name('ajukanvp');
Route::get('finalsample/{sample}','formula\SampleController@finalsample')->name('finalsample');
Route::get('unfinalsample/{sample}','formula\SampleController@unfinalsample')->name('unfinalsample');

// panel
Route::post('hasilpanel','formula\panelController@hasil')->name('hasilpanel');
Route::post('editpanel/{id}','formula\panelController@editpanel')->name('editpanel');
Route::get('panel/{id}/{pkp}/{formula}','formula\panelController@panel')->name('panel');
Route::get('deletepanel/{id}','formula\panelController@hapuspanel')->name('deletepanel');
Route::get('ajukanpanel/{id}/{panel}','formula\panelController@ajukanpanel')->name('ajukanpanel');

// Storage
Route::post('hasilstorage','formula\storageController@hasilnya')->name('hasilstorage');
Route::post('updatedst/{id}','formula\storageController@editdata')->name('updatedst');
Route::post('progress','formula\storageController@proses')->name('progress');
Route::get('st/{id}/{pkp}/{formula}','formula\storageController@st')->name('st');
Route::get('deletest/{id}','formula\storageController@delete')->name('deletest');
Route::get('ajukanstorage/{id}/{storage}','formula\storageController@ajukanstorage')->name('ajukanstorage');

// Ajax
Route::get('getpangan/{id}','ajax\AjaxController@getpangan')->name('getpangan');
Route::get('getolahan/{id}','ajax\AjaxController@getolahan')->name('getolahan');
Route::get('getkatpangan/{id}','ajax\AjaxController@getkatpangan')->name('getkatpangan');
Route::get('getkomponen/{id}','ajax\AjaxController@getkomponen')->name('getkomponen');
Route::get('getdetail/{id}','ajax\AjaxController@getdetailklaim')->name('getdetail');
Route::get('getbahan/{id}','ajax\AjaxController@getbahan')->name('getbahan');
Route::get('subkategori/{id}','ajax\AjaxController@subkategori')->name('subkategori');
Route::get('jenismikroba/{id}','ajax\AjaxController@getjenismikro')->name('jenismikroba');

/***** Feasibility**/
// pengajuan FS dari Pv
Route::post('ajukanPKP/{id}/{for}','PengajuanFS\PengajuanFsController@ajukanPKP')->name('ajukanPKP');
Route::get('pengajuanFS_PKP/{id}/{for}','PengajuanFS\PengajuanFsController@formPengajuanFS')->name('PengajuanFS_PKP');
Route::get('BatalAjukanFS/{id}/{for}','PengajuanFs\PengajuanFsController@BatalAjukanFS')->name('BatalAjukanFS');

// List FS
Route::get('listPkpFs/{id}','feasibility\ListFsController@listPkpFs')->name('listPkpFs');
Route::get('FsPKP','feasibility\ListFsController@FsPKP')->name('FsPKP');

// Form Pengajuan FS dari proses
Route::get('DetailPengajuanFsPKP/{pkp}/{id}/{fs}','PengajuanFS\PengajuanFsController@DetailPengajuanFsPKP')->name('DetailPengajuanFsPKP');
Route::post('overview','PengajuanFS\PengajuanFsController@overview')->name('overview');
Route::post('user_fs/{id}','PengajuanFS\PengajuanFsController@user_fs')->name('user_fs');

// Workbook FS
Route::get('workbookfs/{id}','workbookFS\WorkbookFsController@workbookfs')->name('workbookfs');
Route::get('info/{id}/{for}','workbookFS\WorkbookFsController@info')->name('info');
Route::get('reportinfo/{id}','workbookFS\WorkbookFsController@reportinfo')->name('reportinfo');

// Workbook User_Proses
Route::get('datamesin/{id}','RDproses\MesinController@index')->name('datamesin');
Route::get('datamesin2/{id}/{ws}','RDproses\MesinController@index2')->name('datamesin2');
Route::get('dataOH/{id}/{ws}','RDproses\MesinController@dataOH')->name('dataOH');
Route::get('AllergenBaru/{id}/{ws}','RDproses\MesinController@AllergenBaru')->name('AllergenBaru');

// Workbook Lab
Route::get('datalab/{id}','lab\LabController@index')->name('datalab');
Route::get('AddItem/{id}','lab\LabController@AddItem')->name('AddItem');

// Workbook Kemas
Route::get('datakemas/{id}','RDkemas\KonsepController@index')->name('datakemas');

// Workbook Maklon
Route::Post('FsMaklon/{fs}','Maklon\MaklonController@FsMaklon')->name('FsMaklon');