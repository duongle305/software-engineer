let app = new Vue({
    el: '#app',
    data:{
        roleName:'',
    },
    methods:{
        roleSlug: (roleName)=>{
            return strslug(roleName);
        },
    }
});