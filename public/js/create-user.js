let app = new Vue({
    el: '#app',
    data:{
        isDefaultPassword: false,
        isSelectedProvince: false,
        isSelectedDistrict: false,
        provinces: [],
        districts:[],
        wards: []
    },
    methods:{
        getProvinces(){
            axios.get('/admin-dl/ajax/provinces').then(rs => {
                this.provinces = rs.data;
            });
        },
        getDistricts(e){
            let province_id = e.target.options[e.target.options.selectedIndex].dataset.id;
            axios.get('/admin-dl/ajax/districts/'+province_id).then(rs => {
                this.districts = rs.data;
            });
        },
        getWards(e){
            let district_id = e.target.options[e.target.options.selectedIndex].dataset.id;
            axios.get('/admin-dl/ajax/wards/'+district_id).then(rs => {
                this.wards = rs.data;
            });
        },
    },
    mounted(){
        this.getProvinces();
    }
});