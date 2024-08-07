@extends('Admin.dashboard')
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div>
                <h3 style="color: white;font-weight:900">Update Form - SE_NO : {{ $data->se_no }}</h3>
            </div>
            <div class="form-responsive mt-3">
                <form action="" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="user_id" style="color: white;">User ID</label>
                                <input type="text" id="user_id" name="user_id" class="form-control" value="{{ $data->user_id }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="se_no" style="color: white;">SE_No</label>
                                <input type="text" id="se_no" name="se_no" class="form-control" value="{{ $data->se_no }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="date" style="color: white;">Date</label>
                                <input type="date" id="date" name="date" class="form-control" value="{{ $data->date }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="time" style="color: white;">Time</label>
                                <input type="time" id="time" name="time" class="form-control" value="{{ $data->time }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="acd_type" style="color: white;">Type</label>
                                <input type="text" id="acd_type" name="acd_type" class="form-control" value="{{ $data->acd_type }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="severity" style="color: white;">Severity</label>
                                <input type="text" id="severity" name="severity" class="form-control" value="{{ $data->severity }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="acd_type" style="color: white;">Type</label>
                                <input type="text" id="acd_type" name="acd_type" class="form-control" value="{{ $data->acd_type }}" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="severity" style="color: white;">Severity</label>
                                <input type="text" id="severity" name="severity" class="form-control" value="{{ $data->severity }}" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="severity" style="color: white;">Severity</label>
                                <input type="text" id="severity" name="severity" class="form-control" value="{{ $data->severity }}" required>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-warning">Update</button>
                </form>
            </div>
        </div>
    </div>
@endsection
