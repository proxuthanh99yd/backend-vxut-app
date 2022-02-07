<?php

use App\Http\Controllers\AdminTestController;
use App\Http\Controllers\AdminChapterController;
use App\Http\Controllers\AdminQuestionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/logout', 'AuthController@logout')->name('logout');


Route::resource('/admin/test', 'AdminTestController')->middleware('auth:api');

Route::apiResource('/admin/users', 'AdminUserController')->middleware('auth:api');

Route::apiResource('/admin/test-skill', 'AdminTestSkillController')->middleware('auth:api');
Route::apiResource('/admin/question-skill', 'AdminQuestionSkillController')->middleware('auth:api');
Route::post('/admin/question-skill/{id}/edit', 'AdminQuestionSkillController@updateQuestionSkill')->middleware('auth:api');
Route::apiResource('/admin/answer-skill', 'AdminAnswerSkillController')->middleware('auth:api');

Route::apiResource('/admin/chapter', 'AdminChapterController')->middleware('auth:api');
Route::post('/admin/chapter/{id}', 'AdminChapterController@storeChapter')->middleware('auth:api');
Route::apiResource('/admin/question', 'AdminQuestionController')->middleware('auth:api');
Route::post('/admin/question/{id}', 'AdminQuestionController@storeQuestion')->middleware('auth:api');
Route::post('/admin/question/{id}/edit', 'AdminQuestionController@updateQuestion')->middleware('auth:api');
Route::apiResource('/admin/answer', 'AdminAnswerController')->middleware('auth:api');
Route::get('/admin/test-result/{id}', 'ResultController@getAllResultTest')->middleware('auth:api');
Route::get('/admin/test-result/{id}/{user_id}', 'ResultController@result_test_detail')->middleware('auth:api');
Route::get('/admin/test-skill-result/{id}', 'ResultController@getAllResultTestSkill')->middleware('auth:api');
Route::get('/admin/test-skill-result/{test_skill_id}/{user_id}/{result_skill_id}', 'ResultController@result_test_skill_detail')->middleware('auth:api');

Route::apiResource('admin/manager-flash-cards', 'AdminFlashCardTitleController')->middleware('auth:api');

Route::apiResource('admin/manager-flash-card', 'AdminFlashCardContentController')->middleware('auth:api');


Route::post('/login', "AuthController@login");
Route::post('/register', "AuthController@register");
Route::get('/user', 'AuthController@user')->name('user')->middleware('auth:api');


Route::post('/edit-user', 'AuthController@editUser')->middleware('auth:api');
Route::post('/edit-profile', 'AuthController@editProfile')->middleware('auth:api');
Route::post('/change-password', 'AuthController@change_password')->middleware('auth:api');
Route::apiResource('/tests', 'TestController')->middleware('auth:api');
Route::get('/test/{test_id}/{contest_id}', 'TestController@getChapter')->middleware('auth:api');
Route::get('result-detail/{test_id}', 'TestController@result_detail')->middleware('auth:api');
Route::get('test-level/{test_id}', 'TestController@testLevel')->middleware('auth:api');

Route::get('/result/{id}', 'TestController@getResult')->middleware('auth:api');

Route::apiResource('/test-skill', 'TestSkillController')->middleware('auth:api');
Route::get('/test-skill/{level_id}/{skill_id}', 'TestSkillController@showTest')->middleware('auth:api');
Route::get('/test-skill-history', 'ResultController@testSkillHistory')->middleware('auth:api');
Route::get('/test-history', 'ResultController@testHistory')->middleware('auth:api');
Route::get('/test-skill-history/{test_skill_id}/{result_skill_id}', 'ResultController@result_skill_detail')->middleware('auth:api');

// flash card for user
Route::apiResource('/manager-my-flash-cards', 'FlashCardTitleController')->middleware('auth:api');
Route::patch('/manager-my-flash-cards/{id}/public', 'FlashCardTitleController@updatePublic')->middleware('auth:api');
Route::get('/flash-cards', 'FlashCardTitleController@all')->middleware('auth:api');


Route::apiResource('/manager-my-flash-card', 'FlashCardContentController')->middleware('auth:api');

Route::get('/my-flash-cards', 'FlashCardContentController@myFlashcards')->middleware('auth:api');
Route::get('/my-flash-card/{id}', 'FlashCardContentController@myFlashcard')->middleware('auth:api');
// End flash card for user
