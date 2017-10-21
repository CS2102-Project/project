@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">User statistics</div>

                    <?php
                        $db = new mysqli('localhost', 'root', 'admin', 'blog');
                        if($db->connect_errno > 0){
                            die('Unable to connect to database [' . $db->connect_error . ']');
                        }
                        $sql = "SELECT * from users where users.id = ".$userId.";";
                        $results = $db -> query($sql);
                        $row = $results->fetch_assoc();
                        $username = $row['username'];
                        $points_available = $row['points_available'];
                        $email = $row['email'];
                    ?>

                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <h5>You are logged in as {{$username}}!</h5>
                        <h5>You have {{$points_available}} points available.</h5>
                        <hr>

                    </div>

                    <script>

                    </script>

                    <div class="panel-heading">
                        <h4>Statistics</h4>
                    </div>


                    <div class="panel-body">
                    <?php

                        $sql = "SELECT AVG(num) as avge
                                FROM
                                (SELECT i.itemid, COUNT(b.bidid) as num
                                FROM posts p, bids b, items i
                                WHERE b.post = p.postid AND p.item = i.itemid AND i.owner = '".$email."'
                                GROUP BY i.itemid) as derived;";
                        $results = $db->query($sql);
                        $row = $results->fetch_assoc();
                        echo "Your average item popularity: ".$row['avge'];


                    ?>

                    </div>



                </div>
            </div>
        </div>
    </div>

@endsection