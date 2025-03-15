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
            <h1>Qoshimcha Manzillar haqida malumot </h1>

            {{--            <div class="btn-add">--}}
            {{--                <a id="myBtn" href="#">Qoshish</a>--}}
            {{--            </div>--}}

        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">


                <div class="col-12 table_one row" >
                    <div class="col-6 card recent-sales overflow-auto table_one">


                        <div class="card-body">
                            <h5 class="card-title"> <span></span></h5>
                            <h5 class="card-title"><span></span></h5>
                            <form method="post" action="{{ route('location.store') }}">
                                @csrf
                                <input type="hidden" name="district_id" value="{{ \Illuminate\Support\Facades\Auth::user()->district_id }}">
                                <div class="form-group mb-3">
                                    <label for="exampleInputEmail1" class="mb-2">Tashkilotni tanlang</label>
                                    <select class="form-control form-control-sm"  id="" name="type">
                                        <option value="1">Tuman (Shaxar) hokimligi</option>
                                        <option value="2">Kambag`allik qisqartirish va aholi bandlikida ko'maklashish bo'limi</option>
                                    </select>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <input type="text" value="" class="form-control" name="lat" placeholder="Lat">
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control"  value=""  name="lang" placeholder="Lang">
                                    </div>
                                </div>
                                <div class="form-group mt-3">
                                    <button class="btn btn-primary w-100">Saqlash</button>
                                </div>

                            </form>
                        </div>

                        <div class="card-body">
                            <table class="table table-borderless datatable">
                                <thead>
                                <tr>
                                    {{--                                    <th scope="col">#</th>--}}
                                    <th scope="col">#</th>
                                    <th scope="col">Tashkilot </th>
{{--                                    <th scope="col">Manzil</th>--}}
                                    <th scope="col">Joylashuv</th>




                                </tr>
                                </thead>
                                <tbody>
@foreach($data as $item)
                                    <tr>
                                        <td></td>
                                        <td>{{ $item->tt[$item->type] }}</td>
                                        <td> {{$item->lat}}, {{ $item->lang }} </td>




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

                            </div>
                        </div>

                    </div>

</div>


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
