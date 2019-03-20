<template>
    <!-- LIST OF ALL SCHEDULES -->
    <div class="card">
        <div class="card-header"><b>Created Schedules</b></div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Schedule Type</th>
                        <th>Shift Start</th>
                        <th>Shift End</th>
                        <th>Work Hours</th>
                        <th>Break</th>
                        <th>Monitor Late</th>
                        <th>Grace period</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="sched in schedules">
                        <td>{{ (sched.sched_type == 1) ? 'Mon - Fri' : null }}</td>
                        <td>{{ toHumanTime(sched.shift_start) }}</td>
                        <td>{{ toHumanTime(sched.shift_end) }}</td>
                        <td>{{ sched.min_hrs }} hour/s</td>
                        <td>{{ sched.break_time }} hour/s</td>
                        <td>{{ (sched.late_monitor == 1) ? 'Yes' : 'No' }}</td>
                        <td>{{ sched.grace_period }} Minutes</td>
                        <td><button class="btn btn-danger btn-sm" @click.prevent="deleteSched(sched.sched_id)">Delete</button></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <!-- END OF ASSIGN SCHEDULE CARD -->
</template>


<script>

    export default{
        // props: ['propSchedules'],

        data(){
            return{
                users: '',
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

            deleteSched(schedid){
                if(confirm('Do you really want to delete this schedule?')){
                    // do axios request
                    let params = {
                        sched_id:schedid,
                    };

                    this.axiosRequest('post', this.$store.state.server_path + 'Schedule-status', params)
                    .then(res => {
                        if(res.data.status == 'success'){
                            this.getSchedule();
                            this.mixinsToastr('Schedule', 'Successful deletion of schedule!');
                        }else{
                            this.mixinsToastr('Schedule', 'Error on deletion of schedule!', 'error');
                        }
                    })
                    .catch(err => console.log(err));
                }
            },

        },

    }

</script>
