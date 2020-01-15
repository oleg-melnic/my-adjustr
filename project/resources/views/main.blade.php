@extends('frontend.app', ['activePage' => 'home', 'title' => __('My Adjustr')])

@section('content')
    <section class="first-page" id="sec1">
        <div class="container">
            <div class="row">
                <div class="col text-center">
                    <h1 class="font-weight-bold">Need help with your claim?</h1>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-4  col-sm-12 text-center">
                    <p>We guide you through the claims process and connect you to local trusted professionals.</p>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-4  col-sm-12 text-center">
                    <button type="button" class="btn btn-primary">Get Started</button>
                </div>
            </div>
        </div>
    </section>


    <section id="sec2">
        <div class="container">
            <div class="row">
                <div class="col text-center">
                    <h1>How We Work?</h1>
                    <hr class="blue-line">
                </div>
            </div>

            <div class="row mb-5 text-center justify-content-center">
                <div class="col-md-6 col-sm-10 ">
                    <p >Most homeowners do not have the necessary time or expertise that a claim requires which results in things being overlooked. This might result in a lower settlement and lost of stress.</p>
                </div>
            </div>

            <div class="row ">
                <div class="col-md-4 col-sm-12 " >
                    <a class="a-unstyled" href=""  data-toggle="modal" data-target="#myModal" contenteditable="false">
                        <div class="square mb-5">
                            <div class="p20  bg-white text-center">
                                <img class="im" src="images/share.svg" height="125">
                                <h6 class="font-weight-bold">Small shadow</h6>
                                <p>Tell us a little about yourserf.</p>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-md-4 col-sm-12 ">
                    <a class="a-unstyled" href="">
                        <div class="square mb-5">
                            <div class="p20 bg-white text-center">
                                <img class="im" src="images/compare.svg" height="125">
                                <h6 class="font-weight-bold">Compare</h6>
                                <p>Based on the information you provided, we will guide you through the process and connect you with a trusted local professional the same day.</p>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-md-4 col-sm-12 ">
                    <a class="a-unstyled" href="" >
                        <div class="square mb-5">
                            <div class="p20 bg-white  text-center">
                                <img class="im" src="images/save.svg" height="125">
                                <h6 class="font-weight-bold">Save</h6>
                                <p>No more headache and stress. Let a professional deal with everything and get you the settlement that you deserve.</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section id="sec3">
        <div class="container">
            <div class="row">
                <div class="col text-center">
                    <h1>It’s easy to get a better settlement</h1>
                    <hr class="blue-line">
                </div>
            </div>
            <div class="row padding-settlement">
                <div class="col-md-3 offset-md-2">
                    <div class="text-center">
                        <img class="mh170 img-fluid" src="images/undraw_find-professional.svg">
                        <p class="mt-2 fs16 font-weight-bold">Find a professional<br>online</p>
                        <button type="button" class="btn btn-primary">Get Started</button>
                    </div>
                </div>
                <div class="col-md-2 mb-5">
                    <div class="d-xs-none d-sm-none d-md-block">
                        <span><hr class="vertical-blue-line"></span>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="text-center">
                        <img class="mh170 img-fluid" src="images/undraw_contact-us.svg" >
                        <p class="mt-2 fs16 font-weight-bold">Contact us and<br>we will help you</p>
                        <button type="button" class="btn btn-primary">1-800-123-4567</button>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <div id="myModal" class="modal" role="dialog">
        <div class="modal-dialog modal-full">
            <div class="modal-content ">
                <div class="modal-header ">
                    <button type="button" class="close" data-dismiss="modal"><i class="fas fa-times"></i></button>
                </div>
                <div class="modal-body d-flex align-content-center flex-wrap">
                    <div class="container  ">

                        <div class="row">
                            <div class="col text-center">
                                <h1>What’s  your Zip Code?</h1>
                                <hr class="blue-line">
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-md-6 col-sm-10">
                                <form>
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter your number">
                                    </div>
                                    <div class="form-group text-center">
                                        <button type="button" class="btn  btn-primary btn-next">Next</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-full">
            <div class="modal-content ">
                <div class="modal-header ">

                    <button type="button" class="btn btn-default btn-prev"><i class="fas fa-arrow-left"></i> Back</button>
                    <button type="button" class="close" data-dismiss="modal"><i class="fas fa-times"></i></button>

                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="col text-center">
                                <h1 class="font-weight-bold">33180</h1>
                                <h1>Who is your insurance provider?</h1>
                                <hr class="blue-line">
                            </div>
                        </div>
                        <div class="row text-center">
                            <a href="#"  class="col-lg-2 offset-lg-1 col-sm-4">
                                <img src="images/logos/state-farm.jpg" class=" mb-5 gray-filter mh100 mw150  img-fluid">
                            </a>
                            <a href="#"  class="col-lg-2 offset-lg-2 col-sm-4">
                                <img src="images/logos/allstate.png" class=" mb-5 gray-filter mh100 mw150 img-fluid ">
                            </a>
                            <a href="#"  class="col-lg-2 offset-lg-2 col-sm-4">
                                <img src="images/logos/liberty.png" class="mb-5 gray-filter mh100 mw150 img-fluid ">
                            </a>
                        </div>
                        <div class="row text-center ">
                            <a href="#"  class="col-lg-2  offset-lg-1 col-sm-4">
                                <img src="images/logos/usaa.png" class="mb-5 gray-filter mh100 mw150 img-fluid ">
                            </a>
                            <a href="#"   class="col-lg-2  offset-lg-2 col-sm-4">
                                <img src="images/logos/farmers.png" class="mb-5 gray-filter mh100 mw150 img-fluid ">
                            </a>
                            <a href="#"   class="col-lg-2 offset-lg-2 col-sm-4">
                                <img src="images/logos/nationwide.png" class="mb-5 gray-filter mh100 mw150 img-fluid ">
                            </a>
                        </div>
                        <div class="row text-center">
                            <a href="#"  class="col-lg-2 offset-lg-1 col-sm-4">
                                <img src="images/logos/chubb.png" class="mb-5 gray-filter mh100 mw150 img-fluid ">
                            </a>
                            <a href="#"   class="col-lg-2 offset-lg-2 col-sm-4">
                                <img src="images/logos/erie.png" class="mb-5 gray-filter mh100 mw150 img-fluid ">
                            </a>
                            <a href="#"   class="col-lg-2 offset-lg-2 col-sm-4">
                                <img src="images/logos/metlife.png" class="mb-5 gray-filter mh100 mw150 img-fluid ">
                            </a>
                        </div>

                        <div class="row justify-content-center ">
                            <div class="col-md-4 col-sm-8 text-center">
                                <p class="fs16 font-weight-bold">Not listed?</p>
                                <form>
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter your number">
                                    </div>
                                    <button type="button" class="btn btn-primary btn-next">Next</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-full">
            <div class="modal-content ">
                <div class="modal-header ">

                    <button type="button" class="btn btn-default btn-prev"><i class="fas fa-arrow-left"></i> Back</button>
                    <button type="button" class="close" data-dismiss="modal"><i class="fas fa-times"></i></button>

                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="col text-center">
                                <h1>What Type of Property?</h1>
                                <hr class="blue-line">
                            </div>
                        </div>
                        <div class="row text-center">
                            <div class="col-md-2 offset-md-1">
                                <a class="btn-next" href="#" >
                                    <img src="images/house.svg" class="gray-filter mh100 img-fluid">
                                    <p class="ps16 font-weight-bold">Single-Family Home</p>
                                </a>
                            </div>

                            <div class="col-md-2 offset-md-2">
                                <a href="#"  >
                                    <img src="images/condominium.svg" class="gray-filter mh100 img-fluid ">
                                    <p class="ps16 font-weight-bold">Apartment</p>
                                </a>
                            </div>

                            <div class="col-md-2 offset-md-2">
                                <a href="#" >
                                    <img src="images/townhouse.svg" class="gray-filter mh100 img-fluid">
                                    <p class="ps16 font-weight-bold">Townhouse</p>
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="myModal4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-full">
            <div class="modal-content ">
                <div class="modal-header ">

                    <button type="button" class="btn btn-default btn-prev"><i class="fas fa-arrow-left"></i> Back</button>
                    <button type="button" class="close" data-dismiss="modal"><i class="fas fa-times"></i></button>

                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="col text-center">
                                <h1>Select type of damages sustained</h1>
                                <hr class="blue-line">
                            </div>
                        </div>
                        <div class="row text-center">
                            <div class="col-md-2 offset-md-1">
                                <a class="btn-next" href="#" >
                                    <img  src="images/tornado.svg" class="gray-filter mh100 img-fluid">
                                    <p class="ps16 font-weight-bold">Hurricane</p>
                                </a>
                            </div>

                            <div class="col-md-2 offset-md-2">
                                <a href="#"  >
                                    <img src="images/fire.svg" class="gray-filter mh100 img-fluid ">
                                    <p class="ps16 font-weight-bold">Fire</p>
                                </a>
                            </div>

                            <div class="col-md-2 offset-md-2">
                                <a href="#" >
                                    <img src="images/townhouse.svg" class="gray-filter mh100 img-fluid">
                                    <p class="ps16 font-weight-bold">Water</p>
                                </a>
                            </div>
                        </div>

                        <div class="row text-center mt-5">
                            <div class="col-md-2 offset-md-1">
                                <a class="btn-next" href="#" >
                                    <img  src="images/roof.svg" class="gray-filter mh100 img-fluid">
                                    <p class="ps16 font-weight-bold">Roof</p>
                                </a>
                            </div>

                            <div class="col-md-2 offset-md-2">
                                <a href="#"  >
                                    <img src="images/waste.svg" class="gray-filter mh100 img-fluid ">
                                    <p class="ps16 font-weight-bold">Plumbing</p>
                                </a>
                            </div>

                            <div class="col-md-2 offset-md-2">
                                <a href="#" >
                                    <img  src="images/thief.svg" class="gray-filter mh100 img-fluid">
                                    <p class="ps16 font-weight-bold">Bulgary</p>
                                </a>
                            </div>
                        </div>

                        <div class="row text-center mt-5">
                            <div class="col-md-2 offset-md-1">
                                <a class="btn-next" href="#" >
                                    <img  src="images/hailstorm.svg" class="gray-filter mh100 img-fluid">
                                    <p class="ps16 font-weight-bold">Hail</p>
                                </a>
                            </div>

                            <div class="col-md-2 offset-md-2">
                                <a href="#"  >
                                    <img src="images/lightning.svg" class="gray-filter mh100 img-fluid ">
                                    <p class="ps16 font-weight-bold">Storm</p>
                                </a>
                            </div>

                            <div class="col-md-2 offset-md-2">
                                <a href="#" >
                                    <img  src="images/flood.svg" class="gray-filter mh100 img-fluid">
                                    <p class="ps16 font-weight-bold">Flood</p>
                                </a>
                            </div>
                        </div>

                        <div class="row justify-content-center mt-5">
                            <div class="col-md-4  col-sm-8 text-center">
                                <p class="fs16 font-weight-bold">Not listed?</p>
                                <form>
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter your number">
                                    </div>
                                    <button type="button" class="btn btn-primary btn-next">Next</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="myModal5" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-full">
            <div class="modal-content ">
                <div class="modal-header ">
                    <button type="button" class="btn btn-default btn-prev"><i class="fas fa-arrow-left"></i> Back</button>
                    <button type="button" class="close" data-dismiss="modal"><i class="fas fa-times"></i></button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="col text-center">
                                <h1>What is your current claim status?</h1>
                                <hr class="blue-line">
                            </div>
                        </div>
                        <div class="row text-center">
                            <div class="col-md-2 offset-md-3">
                                <a class="btn-next" href="#" >
                                    <p class="fs20 font-weight-bold">Active</p>
                                </a>
                            </div>

                            <div class="col-md-2 offset-md-2">
                                <a href="#"  >
                                    <p class="fs20 font-weight-bold">Denied</p>
                                </a>
                            </div>
                        </div>

                        <div class="row text-center mt-5">
                            <div class="col-md-2 offset-md-3">
                                <a href="#" >

                                    <p class="fs20 font-weight-bold">Not filled</p>
                                </a>
                            </div>
                            <div class="col-md-2 offset-md-2">
                                <a href="#"  >
                                    <p class="fs20 font-weight-bold">Closed</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="myModal6" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-full">
            <div class="modal-content ">
                <div class="modal-header ">
                    <button type="button" class="btn btn-default btn-prev"><i class="fas fa-arrow-left"></i> Back</button>
                    <button type="button" class="close" data-dismiss="modal"><i class="fas fa-times"></i></button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="col text-center">
                                <h1>Let’s Finish up!</h1>
                                <hr class="blue-line">
                            </div>
                        </div>

                        <form class="form-finish">
                            <div class="row justify-content-center">
                                <div class="col-md-3 col-sm-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Firts Name">
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Last Name">
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-md-6 col-sm-12">
                                    <p class="font-weight-bold">Where would you like to receive updates?</p>
                                </div>

                            </div>

                            <div class="row justify-content-center">
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Email">
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Phone</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Phone Number (optional)">

                                    </div>
                                </div>
                            </div>

                            <div class="row justify-content-center">
                                <div class="col-md-6 col-sm-12">
                                    <p class="font-weight-bold">Where would you like to add anything?</p>
                                </div>
                            </div>

                            <div class="row justify-content-center">
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="4"></textarea>
                                        <div class="text-center">
                                            <small >By clicking Create Account you agree to the Terms of Use and Privacy Policy</small>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3 justify-content-center">
                                <div class="col-md-6 col-sm-12 text-center">
                                    <button type="button" class="btn btn-primary btn-next">Submit</button>
                                </div>
                            </div>
                        </form>

                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection
