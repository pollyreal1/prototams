<template>
    <!-- LIST OF ALL SCHEDULES -->
    <div class="card">
        <div class="card-header"><b>Created Schedules</b></div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th></th>
                        <th>Schedule Type</th>
                        <th>Shift Start</th>
                        <th>Shift End</th>
                        <th>Work Hours</th>
                        <th>Break</th>
                        <th>Monitor Late</th>
                        <th>Grace period</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="sched in schedules">
                        <td></td>
                        <td>{{ (sched.sched_type == 1) ? 'Mon - Fri' : null }}</td>
                        <td>{{ toHumanTime(sched.shift_start) }}</td>
                        <td>{{ toHumanTime(sched.shift_end) }}</td>
                        <td>{{ sched.min_hrs }} hour/s</td>
                        <td>{{ sched.break_time }} hour/s</td>
                        <td>{{ (sched.late_monitor == 1) ? 'Yes' : 'No' }}</td>
                        <td>{{ sched.grace_period }} Minutes</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <!-- END OF ASSIGN SCHEDULE CARD -->
</template>


<script>

    export default{
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

        },

    }

</script>
