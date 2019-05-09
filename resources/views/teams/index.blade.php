@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="float-right">
                    <a href="/teams/invite" class="btn btn-success btn-lg">{{__('Invite to team')}}</a>
                </div>
                <h2>{{__('My team')}}</h2>
                <table class="table table-bordered table-striped">
                    <tr>
                        <th>{{__('Name')}}</th>
                        <th>{{__('Actions')}}</th>
                    </tr>
                    @if(auth()->user()->own_team)
                        @foreach(auth()->user()->own_team->users as $user)
                            <tr>
                                <td>{{ $user->profile->fullname }}</td>
                                <td>
                                    @if(auth()->user()->id != $user->id)
                                        <a href="{{ "/teams/".$user->id."/remove" }}" class="btn btn-danger"><i class="fa fa-close"></i> </a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <h2>{{__('Partner teams')}}</h2>
                <table class="table table-bordered table-striped">
                    <tr>
                        <th>{{__('Team name')}}</th>
                        <th>{{__('Actions')}}</th>
                    </tr>
                    @if(auth()->user()->teams)
                        @foreach(auth()->user()->teams as $team)
                            <tr>
                                <td>{{ $team->teamname }}</td>
                                <td>
                                    <a href="{{ "/teams/".$team->id."/leave" }}" class="btn btn-danger"><i class="fa fa-close"></i> </a>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </table>
            </div>
        </div>
    </div>
@endsection
