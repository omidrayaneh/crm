<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Http\Requests\SupportRequired;
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
        $cost1 = Support::sum('price1');
        $cost2 = Support::sum('price2');
        $supports =Support::with(['user','customer'])->paginate(2);
        $responce = [
            'data'=> $supports,
            'cost1'=> $cost1,
            'cost2'=> $cost2,
            'message'=>'success'
        ];
        return response()->json($responce,200);
    }

    public function create()
    {

        $customers = Customer::all();
        return view('supports.create',compact('customers'));
    }


    public function store(SupportRequired $request)
    {
        $inputs = $request->only(['customer_id','start_date','end_date','status','price1','price2']);

        $support = new Support();
        $support->customer_id = $inputs['customer_id'];
        $support->user_id =auth()->id();
        $support->start_date = $inputs['start_date'];
        $support->end_date = $inputs['end_date'];
        $support->status = $inputs['status'];
        $support->price1 = $inputs['price1'];
        $support->price2 = $inputs['price2'];

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


    public function update(SupportRequired $request, $id)
    {
        $inputs = $request->only(['customer_id','start_date','end_date','status','price1','price2']);



        $support = Support::findOrFail($id);
        $support->customer_id = $inputs['customer_id'];
        $support->user_id =auth()->id();
        $support->start_date = $inputs['start_date'];
        $support->end_date = $inputs['end_date'];
        $support->status = $inputs['status'];
        $support->price1 = $inputs['price1'];
        $support->price2 = $inputs['price2'];


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
