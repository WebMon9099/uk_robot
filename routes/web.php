<?php

use App\Models\UserIp;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\PressController;
use App\Http\Controllers\BotManController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserOrderController;
use App\Http\Controllers\ViewBlogsController;
use App\Http\Controllers\ViewPressController;
use App\Http\Controllers\NewsLetterController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\SiteSettingController;
use App\Http\Controllers\BlogcategoryController;
use App\Http\Controllers\PressReleaseController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\AdvocateambassadorController;
use App\Http\Controllers\Auth\ForgetPasswordController;

Route::post('/like-post/{id}', [ViewBlogsController::class, 'likePost'])->name('like.post');
Route::get('fresh', function () {
    Artisan::call('migrate:fresh --seed --force');
    Artisan::call('config:cache');
    Artisan::call('route:cache');
    Artisan::call('view:cache');
    return redirect()->route('home')->with('success', 'project fresh suucessfully');
});
Route::get('/welcome', function () {
    return view('welcome');
});
Route::post('/admin/update-sales-status', [SiteSettingController::class, 'updateSalesStatus'])->name('admin.updateSalesStatus');

Route::middleware('sales.status')->group(function () {

    Route::get('/checkout', [PagesController::class, 'checkout'])->name('checkout');
    Route::post('/checkout', [PagesController::class, 'processCheckout'])->name('checkout.process');
    Route::get('/Product', [PagesController::class, 'getProducts'])->name('product');
    Route::get('/Product/{id}', [PagesController::class, 'getOneProduct'])->name('products.details');
    Route::post('/cart', [CartController::class, 'store'])->name('cart.store');
    Route::get('/cart', [CartController::class, 'getdata'])->name('cart.store');
    Route::post('/cart/session', [CartController::class, 'store'])->name('cart.session');
    Route::delete('/cart/destroy/{id}/{can_type}', [CartController::class, 'destroy'])->name('cart.destroy');
    Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
    Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('mutiRegsiter');
    Route::post('/register', [AuthController::class, 'showRegistrationFormSubmit'])->name('register.submit');
});
Route::match(['get', 'post'], '/botman', [BotManController::class, 'handle']);
//Route::get('/cart', [CartController::class, 'getdata'])->name('cart.store');
//Route::post('/cart/session', [CartController::class, 'store'])->name('cart.session');
//Route::delete('/cart/destroy/{id}/{can_type}', [CartController::class, 'destroy'])->name('cart.destroy');
//Route::get('/checkout', [PagesController::class, 'checkout'])->name('checkout');
Route::get('/cart/count', [CartController::class, 'getCartCount'])->name('cart.count');

//Press RoutesViewPressController
Route::get('/press', [ViewPressController::class, 'index'])->name('userPress.index');
//Route::get('/latest', [ViewPressController::class, 'latest'])->name('latestblogs');
Route::get('/press/{slug}', [ViewPressController::class, 'show'])->name('press.show');

//Blog Routes
Route::get('/blog', [ViewBlogsController::class, 'index'])->name('userBlog.index');
Route::get('/latestblog', [ViewBlogsController::class, 'latest'])->name('latestblogs');
Route::get('/blog/{slug}', [ViewBlogsController::class, 'show'])->name('blogs.show');

Route::middleware('guest')->group(function () {

    //Press and Blog Register
    Route::get('/blog-register', [AuthController::class, 'register'])->name('register');
    Route::post('/blog-register', [AuthController::class, 'registerUser'])->name('user.register');

    //Advocate Routes
    Route::get('/signUp', [AdvocateambassadorController::class, 'index'])->name('advocateambassadorSignup');
    Route::post('/signup-submit', [AdvocateambassadorController::class, 'submitForm'])->name('signup-submit');
    Route::get('/verify-email/{token}', [AdvocateambassadorController::class, 'verifyEmail'])->name('verify.email');
    //Normal User Register
    // Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('mutiRegsiter');
    // Route::post('/register', [AuthController::class, 'showRegistrationFormSubmit'])->name('register.submit');
    Route::post('/submit-form', [AuthController::class, 'submitForm'])->name('submitForm');
    Route::post('/send-passcode', [AuthController::class, 'sendPasscode']);
    Route::post('/verify-passcode', [AuthController::class, 'verifyPasscode']);
    Route::get('/login', [AuthController::class, 'userLogin'])->name('user.login');
    Route::post('/login', [AuthController::class, 'submitLogin'])->name('user.login');
    Route::get('/forgetPassword', [ForgetPasswordController::class, 'forgetPasswordView'])->name('user.forgetPasswordView');
    Route::post('/forgetPassword', [ForgetPasswordController::class, 'forgetPassword'])->name('user.forgetPassword');
    Route::get('reset-password/{token}', [ForgetPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
    Route::post('reset-password', [ForgetPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');





});

// Routes accessible to authenticated users only
Route::middleware('user.auth')->group(function () {
    Route::post('addresses/add', [PagesController::class, 'addAddress'])->name('user.addresses.add');
    Route::get('addresses/{id}/edit', [PagesController::class, 'editAddress'])->name('user.addresses.edit');
    Route::post('addresses/{id}/update', [PagesController::class, 'updateAddress'])->name('user.addresses.update');
    Route::delete('addresses/{id}/delete', [PagesController::class, 'deleteAddress'])->name('user.addresses.delete');
    Route::get('logout', [AuthController::class, 'userlogout'])->name('user.logout');
    Route::get('/profile', [AuthController::class, 'profile'])->name('user.profile');
    Route::put('/profile', [AuthController::class, 'updateProfile'])->name('user.profile.update');
    Route::post('/update-profile', [AuthController::class, 'updateProfileImage'])->name("account.updateProfileImage");
    Route::post('/check-old-password', [AuthController::class, 'checkOldPassword'])->name('check.old.password');
    Route::post('/update-password', [AuthController::class, 'updatePassword'])->name('password.update');
    // Route::get('/cart', [CartController::class, 'getdata'])->name('cart.store');
    //Route::post('/cart', [CartController::class, 'store'])->name('cart.store');
    //Route::delete('/cart/{id}', [CartController::class, 'destroy'])->name('cart.destroy');
    //Route::post('/checkout', [PagesController::class, 'processCheckout'])->name('checkout.process');
    Route::get('/myOrders', [UserOrderController::class, 'userOrder'])->name('userOrderList');
    Route::get('/myitemdetails/{id}', [UserOrderController::class, 'show'])->name('myitemdetails');
    Route::post('/cancel-order', [UserOrderController::class, 'cancelOrder'])->name('cancel.order');
    Route::get('/invoice/{order_id}', [InvoiceController::class, 'downloadInvoice'])->name('download.invoice');
    Route::post('/apply-credit', [CreditApplicationController::class, 'store'])->name('apply.credit');
    Route::get('/paypal/return', [PagesController::class, 'return'])->name('paypal.return');
    Route::get('/paypal/cancel', [PagesController::class, 'cancel'])->name('paypal.cancel');
});


Route::middleware('term.condition')->group(function () {
    Route::view('/', 'index')->name('home');
    Route::view('/organic-cherry-cola-kumbucha', 'cherry-cola')->name('cherry.cola');
    Route::view('/organic-honey-cola-kumbucha', 'honey-cola')->name('honey.cola');
    Route::view('/organic-pineapple-and-mango-kombucha', 'organic-mango')->name('pineapple.mango');
    Route::view('/the-science', 'science')->name('science');
    Route::view('/contact', 'contact')->name('contact');
    Route::view('/drinks-advocate-ambassador', 'drinksAdvocate&Ambassador')->name('advocate.ambassador');
    Route::get('/press-pack', [PressReleaseController::class, 'showPressRelesase'])->name('press.release');
    Route::get('/download-media-kit', [PressReleaseController::class, 'downloadMediaKit'])->name('downloadMediaKit');
    Route::get('/download-images', [PressReleaseController::class, 'downloadImages'])->name('downloadImages');
    Route::get('/download-pdfs', [PressReleaseController::class, 'downloadPdfs'])->name('downloadPdfs');

    // Route::get('/Product', [PagesController::class, 'getProducts'])->name('product');
    // Route::get('/Product/{id}', [PagesController::class, 'getOneProduct'])->name('products.details');

    Route::post('/post-order', [PagesController::class, 'postOrder'])->name('post.order');
    Route::get('/news-letter/{code?}', [NewsLetterController::class, 'getNewsLetter'])->name('news.letter');
    Route::get('/send-passcode', [NewsLetterController::class, 'sendPasscode'])->name('send.passcode');
    Route::get('/send-verification-email', [NewsLetterController::class, 'sendVarificationMail'])->name('send.verification.email');
    Route::get('/check-passcode', [NewsLetterController::class, 'checkPasscode'])->name('check.passcode');
    Route::get('/send-address', [NewsLetterController::class, 'sendAddress'])->name('send.address');
    Route::get('delete-extra-data', [NewsLetterController::class, 'deleteExtraRecord'])->name('delete.extra.data');
    Route::post('subscribe-news-letter', [NewsLetterController::class, 'store'])->name('subscribe.news.letter');
    Route::post('submit-contact-form', [ContactController::class, 'store'])->name('submit.contact.form');

});
Route::view('/Privacy-Policy', 'privacy-policy')->name('privacy.policy');
Route::get('save-ip', [PagesController::class, 'saveIp'])->name('save.ip');
Route::post('save-ip-form', [PagesController::class, 'saveIpFrom'])->name('save.ip.form');

Route::get('ips', function (Request $req) {
    $ips = UserIp::OrderByDesc('id')->get();
    dd($ips->toArray());
});

Route::prefix('Admin')->group(function () {
    //Route::redirect('/', '/login');
    Route::controller(AuthController::class)
        ->group(function () {
            Route::get('/login', 'login')->name('login');
            Route::post('/submit-login', 'submitLogin')->name('submit.login');
        });

    Route::middleware(['check.auth'])->group(function () {
        Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
        Route::get('/News-letters', [NewsLetterController::class, 'index'])->name('news.letter.index');
        Route::get('/Contact-us', [ContactController::class, 'index'])->name('contact.index');
        Route::controller(UserController::class)->prefix('User')->group(function () {
            Route::get('/', 'index')->name('user.index');
            Route::post('/store', 'store')->name('user.store');
            Route::get('/edit', 'edit')->name('user.edit');
            Route::post('/update/{id}', 'update')->name('user.update');
            Route::get('/user/{id}', 'destroy')->name('user.destroy');
        });
        Route::controller(ProductController::class)
            ->prefix('Product')
            ->group(function () {
                Route::get('/', 'index')->name('product.index');
                Route::post('/store', 'store')->name('product.store');
                Route::get('/edit', 'edit')->name('product.edit');
                Route::post('/update/{id}', 'update')->name('product.update');
                Route::get('/delete/{id}', 'destroy')->name('product.delete');
                Route::get('/product-image-delete/{id}', 'deleteImage')->name('product.image.delete');
            });

        Route::controller(OrderController::class)

            ->prefix('Order')
            ->group(function () {
                Route::get('/', 'index')->name('orders.index');
                Route::get('/order-detail/{id}', 'detail')->name('order.order-detail');
                Route::post('/orders/changeStatus/{id}', 'changeOrderSatatus')->name('order.changeOrderSatatus');
            });
        Route::controller(PaymentController::class)
            ->prefix('Payment')
            ->group(function () {
                Route::get('/', 'index')->name('payment.index');
                // Route::post('/payments',  'store')->name('payments.store');
                Route::post('/payment', 'store')->name('payment.store');  // Store the payment
                Route::get('/{id}/edit', 'edit')->name('payment.edit');
                Route::put('/update/{id}', 'update')->name('payment.update');
            });
        // blog
        Route::controller(BlogController::class)
            ->prefix('blog')
            ->group(function () {
                Route::get('/', 'index')->name('blogs.index');                    // Display a list of blog posts
    
                Route::post('/store', 'store')->name('blog.store');              // Store a new blog post
    
                Route::put('/update/{id}', 'update')->name('blog.update');

                Route::delete('/delete/{id}', 'destroy')->name('blog.destroy');      // Delete a blog post

                Route::delete('/blog/delete-image', 'deleteImage')->name('blog.deleteImage');

    
            });
        Route::controller(PressController::class)
            ->prefix('press-pr')
            ->group(function () {
                Route::get('/', 'index')->name('press.index');                    // Display a list of blog posts
    
                Route::post('/store', 'store')->name('pressc.store');              // Store a new blog post
    
                Route::put('/update/{id}', 'update')->name('press.update');

                Route::delete('/delete/{id}', 'destroy')->name('press.destroy');      // Delete a blog post
    
            });

        // blog categories 

        Route::controller(BlogcategoryController::class)
            ->prefix('category')
            ->group(function () {
                Route::get('/', 'index')->name('category.index');                    // Display a list of blog posts
                //  Route::get('/create', 'create')->name('blog.create');            // Show form to create a new blog post
                Route::post('/store', 'store')->name('category.store');              // Store a new blog post
                // Route::get('/{id}/edit', 'edit')->name('blog.edit');             // Show form to edit a blog post
                Route::put('/update/{id}', 'update')->name('category.update');

                Route::delete('/delete/{id}', 'destroy')->name('category.destroy');      // Delete a blog post
                // Route::get('/{id}', 'show')->name('blog.show');                 // Display a single blog post
            });

        Route::controller(PressReleaseController::class)
            ->prefix('Press-Relases')
            ->group(function () {
                Route::get('/', 'index')->name('press.release');
                Route::post('/press-store', 'store')->name('press.store');
                Route::put('/press/{id}', 'update')->name('press-pack.update');
                Route::delete('/press/delete-image', 'deleteImage')->name('press.deleteImage');
                Route::delete('/press-release/{id}', [PressReleaseController::class, 'destroy'])->name('press.release.destroy');
            });

        Route::get('/press-release/files', [PressReleaseController::class, 'showFilesPage'])->name('press.files.page');
        Route::post('/press-release/delete-file', [PressReleaseController::class, 'deleteFile'])->name('press.file.delete');
        Route::get('/site-setting', [SiteSettingController::class, 'index'])->name('site.setting');
        Route::get('/post-site-setting', [SiteSettingController::class, 'update'])->name('post.site.setting');

        Route::get('/Orders', [PagesController::class, 'order'])->name('order');
        //  Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
        Route::get('/logout', [AuthController::class, 'userlogout'])->name('logout');

    });
});



