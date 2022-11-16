@extends('layouts.app')

@section('content')
    <div class="card-body text-right">
        <h3>ایجاد پشتیبانی جدید</h3>
        <form method="POST" action="{{ route('supports.store') }}">
            @csrf

            <div class="form-group row">
                <label for="customer_id" class="col-md-4 col-form-label text-md-left">{{ __('variable.Customer') }}</label>

                <div class="col-md-6">
                    <select id="customer_id" type="text" class="form-control @error('customer_id') is-invalid @enderror" name="customer_id"  autocomplete="user_name">
                        <option value="">{{(__('variable.Select'))}}</option>
                        @foreach($customers as $customer)
                            <option value="{{$customer->id}}">{{$customer->name}}</option>
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
                    <date-time name="start_date" class="@error('start_date') is-invalid @enderror"></date-time>
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
                    <date-time name="end_date" class="@error('end_date') is-invalid @enderror"></date-time>
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
                        <option value="0">عادی</option>
                        <option value="1">تعلیق</option>
                        <option value="2">پایان</option>
                        <option value="3">گارانتی</option>
                        <option value="4">منتظر خرید</option>
                        <option value="5">در حال بستن</option>
                    </select>
                    @error('status')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="price" class="col-md-4 col-form-label text-md-left">{{ __('variable.Price') }}</label>

                <div class="col-md-6">
                    <input id="price" type="text" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price') }}"  autocomplete="price" autofocus>

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
