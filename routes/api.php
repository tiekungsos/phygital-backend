<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
    // Permissions
    Route::apiResource('permissions', 'PermissionsApiController');

    // Roles
    Route::apiResource('roles', 'RolesApiController');

    // Users
    Route::apiResource('users', 'UsersApiController');

    // Sliders
    Route::post('sliders/media', 'SliderApiController@storeMedia')->name('sliders.storeMedia');
    Route::apiResource('sliders', 'SliderApiController');

    // Our Teams
    Route::post('our-teams/media', 'OurTeamApiController@storeMedia')->name('our-teams.storeMedia');
    Route::apiResource('our-teams', 'OurTeamApiController');

    // Our Clients
    Route::post('our-clients/media', 'OurClientsApiController@storeMedia')->name('our-clients.storeMedia');
    Route::apiResource('our-clients', 'OurClientsApiController');

    // Growup Categories
    Route::apiResource('growup-categories', 'GrowupCategoryApiController');

    // Growup Blogs
    Route::post('growup-blogs/media', 'GrowupBlogApiController@storeMedia')->name('growup-blogs.storeMedia');
    Route::apiResource('growup-blogs', 'GrowupBlogApiController');

    // Work Categories
    Route::apiResource('work-categories', 'WorkCategoryApiController');

    // Works
    Route::post('works/media', 'WorkApiController@storeMedia')->name('works.storeMedia');
    Route::apiResource('works', 'WorkApiController');

    // Contactuses
    // Route::apiResource('contactuses', 'ContactUsApiController');

    // Metadata
    Route::post('metadata/media', 'MetadataApiController@storeMedia')->name('metadata.storeMedia');
    Route::apiResource('metadata', 'MetadataApiController', ['except' => ['store', 'destroy']]);

    // Serch Tags
    Route::apiResource('serch-tags', 'SerchTagApiController');
});


Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin'], function () {
    Route::get('sliders', 'SliderApiController@getData')->name('sliders.getData');
    Route::get('ourteams', 'OurTeamApiController@getData')->name('our-teams.getData');
    Route::get('ourclients', 'OurClientsApiController@getData')->name('our-clients.getData');
    Route::get('growup-blogs', 'GrowupBlogApiController@getData')->name('growup-blogs.getData');
    Route::get('growup-categories', 'GrowupCategoryApiController@getData')->name('growup-categories.getData');
    Route::get('works', 'WorkApiController@getData')->name('works.getData');
    Route::get('work-categories', 'WorkCategoryApiController@getData')->name('works-categories.getData');
    Route::get('serch-tags', 'SerchTagApiController@getData')->name('serch-tags.getData');
    Route::get('setting', 'MetadataApiController@getData')->name('setting.getData');
    Route::post('contactuses', 'ContactUsApiController@saveContactData')->name('contactuses.saveContactData');
});