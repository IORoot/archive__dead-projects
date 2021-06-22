<template>
    <div>

        <h1 class="title">Hashtag Processing</h1>
        <h2 class="subtitle">Retrieve users posting to these hashtags.</h2>

        <div class="box">
            <div class="field">
                <div class="control">
                    <button v-on:click="processAllHashtags" class="button is-danger">Process All Hashtags for Users</button>
                    <button v-on:click="auto_process_hashtags()" class="button is-info">Check Scheduler Returns</button>
                </div>
            </div>
            <div class="field">
                <p>This will retrieve all the latest users who have posted to each hashtag listed below.<br/>Roughly retrieving ~80 users per hashtag.</p>
            </div>
        </div>

        <div class="box">
            <div class="field">
                <div class="control">
                    <input v-model="newhashtag" class="input is-info" type="text" placeholder="Add new hashtag"></input>
                </div>
            </div>

            <div class="field">
                <div class="control">
                    <a v-on:click="add_hashtag" class="button is-info">
                        <span class="icon is-small">
                          <i class="fa fa-plus"></i>
                        </span>
                        <span>Add</span>
                    </a>
                </div>
            </div>
        </div>


        <table class="table is-striped is-narrow">
            <thead>
            <tr>
                <td>ID</td>
                <td>Hashtag</td>
                <td>Status</td>
                <td>Controls</td>
            </tr>
            </thead>

            <tbody>
            <tr style="is-small" v-for="(item, index) in hashtaglist">
                <td>{{item.id}}</td>
                <td>{{item.value}}</td>
                <td>{{item.status}}</td>
                <td>
                    <button class="delete is-small is-info" v-on:click="delete_hashtag(item.id)"></button>
                    <button class="button is-small is-info" v-on:click="processHashtag(index)"><span class="icon is-small"><i class="fa fa-play"></i></span></button>
                </td>
            </tr>
            </tbody>
        </table>

        <div class="notification is-success" v-if="total_processed">Total processed = {{ total_processed }} </div>

        <div class="notification" v-if="responsemessage">{{ responsemessage }} </div>

    </div>
</template>

<script>
export default {

    data(){
        return {
            responsemessage: '',

            hashtaglist: {},

            /* Hashtag to be added onto list. */
            newhashtag: '',

            total_processed: null,
        }
    },

    mounted: function() {
        this.get_all_hashtags();
    },

    methods: {

        get_all_hashtags: function() {
            axios.get('/retrieve_all_hashtags')
                .then(function(data) {
                    this.hashtaglist = data.data;
                }.bind(this));
        },


        add_hashtag: function(){
            axios.get('/add_hashtag',{
                params: {
                    new_hashtag: this.newhashtag
                }
            }).then(function(data) {
                this.newhashtag = '';
                this.responsemessage = data.data;
                this.get_all_hashtags();
            }.bind(this));
        },

        delete_hashtag: function(passed_id) {
            axios.get('/delete_hashtag',{
                params: {
                    hashtag_id: passed_id
                }
            }).then(function(data) {
                this.responsemessage = data.data;
                this.get_all_hashtags();
            }.bind(this));
        },

        /*
         * Process each hashtag individually.
         *
         * Don'tforget to bind() the 'this' keyword to make it available.
        */
        processAllHashtags: function() {

            this.total_processed = 0;

            // Map over array and run function on each entry
            this.hashtaglist.map(function(single_hashtag){

                this.responsemessage = 'Processing Hashtags';

                single_hashtag.status = 'Processing';

                // Process the hashtag
                axios.get('/processhashtagfeed', {
                    params: {
                        hashtag: single_hashtag.value
                    }
                }).then(
                    function(data){
                        // The returned data should be the number of results.
                        this.total_processed += data.data;
                        this.responsemessage = data;
                        single_hashtag.status = data.statusText + '(' + data.data  + ')';
                    }.bind(this)
                ).catch(function (error) {
                    this.responsemessage = error;
                });

            }.bind(this))
        },





        processHashtag: function(hashtag) {

            this.total_processed = 0;

            var current_hashtag = this.hashtaglist[hashtag];

            this.responsemessage = 'Processing ' + current_hashtag.value + ' Hashtag';
            current_hashtag.status = 'processing';

            // Process the hashtag
            axios.get('/processhashtagfeed', {
                params: {
                    hashtag: current_hashtag.value
                }
            }).then(function(data){
                    // The returned data should be the number of results.
                    this.total_processed += data.data;
                    this.responsemessage = data;
                    current_hashtag.status = data.statusText + '(' + data.data  + ')';
                }.bind(this)
            ).catch(function (error) {
                this.responsemessage = error;
            });

        },

        auto_process_hashtags: function() {
            axios.get('/run_schedule')
                .then(function(data) {
                    this.responsemessage = data;
                }.bind(this));
        },

    }
}
</script>
