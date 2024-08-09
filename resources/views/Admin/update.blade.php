@extends('Admin.dashboard')
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div>
                <h3 style="color: white;font-weight:900">Update Form - SE_NO : {{ $data->se_no }}</h3>
            </div>
            <div class="form-responsive mt-3">
                <form action="{{ url('/updateaccident'.$data->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        {{-- <div class="col-md-6">
                            <div class="form-group">
                                <label for="user_id" style="color: white;">User ID:</label>
                                <input type="text" id="user_id" name="user_id" class="form-control" value="{{ $data->user_id }}" required>
                            </div>
                        </div> --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="se_no" style="color: white;">SE_No:</label>
                                <input type="text" id="se_no" name="se_no" class="form-control" value="{{ $data->se_no }}">
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="date" style="color: white;">Date:</label>
                                <input type="date" id="date" name="date" class="form-control" value="{{ $data->date }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="time" style="color: white;">Time:</label>
                                <input type="time" id="time" name="time" class="form-control" value="{{ $data->time }}">
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="acd_type" style="color: white;">Type:</label>
                                <select id="acd_type" name="acd_type" class="form-control">
                                    <option value="Veh to Veh" style="color: black" {{ $data->acd_type == 'Veh to Veh' ? 'selected' : '' }}>Veh to Veh</option>
                                    <option value="Veh to Ped" style="color: black" {{ $data->acd_type == 'Veh to Ped' ? 'selected' : '' }}>Veh to Ped</option>
                                    <option value="Veh to Obj" style="color: black" {{ $data->acd_type == 'Veh to Obj' ? 'selected' : '' }}>Veh to Obj</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="severity" style="color: white;">Severity:</label>
                                <select id="acd_type" name="severity" class="form-control">
                                    <option value="Patal" style="color: black" {{ $data->severity == 'Patal' ? 'selected' : '' }}>Patal</option>
                                    <option value="Major" style="color: black" {{ $data->severity == 'Major' ? 'selected' : '' }}>Major</option>
                                    <option value="Medium" style="color: black" {{ $data->severity == 'Medium' ? 'selected' : '' }}>Medium</option>
                                    <option value="Minor" style="color: black" {{ $data->severity == 'Minor' ? 'selected' : '' }}>Minor</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="acd_type" style="color: white;">Vehicle 1</label>
                                <input type="text" id="vehicle_1" name="vehicle_1" class="form-control" value="{{ $data->vehicle_1 }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="severity" style="color: white;">Vehicle 2</label>
                                <input type="text" id="vehicle_2" name="vehicle_2" class="form-control" value="{{ $data->vehicle_2 }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="severity" style="color: white;">Vehicle 3</label>
                                <input type="text" id="vehicle_3" name="vehicle_3" class="form-control" value="{{ $data->vehicle_3 }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="severity" style="color: white;">Object</label>
                                <input type="text" id="object" name="object" class="form-control" value="{{ $data->object }}">
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="acd_type" style="color: white;">Weather</label>
                                <input type="text" id="with_con" name="with_con" class="form-control" value="{{ $data->with_con }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="severity" style="color: white;">Male Passangers</label>
                                <input type="number" id="male_passengers" name="male_passengers" class="form-control" value="{{ $data->male_passengers }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="severity" style="color: white;">Female Passangers</label>
                                <input type="number" id="female_passengers" name="female_passengers" class="form-control" value="{{ $data->female_passengers }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="severity" style="color: white;">Male Pedestrians</label>
                                <input type="number" id="male_pedestrian" name="male_pedestrian" class="form-control" value="{{ $data->male_pedestrian }}">
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="acd_type" style="color: white;">Weather</label>
                                <input type="text" id="with_con" name="with_con" class="form-control" value="{{ $data->with_con }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="severity" style="color: white;">Male Passangers</label>
                                <input type="number" id="male_passengers" name="male_passengers" class="form-control" value="{{ $data->male_passengers }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="severity" style="color: white;">Female Passangers</label>
                                <input type="number" id="female_passengers" name="female_passengers" class="form-control" value="{{ $data->female_passengers }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="severity" style="color: white;">Male Pedestrians</label>
                                <input type="number" id="male_pedestrian" name="male_pedestrian" class="form-control" value="{{ $data->male_pedestrian }}">
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="acd_type" style="color: white;">Children</label>
                                <input type="number" id="children_count" name="children_count" class="form-control" value="{{ $data->children_count }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="severity" style="color: white;">Description</label>
                                <input type="text" id="des" name="des" class="form-control" value="{{ $data->des }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="severity" style="color: white;">Drunkness</label>
                                <input type="text" id="drunkness" name="drunkness" class="form-control" value="{{ $data->drunkness }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="severity" style="color: white;">Remarks</label>
                                <input type="text" id="remarks" name="remarks" class="form-control" value="{{ $data->remarks }}">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-warning">Update</button>
                </form>
            </div>
        </div>
    </div>
@endsection
