@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">New Post For You :-)</div>
                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ route('posts.submit', $itemId) }}">
                            {{ csrf_field() }}

                            <div class="form-group">
                                <label for="Title" class="col-md-4 control-label">Title</label>

                                <div class="col-md-12">
                                    <input id="Title" type="textarea" class="form-control" name="Title" required>
                                </div>
                            </div>
							
                            <div class="form-group">
                                <label for="Location" class="col-md-4 control-label">Location</label>

                                <div class="col-md-12">
                                    <input id="Location" type="textarea" class="form-control" name="Location" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="Description" class="col-md-4 control-label">Description</label>

                                <div class="col-md-12">
                                    <input id="Description" type="textarea" class="form-control" name="Description" required>
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