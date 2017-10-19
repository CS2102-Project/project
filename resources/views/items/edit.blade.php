@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Editing Item Record For You :-)</div>
                    <?php
                        $db = new mysqli('localhost', 'root', 'admin', 'blog');
                        if($db->connect_errno > 0){
                            die('Unable to connect to database [' . $db->connect_error . ']');
                        }
                        $sql = "select * from items i where i.itemid = ". $itemId.";";
                        $items_owned = $db->query($sql);
                        $index = 1;

                        $row = $items_owned->fetch_assoc();
                        $itemName = $row['name'];
                        $itemDescription = $row['description'];

                    ?>

                    <script>
                        function editSubmit() {
                            alert("edit submit button clicked!");
                            window.location.href = "/";
                        }

                    </script>

                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ route('newItemSubmit') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                                <label for="ItemName" class="col-md-4 control-label"> Name </label>

                                <div class="col-md-6">
                                    <input id="ItemName" type="text" class="form-control" name="ItemName" value="<?php echo ($itemName); ?>" required autofocus>

                                </div>
                            </div>


                            <div class="form-group">
                                <label for="Description" class="col-md-4 control-label">Description</label>

                                <div class="col-md-12">
                                    <input id="Description" type="textarea" class="form-control" name="Description" value="<?php echo ($itemDescription); ?>" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Edit
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection