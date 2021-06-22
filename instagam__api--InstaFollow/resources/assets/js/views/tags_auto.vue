<template>
    <div class="container">

    <div class="notification">{{ responsemessage }}</div>

        <div class="columns">

            <div class="column is-one-third">
                <div class="panel panel-default">
                    <div class="panel-heading">Tag Feed ({{taggers.num_results}})</div>


                    <input v-model="tag" placeholder="Hashtag (without the #)">
                    <a v-on:click="gettag" class="button is-danger is-small">Get Tag Feed</a>
                    <a v-on:click="savetaggers" class="button is-info is-small">Save taggers to DB</a><br/><br/>
                    <a v-on:click="bulktaggers" class="button is-info is-small">Bulk Tag Feeds</a><br/><br/>


                    <div class="panel-body">
                        <table class="table is-striped is-narrow">
                            <tbody>
                                <tr v-for="tagger in taggers.items">
                                    <td><img v-if="tagger.image_versions2" style="width:60px; height: 60px;" :src="tagger.image_versions2.candidates[1].url"></td>
                                    <td>{{ tagger.user.username }} <br/>({{ tagger.user.pk }})<br/>{{ tagger.user.is_private }}</td>
                                    <td><img style="width:60px; height: 60px;" :src="tagger.user.profile_pic_url"></td>

                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>





            <div class="column is-one-third">
                <div class="panel panel-default">
                    <div class="panel-heading">Comment List</div>
                        <a v-on:click="getcomments" class="button is-info is-small">Get Comments</a>
                        <input v-model="comment" placeholder="New comment">
                        <a v-on:click="savecomment" class="button is-danger is-small">Save comment</a><br/><br/>

                    <table class="table is-striped is-narrow">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Comment</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="entry in comments">
                                <td>{{ entry.id }}</td>
                                <td>{{ entry.comment }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>






            <div class="column is-one-third">
                <div class="panel panel-default">
                    <div class="panel-heading">Follow Taggers in DB. ({{dbtaggers.length}}) - [{{ Math.round((dbtaggers.length * 40)/60) }} min]</div>
                    <a v-on:click="gettaggers" class="button is-info is-small">ALL</a>
                    <a v-on:click="getnewtaggers" class="button is-info is-small">Unprocessed</a><br/>

                    <input type="checkbox" id="process_follow" value="true" v-model="process_follow">
                    <label for="process_follow">Follow</label>
                    <input type="checkbox" id="process_like" value="true" v-model="process_like">
                    <label for="process_like">Like</label>
                    <input type="checkbox" id="process_comment" value="true" v-model="process_comment">
                    <label for="process_comment">Comment</label>
                    <input type="checkbox" id="process_unfollow" value="true" v-model="process_unfollow">
                    <label for="process_unfollow">Unfollow</label>

                    <a v-on:click="processtaggers" class="button is-danger is-small">Process</a>
                    <table class="table is-striped is-narrow">
                        <thead>
                            <tr>
                                <th>Username (PK)</th>
                                <th>Followed?</th>
                                <th>UnFollowed?</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="dbtagger in dbtaggers">
                                <td>{{ dbtagger.username }} ({{ dbtagger.tagger_pk }})</td>
                                <td>{{ dbtagger.followed }}</td>
                                <td>{{ dbtagger.unfollowed }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>




        </div>

    <div class="notification"><pre>{{ taggers }}</pre></div>

    </div>
</template>

<script>
export default {

    data(){
        return {
            tag: '',
            taggers: {},
            dbtaggers: {},
            responsemessage: {},
            comment: '',
            comments: {},
            taggerpk: '',
            process_follow: false,
            process_like: false,
            process_comment: false,
            process_unfollow: false
        }
    },

    methods: {

         /*
         *  --- First Column ---
         */

        /*
         * Retrieve a Single Tag from Instagram
        */
        gettag: function(tag) {
            this.responsemessage = 'Getting Tag - ' + this.tag;
            axios.get('/gettag', {
                params: {
                    tag: this.tag
                }
            }).then(({data}) => this.taggers = data);
        },

        /*
         * Retrieve a Single Tag from Instagram and Save results to Database.
         */
        savetaggers: function(tag) {
            this.responsemessage = 'Working...';
            axios.get('/savetaggers', {
                params: {
                    tag: this.tag
                }
            }).then(({data}) => this.responsemessage = data);
        },

        /*
         * Run the bulk hashtag function to retrieve bulk list.
         */
        bulktaggers: function() {
            this.responsemessage = 'Working...';
            axios.get('/bulktaggers').then(({data}) => this.responsemessage = data);
        },


        /*
        *  --- Second Column ---
        */

        /*
         * Get list of comments from DB
         */
        getcomments: function () {
            this.responsemessage = 'Getting Comment List...';
            axios.get('/getcomments')
                .then(({data}) => this.comments = data);
        },

        /*
         * Save new Comment to Database
         */
        savecomment: function() {
            this.responsemessage = 'Saving Comment to DB...';
            axios.get('/savecomment', {
                params: {
                    comment: this.comment
                }
            }).then(({data}) => this.responsemessage = data);
        },


        /*
         *  --- Third Column ---
         */

        /*
         * Get list of Taggers from DB
         */
        gettaggers: function () {
            this.responsemessage = 'Getting Taggers...';
            axios.get('/gettaggers')
                .then(({data}) => this.dbtaggers = data);
        },

        /*
         * Get list of New Taggers from DB
         */
        getnewtaggers: function () {
            this.responsemessage = 'Getting New Taggers...';
            axios.get('/getnewtaggers')
                .then(({data}) => this.dbtaggers = data);
        },

        /*
         * Process all Taggers in Database that need processing.
         */
        processtaggers: function() {
            this.responsemessage = 'Processing Taggers';
            axios.get('/process_tagger', {
                params: {
                    follow: this.process_follow,
                    like: this.process_like,
                    comment: this.process_comment,
                    unfollow: this.process_unfollow
                }
            }).then(({data}) => this.responsemessage = data);
        }

    }
}
</script>
