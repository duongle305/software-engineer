let app = new Vue({
    el:'#app',
    data: {
        title:'',
        slug:''
    },
    methods:{
        slugTitle: (title) => {
            return strslug(title)
        }
    }
});