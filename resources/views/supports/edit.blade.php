@extends('layouts.app')

@section('content')
    <div class="card-body text-right">
        <h3>ویرایش پشتیبانی <span class="text-danger">{{$support->customer->name}}</span></h3>
        <form method="post" action="{{ route('supports.update',$support->id) }}">
            @csrf
            @method('PATCH')
            <div class="form-group row">
                <label for="customer_id" class="col-md-4 col-form-label text-md-left">{{ __('variable.Customer') }}</label>

                <div class="col-md-6">
                    <select id="customer_id" type="text" class="form-control" name="customer_id" required autocomplete="user_name">
                        <option value="">{{(__('variable.Select'))}}</option>
                        @foreach($customers as $customer)
                            <option @if($customer->id == $support->customer_id) selected @endif value="{{$customer->id}}">{{$customer->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="start-date" class="col-md-4 col-form-label text-md-left">{{ __('variable.Start_date') }}</label>

                <div class="col-md-6">
                    <date-time name="start-date" :dt="'{{$support->start_date}}'"></date-time>
                    @error('start-date')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="end-date" class="col-md-4 col-form-label text-md-left">{{ __('variable.End_date') }}</label>

                <div class="col-md-6">
                    <date-time name="end-date" :dt="'{{$support->end_date}}'"></date-time>
                    @error('end-date')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>
            </div>


            <div class="form-group row">
                <label for="status" class="col-md-4 col-form-label text-md-left">{{ __('variable.Status') }}</label>

                <div class="col-md-6">
                    <select id="status" type="text" class="form-control" name="status" required autocomplete="user_name">
                        <option value="">{{(__('variable.Select'))}}</option>
                        <option @if($support->status ==0) selected @endif value="0">عادی</option>
                        <option @if($support->status ==1) selected @endif value="1">تعلیق</option>
                        <option @if($support->status ==2) selected @endif value="2">پایان</option>
                        <option @if($support->status ==3) selected @endif value="3">گارانتی</option>
                        <option @if($support->status ==4) selected @endif value="4">منتظر خرید</option>
                        <option @if($support->status ==5) selected @endif value="5">در حال بستن</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="price" class="col-md-4 col-form-label text-md-left">{{ __('variable.Price') }}</label>
                <div class="col-md-6">
                    <input id="price" type="number" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price',$support->price) }}" required autocomplete="price" autofocus>

                    @error('price')
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

    </div>
@endsection
