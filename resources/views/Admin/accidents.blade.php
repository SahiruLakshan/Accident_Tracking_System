@extends('Admin.dashboard')

<style>
    .year-dropdown-container {
        position: relative;
        display: inline-block;
        width: 150px;
    }

    .year-dropdown {
        appearance: none;
        width: 100%;
        padding: 10px;
        border: none;
        border-radius: 5px;
        background-color: black;
        color: white;
        font-size: 16px;
        cursor: pointer;
        outline: none;
        text-align-last: center;
    }

    .year-dropdown-container::after {
        content: '\25BC';
        position: absolute;
        top: 50%;
        right: 10px;
        transform: translateY(-50%);
        pointer-events: none;
        color: white;
        font-size: 12px;
    }

    .year-dropdown option {
        background-color: black;
        color: white;
    }

    .modal-content img {
        max-width: 100px;
        height: auto;
        cursor: pointer;
        transition: transform 0.2s;
    }

    .modal-content img.enlarged {
        transform: scale(4);
    }
</style>

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-warning">
                            <h4 class="card-title"><b>Accident Reports</b></h4>
                            <p class="card-category">Submitted By Users</p>
                            <div class="year-dropdown-container">
                                <select id="yearFilter" name="year" class="form-control year-dropdown">
                                    @php
                                        $currentYear = date('Y');
                                        $startYear = 2000;
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
                            <form id="searchForm" class="navbar-form mr-5">
                                @csrf
                                <div class="input-group no-border sm:w-50">
                                    <input type="text" id="searchaccidents" class="form-control flex-grow" name="search" placeholder="Search by Serial No, Date, or Time" />
                                    <button type="submit" class="btn btn-default btn-round btn-just-icon">
                                        <i class="material-icons">search</i>
                                        <div class="ripple-container"></div>
                                    </button>
                                </div>
                            </form>
                            
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
                                        </tr>
                                    </thead>
                                    <tbody id="accidentTableBody">
                                        @php $x =0 @endphp
                                        @foreach ($data as $accidents)
                                            @php $x++ @endphp
                                            <tr>
                                                <td>{{ $x }}</td>
                                                <td>{{ $accidents->user_id }}</td>
                                                <td>{{ $accidents->se_no }}</td>
                                                <td>
                                                    <a href="https://www.google.com/maps/search/?api=1&query={{ $accidents->lat }},{{ $accidents->lon }}"
                                                        target="_blank" style="color: inherit; text-decoration: underline;">
                                                        {{ $accidents->lat }},{{ $accidents->lon }}
                                                    </a>
                                                </td>
                                                <td>{{ $accidents->date }}</td>
                                                <td>{{ $accidents->time }}</td>
                                                <td>{{ $accidents->acd_type }}</td>
                                                <td>{{ $accidents->severity }}</td>
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
                                                        '{{ $accidents->male_pedestrian }}', 
                                                        '{{ $accidents->female_pedestrian }}',
                                                        '{{ $accidents->object }}', 
                                                        '{{ $accidents->weather }}', 
                                                        '{{ $accidents->male_passengers }}', 
                                                        '{{ $accidents->female_passengers }}', 
                                                        '{{ $accidents->children_count }}', 
                                                        '{{ $accidents->des }}', 
                                                        '{{ $accidents->drunkness }}',
                                                        '{{ $accidents->images }}', 
                                                        '{{ $accidents->remarks }}'
                                                    )">See
                                                        More</button>
                                                    <a href="{{ url('/updateform' . $accidents->id) }}" class="btn btn-sm btn-primary">Update</a>
                                                    @if (Auth::user()->type == '1')
                                                        <a href="{{ url('/accidentremove' . $accidents->id) }}"
                                                            class="btn btn-sm btn-danger">Remove</a>
                                                    @endif
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
                <table class="table table-bordered table-dark">
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
                        <th>Male Passenger Injuries</th>
                        <td id="modalMalePasInj"></td>
                    </tr>
                    <tr>
                        <th>Female Passenger Injuries</th>
                        <td id="modalFemalePasInj"></td>
                    </tr>
                    <tr>
                        <th>Male Pedestrian Injuries</th>
                        <td id="modalMalePedInj"></td>
                    </tr>
                    <tr>
                        <th>Female Pedestrian Injuries</th>
                        <td id="modalFemalePedInj"></td>
                    </tr>
                    <tr>
                        <th>Children Injuries</th>
                        <td id="modalChildInj"></td>
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
                        <th>Remarks</th>
                        <td id="modalRemarks"></td>
                    </tr>
                    <tr>
                        <th>Images</th>
                        <td id="modalImages"></td>
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
    function setDescription(userId, seNo, lat, lon, date, time, type, severity, vehicle1, vehicle2, vehicle3,
        malePedInj, femalePedInj, object, weather, malePasInj, femalePasInj, childInj, des, drunkness, images, remarks
        ) {
        $('#modalUserId').text(userId);
        $('#modalSeNo').text(seNo);
        $('#modalLat').text(lat);
        $('#modalLon').text(lon);
        $('#modalDate').text(date);
        $('#modalTime').text(time);
        $('#modalType').text(type);
        $('#modalSeverity').text(severity);
        $('#modalVehicle1').text(vehicle1);
        $('#modalVehicle2').text(vehicle2);
        $('#modalVehicle3').text(vehicle3);
        $('#modalMalePasInj').text(malePasInj);
        $('#modalFemalePasInj').text(femalePasInj);
        $('#modalMalePedInj').text(malePedInj);
        $('#modalFemalePedInj').text(femalePedInj);
        $('#modalChildInj').text(childInj);
        $('#modalDes').text(des);
        $('#modalDrunkness').text(drunkness);
        $('#modalRemarks').text(remarks);

        // Parse and display images
        try {
            const imageArray = JSON.parse(images);
            let imageHtml = '';
            imageArray.forEach(image => {
                imageHtml +=
                `<img src="assets/img/${image}" alt="Accident Image" onclick="enlargeImage(this)">`;
            });
            $('#modalImages').html(imageHtml);
        } catch (error) {
            console.error('Error parsing images:', error);
            $('#modalImages').html('<p>No images available</p>');
        }
    }

    function enlargeImage(imgElement) {
        if (imgElement.classList.contains('enlarged')) {
            imgElement.classList.remove('enlarged');
        } else {
            imgElement.classList.add('enlarged');
        }
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
                                <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#projectDetailsModal"
                                    onclick="setDescription(
                                        '${accident.user_id}', 
                                        '${accident.se_no}', 
                                        '${accident.lat}', 
                                        '${accident.lon}', 
                                        '${accident.date}', 
                                        '${accident.time}', 
                                        '${accident.acd_type}', 
                                        '${accident.severity}', 
                                        '${accident.vehicle_1}', 
                                        '${accident.vehicle_2}', 
                                        '${accident.vehicle_3}', 
                                        '${accident.male_pedestrian}', 
                                        '${accident.female_pedestrian}',
                                        '${accident.object}', 
                                        '${accident.weather}', 
                                        '${accident.male_passengers}', 
                                        '${accident.female_passengers}', 
                                        '${accident.children_count}', 
                                        '${accident.des}', 
                                        '${accident.drunkness}', 
                                        '${accident.remarks}',
                                    )">See More</button>
                                <a href="" class="btn btn-sm btn-danger">Update</a>
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#searchaccidents').on('keyup', function() {
            var seno = $(this).val();
            $.ajax({
                url: '{{ route('searchReports') }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    search: seno
                },
                success: function(response) {
                    $('#accidentTableBody').empty();
                    if (response.data.length > 0) {
                        var accidents = response.data;
                        var x = 1;
                        accidents.forEach(function(accidents) {
                            $('#accidentTableBody').append(`
                                <tr>
                                    <td>${x}</td>
                                    <td>${accidents.user_id}</td>
                                    <td>${accidents.se_no}</td>
                                    <td>
                                        <a href="https://www.google.com/maps/search/?api=1&query=${accidents.lat},${accidents.lon}"
                                            target="_blank" style="color: inherit; text-decoration: underline;">
                                            ${accidents.lat},${accidents.lon}
                                        </a>
                                    </td>
                                    <td>${accidents.date}</td>
                                    <td>${accidents.time}</td>
                                    <td>${accidents.acd_type}</td>
                                    <td>${accidents.severity}</td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#projectDetailsModal"
                                            onclick="setDescription(
                                                '${accidents.user_id}', 
                                                '${accidents.se_no}', 
                                                '${accidents.lat}', 
                                                '${accidents.lon}', 
                                                '${accidents.date}', 
                                                '${accidents.time}', 
                                                '${accidents.acd_type}', 
                                                '${accidents.severity}', 
                                                '${accidents.vehicle_1}', 
                                                '${accidents.vehicle_2}', 
                                                '${accidents.vehicle_3}', 
                                                '${accidents.male_pedestrian}', 
                                                '${accidents.female_pedestrian}',
                                                '${accidents.object}', 
                                                '${accidents.weather}', 
                                                '${accidents.male_passengers}', 
                                                '${accidents.female_passengers}', 
                                                '${accidents.children_count}', 
                                                '${accidents.des}', 
                                                '${accidents.drunkness}',
                                                '${accidents.images}', 
                                                '${accidents.remarks}'
                                            )">See More</button>
                                        <a href="" class="btn btn-sm btn-primary">Update</a>
                                        <a href="/accidentremove${accidents.id}" class="btn btn-sm btn-danger">Remove</a>
                                    </td>
                                </tr>
                            `);
                            x++;
                        });
                    } else {
                        $('#accidentTableBody').append(
                            '<tr><td colspan="9">No accident found</td></tr>');
                    }
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });
    });
</script>
