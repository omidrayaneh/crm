<template>
<div class="card-body">
  <div class="row mb-2">
      <div class="text-right col-4">
          <input type="text" class="form-control" @input="search" v-model="find" placeholder="براساس نام مشتری یا شرح فعالیت یا تاریخ">
      </div>
      <div class="text-right col-2">
          <select id="status" type="text" class="form-control" name="status"  v-model="status">
              <option  value="0">جدید</option>
              <option value="1">در حال اجرا</option>
              <option value="2">پایان یافته</option>
          </select>
      </div>
      <div class="text-left col">
          <a class="btn btn-light"  :href="'/tasks/create'">
              <i class="fa fa-plus greenyellow"></i> جدید
          </a>
      </div>
  </div>
    <table class="table table-striped table-hover">
        <thead>
        <tr class="text-center">
            <th scope="col">#</th>
            <th scope="col">مشتری</th>
            <th scope="col">کاربر</th>
            <th scope="col">شرح فعالیت</th>
            <th scope="3">تاریخ پایان</th>
            <th scope="col">وضعیت</th>
            <th scope="col">عملیات</th>
        </tr>
        </thead>
        <tbody>
        <tr class="text-center" v-for="(task,key) in laravelData.data">
            <td v-if="page ==1" >
                {{ key + 1}}
            </td>
            <td v-else>
                {{(((page-1) *9) + key + 1)}}
            </td>
            <td >{{task.customer.name}}</td>
            <td >{{task.user.name}}</td>
            <td >{{task.description}}</td>
            <td >{{task.end_date}}</td>
            <td v-if="task.status === 0">جدید</td>
            <td v-else-if="task.status ===1">در حال احرا</td>
            <td v-else-if="task.status === 2">پایان یافته</td>
            <td>
                <a :href="'/tasks/'+task.id + '/edit'" data-toggle="tooltip"
                   data-title="ویرایش">
                    <span class="fa fa-edit blue"></span>
                </a>
                |

                <a @click="deleted(task.id)" class="deleteRecord">
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
            find :'',
            status :'',
            csrf: document.head.querySelector('meta[name="csrf-token"]').content,
        }
    },
    name: "TaskComponent",
    mounted() {
        this.getData();
        this.status = 0
    },
    methods:{
        search(){
            console.log()
            axios.get('/api/get-search-task',{
              params:{
                  description : this.find,
                  status : this.status
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
            axios.get('/api/get-task?page=' + page)
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
                    axios.delete('/tasks/'+id)
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
