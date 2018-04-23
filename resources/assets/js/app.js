require('./bootstrap');
window.Vue = require('vue');

const ajax = axios.create({
    baseURL: 'http://localhost:8000/ajax'
});

// Vue.component('example-component', require('./components/ExampleComponent.vue'));