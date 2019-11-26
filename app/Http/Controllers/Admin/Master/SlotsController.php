<?php

namespace App\Http\Controllers\Admin\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Slots;
class SlotsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $slots = Slots::all();
        return view('admin.dashboard.master.slots.index',compact('slots'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.dashboard.master.slots.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $slot = $request->slot;        
        $data = ['slot' => date('H:i:s', strtotime($slot)) ];

        $slots = Slots::all();
        if(count($slots) != 0) {
           foreach ($slots as $value) {
                $data['id'] = $value->id +1;
           }
        }
        else{
            $data['id'] = '1';
        }

        Slots::create($data);
        return redirect()->route('slots.index')->with('success','Slot Time Inserted Successfully');
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
        $slot = Slots::find($id);
        return view('admin.dashboard.master.slots.edit',compact('slot'));
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
        $slot = $request->slot;        
        $data = ['slot' => date('H:i:s', strtotime($slot)) ];
        $slotData = Slots::find($id);
        
        $slotData->update($data);
        return redirect()->route('slots.index')->with('success','Slot Time Updated Successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       Slots::find($id)->delete();
       return redirect()->back()->with('success','Slot Time Deleted Successfully');
    }
}
