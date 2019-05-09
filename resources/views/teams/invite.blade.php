@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2>{{__('Invite user to the team')}}</h2>
                <form method="post" action="/teams/invite">
                    @csrf
                    <div class="form-group">
                        <label for="email">{{__('Email')}}</label>
                        <input type="text" name="email" id="email" class="form-control" />
                    </div>
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-success btn-lg"><i class="fa fa-plane"></i> Invite user</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
