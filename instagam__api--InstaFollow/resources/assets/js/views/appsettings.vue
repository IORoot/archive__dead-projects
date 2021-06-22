<template>
    <div>

        <h1 class="title">App Settings</h1>
        <h2 class="subtitle">This will change the behaviour of the BOT.</h2>

        <table class="table is-bordered is-narrow">
            <thead>
            <tr>
                <th>Setting</th><th>Value</th><th>Description</th>
            </tr>
            </thead>
            <tbody>
                <tr><td>Comments<br/>Max Sequential Failed</td><td><input v-model="max_seq_comments" class="input is-small" type="text" placeholder="3"></input></td><td>How many failed comments in a row should happen before app switches off commenting?</td></tr>
                <tr><td>Follows<br/>Max Sequential Failed</td><td><input v-model="max_seq_follows" class="input is-small" type="text" placeholder="3"></input></td><td>How many failed follows in a row should happen before app switches off auto follows?</td></tr>
                <tr><td>UnFollows<br/>Max Sequential Failed</td><td><input v-model="max_seq_unfollows" class="input is-small" type="text" placeholder="3"></input></td><td>How many failed unfollows in a row should happen before app switches off auto unfollowing? </td></tr>
                <tr><td>Likes<br/>Max Sequential Failed</td><td><input v-model="max_seq_likes" class="input is-small" type="text" placeholder="3"></input></td><td>How many failed likes in a row should happen before app switches off auto liking?</td></tr>
                <tr><td>24-hour Max Process</td><td><input v-model="max_daily_process" class="input is-small" type="text" placeholder="480"></input></td><td>How many accounts should be processed in a 24 hour period?<br/>- IG Limits at roughly 480 per day.</td></tr>
                <tr><td>Pause between each API Call (seconds)</td><td><input v-model="api_pause" class="input is-small" type="text" placeholder="11"></input></td><td>How many seconds to delay each API call. Too quick and IG will detect as spam.</td></tr>
            </tbody>
        </table>

        <a v-on:click="update_app_settings" class="button is-danger">Update APP Settings</a>

        <div class="notification" v-if="responsemessage">{{ responsemessage }} </div>

    </div>
</template>

<script>
export default {

    data(){
        return {
            responsemessage: null,

            max_seq_follows: '',
            max_seq_unfollows: '',
            max_seq_comments: '',
            max_seq_likes: '',
            max_daily_process: '',
            api_pause: ''
        }
    },

    mounted: function() {
        this.retrieve_app_settings();
    },

    methods: {

        retrieve_app_settings: function() {
            axios.get('/retrieve_app_settings')
                .then(function(data) {
                    this.max_seq_follows    = data.data.max_seq_follows;
                    this.max_seq_unfollows  = data.data.max_seq_unfollows;
                    this.max_seq_comments   = data.data.max_seq_comments;
                    this.max_seq_likes      = data.data.max_seq_likes;
                    this.max_daily_process  = data.data.max_daily_process;
                    this.api_pause          = data.data.api_pause;
                }.bind(this));
        },

        update_app_settings: function() {
            axios.get('/update_app_settings',{
                params: {
                    max_seq_follows:    this.max_seq_follows,
                    max_seq_unfollows:  this.max_seq_unfollows,
                    max_seq_comments:   this.max_seq_comments,
                    max_seq_likes:      this.max_seq_likes,
                    max_daily_process:  this.max_daily_process,
                    api_pause:          this.api_pause,
                }
            }).then(function(data) {
                this.responsemessage = data.data;
            }.bind(this));
        },



    }
}
</script>
