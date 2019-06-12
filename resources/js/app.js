require("./bootstrap");

window.Vue = require("vue");
/*
*Create a global event bus
*
*/
window.Vue.prototype.$eventHub = new Vue();

import CreateTweet from "./components/CreateTweet.vue";
import GetTweets from "./components/GetTweets.vue";
import Users from "./components/Users.vue";
import UserProfile from "./components/UserProfile.vue";

const app = new Vue({
  el: "#app",
  components: {
    "create-tweet": CreateTweet,
    "get-tweets": GetTweets,
    "my-users": Users,
    "user-profile": UserProfile
  }
});
