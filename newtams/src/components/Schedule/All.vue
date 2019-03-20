<template>
    <div class="container">

        <!-- CREATE SCHEDULE  -->
        <div class="row mt-4">
            <div class="col-md-12 mx-auto">
                <button class="btn btn-primary" @click.prevent="redirect('schedulecreate')">Add Schedule</button>
            </div>
            <div class="col-md-12 mx-auto">
                <!-- <CreateSchedule></CreateSchedule> -->
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-12 mx-auto">
                <IndexSchedule></IndexSchedule>
            </div>
        </div>

        <!-- ASSIGN SCHEDULE  -->
        <div class="row mt-4">

            <div class="col-md-8 mx-auto">
                <AssignSchedule></AssignSchedule>
            </div>

        </div>
    </div>
</template>

<script>
    // import createSchedule from '@/components/Schedule/Create'
    import assignSchedule from '@/components/Schedule/Assign'
    import indexSchedule from '@/components/Schedule/Index'

    export default{
        components:{
            // 'CreateSchedule': createSchedule,
            'AssignSchedule': assignSchedule,
            'IndexSchedule': indexSchedule,
        },

        data(){
            return{
                schedules: '',
            }
        },

        created(){
            this.getSchedule();
        },

        methods:{

            getSchedule(){
                this.axiosRequest('get', this.$store.state.server_path + 'Schedule-index')
                .then(res => {
                    this.schedules = res.data.msg;
                })
                .catch(err => console.log(err));
            },

        }
    }

</script>
