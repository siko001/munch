<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\DealController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ForgotPasswordController;


//website routes General
Route::get("/", [IndexController::class, "render"])->middleware("verifiedC");
Route::get("/menu", [ProductController::class, "showAllMenu"])->middleware("verifiedC");
Route::view("/about", "about")->middleware("verifiedC");
Route::view("/restaurant", "restaurant")->middleware('staff.auth');
Route::post("/reserve-table", [ReservationController::class, "registerReservation"]);
Route::view("/book-table", "booking")->middleware("verifiedC");

//comment Routes
Route::get("/rate-order/{id}", [CommentController::class, "render"]);
Route::post("/submit-comment/{id}", [CommentController::class, "submitComment"]);


//Deal Routes
Route::get("/deals", [DealController::class, "render"]);
Route::get("/deal/{d}", [DealController::class, "applyDeal"]);
Route::post("/apply-discount", [DealController::class, "applyDealManually"]);


//Order Routes
Route::get("/orders/past", [OrderController::class, "getAllPastOrders"])->middleware('staff.auth');
Route::get("/orders/active", [OrderController::class, "showAllOrders"]);
Route::match(["GET", "PUT"], "/user/cancel-order/{id}", [OrderController::class, "cancelOrder"]);
Route::match(["GET", "PUT"], "/staff/cancel-order/{id}", [OrderController::class, "cancelOrder"]);
Route::match(["GET", "PUT"], "/staff/order-ready/{id}", [OrderController::class, "orderReady"]);
Route::match(["GET", "PUT"], "/staff/delivery/{id}", [OrderController::class, "orderDelivering"]);
Route::match(["GET", "PUT"], "/staff/process-order/{id}", [OrderController::class, "orderFinished"]);
Route::match(["GET", "PUT"], "/staff/process-order-cancelled/{id}", [OrderController::class, "orderFinishedButCancelled"]);

Route::get("/orders-active/{id}", [OrderController::class, "showUserOrder"])->middleware("verifiedC");
Route::get("/order-details/{id}", [OrderController::class, "showUserOrders"])->middleware("verifiedC");
Route::post("/proccess-payment-guest", [OrderController::class, "createOrderAsGuest"]);


//product Routes
Route::view("/add-product", "add-product")->middleware('staff.auth');;
Route::post("/add-new-product", [ProductController::class, "addNewProduct"])->middleware('staff.auth');;
Route::get("/edit-menu/{id}", [ProductController::class, "showSingleProduct"]);
Route::put('/out-of-stock/{id}', [ProductController::class, "outOfStock"])->middleware("staff.auth");
Route::put('/back-in-stock/{id}', [ProductController::class, "backInStock"]);
Route::match(['GET', 'DELETE'], '/delete-product/{id}', [ProductController::class, "deleteProduct"])->middleware('staff.auth');;
Route::put("/update-product/{id}", [ProductController::class, "updateProduct"]);

//menu as JSON DATA and api returned as proper menu
Route::get('/menu/api', [ProductController::class, 'getMenu']);
Route::view("/menu1", "/menu1")->middleware("verifiedC");


//Profile Routes 
Route::view("/profile", "profile")->middleware("verifiedC");
Route::view("/profile/settings", "profile-settings")->middleware("verifiedC");
Route::get("/profile/active-orders/{id}", [OrderController::class, "getUserActiveOrder"])->middleware("verifiedC");
Route::get("/profile/past-orders/{id}", [OrderCOntroller::class, "getAllPastOrdersForUser"])->middleware("verifiedC");
Route::get("/profile/reservations", [ReservationController::class, "getEverything"])->middleware("verifiedC");
Route::view("/staff-profile/settings", "profile-settings-staff")->middleware('staff.auth');
Route::match(["GET", "PUT"], "/profile/activate/{id}", [UserController::class, "activateAccountAsUser"])->middleware("verifiedC");
Route::match(["GET", "PUT"], "/profile/disable/{id}", [UserController::class, "deactivateAccountAsUser"])->middleware("verifiedC");
//ForgotPassword Routes
Route::get('/forgot-password', [ForgotPasswordController::class, 'showForgetPasswordForm']);
Route::post('/forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm']);
Route::get('/reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm']);
Route::post('/reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm']);
//profile Picture
Route::get("/change-profile-picture/{id}", [UserController::class, "changeProfilePicture"]);
Route::put("/change-picture/{id}", [UserController::class, "changethePicture"]);


//update profiles as the manager
//user
Route::get("/update/user/{id}", [UserController::class, "getUserToEdit"])->middleware('staff.auth');
Route::match(["GET", "PUT"], "/update/useracc/{id}", [UserController::class, "updateProfile"])->middleware('staff.auth');
Route::match(["GET", "PUT"], "/deactivate/user/{id}", [UserController::class, "deactivateAccount"])->middleware('staff.auth');
Route::match(["GET", "PUT"], "/activate/user/{id}", [UserController::class, "activateAccount"])->middleware('staff.auth');
Route::get("/delete/user/{id}", [UserController::class, "getUserToDelete"])->middleware('staff.auth');
Route::delete("/delete/useracc/{id}", [UserController::class, "deleteProfile"])->middleware('staff.auth');
//staff 
Route::get("/update/staff/{id}", [StaffController::class, "getStaffToEdit"])->middleware('staff.auth');
Route::match(["GET", "PUT"], "/update/staffacc/{id}", [StaffController::class, "updateProfile"])->middleware('staff.auth');
Route::match(["GET", "PUT"], "/deactivate/staff/{id}", [StaffController::class, "deactivateAccount"])->middleware('staff.auth');
Route::match(["GET", "PUT"], "/activate/staff/{id}", [StaffController::class, "activateAccount"])->middleware('staff.auth');
Route::get("/delete/staff/{id}", [StaffController::class, "getStaffToDelete"])->middleware('staff.auth');
Route::delete("/delete/staffacc/{id}", [StaffController::class, "deleteProfile"])->middleware('staff.auth');

//Cart Routes
Route::get("/cart", [CartController::class, "cart"])->middleware("verifiedC");
Route::get("/add-to-cart/{id}", [CartController::class, "addToCart"])->middleware("verifiedC");
Route::get("/increment-product/{rowId}", [CartController::class, "incrementCart"])->middleware("verifiedC");
Route::get("/decrement-product/{rowId}", [CartController::class, "decrementCart"])->middleware("verifiedC");
Route::get("/remove-product/{id}", [CartController::class, "remove"])->middleware("verifiedC");
Route::get("/empty-cart", [CartCOntroller::class, "emptyCart"])->middleware("verifiedC");

//Payment Routes
Route::post("/proceed-to-payment", [PaymentController::class, "proceedToPayment"])->middleware("verifiedC");

//Password Routes
Route::view("/profile/change-password", "change-password")->middleware("verifiedC");
Route::put("/profile/change-password/{id}", [UserController::class, "updatePassword"])->middleware("verifiedC");
Route::put("/profile/change-password-staff/{id}", [StaffController::class, "updatePassword"])->middleware("verifiedC");
Route::view("/forgot-password", "forgot-password")->middleware("verifiedC");
//profile settings CRUD
Route::put('/update-profile/{id}', [UserController::class, 'updateProfile'])->middleware("verifiedC");
Route::put("/update-profile/staff/{id}", [StaffController::class, "updateProfile"]);


//login/registing Routes
//--staff
//login
Route::view("/login-staff", "login-staff");
Route::post("/login-staffmember", [StaffController::class, "login"]);
//reg
Route::view("/register-staff", 'register-staff');
Route::post("/register-staffmember", [StaffController::class, "register"]);
//ajax call for staff email
Route::post('/registeremailstaff', [StaffController::class, "checkEmailAvailability"]);
Route::match(['GET', 'POST'], '/logout', [UserController::class, 'logout']);

//user
Route::get("/login", [UserController::class, "getloginPage"])->name("login")->middleware("verifiedC");
Route::post("/login-user", [UserController::class, "login"])->middleware("verifiedC");
Route::view("/register", 'register');
Route::post("/register-user", [UserController::class, "register"]);
//ajax call for user email
Route::post('/registeremailuser', [UserController::class, "checkEmailAvailability"]);
Route::match(['GET', 'POST'], '/logout-staff', [StaffController::class, 'logout']);
//end login Routes
//----------------------------
//Restaurant Routes
//staff----------------------------------------------------------------------
Route::get("/restaurant/staff/active", [StaffController::class, 'getAllActiveStaff'])->middleware('staff.auth');
Route::get("/restaurant/staff/inactive", [StaffController::class, 'getAllInactiveStaff'])->middleware('staff.auth');
//ajax call for the profile card-----------------
Route::get('/staff/{id}', [StaffController::class, "show"])->name('staff.show')->middleware('staff.auth');
//Reservations-----------------------------------------------------------------------------------------
Route::get("/restaurant/bookings/upcoming", [ReservationController::class, "getAllActiveReservations"])->middleware('staff.auth');
Route::get("/restaurant/bookings/past", [ReservationController::class, "getAllInactiveReservations"])->middleware('staff.auth');

Route::match(["GET", "PUT"], "confirm/reservation/{id}", [ReservationController::class, "confirmReservation"]);
Route::match(["GET", "PUT"], "cancel/reservation/{id}", [ReservationController::class, "cancelReservation"]);
Route::match(["GET", "PUT"], "complete/reservation/{id}", [ReservationController::class, "completeReservation"]);
Route::match(["GET", "PUT"], "no-show/reservation/{id}", [ReservationController::class, "noShowReservation"]);


Route::match(["GET", "PUT"], "cancel/reservation/user/{id}", [ReservationController::class, "cancelReservationAsUser"]);
//ajax call for booking card---------------------
Route::get("/bookings/{id}", [ReservationController::class, "show"])->name("reservation.show");
//users----------------------------------------------------------------------------------------------
Route::get("/restaurant/users/active", [UserController::class, "getAllActiveUsers"]);
Route::get("/restaurant/users/inactive", [UserController::class, "getAllInactiveUsers"]);
//ajax call for the profile card----------------------
Route::get('/users/{id}', [UserController::class, "show"])->name('user.show');
Route::get("/bookingsUser/{id}", [ReservationController::class, "show"])->name("reservation.show");
//-----------------------------

//email verification routes
Route::get('/email/verify', function () {
    return view('verification.notice');
})->middleware('auth')->name('verification.notice');

Route::get("/verify/email/{code}", [UserController::class, "verifyEmail"]);
Route::get("/resend-verification-link/{id}", [UserController::class, "resendCode"]);
