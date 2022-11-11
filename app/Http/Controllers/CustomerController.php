<?php

namespace App\Http\Controllers;

use App\Customer;
use App\User;
use Illuminate\Http\Request;

class CustomerController extends Controller
{

    public function index()
    {
        return view('customer.index');
    }

    public function getData()
    {
        $customers = Customer::with('user')->paginate(2);
        $responce = [
            'data'=> $customers,
            'message'=>'success'
        ];
        return response()->json($responce,200);
    }

    public function create()
    {
        $users = User::all();
        return view('customer.create',compact('users'));
    }


    public function store(Request $request)
    {
        $inputs = $request->only(['name','email','address','phone','user_name']);



        $customer = new Customer();
        $customer->name = $inputs['name'];
        $customer->email = $inputs['email'];
        $customer->user_id = $inputs['user_name'];
        $customer->phone = $inputs['phone'];
        $customer->address =$inputs['address'];


        $customer->save();
        toastr()->success('ثبت شد');
        return redirect(route('customer.index'));
    }


    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $users = User::all();
        $customer = Customer::findOrFail($id);
        return view('customer.edit',compact(['customer','users']));
    }


    public function update(Request $request, $id)
    {
        $inputs = $request->only(['name','email','address','phone','user_name']);



        $customer = Customer::findOrFail($id);
        $customer->name = $inputs['name'];
        $customer->email = $inputs['email'];
        $customer->user_id = $inputs['user_name'];
        $customer->phone = $inputs['phone'];
        $customer->address =$inputs['address'];


        $customer->save();
        toastr()->success('ویرایش شد');
        return redirect(route('customer.index'));
    }


    public function destroy($id)
    {
       $customer = Customer::findOrFail($id);
       $customer->delete();
        toastr()->success('حذف شد');


    }
}
