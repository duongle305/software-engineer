let app = new Vue({
    el: '#app',
    data: {
        tab: 'PENDING',
        hrefData: '',
        pagination:{},
        result:[],
        url:'orders/',
        search: '',
        dataSearch:[]
    },
    methods: {
        getDataOrders(tab,page = 1){
            $('div.loader').show();
            this.tab = tab;
            axios.get(`${this.hrefData}/${tab}?page=${page}`).then(res=>{
                this.result = res.data.data;
                this.pagination = res.data;
                let time = setTimeout(()=>{
                    $('div.loader').fadeOut();
                    clearTimeout(time);
                },500);
            });
        },
        formatNumber(num){
            return $.number(num);
        },
        changeStatus(status,id){
            return axios.post(`status-orders/${id}`,{
                status: status
            });
        },
        readyToShip(index){
            if(this.result[index]) {
                this.changeStatus('READY', this.result[index].id).then(res => {
                    this.result.splice(index, 1);
                    swal(
                        'Thành công',
                        ``,
                        'success'
                    ).then(()=>{
                    })
                });
            }
        },
        shipped(index){
            if(this.result[index]) {
                this.changeStatus('SHIPPED', this.result[index].id).then(res => {
                    this.result.splice(index, 1);
                    swal(
                        'Thành công',
                        ``,
                        'success'
                    ).then(()=>{
                    })
                });
            }
        },
        delivered(index){
            if(this.result[index]) {
                this.changeStatus('DELIVERED', this.result[index].id).then(res => {
                    this.result.splice(index, 1);
                    swal(
                        'Thành công',
                        ``,
                        'success'
                    ).then(()=>{
                    })
                });
            }
        },
        returned(index){
            if(this.result[index]) {
                this.changeStatus('RETURNED', this.result[index].id).then(res => {
                    this.result.splice(index, 1);
                    swal(
                        'Thành công',
                        ``,
                        'success'
                    ).then(()=>{
                    })
                });
            }
        },
        deliveryFailed(index){
            if(this.result[index]) {
                this.changeStatus('DELIVERY FAILED', this.result[index].id).then(res => {
                    this.result.splice(index, 1);
                    swal(
                        'Thành công',
                        ``,
                        'success'
                    ).then(()=>{
                    })
                });
            }
        },
        cancelled(index) {
            swal({
                title: `Bạn có muốn hủy bỏ đơn hàng ${this.result[index].code}?`,
                text: "Sau khi đồng ý bạn sẽ không khôi phục lại được.",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#fb9678',
                confirmButtonText: 'Đồng ý'
            }).then(() => {
                if (this.result[index]) {
                    this.changeStatus('CANCELLED', this.result[index].id).then(res => {
                        this.result.splice(index, 1);
                    });
                }
            }).catch(e => {})
        },

        findOrder(val){
            axios.get(`/admin-dl/search-orders/${this.tab}/${val}`).then(res=>{
                this.result = res.data.data;
                this.pagination = res.data;
            });
        }
    },
    mounted(){
        this.hrefData = $('#href-data').val();
        this.getDataOrders(this.tab);
    },
    watch:{
        search(val){ return this.findOrder(val); }
    }
});