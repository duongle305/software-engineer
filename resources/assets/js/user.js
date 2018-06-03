let app = new Vue({
    el:'#app',
    data:{
        delete:'',
    },
    methods:{
        showDelete(e){
            this.delete = e.target.dataset.delete;
            swal({
                title: `Bạn có muốn xóa nhân viên ${e.target.dataset.name}?`,
                text: "Sau khi đồng ý bạn sẽ không khôi phục lại được.",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#fb9678',
                confirmButtonText: 'Đồng ý'
            }).then(() => {
                this.deleteUser();
            }).catch(e => {})
        },
        deleteUser(){
            axios.delete(this.delete).then(rs => {
                if(rs.status === 200){
                    swal(
                        'Đã xóa!',
                        `${rs.data.message}`,
                        'success'
                    ).then(()=>{
                        location.reload();
                    })
                }
            }).catch(e =>{
                if(e.response.status === 403)
                    swal(
                        'Thông báo!',
                        `${e.response.data.message}`,
                        'error'
                    )
            });
        }
    }
})