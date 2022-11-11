@extends('layouts.app')

@section('content')
    <div class="card-body text-right">
        <h3>ویرایش همکار <span class="text-danger">{{$vendor->name}}</span></h3>
        <form method="post" action="{{ route('vendor.update',$vendor->id) }}">
            @csrf
            @method('PATCH')
            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-left">{{ __('variable.Vendor_Name') }}</label>

                <div class="col-md-6">
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name',$vendor->name) }}" required autocomplete="name" autofocus>

                    @error('name')
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
