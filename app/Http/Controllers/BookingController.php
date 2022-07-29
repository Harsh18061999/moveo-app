<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Booking;
use App\Models\TimeSlote;
class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bookings = Booking::with('time_solt')->paginate(6)->withQueryString();
        // dd($bookings);
        // return view('user.index',compact('users'));
        return view('booking.index',compact('bookings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('booking.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'purpose' => [
                'required',
            ],
            'select_date' => 'required',
            'sloat_time' => 'required',
        ]);
        TimeSlote::where('id',$request->sloat_time)->update([
            'status' => '1'
        ]);
        Booking::create([
            'name' => $request->name,
            'email' => $request->email,
            'purpose' => $request->purpose,
            'selected_date' => $request->select_date,
            'sloat_id' => $request->sloat_time,
        ]);
        return redirect()->route('booking.index')->with('success','Booking Added Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function sloat(Request $request){
        $date = str_replace('/', '-', $request->date);
        $day = date('l', strtotime($date));

        if($day == 'Sunday'){
            $day = 0;
        }else if($day == 'Monday'){
            $day = 1;
        }else if($day == 'Tuesday'){
            $day = 2;
        }else if($day == 'Wednesday'){
            $day = 3;
        }else if($day == 'Thursday'){
            $day = 4;
        }else if($day == 'Friday'){
            $day = 5;
        }else if($day == 'Saturday'){
            $day = 6;
        }
        
        $time = TimeSlote::where('day',$day)->where('status','0')->groupBy(['start_end_time','start_time','end_time'])->get()->toArray();
        
        return response([
            'status' => true,
            'time' => $time
        ]);
    }
}
