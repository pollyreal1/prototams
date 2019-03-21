<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Schedule;

class ScheduleController extends Controller
{

    public function index(){

        $schedule = Schedule::where('status',1)->get();

        $data = [
            'msg' => $schedule,
            'status' => 'success'
        ];

        return response()->json($data);
    }

    public function show(Request $request){

        $schedule = Schedule::where('sched_id',$request->get('sched_id'))->first();

        $data = [
            'msg' => $schedule,
            'status' => 'success'
        ];

        return response()->json($data);
    }


    /**
     * Schedule store
     *Add new Schedule
     */
    public function store(Request $request){

        // for Validation
        $validation = Validator::make($request->all(),[
            'sched_type' => 'required',
            'shift_start' => 'required|date_format:G:i:s',
            'shift_end' => 'required|date_format:G:i:s',
            'break_time' => 'required',
        ]);


        if(!$validation->fails()){
            // generate sched id
            $sched_id = mt_rand(0000, 9999);
            if($request->post('sched_type') == 1){
                // if(!empty($request->post('days'))){
                //     $array_days = [];
                //     foreach($request->post('days') as $day){
                //
                //         $array_days[] = $day;
                //
                //     }
                // }
                $array_days = [1,2,3,4,5];
            }

            $days = json_encode($array_days);
            Schedule::insert([
                'sched_id' => $sched_id,
                'sched_type' => $request->post('sched_type'),
                'shift_start' => $request->post('shift_start'),
                'shift_end' => $request->post('shift_end'),
                'min_hrs' => !empty($request->post('min_hrs'))?$request->post('min_hrs'):0,
                'break_time' => $request->post('break_time'),
                'grace_period' => !empty($request->post('grace_period'))?$request->post('grace_period'):0,
                'days' => $days,
                // 'status' => 1
                'late_monitor' => $request->post('late_monitor'),

            ]);

            $data = [
                'msg' => 'successful',
                'status' => 'success'
            ];


        }else{

            $data = [
                'msg' => $validation->errors(),
                'status' => 'failed'
            ];

        }

        return response()->json($data);

    }

    /**
     * Schedule store
     *Add new Schedule
     */
    public function update(Request $request){
        // for Validation
        $validation = Validator::make($request->all(),[
            'sched_type' => 'required',
            'shift_start' => 'required|date_format:G:i:s',
            'shift_end' => 'required|date_format:G:i:s',
            'break_time' => 'required',
            'sched_id' => 'required',
        ]);


        if(!$validation->fails()){
            if($request->post('sched_type') == 1){
                // if(!empty($request->post('days'))){
                //     $array_days = [];
                //     foreach($request->post('days') as $day){
                //
                //         $array_days[] = $day;
                //
                //     }
                // }
                $array_days = [1,2,3,4,5];

            }

            $days = json_encode($array_days);
            Schedule::where('sched_id',$request->post('sched_id'))->update([
                'sched_type' => $request->post('sched_type'),
                'shift_start' => $request->post('shift_start'),
                'shift_end' => $request->post('shift_end'),
                'min_hrs' => !empty($request->post('min_hrs'))?$request->post('min_hrs'):0,
                'break_time' => $request->post('break_time'),
                'grace_period' => !empty($request->post('grace_period'))?$request->post('grace_period'):0,
                'days' => $days,
                // 'status' => 1
                'late_monitor' => !empty($request->post('late_monitor'))?$request->post('late_monitor'): $late_monitor['late_monitor'],

            ]);

            $data = [
                'msg' => 'successful',
                'status' => 'success'
            ];

        }else{

            $data = [
                'msg' => $validation->errors(),
                'status' => 'failed'
            ];

        }

        return response()->json($data);

    }

    public function schedStatus(Request $request){

        $validation = Validator::make($request->all(),[
            'sched_id' => 'required',
        ]);

        if(!$validation->fails()){

            $late_monitor = Schedule::where('sched_id',$request->post('sched_id'))->update([
                'status' => 0
            ]);
            $data = [
                'msg' => 'successful',
                'status' => 'success'
            ];

        }else{

            $data = [
                'msg' => $validation->errors(),
                'status' => 'failed'
            ];
        }
        return response()->json($data);
    }

    public function regular(Request $request){

        // for Validation
        $validation = Validator::make($request->all(),[
            'sched_type' => 'required',
            'shift_start' => 'required|date_format:G:i:s',
            'shift_end' => 'required|date_format:G:i:s',
            'break_time' => 'required',
        ]);


        if(!$validation->fails()){
            // generate sched id
            $sched_id = mt_rand(0000, 9999);
            $days = [1,2,3,4,5];
            $min_hrs = !empty($request->post('min_hrs')) ?($request->post('min_hrs') * 60):0;
            $break_time = $request->post('break_time') * 60;


            foreach($days as $day){
                Schedule::insert([
                    'sched_id' => $sched_id,
                    'sched_type' => $request->post('sched_type'),
                    'shift_start' => $request->post('shift_start'),
                    'shift_end' => $request->post('shift_end'),
                    'min_hrs' => $min_hrs,
                    'break_time' => $break_time,
                    'grace_period' => !empty($request->post('grace_period'))?$request->post('grace_period'):0,
                    'days' => $day,
                    'late_monitor' => $request->post('late_monitor'),
                 ]);

            }

            $data = [
                'msg' => 'successful',
                'status' => 'success'
            ];


        }else{

            $data = [
                'msg' => $validation->errors(),
                'status' => 'failed'
            ];

        }
        return response()->json($data);
    }

    public function customized(Request $request){

        if(!empty($request->post('array'))){

            // generate sched id
            $sched_id = mt_rand(0000, 9999);

            foreach($request->post('array') as $day){
                $min_hrs = !empty($day['min_hrs']) ?($day['min_hrs'] * 60):0;
                $break_time = $day['break_time'] * 60;
                Schedule::insert([
                    'sched_id' => $sched_id,
                    'sched_type' =>$day['sched_type'],
                    'shift_start' => $day['shift_start'],
                    'shift_end' => $day['shift_end'],
                    'min_hrs' => $min_hrs,
                    'break_time' => $break_time,
                    'grace_period' => !empty($day['grace_period'])?$day['grace_period']:0,
                    'days' => $day['day'],
                    'late_monitor' => $day['late_monitor'],
                 ]);
            }
            $data = [
                'msg' => 'successful',
                'status' => 'success'
            ];
        }else{

            $data =[
                'msg' => 'Please input some data',
                'status' =>'failed'
            ];



        }


        return response()->json($data);
    }





}
