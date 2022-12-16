<?php

use Illuminate\Support\Facades\Route;

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


Route::group(['middleware' => ['auth'] ], function () {
    //route::get('/dashboard', 'App\Http\Controllers\DashboardController@index')->name('dashboard.index');
    Route::get('', 'App\Http\Controllers\DashboardController@index')->name('dashboard.index');
    Route::get('/year/{year}', 'App\Http\Controllers\DashboardController@indexWithYear')->name('dashboard.index.with.year');
    Route::get('month', 'App\Http\Controllers\DashboardController@month')->name('dashboard.date');

    route::get('change/accounttype', 'App\Http\Controllers\UserController@changeAccountType')->name('user.change.type');

    Route::prefix('procurement')->group(function () {
        route::get('/', 'App\Http\Controllers\ProcurementController@index')->name('procurement.index');
        route::get('/sortbytotal', 'App\Http\Controllers\ProcurementController@indexSort')->name('procurement.index.sort');
        route::get('show/{procurement}/{status_choosen}', 'App\Http\Controllers\ProcurementController@show')->name('procurement.show');
        route::get('create', 'App\Http\Controllers\ProcurementController@create')->name('procurement.create');
        route::post('/', 'App\Http\Controllers\ProcurementController@store')->name('procurement.store');
        route::put('update/{procurement}', 'App\Http\Controllers\ProcurementController@update')->name('procurement.update');
        route::delete('/{procurement}', 'App\Http\Controllers\ProcurementController@destroy')->name('procurement.delete');
        route::post('/cancel/{procurement}', 'App\Http\Controllers\ProcurementController@cancel')->name('procurement.cancel');
        route::post('/ajukan/{procurement}', 'App\Http\Controllers\ProcurementController@ajukan')->name('procurement.ajukan');
        route::post('/item/{type}', 'App\Http\Controllers\ProcurementController@itemStore')->name('procurement.item.store');
        route::get('/get-item', 'App\Http\Controllers\ProcurementController@itemIndex')->name('procurement.item.index');
        route::post('/item-import/import', 'App\Http\Controllers\ProcurementController@itemImport')->name('procurement.item.import');
        route::get('/item-delete/{item}', 'App\Http\Controllers\ProcurementController@itemDestroy')->name('procurement.item.delete');
        route::get('/get-vendor/{category_id}', 'App\Http\Controllers\ProcurementController@getVendor')->name('procurement.create.vendor');
        route::get('/item/download', 'App\Http\Controllers\ProcurementController@exampleDownload')->name('procurement.item.import.example');
        //route::get('/tor/download/{procurement}', 'App\Http\Controllers\ProcurementController@torDownload')->name('procurement.tor.download');
        route::get('/status/{procurement}/{status}/{token}', 'App\Http\Controllers\ProcurementController@changeStatus')->name('procurement.item.change.status');
        route::get('/item-edit/{item}', 'App\Http\Controllers\ProcurementController@itemEdit')->name('procurement.item.edit');
        route::put('/item-update/{item}', 'App\Http\Controllers\ProcurementController@itemUpdate')->name('procurement.item.update');
        route::get('/get-input-barang-pengadaan', 'App\Http\Controllers\ProcurementController@getInputBarangPengadaan')->name('procurement.get.input');

        route::get('/file/download/{id}/{type}', 'App\Http\Controllers\ProcurementController@fileDownload')->name('procurement.file.download');
        route::get('/file/view/{id}/{type}', 'App\Http\Controllers\ProcurementController@detailDokumen')->name('procurement.file.view');
        route::get('/file/downloads/all/{procurement}', 'App\Http\Controllers\ProcurementController@downloadAllDokumen')->name('procurement.file.download.all');
        route::post('/file/update/{procurement}', 'App\Http\Controllers\ProcurementController@updateDokumen')->name('procurement.file.update');

        route::get('show/penawaran/tenderterbuka/{procurement}/{status_choosen}', 'App\Http\Controllers\TenderTerbukaController@indexPenawaran')->name('procurement.show.penawaran.tenderterbuka');
        route::get('penawaran/tenderterbuka/detail/{penawaran}', 'App\Http\Controllers\TenderTerbukaController@detailPenawaran')->name('procurement.tenderterbuka.penawaran.detail');
        route::get('penawaran/tenderterbuka/submit/{penawaran}', 'App\Http\Controllers\TenderTerbukaController@submitPenawaran')->name('procurement.tenderterbuka.penawaran.submit');
        route::put('tenderterbuka/batas/ubah', 'App\Http\Controllers\TenderTerbukaController@ubahBatas')->name('procurement.tenderterbuka.batas');
        route::post('logs/store/{procurement}', 'App\Http\Controllers\LogsController@store')->name('procurement.logs.store');
        
        Route::prefix('penawaran')->group(function () {
            route::post('/upload/{procurement}', 'App\Http\Controllers\ProcurementController@uploadPenawaran')->name('procurement.upload.penawaran');
            route::get('/detail/{spph}', 'App\Http\Controllers\ProcurementController@detailPenawaran')->name('procurement.penawaran.detail');
            route::get('/done/{procurement}', 'App\Http\Controllers\ProcurementController@donePenawaran')->name('procurement.penawaran.done');
            route::put('/batas/ubah', 'App\Http\Controllers\ProcurementController@ubahBatas')->name('procurement.penawaran.batas');
        });

        Route::group(['middleware' => ['User']], function () {
            Route::prefix('spph')->group(function () {
                route::get('/input/{procurement}', 'App\Http\Controllers\ProcurementController@inputSpph')->name('procurement.spph.input');
                route::get('/reinput/{procurement}', 'App\Http\Controllers\ProcurementController@reInputSpph')->name('procurement.spph.reinput');
                route::post('/ajukan/{procurement}', 'App\Http\Controllers\ProcurementController@ajukanSpph')->name('procurement.spph.ajukan');
            });

            //tender terbuka
            Route::prefix('spph')->group(function () {
                route::get('/tenderterbuka/download/spph/{procurement}', 'App\Http\Controllers\TenderTerbukaController@downloadSpph')->name('procurement.tenderterbuka.spph.download');
            });
        });

        Route::prefix('evaluasi-tender')->group(function () {
            route::get('/download/{procurement}', 'App\Http\Controllers\ProcurementController@evaluasiTenderExport')->name('procurement.evaluasitender.export');
            route::post('/upload/{procurement}', 'App\Http\Controllers\ProcurementController@uploadEvaluasiTender')->name('procurement.upload.evaluasitender');
            route::get('/done/{procurement}', 'App\Http\Controllers\ProcurementController@doneEvaluasiTender')->name('procurement.evaluasitender.done');
        });

        Route::prefix('banegosiasi')->group(function () {
            route::get('/input/{spph}', 'App\Http\Controllers\BaNegosiasiController@inputNegosiasi')->name('procurement.banegosiasi.input');
            route::get('/edit/{spph}', 'App\Http\Controllers\BaNegosiasiController@editNegosiasi')->name('procurement.banegosiasi.edit');
            route::put('/update/{spph}', 'App\Http\Controllers\BaNegosiasiController@update')->name('procurement.banegosiasi.update');
            route::post('/store/{spph}', 'App\Http\Controllers\BaNegosiasiController@store')->name('procurement.banegosiasi.store');
            route::get('/show/{spph}', 'App\Http\Controllers\BaNegosiasiController@showNegosiasi')->name('procurement.banegosiasi.show');
            route::get('/cetak/{spph}', 'App\Http\Controllers\BaNegosiasiController@cetak')->name('procurement.banegosiasi.cetak');
            route::get('/done/{procurement}', 'App\Http\Controllers\BaNegosiasiController@done')->name('procurement.banegosiasi.done');
            route::get('/lose/{penawaran}', 'App\Http\Controllers\BaNegosiasiController@lose')->name('procurement.banegosiasi.lose');
            route::get('/loseundo/{penawaran}', 'App\Http\Controllers\BaNegosiasiController@loseundo')->name('procurement.banegosiasi.loseundo');
        });

        Route::prefix('bapp')->group(function () {
            route::get('/input/{procurement}', 'App\Http\Controllers\BappController@input')->name('procurement.bapp.input');
            route::get('/edit/{procurement}', 'App\Http\Controllers\BappController@edit')->name('procurement.bapp.edit');
            route::put('/update/{procurement}', 'App\Http\Controllers\BappController@update')->name('procurement.bapp.update');
            route::post('/store/{procurement}', 'App\Http\Controllers\BappController@store')->name('procurement.bapp.store');
            route::get('/show/{procurement}', 'App\Http\Controllers\BappController@show')->name('procurement.bapp.show');
            route::get('/cetak/{procurement}', 'App\Http\Controllers\BappController@cetak')->name('procurement.bapp.cetak');
            route::get('/done/{procurement}', 'App\Http\Controllers\BappController@done')->name('procurement.bapp.done');
        });

        Route::prefix('po')->group(function () {
            route::get('/input/{spph}', 'App\Http\Controllers\PoController@input')->name('procurement.po.input');
            route::get('/edit/{spph}', 'App\Http\Controllers\PoController@edit')->name('procurement.po.edit');
            route::put('/update/{spph}', 'App\Http\Controllers\PoController@update')->name('procurement.po.update');
            route::post('/store/{spph}', 'App\Http\Controllers\PoController@store')->name('procurement.po.store');
            route::get('/show/{spph}', 'App\Http\Controllers\PoController@show')->name('procurement.po.show');
            route::get('/cetak/{spph}', 'App\Http\Controllers\PoController@cetak')->name('procurement.po.cetak');
            route::get('/done/{procurement}', 'App\Http\Controllers\PoController@done')->name('procurement.po.done');
        });

        Route::prefix('bast')->group(function () {
            route::get('/input/{spph}', 'App\Http\Controllers\BastController@input')->name('procurement.bast.input');
            route::post('/store/{spph}', 'App\Http\Controllers\BastController@store')->name('procurement.bast.store');
            route::get('/show/{spph}', 'App\Http\Controllers\BastController@show')->name('procurement.bast.show');
            //route::get('/cetak/{spph}', 'App\Http\Controllers\PoController@cetak')->name('procurement.po.cetak');
            route::get('/done/{procurement}', 'App\Http\Controllers\BastController@done')->name('procurement.bast.done');
        });

        Route::prefix('penilaian')->group(function () {
            route::post('/store', 'App\Http\Controllers\PenilaianVendorController@store')->name('procurement.penilaian.store');
            route::put('/update', 'App\Http\Controllers\PenilaianVendorController@update')->name('procurement.penilaian.update');
            route::get('/done/{procurement}', 'App\Http\Controllers\PenilaianVendorController@done')->name('procurement.penilaian.done');
            route::get('mine/{score}', 'App\Http\Controllers\PenilaianVendorController@scoreMine')->name('procurement.penilaian.mine');
        });

        Route::prefix('sp3')->group(function () {
            route::post('/store/{procurement}', 'App\Http\Controllers\Sp3Controller@store')->name('procurement.sp3.store');
            route::get('/done/{procurement}', 'App\Http\Controllers\Sp3Controller@done')->name('procurement.sp3.done');
        });

        Route::prefix('umk')->group(function () {
            Route::prefix('bast')->group(function () {
                route::post('/store/{procurement}', 'App\Http\Controllers\UmkBastController@store')->name('procurement.umk.bast.store');
                route::get('/done/{procurement}', 'App\Http\Controllers\UmkBastController@done')->name('procurement.umk.bast.done');
            });
            Route::prefix('vendor')->group(function () {
                route::post('/store/{item}', 'App\Http\Controllers\UmkVendorItemController@assignVendor')->name('procurement.umk.vendor.assign');
            });
            Route::prefix('pj')->group(function () {
                route::get('/input/{procurement}', 'App\Http\Controllers\UmkPjController@input')->name('procurement.umk.pj.input');
                route::post('/store/{procurement}', 'App\Http\Controllers\UmkPjController@store')->name('procurement.umk.pj.store');
                route::get('/cetak/{procurement}', 'App\Http\Controllers\UmkPjController@cetak')->name('procurement.umk.pj.cetak');
                route::get('/done/{procurement}', 'App\Http\Controllers\UmkPjController@done')->name('procurement.umk.pj.done');
            });
        });
        
    });

    Route::prefix('procurement-manual')->group(function(){

        Route::prefix('tender')->group(function(){
            route::get('/', 'App\Http\Controllers\ProcurementManualController@index')->name('procurement.manual');
            route::get('/getVendor/{id}', 'App\Http\Controllers\ProcurementManualController@getVendor')->name('manual.getvendor');
            route::get('/getVendorCategory/{id}', 'App\Http\Controllers\ProcurementManualController@getVendorCategory')->name('manual.getvendorcategory');
            route::get('/getPenawaran/{proc_id}', 'App\Http\Controllers\ProcurementManualController@getPenawaran')->name('manual.getpenawaran');
            route::get('/getSpph/{proc_id}/{vendor_id}', 'App\Http\Controllers\ProcurementManualController@getSpph')->name('manual.getspph');
            route::post('/store', 'App\Http\Controllers\ProcurementManualController@store')->name('manual.store');
            route::post('/store/bapp', 'App\Http\Controllers\ProcurementManualController@storeFromBapp')->name('manual.storebapp');
            route::get('/getProcurement/{id}', 'App\Http\Controllers\ProcurementManualController@getProcurement')->name('manual.getprocurement');
            route::get('/getProcurementComponent/{id}', 'App\Http\Controllers\ProcurementManualController@getProcurementComponent')->name('manual.getprocurementcomponent');
            route::get('/getSp3/{id}', 'App\Http\Controllers\ProcurementManualController@getSp3')->name('manual.getSp3');
        });

        Route::prefix('umk')->group(function(){
            route::get('/', 'App\Http\Controllers\ProcurementManualController@indexUmk')->name('procurement.manual-umk');
            route::get('/getProcurementUmk/{id}', 'App\Http\Controllers\ProcurementManualController@getProcurementUmk')->name('procurement.manual-umk.getProcurementUmk');
            route::post('/store', 'App\Http\Controllers\ProcurementManualController@storeUmk')->name('manual.umk.store');
        });
    });

    Route::prefix('slas')->group(function () {
        route::get('/', 'App\Http\Controllers\SlaController@index')->name('sla.index');
        route::get('sla/export/{type}', 'App\Http\Controllers\SlaController@exportSLA')->name('sla.export');
    });

    Route::prefix('master/itemcategory')->group(function () {
        route::get('/', 'App\Http\Controllers\ItemCategoryController@index')->name('master.itemcategory.index');
        route::post('/', 'App\Http\Controllers\ItemCategoryController@store')->name('master.itemcategory.store');
        route::put('/', 'App\Http\Controllers\ItemCategoryController@update')->name('master.itemcategory.update');
        route::delete('/{category}', 'App\Http\Controllers\ItemCategoryController@destroy')->name('master.itemcategory.delete');
    });

    Route::group(['middleware' => ['User']], function () {
        Route::prefix('bidder-list')->group(function () {
            route::get('/', 'App\Http\Controllers\VendorController@index')->name('vendor.index');
            route::get('create', 'App\Http\Controllers\VendorController@create')->name('vendor.create');
            route::post('/', 'App\Http\Controllers\VendorController@store')->name('vendor.store');
            route::get('/edit/{vendor}', 'App\Http\Controllers\VendorController@edit')->name('vendor.edit');
            Route::put('/edit/{vendor}', 'App\Http\Controllers\VendorController@update')->name('vendor.update');
            route::delete('/{vendor}', 'App\Http\Controllers\VendorController@destroy')->name('vendor.delete');
            route::post('file/upload/{vendor}', 'App\Http\Controllers\VendorController@uploadFile')->name('vendor.upload.file');
            route::delete('file/delete/{file}', 'App\Http\Controllers\VendorController@deleteFile')->name('vendor.delete.file');
            route::get('/export', 'App\Http\Controllers\VendorController@export')->name('vendor.export');
            route::post('/import', 'App\Http\Controllers\VendorController@import')->name('vendor.import');
            route::get('/download-import', 'App\Http\Controllers\VendorController@vendorExampleImport')->name('vendor.download.import');
        });

        Route::prefix('deleted-bidder')->group(function () {
            route::get('/', 'App\Http\Controllers\VendorController@indexDeleted')->name('vendor.deleted.index');
            route::get('/detail/{vendor}', 'App\Http\Controllers\VendorController@deletedDetail')->name('vendor.deleted.detail');
        });

        Route::prefix('tenderterbuka-bidder')->group(function () {
            route::get('/', 'App\Http\Controllers\VendorController@indexTerbuka')->name('vendor.terbuka.index');
            route::get('/detail-terbuka/{vendor}', 'App\Http\Controllers\VendorController@detailTerbuka')->name('vendor.terbuka.detail');
            route::put('/approve-vendor/{vendor}', 'App\Http\Controllers\VendorController@approveVendor')->name('vendor.terbuka.approve');
            route::put('/reject-vendor/{vendor}', 'App\Http\Controllers\VendorController@rejectVendor')->name('vendor.terbuka.reject');

        });
    });

    Route::group(['middleware' => ['AdminMaster']], function () {
        Route::prefix('master')->group(function () {
            Route::prefix('mechanism')->group(function () {
                route::get('/', 'App\Http\Controllers\MechanismController@index')->name('master.mechanism.index');
                route::post('/', 'App\Http\Controllers\MechanismController@store')->name('master.mechanism.store');
                route::put('/', 'App\Http\Controllers\MechanismController@update')->name('master.mechanism.update');
                route::delete('/{mechanism}', 'App\Http\Controllers\MechanismController@destroy')->name('master.mechanism.delete');
            });

            Route::prefix('spph')->group(function () {
                route::get('/', 'App\Http\Controllers\MasterSpphController@index')->name('master.spph.index');
                route::put('/', 'App\Http\Controllers\MasterSpphController@update')->name('master.spph.update');
            });

            Route::prefix('mail')->group(function() {
                route::get('/', 'App\Http\Controllers\MasterMailController@index')->name('master.mail.index');
                route::put('/', 'App\Http\Controllers\MasterMailController@update')->name('master.mail.update');

            });

            Route::prefix('po')->group(function () {
                route::get('/', 'App\Http\Controllers\MasterPoController@index')->name('master.po.index');
                route::put('/', 'App\Http\Controllers\MasterPoController@update')->name('master.po.update');
            });

            Route::prefix('sla')->group(function () {
                route::get('/', 'App\Http\Controllers\MasterSlaController@index')->name('master.sla.index');
                route::put('/', 'App\Http\Controllers\MasterSlaController@update')->name('master.sla.update');
            });

            Route::prefix('jabatan')->group(function () {
                route::get('/', 'App\Http\Controllers\MasterJabatanController@index')->name('master.jabatan.index');
                route::put('/', 'App\Http\Controllers\MasterJabatanController@update')->name('master.jabatan.update');
            });

            Route::prefix('role')->group(function () {
                route::get('/', 'App\Http\Controllers\RoleController@index')->name('master.role.index');
                route::post('/', 'App\Http\Controllers\RoleController@store')->name('master.role.store');
                route::delete('/{role}', 'App\Http\Controllers\RoleController@destroy')->name('master.role.delete');
            });

            Route::prefix('user')->group(function () {
                route::get('/', 'App\Http\Controllers\UserController@index')->name('master.user.index');
                route::get('create', 'App\Http\Controllers\UserController@create')->name('master.user.create');
                route::post('/', 'App\Http\Controllers\UserController@store')->name('master.user.store');
                route::get('/{user}', 'App\Http\Controllers\UserController@show')->name('master.user.show');
                route::get('/edit/{user}', 'App\Http\Controllers\UserController@edit')->name('master.user.edit');
                route::delete('/{user}', 'App\Http\Controllers\UserController@destroy')->name('master.user.delete');
                Route::put('/{user}', 'App\Http\Controllers\UserController@update')->name('master.user.update');
                route::post('/import', 'App\Http\Controllers\UserController@import')->name('master.user.import');
                route::get('/download/import', 'App\Http\Controllers\UserController@userExampleImport')->name('master.user.download.import');
            });
        });
    });
});

route::get('spph-tor/download/{spph_id}', 'App\Http\Controllers\ProcurementController@itemExport')->name('procurement.item.export');
route::get('penawaran/input/{procurement_id}', 'App\Http\Controllers\TenderTerbukaController@inputPenawaran')->name('procurement.tenderterbuka.input');
route::post('penawaran-input/store', 'App\Http\Controllers\TenderTerbukaController@store')->name('procurement.tenderterbuka.store');

route::get('vendor/input', 'App\Http\Controllers\VendorController@createTenderTerbuka')->name('vendor.tenderterbuka.create');
route::post('vendor-terbuka/store', 'App\Http\Controllers\VendorController@storeTenderTerbuka')->name('vendor.tenderterbuka.store');
route::get('/reload-captcha', 'App\Http\Controllers\VendorController@reloadCaptcha');
Route::get('wahyu/{reg1?}', 'App\Http\Controllers\ProcurementController@wahyu') ->where('reg1', '(.*)');;
route::get('/test', 'App\Http\Controllers\VendorController@test');
Auth::routes();
// route::get('auth/', 'App\Http\Controllers\AuthController@auth');
// route::get('login', 'App\Http\Controllers\AuthController@showLoginForm')->name('login');
// route::get('gettoken/', 'App\Http\Controllers\AuthController@getToken');
// route::post('logout/', 'App\Http\Controllers\AuthController@logout')->name('logout');

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
