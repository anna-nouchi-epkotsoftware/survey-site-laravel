<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HousingLoanChartController;
use App\Models\HousingLoanChart;

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

//集計結果一覧画面
Route::get('/housing-loan',[HousingLoanChartController::class,'index'])->name('housing-loan.index');

//質問ページ
Route::prefix('housing-loan/question-page')->name('housing-loan.question-page.')->controller(HousingLoanChartController::class)->group(function () {
    Route::get('','questionPageIndex')->name('index');//質問TOPページ
    Route::get('/page1','showPage1')->name('page1.showPage1');
    Route::post('/page1','postPage1')->name('page1.postPage1');
    Route::get('/page2','showPage2')->name('page2.showPage2');
    Route::post('/page2','postPage2')->name('page2.postPage2');
    Route::get('/page3','showPage3')->name('page3.showPage3');
    Route::post('/page3','submitForm')->name('page3.submitForm');
    Route::get('/last','showLast')->name('last.showLast');

});

