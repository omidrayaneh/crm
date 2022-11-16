<?php

namespace App\Http\Controllers;

use App\Http\Requests\VendorRequired;
use App\Vendor;
use Illuminate\Http\Request;

class VendorController extends Controller
{


    public function index()
    {
        return view('vendor.index');
    }

    public function getData()
    {
        $vendors = Vendor::paginate(2);
        $responce = [
            'data'=> $vendors,
            'message'=>'success'
        ];
        return response()->json($responce,200);
    }

    public function create()
    {
        return view('vendor.create');
    }


    public function store(VendorRequired $request)
    {
        $inputs = $request->only(['name']);



        $vendor = new Vendor();
        $vendor->name = $inputs['name'];

        $vendor->save();
        toastr()->success('ثبت شد');
        return redirect(route('vendor.index'));
    }


    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $vendor = Vendor::findOrFail($id);
        return view('vendor.edit',compact(['vendor']));
    }


    public function update(VendorRequired $request, $id)
    {
        $inputs = $request->only(['name']);



        $vendor = Vendor::findOrFail($id);
        $vendor->name = $inputs['name'];

        $vendor->save();
        toastr()->success('ویرایش شد');
        return redirect(route('vendor.index'));
    }


    public function destroy($id)
    {
        $vendor = Vendor::findOrFail($id);
        $vendor->delete();
        toastr()->success('حذف شد');


    }
}
