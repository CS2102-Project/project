@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Posts</div>

                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <h5>You are logged in as {{$username}}!</h5>


                    <div class="panel-heading">
                        <h4>All posts</h4>
                    </div>

                    <div class="panel-body">

                        <?php
                            $db = new mysqli('localhost', 'root', 'admin', 'blog');
                            if($db->connect_errno > 0){
                                die('Unable to connect to database [' . $db->connect_error . ']');
                            }
                            $sql = "select p.title, p.location, p.created_at, i.name from posts p, items i where p.item = i.itemid".
							$email."';";
                            $posts = $db->query($sql);
                            $index = 1;

                            while($row = $posts->fetch_assoc()){
                                echo $index."  <br />";
                                echo "Item name:". $row['name']; echo"<br />";
                                echo "Post title:" .$row['title'];echo"<br />";
                                echo "Created at:" .$row['created_at'];echo"<br />";
                                echo "Pick up location:". $row['location'];echo"<br /><br /><br />";
                                $index++;
                                echo "
                                <div class='form-group'>
                                    <div class='col-md-8 col-md-offset-4'>
                                        <button type='submit' class='btn btn-primary'>
                                        Edit
                                        </button>
                                        <button type='submit' class='btn btn-primary'>
                                        Delete
                                        </button>
                                    </div>
                                </div>";
                            }
                            $posts->close();

						?>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
