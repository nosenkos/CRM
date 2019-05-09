@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <form method="post" action="/projects/{{ $project->id }}">
                    {{ method_field('PUT') }}
                    @csrf
                    <div class="form-group">
                        <label for="name">{{__('Name')}}</label>
                        <input type="text" name="name" class="form-control" id="name" value="{{ $project->name }}" />
                        @if($errors->has('name'))
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="client">{{__('Client')}}</label>
                        <select name="client" class="form-control" id="client">
                            <option disabled value="">{{__('Select client')}}</option>
                            @foreach($clients as $client)
                                <option @if($project->client_id == $client->id) selected @endif value="{{ $client->id }}">{{ $client->name }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('client'))
                            <span class="text-danger">{{ $errors->first('client') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="description">{{__('Description')}}</label>
                        <textarea name="description" class="form-control" id="description">{{ $project->description }}</textarea>
                        @if($errors->has('description'))
                            <span class="text-danger">{{ $errors->first('description') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="estimation">{{__('Estimation')}}</label>
                        <input type="text" name="estimation" class="form-control" id="estimation" value="{{ $project->estimation }}" />
                        @if($errors->has('estimation'))
                            <span class="text-danger">{{ $errors->first('estimation') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="time_spent">{{__('Spent')}}</label>
                        <input type="text" name="time_spent" class="form-control" id="time_spent" value="{{ $project->time_spent }}" />
                        @if($errors->has('time_spent'))
                            <span class="text-danger">{{ $errors->first('time_spent') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="status">{{__('Status')}}</label>
                        <select name="status" class="form-control" id="status">
                            <option @if($project->status == 'ongoing') selected @endif value="ongoing">{{__('Ongoing')}}</option>
                            <option @if($project->status == 'in_progress') selected @endif value="in_progress">{{__('In progress')}}</option>
                            <option @if($project->status == 'finished') selected @endif value="finished">{{__('Finished')}}</option>
                        </select>
                        @if($errors->has('status'))
                            <span class="text-danger">{{ $errors->first('status') }}</span>
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
