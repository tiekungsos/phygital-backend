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
    Route::apiResource('contactuses', 'ContactUsApiController');

    // Metadata
    Route::post('metadata/media', 'MetadataApiController@storeMedia')->name('metadata.storeMedia');
    Route::apiResource('metadata', 'MetadataApiController', ['except' => ['store', 'destroy']]);
});
