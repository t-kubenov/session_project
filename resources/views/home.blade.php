@extends('layouts.app')
{{--{{dd(session())}}--}}
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
{{--            <div class="card">--}}
{{--                @if (session('status'))--}}
{{--                    <div class="alert alert-success" role="alert">--}}
{{--                        {{ session('status') }}--}}
{{--                    </div>--}}
{{--                @endif--}}
{{--                    </div>--}}
            <div class="row h3">
                <div class="col">
                    Current Session
                </div>
                <div class="col">
                    <div class=" float-end">
                        Total Active Sessions: {{ count($other_sessions) }}
                    </div>

                </div>
            </div>

            <div class="list-group">
                <a href="#" class="list-group-item list-group-item-action" aria-current="true">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">{{ $current_session->browser.' '.explode('.', $current_session->browserVersion)[0] }}</h5>
                        <small>{{ date("F j, Y, g:i a", $current_session->last_activity) }}</small>
                    </div>
                    <p class="mb-1">{{ $current_session->platform }}</p>
                    <small>{{ $current_session->ip_address }}</small>
                </a>





            @if(count($other_sessions) > 1)
                    <a href="{{ url('delete-all-sessions') }}" class="list-group-item list-group-item-danger text-center">Terminate All Other Sessions</a>
            </div>
                <div class="h3 mt-3">Active Sessions</div>

                <div class="list-group">
                    @foreach($other_sessions as $a_session)
                        @if($a_session->id != $current_session->id)
                            <a href="#" class="list-group-item list-group-item-action" aria-current="true">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">{{ $a_session->browser.' '.explode('.', $a_session->browserVersion)[0] }}</h5>
                                    <small>{{ date("F j, Y, g:i a", $a_session->last_activity) }}</small>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <p class="mb-1">{{ $a_session->platform }}</p>
                                        <small>{{ $a_session->ip_address }}</small>
                                    </div>
                                    <div class="col my-auto">
                                        <form class=" float-end" method="post" action="{{ url('delete-session') }}">
                                            @csrf
                                            <input type="hidden" id="id" name="id" class="form-control" value="{{$a_session->id}}">
                                            <button type="submit" class="btn btn-outline-danger">Terminate</button>
                                        </form>
                                    </div>
                                </div>
                            </a>
                        @endif
                    @endforeach
                </div>
            </div>
        @else
        </div>
        @endif
    </div>
</div>
@endsection
