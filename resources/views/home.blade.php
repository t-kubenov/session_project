@extends('layouts.app')
{{--{{dd(session())}}--}}
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <div class="card-header">{{ __('Sessions') }}</div>

                <ul class="list-group list-group-flush">
                    @foreach($sessions as $a_session)
                        <li class="list-group-item">{{ $a_session }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
