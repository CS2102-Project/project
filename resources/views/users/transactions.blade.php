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
                    $userid = $user['id'];
                    $email = $user['email'];
                    $points_available = $user['points_available'];
                    ?>

                    <h5>You are logged in as {{$username}}!</h5>
                    <h5>You have {{$points_available}} points available.</h5>

                    <script>

                        function acceptBid( bidId ) {
                            alert("Accept Bid "+bidId);
                        }

                        function rejectBid( bidId ) {
                            window.location = "../../bids/"+bidId+"/reject";
                        }

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
                        $sql = "SELECT * from posts p, items i where p.item=i.itemid and i.owner = '".$email."';";

                        $posts_owned = $db->query($sql);
                        $index = 1;

                        while($row = $posts_owned->fetch_assoc()){
                            $current_post_id = $row['postid'];
                            $current_title = $row['title'];

                            $sql_inner = "SELECT * from bids b where b.post = ".$current_post_id.";";
                            $related_bids = $db->query($sql_inner);
                            //print_r($related_bids);
                            if ($related_bids->num_rows == 0)
                                {
                                    continue;
                                }

                            echo "<strong>".$index++."</strong>  <br />";
                            echo "<strong>Post Title:". $current_title ."</strong><br/>";

                            while($row_inner = $related_bids->fetch_assoc()){

                                $points = $row_inner['points'];
                                $bidder = $row_inner['bidder'];
                                $current_bid_id = $row_inner['bidid'];

                                echo "Bidder:". $bidder."<br>";
                                echo "Points:". $points;echo"<br>";
                                echo "
                                <div class='form-group'>
                                    <div class='col-md-8 col-md-offset-4'>
                                        <button type='submit' class='btn btn-primary' onclick='acceptBid(".$current_bid_id.")'>
                                        Accept
                                        </button>
                                        <button type='submit' class='btn btn-primary' onclick='rejectBid(".$current_bid_id.")'>
                                        Reject
                                        </button>
                                    </div>
                                </div>";

                            }

                            $related_bids->close();

                            echo"<br>";

                        }
                        $posts_owned->close();
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