<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div class="cirkle">
                            <span href="#">{{char}} </span>
                        </div>
                        <a class="follow" href="#" v-on:click="updateFollowStatus()">{{status ? 'Unfollow' : 'Follow' }}</a>
                        <h4 class="media-heading">{{profile.name}} </h4>
                        <h5>{{profile.email}}</h5>

                        <hr style="margin:8px auto">
                    </div>
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
            env: '',
            id: '',
            profile: [],
            char: '',
            status: ''
        }
    },
    created() {

        //Get the id from url 
        this.id = window.document.URL
            .toString()
            .replace(process.env.MIX_APP_URL + '/viewprofile/', '');

        this.checkFollowStatus()
        //when new tweet gets created update tweets list  
        this.$eventHub.$on('created', this.getTweets);
        //get the base_url from .env file
        this.env = process.env.MIX_APP_URL
    },
    mounted() {
        this.getProfile()
    },
    methods: {
        updateFollowStatus() {

            axios.put(`${this.env}/status/${this.id}`)
                .then((response) => {
                    this.status = response.data.status

                }).catch((error) => {
                    console.log(error);
                });
        },
        checkFollowStatus() {
            axios.get(`${this.env}/status/${this.id}`)
                .then((response) => {
                    this.status = response.data.status

                }).catch((error) => {
                    console.log(error);
                });
        },
        getProfile() {
            axios.get(`${this.env}/profile/${this.id}`)
                .then((response) => {
                    this.profile = response.data
                    //set avatar char 
                    this.char = this.profile.name.charAt(0).toUpperCase()
                }).catch((error) => {
                    console.log(error);
                });
        }
    }
}
</script>

<style scoped>
.cirkle {
    margin-right: 10px;
    background-color: lightblue;
    width: 50px;
    height: 50px;
    font-size: 1.4em;
    border-radius: 50%;
    text-align: center;
    display: table;
    float: left;
}

.cirkle span {
    display: table-cell;
    vertical-align: middle;
    text-decoration: none;
}

.follow {
    background-color: lightblue;
    margin-left: 10px;
    width: 60px;
    height: 25px;
    font-size: 1em;
    border-radius: 3px;
    text-align: center;
    display: table;
    float: right;
}
</style>
