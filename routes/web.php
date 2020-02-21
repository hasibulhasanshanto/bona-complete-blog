<?php

//Frontend
Route::get('/', 'FrontController@Home')->name('front.home');
Route::get('/single-post/{slug}/', 'FrontController@SinglePost')->name('front.single.post');
Route::get('/all-posts', 'FrontController@AllPost')->name('front.all.post');
Route::get('/category/{slug}', 'FrontController@postByCategory')->name('category.post');
Route::get('/tag/{slug}', 'FrontController@postByTag')->name('tag.post');
Route::post('subscriber', 'SubscriberController@store')->name('subscriber.store');


//Authentication Routes
Auth::routes();

//User Routes
Route::get('/home', 'HomeController@index')->name('home');
//Route::get('/home/dashboard', 'HomeController@dash')->name('user.dashboard');
Route::get('/home/settings', 'SettingsController@index')->name('user.settings');
Route::put('profile-update', 'SettingsController@updateProfile')->name('user.profile.update');
Route::put('password-update', 'SettingsController@updatePassword')->name('user.password.update');
Route::get('home/favorite', 'HomeController@fav')->name('user.favorite');

//all Auth users
Route::group(['middleware'=>['auth']], function(){
    Route::post('favourite/{post}/add', 'FavoriteController@add')->name('post.favorite');
    Route::post('comment/{post}/', 'CommentController@index')->name('comment.store');
});

//Admin Routes
Route::group(['as'=>'admin.','prefix'=>'admin','namespace'=>'Admin','middleware'=>['auth','admin']], function(){
    Route::get('dashboard','DashboardController@index')->name('dashboard');
    Route::get('settings', 'SettingsController@index')->name('settings');
    Route::put('profile-update', 'SettingsController@updateProfile')->name('profile.update');
    Route::put('password-update', 'SettingsController@updatePassword')->name('password.update');

    Route::resource('tag','TagController');
    Route::resource('category','CategoryController');
    Route::resource('post','PostController');

    Route::get('pending/post', 'PostController@pending')->name('post.pending');
    Route::put('post/{id}/approve', 'PostController@approval')->name('post.approve');

    Route::get('comments/', 'CommentController@index')->name('comment.index');
    Route::delete('comments/{id}', 'CommentController@destroy')->name('comment.destroy');

    Route::get('/subscriber', 'SubscriberController@index')->name('subscriber.index');
    Route::delete('/subscriber/{subscriber}', 'SubscriberController@destroy')->name('subscriber.destroy');

    Route::get('/favorite', 'FavoriteController@index')->name('favorite.index');
});

//Author Routes
Route::group(['as'=>'author.','prefix'=>'author','namespace'=>'Author','middleware'=>['auth','author']], function(){
    Route::get('dashboard','DashboardController@index')->name('dashboard');
    Route::get('settings', 'SettingsController@index')->name('settings');
    Route::put('profile-update', 'SettingsController@updateProfile')->name('profile.update');
    Route::put('password-update', 'SettingsController@updatePassword')->name('password.update');
    
    Route::resource('post','PostController');
    Route::get('/favorite', 'FavoriteController@index')->name('favorite.index');
    //Comments
    Route::get('comments/', 'CommentController@index')->name('comment.index');
    Route::delete('comments/{id}', 'CommentController@destroy')->name('comment.destroy');
    
});

View::composer('frontend.includes.footer', function ($view) {
    $categories = App\Category:: all();
    $view->with('categories', $categories);
});