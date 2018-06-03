var name = $('.breadcrumb .active > span').attr('id');
let app = new Vue({
    el: '#app',
    data: {
        name:name
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
$(document).ready(function(){
    $('.dropify').dropify();
});