<template>
    <div>

        <h1 class="title">Manual Processing</h1>
        <h2 class="subtitle">Process a specific user by their PK number.</h2>

        <div class="box">
            <div class="field">
                <input class="input is-success" v-model="taggerpk" placeholder="User PK"></input>
            </div>
            <div class="field">
                <input type="checkbox" id="process_follow" value="true" v-model="process_follow">
                <label for="process_follow">Follow</label>
            </div>
            <div class="field">
                <input type="checkbox" id="process_comment" value="true" v-model="process_comment">
                <label for="process_comment">Comment</label>
            </div>
            <div class="field">
                <input type="checkbox" id="process_like" value="true" v-model="process_like">
                <label for="process_like">Like</label>
            </div>
            <div class="field">
                <input type="checkbox" id="process_unfollow" value="true" v-model="process_unfollow">
                <label for="process_unfollow">Unfollow</label>
            </div>
            <div class="field">
                <div class="control">
                    <button v-on:click="processtaggers" class="button is-danger">Process User</button>
                </div>
            </div>
        </div>

        <div class="box" v-if="processedtagger">


            <table class="table is-striped is-narrow">
                <thead>
                <tr>
                    <th>Username (PK)</th>
                    <th>Followed?</th>
                    <th>Commented?</th>
                    <th>Liked?</th>
                    <th>UnFollowed?</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>{{processedtagger.tagger.username}} ({{processedtagger.tagger.tagger_pk}})</td>
                    <td>{{ processedtagger.tagger.followed }}</td>
                    <td>{{ processedtagger.tagger.commented }}</td>
                    <td>{{ processedtagger.tagger.liked }}</td>
                    <td>{{ processedtagger.tagger.unfollowed }}</td>
                </tr>
                </tbody>
            </table>
        </div>


        <div class="notification" v-if="responsemessage">{{ responsemessage }} </div>

        <h1 class="title">List Users</h1>
        <h2 class="subtitle">List users to find PK number.</h2>

        <div class="box">
            <div class="field">
                <div class="control">
                    <button v-on:click="gettaggers" class="button is-danger">List ALL Users in DB</button>
                    <button v-on:click="getnewtaggers" class="button is-success">List Unprocessed Users only</button>
                </div>
            </div>
            <div class="field">
                <div class="notification" v-if="dbtaggers.length">Users Retrieved ({{dbtaggers.length}}) </div>
            </div>
        </div>

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
</template>

<script>
export default {

    data(){
        return {
            responsemessage: null,

            dbtaggers: {},

            taggerpk: '',

            processedtagger: null,

            tag: '',

            process_follow: false,
            process_like: false,
            process_comment: false,
            process_unfollow: false


        }
    },

    methods: {

        /*
        * Get a list of all ALL taggers in DB
        */
        gettaggers: function () {
            this.responsemessage = 'Getting Taggers...';
            axios.get('/gettaggers')
                .then(({data}) => this.dbtaggers = data);
        },

        /*
         * Get a list of all unprocessed taggers in DB.
         */
        getnewtaggers: function () {
            this.responsemessage = 'Getting New Taggers... ';
            axios.get('/getnewtaggers')
                .then(({data}) => this.dbtaggers = data);
        },

        /*
        * Process the specific tagger by ID number
        */
        processtaggers: function() {
            this.responsemessage = 'Processing Tagger ' + this.taggerpk;
            axios.get('/process_single_tagger', {
                params: {
                    tagger_pk: this.taggerpk,
                    follow: this.process_follow,
                    like: this.process_like,
                    comment: this.process_comment,
                    unfollow: this.process_unfollow
                }
            }).then(function(data) {
                this.processedtagger = data.data;
                this.responsemessage = 'Processed. ';
            }.bind(this));
        }

    }
}
</script>
