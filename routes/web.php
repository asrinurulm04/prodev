<?php
Route::get('/', function () { return redirect('/lala'); });
Route::get('lala','HomeController@home')->name('lala');
Route::get('/home', function () { return view('login'); });
Route::get('/pageAksesKhusus', function(){ return view('pageAksesKhusus'); });
Route::get('/MyProfile','users\ProfilController@show')->name('MyProfile');
Route::patch('/updateprof','users\ProfilController@update')->name('updateprof');

/****** Auth */
Route::patch('/forgotpass','AccountsController@update')->name('forgotpass');
Route::post('postLogin', 'LoginController@postLogin')->name('postLogin');
Route::post('add', [ 'uses'=> 'RegistrationController@registrationPost', 'as' => 'add']);
Route::post('reset_password_without_token', 'AccountsController@validatePasswordRequest')->name('reset_password_without_token');
Route::get('reset/{id}','LoginController@reset')->name('reset');
Route::get('daftar', 'RegistrationController@create');
Route::get('signin', 'LoginController@getLogin')->name('signin');
Route::get('signout', function(){ Auth::logout(); return redirect('/home');})->name('signout');

/******User Approval*/
Route::get('/userapproval', 'admin\ApprovalController@index')->name('userapproval');
Route::get('userapproval/{id}/update', [ 'uses'=>'admin\ApprovalController@update', 'as' =>'ua.update']);
    
/******User Management*/
Route::get('usermanagement','admin\UserListController@index')->name('usermanagement');
Route::get('showuser/{id}','admin\UserListController@show')->name('showuser');
Route::get('userblok/{id}','admin\UserListController@blok')->name('userblok');
Route::get('openblok/{id}','admin\UserListController@open')->name('openblok');
Route::patch('userupdate/{id}','admin\UserListController@update')->name('userupdate');

/******Data Master*/
// SKU
Route::get('sku','datamaster\masterController@sku')->name('sku');
Route::post('editsku/{id}','datamaster\masterController@editsku')->name('editsku');
Route::post('tambahsku','datamaster\masterController@tambahsku')->name('tambahsku');
// Klaim
Route::get('klaim','datamaster\masterController@klaim')->name('klaim');
Route::post('editklaim/{id}','datamaster\AllergenController@editklaim')->name('editklaim');
// Allergen
Route::get('allergen','datamaster\AllergenController@allergen')->name('allergen');
Route::post('edit_allergen/{id}','datamaster\AllergenController@edit_allergen')->name('edit_allergen');
Route::post('add_allergen','datamaster\masterController@add_allergen')->name('add_allergen');
// Principal
Route::get('principal','datamaster\PrincipalController@principal')->name('principal');
Route::get('inactive_principal/{id}','datamaster\PrincipalController@inactive_principal')->name('inactive_principal');
Route::get('active_principal/{id}','datamaster\PrincipalController@active_principal')->name('active_principal');
Route::post('edit_principal/{id}','datamaster\PrincipalController@edit_principal')->name('edit_principal');
Route::post('add_principal','datamaster\PrincipalController@add_principal')->name('add_principal');
// Supplier
Route::get('supplier','datamaster\SupplierController@supplier')->name('supplier');
Route::get('inactive_supplier/{id}','datamaster\SupplierController@inactive_supplier')->name('inactive_supplier');
Route::get('active_supplier/{id}','datamaster\SupplierController@active_supplier')->name('active_supplier');
Route::post('edit_supplier/{id}','datamaster\SupplierController@edit_supplier')->name('edit_supplier');
Route::post('add_supplier','datamaster\SupplierController@add_supplier')->name('add_supplier');
// Mesin
Route::get('mesin','datamaster\masterController@mesin')->name('mesin');
Route::post('addmesin','datamaster\masterController@addmesin')->name('addmesin');
// UOM
Route::get('datauom','datamaster\masterController@datauom')->name('datauom');
Route::post('uom','datamaster\masterController@uom')->name('uom');
// Pangan
Route::get('datapangan','datamaster\masterController@index')->name('datapangan');
// Brand
Route::get('brand', 'datamaster\BrandController@index')->name('brand.index');
//Departement
Route::get('DataDepartement','datamaster\DepartementController@dept')->name('dept');
Route::get('DeleteDepartement/{id}','datamaster\DepartementController@deldept')->name('deldept');
Route::post('AddDepartement','datamaster\DepartementController@adddept')->name('adddept');
Route::patch('storeupdatedept/{id}','datamaster\DepartementController@saveupdateDept')->name('storeupdatedept');
// Dasboard
Route::get('dasboardnr','pv\dasboardController@dasboardnr')->name('dasboardnr');
Route::get('dasboardpv','pv\dasboardController@dasboardpv')->name('dasboardpv');
Route::get('dasboardmanager','pv\dasboardController@dasboardmanager')->name('dasboardmanager');
Route::get('dasboardawal','pv\dasboardController@dasboard')->name('dasboardawal');
//Bahan Baku
Route::get('bahan_rd','datamaster\BahanBakuController@bahanrd')->name('bahan_rd');
Route::get('edit_bahan/{id}','datamaster\BahanBakuController@edit_bahan')->name('edit_bahan');
Route::get('registrasi_bb_rd','datamaster\BahanBakuController@registrasi')->name('registrasi_bb_rd');
Route::get('DataBahanBaku','datamaster\BahanBakuController@bahan')->name('bahanbaku');
Route::get('ActiveBahan/{id}', 'datamaster\BahanBakuController@active')->name('activebahan');
Route::get('NonActiveBahan/{id}','datamaster\BahanBakuController@nonactive')->name('nonactivebahan');
Route::post('addbahanrd','datamaster\BahanBakuController@addbahanrd')->name('addbahanrd');
Route::resource('curren', 'datamaster\CurrensController',['except' => [ 'show','create' ]]);
Route::resource('kategori', 'datamaster\KategoriController',['except' => [ 'show','create' ]]);
Route::resource('subkategori', 'datamaster\SubkategoriController',['except' => [ 'show','create' ]]);
Route::patch('storeupdateBahanBaku/{id}','datamaster\BahanBakuController@saveupdateBahan')->name('storeupdatebahan');
// Lab
Route::get('itemdesc','lab\LabController@itemdesc')->name('itemdesc');
Route::post('editItem/{id}','lab\LabController@editItem')->name('editItem');

// ****email//
Route::post('sendEmail/{id}', 'users\EmailController@sendEmail');
Route::post('sendEmailreject/{id}', 'users\EmailController@sendEmailreject');
Route::post('editTempemail/{id}','users\EmailController@editTempemail')->name('editTempemail');
Route::post('addTempemail','users\EmailController@addTempemail')->name('addTempemail');
Route::get('/email', function () { return view('send_email');});
Route::get('REmail','users\EmailController@REmail')->name('REmail');
Route::get('tempemail','users\EmailController@tempemail')->name('tempemail');
// Email PKP
Route::post('emailpkp/{id}', 'users\EmailController@emailpkp');
Route::get('approveemailpkp\{id}','users\EmailController@approveemailpkp')->name('approveemailpkp');
Route::get('rejectemailpkp\{id}','users\EmailController@rejectemailpkp')->name('rejectemailpkp');
// Email PDF
Route::post('emailpdf/{id}/{revisi}/{turunan}', 'users\EmailController@emailpdf');
Route::get('approveemailpdf\{id}','users\EmailController@approveemailpdf')->name('approveemailpdf');
Route::get('rejectemailpdf\{id}','users\EmailController@rejectemailpdf')->name('rejectemailpdf');
// Email Promo
Route::post('emailpromo/{id}/{revisi}/{turunan}', 'users\EmailController@emailpromo');
Route::get('approveemailpromo\{id}','users\EmailController@approveemailpromo')->name('approveemailpromo');
Route::get('rejectemailpromo\{id}','users\EmailController@rejectemailpromo')->name('rejectemailpromo');

/***** Report */
// Cetak Excel
Route::get('download_fs/{fs}/{wb1}/{wb2}','report\CetakFsController@download_fs')->name('download_fs');
Route::get('download_fs_pdf/{fs}/{wb1}/{wb2}','report\CetakFsController@download_fs_pdf')->name('download_fs_pdf');
Route::get('cetak','report\cetakController@download_project')->name('cetak');
Route::get('cetak_my_project','report\cetakController@download_my_project')->name('cetak_my_project');
Route::get('cetak_pdf','report\cetakController@download_project_pdf')->name('cetak_pdf');
Route::get('download_my_project_pdf','report\cetakController@download_my_project_pdf')->name('download_my_project_pdf');
Route::get('FOR_pkp/{formula}','report\downloadFORController@FOR_pkp')->name('FOR_pkp');
Route::get('FOR_pdf/{formula}','report\downloadFORController@FOR_pdf')->name('FOR_pdf');
Route::get('nutfact_bayangan_pkp/{formula}','report\downloadFORController@nutfact_bayangan_pkp')->name('nutfact_bayangan_pkp');
Route::post('export_notulen_pkp','report\cetakController@notulenpkp')->name('export_notulen_pkp');
// Halaman Report
Route::post('notulenpkpp','report\reportController@notulenpkpp')->name('notulenpkpp');
Route::post('updateUser', 'report\reportController@updateUser')->name('updateUser');
Route::post('konfirmasi_notulen','report\reportController@konfirmasi_notulen')->name('konfirmasi_notulen');
Route::get('notulenpkp/{bulan}/{tgl}/{info}','report\reportController@notulenpkp')->name('notulenpkp');
Route::get('tabulasi','report\reportController@tabulasi')->name('tabulasi');
Route::get('reportnotulen','report\reportController@reportnotulen')->name('reportnotulen');

/***** PV */
//--> PKP <--//
Route::post('uploadpkp','pv\pkpController@uploaddatapkp')->name('uploadpkp');
Route::get('download/{id}','pv\pkpController@downloadpkp')->name('download');
Route::get('datapengajuan','pv\PengajuanPkpController@pengajuan')->name('datapengajuan');
Route::get('formpkp','pv\pkpController@formpkp')->name('formpkp');
Route::get('drafpkp','pv\pkpController@drafpkp')->name('drafpkp');
Route::get('listpkp','pv\pkpController@listpkp')->name('listpkp');
Route::get('lihatpkp/{id_project}','pv\pkpController@lihatpkp')->name('lihatpkp');
Route::get('temppkpumum/{id}/{revisi}/{turunan}/{kemas}','pv\templateController@templatepkpumum')->name('temppkpumum');
Route::get('temppkpbaku/{id}/{revisi}/{turunan}/{kemas}','pv\templateController@templatepkpbaku')->name('temppkpbaku');
Route::get('temppkpkemas/{id}/{revisi}/{turunan}/{kemas}','pv\templateController@templatepkpkemas')->name('temppkpkemas');
Route::get('rekappkp/{id_project}/{id_pkp}','pv\pkpController@rekappkp')->name('rekappkp');
Route::get('naikversipkp/{id}/{revisi}/{turunan}/{kemas}','pv\templateController@upversionpkp')->name('naikversipkp');
//Sent PKP
Route::post('SentPkpToRD/{id_project}','pv\PengajuanPkpController@SentPkpToRD')->name('SentPkpToRD');
Route::post('sentRevisiPkpRD/{id_project}','pv\PengajuanPkpController@sentRevisiPkpRD')->name('sentRevisiPkpRD');
Route::post('SentPkpToUser/{id_project}','pv\PengajuanPkpController@SentPkpToUser')->name('SentPkpToUser');
// Update PKP
Route::get('konfigurasi/{id}','pv\pkpController@konfigurasi')->name('konfigurasi');
Route::post('updatedPKP/{id_pkp}/{revisi}/{turunan}', 'pv\pkpController@updatedPKP')->name('updatedPKP');
Route::post('updatedPKP2/{id_pkp}/{revisi}/{turunan}/{kemas}', 'pv\pkpController@updatedPKP2')->name('updatedPKP2');
Route::post('EditTimelinepkp/{id}','pv\pkpController@EditTimeline')->name('EditTimelinepkp');
Route::post('edittype/{id_project}','pv\pkpController@edittype')->name('edittype');
Route::post('freeze/{id}','pv\pkpController@freeze')->name('freeze');
Route::post('activepkp/{id}','pv\pkpController@activepkp')->name('activepkp');
// Create PKP
Route::get('buatpkp/{id_project}','pv\pkpController@buatpkp')->name('buatpkp');
Route::get('buatpkp1/{id_project}/{id_pkp}','pv\pkpController@buatpkp1')->name('buatpkp1');
Route::get('datatambahanpkp/{id}','pv\pkpController@uploadpkp')->name('datatambahanpkp');
Route::post('NewPKP','pv\pkpController@NewPKP')->name('NewPKP');
Route::post('infogambar','pv\pkpController@infogambar')->name('infogambar');
Route::post('createpkp/{id}','pv\pkpController@createpkp')->name('createpkp');
Route::post('improve/{id}/{revisi}/{turunan}/{kemas}','pv\templateController@improve')->name('improve');
// Close or Delete PKP
Route::get('droppkp/{id}','pv\pkpController@drop')->name('droppkp');
Route::get('hapuspkp/{id}','pv\pkpController@hapuspkp')->name('hapuspkp');
Route::get('hapuslaunch/{id}/{revisi}/{turunan}','pv\pkpController@deletelaunch')->name('hapuslaunch');
Route::post('closeproject/{id}','pv\PengajuanPkpController@closeproject')->name('closeproject');

//--> PKP PROMO <--//
Route::get('downloadpromo/{id}/{revisi}/{turunan}','pv\promoController@downloadpromo')->name('downloadpromo');
Route::get('promo','pv\promoController@promo')->name('promo');
Route::get('drafpromo','pv\promoController@drafpromo')->name('drafpromo');
Route::get('rekappromo/{id_pkp_promo}','pv\promoController@daftarpromo')->name('rekappromo');
Route::get('promo4/{id_pkp_promo}/{revisi}/{turunan}','pv\promoController@step4')->name('promo4');
Route::get('uploadpkppromo/{id_pkp_promo}/{revisi}/{turunan}','pv\promoController@uploadpromo')->name('uploadpkppromo');
Route::get('listpromo','pv\promoController@listpromo')->name('listpromo');
Route::get('lihatpromo/{id}/{revisi}/{turunan}','pv\promoController@lihatpromo')->name('lihatpromo');
Route::post('freezepromo/{id}','pv\promoController@freeze')->name('freezepromo');
Route::post('uploadpromo','pv\promoController@uploaddatapkp')->name('uploadpromo');
// Create Promo
Route::get('datapromo/{id_project}','pv\promoController@buatpromo')->name('datapromo');
Route::get('datapromo11/{id_project}/{revisi}/{turunan}','pv\promoController@buatpromo1')->name('datapromo11');
Route::post('NewPromo','pv\promoController@NewPromo')->name('NewPromo');
Route::post('infogambarpromo','pv\promoController@infogambarpromo')->name('infogambarpromo');
Route::post('datapromo1','pv\promoController@datapromo')->name('datapromo1');
Route::post('allocation','pv\promoController@postSave')->name('allocation');
Route::post('applicationpromo','pv\promoController@applicationpromo')->name('applicationpromo');
// Update Promo
Route::get('naikversipromo/{id}/{revisi}/{turunan}','pv\templateController@upversionpromo')->name('naikversipromo');
Route::get('InactiveFreeze/{id}','pv\promoController@InactiveFreeze')->name('InactiveFreeze');
Route::post('ubahTM/{id}','pv\promoController@ubahTM')->name('ubahTM');
Route::post('UbahTimeline/{id}','pv\promoController@UbahTimeline')->name('UbahTimeline');
Route::post('SentToUser/{id_project_pdf}','pv\promoController@SentToUser')->name('SentToUser');
Route::post('sentPromoToRD/{id_project}/{revisi}/{turunan}','pv\PengajuanPromoController@sentPromoToRD')->name('sentPromoToRD');
Route::post('edittypepromo/{id}','pv\promoController@edittype')->name('edittypepromo');
Route::post('editdatapromo2/{id_pkp_promo}/{revisi}/{turunan}','pv\promoController@editdatapromo2')->name('editdatapromo2');
Route::post('editdatapromo/{id_pkp_promo}/{revisi}/{turunan}','pv\promoController@editdatapromo')->name('editdatapromo');
Route::post('editdatastep4/{id_product_allocation}/{turunan}','pv\promoController@editdatastep4')->name('editdatastep4');
// Delete
Route::get('deletedatastep4/{id_pkp_promo}/{turunan}','pv\promoController@deletedatastep4')->name('deletedatastep4');
Route::get('hapuspromo/{id}','pv\promoController@hapuspromo')->name('hapuspromo');

//--> PDF <--//
Route::get('drafpdf','pv\pdfController@drafpdf')->name('drafpdf');
Route::get('listpdf','pv\pdfController@listpdf')->name('listpdf');
Route::get('formpdf','pv\pdfController@formpdf')->name('formpdf');
Route::get('lihatpdf/{id_project_pdf}/{revisi}/{turunan}','pv\pdfController@lihatpdf')->name('lihatpdf');
Route::get('activepdf/{id}','pv\pdfController@activepdf')->name('activepdf');
Route::get('naikversipdf/{id}/{recisi}/{turunan}','pv\templateController@upversionpdf')->name('naikversipdf');
Route::post('freezepdf/{id}','pv\pdfController@freeze')->name('freezepdf');
// Sent PDF
Route::post('sentpdf/{id_project_pdf}/{revisi}/{turunan}','pv\PengajuanPdfController@sentpdf')->name('sentpdf');
Route::post('SentPdfToUser/{id_project_pdf}','pv\PengajuanPdfController@SentPdfToUser')->name('SentPdfToUser');
Route::post('SentRevisiToRD/{id_project_pdf}/{revisi}/{turunan}','pv\PengajuanPdfController@SentRevisiToRD')->name('SentRevisiToRD');
// Create Data
Route::get('buatpdf/{id_project_pdf}','pv\pdfController@buatpdf')->name('buatpdf');
Route::get('buatpdf1/{id_project_pdf}/{revisi}/{turunan}','pv\pdfController@buatpdf1')->name('buatpdf1');
Route::get('datatambahanpdf/{id_project_pdf}/{revisi}/{turunan}','pv\pdfController@uploadpdf')->name('datatambahanpdf');
Route::post('NewPDf','pv\pdfController@NewPDf')->name('NewPDf');
Route::post('infogambarpdf','pv\pdfController@infogambarpdf')->name('infogambarpdf');
Route::post('CreatePdf','pv\pdfController@CreatePdf')->name('CreatePdf');
// Edit data
Route::get('konfig/{id}','pv\pdfController@konfigurasi')->name('konfig');
Route::post('UpdatePdf/{id_pdf}/{revisi}/{turunan}','pv\pdfController@UpdatePdf')->name('UpdatePdf');
Route::post('UpdatePdf2/{id_pdf}/{revisi}/{turunan}','pv\pdfController@UpdatePdf2')->name('UpdatePdf2');
Route::post('EditTimeline/{id}','pv\pdfController@EditTimeline')->name('EditTimeline');
Route::post('ubahTMpdf/{id}','pv\pdfController@ubahTMpdf')->name('ubahTMpdf');
// Report data
Route::get('downloadpdf/{id_project_pdf}/{revisi}/{turunan}','pv\pdfController@downloadpdf')->name('downloadpdf');
Route::get('rekappdf/{id_project_pdf}','pv\pdfController@daftarpdf')->name('rekappdf');
Route::get('temppdf/{id}','pv\templateController@template')->name('temppdf');
Route::post('uploadpdf','pv\pdfController@uploaddatapdf')->name('uploadpdf');
// Hapus data
Route::get('hapuspdf/{id}','pv\pdfController@hapuspdf')->name('hapuspdf');
Route::get('destroydata/{id_pictures}','pv\pdfController@destroydata')->name('destroydata');

// ******Manager //
// PKP
Route::get('listpkprka','manager\PkpManagerController@listpkp')->name('listpkprka');
Route::get('daftarpkp/{id_project}','manager\PkpManagerController@daftarpkp')->name('daftarpkp');
Route::get('pkplihat/{id_project}','manager\PkpManagerController@lihatpkp')->name('pkplihat');
Route::post('pengajuan','manager\PkpManagerController@pengajuan')->name('pengajuan');
Route::post('alihkan/{id}','manager\PkpManagerController@alihkan')->name('alihkan');
Route::post('approve1/{id}','manager\PkpManagerController@approve1')->name('approve1');
Route::post('approve2/{id}','manager\PkpManagerController@approve2')->name('approve2');
// PDF
Route::get('listpdfrka','manager\PdfManagerController@listpdf')->name('listpdfrka');
Route::get('daftarpdf/{id}','manager\PdfManagerController@daftarpdf')->name('daftarpdf');
Route::get('pdflihat/{id}/{revisi}/{turunan}','manager\PdfManagerController@lihatpdf')->name('pdflihat');
Route::post('pengajuanpdf','manager\PdfManagerController@pengajuanpdf')->name('pengajuanpdf');
Route::post('alihkanpdf/{id}','manager\PdfManagerController@alihkanpdf')->name('alihkanpdf');
Route::post('approvepdf1/{id}','manager\PdfManagerController@approve1')->name('approvepdf1');
Route::post('approvepdf2/{id}','manager\PdfManagerController@approve2')->name('approvepdf2');
// PROMO
Route::get('listpromoo','manager\PromoManagerController@listpromo')->name('listpromoo');
Route::get('daftarpromo/{id}','manager\PromoManagerController@daftarpromo')->name('daftarpromo');
Route::get('promolihat/{id}/{revisi}/{turunan}','manager\PromoManagerController@lihatpromo')->name('promolihat');
Route::post('pengajuanpromo','manager\PromoManagerController@pengajuanpromo')->name('pengajuanpromo');
Route::post('alihkanpromo/{id}','manager\PromoManagerController@alihkanpromo')->name('alihkanpromo');
Route::post('approvepromo1/{id}','manager\PromoManagerController@approve1')->name('approvepromo1');
Route::post('approvepromo2/{id}','manager\PromoManagerController@approve2')->name('approvepromo2');

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
Route::get('st/{id}/{pkp}/{formula}','formula\storageController@showStorage')->name('st');
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
Route::get('getitemdesc/{id}','ajax\AjaxController@getitemdesc')->name('getitemdesc');

/***** Feasibility**/
// pengajuan FS dari Pv
Route::post('approvefs/{fs}','feasibility\ApproveFsController@approvefs')->name('approvefs');
Route::post('tolakfs/{fs}','feasibility\ApproveFsController@rejectfs')->name('tolakfs');
Route::get('batalReject/{fs}','feasibility\ApproveFsController@batalReject')->name('batalReject');
Route::get('batalApprove/{fs}','feasibility\ApproveFsController@batalApprove')->name('batalApprove');
// PKP
Route::post('ajukanPKP/{id}/{for}','PengajuanFS\PengajuanFsController@ajukanPKP')->name('ajukanPKP');
Route::get('pengajuanFS_PKP/{id}/{for}','PengajuanFS\PengajuanFsController@formPengajuanFS')->name('PengajuanFS_PKP');
Route::get('BatalAjukanFS/{id}/{for}','PengajuanFs\PengajuanFsController@BatalAjukanFS')->name('BatalAjukanFS');
// PDF
Route::post('ajukanPDF/{id}/{for}','PengajuanFS\PengajuanFsController@ajukanPDF')->name('ajukanPDF');
Route::get('PengajuanFS_PDF/{id}/{for}','PengajuanFS\PengajuanFsController@formPengajuanFS_pdf')->name('PengajuanFS_PDF');
Route::get('BatalAjukanFS_PDF/{id}/{for}','PengajuanFs\PengajuanFsController@BatalAjukanFS_PDF')->name('BatalAjukanFS_PDF');
// List FS
Route::get('gabung/{id}/{fs}','feasibility\ListFsController@gabung')->name('gabung');
Route::get('batalgabung/{id}/{fs}','feasibility\ListFsController@batalgabung')->name('batalgabung');
Route::get('comfirmfs/{fs}','feasibility\UpFsController@comfirmfs')->name('comfirmfs');
Route::get('revisifs/{fs}','feasibility\UpFsController@revisifs')->name('revisifs');
Route::post('up/{fs}','feasibility\UpFsController@up')->name('up');
// PKP
Route::get('listPkpFs/{id}','feasibility\ListFsController@listPkpFs')->name('listPkpFs');
Route::get('FsPKP','feasibility\ListFsController@FsPKP')->name('FsPKP');
// PDF
Route::get('listPdfFs/{id}','feasibility\ListFsController@listPdfFs')->name('listPdfFs');
Route::get('FsPDF','feasibility\ListFsController@FsPDF')->name('FsPDF');

// Form Pengajuan FS dari proses
Route::get('DetailPengajuanFsPKP/{pkp}/{id}/{fs}','PengajuanFS\PengajuanFsController@DetailPengajuanFsPKP')->name('DetailPengajuanFsPKP');
Route::get('DetailPengajuanFsPDF/{pdf}/{id}/{fs}','PengajuanFS\PengajuanFsController@DetailPengajuanFsPDF')->name('DetailPengajuanFsPDF');
Route::post('detailoverview','PengajuanFS\PengajuanFsController@overview')->name('detailoverview');
Route::post('user_fs/{id}','PengajuanFS\PengajuanFsController@user_fs')->name('user_fs');
Route::post('final/{fs}/{wb1}/{wb2}','PengajuanFS\PengajuanFsController@final')->name('final');
// Workbook FS
Route::get('workbookfs/{id}/{fs}','workbookFS\WorkbookFsController@workbookfs')->name('workbookfs');
Route::get('overview/{fs}/{wb1}/{wb2}','workbookFS\WorkbookFsController@overview')->name('overview');
Route::get('overviewpdf/{fs}/{wb1}/{wb2}','workbookFS\WorkbookFsController@overviewpdf')->name('overviewpdf');
Route::get('reportinfo/{info}/{id}','workbookFS\WorkbookFsController@reportinfo')->name('reportinfo');
Route::get('addFs/{id}/{fs}','workbookFS\WorkbookFsController@addFs')->name('addFs');
Route::get('upProses/{ws}','workbookFS\UpFsController@upProses')->name('upProses');
Route::get('upKemas/{ws}','workbookFS\UpFsController@upKemas')->name('upKemas');
Route::get('compare/{data}/{id}','feasibility\CompareController@compare')->name('compare');
Route::get('destroyCompare/{data}/{id}','feasibility\CompareController@destroyCompare')->name('destroyCompare');
Route::post('addcompare/{id}','feasibility\CompareController@addcompare')->name('addcompare');
// Workbook User_Proses
Route::get('datamesin/{id}/{fs}/{ws}','RDproses\MesinController@index')->name('datamesin');
Route::get('dataOH/{id}/{fs}/{ws}','RDproses\MesinController@dataOH')->name('dataOH');
Route::get('AllergenBaru/{id}/{fs}/{ws}','RDproses\MesinController@AllergenBaru')->name('AllergenBaru');
Route::get('destroymesin/{id}','RDproses\MesinController@destroy')->name('destroymesin');
Route::get('useMesin/{id}/{ws}','RDproses\MesinController@useMesin')->name('useMesin');
Route::get('detailProses/{id}/{fs}/{ws}','RDproses\MesinController@detailProses')->name('detailProses');
Route::post('Mdata','RDproses\MesinController@Mdata')->name('Mdata');
Route::post('runtime','RDproses\MesinController@runtime')->name('runtime');
Route::post('ohOther','RDproses\MesinController@ohOther')->name('ohOther');
Route::post('lini','RDproses\MesinController@lini')->name('lini');
Route::post('judul','RDproses\MesinController@judul')->name('judul');
// Workbook Lab
Route::get('datalab/{id}/{fs}','lab\LabController@index')->name('datalab');
Route::get('AddItem/{id}/{fs}','lab\LabController@AddItem')->name('AddItem');
Route::post('adddesc','lab\LabController@add')->name('adddesc');
Route::post('item','lab\LabController@item')->name('item');
// Workbook Kemas
Route::get('datakemas/{id}/{fs}/{ws}','RDkemas\KonsepController@index')->name('datakemas');
Route::get('download_template','RDkemas\TempKemasController@download_template')->name('download_template');
Route::get('hasilnya/{id}/{fs}/{ws}','RDkemas\KonsepController@hasilnya')->name('hasilnya');
Route::post('insert','RDkemas\KonsepController@insert')->name('insert');
// Workbook Maklon
Route::Post('FsMaklon/{fs}','Maklon\MaklonController@FsMaklon')->name('FsMaklon');
// Costing
Route::get('listFsConting','Costing\ListFsCostingController@listFsConting')->name('listFsConting');
Route::get('CostingDownloadPKP/{id}/{for}/{fs}','Costing\DownloadController@CostingDownloadPKP')->name('CostingDownloadPKP');
Route::get('CostingDownloadPDF/{id}/{for}/{fs}','Costing\DownloadController@CostingDownloadPDF')->name('CostingDownloadPDF');