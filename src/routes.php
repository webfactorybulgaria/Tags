<?php
Route::model('tags', 'TypiCMS\Modules\Tags\Models\Tag');

Route::group(
    array(
        'namespace' => 'TypiCMS\Modules\Tags\Http\Controllers',
        'prefix'    => 'admin',
    ),
    function () {
        Route::resource('tags', 'AdminController');
    }
);

Route::group(['prefix'=>'api'], function() {
    Route::resource('tags', 'ApiController');
});
