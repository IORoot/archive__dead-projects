<template>
        <div class="row">
            <h1 class="title">Instagram Login</h1>
            <h2 class="subtitle">Enter Username & Password to store details.</h2>

            <div class="field">
                <p class="control has-icons-left has-icons-right">
                    <input v-model="username" class="input" type="text" placeholder="Instagram Username"></input>
                        <span class="icon is-small is-left">
                          <i class="fa fa-instagram"></i>
                        </span>
                </p>
            </div>
            <div class="field">
                <p class="control has-icons-left">
                    <input v-model="password" class="input" type="password" placeholder="Password"></input>
                        <span class="icon is-small is-left">
                          <i class="fa fa-lock"></i>
                        </span>
                </p>
            </div>

            <div class="field is-grouped">
                <div class="control">
                    <input v-on:click="store_user_details" class="button" type="submit" value="Submit"></input>
                </div>
            </div>

            <h2 class="subtitle">{{ responsemessage }}</h2>

        </div>
</template>

<script>

    export default {

        data(){
            return {
                username: '',
                password: '',

                responsemessage: '',
            }
        },

        methods: {

            store_user_details: function () {

                axios.get('/store_user_details',{
                    params: {
                        username: this.username,
                        password: this.password
                    }
                }).then(function(response) {
                    this.responsemessage = response.data;

                    axios.get('/save_userposts')
                        .then(({data}) => this.responsemessage = data);

                }.bind(this));

            }

        }

    }

</script>
