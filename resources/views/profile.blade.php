@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="profile_image text-center">
                    <img width="150px" src="{{ auth()->user()->profile->profile_image->profile->url }}" class="rounded-circle" />
                </div>
                <form method="post" action="/profile" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="firstname">{{__('Firstname')}}</label>
                        <input type="text" name="firstname" id="firstname" value="{{ auth()->user()->profile->firstname }}" class="form-control" />
                        @if($errors->has('firstname'))
                            <span class="text-danger">{{ $errors->first('firstname') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="lastname">{{__('Lastname')}}</label>
                        <input type="text" name="lastname" id="lastname" value="{{ auth()->user()->profile->lastname }}" class="form-control" />
                        @if($errors->has('lastname'))
                            <span class="text-danger">{{ $errors->first('lastname') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="gender">{{__('Gender')}}</label>
                        <select name="gender" class="form-control">
                            <option @if(auth()->user()->profile->gender == 'not_defined') selected @endif value="not_defined">{{__('Not defined')}}</option>
                            <option @if(auth()->user()->profile->gender == 'male') selected @endif value="male">{{__('Male')}}</option>
                            <option @if(auth()->user()->profile->gender == 'female') selected @endif value="female">{{__('Female')}}</option>
                            <option @if(auth()->user()->profile->gender == 'alien') selected @endif value="alien">{{__('Alien')}}</option>
                        </select>
                        @if($errors->has('gender'))
                            <span class="text-danger">{{ $errors->first('gender') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="phone">{{__('Phone')}}</label>
                        <input type="text" name="phone" id="phone" class="form-control" value="{{ auth()->user()->profile->phone }}" />
                        @if($errors->has('phone'))
                            <span class="text-danger">{{ $errors->first('phone') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="address">{{__('Address')}}</label>
                        <textarea name="address" id="address" class="form-control">{{ auth()->user()->profile->address }}</textarea>
                        @if($errors->has('address'))
                            <span class="text-danger">{{ $errors->first('address') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="profile_image">{{__('Profile image')}}</label>
                        <input type="file" name="profile_image" id="profile_image" class="form-control" />
                        @if($errors->has('profile_image'))
                            <span class="text-danger">{{ $errors->first('profile_image') }}</span>
                        @endif
                    </div>
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-success btn-lg">{{__('Update profile')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
