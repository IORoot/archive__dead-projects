<template>
    <div>

        <h1 class="title">Timed Automatic Bulk Processing</h1>
        <h2 class="subtitle">This client-based processing.</h2>

        <div class="notification" v-if="responsemessage">{{ responsemessage }} </div>

        <div class="box">
            <div class="columns">
                <div class="column is-one-half">
                    <h4 class="title">Info
                        <button class="button is-primary is-small" v-on:click="check_daily_processed"><span class="icon"><i class="fa fa-refresh" aria-hidden="true"></i></span></button>
                        <button class="button is-primary is-small" v-on:click="batch_process_taggers"><span class="icon"><i class="fa fa-play" aria-hidden="true"></i></span></button>
                    </h4>
                    <div class="field">
                        <table class="table is-bordered is-narrow is-striped">
                            <tbody>
                                <tr><td>ID being processed next</td><td>{{ current_tagger_id }}</td></tr>
                                <tr><td>Processed in last Batch </td><td class="control" v-bind:class="spinner_daily_batch">{{ daily_batch_count }}</td></tr>
                                <tr><td>Processed in last 24hrs </td><td class="control" v-bind:class="spinner_daily_processed">{{ daily_processed }}</td></tr>
                                <tr><td>Unprocessed</td><td class="control" v-bind:class="spinner_total_unprocessed">{{ total_unprocessed }}</td></tr>
                                <tr><td>Total in DB</td><td class="control" v-bind:class="spinner_total_db">{{ total_in_database }}</td></tr>
                                <tr><td>Last time processing started</td><td>{{date_batch_last_started}}</td></tr>
                                <tr><td>Last time processing finished</td><td>{{date_batch_last_ended}}</td></tr>
                                <tr><td>Maximum to process in 24hrs</td><td>{{ max_daily_process }}</td></tr>
                            </tbody>
                        </table>

                    </div>
                </div>
                <div class="column  is-one-half">
                    <h4 class="title">Settings</h4>
                    <div class="field">
                        <table class="table is-bordered is-striped is-narrow is-hoverable">
                            <tbody>
                                <tr><td>API call Rate?</td><td>{{process_rate_sec}} secs</td></tr>
                                <tr><td>Crontab Recon</td><td><input type="text" v-model="crontab_recon"/>
                                    <button class="button is-warn is-small" v-on:click="get_crontab_recon"><span class="icon"><i class="fa fa-recycle" aria-hidden="true"></i></span></button>
                                </td></tr>
                                <tr><td>Crontab Process</td><td><input type="text" v-model="crontab_process"/>
                                    <button class="button is-primary is-small" v-on:click="batch_process_taggers"><span class="icon"><i class="fa fa-play" aria-hidden="true"></i></span></button>
                                </td></tr>
                            </tbody>
                        </table>
                    </div>
                    <h4 class="title">Spam Counts</h4>
                    <div class="buttons has-addons">
                        <button class="button is-primary is-small" v-on:click="reset_follow_spam"><span class="icon"><i class="fa fa-plus-circle" aria-hidden="true"></i></span><span>{{ followSpam }} / {{ max_seq_follows }}</span></button>
                        <button class="button is-primary is-small" v-on:click="reset_like_spam"><span class="icon"><i class="fa fa-heart" aria-hidden="true"></i></span><span>{{ likeSpam }} / {{ max_seq_likes }}</span></button>
                        <button class="button is-primary is-small" v-on:click="reset_comment_spam"><span class="icon"><i class="fa fa-comment" aria-hidden="true"></i></span><span>{{ commentSpam }} / {{ max_seq_comments }}</span></button>
                        <button class="button is-primary is-small" v-on:click="reset_unfollow_spam"><span class="icon"><i class="fa fa-minus-circle" aria-hidden="true"></i></span><span>{{ unfollowSpam }} / {{ max_seq_unfollows }}</span></button>
                    </div>
                </div>
            </div>
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

            /* 10 Second Wait. */
            process_rate_sec: 5,

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
            total_in_database: null,
            total_unprocessed: null,
            daily_processed: null,

            /* Spam Stats */
            commentSpam: 0,
            likeSpam: 0,
            followSpam: 0,
            unfollowSpam: 0,

            /* App Settings */
            max_seq_follows: '',
            max_seq_unfollows: '',
            max_seq_comments: '',
            max_seq_likes: '',
            max_daily_process: '',

            /* Spinners */
            spinner_get_unprocessed: '',
            spinner_daily_processed: '',
            spinner_daily_batch: '',
            spinner_total_unprocessed: '',
            spinner_total_db: '',

            /*Batch timeDate*/
            date_batch_last_started: null,
            date_batch_last_ended: null,
            daily_batch_count: null,

            /* Crontabs */
            crontab_recon: '',
            crontab_process: '',
        }
    },

    /*
     * Do these On load.
     */
    mounted: function() {
        this.retrieve_app_settings();
        this.batch_datetimes();
        this.check_daily_processed();
        this.get_unfollowed_tagger_list();
        this.get_crontab_recon();
        this.get_crontab_process();

        this.check_batch_processed();
    },

    methods: {

        /*
         * Get list of Taggers from DB
         */
        get_unfollowed_tagger_list: function () {

            this.responsemessage = 'Getting Unprocessed (unfollowed) Taggers from Database';
            this.spinner_get_unprocessed = this.spinner_total_unprocessed = this.spinner_total_db = 'is-loading';

            axios.get('/get_unfollowed_tagger_list')
                .then(function(data) {
                    this.log = data.data;
                    this.total_in_database = data.data.database_count;
                    this.total_unprocessed = data.data.database_unprocessed;
                    this.commentSpam = data.data.commentSpam;
                    this.likeSpam = data.data.likeSpam;
                    this.followSpam = data.data.followSpam;
                    this.unfollowSpam = data.data.unfollowSpam;
                    this.spinner_get_unprocessed = '';
                    this.spinner_total_unprocessed = '';
                    this.spinner_total_db = '';
                }.bind(this));
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
         * Check the number of accounts that have been processed in last 24 hours
         * This is to prevent spam.
        */
        check_daily_processed: function(){
            this.spinner_daily_processed = 'is-loading';
            axios.get('/daily_processed_count',{})
                .then(function(data) {
                    this.daily_processed = data.data;
                    this.spinner_daily_processed = '';
                }.bind(this));

            this.check_batch_processed();
            this.get_unfollowed_tagger_list();
            this.batch_datetimes();
        },

        check_batch_processed: function(){
            this.spinner_daily_batch = 'is-loading';
            axios.get('/daily_batch_count',{})
                .then(function(data) {
                    this.daily_batch_count = data.data;
                    this.spinner_daily_batch = '';
                }.bind(this));
        },

        retrieve_app_settings: function() {
            this.spinner_app_settings = 'is-loading';
            axios.get('/retrieve_app_settings')
                .then(function(data) {
                    this.max_seq_follows    = data.data.max_seq_follows;
                    this.max_seq_unfollows  = data.data.max_seq_unfollows;
                    this.max_seq_comments   = data.data.max_seq_comments;
                    this.max_seq_likes      = data.data.max_seq_likes;
                    this.max_daily_process  = data.data.max_daily_process;
                    this.process_rate_sec   = data.data.api_pause;

                    this.spinner_app_settings = '';
                }.bind(this));
        },

        process_latest_activity: function() {
            axios.get('/process_latest_activity')
                .then(function(data) {
                    this.responsemessage = 'Retrieved.';
                }.bind(this));
        },

        /* Colour icons depending on their status. */
        icon_status: function(response) {
            var result = [];
            if (response != null) { result.push('has-text-success'); }
            return result;
        },

        /* Get batch start end datetimes */
        batch_datetimes(){
            axios.get('/get_batch_datetimes')
                .then(function(data) {
                    this.date_batch_last_started = data.data.start;
                    this.date_batch_last_ended = data.data.end;
                }.bind(this));
        },

        /* Get batch start end datetimes */
        batch_process_taggers(){
            axios.get('/batch_process_taggers')
                .then(function(data) {
                    this.responsemessage = data;
                }.bind(this));
        },

        /* Get CRONTAB Values */
        get_crontab_recon(){
            axios.get('/get_crontab_recon')
                .then(function(data) {
                    this.crontab_recon = data.data.timing;
                }.bind(this));
        },

        get_crontab_process(){
            axios.get('/get_crontab_process')
                .then(function(data) {
                    this.crontab_process = data.data.timing;
                }.bind(this));
        },

    }
}


</script>
