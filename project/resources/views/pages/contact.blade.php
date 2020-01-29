@extends('frontend.app', ['activePage' => 'contact', 'title' => __('My Adjustr')])

@section('content')

    <section class="contact contact-xs contact-sm" id="sec1">
        <div class="container">
            <div class="row mb-5">
                <div class="col text-center">
                    <h1>Contact Us</h1>
                    <hr class="blue-line">
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 mb-5">
                    <div class="text-center text-dark mb-2">
                        <a class="fs20 text-dark font-weight-bold" href="">1-800-123-4567</a>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Call Us</button>
                    </div>
                </div>

                <div class="col-md-4 mb-5">
                    <div class="text-center text-dark mb-2">
                        <a class="fs20 text-dark font-weight-bold" href="">support@myadjustr.com</a>
                    </div>
                    <div class="text-center">
                        <img class="img-contact" height="60" src="images/envelope.svg">
                    </div>
                </div>

                <div class="col-md-4 mb-5">
                    <div class="text-center text-dark mb-2">
                        <a class="fs20 text-dark font-weight-bold" href="">Chat with Us</a>
                    </div>
                    <div class="text-center">
                        <img class="img-contact" height="60" src="images/chat.svg">
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
