<template>
    <!-- CREATE SCHEDULE CARD -->
    <div class="card">
        <div class="card-header"><b>Create Schedule</b></div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-12">
              <div class="col-md-2 text-center">
                  <label for=""><small><b>Type</b></small></label>
                  <select name="" id="" v-model="schedtype" class="form-control form-control-sm">
                      <option value="1">Regular Mon - Fri</option>
                      <option value="2">Flexible Mon - Fri</option>
                      <option value="3">Custom</option>
                  </select>
              </div>
            </div>
          </div>

          <!-- START OF REGULAR MON-FRI -->
          <div class="container" v-if="schedtype == 1">
            <div class="row text-center">
                <div class="col-md-2"><small><b>Shift start</b></small></div>
                <div class="col-md-2"><small><b>Shift end</b></small></div>
                <div class="col-md-2"><small><b>Work hours</b></small></div>
                <div class="col-md-2"><small><b>Break</b></small></div>
            </div>
            <div class="row">
                <div class="col-md-2">
                    <select name="" id="" v-model="shiftstart" class="form-control form-control-sm">
                        <option :value="index" v-for="index in 24">{{ (index <= 11) ? (index+':00 AM'): (index == 12) ? (12+':00 PM') : ((index-12) == 12) ? (index-12+':00 AM') : (index-12+':00 PM') }}</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="" id="" v-model="shiftend" class="form-control form-control-sm">
                        <option :value="index" v-for="index in 24">{{ (index <= 11) ? (index+':00 AM'): (index == 12) ? (12+':00 PM') : ((index-12) == 12) ? (index-12+':00 AM') : (index-12+':00 PM') }}</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="" id="" v-model="wh" class="form-control form-control-sm">
                        <option :value="index" v-for="index in twh">{{ (index == 1) ? (1 + ' hr') : (index + ' hrs')}}</option>
                    </select>
                </div>
                <div class="col-md-2 text-center">
                    <span class="form-control form-control-sm">{{ brktime }} hrs</span>
                    <input type="hidden" v-model="brktime" >
                </div>
                <div class="col-md-2">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="customCheck1" v-model="latemonitor">
                        <label class="custom-control-label" for="customCheck1">Grace Period</label>
                    </div>
                </div>
                <div class="col-md-2" v-if="latemonitor == true">
                    <select name="" id="" v-model="graceperiod" class="form-control form-control-sm">
                        <option value="5">5 mins</option>
                        <option value="10">10 mins</option>
                        <option value="15">15 mins</option>
                        <option value="20">20 mins</option>
                    </select>
                </div>
                <div class="col-md-12 mt-4">
                    <button class="btn btn-success btn-sm" @click.prevent="saveSched()"><i class="fa fa-save"></i> Save Schedule {{  }}</button>
                </div>
            </div>
          </div>
          <!-- END OF REGULAR MON-FRI -->


          <!-- START OF FLEXI -->
          <div class="container" v-if="schedtype == 2">
            <div class="row text-center">
                <div class="col-md-2"><small><b>Start range</b></small></div>
                <div class="col-md-2"><small><b>End range</b></small></div>
                <div class="col-md-2"><small><b>Work hours</b></small></div>
                <div class="col-md-2"><small><b>Break</b></small></div>
            </div>
            <div class="row">
                <div class="col-md-2">
                    <select name="" id="" v-model="shiftstart" class="form-control form-control-sm">
                        <option :value="index" v-for="index in 24">{{ (index <= 11) ? (index+':00 AM'): (index == 12) ? (12+':00 PM') : ((index-12) == 12) ? (index-12+':00 AM') : (index-12+':00 PM') }}</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="" id="" v-model="shiftend" class="form-control form-control-sm">
                        <option :value="index" v-for="index in 24">{{ (index <= 11) ? (index+':00 AM'): (index == 12) ? (12+':00 PM') : ((index-12) == 12) ? (index-12+':00 AM') : (index-12+':00 PM') }}</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="" id="" v-model="wh" class="form-control form-control-sm">
                        <option :value="index" v-for="index in twh">{{ (index == 1) ? (1 + ' hr') : (index + ' hrs')}}</option>
                    </select>
                </div>
                <div class="col-md-2 text-center">
                    <select name="" id="" v-model="brktime" class="form-control form-control-sm">
                        <option :value="index" v-for="index in brktime">{{ (index == 1) ? (1 + ' hr') : (index + ' hrs')}}</option>
                    </select>
                </div>
                <div class="col-md-12 mt-4">
                    <button class="btn btn-success btn-sm" @click.prevent="saveSched()"><i class="fa fa-save"></i> Save Schedule {{  }}</button>
                </div>
            </div>
          </div>
          <!-- END OF FLEXI -->

          <!-- START OF CUSTOM -->
          <div class="container" v-if="schedtype == 3">
            <div class="row text-center">
                <div class="col-md-2"><small><b>Day</b></small></div>
                <div class="col-md-2"><small><b>Shift start</b></small></div>
                <div class="col-md-2"><small><b>Shift end</b></small></div>
                <div class="col-md-2"><small><b>Work Hours</b></small></div>
                <div class="col-md-2"><small><b>Break</b></small></div>
            </div>
            <div class="row">
                <div class="col-md-2">
                  <select name="" id="" v-model="day" class="form-control form-control-sm">
                    <option v-for="index in 7" :value="--index">{{ toWeekDay(index) }}</option>
                  </select>
                </div>
                <div class="col-md-2">
                  <select name="" id="" v-model="shiftstart" class="form-control form-control-sm">
                      <option :value="index" v-for="index in 24">{{ (index <= 11) ? (index+':00 AM'): (index == 12) ? (12+':00 PM') : ((index-12) == 12) ? (index-12+':00 AM') : (index-12+':00 PM') }}</option>
                  </select>
                </div>
                <div class="col-md-2">
                  <select name="" id="" v-model="shiftend" class="form-control form-control-sm">
                      <option :value="index" v-for="index in 24">{{ (index <= 11) ? (index+':00 AM'): (index == 12) ? (12+':00 PM') : ((index-12) == 12) ? (index-12+':00 AM') : (index-12+':00 PM') }}</option>
                  </select>
                </div>
                <div class="col-md-2">
                  <select name="" id="" v-model="wh" class="form-control form-control-sm">
                      <option :value="index" v-for="index in twh">{{ (index == 1) ? (1 + ' hr') : (index + ' hrs')}}</option>
                  </select>
                </div>
                <div class="col-md-2 text-center">
                    <span class="form-control form-control-sm">{{ brktime }} hrs</span>
                    <input type="hidden" v-model="brktime" >
                </div>
                <div class="col-md-12 mt-4">
                  <button class="btn btn-secondary btn-sm">Add shift</button>
                </div>
                <div class="col-md-12 mt-4">
                    <button class="btn btn-success btn-sm" @click.prevent="saveSched()"><i class="fa fa-save"></i> Save Schedule {{  }}</button>
                </div>
            </div>
          </div>
          <!-- END OF CUSTOM  -->

        </div>
    </div>
    <!-- END OF CREATE SCHEDULE CARD -->
</template>

<script>

    export default{
        data(){
            return{
                schedtype: '',
                shiftstart: '',
                shiftend: '',
                graceperiod: '',
                latemonitor: '',
                wh: '',
                day: '',
                response: '',
            }
        },

        computed:{
            twh: function(){
                if(this.shiftend < this.shiftstart){
                    return Math.abs((24-this.shiftstart) + this.shiftend);
                }else{
                    return Math.abs(this.shiftend - this.shiftstart);
                }
            },

            brktime: function(){
                return this.twh - this.wh;
            },
        },

        methods:{

            saveSched(){
                    let params = {
                        sched_type: (this.schedtype == '') ? null : parseInt(this.schedtype),
                        shift_start: (this.shiftstart == '') ? (null) : (this.shiftstart+':00:00'),
                        shift_end: (this.shiftend == '') ? (null) : (this.shiftend+':00:00'),
                        min_hrs: this.wh,
                        break_time: this.brktime,
                        late_monitor: (this.latemonitor == '') ? (0) : this.latemonitor,
                        grace_period: this.graceperiod,
                    };

                    console.log({etoungparams: params});

                    this.axiosRequest('post', this.$store.state.server_path + 'Schedule-create', params)
                    .then(res => {
                        if(res.data.status == 'success'){
                            this.response = res.data;
                            this.mixinsToastr('Schedule' , "Successfully created schedule!");
                        }else{
                            this.mixinsToastr('Schedule' , "Error on creation of schedule!", 'error');
                        }
                    })
                    .catch(err => console.log(err));
            },

        }
    }

</script>
