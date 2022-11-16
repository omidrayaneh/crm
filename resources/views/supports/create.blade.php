@extends('layouts.app')

@section('content')
    <div class="card-body text-right">
        <h3>ایجاد پشتیبانی جدید</h3>
        <form method="POST" action="{{ route('supports.store') }}">
            @csrf

            <div class="form-group row">
                <label for="customer_id" class="col-md-4 col-form-label text-md-left">{{ __('variable.Customer') }}</label>

                <div class="col-md-6">
                    <select id="customer_id" type="text" class="form-control" name="customer_id" required autocomplete="user_name">
                        <option value="">{{(__('variable.Select'))}}</option>
                        @foreach($customers as $customer)
                            <option value="{{$customer->id}}">{{$customer->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="start-date" class="col-md-4 col-form-label text-md-left">{{ __('variable.Start_date') }}</label>

                <div class="col-md-6">
                    <date-time name="start-date"></date-time>
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
                    <date-time name="end-date"></date-time>
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
                        <option value="0">عادی</option>
                        <option value="1">تعلیق</option>
                        <option value="2">پایان</option>
                        <option value="3">گارانتی</option>
                        <option value="4">منتظر خرید</option>
                        <option value="5">در حال بستن</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="price" class="col-md-4 col-form-label text-md-left">{{ __('variable.Price') }}</label>

                <div class="col-md-6">
                    <input id="price" type="number" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price') }}" required autocomplete="price" autofocus>

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
