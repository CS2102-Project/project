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
                        <h5>You are logged in as {{$username}}!</h5>


                    <div class="panel-heading">
                        <h4>Item Owned</h4>
                    </div>

                    <div class="panel-body">

                        <?php
                            $db = new mysqli('localhost', 'root', 'admin', 'blog');
                            if($db->connect_errno > 0){
                                die('Unable to connect to database [' . $db->connect_error . ']');
                            }
                            $sql = "select * from items i where i.owner = '".$email."';";
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

                    <hr>


                    <div class="panel-heading">
                        <h4>Item Bidding</h4>
                    </div>

                    <div class="panel-body">
                        Name: 123<br>
                        Points: 100<br>
                        Success: false<br>
                        <div class='form-group'>
                            <div class='col-md-8 col-md-offset-4'>
                                <button type='submit' class='btn btn-primary'>
                                    Update
                                </button>
                                <button type='submit' class='btn btn-primary'>
                                    Withdraw
                                </button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
