<template>
    <div>

        <div class="notification">{{ responsemessage }}</div>

        <div class="columns">

            <div class="column is-one-third">
                <div class="panel panel-default">

                    <div class="panel">
                        <div class="panel-heading">Debug API Command</div>
                        <div class="panel-block">
                            <button class="button is-success" v-on:click="debug_command"><span class="icon is-small"><i class="fa fa-play" aria-hidden="true"></i></span><span>Debug</span></button>
                        </div>
                    </div>

                    <div class="field">
                        <div class="select">
                            <select v-model="input_group" >
                                <option selected>account</option>
                                <option>business</option>
                                <option>collection</option>
                                <option>direct</option>
                                <option>discover</option>
                                <option>hashtag</option>
                                <option>internal</option>
                                <option>live</option>
                                <option>location</option>
                                <option>media</option>
                                <option>people</option>
                                <option>push</option>
                                <option>story</option>
                                <option>timeline</option>
                                <option>usertag</option>
                            </select>
                        </div>
                    </div>

                    <div class="field">
                        <label class="label">Input Command</label>
                        <div class="control">
                            <input v-model="input_command" class="input is-primary" type="text" placeholder="Input API Command"></input>
                        </div>
                    </div>
                    <div class="field">
                        <label class="label">Parameter 1</label>
                        <div class="control">
                            <input v-model="param1" class="input is-info" type="text" placeholder="Parameter 1"></input>
                        </div>
                    </div>
                    <div class="field">
                        <label class="label">Parameter 2</label>
                        <div class="control">
                            <input v-model="param2" class="input is-info" type="text" placeholder="Parameter 2"></input>
                        </div>
                    </div>

                </div>
            </div>

            <div class="column is-two-thirds">
                <h1 class="title is-1">Popular Commands</h1>
                <a href="commandList.html">Full Command Reference</a>

                <hr/>

                <table class="table is-striped is-narrow">
                    <tbody>
                        <tr><td> Discover->getPopularFeed()</td><td>Is this the heart - following feed?</td></tr>
                        <tr><td> Discover->getHomeChannelFeed()</td><td>Own feed?</td></tr>

                        <tr><td> Hashtag->getInfo() </td><td></td></tr>
                        <tr><td> Hashtag->search() </td><td></td></tr>
                        <tr><td> Hashtag->getFeed() </td><td></td></tr>
                        <tr><td> Hashtag->getRelated() </td><td></td></tr>

                        <tr><td> Media->getInfo() </td><td></td></tr>
                        <tr><td> Media->like() </td><td></td></tr>
                        <tr><td> Media->unlike() </td><td></td></tr>
                        <tr><td> Media->comment() </td><td></td></tr>

                        <tr><td> People->getInfoById() </td><td></td></tr>
                        <tr><td> People->getRecentActivityInbox()</td><td>Details about your feed - when people like/comment/etc..</td></tr>
                        <tr><td> People->getSelfFollowing()</td><td>Get list of who you are following.</td></tr>
                        <tr><td> People->getSelfFollowers()</td><td>Get list of your own followers.</td></tr>
                        <tr><td> People->search()</td><td>Search for Instagram users.</td></tr>
                        <tr><td> People->follow() </td><td></td></tr>
                        <tr><td> People->unfollow() </td><td></td></tr>

                        <tr><td> Timeline->getTimelineFeed()</td><td>Get your "home screen" timeline feed.</td></tr>
                        <tr><td> Timeline->getUserFeed() </td><td></td></tr>
                    </tbody>
                </table>
            </div>

        </div>

        <pre class="notification">{{ log }}</pre>

    </div>
</template>

<script>
export default {

    data(){
        return {
            /* This is what the Response Message from the Server is. */
            responsemessage: '',

            /* This is a detailed log of the responses from the server */
            log: '{}',

            input_group: '',
            input_command: '',
            param1: '',
            param2: '',
        }
    },

    methods: {

        /*
         * Send Debug Command
         */
        debug_command: function () {

            this.responsemessage = 'Running Command ';

            axios.get('/debug_command', {
                params: {
                    group: this.input_group,
                    command: this.input_command,
                    parameter1: this.param1,
                    parameter2: this.param2,
                }
            }).then(function (response) {
                this.log = response;
                this.responsemessage = 'Command Run';
            }.bind(this));

        },

    }

}

</script>