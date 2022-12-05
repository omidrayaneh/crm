@extends('layouts.app')

@section('content')
    <div class="card-body text-right">
        <h3>ویرایش پشتیبانی <span class="text-danger">{{$task->customer->name}}</span></h3>
        <form method="post" action="{{ route('tasks.update',$task->id) }}">
            @csrf
            @method('PATCH')
            <div class="form-group row">
                <label for="customer_id" class="col-md-4 col-form-label text-md-left">{{ __('variable.Customer') }}</label>
                <div class="col-md-6">
                    <select id="customer_id" type="text" class="form-control  @error('customer_id') is-invalid @enderror" name="customer_id"  autocomplete="customer_id">
                        <option value="">{{(__('variable.Select'))}}</option>
                        @foreach($customers as $customer)
                            <option @if($task->customer->id == $customer->id) selected @endif value="{{$customer->id}}">{{$customer->name}}</option>
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
                <label for="description" class="col-md-4 col-form-label text-md-left">{{ __('variable.Description') }}</label>

                <div class="col-md-6">
                    <textarea id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description"  autocomplete="description" autofocus>{{ old('description',$task->description) }}</textarea>

                    @error('description')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="end_date" class="col-md-4 col-form-label text-md-left">{{ __('variable.End_date') }}</label>

                <div class="col-md-6">
                    <date-time name="end_date" :dt="'{{$task->end_date}}'" class="@error('end_date') is-invalid @enderror"></date-time>
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
                        <option @if($task->status ==0) selected @endif value="0">جدید</option>
                        <option @if($task->status ==1) selected @endif value="1">در حال اجرا</option>
                        <option @if($task->status ==2) selected @endif value="2">پایان یافته</option>
                    </select>
                    @error('status')
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
