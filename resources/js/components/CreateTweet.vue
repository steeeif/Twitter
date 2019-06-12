<template>
    <div class="col-md-8 ">
        <div class="card">
            <div class="card-header">Add new tweet</div>
            <div class="card-body">
                <form>
                    <div class="form-group">
                        <textarea v-model="tweet" type="text" name="tweet" rows="4" placeholder="Vad händer?" class="form-control">
                        </textarea>
                        {{160 - tweet.length }}: characters left
                    </div>
                    <div class="form-group">
                        <button v-on:click="addTweet" class="btn btn-info">Tweeta</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
<script>
import axios from 'axios'
export default {
    data() {
        return {
            tweet: '',
            countChar: 0,
            env: ''
        }
    },
    created() {
        this.env = process.env.MIX_APP_URL
    },
    methods: {
        addTweet: function(event) {
            event.preventDefault()
            if (this.tweet.length > 160) {
                alert(`You have exceeded maximum number of characters allowed, plese remove ${(this.tweet.length - 160)} chars`)
            } else {
                axios.post(`${this.env}/tweet`, {
                    'tweet': this.tweet,
                }).then((response) => {
                    this.tweet = ''
                    //Fires event bus to update tweets list in GetTweets component
                    this.$eventHub.$emit('created');

                }).catch((error) => {
                    console.log(error);
                });
            }
        }
    }
}
</script>
