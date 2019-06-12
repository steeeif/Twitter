<template>
    <div class="index">
        <input class="serch-field" type="text" v-on:input="getUsers" v-model="serch" placeholder="Find users" aria-label="Search" />
        <div v-bind:class="{ 'active': isActive}" class="list" v-on:focus="isActive = true">
            <div class="serch-list">
                <div v-for="post in postList">
                    <small>
                        <a v-bind:href="env+'/viewprofile/'+post.id" class="list-user" v-on:focus="isActive = true">{{ post.name }}</a>
                    </small>
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
            isActive: false,
            serch: '',
            postList: [],
            env: ''
        }
    },
    created() {

        //get the base_url from .env file
        this.env = process.env.MIX_APP_URL
        //Show serch list on input 
        window.addEventListener("input", (e) => {
            if (this.$el.querySelector('.serch-field').contains(e.target)) {
                this.isActive = true
            }
        });
        //Show hide serch list
        window.addEventListener("click", (e) => {
            if (this.$el.querySelector('.serch-field').contains(e.target) || this.$el.querySelector('.list').contains(e.target)) {
                this.isActive = true
            } else {
                this.isActive = false
            }
        });
    },

    methods: {
        getUsers: function(event) {
            //Check if serch field contains serch parameter
            if (this.serch.length > 0) {
                axios.get(`${this.env}/users?name=${this.serch}`)
                    .then((response) => {
                        this.postList = response.data
                        console.log(this.postList)
                    }).catch((error) => {
                        console.log(error);
                    });
                //If no serch term added clear list        
            } else {
                this.postList = []
            }
        }
    }
}
</script>
<style scoped>
* {
    box-sizing: border-box;
}

.serch {
    position: relative;
}

.index {
    margin-left: 20%;
    z-index: 10;
}

.serch-field {
    border-radius: 3px;
    margin: 0 auto;
    width: 230px;
    border-width: 0px 0px 3px 0px;
    border-color: #6cb2eb;
    border-style: solid;
    outline: none;
    padding: 10px;
}

.serch-list {
    cursor: pointer;

    width: 230px;
    background-color: white;
}

.list {
    position: absolute;
    display: none;
}

.list-user {
    padding: 10px;
}

.active {
    display: block;
}
</style>