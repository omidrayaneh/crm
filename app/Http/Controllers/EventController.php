<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Event;
use App\Http\Requests\EventRequest;
use App\Support;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EventController extends Controller
{
    public function index()
    {
        return view('events.index');

    }
    public function searchEvent(Request $request)
    {

        $customers =Support::with('customer')->whereHas('customer' , function (Builder  $q) use ($request) {
                 $q->where('name','like','%'.$request->name.'%');
        })->get();

        $responce = [
            'data'=> $customers,
            'message'=>'success'
        ];
        return response()->json($responce,200);
    }
    public function getData()
    {
        $supports = Support::paginate(2);
        $responce = [
            'data'=> $supports,
            'message'=>'success'
        ];
        return response()->json($responce,200);
    }
    public function create()
    {

    }



    public function store(EventRequest $request)
    {
        $inputs = $request->only(['description','cost','customer_id']);

        $event = new Event();
        $event->user_id = auth()->id();
        $event->customer_id = $request['customer_id'];
        $event->cost = $request['cost'];
        $event->description = $request['description'];

        $event->save();

        toastr()->success('ثبت شد');
        $customer =  Customer::findOrFail($request['customer_id']);
        $user = auth()->user()->name;
        $events = Event::where('customer_id',$request['customer_id'])->paginate(2);
      //  return view('events.create',compact(['customer','user','events']));
       return redirect()->back();
    }

    public function show( $id)
    {
        $costs = Event::where('customer_id',$id)->sum('cost');
       $customer =  Customer::findOrFail($id);
       $user = auth()->user()->name;
       $events = Event::with('user')->where('customer_id',$id)->orderBy('id','desc')->get();
       return view('events.create',compact(['customer','user','events','costs']));
    }


    public function edit(Request $request)
    {
        //
    }


    public function update(Request $request, Event $event)
    {
        //
    }


    public function destroy(Event $event)
    {
        //
    }
}
