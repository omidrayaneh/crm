<template>
<div class="card-body">
    <div class="text-left">
        <a class="btn btn-light"  :href="'/customer/create'">
            <i class="fa fa-plus greenyellow"></i> جدید
        </a>
    </div>
<!--    <a :href="'/'">444</a>-->
    <table class="table table-striped table-hover">
        <thead>
        <tr class="text-center">
            <th scope="col">#</th>
            <th scope="col"> نام مشتری</th>
            <th scope="col">ایمیل</th>
            <th scope="3">آدرس</th>
            <th scope="col">تلفن</th>
            <th scope="col">نام مسئول</th>
            <th scope="col">تاریخ</th>
            <th scope="col">عملیات</th>
        </tr>
        </thead>
        <tbody>
        <tr class="text-center" v-for="(customer,key) in laravelData.data">
            <td v-if="page ==1" >
                {{ key + 1}}
            </td>
            <td v-else>
                {{(((page-1) *9) + key + 1)}}
            </td>
            <td >{{customer.name}}</td>
            <td >{{customer.email}}</td>
            <td >{{customer.address}}</td>
            <td >{{customer.phone}}</td>
            <td v-if="customer.user">{{customer.user.name}}</td>
            <td v-else></td>
            <td >{{date(customer.created_at)}}</td>
            <td>
                <a :href="'/customer/'+customer.id + '/edit'" data-toggle="tooltip"
                   data-title="ویرایش">
                    <span class="fa fa-edit blue"></span>

                </a>
                |

                <a @click="deleted(customer.id)" class="deleteRecord">
                    <span class="fa fa-trash red"></span>
                </a>

            </td>
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
            page :1,
            csrf: document.head.querySelector('meta[name="csrf-token"]').content,
        }
    },
    name: "CustomerComponent",
    mounted() {
        this.getData();

    },
    methods:{
        getData(page = 1){
            this.page = page;
            axios.get('/api/get-customer?page=' + page)
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
                    axios.delete('/customer/'+id)
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
