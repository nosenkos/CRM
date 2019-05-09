@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>{{ $project->name }}</h1>
                <p>
                    {!! $project->description !!}
                </p>
                <ul class="list-unstyled">
                    <li><strong>{{ __('Client') }}</strong>: {{ $project->client->name }}</li>
                    <li><strong>{{ __('Estimation') }}</strong>: {{ $project->estimation }}</li>
                    <li><strong>{{ __('Spent') }}</strong>: {{ $project->time_spent }}</li>
                    <li><strong>{{ __('Created') }}</strong>: {{ $project->created_at }}</li>
                    <li><strong>{{ __('Updated') }}</strong>: {{ $project->updated_at }}</li>
                    <li><strong>{{ __('Status') }}</strong>: {{ $project->statusForHumans }}</li>
                </ul>
            </div>
        </div>
    </div>
@endsection
