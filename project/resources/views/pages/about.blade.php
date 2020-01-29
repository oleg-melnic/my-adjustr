@extends('frontend.app', ['activePage' => 'about', 'title' => __('My Adjustr')])

@section('content')

    <section id="sec1">
        <div class="container">
            <div class="row">
                <div class="col text-center">
                    <h1>About my<span class="blue-text">adjustr</span></h1>
                    <hr class="blue-line">
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12 d-md-none d-lg-none d-xl-none">
                    <div class="text-sm-center text-xs-center text-md-left">
                        <h5 class="mt-sm-5 font-weight-bold">WHAT</h5>
                        <p>We're on a mission to help people getting the settlement that they deserve.</p>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div>
                        <img class="img-fluid" src="images/undraw_what.svg">
                    </div>
                </div>
                <div class="col-md-6 d-sm-none d-xs-none d-md-flex align-items-center ">
                    <div class="text-md-left">
                        <h5 class="font-weight-bold">WHAT</h5>
                        <p>We're on a mission to help people getting the settlement that they deserve.</p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 col-sm-12 d-md-flex align-items-center">
                    <div class="text-sm-center text-xs-center text-md-right">
                        <h5 class=" mt-sm-5 mt-xs-5 font-weight-bold">WHY</h5>
                        <p>We believe that homeowners should not be alone when dealing with a claim and that insurance providers often take advantage of homeowners because of their lack of expertise and time constraints thus providing them with an unfair settlement</p>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div>
                        <img class="img-fluid" src="images/undraw_why.svg">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12 d-md-none d-lg-none d-xl-none">
                    <div class="text-sm-center text-xs-center text-md-left">
                        <h5 class="mt-sm-5 mt-xs-5 font-weight-bold">WHO</h5>
                        <p>There is no time to lose when your property has been damaged. With us, we speed up the process by connecting you with a trusted local claims specialist while keeping you informed every step of the way. With our support and a professionals expertise, we can get you the settlement that you deserve.</p>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div>
                        <img class="img-fluid" src="images/undraw_how.svg">
                    </div>
                </div>
                <div class="col-md-6 d-sm-none d-xs-none d-md-flex align-items-center">
                    <div class="text-md-left">
                        <h5 class="font-weight-bold">WHO</h5>
                        <p>There is no time to lose when your property has been damaged. With us, we speed up the process by connecting you with a trusted local claims specialist while keeping you informed every step of the way. With our support and a professionals expertise, we can get you the settlement that you deserve.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
