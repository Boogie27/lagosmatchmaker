<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ClientController;
use App\Http\Controllers\ClientAjaxController;








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

// *********************************************************************************************************************************//
//                                        CLIENT ROUTE SECTION                                                                    *//
// ********************************************************************************************************************************//


Route::group(['middleware' => 'remember_me'], function(){
    // ************ HOME SECTION ***************//
    Route::get("/", [ClientController::class, "index"]);
    Route::get("/search", [ClientController::class, "index_search"]);


    // ************ LOGIN SECTION ***************//
    Route::get("/login", [ClientController::class, "login_index"]);
    Route::post("/login", [ClientController::class, "login_store"]);


    // ************ FORGOT PASSWORD SECTION ***************//
    Route::get("/forgot-password", [ClientController::class, "forgot_password_index"]);
    Route::get("/new-password", [ClientController::class, "new_password_index"]);

    // ************ REGISTER SECTION ***************//
    Route::get("/register", [ClientController::class, "register_index"]);
    Route::post("/register", [ClientController::class, "register_store"]);


    // ************ PROFILE SECTION ***************//
    Route::get("/profile", [ClientController::class, "profile_index"]);
    Route::get("/profile/{id}", [ClientController::class, "profile_detail"]);
    Route::post("/edit-detail-info", [ClientAjaxController::class, "edit_detail_info_ajax"]);
    Route::post("/ajax-get-detail-info", [ClientAjaxController::class, "ajax_get_detail_info"]);
    Route::post("/edit-about-me", [ClientAjaxController::class, "ajax_edit_about_me"]);
    Route::post("/ajax-get-about-me", [ClientAjaxController::class, "ajax_get_about_me"]);
    Route::post("/edit-looking-for", [ClientAjaxController::class, "ajax_edit_looking_for"]);
    Route::post("/ajax-get-looking-for", [ClientAjaxController::class, "ajax_get_looking_for"]);
    Route::post("/edit-life-style", [ClientAjaxController::class, "ajax_edit_life_style"]);
    Route::post("/ajax-get-lifestyle", [ClientAjaxController::class, "ajax_get_life_style"]);
    Route::post("/edit-physical-info", [ClientAjaxController::class, "ajax_edit_physical_info"]);
    Route::post("/ajax-get-physical-info", [ClientAjaxController::class, "ajax_get_physical_info"]);
    Route::post("/ajax-login-check", [ClientAjaxController::class, "ajax_login_check"]);





    // ************ MEMBER SECTION ***************//
    Route::get("/premium", [ClientController::class, "premium_index"]);
    Route::get("/premium/men", [ClientController::class, "premium_men"]);
    Route::get("/premium/women", [ClientController::class, "premium_women"]);



    // ********** BASIC MEMBERS SECTION ***********//
    Route::get("/basic", [ClientController::class, "basic_idex"]);
    Route::get("/basic/men", [ClientController::class, "basic_men"]);
    Route::get("/basic/women", [ClientController::class, "basic_women"]);



    // ************ MESSAGE SECTION ***************//
    Route::get("/messages", [ClientController::class, "message_index"]);
    Route::get("/chat/{user_id}", [ClientController::class, "chat_index"]);
    Route::post("/ajax-get-user-chats", [ClientAjaxController::class, "ajax_get_user_chats"]);
    Route::post("/ajax-send-user-text-chats", [ClientAjaxController::class, "ajax_send_user_text_chats"]);



    // ************ SUBCRIPTION SECTION ***************//
    Route::get("/subscription", [ClientController::class, "subscription_index"]);
    Route::post("/upload-ID-card", [ClientAjaxController::class, "ajax_upload_id_card"]);
    Route::post("/ajax-subscribe-now", [ClientAjaxController::class, "ajax_subscribe_now"]);
    Route::post("/subscription", [ClientController::class, "subscription_store"]);


    // ********** HOW IT WORKS SECTION ***************//
    Route::get("/how-it-works", [ClientController::class, "how_it_works_index"]);



    // ************ LIKE  A MEMBER SECTION **************//
    Route::post("/ajax-like-user", [ClientAjaxController::class, "ajax_like_user"]);
    Route::post("/ajax-subscribe-to-plan", [ClientAjaxController::class, "ajax_subscribe_plan"]);
    Route::post("/ajax-cancle-like-request", [ClientAjaxController::class, "ajax_cancle_like_request"]);
    Route::post("/ajax-accept-like-request", [ClientAjaxController::class, "ajax_accept_like_request"]);
    Route::post("/ajax-get-matched-detail", [ClientAjaxController::class, "ajax_get_matched_detail"]);
    Route::post("/ajax-get-users-notification-count", [ClientAjaxController::class, "ajax_get_users_notification_count"]);
    Route::post("/ajax-unlike-matched-user", [ClientAjaxController::class, "ajax_unlike_matched_user"]);
    Route::post("/ajax-get-member-links", [ClientAjaxController::class, "ajax_get_member_links"]);
    Route::post("/ajax-get-profile-links", [ClientAjaxController::class, "ajax_get_profile_links"]);



    // ************* VIDEO CALL SECTION *******************//
    Route::post("/ajax-call-user", [ClientAjaxController::class, "ajax_call_user"]);



    // ************* SUCCESS SECTION ********************//
    Route::get("/success", [ClientController::class, "success_index"]);



    // ************* FRIENDS SECTION ********************//
    Route::get("/friends", [ClientController::class, "friends_index"]);


    // ************* ERROR SECTION ********************//
    Route::get("/404", [ClientController::class, "error_index"]);




    // ************ NEWS LETTER SECTION ******************//
    Route::get("/unsubscribe-newsletter", [ClientController::class, "unsubescribe_newsletter"]);
    Route::post("/ajax-newsletter-subscription", [ClientAjaxController::class, "ajax_newsletter_subscription"]);
    Route::post("/ajax-newsletter-unsubscription", [ClientAjaxController::class, "ajax_newsletter_unsubscription"]);


    // ************ CONTACT SECTION ******************//
    Route::get("/contact", [ClientController::class, "contact_index"]);
    Route::post("/contact", [ClientController::class, "contact_store"]);


    // ************ SETTINGS SECTION ******************//
    // Route::get("/settings", [ClientController::class, "settings_index"]);
    Route::post("/update-username", [ClientController::class, "update_username_update"]);
    Route::post("/change-password", [ClientController::class, "change_password_update"]);




    // ************ REPORT SECTION ******************//
    Route::get("/report-member", [ClientController::class, "report_index"]);
    Route::post("/ajax-report-member", [ClientAjaxController::class, "ajax_report_member"]);


   
}); //end of remember_me middleware



    // ************ LOGOUT SECTION ***************//
    Route::get("/logout", [ClientController::class, "logout"]);
    Route::post("/ajax-logout", [ClientAjaxController::class, "ajax_logout"]);


















































// *********************************************************************************************************************************//
//                                        ADMIN ROUTE SECTION                                                                    *//
// ********************************************************************************************************************************//
    use App\Http\Controllers\AdminController;
    use App\Http\Controllers\AdminAjaxController;

    




    Route::group(['middleware' => 'admin_authentication'], function(){


    // ********* DASHBOARD SECTION **************//
    Route::get("/admin", [AdminController::class, "index"]);



    // ********* LOGOUT ***********//
    Route::get("/admin/logout", [AdminController::class, "logout_admin"]);



    // ********** MEMBER SECTION ***********//
    Route::get("/admin/basic", [AdminController::class, "basic_index"]);
    Route::get("/admin/premium", [AdminController::class, "premium_index"]);
    Route::get("/admin/member-detail/{id}", [AdminController::class, "member_detail_index"]);
    Route::post("/ajax-suspend-member", [AdminAjaxController::class, "ajax_suspend_member"]);
    Route::post("/ajax-approve-member", [AdminAjaxController::class, "ajax_approve_member"]);
    Route::post("/ajax-deactivate-member", [AdminAjaxController::class, "ajax_deactivate_member"]);
    
    

    // ********* ERROR SECTION ************//
    Route::get("/admin/404", [AdminController::class, "error_index"]);

    

    
    
}); //end of admin authenication middleware



    // ********* LOGIN SECTION **************//
    Route::get("/admin/login", [AdminController::class, "login_index"]);
    Route::post("/admin/login", [AdminController::class, "login_admin"]);











































