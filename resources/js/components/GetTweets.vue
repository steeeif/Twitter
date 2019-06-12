<template>
    <div class="row justify-content-center">
        <div class="col-md-8 mt-4" v-for="tweet in tweets" v-bind:key="tweet.id">
            <div class="card">
                <div class="card-header">{{tweet.name}}
                    <span class="float-right">{{tweet.created_at}}
                    </span>
                </div>
                <div class="card-body">
                    {{tweet.tweet}}
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios'
export default {
    data() {
        return {
            tweets: [],
            env: ''

        }
    },

    created() {
        /*
        * when new tweet gets created event bus updates tweets list  
        */
        this.$eventHub.$on('created', this.getTweets);
        this.env = process.env.MIX_APP_URL
    },
    mounted() {
        this.getTweets()
    },
    methods: {
        getTweets() {
            axios.get(`${this.env}/tweet`)
                .then((response) => {
                    this.tweets = response.data
                }).catch((error) => {
                    console.log(error);
                });
        }
    }
}
</script>

