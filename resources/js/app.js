import Vue from 'vue'
import NewComponent from "./components/NewComponent";

require('./bootstrap');

const app = new Vue({
    el: '#app',
    components: {
        NewComponent,
    }
})
