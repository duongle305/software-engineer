!function(t){var e={};function n(o){if(e[o])return e[o].exports;var r=e[o]={i:o,l:!1,exports:{}};return t[o].call(r.exports,r,r.exports,n),r.l=!0,r.exports}n.m=t,n.c=e,n.d=function(t,e,o){n.o(t,e)||Object.defineProperty(t,e,{configurable:!1,enumerable:!0,get:o})},n.n=function(t){var e=t&&t.__esModule?function(){return t.default}:function(){return t};return n.d(e,"a",e),e},n.o=function(t,e){return Object.prototype.hasOwnProperty.call(t,e)},n.p="/",n(n.s=75)}({75:function(t,e,n){t.exports=n(76)},76:function(t,e){new Vue({el:"#app",data:{delete:""},methods:{showDelete:function(t){var e=this;this.delete=t.target.dataset.delete,swal({title:"Bạn có muốn xóa nhân viên "+t.target.dataset.name+"?",text:"Sau khi đồng ý bạn sẽ không khôi phục lại được.",type:"warning",showCancelButton:!0,confirmButtonColor:"#3085d6",cancelButtonColor:"#fb9678",confirmButtonText:"Đồng ý"}).then(function(){e.deleteUser()}).catch(function(t){})},deleteUser:function(){axios.delete(this.delete).then(function(t){200===t.status&&swal("Đã xóa!",""+t.data.message,"success").then(function(){location.reload()})}).catch(function(t){403===t.response.status&&swal("Thông báo!",""+t.response.data.message,"error")})}}})}});