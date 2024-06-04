<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ShipDistrict;
use Illuminate\Http\Request;
use App\Models\ShipDivision;
use App\Models\ShipDistricts;
use App\Models\ShipState;
use Carbon\Carbon;

class ShippingAreaController extends Controller
{
    public function AllDivisions()
    {
        $divisions = ShipDivision::latest()->get();
        return view('backend.ship.division.all_divisions', compact('divisions'));
    } // End Method 

    public function AddDivision()
    {
        return view('backend.ship.division.add_division');
    } // End Method 


    public function StoreDivision(Request $request)
    {

        ShipDivision::insert([
            'division_name' => $request->division_name,
        ]);

        $notification = array(
            'message' => 'ShipDivision Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.divisions')->with($notification);
    }

    public function EditDivision(Request $request)
    {

        $division = ShipDivision::findOrFail($request->id);
        return view('backend.ship.division.edit_division', compact('division'));
    } // End Method 


    public function UpdateDivision(Request $request)
    {

        $division_id = $request->id;

        ShipDivision::findOrFail($division_id)->update([
            'division_name' => strtoupper($request->division_name),
            'updated_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Province Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.divisions')->with($notification);
    } // End Method 

    public function RemoveDivision(Request $request)
    {

        ShipDivision::findOrFail($request->id)->delete();

        $notification = array(
            'message' => 'Province Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function GetDistrict($division_id)
    {
        $dist = ShipDistrict::where('division_id', $division_id)->orderBy('district_name', 'ASC')->get();
        return json_encode($dist);
    }

    public function AllStates()
    {
        $states = ShipState::latest()->get();
        return view('backend.ship.state.all_states', compact('states'));
    } // End Method 

    public function Addstate()
    {
        $divisions = ShipDivision::orderBy('division_name', 'ASC')->get();
        $districts = ShipDistrict::orderBy('district_name', 'ASC')->get();
        return view('backend.ship.state.add_state', compact('divisions', 'districts'));
    } // End Method 


    public function Storestate(Request $request)
    {

        ShipState::create([ 
            'division_id' => $request->division_id, 
            'district_id' => $request->district_id, 
            'state_name' => $request->state_name,
        ]);

       $notification = array(
            'message' => 'ShipState Created',
            'alert-type' => 'success'
        );

        return redirect()->route('all.states')->with($notification); 
    }

    public function Editstate(Request $request)
    {
        $division = ShipDivision::orderBy('division_name','ASC')->get();
        $district = ShipDistrict::orderBy('district_name','ASC')->get();
        $state = ShipState::findOrFail($request->id);
         return view('backend.ship.state.edit_state',compact('division','district','state'));
    } // End Method 


    public function Updatestate(Request $request)
    {

        $state_id = $request->id;

        Shipstate::findOrFail($state_id)->update([
            'division_id' => $request->division_id,
            'state_name' => $request->state_name,
        ]);

        $notification = array(
            'message' => 'state Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.states')->with($notification);
    } // End Method 

    public function Removestate(Request $request)
    {

        Shipstate::findOrFail($request->id)->delete();

        $notification = array(
            'message' => 'state Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function AllDistricts()
    {
        $districts = ShipDistrict::latest()->get();
        return view('backend.ship.district.all_districts', compact('districts'));
    } // End Method 

    public function AddDistrict()
    {
        $divisions = ShipDivision::orderBy('division_name', 'ASC')->get();
        return view('backend.ship.district.add_district', compact('divisions'));
    } // End Method 


    public function StoreDistrict(Request $request)
    {

        ShipDistrict::create([
            'division_id' => $request->division_id,
            'district_name' => $request->district_name,
        ]);

        $notification = array(
            'message' => 'ShipDistrict Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.districts')->with($notification);
    }

    public function EditDistrict(Request $request)
    {
        $divisions = ShipDivision::orderBy('division_name', 'ASC')->get();
        $district = ShipDistrict::findOrFail($request->id);
        return view('backend.ship.district.edit_district', compact('district', 'divisions'));
    } // End Method 


    public function UpdateDistrict(Request $request)
    {

        $district_id = $request->id;

        ShipDistrict::findOrFail($district_id)->update([
            'division_id' => $request->division_id,
            'district_name' => $request->district_name,
        ]);

        $notification = array(
            'message' => 'Town Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.districts')->with($notification);
    } // End Method 

    public function RemoveDistrict(Request $request)
    {

        ShipDistrict::findOrFail($request->id)->delete();

        $notification = array(
            'message' => 'Town Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
