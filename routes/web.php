<?php

use Illuminate\Support\Facades\Route;

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
Auth::routes(['verify'=>true]);

Route::middleware(['verified', 'UserRole'])->group(function () {

    Route::get('admin/dashbord', 'AdminController@index')->name('admin');
    Route::get('adminAccount', 'AdminController@adminAccount')->name('adminAccount');
    Route::post('adminAccountPost', 'AdminController@adminAccountPost')->name('adminAccountPost');
    Route::get('/home', 'HomeController@index')->name('home');

    //blog
    Route::get('blogAdd', 'blogController@blogadd')->name('blogAdd');
    Route::post('blogPost', 'blogController@blogPost')->name('blogPost');
    Route::get('blogUpdate/{id}', 'blogController@blogUpdate')->name('blogUpdate');
    Route::post('blogUpdatePost', 'blogController@blogUpdatePost')->name('blogUpdatePost');
    Route::get('blogView', 'blogController@blogVeiw')->name('blogView');
    Route::get('blogDelete/{id}', 'blogController@blogDelete')->name('blogDelete');
    Route::get('blogComments', 'blogController@blogComments')->name('blogComments');
    Route::get('commentToBlog/{id}', 'blogController@commentToBlog')->name('commentToBlog');

    //Banner
    Route::get('bannerAdd', 'bannerController@bannerAdd')->name('bannerAdd');
    Route::post('bannerPost', 'bannerController@bannerPost')->name('bannerPost');
    Route::get('bannerView', 'bannerController@bannerView')->name('bannerView');
    Route::get('bannerDelete/{id}', 'bannerController@bannerDelete')->name('bannerDelete');

    //Catagory
    Route::get('/category', 'CategoryController@category');
    Route::post('/categoryPost', 'CategoryController@categoryPost');
    Route::get('/categoryUpdate/{id}', 'CategoryController@categoryUpdate')->name('categoryUpdate');
    Route::post('/categoryUpdatePost', 'CategoryController@categoryUpdatePost')->name('categoryUpdatePost');
    Route::get('/categoryView', 'CategoryController@categoryView');
    Route::get('/categoryDelete/{id}', 'CategoryController@categoryDelete');

    //Sub Category
    Route::get('/subCategoryAdd', 'subCategoryController@subCategoryAdd');
    Route::post('/subCategoryPost', 'subCategoryController@subCategoryPost');
    Route::get('/subCategoryView', 'subCategoryController@subCategoryView');
    Route::get('/subCategoryDelete/{id}', 'subCategoryController@subCategoryDelete');
    Route::get('/subCategoryTrush', 'subCategoryController@subCategoryTrush');
    Route::get('/subCategoryTrushRecover/{id}', 'subCategoryController@subCategoryTrushRecover');
    Route::get('/subCategoryTrushForceDelete/{id}', 'subCategoryController@subCategoryTrushForceDelete');
    Route::get('/subCategoryUpdate/{id}', 'subCategoryController@subCategoryUpdate');
    Route::post('/subCategoryUpdatePost', 'subCategoryController@subCategoryUpdatePost');

    //Product
    Route::get('/product', 'productController@product');
    Route::get('/productView', 'productController@productView');
    Route::post('/productPost', 'productController@productPost');
    Route::get('/productDelete/{id}', 'productController@productDelete');
    Route::get('/ProductTrashed', 'productController@ProductTrashed')->name('ProductTrashed');
    Route::get('/productEdit/{id}', 'productController@productEdit');
    Route::post('/productEditPost', 'productController@productEditPost')->name('productUpdatePost');
    Route::get('/deleteGalleryImg/{id}', 'productController@deleteGalleryImg')->name('deleteGalleryImg');
    Route::get('/ProductRestore/{pro_id}', 'productController@ProductRestore')->name('ProductRestore');
    Route::get('/ProductForceDelete/{pro_id}', 'productController@ProductForceDelete')->name('ProductForceDelete');

    //Messages
    Route::get('/message', 'messageController@message')->name('message');
    Route::get('/messageView/{id}', 'messageController@messageView')->name('messageView');
    Route::get('/messageUnseen/{id}', 'messageController@messageUnseen')->name('messageUnseen');

    //About
    Route::get('/aboutSet', 'aboutSetController@aboutSet')->name('aboutSet');
    Route::post('/aboutPost', 'aboutSetController@aboutPost')->name('aboutPost');

    //Site settings
    Route::get('/siteUpdate', 'siteSettingsController@siteUpdate')->name('siteUpdate');
    Route::post('/siteUpdatePost', 'siteSettingsController@siteUpdatePost')->name('siteUpdatePost');

    //testimonial
    Route::get('testimonialAdd', 'testimonialController@testimonialAdd')->name('testimonialAdd');
    Route::post('testimonialPost', 'testimonialController@testimonialPost')->name('testimonialPost');
    Route::get('testimonialView', 'testimonialController@testimonialView')->name('testimonialView');
    Route::get('testimonialUpdate/{id}', 'testimonialController@testimonialUpdate')->name('testimonialUpdate');
    Route::post('testimonialUpdatePost/', 'testimonialController@testimonialUpdatePost')->name('testimonialUpdatePost');
    Route::get('testimonialDelete/{id}', 'testimonialController@testimonialDelete')->name('testimonialDelete');

    //Faq
    Route::get('/faqPost', 'FrontendController@faqPost')->name('faqPost');
    Route::get('/addFaq', 'FrontendController@addFaq')->name('addFaq');
    Route::post('/faqPost', 'FrontendController@faqPost')->name('faqPost');
    Route::get('/viewFaq', 'FrontendController@viewFaq')->name('viewFaq');
    Route::get('/faqEdit/{id}', 'FrontendController@faqEdit')->name('faqEdit');
    Route::Post('/faqEditPost', 'FrontendController@faqEditPost')->name('faqEditPost');
    Route::get('/faqDelete/{id}', 'FrontendController@faqDelete')->name('faqDelete');

    //newsLetter
    Route::get('newsLetter' , 'newsLetterController@newsLetter')->name('newsLetter');
    Route::post('newsLetterPost' , 'newsLetterController@newsLetterPost')->name('newsLetterPost');

    //Countdown
    Route::get('setCountdown', 'countdownController@setCountdown')->name('setCountdown');
    Route::post('countDownPost', 'countdownController@countDownPost')->name('countDownPost');


});

Route::group(['middleware' => ['verified']], function () {
    //customer
    Route::get('castomer/dashbord', 'CastomerController@index')->name('catomer');
    Route::post('userUpdate', 'CastomerController@userUpdate')->name('userUpdate');
    //frontend route
    Route::get('/checkout', 'checkoutController@checkoutView')->name('checkout');
    Route::get('/api/get-state-list/{country_id}', 'checkoutController@stateList')->name('stateList');
    Route::get('api/get-city-list/{city_id}', 'checkoutController@cityList')->name('cityList');
    Route::post('/payment', 'paymentController@payment')->name('payment');
    //wish
    Route::get('/singleWish/{slug}', 'wishController@singleWish')->name('singleWish');
    Route::get('/wishDelete/{id}', 'wishController@wishDelete')->name('wishDelete');
    Route::get('/wishList', 'wishController@wishList')->name('wishList');

    //Comment
    Route::get('deleteComments/{id}', 'blogController@deleteComments')->name('deleteComments');

    Route::get('deleteReview/{id}', 'FrontendController@deleteReview')->name('deleteReview');

});

//frontend
Route::get('/', 'FrontendController@frontpage');
Route::post('newsLetter', 'FrontendController@newsLetter')->name('newsLetter');
Route::post('review', 'FrontendController@review')->name('review');
Route::get('/SingleProduct/{pro_id}', 'FrontendController@SingleProduct')->name('SingleProduct');
Route::get('/shop', 'FrontendController@shop')->name('shop');
Route::get('/singleCart/{slug}', 'FrontendController@singleCart')->name('singleCart');
Route::get('/blog', 'FrontendController@blog')->name('blog');
Route::get('/singleBlog/{slug}', 'FrontendController@singleBlog')->name('singleBlog');
Route::get('/categoryBlog/{id}', 'FrontendController@categoryBlog')->name('categoryBlog');
Route::post('/blogComments', 'FrontendController@blogComments')->name('blogComments');
Route::get('/about', 'FrontendController@about')->name('about');
Route::get('/categoryProduct/{name}', 'FrontendController@categoryProduct')->name('categoryProduct');
Route::get('/faq', 'FrontendController@faq')->name('faq');

Route::post('/search', 'FrontendController@search')->name('search');


//cart
Route::get('/cart', 'cartController@cart')->name('cart');
Route::get('/cart/{coupon}', 'cartController@cart')->name('couponCart');
Route::get('/singleCartDelete/{cart_id}', 'cartController@singleCartDelete')->name('singleCartDelete');
Route::post('/cartUpdate', 'cartController@cartUpdate')->name('cartUpdate');
Route::post('/singleCartAdd', 'cartController@singleCartAdd')->name('singleCartAdd');


//socialite
Route::get('login/github', 'socialController@redirectToProvider')->name('redirectToProvider');
Route::get('login/github/callback', 'socialController@handleProviderCallback')->name('handleProviderCallback');

Route::get('login/google', 'socialController@redirectToProviderGoogle')->name('redirectToProviderGoogle');
Route::get('login/google/callback', 'socialController@handleProviderCallbackGoogle')->name('handleProviderCallbackGoogle');


//contact
Route::get('/contact', 'frontendController@contact')->name('contact');
Route::post('/contactPost', 'frontendController@contactPost')->name('contactPost');




Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
