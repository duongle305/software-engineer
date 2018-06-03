$(document).ready(function(){
    $('.dropify').dropify();
});
let app = new Vue({
    el: '#app',
    data: {
        name:''
    },
    watch: {
        name: function (str) {
            this.getSlug(str)
        }
    },
    methods: {
        getSlug: function(str) {
            return this.generateSlug(str);
        },
        generateSlug(str){
            return strslug(str);
        }
    },
});