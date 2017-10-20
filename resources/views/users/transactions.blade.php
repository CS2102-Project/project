@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Transacting Centre</div>

                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                    <?php
                    $user = \Illuminate\Support\Facades\Auth::user();
                    $username = $user['username'];
                    $points_available = $user['points_available'];
                    ?>

                    <h5>You are logged in as {{$username}}!</h5>
                    <h5>You have {{$points_available}} points available.</h5>

                    <script>

                    </script>

                    </div>

                    <hr>

                    <div class="panel-heading">
                        <h4>Posts Being Bid</h4>
                    </div>


                    <div class="panel-body">

                        <?php
                        $db = new mysqli('localhost', 'root', 'admin', 'blog');
                        if($db->connect_errno > 0){
                            die('Unable to connect to database [' . $db->connect_error . ']');
                        }

                        ?>
                    </div>

                    <div class="panel-heading">
                        <h4>Past Transactions</h4>
                    </div>

                    <div class="panel-body">

                        <?php
                        $db = new mysqli('localhost', 'root', 'admin', 'blog');
                        if($db->connect_errno > 0){
                            die('Unable to connect to database [' . $db->connect_error . ']');
                        }

                        ?>
                    </div>




                </div>
            </div>
        </div>
    </div>

@endsection