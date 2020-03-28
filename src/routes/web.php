<?php

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


Route::get('/','Web\PageController@index');

Route::get('testCron','CronController@testCron')->name('testCron');

Route::get('project1','Web\PageController@getProject1');
Route::get('about-us','Web\PageController@about');
Route::post('enquiry','Web\PageController@postEnquiry')->name('enquiry');

// Route::get('test-job','Web\PageController@testJob');
// Route::get('auto-donate','Web\PageController@autoDonate');
Route::get('contact','Web\PageController@contact');
Route::post('subscibed','Web\PageController@subscibed');
Route::get('projects','Web\ProjectController@index');
// project search
Route::get('projects/result','Web\ProjectController@search');
Route::post('search-hints','Web\ProjectController@searchHints');
// project details
Route::get('projects/{id}','Web\ProjectController@show');
// comment route
Route::get('projects/{projectId}/comments','Web\CommentController@allComments');
Route::get('projects/comments/{id}','Web\CommentController@index');

Route::get('max-funded','Web\ProjectController@maxFunded');
Route::get('invoice/{key}','Web\InvoiceController@showInvoice');

Route::group(['middleware' => ['auth']], function () {
	// donate
	Route::post('donate/{intervalId}', 'Web\ProjectController@donate');
	Route::post('comments/{projectId}','Web\CommentController@store');
	Route::post('invoice/{projectId}','Web\InvoiceController@mailInvoice');

	Route::get('profile', 'Web\PageController@profile');
	Route::get('profile/password','Web\UserController@showProfilePassword');
	
	Route::get('profile/edit', 'Web\UserController@profileEdit');
	Route::post('profile/update', 'Web\UserController@profileUpdate');
	Route::post('profile/password', 'Web\UserController@updatePassword');

	Route::get('backed-campaigns', 'Web\PageController@backCampaigns');
	Route::get('backed-campaigns/{projectId}', 'Web\PageController@donations');
	// wallet routes
	Route::get('wallet','Web\WalletController@index');
	Route::post('wallet/add','Web\WalletController@postAddMoney');
	Route::put('plan','Web\WalletController@updatePlan')->name('update.plan');

	Route::post('wallet/success','Web\WalletController@postSuccess');
	Route::post('wallet/fail','Web\WalletController@postFail');
	Route::get('wallet/transaction','Web\WalletController@getTransaction');

});
Route::get('how-it-works', function () {
	return view('how_it_works');
});
Route::get('what-is-this',function(){
	return view('what_is_this');
});
Route::get('privacy-policy',function(){
	return view('privacy_policy');
});
Route::get('start-your-campaign',function(){
	return view('start_your_campaign');
});
Route::get('campaign-support',function(){
	return view('campaign_support');
});
Route::get('trust-and-safety',function(){
	return view('trust_and_safety');
});
Route::get('support',function(){
	return view('support');
});
Route::get('terms-of-use',function(){
	return view('terms_of_use');
});

/*****************************
		Admin Routes
		*****************************/
		Route::get('send','API\DonationController@sendReceipt');
		Route::get('admin/login','AdminAuthController@getLogin')->middleware('guest')->name('admin.login');
		Route::post('admin/login','AdminAuthController@postLogin');

		Route::get('admin/logout','AdminAuthController@logout')->middleware('auth')->name('admin.logout');

		Route::group(['middleware' => ['auth','admin']], function () {
			Route::prefix('admin')->group(function () {
				Route::get('cron-test','ProjectController@cronTest');
				Route::get('dashboard', function () {
					return view('admin.dashboard');
				});
				
				Route::put('ngo/update-image','NgoController@updateImage')->name('ngo.update_image');
				Route::put('ngo/update-pancard','NgoController@updatePancard')->name('ngo.update_pancard');
				Route::put('ngo/update-certificate','NgoController@updateCertificate')->name('ngo.update_certificate');
				Route::put('ngo/update-crcertificate','NgoController@updateCrcertificate')->name('ngo.update_crcertificate');
				Route::put('ngo/update-dead','NgoController@updateDead')->name('ngo.update_dead');
				Route::post('ngo/kyc-update','NgoController@kycUpdate')->name('ngo.kyc_update');

				Route::delete('ngo/delete-image','NgoController@destroyImage')->name('ngo.delete_image');
				Route::delete('ngo/delete-pan','NgoController@destroyPan')->name('ngo.delete_pan');
				Route::delete('ngo/delete-certificate','NgoController@destroyCertificate')->name('ngo.delete_certificate');
				Route::delete('ngo/delete-crcertificate','NgoController@destroyCrcertificate')->name('ngo.delete_crcertificate');
				Route::delete('ngo/delete-dead','NgoController@destroyDead')->name('ngo.delete_dead');
				Route::resource('ngo', 'NgoController');

				Route::delete('projects/image/{imgId}/destroy', 'ProjectController@destroyImage')->name('projects.destroy_image');
				Route::post('projects/images/upload', 'ProjectController@updateImage')->name('projects.update_image');
				Route::post('projects/status','ProjectController@updateStatus')->name('projects.status')->middleware('can:admin');
				Route::post('projects/home_status','ProjectController@updateHomeStatus')->name('projects.home_status')->middleware('can:admin');
				Route::put('projects/end-date/{project}', 'ProjectController@extendEndDate')->name('projects.end_date');
		// completed projects
				Route::get('completed-projects', 'ProjectController@completedProjects')->name('projects.completed');

		// Route::get('projects/complete','Web\ProjectController@index');

				Route::post('generate-receipts','ProjectController@mailReceipt')->name('generate.receipts');
				Route::get('projects/fund','ProjectController@fund')->name('projects.fund');
				Route::post('projects/submitfund','ProjectController@submitfund')->name('projects.submitfund');
				Route::put('pojects/{projectId}/update-info','ProjectController@updateInfo')->name('projects.updateInfo');
				Route::resource('projects', 'ProjectController');
				
				Route::post('users/projects/{userId}','UserController@userProjects');
				Route::put('users/update-image','UserController@updateImage')->name('users.update_image');
				Route::put('users/update-password','UserController@updatePassword')->name('users.update_password');
				Route::delete('users/delete-image','UserController@destroyImage')->name('users.destroy_image');
				Route::post('users/search-donation','UserController@searchDonation')->name('users.search_donation');
				Route::resource('users','UserController');
				Route::get('users/download/{filename}', 'UserController@csvDownload');

		// Route::resource('users','UserController')->middleware('can:admin');

				Route::get('profile','UserController@showProfile')->name('profile.show');
				
				Route::get('donoremail','UserController@showDonorEmailList')->name('donor.show');
				Route::post('sendDonorEmails','UserController@sendDonorEmails')->name('admin.sendDonorEmails');
				Route::put('users/update-email-image','UserController@updateEmailImage')->name('users.update_email_image');


				Route::get('profile/edit','UserController@profile')->name('profile.edit');
				Route::put('profile/update','UserController@PutUpdateProfile')->name('profile_update');
				
				Route::resource('roles', 'RoleController')->middleware('can:admin');
				Route::resource('payments', 'PaymentController')->middleware('can:admin');
				Route::post('donations/refund','ProjectController@refund')->name('donation_refund');
				Route::resource('editors', 'EditorController')->middleware('can:admin');
				Route::resource('razorpaycredentials', 'RazorpaycredentialsController')->middleware('can:admin');

		// config route
				Route::get('config','ConfigController@getConfig');
				Route::put('commission','ConfigController@updateCommission')->name('update.commission');
				Route::put('project1','ConfigController@setProject1')->name('update.project1');
				Route::put('project2','ConfigController@setProject2')->name('update.project2');

			});
});

// exit('hi1');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');

Route::get('importExport', 'MaatwebsiteDemoController@importExport');
Route::post('importExcel', 'MaatwebsiteDemoController@importExcel');
// exit('hi');

Route::post('pay', 'RazorpayController@pay')->name('pay');

// route for make payment request using post method
Route::post('dopayment', 'RazorpayController@dopayment')->name('dopayment');

Route::post('add_payment_details', 'RazorpayController@add_payment_details')->name('add_payment_details');

