@extends('Admin.dashboard')

<style>
    .year-dropdown-container {
        position: relative;
        display: inline-block;
        width: 150px;
    }

    .year-dropdown {
        appearance: none;
        /* Remove default dropdown arrow */
        width: 100%;
        padding: 10px;
        border: none;
        border-radius: 5px;
        background-color: black;
        color: white;
        font-size: 16px;
        cursor: pointer;
        outline: none;
        /* Remove outline on focus */
        text-align-last: center;
        /* Center text */
    }

    /* Custom arrow */
    .year-dropdown-container::after {
        content: '\25BC';
        /* Unicode character for downward arrow */
        position: absolute;
        top: 50%;
        right: 10px;
        transform: translateY(-50%);
        pointer-events: none;
        /* Allow clicks to go through the arrow */
        color: rgb(255, 255, 255);
        font-size: 12px;
    }

    .year-dropdown option {
        background-color: black;
        color: white;
    }
</style>
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-warning">
                            <h4 class="card-title "><b>Accident Reports</b></h4>
                            <p class="card-category"> Submitted By Users</p>
                            <div class="year-dropdown-container">
                                <select id="yearFilter" name="year" class="form-control year-dropdown">
                                    @php
                                        $currentYear = date('Y');
                                        $startYear = 2000; // or the first year you have data for
                                    @endphp
                                    @for ($year = $currentYear; $year >= $startYear; $year--)
                                        <option value="{{ $year }}" {{ $year == $selectedYear ? 'selected' : '' }}>
                                            {{ $year }}
                                        </option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="text-primary">
                                        <tr>
                                            <th style="color: white;">#</th>
                                            <th style="color: white;">User ID</th>
                                            <th style="color: white;">SE_No</th>
                                            <th style="color: white;">Lat & Lon</th>
                                            <th style="color: white;">Date</th>
                                            <th style="color: white;">Time</th>
                                            <th style="color: white;">Type</th>
                                            <th style="color: white;">Severity</th>
                                            <th style="color: white;"></th>
                                            {{-- <th style="color: white;">Vehicle 1</th>
                                            <th style="color: white;">Vehicle 2</th>
                                            <th style="color: white;">Vehicle 3</th>
                                            <th style="color: white;">Pedest</th>
                                            <th style="color: white;">Object</th> --}}
                                            {{-- <th style="color: white;">With_Con</th>
                                            <th style="color: white;">Pas_Inj</th>
                                            <th style="color: white;">Ped_Inj</th>
                                            <th style="color: white;">des</th>
                                            <th style="color: white;">drukness</th>
                                            <th style="color: white;">dl</th>
                                            <th style="color: white;">nic</th>
                                            <th style="color: white;">Images</th>
                                            <th style="color: white;">remarks</th> --}}

                                        </tr>
                                    </thead>

                                    <tbody id="accidentTableBody">
                                        @php $x =0 @endphp
                                        @foreach ($data as $accidents)
                                            @php $x++ @endphp
                                            <tr>
                                                <td>
                                                    {{ $x }}
                                                </td>
                                                <td>
                                                    {{ $accidents->user_id }}
                                                </td>
                                                <td>
                                                    {{ $accidents->se_no }}
                                                </td>
                                                <td>
                                                    <a href="https://www.google.com/maps/search/?api=1&query={{ $accidents->lat }},{{ $accidents->lon }}"
                                                        target="_blank" style="color: inherit; text-decoration: underline;">
                                                        {{ $accidents->lat }},{{ $accidents->lon }}
                                                    </a>
                                                </td>
                                                <td>
                                                    {{ $accidents->date }}
                                                </td>
                                                <td>
                                                    {{ $accidents->time }}
                                                </td>
                                                <td>
                                                    {{ $accidents->acd_type }}
                                                </td>
                                                <td>
                                                    {{ $accidents->severity }}
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-sm btn-success"
                                                        data-toggle="modal" data-target="#projectDetailsModal"
                                                        onclick="setDescription(
                                                            '{{ $accidents->user_id }}', 
                                                            '{{ $accidents->se_no }}', 
                                                            '{{ $accidents->lat }}', 
                                                            '{{ $accidents->lon }}', 
                                                            '{{ $accidents->date }}', 
                                                            '{{ $accidents->time }}', 
                                                            '{{ $accidents->acd_type }}', 
                                                            '{{ $accidents->severity }}', 
                                                            '{{ $accidents->vehicle_1 }}', 
                                                            '{{ $accidents->vehicle_2 }}', 
                                                            '{{ $accidents->vehicle_3 }}', 
                                                            '{{ $accidents->pedest }}', 
                                                            '{{ $accidents->object }}', 
                                                            '{{ $accidents->with_con }}', 
                                                            '{{ $accidents->pas_inj }}', 
                                                            '{{ $accidents->ped_inj }}', 
                                                            '{{ $accidents->des }}', 
                                                            '{{ $accidents->drunkness }}', 
                                                            '{{ $accidents->dl }}', 
                                                            '{{ $accidents->nic }}', 
                                                            '{{ $accidents->remarks }}'
                                                        )">See
                                                        More</button>
                                                    <a href="" class="btn btn-sm btn-danger">Remove</a>
                                                </td>

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<div class="modal fade" id="projectDetailsModal" tabindex="-1" role="dialog"
    aria-labelledby="projectDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 1140px">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #000000; color: white;">
                <h5 class="modal-title">Accident Details - Serial No : <span id="modalSeNo"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color:white">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <tr>
                        <th>User ID</th>
                        <td id="modalUserId"></td>
                    </tr>
                    <tr>
                        <th>Date</th>
                        <td id="modalDate"></td>
                    </tr>
                    <tr>
                        <th>Time</th>
                        <td id="modalTime"></td>
                    </tr>
                    <tr>
                        <th>Latitude</th>
                        <td id="modalLat"></td>
                    </tr>
                    <tr>
                        <th>Longitude</th>
                        <td id="modalLon"></td>
                    </tr>
                    <tr>
                        <th>Type</th>
                        <td id="modalType"></td>
                    </tr>
                    <tr>
                        <th>Severity</th>
                        <td id="modalSeverity"></td>
                    </tr>
                    <tr>
                        <th>Vehicle 1</th>
                        <td id="modalVehicle1"></td>
                    </tr>
                    <tr>
                        <th>Vehicle 2</th>
                        <td id="modalVehicle2"></td>
                    </tr>
                    <tr>
                        <th>Vehicle 3</th>
                        <td id="modalVehicle3"></td>
                    </tr>
                    <tr>
                        <th>Pedestrians</th>
                        <td id="modalPedest"></td>
                    </tr>
                    <tr>
                        <th>Object</th>
                        <td id="modalObject"></td>
                    </tr>
                    <tr>
                        <th>Condition</th>
                        <td id="modalWithCon"></td>
                    </tr>
                    <tr>
                        <th>Passenger Injuries</th>
                        <td id="modalPasInj"></td>
                    </tr>
                    <tr>
                        <th>Pedestrian Injuries</th>
                        <td id="modalPedInj"></td>
                    </tr>
                    <tr>
                        <th>Description</th>
                        <td id="modalDes"></td>
                    </tr>
                    <tr>
                        <th>Drunkness</th>
                        <td id="modalDrunkness"></td>
                    </tr>
                    <tr>
                        <th>Driving License</th>
                        <td id="modalDl"></td>
                    </tr>
                    <tr>
                        <th>NIC</th>
                        <td id="modalNic"></td>
                    </tr>
                    <tr>
                        <th>Remarks</th>
                        <td id="modalRemarks"></td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>



<script>
    function setDescription(userId, seNo, lat, lon, date, time, acdType, severity, vehicle1, vehicle2, vehicle3, pedest,
        object, withCon, pasInj, pedInj, des, drunkness, dl, nic, remarks) {
        document.getElementById('modalUserId').innerText = userId;
        document.getElementById('modalSeNo').innerText = seNo;
        document.getElementById('modalLat').innerText = lat;
        document.getElementById('modalLon').innerText = lon;
        document.getElementById('modalDate').innerText = date;
        document.getElementById('modalTime').innerText = time;
        document.getElementById('modalType').innerText = acdType;
        document.getElementById('modalSeverity').innerText = severity;
        document.getElementById('modalVehicle1').innerText = vehicle1;
        document.getElementById('modalVehicle2').innerText = vehicle2;
        document.getElementById('modalVehicle3').innerText = vehicle3;
        document.getElementById('modalPedest').innerText = pedest;
        document.getElementById('modalObject').innerText = object;
        document.getElementById('modalWithCon').innerText = withCon;
        document.getElementById('modalPasInj').innerText = pasInj;
        document.getElementById('modalPedInj').innerText = pedInj;
        document.getElementById('modalDes').innerText = des;
        document.getElementById('modalDrunkness').innerText = drunkness;
        document.getElementById('modalDl').innerText = dl;
        document.getElementById('modalNic').innerText = nic;
        document.getElementById('modalRemarks').innerText = remarks;
    }
</script>

<script>
    $(document).ready(function() {
        $('#yearFilter').on('change', function() {
            var selectedYear = $(this).val();

            $.ajax({
                url: "{{ route('admin.getdata') }}", // Your route for fetching data
                type: "GET",
                data: {
                    year: selectedYear
                },
                success: function(response) {
                    // Clear the existing table body
                    $('#accidentTableBody').empty();

                    // Iterate over the data returned from the server and append rows to the table body
                    $.each(response.data, function(index, accident) {
                        $('#accidentTableBody').append(`
                            <tr>
                                <td>${index + 1}</td>
                                <td>${accident.user_id}</td>
                                <td>${accident.se_no}</td>
                                <td>
                                    <a href="https://www.google.com/maps/search/?api=1&query=${accident.lat},${accident.lon}"
                                       target="_blank" style="color: inherit; text-decoration: underline;">
                                       ${accident.lat},${accident.lon}
                                    </a>
                                </td>
                                <td>${accident.date}</td>
                                <td>${accident.time}</td>
                                <td>${accident.acd_type}</td>
                                <td>${accident.severity}</td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#projectDetailsModal" data-description="{{ $accidents->des }}" onclick="setDescription('{{ $accidents->time }}','{{ $accidents->date }}')">See More</button>
                                    <a href="" class="btn btn-sm btn-danger">Remove</a>
                                </td>
                            </tr>
                        `);
                    });
                },
                error: function() {
                    console.error('Error fetching data for selected year');
                }
            });
        });
    });
</script>
