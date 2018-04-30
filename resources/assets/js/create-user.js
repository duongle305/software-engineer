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
            }).catch(e =>{});
        },
        getDistricts(e){
            let selected = e.target.options[e.target.options.selectedIndex];
            if(selected !== undefined){
                if(this.wards.length > 0){
                    this.wards = [];
                    this.isSelectedDistrict = false;
                }
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
    },
    mounted(){
        this.getProvinces();
    }
});