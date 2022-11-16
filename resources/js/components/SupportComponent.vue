<template>
<div class="card-body">
    <div class="text-left">
        <a class="btn btn-light"  :href="'/supports/create'">
            <i class="fa fa-plus greenyellow"></i> جدید
        </a>
    </div>
<!--    <a :href="'/'">444</a>-->
    <table class="table table-striped table-hover">
        <thead>
        <tr class="text-center">
            <th scope="col">#</th>
            <th scope="col">مشتری</th>
            <th scope="col">کاربر</th>
            <th scope="col">تاریخ شروع</th>
            <th scope="3">تاریخ پایان</th>
            <th scope="col">وضعیت</th>
            <th scope="col">مبلغ</th>
        </tr>
        </thead>
        <tbody>
        <tr class="text-center" v-for="(support,key) in laravelData.data">
            <td v-if="page ==1" >
                {{ key + 1}}
            </td>
            <td v-else>
                {{(((page-1) *9) + key + 1)}}
            </td>
            <td >{{support.customer.name}}</td>
            <td >{{support.user.name}}</td>
            <td >{{support.start_date}}</td>
            <td >{{support.end_date}}</td>
            <td v-if="support.status === 0">عادی</td>
            <td v-else-if="support.status ===1">تعلیق</td>
            <td v-else-if="support.status === 2">پایان</td>
            <td v-else-if="support.status === 3">گارانتی</td>
            <td v-else-if="support.status === 4">منتظر خرید</td>
            <td v-else-if="support.status === 5">در حال بستن</td>
            <td >{{groupDigit(support.price)}}</td>
            <td>
                <a :href="'/supports/'+support.id + '/edit'" data-toggle="tooltip"
                   data-title="ویرایش">
                    <span class="fa fa-edit blue"></span>
                </a>
                |

                <a @click="deleted(support.id)" class="deleteRecord">
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
                    axios.delete('/supports/'+id)
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
