@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Editing Post For You :-)</div>

                    <?php

                        $db = new mysqli('localhost', 'root', 'admin', 'blog');
                        if($db->connect_errno > 0){
                            die('Unable to connect to database [' . $db->connect_error . ']');
                        }

                        $sql = "SELECT * from posts where posts.postid = ".$postId.";";
                        $current_post = $db->query($sql);
                        $row = $current_post->fetch_assoc();

                        $title = $row['title'];
                        $location = $row['location'];
                        $description = $row['description'];

                    ?>

                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ route('posts.editSubmit', $postId) }}">
                            {{ csrf_field() }}

                            <div class="form-group">
                                <label for="Title" class="col-md-4 control-label">Title</label>

                                <div class="col-md-12">
                                    <input id="Title" type="textarea" class="form-control" name="Title" value="<?php echo $title; ?>" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="Location" class="col-md-4 control-label">Location</label>

                                <div class="col-md-12">
                                    <input id="Location" type="textarea" class="form-control" name="Location" value="<?php echo $location; ?>" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="Description" class="col-md-4 control-label">Description</label>

                                <div class="col-md-12">
                                    <input id="Description" type="textarea" class="form-control" name="Description" value="<?php echo $description; ?>" required>
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