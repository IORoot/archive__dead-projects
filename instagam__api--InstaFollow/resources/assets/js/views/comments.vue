<template>
    <div>
        <h1 class="title">Comments </h1>
        <h2 class="subtitle">Responses to users on their Images.</h2>

        <div class="box">
            <div class="field">
                <div class="control">
                    <input v-model="newcomment" class="input is-primary" type="text" placeholder="Add Comment to List"></input>
                </div>
            </div>

            <div class="field">
                <div class="control">
                    <a v-on:click="add_comment" class="button is-success">
                        <span class="icon is-small">
                          <i class="fa fa-plus"></i>
                        </span>
                        <span>Add</span>
                    </a>
                </div>
            </div>
        </div>

        <div class="tags has-addons">
                <span style="border-radius: 2px; margin: 3px;" class="tag is-success" v-for="comment in commentlist">
                        {{comment.comment}}
                    <a class="delete is-small is-info" v-on:click="delete_comment(comment.id)"></a>
                </span>
        </div>

        <div class="notification" v-if="responsemessage">{{ responsemessage }} </div>



    </div>
</template>

<script>

    export default {

        data(){
            return {
                responsemessage: '',

                commentlist: {},

                newcomment: null,
            }
        },

        mounted: function() {
            this.get_all_comments();
        },

        methods: {

            get_all_comments: function() {
                axios.get('/retrieve_all_comments')
                    .then(function(data) {
                        this.commentlist = data.data;
                    }.bind(this));
            },

            delete_comment: function(passed_id) {
                axios.get('/delete_comment',{
                    params: {
                        comment_id: passed_id
                    }
                }).then(function(data) {
                    this.responsemessage = data.data;
                    this.get_all_comments();
                }.bind(this));
            },

            add_comment: function(){
                axios.get('/add_comment',{
                    params: {
                        new_comment: this.newcomment
                    }
                }).then(function(data) {
                    this.responsemessage = data.data;
                    this.get_all_comments();
                }.bind(this));
            }

        }

    }

</script>
