<template>
    <!-- ASSIGN SCHEDULE CARD -->
    <div class="card">
        <div class="card-header"><b>Assign Schedule</b></div>
        <div class="card-body">
            <table class="table table-striped datatable">
                <thead>
                    <tr>
                        <th></th>
                        <th>Name</th>
                        <th>Schedule</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="user,index in users">
                        <td>
                            <select name="" id="" v-model="sched_id[index]" class="form-control form-control-sm">
                                <option value="">--Select schedule--</option>
                                <option  v-for="sched in schedules" :value="sched.sched_id">{{ toHumanTime(sched.shift_start) + ' - ' + toHumanTime(sched.shift_end) }}</option>
                            </select>
                        </td>
                        <td>{{ user.name }}</td>
                        <td>
                            <span v-if="user.schedule != ''">
                                <span v-for="usched in user.schedule">{{ toHumanTime(usched.shift_start) }} {{ toHumanTime(usched.shift_end) }}</span>
                            </span>
                            <span v-else>
                                --
                            </span>
                        </td>
                        <!-- <td>{{ user.schedule }}</td> -->
                        <td>
                            <button class="btn btn-success btn-sm" @click.prevent="assignSchedule(user.id,sched_id[index])">Assign</button>
                        </td>
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
                sched_id: [],
                schedules: '',
            }
        },


        created(){
            this.getUsers();
            this.getSchedule();
        },

        updated(){
            $('.datatable').DataTable();
        },

        methods:{
            getUsers(){
                this.axiosRequest('get', this.$store.state.server_path + 'UserSchedule-index')
                .then(res => {
                    this.users = res.data.msg;
                })
                .catch(err => console.log(err));
            },

            getSchedule(){
                this.axiosRequest('get', this.$store.state.server_path + 'Schedule-index')
                .then(res => {
                    this.schedules = res.data.msg;
                })
                .catch(err => console.log(err));
            },

            assignSchedule(userid,sched_id){
                let params = {
                    user_id: userid,
                    sched_id: sched_id,
                };

                this.axiosRequest('post', this.$store.state.server_path + 'UserSchedule-store', params)
                .then(res => {
                    if(res.data.status == 'success'){
                        this.getUsers();
                        this.mixinsToastr('Assign Schedule' , "Successfully assigned schedule!");
                    }else{
                        this.mixinsToastr('Assign Schedule' , "Error on assigning of schedule!", 'error');
                    }
                })
                .catch(err => console.log(err));
            },

        },

    }

</script>
