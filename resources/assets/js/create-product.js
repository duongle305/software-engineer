$(document).ready(()=>{
    $('.dropify').dropify();
    $('#summernote').summernote({
        height: 200,
        tabsize: 2
    });
});
let app = new Vue({
    el: '#app',
    data: {
        isAddColor: false,
        isAddSize: false,
        sizeTypeId: '',
        sizes: [],
        colors:[],
        name:''
    },
    watch: {
        name: function (str) {
            this.getSlug(str)
        }
    },
    methods: {
        getSizes(e){
            let selected = e.target.options[e.target.options.selectedIndex];
            if(selected !== undefined){
                axios.get(selected.dataset.href).then(rs => {
                    this.sizes = rs.data;
                    this.sizes.forEach((el)=>{
                        el.text = el.name;
                    });
                }).catch(e => {
                });
            }
        },
        getColors(e){
            if(e.target.dataset.href){
                axios.get(e.target.dataset.href).then(res=>{
                    this.colors = res.data;
                    this.colors.forEach((el)=>{ el.text = el.name });
                });
            }
        },
        getSlug: function(str) {
            return this.generateSlug(str);
        },
        generateSlug(str){
            return strslug(str);
        }
    },
});

Vue.component('select2-multiple',{
    template:`
        <select :name="name" multiple style="width: 100%"></select>
    `,
    props:['options','name'],
    mounted(){
        $(this.$el).select2({data:this.options}).trigger('change');
    },
    watch:{
        options(options){
            $(this.$el).select2().empty().trigger('change');
            $(this.$el).select2({data: options}).trigger('change');
        }
    }
});