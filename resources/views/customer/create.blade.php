@extends('layouts.app')

@section('content')
    <div class="card-body text-right">
        <h3>ایجاد مشتری جدید</h3>
        <form method="POST" action="{{ route('customer.store') }}">
            @csrf

            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-left">{{ __('variable.Customer_Name') }}</label>

                <div class="col-md-6">
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                    @error('name')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="email" class="col-md-4 col-form-label text-md-left">{{ __('variable.Email') }}</label>

                <div class="col-md-6">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                    @error('email')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="password" class="col-md-4 col-form-label text-md-left">{{ __('variable.Address') }}</label>

                <div class="col-md-6">
                    <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" required autocomplete="address">

                    @error('address')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="password-confirm" class="col-md-4 col-form-label text-md-left">{{ __('variable.Phone') }}</label>

                <div class="col-md-6">
                    <input id="phone" type="text" class="form-control" name="phone" required autocomplete="phone">
                </div>
            </div>
            <div class="form-group row">
                <label for="password-confirm" class="col-md-4 col-form-label text-md-left">{{ __('variable.User_Name') }}</label>

                <div class="col-md-6">
                    <select id="user_name" type="text" class="form-control" name="user_name" required autocomplete="user_name">
                        <option value="">{{(__('variable.Select'))}}</option>
                        @foreach($users as $user)
                        <option value="{{$user->id}}">{{$user->name}}</option>
                        @endforeach
                    </select>
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
