@extends('layouts.app')

@section('content')
    <div class="card-body text-right">
        <div class="row mb-2 " style="margin-top: -18px">
            <div class="text-right col-4">
                <h5> رویداد ها</h5>
            </div>
        </div>
        <table class="table table-striped table-hover">
            <thead>
            <tr class="text-center">
                <th scope="col">#</th>
                <th scope="col">تاریخ</th>
                <th scope="col">کاربر</th>
                <th scope="col">مشتری</th>
                <th scope="col">شرح</th>
                <th scope="col">هزینه</th>
            </tr>
            </thead>
            <tbody>
            @foreach($events as $key=>$event)
            <tr class="text-center">
                <td>{{$key+1}}</td>

                <td>{{Morilog\Jalali\Jalalian::fromDateTime($event->created_at)}}</td>
                    <td>{{$event->user->name}}</td>
                    <td>{{$event->customer->name}}</td>
                    <td>{{$event->description}}</td>
                    <td>{{number_format($event->cost)}}</td>
            </tr>
            @endforeach
            </tbody>
        </table>
{{--        <br>--}}
{{--        <div class="row mb-2 ml-5 " style="margin-top: -18px">--}}

{{--            <div class="text-left col">--}}
{{--                <span> جمع کل : </span> <span class="orangered"> {{number_format($costs)}} </span>--}}
{{--            </div>--}}
{{--        </div>--}}

    </div>
@endsection
