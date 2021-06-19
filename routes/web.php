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
    Route::get("/settings", [ClientController::class, "settings_index"]);
    Route::post("/update-username", [ClientController::class, "update_username_update"]);
    Route::post("/change-password", [ClientController::class, "change_password_update"]);




    // ************ REPORT SECTION ******************//
    Route::get("/report-member", [ClientController::class, "report_index"]);
    Route::post("/ajax-report-member", [ClientAjaxController::class, "ajax_report_member"]);



   // ************ LEGAL SECTION ******************//
    Route::get("/about-us", [ClientController::class, "about_us_index"]);
    Route::get("/terms", [ClientController::class, "terms_index"]);
    Route::get("/privacy-policy", [ClientController::class, "privacy_policy_index"]);









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
    Route::get("/admin/add-member", [AdminController::class, "add_member_index"]);
    Route::post("/admin/add-member", [AdminController::class, "add_member_store"]);
    Route::get("/admin/basic", [AdminController::class, "basic_index"]);
    Route::get("/admin/premium", [AdminController::class, "premium_index"]);
    Route::get("/admin/deactivated", [AdminController::class, "deactivated_index"]);
    Route::get("/admin/unapproved", [AdminController::class, "unapproved_index"]);
    Route::get("/admin/member-detail/{id}", [AdminController::class, "member_detail_index"]);
    Route::post("/ajax-suspend-member", [AdminAjaxController::class, "ajax_suspend_member"]);
    Route::post("/ajax-approve-member", [AdminAjaxController::class, "ajax_approve_member"]);
    Route::post("/ajax-deactivate-member", [AdminAjaxController::class, "ajax_deactivate_member"]);
    Route::post("/admin/edit-detail-info", [AdminAjaxController::class, "edit_detail_info_ajax"]);
    Route::post("/admin/ajax-get-detail-info", [AdminAjaxController::class, "ajax_get_detail_info"]);
    Route::post("/admin/edit-about-me", [AdminAjaxController::class, "ajax_edit_about_me"]);
    Route::post("/admin/edit-looking-for", [AdminAjaxController::class, "ajax_edit_looking_for"]);
    Route::post("/admin/edit-life-style", [AdminAjaxController::class, "ajax_edit_life_style"]);
    Route::post("/admin/ajax-get-lifestyle", [AdminAjaxController::class, "ajax_get_life_style"]);
    Route::post("/admin/edit-physical-info", [AdminAjaxController::class, "ajax_edit_physical_info"]);
    Route::post("/admin/ajax-get-physical-info", [AdminAjaxController::class, "ajax_get_physical_info"]);
    



    // ********* ERROR SECTION ************//
    Route::get("/admin/404", [AdminController::class, "error_index"]);





    // *********** GENOTYPE SECTION ***********//
    Route::get("/admin/genotype", [AdminController::class, "genotype_index"]);
    Route::post("/admin/ajax-edit-genotype", [AdminAjaxController::class, "ajax_edit_genotype"]);
    Route::post("/admin/ajax-delete-genotype", [AdminAjaxController::class, "ajax_delete_genotype"]);
    Route::post("/admin/ajax-add-genotype", [AdminAjaxController::class, "ajax_add_genotype"]);
    Route::post("/admin/ajax-feature-genotype", [AdminAjaxController::class, "ajax_feature_genotype"]);
   
    
    

    // *********** MARITAL STATUS SECTION *************//
    Route::get("/admin/marital-status", [AdminController::class, "marital_status_index"]);
    Route::post("/admin/ajax-edit-marital-status", [AdminAjaxController::class, "ajax_edit_marital_status"]);
    Route::post("/admin/ajax-feature-marital-status", [AdminAjaxController::class, "ajax_feature_marital_status"]);
    Route::post("/admin/ajax-add-marital-status", [AdminAjaxController::class, "ajax_add_martital_status"]);
    Route::post("/admin/ajax-delete-marital-status", [AdminAjaxController::class, "ajax_delete_marital_status"]);


    
    // *********** DRINKING SECTION *************//
    Route::get("/admin/drinking", [AdminController::class, "drinking_index"]);
    Route::post("/admin/ajax-edit-drinking", [AdminAjaxController::class, "ajax_edit_drinking"]);
    Route::post("/admin/ajax-delete-drinking", [AdminAjaxController::class, "ajax_delete_drinking"]);
    Route::post("/admin/ajax-add-drinking", [AdminAjaxController::class, "ajax_add_drinking"]);
    Route::post("/admin/ajax-feature-drinking", [AdminAjaxController::class, "ajax_feature_drinking"]);

    
    

    
    // *********** SMOKING SECTION *************//
    Route::get("/admin/smoking", [AdminController::class, "smoking_index"]);
    Route::post("/admin/ajax-edit-smoking", [AdminAjaxController::class, "ajax_edit_smoking"]);
    Route::post("/admin/ajax-delete-smoking", [AdminAjaxController::class, "ajax_delete_smoking"]);
    Route::post("/admin/ajax-add-smoking", [AdminAjaxController::class, "ajax_add_smoking"]);
    Route::post("/admin/ajax-feature-smoking", [AdminAjaxController::class, "ajax_feature_smoking"]);


    
    


    // *********** BODY TYPE SECTION *************//
    Route::get("/admin/body-types", [AdminController::class, "body_type_index"]);
    Route::post("/admin/ajax-edit-body-type", [AdminAjaxController::class, "ajax_edit_body_type"]);
    Route::post("/admin/ajax-delete-body-type", [AdminAjaxController::class, "ajax_delete_body_type"]);
    Route::post("/admin/ajax-add-body-type", [AdminAjaxController::class, "ajax_add_body_type"]);
    Route::post("/admin/ajax-feature-body-type", [AdminAjaxController::class, "ajax_feature_body_type"]);


    


    // *********** HEIGHT SECTION *************//
    Route::get("/admin/heights", [AdminController::class, "height_index"]);
    Route::post("/admin/ajax-edit-height", [AdminAjaxController::class, "ajax_edit_height"]);
    Route::post("/admin/ajax-delete-height", [AdminAjaxController::class, "ajax_delete_delete"]);
    Route::post("/admin/ajax-add-height", [AdminAjaxController::class, "ajax_add_height"]);
    Route::post("/admin/ajax-feature-height", [AdminAjaxController::class, "ajax_feature_height"]);



    
    // *********** HEIGHT SECTION *************//
    Route::get("/admin/weights", [AdminController::class, "weights_index"]);
    Route::post("/admin/ajax-edit-weight", [AdminAjaxController::class, "ajax_edit_weight"]);
    Route::post("/admin/ajax-delete-weight", [AdminAjaxController::class, "ajax_delete_weight"]);
    Route::post("/admin/ajax-add-weight", [AdminAjaxController::class, "ajax_add_weight"]);
    Route::post("/admin/ajax-feature-weight", [AdminAjaxController::class, "ajax_feature_weight"]);



    // *********** SUBSCRIPTION SECTION *************//
    Route::get("/admin/subscription", [AdminController::class, "subscription_index"]);
    Route::get("/admin/edit-subscription/{id}", [AdminController::class, "edit_subscription_index"]);
    Route::post("/admin/edit-subscription/{id}", [AdminController::class, "edit_subscription_update"]);
    Route::post("/admin/ajax-feature-subscription", [AdminAjaxController::class, "ajax_feature_subscription"]);
    Route::get("/admin/user-subscription", [AdminController::class, "user_subscription_index"]);
    Route::get("/admin/subscription-history/{id}", [AdminController::class, "subscription_history_index"]);
    Route::post("/admin/ajax-end-subscription", [AdminAjaxController::class, "ajax_end_subscription"]);



    // *********** SUBSCRIPTION SECTION *************//
    Route::get("/admin/contact", [AdminController::class, "contact_index"]);
    Route::get("/admin/contact-detail/{id}", [AdminController::class, "contact_detail_index"]);
    Route::post("/admin/ajax-contact-us-seen", [AdminAjaxController::class, "ajax_contact_us_seen"]);
    Route::post("/admin/ajax-contact-us-delete", [AdminAjaxController::class, "ajax_contact_us_delete"]);



    
    // *********** REPORT SECTION *************//
    Route::get("/admin/reports", [AdminController::class, "report_index"]);
    Route::get("/admin/report-detail/{id}", [AdminController::class, "report_detail_index"]);
    Route::post("/admin/ajax-report-seen", [AdminAjaxController::class, "ajax_report_seen"]);
    Route::post("/admin/ajax-report-delete", [AdminAjaxController::class, "ajax_report_delete"]);
      
    


    // *********** ACCOUNT SECTION *************//
    Route::get("/admin/profile", [AdminController::class, "profile_index"]);
    Route::post("/admin/profile", [AdminController::class, "profile_update"]);
    Route::get("/admin/change-password", [AdminController::class, "change_password_index"]);
    Route::post("/admin/change-password", [AdminController::class, "change_password_update"]);

    


    // ********** LEGAL SECTION ***************//
    Route::get("/admin/privacy-policy", [AdminController::class, "privacy_policy_index"]);
    Route::post("/admin/privacy-policy", [AdminController::class, "privacy_policy_update"]);
    Route::get("/admin/terms", [AdminController::class, "terms_index"]);
    Route::post("/admin/terms", [AdminController::class, "terms_update"]);
    Route::get("/admin/about-us", [AdminController::class, "about_us_index"]);
    Route::post("/admin/about-us", [AdminController::class, "about_us_update"]);



    // ********** SETTINGS SECTION ***************//
    Route::get("/admin/settings", [AdminController::class, "settings_index"]);
    Route::post("/admin/home-page", [AdminController::class, "home_page_update"]);
    Route::post("/admin/footer-left", [AdminController::class, "footer_left_update"]);
    Route::post("/admin/footer-middle", [AdminController::class, "tooter_middle_update"]);
    Route::post("/admin/app-contact", [AdminController::class, "app_contact_update"]);
    Route::post("/admin/site-detail", [AdminController::class, "side_detail_update"]);

    
    
    









    
}); //end of admin authenication middleware



    // ********* LOGIN SECTION **************//
    Route::get("/admin/login", [AdminController::class, "login_index"]);
    Route::post("/admin/login", [AdminController::class, "login_admin"]);











































