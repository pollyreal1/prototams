<template>
    <!-- CREATE SCHEDULE CARD -->
    <div class="card">
        <div class="card-header"><b>Create Schedule</b></div>
        <div class="card-body">
          <!-- <div class="row">
            <div class="col-md-12">
              <div class="col-md-2">
                  <label for=""><b>Type</b></label>
                  <select name="" id="" v-model="schedtype" class="form-control form-control-sm">
                      <option value="1">Regular Mon - Fri</option>
                      <option value="2">Flexible</option>
                      <option value="3">Custom</option>
                  </select>
              </div>
            </div>
          </div> -->
            <div class="row text-center">
                <div class="col-md-2"><small><b>Type</b></small></div>
                <div class="col-md-3"><small><b>Shift start</b></small></div>
                <div class="col-md-3"><small><b>Shift end</b></small></div>
                <div class="col-md-2"><small><b>Work hours</b></small></div>
                <div class="col-md-2"><small><b>Break</b></small></div>
            </div>
            <div class="row">
                <div class="col-md-2">
                    <select name="" id="" v-model="schedtype" class="form-control form-control-sm">
                        <option value="1">Regular Mon - Fri</option>
                        <option value="2">Flexible</option>
                        <option value="3">Custom</option>
                    </select>
                </div>
                <!-- START OF OTHER FIELDS -->
                <div class="col-md-3">
                    <select name="" id="" v-model="shiftstart" class="form-control form-control-sm">
                        <option :value="((index / 4) * 60)" v-for="index in 96">{{ toHumanTime(timeConvert((index / 4) * 60)) }}</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <select name="" id="" v-model="shiftend" class="form-control form-control-sm">
                        <option :value="((index / 4) * 60)" v-for="index in 96">{{ toHumanTime(timeConvert((index / 4) * 60)) }}</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="" id="" v-model="wh" class="form-control form-control-sm">
                        <option :value="index" v-for="index in twh/15">{{ timeConvertToHuman((index / 4) * 60) }}</option>
                    </select>
                </div>
                <div class="col-md-2 text-center">
                    <span class="form-control form-control-sm">{{ brktime }} hrs</span>
                    <input type="hidden" v-model="brktime" >
                </div>
                <div class="col-md-2 offset-md-2 mt-2">
                    <label for=""><small><b>Monitor late</b></small></label>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="customCheck1" v-model="latemonitor">
                        <label class="custom-control-label" for="customCheck1">Yes</label>
                    </div>
                </div>
                <div class="col-md-2 mt-2" v-if="latemonitor == true">
                    <label for=""><small><b>Grace Period</b></small></label>
                    <select name="" id="" v-model="graceperiod" class="form-control form-control-sm">
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="15">15</option>
                        <option value="20">20</option>
                    </select>
                </div>
                <div class="col-md-12 mt-4">
                    <button class="btn btn-success btn-sm" @click.prevent="saveSched()"><i class="fa fa-save"></i> Save Schedule {{  }}</button>
                </div>
                <div class="col-md-12">
                  {{ shiftstart }} - {{ shiftend }}
                  <br>
                  {{ twh }}
                </div>
                <!-- END OF OTHER FIELDS -->

            </div>
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
                response: '',
            }
        },

        computed:{
            twh: function(){
                if(this.shiftend < this.shiftstart){
                  // return Math.abs((this.shiftstart + this.shiftend) - (this.shiftstart- this.shiftend));
                    return Math.abs((this.shiftstart / 60) - ((this.shiftstart + this.shiftend) / 60));
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
