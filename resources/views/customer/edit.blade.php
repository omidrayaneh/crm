@extends('layouts.app')

@section('content')
    <div class="card-body text-right">
        <h3>ویرایش مشتری <span class="text-danger">{{$customer->name}}</span></h3>
        <form method="post" action="{{ route('customer.update',$customer->id) }}">
            @csrf
            @method('PATCH')
            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-left">{{ __('variable.Customer_Name') }}</label>

                <div class="col-md-6">
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name',$customer->name) }}"  autocomplete="name" autofocus>

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
                    <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email',$customer->email) }}"  autocomplete="email">

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
                    <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address',$customer->address) }}"  autocomplete="address">

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
                    <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone',$customer->phone) }}"  autocomplete="phone">
                    @error('phone')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="password-confirm" class="col-md-4 col-form-label text-md-left">{{ __('variable.User_Name') }}</label>

                <div class="col-md-6">
                    <select id="user_name" type="text" class="form-control @error('user_name') is-invalid @enderror" name="user_name"  autocomplete="user_name">
                        <option value="">{{(__('variable.Select'))}}</option>
                        @foreach($users as $user)
                        <option @if($customer->user && $customer->user->id == $user->id) selected @endif value="{{$user->id}}">{{$user->name}}</option>
                        @endforeach
                    </select>
                    @error('user_name')
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
