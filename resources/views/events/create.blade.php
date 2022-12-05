@extends('layouts.app')

@section('content')
    <div class="card-body text-right">
        @php $cots = 0 @endphp
        <div class="row mb-2 " style="margin-top: -18px">
            <div class="text-right col-4">
                <h5> ایجاد رویداد برای<span class="red"> {{$customer->name}} </span></h5>
            </div>
            <div class="text-left col">
                <a class="btn btn-light"  href="/events">
                    <span>بازگشت</span> <i class="fa fa-backward orangeredgit "></i>
                </a>
            </div>
        </div>
        <form method="POST" action="{{ route('events.store') }}">
            @csrf
            <input type="hidden" name="customer_id" value="{{$customer->id}}" >
            <div class="form-group row">
                <label for="description" class="col-md-4 col-form-label text-md-left">{{ __('variable.Description') }}</label>

                <div class="col-md-6">
                    <textarea id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description"  autocomplete="description" autofocus>
                        {{ old('description') }}
                    </textarea>

                    @error('description')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>
            </div>


            <div class="form-group row">
                <label for="cost" class="col-md-4 col-form-label text-md-left">{{ __('variable.Cost') }}</label>

                <div class="col-md-6">
                    <input id="cost" type="text" class="form-control @error('cost') is-invalid @enderror" name="cost" value="{{ old('cost') }}"  autocomplete="cost" autofocus>
                    @error('cost')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row mb-0 text-left">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        {{ __('variable.Save') }}
                    </button>
                </div>
            </div>
        </form>
        <h4>رویدادهای <span class="greenyellow">  {{$customer->name}} </span></h4>
        <table class="table table-striped table-hover">
            <thead>
            <tr class="text-center">
                <th scope="col">#</th>
                <th scope="col">تاریخ</th>
                <th scope="col">کاربر</th>
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
                    <td>{{$event->description}}</td>
                    <td>{{number_format($event->cost)}}</td>
            </tr>
            @endforeach
            </tbody>
        </table>


    </div>
@endsection
