let app = new Vue({
    el: '#app',

    data:{
        resource:'',
        permissionType: 'basic',
        crudSelected: ['create','read','update','delete']
    },
    methods:{
        crudName(item){
            return item.replace(/create|read|update|delete/gi,function(x){
                if(x==='create')
                    return  'Thêm';
                if(x==='read')
                    return  'Xem';
                if(x==='update')
                    return  'Sửa';
                if(x==='delete')
                    return  'Xóa';
            }) + " " + app.resource.toLowerCase();
        },
        crudSlug(item){
            return item.toLowerCase() + "-" + strslug(app.resource.toLowerCase());
        },
        crudDescription: function(item) {
            return "Cho phép người dùng " + item.replace(/create|read|update|delete/gi,function(x){
                if(x==='create')
                    return  'thêm';
                if(x==='read')
                    return  'xem';
                if(x==='update')
                    return  'sửa';
                if(x==='delete')
                    return  'xóa';
            }) + " " + app.resource.toLowerCase();
        },
    },
});