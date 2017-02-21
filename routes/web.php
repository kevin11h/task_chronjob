<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function (){
    return view('welcome');
});

Auth::routes();



//FACCEBOOK login
Route::get('/facebook', 'FacebookController@redirectToProvider')->name('facebook');
Route::get('/facebook/callback', 'FacebookController@handleProviderCallback');

//GOOGLE login
Route::get('/google', 'GoogleController@redirectToProvider')->name('google.login');
Route::get('/google/callback', 'GoogleController@handleProviderCallback');


//Route::get('/home','HomeController@index');

Route::get('/home',[
    'uses' => 'HomeController@index',
    'as' => '/home',
//    'middleware' => 'userprivilege'
]);

Route::get('/showtable',
    [
    'uses' => 'ProductController@index',
    'as' => '/showtable'
    ]
);

Route::post('/addfrutsdata',
    [
    'uses' => 'ProductController@addfruts',
    'as' => '/addfrutsdata'
    ]
);
Route::post('/delete',
    [
        'uses' => 'ProductController@delete',
        'as' => '/delete'
    ]);
Route::post('/edit',
    [
        'uses' => 'ProductController@edit',
        'as' => '/edit'
    ]);
Route::get('/test',
    [
        'uses' => 'ProductController@test',
        'as' => '/test'
    ]);
Route::get('/test2',
    [
        'uses' => 'ProductController@test2',
        'as' => '/test2'
    ]);

Route::get('/file',
    [
        'uses' => 'ProductController@file',
        'as' => '/file'
    ]
);
Route::get('/directory',
    [
        'uses' => 'ProductController@directory',
        'as' => '/directory'
    ]
);

///////////// USER Profile ///

Route::get('profile',
    [
        'uses' => 'ProfileController@index',
        'as' => '/profile'
    ]
);
/////////// add_friend_request ///

Route::post('/add_friend_request',
    [
        'uses' => 'FriendRequestController@index',
        'as' => '/add_friend_request'
    ]
);
Route::post('/addFriend',
    [
        'uses' => 'FriendRequestController@addFriend',
        'as' => '/addFriend'
    ]
);
Route::post('/friend_del',
    [
        'uses' => 'FriendRequestController@friendDel',
        'as' => '/friend_del'
    ]
);
Route::post('/get_messages',
    [
        'uses' => 'MessagesController@index',
        'as' => '/get_messages'
    ]
);
Route::post('/send_messages',
    [
        'uses' => 'MessagesController@create',

        'as' => '/send_messages'
    ]
);

Route::get('/messages',
    [
        'uses' => 'MessagesPageController@index',
        'as' => '/messages'
    ]
);
Route::post('/select_messages',
    [
        'uses' => 'MessagesController@select',
        'as' => '/select_messages'

    ]
);
Route::get('/get_userid',
    [
        'uses' => 'ProductController@get_userid',
        'as' => '/get_userid'
    ]
);

//////PDF/////////

Route::get('pdfview',array('as'=>'pdfview','uses'=>'MessagesController@pdfview'));


Route::get('/calendar',
    [
        'uses' => 'CalendarController@calendar',
        'as' => '/calendar'

    ]
);





