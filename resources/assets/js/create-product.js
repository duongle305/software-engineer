let app = new Vue({
    el: '#app',
    data: {
        isAddColor: false,
        isAddSize: false,
        sizeTypeId: '',
        sizes: [],
        colors:[]
    },
    methods: {
        getSizes(e){
            let selected = e.target.options[e.target.options.selectedIndex];
            $('select.select-multiple-sizes').empty().trigger('change');
            if(selected !== undefined){
                axios.get(selected.dataset.href).then(rs => {
                    this.sizes = rs.data;
                    this.sizes.forEach((el)=>{
                        el.text = el.name;
                    });
                    $('select.select-multiple-sizes').select2({data: this.sizes}).trigger('change');
                }).catch(e => {
                });
            }
        },
        getColors(e){
            $('select.select-multiple-colors').empty().trigger('change');
            if(e.target.dataset.href){
                axios.get(e.target.dataset.href).then(res=>{
                    this.colors = res.data;
                    this.colors.forEach((el)=>{ el.text = el.name });
                        $('select.select-multiple-colors').select2({data: this.colors}).trigger('change');
                    $()
                });
            }
        }
    },
});