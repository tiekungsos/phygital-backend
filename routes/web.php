<?php

Route::redirect('/', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Auth::routes(['register' => false]);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Audit Logs
    Route::resource('audit-logs', 'AuditLogsController', ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);

    // Sliders
    Route::delete('sliders/destroy', 'SliderController@massDestroy')->name('sliders.massDestroy');
    Route::post('sliders/media', 'SliderController@storeMedia')->name('sliders.storeMedia');
    Route::post('sliders/ckmedia', 'SliderController@storeCKEditorImages')->name('sliders.storeCKEditorImages');
    Route::resource('sliders', 'SliderController');

    // Our Teams
    Route::delete('our-teams/destroy', 'OurTeamController@massDestroy')->name('our-teams.massDestroy');
    Route::post('our-teams/media', 'OurTeamController@storeMedia')->name('our-teams.storeMedia');
    Route::post('our-teams/ckmedia', 'OurTeamController@storeCKEditorImages')->name('our-teams.storeCKEditorImages');
    Route::resource('our-teams', 'OurTeamController');

    // Our Clients
    Route::delete('our-clients/destroy', 'OurClientsController@massDestroy')->name('our-clients.massDestroy');
    Route::post('our-clients/media', 'OurClientsController@storeMedia')->name('our-clients.storeMedia');
    Route::post('our-clients/ckmedia', 'OurClientsController@storeCKEditorImages')->name('our-clients.storeCKEditorImages');
    Route::resource('our-clients', 'OurClientsController');

    // Growup Categories
    Route::delete('growup-categories/destroy', 'GrowupCategoryController@massDestroy')->name('growup-categories.massDestroy');
    Route::resource('growup-categories', 'GrowupCategoryController');

    // Growup Blogs
    Route::delete('growup-blogs/destroy', 'GrowupBlogController@massDestroy')->name('growup-blogs.massDestroy');
    Route::post('growup-blogs/media', 'GrowupBlogController@storeMedia')->name('growup-blogs.storeMedia');
    Route::post('growup-blogs/ckmedia', 'GrowupBlogController@storeCKEditorImages')->name('growup-blogs.storeCKEditorImages');
    Route::resource('growup-blogs', 'GrowupBlogController');

    // Work Categories
    Route::delete('work-categories/destroy', 'WorkCategoryController@massDestroy')->name('work-categories.massDestroy');
    Route::resource('work-categories', 'WorkCategoryController');

    // Works
    Route::delete('works/destroy', 'WorkController@massDestroy')->name('works.massDestroy');
    Route::post('works/media', 'WorkController@storeMedia')->name('works.storeMedia');
    Route::post('works/ckmedia', 'WorkController@storeCKEditorImages')->name('works.storeCKEditorImages');
    Route::resource('works', 'WorkController');

    // Contactuses
    Route::delete('contactuses/destroy', 'ContactUsController@massDestroy')->name('contactuses.massDestroy');
    Route::resource('contactuses', 'ContactUsController');

    // Metadata
    Route::post('metadata/media', 'MetadataController@storeMedia')->name('metadata.storeMedia');
    Route::post('metadata/ckmedia', 'MetadataController@storeCKEditorImages')->name('metadata.storeCKEditorImages');
    Route::resource('metadata', 'MetadataController', ['except' => ['create', 'store', 'destroy']]);

    // Serch Tags
    Route::delete('serch-tags/destroy', 'SerchTagController@massDestroy')->name('serch-tags.massDestroy');
    Route::resource('serch-tags', 'SerchTagController');
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
// Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
    }
});
