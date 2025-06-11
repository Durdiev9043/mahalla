@extends('operator.layouts.app')

@section('content')

    <style>
        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 999; /* Sit on top */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgb(0,0,0); /* Fallback color */
            background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
        }

        /* Modal Content/Box */
        .modal-content {
            background-color: #fefefe;
            margin: 5% auto; /* 15% from the top and centered */
            padding: 20px;
            border: 1px solid #888;
            width: 80%; /* Could be more or less, depending on screen size */
        }

        /* The Close Button */
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
        body>footer>div{
            display: none !important;
        }
    </style>
    <!-- ======= Header ======= -->


    <!-- ======= Sidebar ======= -->


    <main id="main" class="main">
        @if (\Session::has('success'))
            <div class="alert alert-success">
                <ul>
                    <li>{!! \Session::get('success') !!}</li>
                </ul>
            </div>
        @endif
        <div class="pagetitle">
            <h1>Mahallar Xodimlarning joylashuvi</h1>

            {{--            <div class="btn-add">--}}
            {{--                <a id="myBtn" href="#">Qoshish</a>--}}
            {{--            </div>--}}

        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">


                <div class="col-12 table_one">
                    <div class="card recent-sales overflow-auto table_one">

                        <div class="filter">
                            <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                <li class="dropdown-header text-start">
                                    <h6>Filter</h6>
                                </li>

                                <li><a class="dropdown-item" href="#">Today</a></li>
                                <li><a class="dropdown-item" href="#">This Month</a></li>
                                <li><a class="dropdown-item" href="#">This Year</a></li>
                            </ul>
                        </div>


                        <div class="card-body p-3">
                            @foreach($villages as $village)
                                <a href="{{ route('currentLocationVillage',$village->id) }}"  class="btn btn-success">{{$village->name}}</a>
                            @endforeach
                            <div class="row">
                                <h3>Xodimlarning So‘nggi Joylashuvi</h3>

                                <div id="map" class="col-7">
                                    <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>
                                    <style>
                                        #map {
                                            width: 60%;
                                            height: 300px;
                                            padding: 0;
                                            margin: 0;
                                        }
                                    </style>
                                    <!-- Leaflet JS -->
                                    <script>
                                        // Laraveldan olingan massivni JavaScriptga uzatamiz
                                        const locations = @json($users);

                                        ymaps.ready(function () {
                                            var map = new ymaps.Map("map", {
                                                center: [41.67, 60.76],
                                                zoom: 6
                                            });

                                            let points = [];

                                            // Markerlar va koordinatalar massivini to‘plash
                                            locations.forEach(function (loc) {
                                                if (loc.lat && loc.lang) {
                                                    const coords = [loc.lat, loc.lang];
                                                    points.push(coords);

                                                    const marker = new ymaps.Placemark(coords, {
                                                        balloonContent: `
                        <strong>${loc.name}</strong><br>
                        📞 Telefon: ${loc.phone ?? '–'}<br>
                        ✉️ Email: ${loc.email ?? '–'}<br>
                        🕒 So‘nggi joylashuv: ${loc.created_at}<br>`
                                                    });
                                                    map.geoObjects.add(marker);
                                                }
                                            });

                                            // Chiziqlarni chizish (polyline)
                                            if (points.length >= 2) {
                                                const polyline = new ymaps.Polyline(points, {}, {
                                                    balloonCloseButton: false,
                                                    strokeColor: "#FF0000", // chiziq rangi
                                                    strokeWidth: 4,         // chiziq qalinligi
                                                    strokeOpacity: 0.7
                                                });

                                                map.geoObjects.add(polyline);
                                                map.setBounds(polyline.geometry.getBounds(), {
                                                    checkZoomRange: true
                                                });
                                            }
                                        });
                                    </script>
                                    <div>
                                    </div>
                                </div>
                                <div class="col-4">
{{--                                    <table class="table bordered">--}}
{{--                                        <tr>--}}
{{--                                            <td>F.I.O</td>--}}
{{--                                            <td>Mahalla</td>--}}
{{--                                            <td>oxirgi ma'lumot bergan vaqt</td>--}}
{{--                                            <td>Holati</td>--}}
{{--                                        </tr>--}}
{{--                                        @foreach($users as $user)--}}
{{--                                            <tr>--}}
{{--                                                <td>{{$user->ismi}} {{$user->familyasi}}</td>--}}
{{--                                                <td>{{$user->village->name}}</td>--}}
{{--                                                <td>{{\Carbon\Carbon::parse($user->location_created_at)->addHours(5)->format('d M Y H:i')}}</td>--}}
{{--                                                <td>--}}
{{--                                                    @if( \Carbon\Carbon::parse($user->location_created_at)->diffInMinutes(now()) > 10)--}}
{{--                                                        offline--}}
{{--                                                    @else--}}
{{--                                                        online--}}
{{--                                                    @endif--}}
{{--                                                </td>--}}
{{--                                            </tr>--}}

{{--                                        @endforeach--}}
{{--                                    </table>--}}




                                </div>


                            </div>

                        </div>
                    </div>




                </div>

        </section>

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->


    {{--<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>--}}

    <!-- Vendor JS Files -->


    <script src="{{asset('/js/core/jquery.3.2.1.min.js')}}"></script>
    <script src="{{asset('/js/plugin/datatables/datatables.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>



    <script>
        function cat(cat) {
            cat = $('#category_id').val();
            $.ajax(
                    {{--                "{{route('cat.filter')}}",--}}
                {
                    method: 'post',
                    headers: {
                        'X-CSRF-TOKEN': '{{csrf_token()}}'
                    },
                    data: {
                        cat: cat,
                    },
                    success: function (data) {

                        $('#hash_id').empty()
                        for (let d in data) {
                            let option = '<option value=' + data[d].id + '>' + data[d].name + '</option>';
                            $('#hash_id').append(option)
                        }
                    }
                });
        }
        function catfilter(cat) {
            cat = $('#cat_id').val();
            $.ajax(
                    {{--"{{route('cat.filter')}}",--}}
                {
                    method: 'post',
                    headers: {
                        'X-CSRF-TOKEN': '{{csrf_token()}}'
                    },
                    data: {
                        cat: cat,
                    },
                    success: function (data) {

                        $('#hash_id').empty()
                        for (let d in data) {
                            let option = '<option value=' + data[d].id + '>' + data[d].name + '</option>';
                            $('#hash_id').append(option)
                        }
                    }
                });
        }
        $(document).ready( function () {
            $('#table').DataTable({
                dom: 'Bfrtip',
                "buttons": [
                    {
                        "extend": 'excel', "text":' Малумотларни excel форматда юклаб олиш',"className": 'btn btn-primary btn-xm'
                    }
                ],
                "aLengthMenu": [200],
            });
            $('#exportButton').on('click', function() {
                exportToExcel();
            });


            function exportToExcel() {
                var wb = XLSX.utils.table_to_book(document.getElementById('table'), {sheet: 'Sheet JS'});
                var wbout = XLSX.write(wb, {bookType:'xlsx',  type: 'binary'});

                function s2ab(s) {
                    var buf = new ArrayBuffer(s.length);
                    var view = new Uint8Array(buf);
                    for (var i=0; i<s.length; i++) view[i] = s.charCodeAt(i) & 0xFF;
                    return buf;
                }

                saveAs(new Blob([s2ab(wbout)],{type:"application/octet-stream"}), 'data.xlsx');
            }

        } );
        var modal = document.getElementById("myModal");

        var btn = document.getElementById("myBtn");

        var span = document.getElementsByClassName("close")[0];

        btn.onclick = function() {
            modal.style.display = "block";
        }

        span.onclick = function() {
            modal.style.display = "none";
        }

        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }

    </script>


@endsection
