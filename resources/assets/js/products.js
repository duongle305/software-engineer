let app = new Vue({
    el:'#app',
    data:{
        delete:'',
        hrefData:'',
        result: [],
        search:'',
        pagination: [],
    },
    methods:{
        showDelete(e, index){
            this.delete = e.target.dataset.delete;
            swal({
                title: `Bạn có muốn xóa sản phẩm ${this.result[index].title}?`,
                text: "Sau khi đồng ý bạn sẽ không khôi phục lại được.",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#fb9678',
                confirmButtonText: 'Đồng ý'
            }).then(() => {
                this.deleteProduct();
            }).catch(e => {})
        },
        getAllProducts(page = 1){
            $('div.loader').show();
            axios.get(`${this.hrefData}?page=${page}`).then(res=>{
                this.result = res.data.data;
                this.pagination = res.data;
                let time = setTimeout(()=>{
                    $('div.loader').fadeOut();
                    clearTimeout(time);
                },500);
            });
        },
        deleteProduct(index){
            this.result.splice(index,1);
            axios.delete(this.delete).then(rs => {
                this.result.splice(index,1);
                swal(
                    'Đã xóa!',
                    `${rs.data.message}`,
                    'success'
                );
            }).catch(e =>{
                swal(
                    'Thông báo!',
                    `${e.response.data.message}`,
                    'error'
                )
            });
        },
        formatDate(str){
            let date = new Date(str);
            return `${date.getDate()}/${date.getMonth()+1}/${date.getFullYear()}`;
        },
        searchProduct(val){
            console.log(val);
        },
    },
    mounted(){
        this.hrefData = $('#href-data').val();
        this.getAllProducts();
    },
    watch:{
        search(val){ return this.searchProduct(val); }
    }
});