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
            <h1>{{ $user->village->name }}</h1>

            {{--            <div class="btn-add">--}}
            {{--                <a id="myBtn" href="#">Qoshish</a>--}}
            {{--            </div>--}}

        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">


                <div class="col-12 table_one row" >
                    <div class="col-6 card recent-sales overflow-auto table_one">
                        <div class="pagetitle">


{{--                            <div class="btn-add">--}}
{{--                                <a id="myBtn" href="#">Qoshish</a>--}}
{{--                            </div>--}}

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


                            <div id="" class="" >

                                <!-- Modal content -->
                                <div class="modal-content p-5 m-1">
{{--                                    <span class="close">&times;</span>--}}
                                    <form method="POST" action="{{ route('update',$user->id) }}" accept-charset="UTF-8"
                                          enctype="multipart/form-data">
                                        @method('PUT')
                                        @csrf
                                        {{--                                        <div class="form-group">--}}
                                        {{--                                            <label for="exampleInputEmail1">Mahallani tanlang</label>--}}
                                        {{--                                            <select class="form-control form-control-sm"  id="" name="village_id">--}}
                                        {{--                                                @foreach($villages as $item)<option value="{{$item->id}}">{{ $item->name }}</option>@endforeach--}}
                                        {{--                                            </select></div>--}}

                                        <div class="form-group">

                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Ismi</label>
                                                <input type="text" class="form-control" value="{{ $user->ismi }}" id="exampleInputEmail1" name="ismi" >
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Familyasi</label>
                                                <input type="text" class="form-control" value="{{ $user->familyasi }}" id="exampleInputEmail1" name="familyasi" >
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Otasining ismi</label>
                                                <input type="text" class="form-control" id="exampleInputEmail1" value="{{ $user->otasini_ismi }}" name="otasini_ismi" >
                                            </div>

                                            <div class="form-group">
                                                <label for="exampleInputEmail1">login</label>
                                                <input type="text" class="form-control" value="{{ $user->name }}" id="exampleInputEmail1" name="name">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Elektron pochta</label>
                                                <input type="email" class="form-control" id="exampleInputEmail1" name="email" value="{{ $user->email }}"  placeholder="Elektron pochta:">

                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Tel:</label>
                                                <input type="number" name="phone" value="{{ $user->phone }}" class="form-control" id="exampleInputPassword1" placeholder="Telefon raqamingiz">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Parol</label>
                                                <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Parol">
                                            </div>
{{--                                            <div class="form-group">--}}
{{--                                                <label for="exampleInputEmail1">Surati :</label>--}}
{{--                                                <input type=file name="img" >--}}


{{--                                            </div>--}}

                                            <button type="submit" class="btn btn-primary">Saqlash</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
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





@endsection
