<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Support;
use Illuminate\Http\Request;

class SupportController extends Controller
{

    public function index()
    {
        return view('supports.index');
    }

    public function getData()
    {
        $supports =Support::with(['user','customer'])->paginate(2);
        $responce = [
            'data'=> $supports,
            'message'=>'success'
        ];
        return response()->json($responce,200);
    }

    public function create()
    {

        $customers = Customer::all();
        return view('supports.create',compact('customers'));
    }


    public function store(Request $request)
    {
        $inputs = $request->only(['customer_id','start-date','end-date','status','price']);

        $support = new Support();
        $support->customer_id = $inputs['customer_id'];
        $support->user_id =auth()->id();
        $support->start_date = $inputs['start-date'];
        $support->end_date = $inputs['end-date'];
        $support->status = $inputs['status'];
        $support->price = $inputs['price'];

        $support->save();
        toastr()->success('ثبت شد');
        return redirect(route('supports.index'));
    }


    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $customers = Customer::all();
        $support = Support::with(['user','customer'])->findOrFail($id);
        return view('supports.edit',compact(['support','customers']));
    }


    public function update(Request $request, $id)
    {
        $inputs = $request->only(['customer_id','start-date','end-date','status','price']);



        $support = Support::findOrFail($id);
        $support->customer_id = $inputs['customer_id'];
        $support->user_id =auth()->id();
        $support->start_date = $inputs['start-date'];
        $support->end_date = $inputs['end-date'];
        $support->status = $inputs['status'];
        $support->price = $inputs['price'];


        $support->save();
        toastr()->success('ویرایش شد');
        return redirect(route('supports.index'));
    }


    public function destroy($id)
    {
        $support = Support::findOrFail($id);
        $support->delete();
        toastr()->success('حذف شد');


    }
}
