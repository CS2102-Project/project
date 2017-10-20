@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">New Bidding For You :-)</div>
                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ route('posts.bidPointSubmit', $postId) }}">
                            {{ csrf_field() }}

                            <div class="form-group">
                                <label for="Points" class="col-md-4 control-label">How many Points to give</label>

                                <div class="col-md-12">
                                    <input id="Points" type="textarea" class="form-control" name="Point" required>
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