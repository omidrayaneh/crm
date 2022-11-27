<template>
<div class="card-body">
  <div class="row mb-2" style="margin-top: -35px">
      <div class="text-right col-4">
          <input type="text" class="form-control" @input="search" v-model="find" placeholder=" نام مشتری ">
      </div>

<!--      <div class="text-left col">-->
<!--          <a class="btn btn-light"  :href="'/events/create'">-->
<!--              <i class="fa fa-plus greenyellow"></i> جدید-->
<!--          </a>-->
<!--      </div>-->
  </div>
    <table class="table table-striped table-hover">
        <thead>
        <tr class="text-center">
            <th scope="col">#</th>
            <th scope="col">مشتری</th>
            <th scope="col">وضعیت</th>
<!--            <th scope="col">عملیات</th>-->
        </tr>
        </thead>
        <tbody>
        <tr class="text-center" v-for="(customer,key) in laravelData.data" @click="clicked(customer)">
            <td v-if="page ==1" >
                {{ key + 1}}
            </td>
            <td v-else>
                {{(((page-1) *9) + key + 1)}}
            </td>
            <td >{{customer.customer.name}}</td>
            <td v-if="customer.status === 0">عادی</td>
            <td v-else-if="customer.status ===1">تعلیق</td>
            <td v-else-if="customer.status === 2">پایان</td>
            <td v-else-if="customer.status === 3">گارانتی</td>
            <td v-else-if="customer.status === 4">منتظر خرید</td>
            <td v-else-if="customer.status === 5">در حال بستن</td>

<!--                |-->

<!--&lt;!&ndash;                <a @click="deleted(event.id)" class="deleteRecord">&ndash;&gt;-->
<!--&lt;!&ndash;                    <span class="fa fa-trash red"></span>&ndash;&gt;-->
<!--&lt;!&ndash;                </a>&ndash;&gt;-->

<!--            </td>-->
        </tr>
        </tbody>
    </table>
    <div  class="col-sm-12 d-print-none d-flex justify-content-center" style="margin-bottom: 0">

    <pagination  :data="laravelData" :limit="5" @pagination-change-page="getData"></pagination>
    </div>
</div>
</template>

<script>
import Swal from 'sweetalert2/dist/sweetalert2.js'
export default {
    data(){
        return{
            laravelData:{},
            find :'',
            page :'',
            status :'',
            csrf: document.head.querySelector('meta[name="csrf-token"]').content,
        }
    },
    name: "eventComponent",
    mounted() {
        this.getData();
        this.status = 0
    },
    methods:{
        clicked(customer){
          location.replace('/events/'+ customer.customer.id)
        },
        search(){
            axios.get('/api/get-search-customer',{
              params:{
                  name : this.find,
              }
            }).then(res =>{
                    this.laravelData = res.data
                })
        },
        groupDigit(num){
            num = Number(num)
            var str = num.toString().split('.');
            if (str[0].length >= 5) {
                str[0] = str[0].replace(/(\d)(?=(\d{3})+$)/g, '$1,');
            }
            if (str[1] && str[1].length >= 5) {
                str[1] = str[1].replace(/(\d{3})/g, '$1 ');
            }
            return str.join('.');
        },
        getData(page = 1){
            this.page = page;
            axios.get('/api/get-support?page=' + page)
                .then(res =>{
                   this.laravelData = res.data.data
                })
        },
        date(time){
            var date = JSON.parse(`{"date":"` +time+`","timezone_type":3,"timezone":"Asia/Tehran"}`);
            return    new Date(date.date).toLocaleString("fa-IR", {timeZone: date.timezone})

        },
        deleted(id){
            Swal.fire({
                title: 'آیا مطمئن هستید?',
                showDenyButton: true,
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'بله',
                denyButtonText: 'خیر',
                cancelButtonText:'لغو',
                customClass: {
                    actions: 'my-actions',
                    cancelButton: 'order-1 right-gap',
                    confirmButton: 'order-2',
                    denyButton: 'order-3',
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.delete('/events/'+id)
                        .then(res =>{
                            window.location.reload()
                        })
                    Swal.fire('انجام شد', '', 'success')
                } else if (result.isDenied) {
                    Swal.fire('لغو شد', '', 'info')
                }
            })

        }
    },

}
</script>

<style scoped>

</style>
