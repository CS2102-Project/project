@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">New Item Record For You :-)</div>
                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ route('newItemSubmit') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                                <label for="ItemName" class="col-md-4 control-label"> Name </label>

                                <div class="col-md-6">
                                    <input id="ItemName" type="text" class="form-control" name="ItemName" value="{{ old('ItemName') }}" required autofocus>

                                </div>
                            </div>


                            <div class="form-group">
                                <label for="Description" class="col-md-4 control-label">Description</label>

                                <div class="col-md-12">
                                    <input id="Description" type="textarea" class="form-control" name="Description" required>
                                </div>
                            </div>


                            <div class="form-group">
                                <label for="ItemImage" class="col-md-4 control-label">Item Image</label>

                                <div class="col-md-12">
                                    <input id="ItemImage" type="file" name="avatar">
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