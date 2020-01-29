@extends('frontend.app', ['activePage' => 'services', 'title' => __('My Adjustr')])

@section('content')

    <section id="sec1">
        <div class="container">
            <div class="row">
                <div class="col text-center">
                    <h1>Services and Fees</h1>
                    <hr class="blue-line">
                </div>
            </div>
            <div class="row">

                <div class="col-sm-12 d-md-none d-lg-none d-xl-none ">
                    <div class="text-sm-center text-xs-center">
                        <p class="mb-5">MyAdjustr is a FREE platform that offers services for homeowners at no cost. When a homeowners jires a professional claims handler, they charge you a fee of the final settlement whitc might be from 5-20% depending on your claim.</p>
                    </div>
                </div>
                <div class="col">
                    <div>
                        <img class="img-fluid" src="images/undraw_services.svg" >
                    </div>
                </div>
                <div class="col  d-sm-none d-xs-none d-md-flex align-items-center ">
                    <div>
                        <p>MyAdjustr is a FREE platform that offers services for homeowners at no cost. When a homeowners jires a professional claims handler, they charge you a fee of the final settlement whitc might be from 5-20% depending on your claim.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
