@extends('layouts.email')

@section('content')
    <div class="container">
        <div class="header">
            <h1>Welcome !</h1>
        </div>
        <div class="content">
            <p>Hello, <b>{{ $user->email }}</b> !</p>

            <p>
                Your password has been updated successfully. If this was not you, please contact us immediately.
            </p>

            <p>
                Respectfully, the TuboQuest team.
            </p>
        </div>
        <div class="footer">
            <p>© 2024 TuboQuest Corporation. All rights reserved.</p>
        </div>
    </div>
@endsection
