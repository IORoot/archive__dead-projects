<template>
    <div>

        <h1 class="title">Automated Bulk Processing</h1>
        <h2 class="subtitle">This will iterate through the list of unprocessed users.</h2>

        <div class="box">

            <div class="columns">
                <div class="column is-one-third">
                    <h4 class="title">Retrieve List</h4>
                    <div class="field">
                        <div class="control">
                            <button class="button is-info" v-on:click="get_unfollowed_tagger_list"><span class="icon is-small"><i class="fa fa-database" aria-hidden="true"></i></span><span>Get Unprocessed Users</span></button>
                        </div>
                    </div>
                </div>
                <div class="column  is-one-third">
                    <h4 class="title">Database Stats</h4>
                    <div class="field">
                        <ul>
                            <li>Total in DB ({{ total_in_database }})</li>
                            <li>Unprocessed ({{ total_unprocessed }})</li>
                            <li>Pause between API calls : {{ process_rate_sec }}sec</li>
                            <li>Daily Maximum : {{ max_daily_process }}</input></li>
                            <li>Processed in last 24hrs ({{ daily_processed }})</li>
                            <li>Current Batch Count : {{ batch_processed }}</li>
                        </ul>
                    </div>
                </div>
                <div class="column  is-one-third">
                    <h4 class="title">Spam Counters</h4>
                    <div class="field">
                        <button class="button is-primary is-small" v-on:click="reset_comment_spam"><span class="icon"><i class="fa fa-comment" aria-hidden="true"></i></span><span>{{ commentSpam }} / {{ max_seq_comments }}</span></button>
                        <button class="button is-primary is-small" v-on:click="reset_like_spam"><span class="icon"><i class="fa fa-heart" aria-hidden="true"></i></span><span>{{ likeSpam }} / {{ max_seq_likes }}</span></button>
                        <button class="button is-primary is-small" v-on:click="reset_follow_spam"><span class="icon"><i class="fa fa-plus-circle" aria-hidden="true"></i></span><span>{{ followSpam }} / {{ max_seq_follows }}</span></button>
                        <button class="button is-primary is-small" v-on:click="reset_unfollow_spam"><span class="icon"><i class="fa fa-minus-circle" aria-hidden="true"></i></span><span>{{ unfollowSpam }} / {{ max_seq_unfollows }}</span></button>
                    </div>
                </div>
            </div>


        </div>

        <div class="box">

            <h1 class="title">Process List</h1>

            <div class="columns">
                <div class="column is-one-third">
                    <div class="field">
                        <p>ID being processed next:</p>
                    </div>
                    <div class="field">
                        <input type="text" v-model="current_tagger_id"/>
                    </div>
                </div>

                <div class="column is-one-third">

                    <div class="field">
                        <div class="field">
                            <input id="process_follow" v-model="follow_taggers" type="checkbox"></input>
                            <label for="process_follow">Follow</label>
                        </div>
                        <div class="field">
                            <input id="process_like" v-model="like_taggers" type="checkbox"></input>
                            <label for="process_like">Like</label>
                        </div>
                        <div class="field">
                            <input id="process_comment" v-model="comment_taggers" type="checkbox"></input>
                            <label for="process_comment">Comment</label>
                        </div>
                        <div class="field">
                            <input id="process_unfollow" v-model="unfollow_taggers" type="checkbox"></input>
                            <label for="process_unfollow">Unfollow</label>
                        </div>

                    </div>

                </div>

                <div class="column is-one-third">

                    <div class="field">
                        <button class="button is-success" v-on:click="process_all_taggers(current_tagger_id)"><span class="icon is-small"><i class="fa fa-play" aria-hidden="true"></i></span><span>Process All</span></button>
                    </div>
                    <div class="field">
                        <button v-if="stop_processing" class="button is-info" v-on:click="toggle_process"><span class="icon is-small"><i class="fa fa-stop" aria-hidden="true"></i></span><span>UnPause Processing.</span></button>
                        <button v-else class="button is-danger" v-on:click="toggle_process"><span class="icon is-small"><i class="fa fa-stop" aria-hidden="true"></i></span><span>Pause Processing</span></button>
                    </div>
                </div>
            </div>

        </div>

        <div class="notification" v-if="responsemessage">{{ responsemessage }} </div>

        <table class="table is-striped is-narrow">

            <thead>
            <tr>
                <td>#</td>
                <td>User</td>
                <td><i class="fa fa-plus-circle" aria-hidden="true"></i></td>
                <td><i class="fa fa-heart" aria-hidden="true"></i></td>
                <td><i class="fa fa-comment" aria-hidden="true"></i></td>
                <td><i class="fa fa-minus-circle" aria-hidden="true"></i></td>
                <td>Comment</td>
                <td>Updated</td>
                <td>Run</td>
            </tr>
            </thead>

            <tbody>
            <tr style="is-small" v-for="(tagger, index) in tagger_list">
                <td>{{ index }}</td>
                <td>{{ tagger.username }}<br/></td>
                <td><textarea style="width:80px;">{{ tagger.followResponse }}</textarea><i id="show-modal" v-on:click="unserialize_this(tagger.followResponse); showModal = 'is-active'" class="fa fa-question" aria-hidden="true"></i></td>
                <td><textarea style="width:80px;">{{ tagger.likeResponse }}</textarea><i v-on:click="unserialize_this(tagger.likeResponse)" class="fa fa-question" aria-hidden="true"></i></td>
                <td><textarea style="width:80px;">{{ tagger.commentResponse }}</textarea><i v-on:click="unserialize_this(tagger.commentResponse)" class="fa fa-question" aria-hidden="true"></i></td>
                <td><textarea style="width:80px;">{{ tagger.unfollowResponse }}</textarea><i v-on:click="unserialize_this(tagger.unfollowResponse)" class="fa fa-question" aria-hidden="true"></i></td>
                <td style="font-size:10px;">{{ tagger.comment }}</td>
                <td style="font-size:10px;">{{ tagger.updated_at }}</td>
                <td><button class="button is-primary is-small" v-on:click="process_single_tagger(tagger, index)"><span class="icon is-small"><i class="fa fa-play" aria-hidden="true"></i></span></button></td>
            </tr>
            </tbody>
        </table>



        <div class="modal" v-bind:class="showModal" v-if="showModal">
            <div class="modal-background"></div>
            <div class="modal-content">
                <div class="notification">
                    <div class="title">JSON Response</div>
                    <pre><textarea style="width: 100%; height: 300px; font-family: courier;">{{ json_response }}</textarea></pre>
                </div>
            </div>
            <button class="modal-close is-large" aria-label="close" @click="showModal = ''"></button>
        </div>


        <div class="notification" v-if="debug">
            <div class="title">Log</div>
            <pre style="white-space: pre-wrap; text-overflow: ellipsis;"><textarea style=" font-family: courier; width: 100%; height: 300px;">{{ log }}</textarea></pre>
        </div>


    </div>
</template>

<script>
export default {

    data(){
        return {
            /* This is what the Response Message from the Server is. */
            responsemessage: '',

            /* Switch on to see log */
            debug: false,

            /* This is a detailed log of the responses from the server */
            log: '',

            /* Complete list of taggers from database */
            tagger_list: {},

            /* 10 Second Wait. */
            process_rate_sec: 10,

            /* Set ForEach Break */
            stop_processing: false,
            current_tagger: '',
            current_tagger_id: 0,

            /* Processing Parameters*/
            follow_taggers:     true,
            like_taggers:       true,
            comment_taggers:    true,
            unfollow_taggers:   true,

            /* Database Stats */
            total_in_database: 0,
            total_unprocessed: 0,
            daily_processed: 0,

            /* Spam Stats */
            commentSpam: 0,
            likeSpam: 0,
            followSpam: 0,
            unfollowSpam: 0,

            json_response: {},
            showModal: '',

            response_removed: {
                comment:"N/A", commentResponse:"REMOVED", commented:"2017-10-01 00:00:00", created_at:"2017-10-01 00:00:00",
                followResponse:"REMOVED", followed:"2017-10-01 00:00:00", id:0, likeResponse:"REMOVED", liked:"2017-10-01 00:00:00", tagger_media_pk:321, tagger_pk:123,
                unfollowResponse:"REMOVED", unfollowed:"2017-10-01 00:00:00", updated_at:"2017-10-01 00:00:00", userResponse:"REMOVED", username:"IG DELETED"
            },

            response_timedout: {
                comment:"TIMEOUT", commentResponse:"TIMEDOUT", commented:"2017-10-01 00:00:00", created_at:"2017-10-01 00:00:00",
                followResponse:"TIMEOUT", followed:"2017-10-01 00:00:00", likeResponse:"TIMEOUT", liked:"2017-10-01 00:00:00",
                unfollowResponse:"TIMEOUT", unfollowed:"2017-10-01 00:00:00", updated_at:"2017-10-01 00:00:00", userResponse:"TIMEOUT",
            },

            /* App Settings */
            max_seq_follows: '',
            max_seq_unfollows: '',
            max_seq_comments: '',
            max_seq_likes: '',
            max_daily_process: '',

            /* Current Batch */
            batch_processed: 0,

        }
    },

    mounted: function() {
        this.retrieve_app_settings();
        this.check_daily_processed();
    },

    methods: {

        /*
         * Process all Taggers in List
         */
        process_all_taggers: function(index) {

            //this.process_latest_activity(); // Get Latest Activity for DB.

            this.check_daily_processed(); // Refresh Processed Count.

            if (this.daily_processed >= this.max_daily_process ){
                this.responsemessage = 'Hit Maximum Daily Processed Rate:' + this.max_daily_process;
                return;
            } /* No more taggers! Maximum for the day! Seems to overrun if some already on last 24hours though. */

            if (this.batch_processed >= this.max_daily_process ){
                this.responsemessage = 'Batch has hit Maximum Daily Processed Rate:' + this.max_daily_process;
                return;
            } /* No more taggers! Batch has hit Maximum for the day! */

            if (this.current_tagger_id >= this.max_daily_process ){
                this.responsemessage = 'Current ID is > Maximum Daily Processed Rate:' + this.max_daily_process;
                return;
            } /* No more taggers! Current ID has hit Maximum for the day! */

            this.current_tagger_id = index;
            this.current_tagger = this.tagger_list[this.current_tagger_id];

            if (this.current_tagger == null ){
                this.responsemessage = 'Finished.';
                return;
            } /* No more taggers! */

            this.responsemessage = 'Processing Tagger: '+ this.current_tagger.username;

            if (this.stop_processing == false){

                axios.get('/process_single_tagger',{
                    params: {
                        tagger_pk:  this.current_tagger.tagger_pk,
                        delay:      this.process_rate_sec,
                        follow:     this.follow_taggers,
                        like:       this.like_taggers,
                        comment:    this.comment_taggers,
                        unfollow:   this.unfollow_taggers,
                    }
                }).then(function(data) {

                    ++this.batch_processed;
                    this.log = data.data;
                    this.total_in_database = data.data.database_count;
                    this.total_unprocessed = data.data.database_unprocessed;
                    this.responsemessage = 'Processed: '+ this.current_tagger.username;

                    if (data.data.tagger != null) {
                        this.tagger_list[index] = data.data.tagger;
                    } else {
                        this.tagger_list[index] = this.response_removed;
                    }

                }.bind(this)).then(function(data) {

                    /**
                     * Make function recursive for sync (not async) processing.
                     */
                     return this.process_all_taggers(++this.current_tagger_id);

                }.bind(this)).catch(function(error) {

                    this.responsemessage = error;

                    this.tagger_list[index] = this.response_timedout;

                    --this.total_unprocessed;

                    // Keep processing the next one anyway!
                    return this.process_all_taggers(++this.current_tagger_id);

                }.bind(this));

            } else {
                this.responsemessage = 'Processing was Cancelled';
            }


        },




        /** Follow the specified tagger
         *
         * Update the tagger list with the response values if followed.
         *
         * @param single_tagger
         * @param index
         */
        process_single_tagger: function(single_tagger, index) {

            this.check_daily_processed();

            if (this.daily_processed >= this.max_daily_process ){
                this.responsemessage = 'Hit Maximum Daily Processed Rate:' + this.max_daily_process;
                return;
            } /* No more taggers! Maximum for the day! */

            this.responsemessage = 'Processing Tagger: '+ single_tagger.username;

            axios.get('/process_single_tagger',{
                params: {
                    tagger_pk:  single_tagger.tagger_pk,
                    delay:      this.process_rate_sec,
                    follow:     this.follow_taggers,
                    like:       this.like_taggers,
                    comment:    this.comment_taggers,
                    unfollow:   this.unfollow_taggers,
                }
            }).catch(function(error) {

                this.responsemessage = error;

                this.tagger_list[index] = this.response_timedout;
                --this.total_unprocessed;

            }).then(function(data) {
                    this.log = data.data;
                    this.tagger_list[index] = data.data.tagger;
                    this.total_in_database = data.data.database_count;
                    this.total_unprocessed = data.data.database_unprocessed;
                    this.responsemessage = 'Processed: '+ single_tagger.username;
            }.bind(this));

        },



        /*
         * Get list of Taggers from DB
         */
        get_unfollowed_tagger_list: function () {

            this.responsemessage = 'Getting Unprocessed (unfollowed) Taggers from Database';

            console.log('get_unfollowed_tagger_list');

            axios.get('/get_unfollowed_tagger_list')
                .then(function(data) {
                    this.batch_processed = 0;
                    this.log = data.data;
                    this.tagger_list = data.data.taggers;
                    this.total_in_database = data.data.database_count;
                    this.total_unprocessed = data.data.database_unprocessed;
                    this.commentSpam = data.data.commentSpam;
                    this.likeSpam = data.data.likeSpam;
                    this.followSpam = data.data.followSpam;
                    this.unfollowSpam = data.data.unfollowSpam;
                }.bind(this));
        },


        toggle_process: function(){
            if (this.stop_processing == false){ this.stop_processing = true; } else { this.stop_processing = false; }
            this.responsemessage = 'Operation Canceled = ' + this.stop_processing;
        },



        reset_comment_spam: function(){
            axios.get('/reset_comment_spam')
                .then(function(data) {
                    this.responsemessage = 'commentSpam Field reset to 0.';
                    this.commentSpam = 0;
                }.bind(this));
        },
        reset_like_spam: function(){
            axios.get('/reset_like_spam')
                .then(function(data) {
                    this.responsemessage = 'likeSpam Field reset to 0.';
                    this.likeSpam = 0;
                }.bind(this));
        },
        reset_follow_spam: function(){
            axios.get('/reset_follow_spam')
                .then(function(data) {
                    this.responsemessage = 'followSpam Field reset to 0.';
                    this.followSpam = 0;
                }.bind(this));
        },
        reset_unfollow_spam: function(){
            axios.get('/reset_unfollow_spam')
                .then(function(data) {
                    this.responsemessage = 'unfollowSpam Field reset to 0.';
                    this.unfollowSpam = 0;
                }.bind(this));
        },

        /*
         * Get list of Taggers from DB
         */
        unserialize_this: function ($serialised_string) {
            this.responsemessage = 'Unserializing String.';

            axios.get('/unserialize_this',{
                params: {
                    serialised_string:  $serialised_string,
                }
            }).then(function(response) {
                this.json_response = response.data;
                this.responsemessage = 'Unserialized!';
            }.bind(this));

        },

        check_daily_processed: function(){
            axios.get('/daily_processed_count',{})
                .then(function(data) {
                    this.daily_processed = data.data;
                }.bind(this));
        },

        retrieve_app_settings: function() {
            axios.get('/retrieve_app_settings')
                .then(function(data) {
                    this.max_seq_follows    = data.data.max_seq_follows;
                    this.max_seq_unfollows  = data.data.max_seq_unfollows;
                    this.max_seq_comments   = data.data.max_seq_comments;
                    this.max_seq_likes      = data.data.max_seq_likes;
                    this.max_daily_process  = data.data.max_daily_process;
                    this.process_rate_sec   = data.data.api_pause;
                }.bind(this));
        },

        process_latest_activity: function() {
            axios.get('/process_latest_activity')
                .then(function(data) {
                    this.responsemessage = 'Retrieved.';
                }.bind(this));
        },

    }
}


</script>
