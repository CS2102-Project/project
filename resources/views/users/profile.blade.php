@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard</div>

                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                    <?php
                        $user = \Illuminate\Support\Facades\Auth::user();
                        $admin = $user['admin'];
                        $points_available = $user['points_available'];
                        if ($admin ==1 ) {
                            echo "<h5>You are logged in as admin!</h5>";
                        }
                        else {
                            echo "<h5>You are logged in as ". $username."!</h5>";
                            echo "<h5>You have ".$points_available." points available.</h5>";
                        }
                    ?>




                            <script>
                                //alert("You are logged in.");

                                function myTestButtonFunction() {
                                    alert("You clicked this button!");
                                }

                                function editItem( itemId ) {
                                    window.location = ('../items/'+itemId +'/edit');
                                }

                                function deleteItem( itemId ) {
                                    window.location = ('../items/'+itemId +'/delete');
                                }

                                function postItem( itemId ) {
                                    window.location = ('../items/'+itemId+'/post');
                                }

                                function editPost( postId ) {
                                    window.location = ('../posts/'+postId+'/edit');
                                }

                                function deletePost( postId ) {
                                    window.location = ('../posts/'+postId +'/delete');
                                }

                                function deleteBid( bidId ) {
                                    window.location = ('../bids/'+bidId +'/delete');
                                }

                                function updateBid( bidId ) {
                                    window.location = ('../bids/'+bidId +'/edit');
                                }

                                function returnLoan( loanId ) {
                                    window.location = ('../loans/'+loanId +'/return');
                                }

                            </script>
                    <hr>

                    <div class="panel-heading">
                        <h4>Item Owned</h4>
                    </div>

                    <div class="panel-body">

                        <?php
                            $db = new mysqli('localhost', 'root', 'admin', 'blog');
                            if($db->connect_errno > 0){
                                die('Unable to connect to database [' . $db->connect_error . ']');
                            }
                            if ($admin == 1) {
                                $sql = "select * from items i";
                            } else {
                                $sql = "select * from items i where i.owner = '".$email."';";
                            }
                            $items_owned = $db->query($sql);
                            $index = 1;

                            while($row = $items_owned->fetch_assoc()){

                                $itemImage = $row['avatar'];

                                echo "<img src=\"/uploads/items/".$itemImage."\" style=\"width:64px; height:64px; top:10px; left:10px; border-radius:50%\">";
                                echo $index."  <br />";
                                echo "Name:". $row['name']; echo"<br />";
                                echo "Description:" .$row['description'];echo"<br />";
                                echo "Available:". $row['available'];echo"<br /><br /><br />";

                                $index++;
                                $current_item_id = $row['itemid']; // this is for clicking events handle

                                echo "
                                <div class='form-group'>
                                    <div class='col-md-8 col-md-offset-4'>
                                        <button type='submit' class='btn btn-primary' onclick='editItem(".$current_item_id.")'>
                                        Edit
                                        </button>
                                        <button type='submit' class='btn btn-primary' onclick='deleteItem(".$current_item_id.")'>
                                        Delete
                                        </button>
                                        <button type='submit' class='btn btn-primary' onclick='postItem(".$current_item_id.")'>
                                        Post
                                        </button>
                                    </div>
                                </div>";
                            }
                            $items_owned->close();
                        ?>
                    </div>
                    <hr>

                    <div class="panel-heading">
                        <h4>Item Posted</h4>
                    </div>

                    <div class="panel-body">

                        <?php
                            if ($admin == 1) {
                                $sql = "select p.title, p.location, p.created_at, p.postid, p.description, i.name, i.avatar from posts p, items i where p.item = i.itemid;";
                            } else {
                                $sql = "select p.title, p.location, p.created_at, p.postid, p.description, i.name, i.avatar from posts p, items i where p.item = i.itemid AND i.owner = '".$email."';";
                            }
                            $posts = $db->query($sql);
                            $index = 1;

                            while($row = $posts->fetch_assoc()){

                                $itemImage = $row['avatar'];

                                echo "<img src=\"/uploads/items/".$itemImage."\" style=\"width:64px; height:64px; top:10px; left:10px; border-radius:50%\">";

                                echo $index."  <br />";
                                echo "Item name:". $row['name']; echo"<br />";
                                echo "Post title:" .$row['title'];echo"<br />";
                                echo "Created at:" .$row['created_at'];echo"<br />";
                                echo "Description:" .$row['description'];echo"<br />";
                                echo "Pick up location:". $row['location'];echo"<br /><br /><br />";

                                $index++;
                                $current_post_id = $row['postid'];

                                echo "
                                <div class='form-group'>
                                    <div class='col-md-8 col-md-offset-4'>
                                        <button type='submit' class='btn btn-primary' onclick='editPost(".$current_post_id.")'>
                                        Edit
                                        </button>
                                        <button type='submit' class='btn btn-primary' onclick='deletePost(".$current_post_id.")'>
                                        Delete
                                        </button>
                                    </div>
                                </div>";
                            }
                            $posts->close();
						?>


                    </div>

                    <hr>


                    <div class="panel-heading">
                        <h4>Item Bidding</h4>
                    </div>

                    <div class="panel-body">
                        <?php
                            if ($admin == 1) {
                                $sql = "select b.post, b.points, b.updated_at, b.status, b.bidid, i.avatar, p.title, p.postid from bids b, posts p, items i where
                                b.post = p.postid and p.item = i.itemid;";
                            }
                            else {
                                $sql = "select b.post, b.points, b.updated_at, b.status, b.bidid, i.avatar, p.title, p.postid from bids b, posts p, items i where
                                b.post = p.postid and p.item = i.itemid and b.bidder = '". $email."';";

                            }

                        $posts = $db->query($sql);
                        $index = 1;


                        while($row = $posts->fetch_assoc()){
                            $postid = $row['postid'];

                            $sql = "SELECT MAX(b.points) as maxi
                            FROM bids b, posts p
                            WHERE b.post = p.postid AND p.postid = ".$postid.";";

                            $maxPoints = $db->query($sql);
                            $pointsMaxstats = $maxPoints->fetch_assoc();
                            $maxiBiddingPoints = $pointsMaxstats['maxi'];


                            $itemImage = $row['avatar'];


                            echo "<img src=\"/uploads/items/".$itemImage."\" style=\"width:64px; height:64px; top:10px; left:10px; border-radius:50%\">";

                            echo $index."  <br />";
                            echo "Bid post:". $row['title']; echo"<br />";
                            echo "Bidding points:" .$row['points'];echo"<br />";
                            echo "Max Bid Points:" .$maxiBiddingPoints;echo"<br />";
                            echo "Last Update:" .$row['updated_at'];echo"<br />";
                            echo "Bid Status:". $row['status'];echo"<br /><br /><br />";

                            $index++;
                            $current_bid_id = $row['bidid'];

                            echo "
                                <div class='form-group'>
                                    <div class='col-md-8 col-md-offset-4'>
                                        <button type='submit' class='btn btn-primary' onclick='updateBid(".$current_bid_id.")'>
                                        Update
                                        </button>
                                        <button type='submit' class='btn btn-primary' onclick='deleteBid(".$current_bid_id.")'>
                                        Withdraw
                                        </button>
                                    </div>
                                </div>";
                            }
                            $posts->close();
                        ?>

                    </div>

                    <hr>

                    <div class="panel-heading">
                        <h4>Borrowing</h4>
                    </div>

                    <div class="panel-body">

                        <?php
                            if ($admin == 1) {
                                $sql = "select p.title, p.description, l.start, l.loanid from loans l, bids b, posts p where p.postid = b.post and l.bid = b.bidid and l.status = 'USING';";
                            }
                            else {
                            $sql = "select p.title, p.description, l.start, l.loanid from loans l, bids b, posts p where p.postid = b.post and l.bid = b.bidid and b.bidder = '".
                                $email."' and l.status = 'USING';";
                            }
                            $results = $db->query($sql);
                            $index = 1;

                            while($row = $results->fetch_assoc()){
                                echo $index."  <br />";
                                echo "Post:". $row['title']; echo"<br />";
                                echo "Description:" .$row['description'];echo"<br />";
                                echo "Start at:" .$row['start'];echo"<br /><br /><br />";

                                $index++;
                                $current_loan_id = $row['loanid'];

                                echo "
                                <div class='form-group'>
                                    <div class='col-md-8 col-md-offset-4'>
                                        <button type='submit' class='btn btn-primary' onclick='returnLoan(".$current_loan_id.")'>
                                        Return it
                                        </button>
                                    </div>
                                </div>";

                            }


                            $results->close();

                        ?>

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
