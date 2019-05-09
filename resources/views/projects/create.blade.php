@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <form method="post" action="/projects/create">
                    @csrf
                    <div class="form-group">
                        <label for="name">{{__('Name')}}</label>
                        <input type="text" name="name" class="form-control" id="name" value="{{ old('name') }}" />
                        @if($errors->has('name'))
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="client">{{__('Client')}}</label>
                        <select name="client" class="form-control" id="client">
                            <option disabled value="">{{__('Select client')}}</option>
                            @foreach($clients as $client)
                                <option @if(old('client')==$client->id) selected @endif value="{{ $client->id }}">{{ $client->name }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('client'))
                            <span class="text-danger">{{ $errors->first('client') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="description">{{__('Description')}}</label>
                        <textarea name="description" class="form-control" id="description">{{ old('description') }}</textarea>
                        @if($errors->has('description'))
                            <span class="text-danger">{{ $errors->first('description') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="estimation">{{__('Estimation')}}</label>
                        <input type="text" name="estimation" class="form-control" id="estimation" value="{{ old('estimation') }}" />
                        @if($errors->has('estimation'))
                            <span class="text-danger">{{ $errors->first('estimation') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success">{{__('Submit')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
