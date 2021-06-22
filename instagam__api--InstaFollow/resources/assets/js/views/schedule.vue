<template>
    <div>
        <h1 class="title">Schedule </h1>
        <h2 class="subtitle">Stats of times of day people respond most.</h2>

        <div class="box">
            <div class="field">
                <div class="control">
                    <a v-on:click="process_latest_activity" class="button is-success">
                        <span class="icon is-small">
                          <i class="fa fa-instagram"></i>
                        </span>
                        <span>Update latest Activity Inbox.</span>
                    </a>
                </div>
            </div>
        </div>

        <div class="box">
            <div class="field">
                <div class="control">
                    <a v-on:click="get_latest_stats" class="button is-info">
                        <span class="icon is-small">
                          <i class="fa fa-bar-chart"></i>
                        </span>
                        <span>Get Latest Stats.</span>
                    </a>
                </div>
            </div>

            <div class="field">
                <div class="control">
                    <label class="radio">
                        <input type="radio" name="follows" value="started following you" v-model="returndata" checked>
                            Follows
                    </label>
                    <label class="radio">
                        <input type="radio" name="commentlikes" value="liked your comment" v-model="returndata">
                            Likes of comment
                    </label>
                    <label class="radio">
                        <input type="radio" name="postlikes" value="liked your post" v-model="returndata">
                            Likes of post
                    </label>
                    <label class="radio">
                        <input type="radio" name="mentions" value="mentioned you in a comment" v-model="returndata">
                            mentions
                    </label>
                    <label class="radio">
                        <input type="radio" name="all" value="u" v-model="returndata">
                            all
                    </label>
                </div>
            </div>
        </div>


        <div class="notification" v-if="responsemessage">{{ responsemessage }} </div>

        <canvas ref="myChart" id="myChart" type="bar" width="400" height="500"></canvas>

    </div>
</template>

<script>

    export default {

        data(){
            return {
                responsemessage: '',

                labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                instagramdata: [ { x: 0, y: 0 }, { x: 7, y: 24 }],

                returndata: 'started following you',
                myNewChart: null,
            }
        },

        mounted: function() {
            this.render_chart();
        },


        methods: {

            render_chart: function() {

                this.myNewChart = new Chart(this.$refs.myChart, {
                    type: 'scatter',
                    data: {
                        labels: this.labels,
                        datasets: [{
                            label: 'When Instagram Users Post.',
                            data: this.instagramdata,
                            borderColor: "rgba(80, 171, 80, 1)",
                            backgroundColor: "rgba(220,220,220,0.2)",
                            pointBorderColor: "rgba(80, 171, 80, 0.1)",
                            pointBackgroundColor: "rgba(137, 192, 74, 0.05)",
                            pointBorderWidth: "1",
                        }]
                    },
                    options: {
                        scales: {
                            xAxes: [{
                                type: 'linear',
                                position: 'bottom',
                                ticks: {
                                    min: 0,
                                    max: 7
                                },
                                scaleLabel: {
                                    display: true,
                                    labelString: 'Day of the Week'
                                }
                            }],
                            yAxes: [{
                                type: 'linear',
                                ticks: {
                                    beginAtZero: true,
                                    min: 0,
                                    max: 24,
                                    stepSize: 1
                                },
                                scaleLabel: {
                                    display: true,
                                    labelString: 'Hour of the Day'
                                }
                            }]
                        }
                    }
                });

            },

            process_latest_activity: function() {
                axios.get('/process_latest_activity')
                    .then(function(data) {
                        this.responsemessage = 'Activities Stored.'
                    }.bind(this));
            },

            get_latest_stats: function() {
                axios.get('/get_latest_stats',{
                        params: {
                            reporttype:  this.returndata
                    }
                }).then(function(data) {
                        this.responsemessage = 'Chart updated.';
                        this.instagramdata = data.data;
                        this.myNewChart.destroy();
                        this.render_chart();
                }.bind(this));
            },



        }

    }

</script>

