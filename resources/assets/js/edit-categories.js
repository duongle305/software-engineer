let app = new Vue({
    el:'#app',
    data: {
        url: $('#url').val(),
        title:'',
        slug:''
    },
    methods:{
        slugTitle: (title) => {
            return strslug(title)
        },
        getCategory(){
            axios.get(this.url).then(rs =>{
                this.title = rs.data.title;
                this.slug = rs.data.slug;
            });
        }
    },
    mounted(){
        this.getCategory();
    }
});