@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">User Verification</div>
                <div class="panel-body">
                   Hello {{ $username }} <br/>
                   <div class="verification-status">{{ $verificationstatus }}</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
