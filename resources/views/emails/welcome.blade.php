@extends('layouts.email')

@section('content')
    <div class="container">
        <div class="header">
            <h1>Welcome !</h1>
        </div>
        <div class="content">
            <p>Hello, <b>${user->email}</b> !</p>

            <p>
                We are pleased to welcome you to the Tubopark application. We are excited to have you on board and look
                forward to seeing you around.
            </p>

            <p>
                Respectfully, the TuboQuest team.
            </p>

            <img src="" alt="tuboquest logo" />
        </div>
        <div class="footer">
            <p>© 2024 TuboQuest Corporation. All rights reserved.</p>
        </div>
    </div>
@endsection
