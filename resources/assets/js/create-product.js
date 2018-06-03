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
            var slug = '';
            slug = str.toLowerCase();
            slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
            slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
            slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
            slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
            slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
            slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
            slug = slug.replace(/đ/gi, 'd');
            slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
            slug = slug.replace(/ /gi, "-");
            slug = slug.replace(/\-\-\-\-\-/gi, '-');
            slug = slug.replace(/\-\-\-\-/gi, '-');
            slug = slug.replace(/\-\-\-/gi, '-');
            slug = slug.replace(/\-\-/gi, '-');
            slug = '@' + slug + '@';
            slug = slug.replace(/\@\-|\-\@|\@/gi, '');
            return slug;
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