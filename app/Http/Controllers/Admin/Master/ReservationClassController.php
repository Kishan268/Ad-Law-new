<?php

namespace App\Http\Controllers\Admin\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ReservationClass;
class ReservationClassController extends Controller
{

    public function index()
    {   
        $reservations = ReservationClass::all();
        return view('admin.dashboard.master.reservation_class.index',compact('reservations'));
    }

  
    public function create()
    {
        return view('admin.dashboard.master.reservation_class.create');
    }

    
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|max:100|min:1',
        ]);

        $reservations = ReservationClass::all();
        if(count($reservations) !=0){
            foreach ($reservations as $value) {
                $data['id'] = $value->id + 1;
            }
        }
        else{
            $data['id'] = '1';
        }

        ReservationClass::create($data);

        return redirect()->route('reservation.index')->with('success', 'Reservation Class Inserted Successfully');
    }

  
    public function edit($id)
    {
        $reservation = ReservationClass::find($id);
        return view('admin.dashboard.master.reservation_class.edit',compact('reservation'));
    }

  
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required|max:100|min:1',
        ]);
        ReservationClass::find($id)->update($data);
        return redirect()->route('reservation.index')->with('success', 'Reservation Class Updated Successfully');
    }

    
    public function destroy($id)
    {
        ReservationClass::find($id)->delete();
        return redirect()->back()->with('success', 'Reservation Class Deleted Successfully');
    }
}
