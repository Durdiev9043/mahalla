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
$data=$request->all();
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
            <h1>{{ $village->name }}</h1>

{{--            <div class="btn-add">--}}
{{--                <a id="myBtn" href="#">Qoshish</a>--}}
{{--            </div>--}}

        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">


                <div class="col-12 table_one row" >
                    <div class="col-6 card recent-sales overflow-auto table_one">
                        <div class="pagetitle">


                            <div class="btn-add">
                                <a id="myBtn" href="#">Qoshish</a>
                            </div>

                        </div>
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

                        <div class="card-body">
                            <h5 class="card-title"> <span>Xodimlar bo'yicha ma'lumot</span></h5>

                            <table class="table table-borderless datatable">
                                <thead>
                                <tr>
                                    {{--                                    <th scope="col">#</th>--}}
                                    <th scope="col">#</th>
                                    <th scope="col">F.I.SH</th>
                                    <th scope="col">Lavozimi</th>
                                    <th scope="col">Tel</th>
                                    <th scope="col">Elektron pochta</th>
                                    <th scope="col">Surati</th>



                                </tr>
                                </thead>
                                <tbody>

@foreach($users as $user)
                                    <tr>
                                        <td></td>
                                        <td>{{ $user->ismi }} {{ $user->familyasi }} {{ $user->otasini_ismi }}</td>
                                        <td>{{ $user->position->name }}</td>
                                        <td>{{ $user->phone }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td><img src="{{ asset('/storage/galereya/'.$user->img) }}"
                                                 alt="Geeks Image"  width="150px" /></td>


                                    </tr>
@endforeach
                                </tbody>
                            </table>

                            <style>
                                .image-container img {
                                    transition: transform 0.3s ease-in-out;
                                }

                                .image-container img:hover {

                                    transform: scale(4);
                                    position: relative;
                                    right: 30%;
                                    top: 30%;
                                }
                            </style>
                            <div id="myModal" class="modal" >

                                <!-- Modal content -->
                                <div class="modal-content p-5 m-1">
                                    <span class="close">&times;</span>
                                    <form method="POST" action="{{ route('user.store') }}" accept-charset="UTF-8"
                                          enctype="multipart/form-data">
                                        @csrf
{{--                                        <div class="form-group">--}}
{{--                                            <label for="exampleInputEmail1">Mahallani tanlang</label>--}}
{{--                                            <select class="form-control form-control-sm"  id="" name="village_id">--}}
{{--                                                @foreach($villages as $item)<option value="{{$item->id}}">{{ $item->name }}</option>@endforeach--}}
{{--                                            </select></div>--}}
                                        <input type="hidden" name="village_id" value="{{ $village->id }}">
                                        <div class="form-group">

                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Ismi</label>
                                                <input type="text" class="form-control" id="exampleInputEmail1" name="ismi" >
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Familyasi</label>
                                                <input type="text" class="form-control" id="exampleInputEmail1" name="familyasi" >
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Otasining ismi</label>
                                                <input type="text" class="form-control" id="exampleInputEmail1" name="otasini_ismi" >
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="exampleInputEmail1" class="mb-2">Tashkilotni tanlang</label>
                                                <select class="form-control form-control-sm"  id="" name="position_id">
                                                    @foreach($position as $item) <option value="{{ $item->id }}">{{ $item->name }}</option> @endforeach

                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">login</label>
                                                <input type="text" class="form-control" id="exampleInputEmail1" name="name">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Elektron pochta</label>
                                                <input type="email" class="form-control" id="exampleInputEmail1" name="email"  placeholder="Elektron pochta:">

                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Tel:</label>
                                                <input type="number" name="phone" class="form-control" id="exampleInputPassword1" placeholder="Telefon raqamingiz">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Parol</label>
                                                <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Parol">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Surati :</label>
                                                <input type=file name="img" >


                                            </div>

                                            <button type="submit" class="btn btn-primary">Saqlash</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-6 card recent-sales overflow-auto table_one">
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

                        <div class="card-body">
                            <h5 class="card-title"><span>Mahalla fuqoralar yig`inining joylashuvi </span></h5>
                            <form method="post" action="{{ route('location.store') }}">
                                @csrf
                                <input type="hidden" name="village_id" value="{{ $village->id }}">
                                <input type="hidden" name="type" value="0">
                                <div class="row">
                                    <div class="col">
                                        <input type="text" @if($loc) value="{{ $loc->lat }}" @endif class="form-control" name="lat" placeholder="Lat">
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control" @if($loc) value="{{ $loc->lang }}" @endif name="lang" placeholder="Lang">
                                    </div>
                                </div>
                                <button>saqlash</button>
                            </form>


                            <style>
                                .image-container img {
                                    transition: transform 0.3s ease-in-out;
                                }

                                .image-container img:hover {

                                    transform: scale(4);
                                    position: relative;
                                    right: 30%;
                                    top: 30%;
                                }
                            </style>
                            <div id="myModal" class="modal" >

                                <!-- Modal content -->
                                <div class="modal-content">
                                    <span class="close">&times;</span>
                                    <form method="POST" action="{{ route('village.store') }}" accept-charset="UTF-8"
                                          enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">nomi</label>
                                            <input type="text" class="form-control" id="exampleInputEmail1" name="name" aria-describedby="emailHelp" placeholder="nomi">

                                        </div>
                                    </form>
                                </div>
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
