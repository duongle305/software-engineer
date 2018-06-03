let app = new Vue({
    el: '#app',
    data: {
        isChangeAddress: parseInt($('#oldChange').val()),
        isSelectedWard: false,
        isSelectedProvince: false,
        isSelectedDistrict: false,
        detail:'',
        provinces:[],
        districts:[],
        wards:[],
        address:''
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
        reset(){
            this.isSelectedWard = undefined;
            this.isSelectedDistrict = undefined;
            this.isSelectedProvince = undefined;
            this.detail = null;
        },
    },
    mounted(){
        this.getProvinces();
    }
});