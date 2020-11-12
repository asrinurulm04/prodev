<?php

Route::get('/', function () { return redirect('/lala'); });
Route::get('lala','HomeController@home')->name('lala');
Route::get('/home', function () { return view('welcome'); });

Route::get('/pageAksesKhusus', function(){ return view('pageAksesKhusus'); });
Route::get('/MyProfile','users\ProfilController@show')->name('MyProfile');
Route::patch('/updateprof','users\ProfilController@update')->name('updateprof');

/** Auth */
Route::get('daftar', 'users\RegistrationController@create');
Route::post('add', [
    'uses'=> 'users\RegistrationController@registrationPost',
    'as' => 'add']);
 
Route::get('signin', 'LoginController@getLogin')->name('signin');
Route::post('postLogin', 'LoginController@postLogin')->name('postLogin');
Route::get('signout', function(){
    Auth::logout();
    return redirect('/home');
})->name('signout');

/****** ADMIN**/
//email
Route::get('/email', function () { return view('send_email');});
Route::post('sendEmail/{id}', 'Email@sendEmail');
Route::post('sendEmailreject/{id}', 'Email@sendEmailreject');
Route::post('emailpkp/{id}/{revisi}/{turunan}', 'Email@emailpkp');
Route::get('approveemailpkp\{id}','Email@approveemailpkp')->name('approveemailpkp');
Route::get('rejectemailpkp\{id}','Email@rejectemailpkp')->name('rejectemailpkp');
Route::get('approveemailpdf\{id}','Email@approveemailpdf')->name('approveemailpdf');
Route::get('rejectemailpdf\{id}','Email@rejectemailpdf')->name('rejectemailpdf');
Route::get('approveemailpromo\{id}','Email@approveemailpromo')->name('approveemailpromo');
Route::get('rejectemailpromo\{id}','Email@rejectemailpromo')->name('rejectemailpromo');
Route::post('emailpromo/{id}/{revisi}/{turunan}', 'Email@emailpromo');
Route::post('emailpdf/{id}/{revisi}/{turunan}', 'Email@emailpdf');
Route::get('REmail','Email@REmail')->name('REmail');
// perubahan data form

Route::get('datases','admin\ApprovalController@datases')->name('datases');
Route::post('ses','admin\ApprovalController@ses')->name('ses');
Route::get('bacapesan/{id}','pv\pkpController@bacapesan')->name('bacapesan');
Route::get('pkpklaim/{id}','pv\pkpController@klaim')->name('pkpklaim');

Route::post('edittuser/{id_project}','pv\pkpController@edituser')->name('edittuser');
Route::post('editt/{id_project}','pv\pkpController@edit')->name('editt');
Route::post('sentpkp/{id_project}/{revisi}/{turunan}','pv\pkpController@sentpkp')->name('sentpkp');

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
Route::get('DataDepartement','datamaster\DepartementController@dept')->name('dept');
Route::get('DeleteDepartement/{id}','datamaster\DepartementController@deldept')->name('deldept');
Route::post('AddDepartement','datamaster\DepartementController@adddept')->name('adddept');
Route::patch('storeupdatedept/{id}','datamaster\DepartementController@saveupdateDept')->name('storeupdatedept');

Route::get('datauom','admin\ApprovalController@datauom')->name('datauom');
Route::post('uom','admin\ApprovalController@uom')->name('uom');
Route::post('ubahjenis/{id_jenis}','admin\UserListController@isijenis')->name('ubahjenis');

Route::get('DataBahanBaku','datamaster\BahanBakuController@bahan')->name('bahanbaku');
Route::get('DeleteBahanBaku/{id}','datamaster\BahanBakuController@delbahan')->name('delbahan');
Route::get('ActiveBahan/{id}', 'datamaster\BahanBakuController@active')->name('activebahan');
Route::get('NonActiveBahan/{id}','datamaster\BahanBakuController@nonactive')->name('nonactivebahan');
Route::post('AddBahanBaku','datamaster\BahanBakuController@addbahan')->name('addbahan');
Route::patch('storeupdateBahanBaku/{id}','datamaster\BahanBakuController@saveupdateBahan')->name('storeupdatebahan');

Route::get('brand', 'datamaster\BrandController@index')->name('brand.index');
Route::post('brand/store','datamaster\BrandController@store')->name('brand.store');
Route::post('brand/{id}/update', 'datamaster\BrandController@update')->name('brand.update');
Route::get('brand/{id}/destroy', 'datamaster\BrandController@destroy')->name('brand.destroy');

Route::get('exportBpom','datamaster\datapanganController@exportBpom')->name('exportBpom');
Route::get('exportAkg','datamaster\datapanganController@exportAkg')->name('exportAkg');
Route::get('exportklaim','datamaster\datapanganController@export_klaim')->name('exportklaim');
Route::get('exportarsen','datamaster\datapanganController@exportarsen')->name('exportarsen');
Route::get('export','datamaster\datapanganController@export_excel')->name('export');
Route::get('exportsku','datamaster\datapanganController@exportsku')->name('exportsku');
Route::post('editpangan/{id}','datamaster\datapanganController@editbpom')->name('editpangan');
Route::post('editakg/{id_akg}','datamaster\datapanganController@editakg')->name('editakg');
Route::post('editsku/{id}','datamaster\datapanganController@editsku')->name('editsku');
Route::post('editklaim/{id}','datamaster\datapanganController@editklaim')->name('editklaim');
Route::post('editarsen/{id}','datamaster\datapanganController@editarsen')->name('editarsen');

Route::post('tambahpangan','datamaster\datapanganController@tambahpangan')->name('tambahpangan');
Route::post('tambahakg','datamaster\datapanganController@tambahakg')->name('tambahakg');
Route::post('tambahsku','datamaster\datapanganController@tambahsku')->name('tambahsku');
Route::post('tambaharsen','datamaster\datapanganController@tambaharsen')->name('tambaharsen');

Route::get('kemasexport','datamaster\datapanganController@kemas')->name('kemasexport');
Route::get('akg','datamaster\datapanganController@akg')->name('akg');
Route::get('klaim','datamaster\datapanganController@klaim')->name('klaim');
Route::get('sku','datamaster\datapanganController@sku')->name('sku');
Route::get('arsen','datamaster\datapanganController@arsen')->name('arsen');
Route::get('datapangan','datamaster\datapanganController@index')->name('datapangan');

Route::resource('subbrand', 'datamaster\subbrandController',['except' => [ 'show','create' ]]);
Route::resource('curren', 'datamaster\CurrensController',['except' => [ 'show','create' ]]);
Route::resource('satuan', 'datamaster\SatuanController',['except' => [ 'show','create' ]]);
Route::resource('gudang', 'datamaster\GudangController',['except' => [ 'show','create' ]]);
Route::resource('maklon', 'datamaster\MaklonController',['except' => [ 'show','create' ]]);
Route::resource('produksi', 'datamaster\ProduksiController',['except' => [ 'show','create' ]]);
Route::resource('kategori', 'datamaster\KategoriController',['except' => [ 'show','create' ]]);
Route::resource('subkategori', 'datamaster\SubkategoriController',['except' => [ 'show','create' ]]);
Route::resource('kelompok', 'datamaster\KelompokController',['except' => [ 'show','create' ]]);
Route::resource('tarkon', 'datamaster\TarkonController',['except' => [ 'show','create' ]]);

/***** PV */
Route::post('notpromo','pv\pkp2Controller@notpromo')->name('notpromo');
Route::post('notpdf','pv\pkp2Controller@notpdf')->name('notpdf');
Route::post('notpkp','pv\pkp2Controller@notpkp')->name('notpkp');
Route::get('notulenpkp','pv\pkp2Controller@notulenpkp')->name('notulenpkp');
Route::post('notulenpkpp','pv\pkp2Controller@notulenpkpp')->name('notulenpkpp');
Route::get('notulenpdf','pv\pkp2Controller@notulenpdf')->name('notulenpdf');
Route::post('notulenpdff','pv\pkp2Controller@notulenpdff')->name('notulenpdff');
Route::get('indexnotulenpromo','pv\pkp2Controller@indexnotulenpromo')->name('indexnotulenpromo');
Route::post('notulenpromoo','pv\pkp2Controller@notulenpromoo')->name('notulenpromoo');

Route::get('tabulasi','pv\pkp2Controller@tabulasi')->name('tabulasi');
Route::post('check','pv\pkp2Controller@checkpkp')->name('check');
Route::post('checkpdf','pv\pkp2Controller@checkpdf')->name('checkpdf');
Route::post('checkpromo','pv\pkp2Controller@checkpromo')->name('checkpromo');
Route::get('editpkpall','pv\pkp2Controller@editpkpall')->name('editpkpall');
Route::get('hapuscheck','pv\pkp2Controller@hapuscheck')->name('hapuscheck');
Route::get('hapuscheckpdf','pv\pkp2Controller@hapuscheckpdf')->name('hapuscheckpdf');
Route::get('hapuscheckpromo','pv\pkp2Controller@hapuscheckpromo')->name('hapuscheckpromo');
Route::get('editpdfall','pv\pkp2Controller@editpdfall')->name('editpdfall');
Route::get('hapuspdf1/{id}','pv\pkp2Controller@deletepdf1')->name('hapuspdf1');

Route::get('deletepkp1/{id}','pv\pkp2Controller@deletepkp1')->name('deletepkp1');
Route::get('deletepromo1/{id}','pv\pkp2Controller@deletepromo1')->name('deletepromo1');
Route::post('update_pkp','pv\pkp2Controller@update_pkp')->name('update_pkp');
Route::post('notulen_pkp','pv\pkp2Controller@notulen_pkp')->name('notulen_pkp');
Route::post('update_pdf','pv\pkp2Controller@update_pdf')->name('update_pdf');
Route::post('update_promo','pv\pkp2Controller@update_promo')->name('update_promo');
Route::get('editpromoall','pv\pkp2Controller@editpromoall')->name('editpromoall');
Route::get('approvalformula','pv\FormulaApprovalController@listapproval')->name('approvalformula');
Route::get('detailproject/{id}','pv\FormulaApprovalController@detailproject')->name('detailproject');
Route::get('LihatFormulaPv/{id}','pv\FormulaApprovalController@lihatformulapv')->name('lihatformulapv');
Route::get('BatalkanProject/{id}','pv\FormulaApprovalController@batalkanproject')->name('batalkanprojectbypv');

Route::get('datapengajuan','pv\pkpController@pengajuan')->name('datapengajuan');
Route::get('datapengajuan1','pv\pkpController@pengajuan1')->name('datapengajuan1');
Route::get('approvedformula','pv\FormulaApprovalController@listapproved')->name('approvedformula');
Route::get('story','pv\pkpController@story')->name('story');
Route::get('catatanrevisi','pv\pkpController@catatanrevisi')->name('catatanrevisi');
Route::post('prioritas/{id}','pv\pkpController@prioritas')->name('prioritas');

Route::post('approve1/{id}','pv\pkpController@approve1')->name('approve1');
Route::post('approve2/{id}','pv\pkpController@approve2')->name('approve2');
Route::get('dasboardpv','pv\pkpController@dasboardpv')->name('dasboardpv');
Route::get('dasboardnr','pv\pkpController@dasboardnr')->name('dasboardnr');
Route::get('dasboardcs','pv\pkpController@dasboardcs')->name('dasboardcs');
Route::get('approveformula/{id}','pv\FormulaApprovalController@approve')->name('approveformula');
Route::get('rejectformula/{id}','pv\FormulaApprovalController@reject')->name('rejectformula');
Route::get('ajukanfs/{id}','devwb\PengajuanFormulaController@fs')->name('ajukanfs');
route::get('ajukanfn/{id}','devwb\PengajuanFormulaController@nf')->name('ajukanfn');

// PKP
Route::get('download/{id}/{revisi}/{turunan}','pv\pkpController@downloadpkp')->name('download');
Route::get('formpkp','pv\pkpController@formpkp')->name('formpkp');
Route::post('datapkp','pv\pkpController@datapkp')->name('datapkp');
Route::get('drafpkp','pv\pkpController@drafpkp')->name('drafpkp');
Route::get('listpkp','pv\pkpController@listpkp')->name('listpkp');
Route::get('buatpkp/{id_project}/{revisi}/{turunan}','pv\pkpController@buatpkp')->name('buatpkp');
Route::get('buatpkp1/{id_project}','pv\pkpController@buatpkp1')->name('buatpkp1');
Route::get('lihatpkp/{id_project}/{revisi}/{turunan}','pv\pkpController@lihatpkp')->name('lihatpkp');
Route::post('terima/{id_project}','pv\pkpController@terima')->name('terima');
Route::get('temppkp/{id}','pv\pkp2Controller@template')->name('temppkp');

Route::get('konfigurasi/{id}/{revisi}/{turunan}','pv\pkpController@konfigurasi')->name('konfigurasi');
Route::get('getpangan/{id}','ajax\getGet@getpangan')->name('getpangan');
Route::get('getolahan/{id}','ajax\getGet@getolahan')->name('getolahan');
Route::get('getkatpangan/{id}','ajax\getGet@getkatpangan')->name('getkatpangan');
Route::get('getkomponen/{id}','ajax\getGet@getkomponen')->name('getkomponen');
Route::get('getdetail/{id}','ajax\getGet@getdetailklaim')->name('getdetail');
Route::get('reportnotulen','pv\pkp2Controller@reportnotulen')->name('reportnotulen');

Route::get('approvesamplepkp/{id}','pv\pkpController@approvesamplepkp')->name('approvesamplepkp');
Route::post('rejectsamplepkp/{id}','pv\pkpController@rejectsamplepkp')->name('rejectsamplepkp');
Route::get('finalsamplepkp/{id}/{sample}','pv\pkpController@finalsamplepkp')->name('finalsamplepkp');
Route::get('unfinalsamplepkp/{id}/{sample}','pv\pkpController@unfinalsamplepkp')->name('unfinalsamplepkp');

Route::get('merk/{id}','pv\pkpController@merkAjax')->name('merk');
Route::post('freeze/{id}','pv\pkpController@freeze')->name('freeze');
Route::post('infogambar','pv\pkpController@infogambar')->name('infogambar');
Route::post('ubahTMpkp/{id}','pv\pkpController@ubahTMpkp')->name('ubahTMpkp');
Route::get('activepkp/{id}','pv\pkpController@activepkp')->name('activepkp');

Route::post('TMubahpkp/{id}','pv\pkpController@TMubah')->name('TMubahpkp');
Route::post('edittype/{id_project}','pv\pkpController@edittype')->name('edittype');
Route::get('rekappkp/{id_project}','pv\pkpController@rekappkp')->name('rekappkp');
Route::get('datatambahanpkp/{id}/{revisi}/{turunan}','pv\pkpController@uploadpkp')->name('datatambahanpkp');
Route::post('uploadpkp','pv\pkpController@uploaddatapkp')->name('uploadpkp');
Route::get('bagian1/{id_project}/{revisi}/{turunan}','pv\pkpController@step1')->name('bagian1');
Route::get('bagian2/{id_project}','pv\pkpController@step2')->name('bagian2');

Route::post('editnotulen','pv\pkp2Controller@editnote')->name('editnotulen');
Route::post('tippp','pv\pkpController@tipp')->name('tippp');
Route::get('naikversipkp/{id}/{revisi}/{turunan}','pv\pkpController@upversionpkp')->name('naikversipkp');
Route::post('updatetipp/{id_pkp}/{revisi}/{turunan}', 'pv\pkpController@updatetipp')->name('updatetipp');
Route::post('updatetipp2/{id_pkp}/{revisi}/{turunan}', 'pv\pkpController@updatetipp2')->name('updatetipp2');

Route::get('cetak','cetakController@download_project')->name('cetak');
Route::get('cetak_my_project','cetakController@download_my_project')->name('cetak_my_project');
Route::get('cetak_pdf','cetakController@download_project_pdf')->name('cetak_pdf');

//PKP PROMO
Route::get('downloadpromo/{id}/{revisi}/{turunan}','pv\promoController@downloadpromo')->name('downloadpromo');
Route::get('promo','pv\promoController@promo')->name('promo');
Route::get('datapromo/{id_project}','pv\promoController@buatpromo')->name('datapromo');
Route::get('datapromo11/{id_project}/{revisi}/{turunan}','pv\promoController@buatpromo1')->name('datapromo11');
Route::post('isipromo','pv\promoController@isipromo')->name('isipromo');
Route::post('ubahTM/{id}','pv\promoController@ubahTM')->name('ubahTM');
Route::get('activepromo/{id}','pv\promoController@active')->name('activepromo');
Route::post('TMubah/{id}','pv\promoController@TMubah')->name('TMubah');
Route::post('infogambarpromo','pv\promoController@infogambarpromo')->name('infogambarpromo');
Route::post('freezepromo/{id}','pv\promoController@freeze')->name('freezepromo');

Route::get('approvesamplepromo/{id}','pv\promoController@approvesamplepromo')->name('approvesamplepromo');
Route::post('rejectsamplepromo/{id}','pv\promoController@rejectsamplepromo')->name('rejectsamplepromo');
Route::get('finalsamplepromo/{id}/{sample}','pv\promoController@finalsamplepromo')->name('finalsamplepromo');
Route::get('unfinalsamplepromo/{id}/{sample}','pv\promoController@unfinalsamplepromo')->name('unfinalsamplepromo');

Route::get('drafpromo','pv\promoController@drafpromo')->name('drafpromo');
Route::get('rekappromo/{id_pkp_promo}','pv\promoController@daftarpromo')->name('rekappromo');
Route::get('promo1/{id_pkp_promo}','pv\promoController@step1')->name('promo1');
Route::get('promo11/{id_pkp_promo}/{revisi}/{turunan}','pv\promoController@promo1')->name('promo11');
Route::get('promo4/{id_pkp_promo}/{revisi}/{turunan}','pv\promoController@step4')->name('promo4');
Route::post('uploadpromo','pv\promoController@uploaddatapkp')->name('uploadpromo');
Route::get('uploadpkppromo/{id_pkp_promo}/{revisi}/{turunan}','pv\promoController@uploadpromo')->name('uploadpkppromo');
Route::get('listpromo','pv\promoController@listpromo')->name('listpromo');
Route::get('lihatpromo/{id}/{revisi}/{turunan}','pv\promoController@lihatpromo')->name('lihatpromo');

Route::get('naikversipromo/{id}/{revisi}/{turunan}','pv\promoController@upversionpromo')->name('naikversipromo');
Route::post('edituser/{id_project_pdf}','pv\promoController@edituser')->name('edituser');
Route::post('sentpromo/{id_project}/{revisi}/{turunan}','pv\promoController@sentpromo')->name('sentpromo');
Route::post('editpromo/{id_project}/{revisi}/{turunan}','pv\promoController@edit')->name('editpromo');
Route::post('allocation','pv\promoController@postSave')->name('allocation');
Route::post('edittypepromo/{id}','pv\promoController@edittype')->name('edittypepromo');
Route::post('datapromo1','pv\promoController@datapromo')->name('datapromo1');
Route::post('prioritaspromo/{id}','pv\promoController@prioritas')->name('prioritaspromo');
Route::get('promoklaim/{id}','pv\promoController@klaim')->name('promoklaim');

Route::get('hapuspromo/{id}','pv\promoController@hapuspromo')->name('hapuspromo');
Route::post('applicationpromo','pv\promoController@applicationpromo')->name('applicationpromo');
Route::post('editdatapromo2/{id_pkp_promo}/{revisi}/{turunan}','pv\promoController@editdatapromo2')->name('editdatapromo2');
Route::post('editdatapromo/{id_pkp_promo}/{revisi}/{turunan}','pv\promoController@editdatapromo')->name('editdatapromo');
Route::get('deletedatastep4/{id_pkp_promo}/{turunan}','pv\promoController@deletedatastep4')->name('deletedatastep4');
Route::post('editdatastep4/{id_product_allocation}/{turunan}','pv\promoController@editdatastep4')->name('editdatastep4');
Route::post('approvepromo1/{id}','pv\promoController@approve1')->name('approvepromo1');
Route::post('approvepromo2/{id}','pv\promoController@approve2')->name('approvepromo2');

// PDF
Route::get('konfig/{id}/{turunan}','pv\pdfController@konfigurasi')->name('konfig');
Route::post('sentpdf/{id_project_pdf}/{revisi}/{turunan}','pv\pdfController@sentpdf')->name('sentpdf');
Route::get('drafpdf','pv\pdfController@drafpkp')->name('drafpdf');
Route::get('listpdf','pv\pdfController@listpdf')->name('listpdf');
Route::get('downloadpdf/{id_project_pdf}/{revisi}/{turunan}','pv\pdfController@downloadpdf')->name('downloadpdf');
Route::post('datapdf','pv\pdfController@datapdf')->name('datapdf');
Route::post('infogambarpdf','pv\pdfController@infogambarpdf')->name('infogambarpdf');
Route::get('buatpdf/{id_project_pdf}','pv\pdfController@buatpdf')->name('buatpdf');
Route::get('buatpdf1/{id_project_pdf}/{revisi}/{turunan}','pv\pdfController@buatpdf1')->name('buatpdf1');
Route::get('formpdf','pv\pdfController@formpdf')->name('formpdf');
Route::get('lihatpdf/{id_project_pdf}/{revisi}/{turunan}','pv\pdfController@lihatpdf')->name('lihatpdf');
Route::post('pos','pv\pdfController@coba')->name('pos');

Route::get('approvesamplepdf/{id}','pv\pdfController@approvesamplepdf')->name('approvesamplepdf');
Route::post('rejectsamplepdf/{id}','pv\pdfController@rejectsamplepdf')->name('rejectsamplepdf');
Route::get('finalsamplepdf/{id}/{sample}','pv\pdfController@finalsamplepdf')->name('finalsamplepdf');
Route::get('unfinalsamplepdf/{id}/{sample}','pv\pdfController@unfinalsamplepdf')->name('unfinalsamplepdf');

Route::get('hapuspdf/{id}','pv\pdfController@hapuspdf')->name('hapuspdf');
Route::post('eedit/{id_project_pdf}/{revisi}/{turunan}','pv\pdfController@edit')->name('eedit');
Route::post('freezepdf/{id}','pv\pdfController@freeze')->name('freezepdf');
Route::post('ubahTMpdf/{id}','pv\pdfController@ubahTMpdf')->name('ubahTMpdf');
Route::get('activepdf/{id}','pv\pdfController@activepdf')->name('activepdf');
Route::post('pdf/{id}','pv\pdfController@TMubah')->name('TMubahpdf');
Route::post('eedituser/{id_project_pdf}','pv\pdfController@edituser')->name('eedituser');
Route::get('temppdf/{id}','devwb\listpkpController@template')->name('temppdf');

Route::get('pdfklaim/{id}','pv\pdfController@klaim')->name('pdfklaim');
Route::get('destroydata/{id_pictures}','pv\pdfController@destroydata')->name('destroydata');
Route::get('datatambahanpdf/{id_project_pdf}/{revisi}/{turunan}','pv\pdfController@uploadpdf')->name('datatambahanpdf');
Route::post('uploadpdf','pv\pdfController@uploaddatapdf')->name('uploadpdf');

Route::get('naikversipdf/{id}/{recisi}/{turunan}','pv\pdfController@upversionpdf')->name('naikversipdf');
Route::get('pdf1/{id_project_pdf}','pv\pdfController@step1')->name('pdf1');
Route::get('pdf2/{id_project_pdf}/{revisi}/{turunan}','pv\pdfController@step11')->name('pdf2');
Route::post('updatepdf/{id_pdf}/{revisi}/{turunan}','pv\pdfController@updatecoba')->name('updatepdf');
Route::post('updatepdf2/{id_pdf}/{revisi}/{turunan}','pv\pdfController@updatecoba2')->name('updatepdf2');
Route::get('rekappdf/{id_project_pdf}','pv\pdfController@daftarpdf')->name('rekappdf');
Route::post('approvepdf1/{id}','pv\pdfController@approve1')->name('approvepdf1');
Route::post('approvepdf2/{id}','pv\pdfController@approve2')->name('approvepdf2');
Route::post('prioritaspdf/{id}','pv\pdfController@prioritas')->name('prioritaspdf');

// ***************Manager
Route::get('listpkprka','manager\managerController@listpkp')->name('listpkprka');
Route::get('listpdfrka','manager\managerController@listpdf')->name('listpdfrka');
Route::get('listpromoo','manager\managerController@listpromo')->name('listpromoo');
Route::post('pengajuan','manager\managerController@pengajuan')->name('pengajuan');
Route::post('pengajuanpdf','manager\managerController@pengajuanpdf')->name('pengajuanpdf');
Route::post('pengajuanpromo','manager\managerController@pengajuanpromo')->name('pengajuanpromo');
Route::get('dasboardmanager','manager\managerController@dasboardmanager')->name('dasboardmanager');

Route::post('Gproses/{id}/{revisi}/{turunan}','manager\managerController@Gproses')->name('Gproses');
Route::get('daftarpkp/{id_project}','manager\managerController@daftarpkp')->name('daftarpkp');
Route::get('daftarpdf/{id}','manager\managerController@daftarpdf')->name('daftarpdf');
Route::get('daftarpromo/{id}','manager\managerController@daftarpromo')->name('daftarpromo');
Route::post('samplepkp/{id}','manager\managerController@samplepkp')->name('samplepkp');
Route::post('samplepdf/{id}','manager\managerController@samplepdf')->name('samplepdf');
Route::post('samplepromo/{id}','manager\managerController@samplepromo')->name('samplepromo');

Route::post('alihkan/{id}','manager\managerController@alihkan')->name('alihkan');
Route::post('alihkanpdf/{id}','manager\managerController@alihkanpdf')->name('alihkanpdf');
Route::post('alihkanpromo/{id}','manager\managerController@alihkanpromo')->name('alihkanpromo');
Route::get('pdflihat/{id}/{revisi}/{turunan}','manager\managerController@lihatpdf')->name('pdflihat');
Route::get('pkplihat/{id}/{revisi}/{turunan}','manager\managerController@lihatpkp')->name('pkplihat');
Route::get('promolihat/{id}/{revisi}/{turunan}','manager\managerController@lihatpromo')->name('promolihat');

Route::get('myworkbooks','devwb\WorkbookController@index')->name('myworkbooks');
Route::get('myworkbooks/{id}/show', ['uses'=>'devwb\WorkbookController@show','as' =>'showworkbook']);
Route::get('myworkbooks/{id}/delete', ['uses'=>'devwb\WorkbookController@destroy','as' =>'deleteworkbook']);
Route::post('newworkbook','devwb\WorkbookController@store')->name('newworkbook');


Route::get('HapusBase/{id}','formula\ScaleController@hapusbase')->name('hapusbase');
Route::post('GantiBase/{id}','formula\ScaleController@gantibase')->name('gantibase');

// ***************user_rd_proses
Route::get('dasboardawal','devwb\listpkpController@dasboard')->name('dasboardawal');
Route::get('listprojectpkp','devwb\listpkpController@listpkp')->name('listprojectpkp');
Route::get('listprojectpdf','devwb\listpkpController@listpdf')->name('listprojectpdf');
Route::get('listprojectpromo','devwb\listpkpController@listpromo')->name('listprojectpromo');

Route::get('listpkpclose','devwb\listpkpController@listpkpclose')->name('listpkpclose');
Route::get('listpdfclose','devwb\listpkpController@listpdfclose')->name('listpdfclose');
Route::get('listpromoclose','devwb\listpkpController@listpromoclose')->name('listpromoclose');

Route::post('closepkp/{id}','devwb\listpkpController@closepkp')->name('closepkp');
Route::post('closepdf/{id}','devwb\listpkpController@closepdf')->name('closepdf');
Route::post('closepromo/{id}','devwb\listpkpController@closepromo')->name('closepromo');
Route::get('kalenderpkp/{id}','pv\pkpController@kalenderpkp')->name('kalenderpkp');

Route::get('allcalenderpkp','pv\pkpController@allcalenderpkp')->name('allcalenderpkp');
Route::get('allcalenderpdf','pv\pkpController@allcalenderpdf')->name('allcalenderpdf');

Route::get('allproject','devwb\listpkpController@allproject')->name('allproject');
Route::get('allcalenderpromo','pv\pkpController@allcalenderpromo')->name('allcalenderpromo');
Route::get('menucalender','menuController@menukalender')->name('menucalender');
Route::get('datareport','menuController@data')->name('datareport');
Route::get('kalenderpdf/{id}','pv\pdfController@kalenderpdf')->name('kalenderpdf');
Route::get('kalenderpromo/{id}','pv\promoController@kalenderpromo')->name('kalenderpromo');

// FEASIBILITY
Route::get('PengajuanFormulaFeasibility','feasibility\ListFormulaController@index')->name('formula.feasibility');
Route::get('PengajuanSelesai','feasibility\ListFormulaController@sudah')->name('formula.selesai');
Route::get('MyFeasibility/{id}','feasibility\ListFeasibilityController@index')->name('myFeasibility');
Route::get('UpFeasibility/{id}','feasibility\UpFeasibility@index')->name('upFeasibility');
Route::post('kirimWB/{id}/{id_feasibility}', 'feasibility\ListFeasibilityController@kirimWB')->name('kirimWB');
Route::get('deletefs/{id}', 'feasibility\ListFeasibilityController@deletefs')->name('deletefs');

Route::get('hapuspkp/{id}','pv\pkpController@hapuspkp')->name('hapuspkp');
Route::get('hapuslaunch/{id}/{revisi}/{turunan}','pv\pkpController@deletelaunch')->name('hapuslaunch');
Route::post('ubahTMpkp1/{id}','devwb\pkp1Controller@ubahTMpkp')->name('ubahTMpkp1');
Route::get('activepkp1/{id}','devwb\pkp1Controller@active')->name('activepkp1');
Route::post('TMubahpkp1/{id}','devwb\pkp1Controller@TMubah')->name('TMubahpkp1');

Route::post('ubahTMpdf1/{id}','devwb\pkp1Controller@ubahTMpdf')->name('ubahTMpdf1');
Route::get('activepdf2/{id}','devwb\pkp1Controller@activepdf')->name('activepdf1');
Route::post('TMubahpdf1/{id}','devwb\pkp1Controller@TMubahpdf')->name('TMubahpdf1');

Route::post('ubahTMpromo1/{id}','devwb\pkp1Controller@ubahTMprom')->name('ubahTMpromo1');
Route::get('activepromo2/{id}','devwb\pkp1Controller@activeprom')->name('activepromo1');
Route::post('TMubahpromo1/{id}','devwb\pkp1Controller@TMubahpromo')->name('TMubahpromo1');

/***** Workbook Development**/
Route::get('getBatasMax/{id}','ajax\getGet@getBatasMax');
Route::get('getSubbrand/{id}','ajax\getGet@getSubbrand');
Route::get('myworkbooks','devwb\WorkbookController@index')->name('myworkbooks');
Route::get('myworkbooks/{id}/show', ['uses'=>'devwb\WorkbookController@show','as' =>'showworkbook']);
Route::get('myworkbooks/{id}/delete', ['uses'=>'devwb\WorkbookController@destroy','as' =>'deleteworkbook']);
Route::post('newworkbook','devwb\WorkbookController@store')->name('newworkbook');
Route::patch('updateworkbooks/{id}','devwb\WorkbookController@update')->name('updateworkbooks');
Route::patch('alihkan/{id}','devwb\WorkbookController@alihkan')->name('alihkan');
Route::get('endproject/{id}','devwb\WorkbookController@endproject')->name('workbook.selesai');
Route::get('batalkanproject/{id}','devwb\WorkbookController@batalproject')->name('workbook.batal');

Route::post('addformula','devwb\FormulaController@new')->name('addformula');
Route::get('upversion/{cf}/{id}','devwb\UpVersionController@upversion')->name('upversion');
Route::get('upversion2/{id}','devwb\UpVersionController@upversion2')->name('upversion2');
Route::get('DetailFormula/{id}','devwb\FormulaController@detail')->name('formula.detail');
Route::get('DestroyFormula/{id}','devwb\FormulaController@deleteformula')->name('deleteFormula');

Route::get('ajukanvp/{id}','devwb\PengajuanFormulaController@vp')->name('ajukanvp');
Route::get('ajukanf/{id}','devwb\PengajuanFormulaController@vp')->name('ajukannf');
Route::get('formulainformation/{id}','formula\Step1Controller@create')->name('step1');
Route::patch('updateformula/{id}','formula\Step1Controller@update')->name('step1update');

Route::get('penyusunanbahan/{id}','formula\Step2Controller@create')->name('step2');
Route::post('insertbahan/{id}','formula\Step2Controller@insert')->name('step2insert');
Route::post('updatebahan/{id}','formula\Step2Controller@update')->name('step2update');
Route::get('bahan/{id}/{vf}/delete','formula\Step2Controller@destroy')->name('step2destroy');
Route::get('getAlternatif/{id}','ajax\getGet@getAlternatif');

Route::get('HapusBase/{id}','formula\ScaleController@hapusbase')->name('hapusbase');
Route::post('GantiBase/{id}','formula\ScaleController@gantibase')->name('gantibase');

Route::post('savechanges/{id}','formula\ScaleController@savechanges')->name('savechanges');

Route::post('cekscale/{id}','formula\ScaleController@cekscale')->name('cekscale');
Route::post('savescale/{id}','formula\ScaleController@savescale')->name('savescale');

Route::get('getTemplate/{id}','devwb\TemplateFormulaController@index')->name('getTemplate');
Route::get('InsertTemplate/{ftujuan}/{fasal}','devwb\TemplateFormulaController@template')->name('insertTemplate');

Route::get('MyRamen/{id}','formula\MyRamenController@index')->name('ramen');
Route::post('MyRamenInsert/{id}','formula\MyRamenController@insert')->name('MyRamen.insert');

Route::get('EditDetailPenyusunan/{id}','formula\EditFortailController@index')->name('editfortail');
Route::patch('SaveDetailPenyusunan/{idf}/{id}','formula\EditFortailController@update')->name('updatefortail');

Route::get('penyusunanpremix/{id}','formula\Step3Controller@create')->name('step3');
Route::get('InsertPremix/{id}','formula\Step3Controller@insert')->name('step3insert');
Route::get('summarryformula/{id}','formula\SummaryFormulaController@summarry')->name('summarry');
Route::post('vit15/{id}','formula\SummaryFormulaController@vit15')->name('vit15');
Route::post('vit20/{id}','formula\SummaryFormulaController@vit20')->name('vit20');
Route::post('overrate/{id}','formula\SummaryFormulaController@overrate')->name('overrate');

// panel
Route::get('panel/{id}','formula\panelController@panel')->name('panel');
Route::post('hasilpanel','formula\panelController@hasil')->name('hasilpanel');
Route::get('st/{id}','formula\storageController@st')->name('st');
Route::post('hasilstorage','formula\storageController@hasilnya')->name('hasilstorage');
Route::post('updatedst/{id}','formula\storageController@editdata')->name('updatedst');
Route::post('progress','formula\storageController@proses')->name('progress');
/**** PESAN Antar User */
Route::post('send','PesanController@send')->name('send.email');

/************************************FEASIBILITY */

// FEASIBILITY
Route::get('PengajuanFormulaFeasibility','feasibility\ListFormulaController@index')->name('formula.feasibility');
Route::get('MyFeasibility/{id}','feasibility\ListFeasibilityController@index')->name('myFeasibility');
Route::get('UpFeasibility/{id}','feasibility\UpFeasibility@index')->name('upFeasibility');
Route::post('kirimWB/{id}/{id_feasibility}', 'feasibility\ListFeasibilityController@kirimWB')->name('kirimWB');

// KEMAS
Route::get('KonsepKemas/{id}/{id_feasibility}','kemas\KonsepController@index')->name('konsepkemas');
Route::post('InsertKonsep/{id}','kemas\KonsepController@insert')->name('insertkonsep');
Route::get('lihat/{id}/{id_feasibility}','kemas\KonsepController@hasilnya')->name('lihat');
Route::get('deletekemas/{id}','kemas\KonsepController@destroykemas')->name('deletekemas');
Route::get('inboxkemas/{id}/{id_feasibility}','kemas\KonsepController@inboxkemas')->name('inboxkemas');
Route::get('UploadKemas/{id}/{id_feasibility}','kemas\KemasController@index')->name('uploadkemas');
Route::post('hasil/{id}', 'kemas\KemasController@storeData')->name('hasil');

//EVALUATOR
Route::get('hasilnya/{id}/{id_feasibility}','mesin\MesinController@hasil')->name('hasilnya');
Route::get('datamesin/{id}/{id_feasibility}','mesin\MesinController@index')->name('datamesin');
Route::get('ubah/{id}/{id_feasibility}','mesin\MesinController@ubah')->name('ubah');
Route::get('reference/{id}/{id_feasibility}','mesin\MesinController@reference')->name('reference');
Route::get('inboxmesin/{id}/{id_feasibility}','mesin\MesinController@inbox')->name('inboxmesin');
Route::get('/runtimemesin/{id}/{id_feasibility}','mesin\MesinController@createrateM')->name('runtimemesin');
Route::get('dataoh/{id}/{id_feasibility}','mesin\MesinController@data')->name('dataoh');
Route::get('std/{id}','mesin\MesinController@std')->name('std');
Route::post('DM', 'mesin\MesinController@createDMmesin')->name('DM');

Route::post('/stdd', 'mesin\MesinController@store');
Route::put('/updatemss/{id_mesin}', 'mesin\MesinController@runM')->name('updatemss');
Route::post('/updateoh/{id_oh}', 'mesin\MesinController@runO')->name('updateoh');
Route::get('delete/{id}', 'mesin\MesinController@destroyoh')->name('delete');
Route::delete('deletedata/{id}', 'mesin\MesinController@destroy')->name('mesin.destroy');
Route::post('/mss', 'mesin\MesinController@Mdata')->name('mss');
Route::post('master/{id}', 'mesin\MesinController@master')->name('master');
Route::post('/ohh', 'mesin\MesinController@dataO')->name('ohh');
Route::get('deleteP/{id}','mesin\MesinController@destroyP')->name('pesan.destroy');
Route::post('statusM/{id}/{id_feasibility}', 'mesin\MesinController@status')->name('statusM');
Route::post('lihat', 'mesin\MesinController@lihat')->name('lihat');
route::post('kirimlab','mesin\MesinController@kirimlab')->name('kirimlab');
route::post('lab','mesiMesinController@lab')->name('lab');

//PRODUKSI
route::get('produksi/{id}','produksi\ProduksiController@index')->name('produksi');
route::get('data/{id}/{id_feasibility}','produksi\ProduksiController@has')->name('data');
route::get('inboxproduksi/{id}','produksi\ProduksiController@inbox')->name('inboxproduksi');
Route::post('updatesdmmesin/{id_mesin}', 'produksi\ProduksiController@sdmM')->name('updatesdmmesin');
Route::post('updatesdmoh/{id_oh}', 'produksi\ProduksiController@sdmO')->name('updatesdmoh');
Route::get('deletePsdm/{id}','produksi\ProduksiController@destroyPsdm')->name('pesansdm.destroy');
Route::post('statusP/{id}/{id_feasibility}', 'produksi\ProduksiController@status')->name('statusP');

//LAB
route::get('datalab/{id}/{id_feasibility}','lab\LabController@index')->name('datalab');
route::get('lab/{id}','lab\LabController@lihat')->name('lab');
Route::get('deletelab/{id}','lab\LabController@destroylab')->name('delete');
Route::post('/labb', 'lab\LabController@data')->name('labb');
Route::get('inboxlab/{id}/{id_feasibility}','lab\LabController@inbox')->name('inboxlab');
route::post('Insertlab/{formula_id}/{cek_lab}/{id}','lab\LabController@create')->name('Insertlab');

//FINANCE
route::get('summary/{id}/{id_feasibility}','finance\FinanceController@summary')->name('summary');
route::get('finance/{id}/{id_feasibility}','finance\FinanceController@index')->name('finance');
route::get('inboxfn/{id}/{id_feasibility}','finance\FinanceController@inboxfn')->name('inboxfn');
route::get('komentar/{id}/{id_feasibility}','finance\FinanceController@komentar')->name('komentar');
route::get('pesan/{id}/{id_feasibility}','finance\FinanceController@pesan')->name('pesan');
route::get('Kkemas/{id}/{id_feasibility}','finance\FinanceController@pesankemas')->name('Kkemas');
route::post('insertkomentar/{id}/{id_feasibility}','finance\FinanceController@store')->name('insertkomentar');
route::post('Pkemas/{id}/{id_feasibility}','finance\FinanceController@Pkemas')->name('Pkemas');
route::post('insertpesan/{id}/{id_feasibility}','finance\FinanceController@kirim')->name('insertpesan');
route::get('Datamastermesin/{id}/{id_feasibility}','finance\FinanceController@DMmesin')->name('DMmesin');
Route::post('Dm', 'finance\FinanceController@createDMmesin')->name('Dm');

route::get('Datamasteroh/{id}/{id_feasibility}','finance\FinanceController@DMoh')->name('DMoh');
Route::post('Do', 'finance\FinanceController@createDMoh')->name('Do');
Route::put('/updateM/{id_mesin}/{id_data_mesin}', 'finance\FinanceController@updateMesin')->name('updateM');
Route::get('deletemesin/{id}', 'finance\FinanceController@destroy')->name('mesin.hapus');
Route::get('deleteoh/{id}', 'finance\FinanceController@destroyoh')->name('oh.hapus');
Route::get('akhir/{id}','finance\FinanceController@akhir')->name('akhir');
Route::post('status/{id}/{id_feasibility}', 'finance\FinanceController@status')->name('status');
Route::get('kemas/{id}/{id_feasibility}', 'finance\FinanceController@kemasan')->name('kemas');
Route::resource('posts','finance\ajax');

// forgot password
Route::post('reset_password_without_token', 'AccountsController@validatePasswordRequest')->name('reset_password_without_token');
Route::patch('/forgotpass','AccountsController@update')->name('forgotpass');
Route::get('reset/{id}','LoginController@reset')->name('reset');