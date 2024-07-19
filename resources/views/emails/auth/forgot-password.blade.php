@extends('layouts.email')

@section('content')
    <div class="container">
        <div class="header">
            <h1>Welcome !</h1>
        </div>
        <div class="content">
            <p>Hello, <b>${user->email}</b> !</p>

            <p>
                We are sorry to hear that you have forgotten your password. Please use the following to code to reset your
                password:
            </p>

            <p>
                <b>${code}</b>
            </p>

            <p>
                Respectfully, the TuboQuest team.
            </p>

            <img src="{{ $logoUrl }}" alt="tuboquest logo" />
        </div>
        <div class="footer">
            <p>© 2024 TuboQuest Corporation. All rights reserved.</p>
        </div>
    </div>
@endsection

<p></p>
