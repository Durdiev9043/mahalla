@extends('operator.layouts.app')

@section('content')


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
            <h1>Mahalla yettiligini nazorat qiluvchi axborot tizimi</h1>

{{--            <div class="btn-add">--}}
{{--                <a href="{{ route('patient.create') }}">Be`mor qoshish</a>--}}
{{--            </div>--}}

        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">


                <div class="col-12 table_one">
                    <div class="card recent-sales overflow-auto table_one">

{{--                        <div class="filter">--}}
{{--                            <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>--}}
{{--                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">--}}
{{--                                <li class="dropdown-header text-start">--}}
{{--                                    <h6>Filter</h6>--}}
{{--                                </li>--}}

{{--                                <li><a class="dropdown-item" href="#">Today</a></li>--}}
{{--                                <li><a class="dropdown-item" href="#">This Month</a></li>--}}
{{--                                <li><a class="dropdown-item" href="#">This Year</a></li>--}}
{{--                            </ul>--}}
{{--                        </div>--}}

                        <div class="card-body row">

                            <div style="margin-top: 10px" >

                                <table class="table table-borderless datatable">
                                    <thead>
                                    <tr>
                                        {{--                                    <th scope="col">#</th>--}}
                                        <th scope="col">#</th>
                                        <th scope="col">Mahalla</th>
                                        <th scope="col">Xodim</th>
                                        <th scope="col">Vaqti</th>



                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($data as $item)
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td>{{ $item->user->name }}</td>
                                            <td>{{ $item->created_at->format('H:s') }}</td>


                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
{{--                            <div style="margin-top: 10px" class="col-6">--}}
{{--                            </div>--}}




                        </div>

                    </div>
                </div>




            </div>

        </section>

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->


    {{--<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>--}}

    <!-- Vendor JS Files -->





@endsection
