@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Posting Markets</div>

                    <?php
                        $username = $user['username'];

                    ?>
                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <h5>You are logged in as {{$username}}!</h5>
                        <hr>

                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection