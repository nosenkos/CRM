@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <a href="/projects/create" class="float-right btn btn-success">{{__('Create project')}}</a>
                <h1>{{__('Projects')}}</h1>
                <table class="table table-bordered table-striped">
                    <tr>
                        <th>{{__('Name')}}</th>
                        <th>{{__('Client')}}</th>
                        <th>{{__('Estimation')}}</th>
                        <th>{{__('Spent')}}</th>
                        <th>{{__('Status')}}</th>
                        <th>{{__('Created')}}</th>
                        <th>{{__('Actions')}}</th>
                    </tr>
                    @if($projects->count())
                        @foreach($projects as $project)
                            <tr>
                                <td>{{ $project->name }}</td>
                                <td>{{ $project->client->name }}</td>
                                <td>{{ $project->estimation }}</td>
                                <td>{{ $project->time_spent }}</td>
                                <td>{{ $project->statusForHumans }}</td>
                                <td>{{ $project->created_at }}</td>
                                <td>
                                    <a href="/projects/{{ $project->id }}" class="btn btn-info"><i class="fa fa-eye"></i></a>
                                    <a href="/projects/{{ $project->id }}/edit" class="btn btn-warning"><i class="fa fa-pencil"></i></a>
                                    <form method="post" action="/projects/{{ $project->id }}" style="display: inline">
                                        @csrf
                                        {{ method_field('DELETE') }}
                                        <button type="submit" class="btn btn-danger"><i class="fa fa-close"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @else
                    @endif
                </table>
            </div>
        </div>
    </div>
@endsection
