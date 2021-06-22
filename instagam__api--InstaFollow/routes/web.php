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


/**
 * V4 'Home' Tab
 */
    Route::get('/', 'settingsController@index');
    Route::get('/store_user_details', 'settingsController@storeUserDetails');


/**
 * V4  User 'Settings' Tab
 */
    Route::get('/userdetails', 'smartController@userdetails');
    Route::get('/userposts', 'smartController@userposts');
    Route::get('/save_userposts', 'smartController@save_userposts');
    Route::get('/whitelist', 'smartController@whitelist');
    Route::get('/savewhitelist', 'smartController@save_whitelist');

/**
 * V4  App 'Settings' Tab
 */
    Route::get('/retrieve_app_settings', 'settingsController@retrieveAppSettings');
    Route::get('/update_app_settings', 'settingsController@updateAppSettings');

/**
 * V4 'Comments' Tab
 */
    Route::get('/retrieve_all_comments', 'settingsController@retrieveAllComments');
    Route::get('/delete_comment', 'settingsController@deleteComment');
    Route::get('/add_comment', 'settingsController@addComment');


/**
 * V4 'Hashtags' Tab
 */
    Route::get('/retrieve_all_hashtags', 'hashtagController@retrieveAllHashtags');
    Route::get('/delete_hashtag', 'hashtagController@deleteHashtag');
    Route::get('/add_hashtag', 'hashtagController@addHashtag');
    Route::get('/processhashtagfeed', 'smartController@process_hashtag_feed');


/**
 * V3 'Manual' Tab
 */
    Route::get('/gettaggers', 'smartController@taggersfromdb');
    Route::get('/getnewtaggers', 'smartController@newtaggersfromdb');
    Route::get('/process_single_tagger', 'smartController@process_single_tagger');


/**
 * V3 'Smart' Tab
 */

    Route::get('/get_all_tagger_list', 'smartController@get_all_tagger_list');
    Route::get('/get_unfollowed_tagger_list', 'smartController@get_unfollowed_tagger_list');
    Route::get('/get_followed_not_unfollowed_tagger_list', 'smartController@get_followed_not_unfollowed_tagger_list');

    Route::get('/reset_comment_spam', 'smartController@reset_comment_spam');
    Route::get('/reset_like_spam', 'smartController@reset_like_spam');
    Route::get('/reset_follow_spam', 'smartController@reset_follow_spam');
    Route::get('/reset_unfollow_spam', 'smartController@reset_unfollow_spam');

    Route::get('/daily_processed_count', 'smartController@daily_processed_count');

/**
 * V3 'Timed' Tab
 */
    Route::get('/update_batch_date', 'smartController@updateBatchDate');
    Route::get('/get_batch_datetimes', 'smartController@retrieveBatchDatetimes');
    Route::get('/batch_process_taggers', 'smartController@batch_process_taggers');
    Route::get('/get_crontab_recon', 'crontabController@get_crontab_recon');
    Route::get('/get_crontab_process', 'crontabController@get_crontab_process');


/*
 * V4 Scheduler - Manual controls
 */
    Route::get('/batch_process_taggers', 'smartController@batch_process_taggers');
    Route::get('/daily_batch_count', 'smartController@daily_batch_count');

/**
 * V3 'Activity' Tab
 */
    Route::get('/process_latest_activity', 'activityController@process_latest_activity');
    Route::get('/get_latest_stats', 'activityController@get_latest_stats');

/**
 * 'Debug' Tab
 */
    Route::get('/debug_command', 'smartController@debug_command');

/**
 * Printr
 */
    Route::get('/unserialize_this', 'smartController@unserialize_this');
