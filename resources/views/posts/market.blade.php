@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Posting Markets</div>

                    <?php
                        $username = $user['username'];
                        $email = $user['email'];
                        $points_available = $user['points_available'];

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
                        function bidPost (postId) {
                            //alert("you want to bid for this one: "+ postId);
                            window.location = 'posts/'+postId+'/bid';
                        }
                    </script>


                    <div class="panel-body">

                        <?php
                        $db = new mysqli('localhost', 'root', 'admin', 'blog');
                        if($db->connect_errno > 0){
                            die('Unable to connect to database [' . $db->connect_error . ']');
                        }
                        $sql = "SELECT p.postid, p.title, p.description, p.created_at, i1.avatar from posts p, items i1 where p.item not in ( SELECT i.itemid from items i where i.owner ='".$email."')
                                and p.item = i1.itemid;";
                        $all_posts_not_owned = $db->query($sql);
                        $index = 1;

                        while($row = $all_posts_not_owned->fetch_assoc()){
                            $itemImage = $row['avatar'];

                            echo "<img src=\"/uploads/items/".$itemImage."\" style=\"width:64px; height:64px; top:10px; left:10px; border-radius:50%\">";

                            echo $index."  <br />";
                            echo "Title:". $row['title']; echo"<br />";
                            echo "Description:" .$row['description'];echo"<br />";
                            echo "Created_at:". $row['created_at'];echo"<br /><br /><br />";

                            $index++;
                            $current_post_id = $row['postid']; // this is for clicking events handle

                            echo "
                                <div class='form-group'>
                                    <div class='col-md-8 col-md-offset-4'>
                                        <button type='submit' class='btn btn-primary' onclick='bidPost(".$current_post_id.")'>
                                        Bid
                                        </button>
                                    </div>
                                </div>";
                        }
                        $all_posts_not_owned->close();
                        ?>
                    </div>


                </div>
            </div>
        </div>
    </div>

@endsection