<?php

use App\Http\Controllers\FacebookController;
use App\Http\Controllers\GoogleController;
use App\Models\publisherModel;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\admin\categoryController;
use App\Http\Controllers\admin\regionController;
use App\Http\Controllers\admin\articleTypeController;
use App\Http\Controllers\admin\indexController;
use App\Http\Controllers\admin\subcategoryController;
use App\Http\Controllers\admin\PopularOfferController;

use App\Http\Controllers\registerController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\DiscoverController;
use App\Http\Controllers\articleController;
use App\Http\Controllers\orderController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\publisherController;
use App\Http\Controllers\admin\articleController as adminArticleController;
use App\Http\Controllers\PayPalController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::post('/meta-data', [\App\Http\Controllers\MetaController::class,'changeMetaData'])->name('change-meta-data');

Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    return 'Cache cleared!';
});

Route::get('/clear-config-cache', function () {
    Artisan::call('config:clear');
    return 'Config cache cleared!';
});

Route::get('/clear-route-cache', function () {
    Artisan::call('route:clear');
    return 'Route cache cleared!';
});

Route::get('/clear-view-cache', function () {
    Artisan::call('view:clear');
    return 'View cache cleared!';
});
// Route::get('/', [DiscoverController::class,'category'])->name('temp-dashboard')->middleware('session');

Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('temp-dashboard');

Route::get('/discover', [DiscoverController::class,'category'])->name('user-discover')->middleware('session');

Route::get('/search-discover', [DiscoverController::class,'searchDiscover'])->name('search-discover')->middleware('session');;



Route::post('/signup-process', [registerController::class,'save'])->name('register-save');
Route::post('/signin-process', [loginController::class,'authUser'])->name('signin-process');
Route::any('/logout', [loginController::class,'logout'])->name('logout-process');


Route::get('/new-order', [orderController::class, 'newOrder'])->name('user-new-order')->middleware('session');
Route::get('/new-order-update/{id}', [orderController::class, 'newOrderUpdate'])->name('user-new-order-update')->middleware('session');
Route::get('/new-order-delete/{id}', [orderController::class, 'newOrderDelete'])->name('user-new-order-delete')->middleware('session');

Route::post('/process-new-order', [articleController::class, 'processNewOrder'])->name('process-new-order');

Route::get('/draft', [articleController::class, 'draft'])->name('user-draft')->middleware('session');

Route::get('/reset-password/{code}', [loginController::class, 'resetPasswordCode'])->name('resetPasswordCode');
Route::any('/reset-password-process/', [loginController::class, 'resetPasswordCodeProcess'])->name('resetPasswordCodeProcess');

Route::get('/change-password', [loginController::class, 'changePassword'])->name('userChangePassword')->middleware('session');
Route::any('/change-password-update', [loginController::class, 'changePasswordUpdate'])->name('user-change-password-update')->middleware('session');

Route::get('/verify-email/{code}', [loginController::class, 'verifyEmail'])->name('verifyEmailCode');
// Route::get('/tracking', function () {
//     return view('user/tracking');
// })->name('user-tracking-default')->middleware('session');

Route::get('/tracking', [orderController::class, 'tracking_default'])->name('user-tracking-default')->middleware('session');
Route::get('/tracking/{id}', [orderController::class, 'tracking'])->name('user-tracking')->middleware('session');
Route::any('/update-article-comments', [orderController::class, 'updateArticleComment'])->name('user-article-comment')->middleware('session');
Route::any('/update-article-status', [orderController::class, 'updateArticleStatus'])->name('user-article-status')->middleware('session');

Route::get('/profile', [orderController::class, 'profile'])->name('profile')->middleware('session');
Route::any('/profile-update', [orderController::class, 'profileUpdate'])->name('profile-update')->middleware('session');

Route::get('/admin/change-password', [adminArticleController::class, 'changePassword'])->name('changePassword')->middleware('adminsession');
Route::any('/admin/change-password-update', [adminArticleController::class, 'changePasswordUpdate'])->name('change-password-update')->middleware('adminsession');
Route::any('/admin/reset-password-via-email/{code}', [adminArticleController::class, 'resetPasswordCodeViaEmail'])->name('reset-password-via-email')->middleware('adminsession');
Route::any('/admin/reset-password-via-email-process', [adminArticleController::class, 'resetPasswordCodeViaEmailProcess'])->name('reset-password-via-email-process')->middleware('adminsession');

Route::get('/publisher-details/{id}', [articleController::class, 'publisherDetails'])->name('publisher-details')->middleware('session');

Route::get('/admin/articles/articles_detail/{id}', [adminArticleController::class, 'articleDetails'])->name('articleDetails')->middleware('adminsession');

Route::any('/admin/articles/updateComments', [adminArticleController::class, 'articleupdateComments'])->name('articleupdateComments')->middleware('adminsession');
//Admin Route

Route::get('/admin', function () {
    return view('admin/login');
})->name('admin-login');

Route::get('/admin/reset-password', function () {
    return view('admin/reset_password');
})->name('reset-password');

// Route::get('/dashboard', function () {
//     return view('admin/dashboard');
// })->name('admin-dashboard')->middleware('adminsession');

// Route::get('/category', function () {
//     return view('admin/category');
// });

// Route::get('/sub-category', function () {
//     return view('admin/sub-category');
// });

Route::get('/articles', function () {
    return view('admin/articles');
});

// Route::get('/publisher', function () {
//     return view('admin/publisher');
// });

// Route::get('/user', function () {
//     return view('admin/user');
// });

Route::any('/manage-users', [indexController::class,'manageUsers'])->name('admin-manage-user')->middleware('adminsession');
Route::any('/user', [indexController::class,'userList'])->name('admin-user-list')->middleware('adminsession');
Route::any('/user/black-list', [indexController::class,'userBlackList'])->name('admin-user-black-list')->middleware('adminsession');
Route::any('/user/toggle-status', [indexController::class,'toggleUserStatus'])->name('toggle-user-status')->middleware('adminsession');
Route::any('/dashboard', [indexController::class,'dashboard'])->name('admin-dashboard')->middleware('adminsession');


Route::resource('admin/category', categoryController::class)->middleware('adminsession');
Route::resource('admin/region', regionController::class)->middleware('adminsession');
Route::resource('admin/article-type', articleTypeController::class)->middleware('adminsession');

Route::resource('admin/subcategory', subcategoryController::class)->middleware('adminsession');
Route::resource('admin/publisher', publisherController::class)->middleware('adminsession');
Route::post('admin/delete-publisher', [publisherController::class, 'deletePublisher'])->name('delete-publisher')->middleware('adminsession');
Route::resource('admin/articles', adminArticleController::class)->middleware('adminsession');
Route::get('admin/search-publisher', [publisherController::class,'searchPublisher'])->name('admin.search-publisher')->middleware('adminsession');;

Route::resource('admin/popular-offer', PopularOfferController::class)->middleware('adminsession');
Route::post('delete-offer-image', [PopularOfferController::class,'deletePubImage'])->name('delete-offer-image');
Route::post('delete-popular-offer', [PopularOfferController::class,'deletePopularOffer'])->name('delete-popular-offer');

Route::get('/login', function () {
    return view('user/auth/user_login');
})->name('login');

Route::get('/home', [\App\Http\Controllers\HomeController::class, 'index'])->name('common-login');


Route::post('admin/signin-process', [indexController::class,'authAdminUser'])->name('admin-signin-process');

Route::get('/signup', function () {
    return view('user/auth/customer_signup');
});

Route::get('verify', function () {
    return view('user/auth/verify_email');
})->name("verify");

Route::get('test-email', function () {
    Artisan::call('app:add-niches-to-publishers');


})->name("test-email");

Route::get('/forgot-password', function () {
    return view('user/auth/forgot_password');
})->name('forgot-password-user');

Route::get('/change-password-email', function () {
    return view('user/auth/change-password-email');
})->name('change-password-email');


Route::post('forgot-password-process', [loginController::class,'forgotPasswordProcess'])->name('user-forgot-password-process');
Route::post('user-change-password-process', [loginController::class,'changePasswordProcessEmail'])->name('user-change-password-process');
Route::post('delete-publisher-image', [publisherController::class,'deletePubImage'])->name('delete-publisher-image');

// Route::get('/change-password', function () {
//     return view('user/auth/change_password');
// });

Route::post('/email-exist', [registerController::class, 'emailExist'])->name('email-exists');

Route::get('/customer-signup', function () {
    return view('user/auth/customer_signup');
})->name('customer-signup');

Route::get('/agency-signup', function () {
    return view('user/auth/agency_signup');
})->name('agency-signup');

Route::get('/publisher-signup', function () {
    return view('user/auth/publisher_signup');
});

// PAYMENT PAYPAL

Route::get('create-transaction', [PayPalController::class, 'createTransaction'])->name('createTransaction')->middleware('session');
Route::get('process-transaction/{id}', [PayPalController::class, 'processTransaction'])->name('processTransaction')->middleware('session');
Route::get('success-transaction', [PayPalController::class, 'successTransaction'])->name('successTransaction')->middleware('session');
Route::get('cancel-transaction', [PayPalController::class, 'cancelTransaction'])->name('cancelTransaction')->middleware('session');

// CONTACT SUPPORT

Route::post('/contact', [ContactController::class, 'submitForm'])->name('contact');

//Admin Change Password

// Route::any('/admin/change-password', [AdminController::class, 'changePassword'])->name('change-password');
// Route::any('/admin/change-password', [AdminController::class, 'changePassword'])->name('change-password');

Route::get('/privacy-policy', [\App\Http\Controllers\HomeController::class, 'privacyPolicy'])->name('privacy-policy');
Route::get('/terms-of-use', [\App\Http\Controllers\HomeController::class, 'termsAndConditions'])->name('terms-and-conditions');
Route::get('/about-us', [\App\Http\Controllers\HomeController::class, 'aboutUs'])->name('about-us');
Route::get('/refund-policy', [\App\Http\Controllers\HomeController::class, 'refundPolicy'])->name('refund-policy');

Route::prefix('auth')->group(function () {
    Route::get('google', [GoogleController::class, 'redirectToSocial'])->name('google.login');
    Route::get('google/redirect', [GoogleController::class, 'handleSocialCallback']);

    Route::get('facebook', [FacebookController::class, 'redirectToSocial'])->name('facebook.login');
    Route::get('facebook/redirect', [FacebookController::class, 'handleSocialCallback']);
});


Route::get('/blog', function () {
    return view('blog.main');
});

Route::get('/blog/{slug}', function () {
    return view('blog.article_details');
});



Route::group(['prefix' => 'blog'], function () {
    Route::get('/', [\App\Http\Controllers\BlogController::class, 'index'])->name('blog.index');
    Route::get('/{slug}', [\App\Http\Controllers\BlogController::class, 'show'])->name('blog.show');
    Route::get('/category/{slug}', [\App\Http\Controllers\BlogController::class, 'category'])->name('blog.category');
});
