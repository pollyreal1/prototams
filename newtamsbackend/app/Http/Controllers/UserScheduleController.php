<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Users;
use App\Schedule;
use App\User_Sched;
use Validator;


class UserScheduleController extends Controller
{


    /**
    * User Schedule index
    *return User with their schedules
    */
    public function index(){

        $user_sched = new User_Sched();
        $schedules = new Schedule();

        $user_sched = Users::get()->map(function($us) use($user_sched,$schedules) {

            $user_sched = $user_sched->where('user_id',$us['id'])->get()->pluck('sched_id');
            $user_scheds =[];
            foreach($user_sched as $sched){
                $user_scheds[] = $schedules->where('sched_id',$sched)->first();

            }
            $us['schedule'] = $user_scheds;

            return $us;
        });

        $data = [
            'msg' => $user_sched,
            'status' => 'failed'
        ];
        return response()->json($data);

    }

    public function show(Request $request){

        $user_sched = new User_Sched();
        $schedules = new Schedule();

        $user_sched = Users::where('id',$request->get('user_id'))->get()->map(function($us) use($user_sched,$schedules) {

            $user_sched = $user_sched->where('user_id',$us['id'])->get()->pluck('sched_id');
            $user_scheds =[];
            foreach($user_sched as $sched){
                $user_scheds[] = $schedules->where('sched_id',$sched)->first();

            }
            $us['schedule'] = $user_scheds;

            return $us;
        });

        $data = [
            'msg' => $user_sched,
            'status' => 'failed'
        ];
        return response()->json($data);

    }
    /**
    *User_Sched store
    *Assign of schedule to employee
    */
    public function store(Request $request){

        $validation = Validator::make($request->all(),[
            'user_id' => 'required',
            'sched_id' => 'required',
        ]);

        if(!$validation->fails()){

            if(User_Sched::where('user_id',$request->post('user_id'))->first()){
                User_Sched::where('user_id',$request->post('user_id'))->delete();
            }
                // foreach($request->post('sched_id') as $sched_id){
                    User_Sched::insert([
                        'user_id' => $request->post('user_id'),
                        'sched_id' => $request->post('sched_id'),
                    ]);
                // }


            $data = [
                'msg' => 'Successful',
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
    *User_Sched update
    *Update Employee Schedule
    */
    public function update(Request $request){

        $validation = Validator::make($request->all(),[
            'user_id' => 'required',
            'sched_id' => 'required',
        ]);
        if(!$validation->fails()){
            User_Sched::where('user_id',$request->post('user_id'))->delete();
            foreach($request->post('sched_id') as $sched_id){
                User_Sched::insert([
                    'user_id' => $request->post('user_id'),
                    'sched_id' => $sched_id,
                ]);
            }
            $data = [
                'msg' => 'Successful',
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





}
