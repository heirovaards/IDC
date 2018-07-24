<?php

Route::get('/', 'HomeController@index')->name('home');
//auth routes
Route::get('/login', 'AuthController@getLogin')->name('login');
Route::post('/login', 'AuthController@postLogin')->name('post.login');
Route::get('/signup', 'AuthController@getRegister')->name('pages.signup');
Route::post('/signup', 'AuthController@postRegister')->name('post.register');

//master routes
Route::get('/master', function (){return view('master.index');});
Route::get('/logout', 'AuthController@logout')->name('logout');
Route::get('/forgot_password', 'AuthController@forgotPasswordForm')->name('forgot_password');
Route::post('/forgot_password/post', 'AuthController@requestEditPassword')->name('post.forgot_password');
Route::post('/reset_password/post', 'AuthController@resetPassword')->name('post.reset_password');

//guest route
Route::get('/public/events', 'EventController@guestEvent')->name('guest.event');
Route::post('/guest/search', 'EventController@guestSearch')->name('guest.search');
Route::get('/guest/donation', function (){
    return view('pages.guest_donation');
})->name('guest.donation');

//email route
Route::get('register/verify/{token}', [
    'as' => 'confirmation_path',
    'uses' => 'AuthController@confirm'
]);

Route::get('reset_password/{token}', [
    'as' => 'reset_password',
    'uses' => 'AuthController@editPasswordLink'
]);


// using prefix /{role}
//protected by middleware of each role

// organization routes



Route::prefix('organization')->middleware('role:organization')->group(function (){
//  user organization function
//   login and profile route
    Route::get('/profile','AuthController@profile')
        ->name('organization');

//  create event form route
    Route::get('/create_event', 'EventController@showCreateEventForm')->name('event.form');

//  save record from create event form
    Route::post('/create_event', 'EventController@postEvent')->name('post.event');

//  get particular organization their own events
    Route::get('/event', 'EventController@getEvents')->name('org.list.event');

//  get event detail for ogranization
    Route::get('/post/{event}/detail', 'EventController@showEventDetail')->name('org.event.detail');

    Route::get('/event/{event}/manage', 'RegistrationController@manageVolunteer')->name('manage.volunteer');

    Route::post('/event_attend', 'RegistrationController@attendEvent')->name('attend.event');

    Route::get('/event/comment', 'EventController@eventForComment')->name('comment.list.event');
    Route::get('/event/volunteers', 'EventController@eventForManage')->name('volunteers.list.event');
    Route::post('/event/{event}/edit', 'ManageController@editEvent')->name('org.edit.event');

    Route::get('/organization/user/{user}/edit', 'ManageController@editUser')->name('organization.edit.user');

    Route::get('/comment/{event}/detail', 'CommentController@listComment')->name('event.comment');

    Route::get('/print/{event}/attendance', 'ReportController@printAttendance')->name('print.attendance');

    Route::get('/guest/donation', function (){
        return view('pages.user_donation');
    })->name('org.donation');

});


Route::post('/event/search', 'EventController@search')->middleware('auth')->name('user.list.event.search');
//user routes
Route::prefix('volunteers')->middleware('role:user')->group(function (){
//  user redirect function
//  login and profile route
    Route::get('/profile', 'AuthController@profile')
        ->name('user');

//  get list of event for user
    Route::get('/event', 'EventController@getEvents')->name('user.list.event');




//  get event detail for user
    Route::get('/event/{event}/detail', 'EventController@showEventDetail')->name('user.event.detail');

//    registration route
    Route::post('/event/{event}/register', 'RegistrationController@eventRegistration')->name('event.register');

    Route::post('/event/comment', 'CommentController@addComment')->name('user.comment');

    Route::get('/event/{attended}/comment_form', 'CommentController@commentForm')->name('comment.form');

    Route::get('/event/attended', 'CommentController@attendedEvent')->name('attended.event');

    Route::get('/event/attended/list', 'EventController@attendedEvent')->name('list.attended.event');

    Route::get('/volunteer/user/{user}/edit', 'ManageController@editUser')->name('volunteer.edit.user');

    Route::post('/print/attended/event', 'ReportController@printPDF')->name('print.report');

    Route::post('/print/certificate/event', 'ReportController@printCertificate')->name('print.certificate');

    Route::get('/comment', 'CommentController@userComment')->name('list.user.comment');

    Route::get('/comment/{comment}/edit', 'CommentController@editComment')->name('edit.comment');

    Route::patch('/comment/{comment}/update', 'CommentController@updateComment')->name('update.comment');

    Route::post('/comment/{comment}/delete', 'CommentController@deleteComment')->name('delete.comment');

    Route::get('/guest/donation', function (){
        return view('pages.user_donation');
    })->name('user.donation');


});



//admin routes
Route::prefix('admin')->middleware('role:admin')->group(function () {
//  admin redirect function
    Route::get('/profile', 'AuthController@profile')
        ->name('admin');

    Route::get('/event', 'EventController@getEvents')->name('admin.list.event');

    Route::get('/event/{event}/detail', 'EventController@showEventDetail')->name('admin.event.detail');
    Route::patch('/event/{event}/detail', 'EventController@eventApproval')->name('event.approval');

    Route::get('/user', 'ManageController@manageUser')->name('manage.user');

    Route::post('/user/{user}/delete', 'ManageController@deleteUser')->name('delete.user');


    Route::get('/events', 'ManageController@manageEvent')->name('manage.event');

    Route::post('/events/{event}/delete', 'ManageController@deleteEvent')->name('delete.event');

    Route::post('/events/{event}/edit', 'ManageController@editEvent')->name('edit.event');



    Route::get('/interests', 'ManageController@manageInterest')->name('manage.interest');

    Route::post('/interests/{interest}/delete', 'ManageController@deleteInterest')->name('delete.interest');

    Route::post('/interests/add', 'ManageController@addInterest')->name('add.interest');

    Route::get('/admin/user/{user}/edit', 'ManageController@editUser')->name('admin.edit.user');

    Route::get('/add_event', 'EventController@showCreateEventForm')->name('admin.add.event');

    Route::get('/guest/donation', function (){
        return view('pages.user_donation');
    })->name('admin.donation');

});

Route::patch('/user/{user}/update', 'ManageController@updateUser')->name('update.user');

Route::patch('/events/{event}/update', 'ManageController@updateEvent')->name('update.event');

Route::get('/try', function (){return view('profilepages');});
