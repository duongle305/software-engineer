$(document).ready(function () {
    $('.dropify').dropify();
});
let app = new Vue({
    el: '#app',
    data: {
        isSelectedProvince: false,
        isSelectedDistrict: false,
        provinces:[],
        districts:[],
        wards:[],
        title:''
    },
    watch: {
        name: function (str) {
            this.getSlug(str)
        }
    },
    methods:{
        getProvinces(){
            axios.get('/admin-dl/ajax/provinces').then(rs => {
                this.provinces = rs.data;
            }).catch(e =>{});
        },
        getDistricts(e){
            let selected = e.target.options[e.target.options.selectedIndex];
            if(selected !== undefined){
                let province_id = selected.dataset.id;
                axios.get('/admin-dl/ajax/districts/'+province_id).then(rs => {
                    this.districts = rs.data;
                }).catch(e =>{});
            }
        },
        getWards(e){
            let selected = e.target.options[e.target.options.selectedIndex];
            if(selected !== undefined){
                let district_id = selected.dataset.id;
                axios.get('/admin-dl/ajax/wards/'+district_id).then(rs => {
                    this.wards = rs.data;
                }).catch(e =>{});
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
    mounted(){
        this.getProvinces();
    }
});