let app = new Vue({
    el: '#app',
    data: {
        isAddColor: false,
        isAddSize: false,
        sizeTypeId: '',
        sizes: {},
        col: 12
    },
    methods: {
        getSizes(e){
            let selected = e.target.options[e.target.options.selectedIndex];
            if(selected !== undefined){
                axios.get(selected.dataset.href).then(rs => {
                    this.sizes = rs.data;
                }).catch(e => {
                });
            }
        },
    },
});