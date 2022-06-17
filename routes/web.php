<?php

use App\Models\User;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Yajra\Datatables\Datatables;
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
Route::middleware('NotLogin')->group(function () {

Route::get('/', 'AuthController@login')->name('user.login');
Route::get('/user-register', 'AuthController@register')->name('user.register');
Route::post('/user-register', 'AuthController@registerStore')->name('user.register');;
Route::get('/login', 'AuthController@login')->name('user.login');;
Route::post('/user-login', 'AuthController@loginStore')->name('user.login');

});

Route::middleware('IsLogin')->group(function () {
Route::get('user-logout', 'AuthController@logout')->name('user.logout');
    
Route::get('/dashboard', 'AuthController@dashboard')->name('dashboard');
Route::get('/exams', 'ExamController@index')->name('exams');
Route::get('/exam/{id}/{name}', 'ExamController@detail')->name('exam');
Route::get('/load-all-question', 'ExamController@loadAllquestion');

Route::get('/summary', 'ExamController@summary')->name('summary');
Route::get('/answer', 'ExamController@answer')->name('answer');
Route::get('/load-question', 'ExamController@loadQuestion');
Route::get('/save-answer', 'ExamController@saveAnswer');
Route::get('/submit-ans', 'ExamController@submitAns');
Route::get('/qsn-visited', 'ExamController@qsnVisisted');
Route::get('/view-ans', 'ExamController@viewAns');
Route::get('/single-ans', 'ExamController@SingleAns');

});










 

