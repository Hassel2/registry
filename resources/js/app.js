require('./bootstrap');
window.Vue = require('vue').default;

Vue.component('layout-component', require('./components/LayoutComponent.vue').default);

const app = new Vue({
    el: '#app',
    data(){
        return {
            search: null
        }
    }
})
