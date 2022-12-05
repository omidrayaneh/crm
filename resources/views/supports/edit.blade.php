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
                    <select id="customer_id" type="text" class="form-control  @error('customer_id') is-invalid @enderror" name="customer_id"  autocomplete="customer_id">
                        <option value="">{{(__('variable.Select'))}}</option>
                        @foreach($customers as $customer)
                            <option @if($customer->id == $support->customer_id) selected @endif value="{{$customer->id}}">{{$customer->name}}</option>
                        @endforeach
                    </select>
                    @error('customer_id')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="start_date" class="col-md-4 col-form-label text-md-left">{{ __('variable.Start_date') }}</label>

                <div class="col-md-6">
                    <date-time name="start_date" :dt="'{{$support->start_date}}'" class=" @error('start_date') is-invalid @enderror"></date-time>
                    @error('start_date')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="end_date" class="col-md-4 col-form-label text-md-left">{{ __('variable.End_date') }}</label>

                <div class="col-md-6">
                    <date-time name="end_date" :dt="'{{$support->end_date}}'" class="@error('end_date') is-invalid @enderror"></date-time>
                    @error('end_date')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>
            </div>


            <div class="form-group row">
                <label for="status" class="col-md-4 col-form-label text-md-left">{{ __('variable.Status') }}</label>

                <div class="col-md-6">
                    <select id="status" type="text" class="form-control @error('status') is-invalid @enderror" name="status"  autocomplete="user_name">
                        <option value="">{{(__('variable.Select'))}}</option>
                        <option @if($support->status ==0) selected @endif value="0">عادی</option>
                        <option @if($support->status ==1) selected @endif value="1">تعلیق</option>
                        <option @if($support->status ==2) selected @endif value="2">پایان</option>
                        <option @if($support->status ==3) selected @endif value="3">گارانتی</option>
                        <option @if($support->status ==4) selected @endif value="4">منتظر خرید</option>
                        <option @if($support->status ==5) selected @endif value="5">در حال بستن</option>
                    </select>
                    @error('status')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="price1" class="col-md-4 col-form-label text-md-left">{{ __('variable.Price1') }}</label>
                <div class="col-md-6">
                    <input id="price1" type="text" class="form-control @error('price1') is-invalid @enderror" name="price1" value="{{ old('price1',$support->price1) }}"  autocomplete="price1" autofocus>

                    @error('price1')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="price2" class="col-md-4 col-form-label text-md-left">{{ __('variable.price2') }}</label>
                <div class="col-md-6">
                    <input id="price2" type="text" class="form-control @error('price2') is-invalid @enderror" name="price2" value="{{ old('price2',$support->price2) }}"  autocomplete="price2" autofocus>

                    @error('price2')
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
