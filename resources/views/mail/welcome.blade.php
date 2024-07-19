@extends('layouts.email')

@section('content')
    <div class="container">
        <div class="header">
            <h1>Welcome !</h1>
        </div>
        <div class="content">
            <p>Hello, <b>{{ $email }}</b> !</p>

            <p>
                Welcome to TuboQuest! We are excited to have you on board. If you have any questions or need assistance,
                please
                do not hesitate to contact us.
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
