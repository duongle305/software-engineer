require('./bootstrap');
window.Vue = require('vue');

Vue.component('pagination',{
    template:`
                <ul class="pagination rounded-flat pagination-success justify-content-end" v-if="pagination.total">
                    <li class="page-item" :class="{ 'disabled':(pagination.current_page <= 1)}"><a class="page-link" href="#" @click.prevent="changePage(pagination.current_page - 1)"><i class="mdi mdi-chevron-left"></i></a></li>
                    <li class="page-item" :class="{'active':(pagination.current_page === page)}" v-for="page in pages"><a class="page-link" href="#" @click.prevent="changePage(page)">{{ page }}</a></li>
                    <li class="page-item" :class="{ 'disabled':(pagination.current_page===pagination.total) }"><a class="page-link" href="#" @click.prevent="changePage(pagination.current_page + 1)"><i class="mdi mdi-chevron-right"></i></a></li>
                </ul>`,
    props:['pagination'],
    computed:{
        pages: function (){
            let array = [];
            let totalPages = Math.ceil(this.pagination.total / this.pagination.per_page);
            for(let i = 1; i <= totalPages; i++){
                array.push(i);
            }
            return array;
        }
    },
    methods:{
        changePage(page){
            this.pagination.current_page = page;
        }
    }
});

// Vue.component('example-component', require('./components/ExampleComponent.vue'));