<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ClientController;
use App\Http\Controllers\ClientAjaxController;
use App\Http\Controllers\AgoraVideoController;







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
    Route::post("/upload-ID-card-index", [ClientAjaxController::class, "upload_ID_card_index"]);
    Route::post("/ajax-check-member-detail", [ClientAjaxController::class, "ajax_check_member_detail"]);


  


    // ************ LOGIN SECTION ***************//
    Route::get("/login", [ClientController::class, "login_index"]);
    Route::post("/login", [ClientController::class, "login_store"]);




    // ************ FORGOT PASSWORD SECTION ***************//
    Route::get("/forgot-password", [ClientController::class, "forgot_password_index"]);
    Route::post("/forgot-password", [ClientController::class, "forgot_password_store"]);
    Route::get("/forgot-password-message", [ClientController::class, "forgot_password_message_index"]);
    Route::get("/new-password", [ClientController::class, "new_password_index"]);
    Route::post("/new-password", [ClientController::class, "new_password_update"]);

    


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
    Route::post("/ajax-delete-user-chat", [ClientAjaxController::class, "ajax_delete_user_chats"]);
    Route::post("/ajax-upload-chat-image", [ClientAjaxController::class, "ajax_upload_chat_image"]);
    Route::post("/ajax-mark-seen-user-chat", [ClientAjaxController::class, "ajax_mark_seen_user_chat"]);
    Route::post("/ajax-max-users-message-delete", [ClientAjaxController::class, "ajax_max_users_message_delete"]);
    Route::post("/ajax-get-infinit-user-chat", [ClientAjaxController::class, "ajax_get_infinit_user_chat"]);
    
   
    

    // ************ SUBCRIPTION SECTION ***************//
    Route::get("/subscription", [ClientController::class, "subscription_index"]);
    Route::get("/manual-payment", [ClientController::class, "manual_payment_index"]);
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



    // ********** NOTIFICATION *****************//
    Route::post("/delete-approved-notification", [ClientAjaxController::class, "delete_approved_notification"]);
    
    


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




    // ********** NOTIFICATION *******************//
    Route::post("/ajax-remove-subscription-notification", [ClientAjaxController::class, "ajax_remove_subscription_notification"]);


    

    // ********* AGORA VIDEO CALL **************//
    Route::get('/agora-chat', [AgoraVideoController::class, "index"]);
    Route::post('/agora/token', [AgoraVideoController::class, 'token']);
    Route::post('/agora/call-user', [AgoraVideoController::class,'callUser']);


}); //end of remember_me middleware



    // ************ LOGOUT SECTION ***************//
    Route::get("/logout", [ClientController::class, "logout"]);
    Route::post("/ajax-logout", [ClientAjaxController::class, "ajax_logout"]);




























































    

































// *********************************************************************************************************************************//
//                                        ADMIN ROUTE SECTION                                                                    *//
// ********************************************************************************************************************************//
    use App\Http\Controllers\AdminController;
    use App\Http\Controllers\AdminAjaxController;

    




    Route::group(['middleware' => ['admin_authentication', 'end_subscription']], function(){


    // ********* DASHBOARD SECTION **************//
    Route::get("/admin", [AdminController::class, "index"]);



    // ********** NOTIFICATION ***************//
    Route::get("/admin/notification", [AdminController::class, "notification_index"]);
    Route::post("/admin/ajax-get-notification-count", [AdminAjaxController::class, "ajax_get_notification_count"]);
    Route::post("/admin/ajax-get-navi-notification", [AdminAjaxController::class, "ajax_get_navi_notification"]);
    Route::post("/admin/ajax-delete-notification", [AdminAjaxController::class, "ajax_delete_notification"]);
    Route::post("/admin/ajax-seen-notification", [AdminAjaxController::class, "ajax_seen_notification"]);
    Route::post("/admin/ajax-clear-all-notifications", [AdminAjaxController::class, "ajax_clear_all_notification"]);
   
    
    

    // ********* LOGOUT ***********//
    Route::get("/admin/logout", [AdminController::class, "logout_admin"]);
    Route::post("/admin/ajax-logout", [AdminAjaxController::class, "ajax_logout_admin"]);
    


    // ************* ALL MEMBERS ************//
    Route::get("/admin/all-members", [AdminController::class, "all_members_index"]);
    Route::post("/admin/ajax-add-mass-user-subscription", [AdminAjaxController::class, "ajax_add_mass_user_subscription"]);

   
    


    // ********** MEMBER SECTION ***********//
    Route::get("/admin/add-member", [AdminController::class, "add_member_index"]);
    Route::post("/admin/add-member", [AdminController::class, "add_member_store"]);
    Route::get("/admin/basic", [AdminController::class, "basic_index"]);
    Route::get("/admin/premium", [AdminController::class, "premium_index"]);
    Route::get("/admin/suspended", [AdminController::class, "suspended_index"]);
    Route::post("/admin/ajax-mass-unsuspend-members", [AdminAjaxController::class, "ajax_mass_unsuspend_members"]);
    Route::get("/admin/ended-subscriptions", [AdminController::class, "ended_subscriptions_index"]);
    Route::get("/admin/friends/{id}", [AdminController::class, "friends_index"]);
    Route::get("/admin/read-chats", [AdminController::class, "read_chats_index"]);
    Route::post("/admin/ajax-delete-user-chat", [AdminAjaxController::class, "ajax_delete_user_chat"]);
    Route::post("/admin/ajax-get-infinit-user-chat", [AdminAjaxController::class, "ajax_get_infinit_user_chat"]);
   
    
    
    Route::get("/admin/deactivated", [AdminController::class, "deactivated_index"]);
    Route::get("/admin/unapproved", [AdminController::class, "unapproved_index"]);
    Route::get("/admin/unapproved/completed", [AdminController::class, "unapproved_completed_index"]);
    Route::get("/admin/member-detail/{id}", [AdminController::class, "member_detail_index"]);
    Route::post("/ajax-suspend-member", [AdminAjaxController::class, "ajax_suspend_member"]);
    Route::post("/ajax-approve-member", [AdminAjaxController::class, "ajax_approve_member"]);
    Route::post("/admin/ajax-mass-approve-members", [AdminAjaxController::class, "ajax_mass_approve_members"]);
    Route::post("/admin/ajax-mass-unapprove-members", [AdminAjaxController::class, "ajax_mass_unapprove_members"]);

    
    
    Route::post("/ajax-deactivate-member", [AdminAjaxController::class, "ajax_deactivate_member"]);
    Route::post("/admin/edit-detail-info", [AdminAjaxController::class, "edit_detail_info_ajax"]);
    Route::post("/admin/ajax-get-detail-info", [AdminAjaxController::class, "ajax_get_detail_info"]);
    Route::post("/admin/edit-about-me", [AdminAjaxController::class, "ajax_edit_about_me"]);
    Route::post("/admin/edit-looking-for", [AdminAjaxController::class, "ajax_edit_looking_for"]);
    Route::post("/admin/edit-life-style", [AdminAjaxController::class, "ajax_edit_life_style"]);
    Route::post("/admin/ajax-get-lifestyle", [AdminAjaxController::class, "ajax_get_life_style"]);
    Route::post("/admin/edit-physical-info", [AdminAjaxController::class, "ajax_edit_physical_info"]);
    Route::post("/admin/ajax-get-physical-info", [AdminAjaxController::class, "ajax_get_physical_info"]);
    Route::post("/admin/ajax-delete-id-card", [AdminAjaxController::class, "ajax_delete_id_card"]);
    Route::post("/admin/upload-id-card-edit", [AdminAjaxController::class, "ajax_upload_id_card_edit"]);
    Route::post("/admin/ajax-send-members-newsletter", [AdminAjaxController::class, "ajax_send_members_newsletter"]);
    
    Route::post("/admin/ajax-update-christain", [AdminAjaxController::class, "ajax_update_christain"]);
    
    
    


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
    Route::post("/admin/ajax-delete-height", [AdminAjaxController::class, "ajax_delete_height"]);
    Route::post("/admin/ajax-add-height", [AdminAjaxController::class, "ajax_add_height"]);
    Route::post("/admin/ajax-feature-height", [AdminAjaxController::class, "ajax_feature_height"]);



    
    // *********** WEIGHT SECTION *************//
    Route::get("/admin/weights", [AdminController::class, "weights_index"]);
    Route::post("/admin/ajax-edit-weight", [AdminAjaxController::class, "ajax_edit_weight"]);
    Route::post("/admin/ajax-delete-weight", [AdminAjaxController::class, "ajax_delete_weight"]);
    Route::post("/admin/ajax-add-weight", [AdminAjaxController::class, "ajax_add_weight"]);
    Route::post("/admin/ajax-feature-weight", [AdminAjaxController::class, "ajax_feature_weight"]);



    // *********** WEIGHT SECTION *************//
    Route::get("/admin/states", [AdminController::class, "states_index"]);
    Route::post("/admin/ajax-edit-state", [AdminAjaxController::class, "ajax_edit_state"]);
    Route::post("/admin/ajax-delete-state", [AdminAjaxController::class, "ajax_delete_state"]);
    Route::post("/admin/ajax-add-state", [AdminAjaxController::class, "ajax_add_state"]);
    Route::post("/admin/ajax-feature-state", [AdminAjaxController::class, "ajax_feature_state"]);




    // *********** SUBSCRIPTION SECTION *************//
    Route::get("/admin/subscription", [AdminController::class, "subscription_index"]);
    Route::get("/admin/edit-subscription/{id}", [AdminController::class, "edit_subscription_index"]);
    Route::post("/admin/edit-subscription/{id}", [AdminController::class, "edit_subscription_update"]);
    Route::post("/admin/ajax-feature-subscription", [AdminAjaxController::class, "ajax_feature_subscription"]);
    Route::get("/admin/user-subscription", [AdminController::class, "user_subscription_index"]);
    Route::get("/admin/subscription-history/{id}", [AdminController::class, "subscription_history_index"]);
    Route::post("/admin/ajax-end-subscription", [AdminAjaxController::class, "ajax_end_subscription"]);
    Route::get("/admin/manual-subscription", [AdminController::class, "manual_subscription_index"]);
    Route::post("/admin/manual-subscription", [AdminController::class, "manual_subscription_store"]);
    Route::post("/admin/ajax-edit-subscription-description", [AdminAjaxController::class, "ajax_edit_subscription_description"]);
    Route::post("/admin/ajax-delete-subscription-description", [AdminAjaxController::class, "ajax_delete_subscription_description"]);
    Route::post("/admin/ajax-delete-subscription-bank-icon", [AdminAjaxController::class, "ajax_delete_subscription_bank_icon"]);
    Route::post("/admin/ajax-add-subscription-bank-icon", [AdminAjaxController::class, "ajax_add_subscription_bank_icon"]);
    Route::post("/admin/ajax-add-user-subscription", [AdminAjaxController::class, "ajax_add_user_subscription"]);
    Route::post("/admin/personalized-matching", [AdminController::class, "personalized_matching_update"]);
    Route::post("/admin/ajax-delete-subscription", [AdminAjaxController::class, "ajax_delete_user_subscription"]);
    
    


    // *********** CONTACT SECTION *************//
    Route::get("/admin/contact", [AdminController::class, "contact_index"]);
    Route::get("/admin/contact-detail/{id}", [AdminController::class, "contact_detail_index"]);
    Route::post("/admin/ajax-contact-us-seen", [AdminAjaxController::class, "ajax_contact_us_seen"]);
    Route::post("/admin/ajax-mass-contact-us-seen", [AdminAjaxController::class, "ajax_mass_contact_us_seen"]);
    Route::post("/admin/ajax-contact-us-delete", [AdminAjaxController::class, "ajax_contact_us_delete"]);
    Route::post("/admin/ajax-mass-contact-us-delete", [AdminAjaxController::class, "ajax_mass_contact_us_delete"]);
    
    


    
    // *********** REPORT SECTION *************//
    Route::get("/admin/reports", [AdminController::class, "report_index"]);
    Route::get("/admin/report-detail/{id}", [AdminController::class, "report_detail_index"]);
    Route::post("/admin/ajax-report-seen", [AdminAjaxController::class, "ajax_report_seen"]);
    Route::post("/admin/ajax-mass-report-seen", [AdminAjaxController::class, "ajax_mass_report_seen"]);
    Route::post("/admin/ajax-report-delete", [AdminAjaxController::class, "ajax_report_delete"]);
    Route::post("/admin/ajax-mass-reports-delete", [AdminAjaxController::class, "ajax_mass_report_delete"]);
      
    


    // *********** ACCOUNT SECTION *************//
    Route::get("/admin/profile", [AdminController::class, "profile_index"]);
    Route::post("/admin/profile", [AdminController::class, "profile_update"]);
    Route::get("/admin/change-password", [AdminController::class, "change_password_index"]);
    Route::post("/admin/change-password", [AdminController::class, "change_password_update"]);
    Route::post("/admin/ajax-profile-upload-image", [AdminAjaxController::class, "ajax_profile_upload_image"]);

    


    // ********** LEGAL SECTION ***************//
    Route::get("/admin/privacy-policy", [AdminController::class, "privacy_policy_index"]);
    Route::post("/admin/privacy-policy", [AdminController::class, "privacy_policy_update"]);
    Route::get("/admin/terms", [AdminController::class, "terms_index"]);
    Route::post("/admin/terms", [AdminController::class, "terms_update"]);
    Route::get("/admin/about-us", [AdminController::class, "about_us_index"]);
    Route::post("/admin/about-us", [AdminController::class, "about_us_update"]);



    // ********** SETTINGS SECTION **************//
    Route::get("/admin/settings", [AdminController::class, "settings_index"]);
    Route::post("/admin/home-page", [AdminController::class, "home_page_update"]);
    Route::post("/admin/footer-left", [AdminController::class, "footer_left_update"]);
    Route::post("/admin/footer-middle", [AdminController::class, "tooter_middle_update"]);
    Route::post("/admin/app-contact", [AdminController::class, "app_contact_update"]);
    Route::post("/admin/site-detail", [AdminController::class, "side_detail_update"]);
    Route::get("/admin/email-settings", [AdminController::class, "email_settings_index"]);
    Route::post("/admin/email-settings", [AdminController::class, "email_settings_update"]);
    Route::get("/admin/payment-settings", [AdminController::class, "payment_settings_index"]);
    Route::post("/admin/payment-settings", [AdminController::class, "payment_settings_update"]);
    Route::post("/admin/profile-alert-message", [AdminController::class, "profile_alert_message_update"]);
    Route::post("/admin/social-media", [AdminController::class, "social_media_update"]);
    
   




    // ********** SLIDER SECTION ***************//
    Route::get("/admin/banner-settings", [AdminController::class, "banner_settings_index"]);
    Route::post("/admin/ajax-add-slider", [AdminAjaxController::class, "ajax_add_slider"]);
    Route::post("/admin/ajax-get-slider", [AdminAjaxController::class, "ajax_get_slider"]);
    Route::post("/admin/ajax-delete-slider", [AdminAjaxController::class, "ajax_delete_slider"]);
    Route::post("/admin/ajax-update-slider", [AdminAjaxController::class, "ajax_update_slider"]);
    Route::post("/admin/ajax-feature-slider", [AdminAjaxController::class, "ajax_feature_slider"]);
    
    
    
    


    // ********** NEWSLETTER SECTION ***************//
    Route::get("/admin/newsletter-subscriptions", [AdminController::class, "news_letter_subscriptions_index"]);
    Route::post("/admin/ajax-delete-newsletter-subscription", [AdminAjaxController::class, "ajax_delete_newsletter_subscription"]);
    Route::post("/admin/ajax-all-newsletter-id", [AdminAjaxController::class, "ajax_all_newsletter_id"]);
    Route::post("/admin/ajax-check-newsletter-email-single", [AdminAjaxController::class, "ajax_single_newsletter_email_id"]);
    Route::post("/admin/ajax-check-newsletter-mass-delete", [AdminAjaxController::class, "ajax_check_newsletter_mass_delete"]);
    Route::get("/admin/newsletter-preview/{id}", [AdminController::class, "newsletter_preview_index"]);
    
    
    Route::get("/admin/news-letter", [AdminController::class, "news_letter_index"]);
    Route::get("/admin/sent-newsletters", [AdminController::class, "sent_letter_index"]);
    Route::get("/admin/saved-newsletters", [AdminController::class, "saved_letter_index"]);
    Route::post("/admin/ajax-save-newsletter", [AdminAjaxController::class, "ajax_save_newsletter"]);

    
    Route::post("/admin/ajax-delete-news-letter", [AdminAjaxController::class, "ajax_delete_news_letter"]);
    Route::post("/admin/ajax-newsletter-mass-delete", [AdminAjaxController::class, "ajax_delete_mass_news_letter"]);
    Route::get("/admin/edit-newsletter/{id}", [AdminController::class, "edit_newsletter_index"]);
    Route::post("/admin/edit-newsletter/{id}", [AdminController::class, "edit_newsletter_update"]);
    Route::get("/admin/compose-newsletter", [AdminController::class, "compose_newsletter"]);
    Route::post("/admin/compose-newsletter", [AdminController::class, "compose_newsletter_store"]);
    Route::post("/admin/ajax-send-newsletter", [AdminAjaxController::class, "ajax_send_news_letter"]);
    // Route::post("/admin/ajax-send-users-newsletter", [AdminAjaxController::class, "ajax_send_users_newsletter"]);
    
    

    // ************HOW IT WORKS ***********//
    Route::get("/admin/how-it-works", [AdminController::class, "how_it_works_index"]);
    Route::post("/admin/ajax-add-how-it-works", [AdminAjaxController::class, "ajax_add_how_it_works"]);
    Route::post("/admin/ajax-get-how-it-works", [AdminAjaxController::class, "ajax_get_how_it_works"]);
    Route::post("admin/ajax-delete-how-it-works", [AdminAjaxController::class, "ajax_delete_how_it_works"]);
    Route::post("/admin/ajax-update-how-it-works", [AdminAjaxController::class, "ajax_update_how_it_works"]);
    Route::post("/admin/ajax-feature-how-it-works", [AdminAjaxController::class, "ajax_feature_how_it_works"]);
    

    
}); //end of admin authenication middleware



    // ********* LOGIN SECTION **************//
    Route::get("/admin/login", [AdminController::class, "login_index"]);
    Route::post("/admin/login", [AdminController::class, "login_admin"]);











































