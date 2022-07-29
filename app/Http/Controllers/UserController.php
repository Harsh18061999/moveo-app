<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\TimeSlote;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(){
        $users = User::where('role',3)->paginate(6)->withQueryString();
        return view('user.index',compact('users'));
    }

    public function create()
    {
        return view('user.create');
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => [
                'required',
                'min:10',             // must be at least 10 characters in length
            ],
            'start_time' => 'required|numeric|gt:0',
            'end_time' => 'required|numeric|gt:start_time',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);

        //uploade image
        if( $request->hasFile('image')) {
            $title = hexdec(uniqid());
            $file = $request->file('image');
            $img_ext = strtolower($file->getClientOriginalExtension());
            $img_name = $title.'.'.$img_ext;
            $up_location = 'image/user';
            $image_path = $up_location.'/'.$img_name;
            $file->move($up_location,$img_name);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'image' => $image_path,
            'role' => '3'
        ]);

        $diff = $request->end_time - $request->start_time;
        $request_start_time = $request->start_time;
        for($i=0;$i<($diff*2);$i++){
            
            if($i == 0){
                $start_time = $request_start_time.':00';
                $end_time = $request_start_time.':30';
            }else if($i % 2 == 0){
                $start_time = $request_start_time.':00';
                $end_time = $request_start_time.':30';
            }else{
                $start_time = $request_start_time.':30';
                $end_time = ($request_start_time+1).':00';
                $request_start_time = $request_start_time+1;
            }

            TimeSlote::create([
                'user_id' => $user->id,
                'day' => $request->day,
                'start_end_time' => $request->start_time.':'.$request->end_time,
                'start_time' => $start_time,
                'end_time' => $end_time
            ]);
        }
        return redirect()->route('user.index')->with('success','User Added Successfully.');
    }

    public function show($id)
    {
        $user = User::with('time_solt')->where('id',$id)->first();
       
        $day = isset($user->time_solt->day) ? ($user->time_solt->day) : '';
        $time = isset($user->time_solt->start_end_time) ? explode(":",$user->time_solt->start_end_time) : [];
        $start = '';
        $end = '';

        if(count($time) > 0){
            $start = $time[0];
            $end = $time[1];
        }
        return view('user.edit',compact('user','start','end','day'));
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, User $user)
    {
        //delete existing iamge and upload new image
        $user_id = $user->id;
        if( $request->hasFile('image')) {
            $user->image ? unlink($user->image) : '';
            $title = hexdec(uniqid());
            $file = $request->file('image');
            $img_ext = strtolower($file->getClientOriginalExtension());
            $img_name = $title.'.'.$img_ext;
            $up_location = 'image/user';
            $image_path = $up_location.'/'.$img_name;
            $file->move($up_location,$img_name);
        }else{
            $image_path = $user->image;
        }

        TimeSlote::where('user_id',$user->id)->delete();

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'image' => $image_path,
            'role' => '3'
        ]);

        $user = User::where('id',$user_id)->first();
        $diff = $request->end_time - $request->start_time;
        $request_start_time = $request->start_time;
        for($i=0;$i<($diff*2);$i++){
            
            if($i == 0){
                $start_time = $request_start_time.':00';
                $end_time = $request_start_time.':30';
            }else if($i % 2 == 0){
                $start_time = $request_start_time.':00';
                $end_time = $request_start_time.':30';
            }else{
                $start_time = $request_start_time.':30';
                $end_time = ($request_start_time+1).':00';
                $request_start_time = $request_start_time+1;
            }

            TimeSlote::create([
                'user_id' => $user->id,
                'day' => $request->day,
                'start_end_time' => $request->start_time.':'.$request->end_time,
                'start_time' => $start_time,
                'end_time' => $end_time
            ]);
        }

        return redirect()->route('user.index')->with('success','User Updated Successfully.');
    }

    public function destroy(User $user)
    {
        $user->image ? unlink($user->image) : '';
        TimeSlote::where('user_id',$user->id)->delete();
        $user->delete();
        return redirect()->route('user.index')->with('success','User Deleted Successfully.');
    }

    //register
    public function register(){
        return view('register');
    }

    public function userRegister(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => [
                'required',
                'min:10',             // must be at least 10 characters in length
            ],
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);

        //uploade image
        if( $request->hasFile('image')) {
            $title = hexdec(uniqid());
            $file = $request->file('image');
            $img_ext = strtolower($file->getClientOriginalExtension());
            $img_name = $title.'.'.$img_ext;
            $up_location = 'image/user';
            $image_path = $up_location.'/'.$img_name;
            $file->move($up_location,$img_name);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'image' => $image_path,
            'role' => '2'
        ]);

        return redirect()->route('dashboard');
    }
}
