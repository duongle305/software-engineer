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
            update:'',
            delete:''
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
            }).catch(error => {
            });
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
        },
        deletePermission(){
            axios.delete(this.href.delete).then(rs=>{
                if(rs.status === 200){
                    swal(
                        'Đã xóa',
                        `${rs.data.message}`,
                        'success'
                    ).then(()=>{
                        location.reload();
                    })
                }
            }).catch(e=>{
                if(e.response.status === 403){
                    swal(
                        'Thông báo',
                        `${e.response.data.message}`,
                        'error'
                    )
                }
            })
        },
        showMessage(e){
            this.href.delete = e.target.dataset.delete;
            swal({
                title: `Bạn có muốn xóa quyền ${e.target.dataset.name}?`,
                text: `Sau khi đồng ý bạn sẽ không khôi phục lại được.`,
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#fb9678',
                confirmButtonText: 'Đồng ý'
            }).then(()=>{
                this.deletePermission();
            }).catch(e=>{})
        }
    },
    mounted(){
        $(this.$refs.vueModal).on('show.bs.modal',(e)=>{ this.showEdit(e); });
    }
});