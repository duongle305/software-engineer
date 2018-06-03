$(document).ready(function(){
    $('.dropify').dropify();
});
let app = new Vue({
    el: '#app',
    data:{
        defaultPassword:false,
        isChangeInfo:false,
        isChangePhoto: false,
        isChangeAddress: false,
        isSelectedProvince: false,
        isSelectedDistrict: false,
        isSelectedWard: false,
        isNull: true,
        provinces: [],
        districts:[],
        wards: [],
    },
    methods:{
        getProvinces(){
            axios.get('/admin-dl/ajax/provinces').then(rs => {
                this.provinces = rs.data;
            });
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
        reset(){
            this.isSelectedProvince = undefined;
            this.isSelectedDistrict = undefined;
            this.isSelectedWard = undefined;
            this.isNuLL = null;
        }
    },
    mounted(){
        this.getProvinces();
        this.reset();
    }
});