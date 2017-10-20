@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Update Bidding For You :-)</div>

                    <?php
                        $db = new mysqli('localhost', 'root', 'admin', 'blog');
                        if($db->connect_errno > 0){
                            die('Unable to connect to database [' . $db->connect_error . ']');
                        }

                        $sql = "SELECT * from bids where bids.bidid = ".$bidId.";";
                        $current_post = $db->query($sql);
                        $row = $current_post->fetch_assoc();

                        $points = $row['points'];
                    ?>

                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ route('bids.editSubmit', $bidId) }}">
                            {{ csrf_field() }}

                            <div class="form-group">
                                <label for="Points" class="col-md-4 control-label">How many Points to Update</label>

                                <div class="col-md-12">
                                    <input id="Points" type="textarea" class="form-control" name="Point" value="<?php echo $points; ?>" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Submit
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