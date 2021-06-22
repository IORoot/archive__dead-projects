<template>
    <div>

        <h1 class="title">User Settings</h1>
        <h2 class="subtitle">This will grab all user details from IG.</h2>

        <div class="box" v-if="userdetails.username">
            <table class="table is-striped is-narrow">
                <tbody>
                    <tr>
                        <td>Picture: <img :src="userdetails.profile_pic_url"></td>
                        <td>Username: {{ userdetails.username }}</td>
                        <td>Fullname: {{ userdetails.full_name }}</td>
                        <td>PK#: {{ userdetails.pk }}</td>
                        <td>Private: {{ userdetails.is_private }}</td>
                        <td>URL: <a :href="userdetails.external_url">{{ userdetails.external_url }}</a></td>
                        <td>Email: {{ userdetails.email }}</td>
                    </tr>
                </tbody>
            </table>
            <table class="table is-striped is-narrow">
                <tbody>
                    <tr>
                        <td v-if="userpost.image_versions2" style="width: 200px;"><img :src="userpost.image_versions2.candidates[1].url"></td>
                        <td v-if="userpost.caption" >{{ userpost.caption.text }}</td>
                    </tr>
                </tbody>
            </table>
            <table class="table is-striped is-narrow">
                <tbody>
                    <tr>
                        <td>Media PK: {{ userpost.pk }}</td>
                        <td>Views: {{ userpost.view_count }} </td>
                        <td>Comments: {{ userpost.comment_count }} </td>
                        <td>Likes: {{ userpost.like_count }}</td>
                    </tr>
                </tbody>
            </table>

        </table>
        </div>

        <hr>

        <h1 class="title">Follow List <a v-on:click="getwhitelist" class="button is-danger">Create Whitelist</a></h1>
        <h2 class="subtitle">This will create a Whitelist of people for the BOT to ignore.</h2>
        <div class="notification" v-if="whitelist.users">Users added to whitelist. Total Added : {{ whitelist.users.length }} </div>


        <div v-for="followed in whitelist.users">
            <img style="float:left; width:60px; height: 60px;" :src="followed.profile_pic_url" :title="followed.username">
        </div>


    </div>
</template>

<script>
export default {

    data(){
        return {
            userdetails: {},
            userpost: {},
            whitelist: {},
            responsemessage: {}
        }
    },

    mounted: function() {
        this.getuser();
    },

    methods: {
        getuser: function () {
            axios.get('/userdetails')
                .then(({data}) => this.userdetails = data);

            axios.get('/userposts')
                .then(({data}) => this.userpost = data)
                .then(({data}) => this.userpostimage = data);

            axios.get('/save_userposts')
                .then(({data}) => this.responsemessage = data);
        },


        getwhitelist: function () {
            axios.get('/whitelist')
                .then(({data}) => this.whitelist = data);
            axios.get('/savewhitelist')
                .then(({data}) => this.responsemessage = data);
        }
    }
}
</script>
