<template>
    <date-picker v-model="date" :name="name" :value="dt" format="YYYY-MM-DD" auto-submit
                 display-format="jYYYY/jMM/jDD"/>

</template>

<script>
import VuePersianDatetimePicker from "vue-persian-datetime-picker";

export default {
    data() {
        return {
            date: ''
        }
    },
    props: ['name', 'dt'],
    components: {
        DatePicker: VuePersianDatetimePicker
    },
    mounted() {
        if (this.dt) {
            var dt, dt1, yd, md, dd = 0
            dt = this.dt

            yd =  parseInt(dt.slice(0, 4))
            md = parseInt(dt.slice(5, 7))
            dd =  parseInt(dt.slice(8, 10))

           this.date =shamsi_be_miladi(yd, md, dd);

        }


    }

}
</script>
