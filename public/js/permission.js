let app  = new Vue({
    el: '#app',
    data:{
        editPermission: false,
        permission:{
            id:'',
            name:'',
            display_name:'',
            description:'',
            created_at: ''
        },
        href:{
            edit:'',
            update:''
        }
    },
    methods:{
        showEdit(e){
            if(this.editPermission)this.editPermission = ! this.editPermission;
            this.href.edit = e.relatedTarget.dataset.edit;
            this.href.update = e.relatedTarget.dataset.update;
            this.getPermission();
        },
        getPermission(){
            axios.get(this.href.edit).then(rs =>{
                this.permission = rs.data;
            }).catch(e => { });
        },
        updatePermission(){
            axios.put(this.href.update,this.permission).then(rs =>{
                location.href = rs.data.href;
            }).catch(e => {
                $.toast({
                    heading: 'Thông báo !',
                    text: e.response.data.message,
                    showHideTransition: 'slide',
                    icon: 'error',
                    loaderBg: '#f96868',
                    position: 'top-right'
                });
            });
        }
    },
    mounted(){
        $(this.$refs.vueModal).on('show.bs.modal',(e)=>{ this.showEdit(e); });
    }
});