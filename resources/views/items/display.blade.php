@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Items</div>

                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <h5>You are logged in as {{$username}}!</h5>


                    <div class="panel-heading">
                        <h4>All items</h4>
                    </div>

                    <div class="panel-body">

                        <?php
                            $db = new mysqli('localhost', 'root', 'admin', 'blog');
                            if($db->connect_errno > 0){
                                die('Unable to connect to database [' . $db->connect_error . ']');
                            }
                            $sql = "select * from items i".
							$email."';";
                            $items_owned = $db->query($sql);
                            $index = 1;

                            while($row = $items_owned->fetch_assoc()){
                                echo $index."  <br />";
                                echo "Name:". $row['name']; echo"<br />";
                                echo "Description:" .$row['description'];echo"<br />";
                                echo "Available:". $row['available'];echo"<br /><br /><br />";
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
                                        <button type='submit' class='btn btn-primary'>
                                        Post
                                        </button>
                                    </div>
                                </div>";
                            }
                            $items_owned->close();

						?>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
