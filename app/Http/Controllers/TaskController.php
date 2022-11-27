<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Http\Requests\TaksRequired;
use App\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        return view('tasks.index');
    }

    public function searchTask(Request $request)
    {

        $tasks =Task::with(['customer','user'])->where([['description','like','%'.$request->description.'%'],['status',$request->status]])->get();
        $responce = [
            'data'=> $tasks,
            'message'=>'success'
        ];
        return response()->json($responce,200);
    }
    public function getData()
    {
        $tasks =Task::with(['customer','user'])->where('status',0)->paginate(2);
        $responce = [
            'data'=> $tasks,
            'message'=>'success'
        ];
        return response()->json($responce,200);
    }

    public function create()
    {

        $customers = Customer::all();
        return view('tasks.create',compact('customers'));
    }


    public function store(TaksRequired $request)
    {
        $inputs = $request->only(['customer_id','end_date','status','description']);

        $support = new Task();
        $support->customer_id = $inputs['customer_id'];
        $support->user_id =auth()->id();
        $support->end_date = $inputs['end_date'];
        $support->status = $inputs['status'];
        $support->description = $inputs['description'];

        $support->save();
        toastr()->success('ثبت شد');
        return redirect(route('tasks.index'));
    }


    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $customers = Customer::all();
        $task = Task::with(['user','customer'])->findOrFail($id);
        return view('tasks.edit',compact(['task','customers']));
    }


    public function update(TaksRequired $request, $id)
    {
        $inputs = $request->only(['customer_id','end_date','status','description']);



        $support = Task::findOrFail($id);
        $support->customer_id = $inputs['customer_id'];
        $support->user_id =auth()->id();
        $support->end_date = $inputs['end_date'];
        $support->status = $inputs['status'];
        $support->description = $inputs['description'];


        $support->save();
        toastr()->success('ویرایش شد');
        return redirect(route('tasks.index'));
    }


    public function destroy($id)
    {
        $support = Task::findOrFail($id);
        $support->delete();
        toastr()->success('حذف شد');


    }
}
