@extends('frontend.app', ['activePage' => 'prices', 'title' => __('My Adjustr')])

@section('content')

    <section id="sec1">
        <div class="container">
            <div class="row">
                <div class="col text-center">
                    <h1>How my<span class="blue-text">adjustr</span> works</h1>
                    <hr class="blue-line">
                </div>
            </div>
            <div class="row text-center">
                <div class="col-md-4 col-sm-12">
                    <img class="img-fluid mh200 mb-4" src="images/undraw_steps_ngvm.svg" >
                    <p class="fs20 font-weight-bold">We show customers your business</p>
                    <p class="mb-4">We match customers with your business based on the avaible information.</p>
                </div>
                <div class="col-md-4 col-sm-12 ">
                    <img class="img-fluid mh200 mb-4" src="images/undraw_personal_text_vkd8.svg" >
                    <p class="fs20 font-weight-bold">Customers contacts you</p>
                    <p class="mb-4">If a customer thinks you’re a great fit, they will reach out to you and hire you.</p>
                </div>
                <div class="col-md-4 col-sm-12 ">
                    <img class="img-fluid mh200 mb-4" src="images/undraw_agreement_aajr.svg">
                    <p class="fs20 font-weight-bold">Accept Job</p>
                    <p class="mb-4">It is up to you to accept the job if you have been hired. You only pay when you accept a job.</p>
                </div>
            </div>

        </div>
    </section>

    <section id="sec2">
        <div class="container">
            <div class="row text-center">
                <div class="col">
                    <p class="fs20 font-weight-bold">Start connecting with customers</p>
                </div>
            </div>
            <div class="row text-center mt-3">
                <div class="col">
                    <button type="button" onclick="window.location='{{ route('register') }}'; return false;" class="btn btn-primary">Join Us</button>
                </div>
            </div>
        </div>
    </section>

@endsection
