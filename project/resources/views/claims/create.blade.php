@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Claims Management')])

@section('css')
    <style type="text/css">
        #msform {
            text-align: center;
            position: relative;
            margin-top: 20px;
            z-index: 0;
        }

        #msform fieldset .form-card {
            background: white;
            border: 0 none;
            border-radius: 0px;
            box-shadow: 0 2px 2px 2px rgba(0, 0, 0, 0.2);
            padding: 20px 40px 30px 40px;
            box-sizing: border-box;
            width: 94%;
            margin: 0 3% 20px 3%;
            position: relative
        }

        #msform fieldset {
            background: white;
            border: 0 none;
            border-radius: 0.5rem;
            box-sizing: border-box;
            width: 100%;
            margin: 0;
            padding-bottom: 20px;
            position: relative
        }

        #msform fieldset:not(:first-of-type) {
            display: none
        }

        #msform fieldset .form-card {
            text-align: left;
            color: #9E9E9E
        }

        #msform input,
        #msform textarea {
            padding: 0px 8px 4px 8px;
            border: none;
            border-bottom: 1px solid #ccc;
            border-radius: 0px;
            margin-bottom: 25px;
            margin-top: 2px;
            width: 100%;
            box-sizing: border-box;
            font-family: montserrat;
            color: #2C3E50;
            font-size: 16px;
            letter-spacing: 1px
        }

        #msform input:focus,
        #msform textarea:focus {
            -moz-box-shadow: none !important;
            -webkit-box-shadow: none !important;
            box-shadow: none !important;
            border: none;
            font-weight: bold;
            border-bottom: 2px solid skyblue;
            outline-width: 0
        }

        #progressbar {
            margin-bottom: 30px;
            overflow: hidden;
            color: lightgrey;
            padding-left: 0;
        }

        #progressbar .active {
        color: #000000
        }

        #progressbar li {
            list-style-type: none;
            font-size: 12px;
            width: 16.66%;
            float: left;
            position: relative;
            text-align: center;
        }

        #progressbar #step1:before {
        font-family: FontAwesome;
            content: "\f00c"
        }

        #progressbar #step2:before {
        font-family: FontAwesome;
        content: "\f023"
        }

        #progressbar #step3:before {
        font-family: FontAwesome;
        content: "\f023"
        }

        #progressbar #step4:before {
        font-family: FontAwesome;
        content: "\f023"
        }

        #progressbar #step5:before {
        font-family: FontAwesome;
        content: "\f023"
        }

        #progressbar #confirm:before {
        font-family: FontAwesome;
        content: "\f023"
        }

        #progressbar li:before {
            width: 50px;
            height: 50px;
            line-height: 45px;
            display: block;
            font-size: 18px;
            color: #ffffff;
            background: lightgray;
            border-radius: 50%;
            margin: 0 auto 10px auto;
            padding: 2px;
        }

        #progressbar li:after {
        content: '';
        width: 100%;
        height: 2px;
        background: lightgray;
        position: absolute;
        left: 0;
        top: 25px;
        z-index: -1
        }

        #progressbar li.active:before {
            content: "\f00c" !important;
        }

        #progressbar li.active:before,
        #progressbar li.active:after {
            background: skyblue
        }


        .card {
            cursor: pointer
        }

        .hd {
            font-size: 25px;
            font-weight: 550
        }

        .card.hover,
        .card:hover {
            box-shadow: 0 20px 40px rgba(0, 0, 0, .2)
        }

        .img {
            margin-bottom: 35px;
            -webkit-filter: drop-shadow(5px 5px 5px #222);
            filter: drop-shadow(5px 5px 5px #222)
        }

        .card-title {
            font-weight: 600
        }

        button.focus,
        button:focus {
            outline: 0;
            box-shadow: none !important
        }

        .ft {
            margin-top: 25px
        }

        .chk {
            margin-bottom: 5px
        }

        .rck {
            margin-top: 20px;
            padding-bottom: 15px
        }

        .hidden {
            display: none;
        }
    </style>
@stop

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row" id="grad1">
        <div class="col-md-12">
            <div class="card ">
              <div class="card-header card-header-primary">
                <h4 class="card-title">{{ __('Add Claim') }}</h4>
                <p class="card-category"></p>
              </div>
              <div class="card-body ">
                <div class="row">
                  <div class="col-md-12 text-right">
                      <a href="{{ route('home') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                  </div>
                </div>
                  <div class="container-fluid" id="grad1">
                      <div class="row justify-content-center mt-0">
                          <div class="col-11 col-sm-9 col-md-7 col-lg-6 text-center p-0 mt-3 mb-2">
                              <div class="card px-0 pt-4 pb-0 mt-3 mb-3">
                                <div class="row">
                                    <div class="col-md-12 mx-0">
                                        <form method="post" action="{{ route('claims-create') }}" autocomplete="off" id="msform">
                                            @csrf
                                            @method('post')

                                                <ul id="progressbar">
                                                    <li class="active" id="step1"><strong>Step 1</strong></li>
                                                    <li id="step2"><strong>Step 2</strong></li>
                                                    <li id="step3"><strong>Step 3</strong></li>
                                                    <li id="step4"><strong>Step 4</strong></li>
                                                    <li id="step5"><strong>Step 5</strong></li>
                                                    <li id="confirm"><strong>Step 6</strong></li>
                                                </ul> <!-- fieldsets -->
                                                <fieldset>
                                                    <div class="form-card">
                                                      <label class="col-sm-2 col-form-label">{{ __('Zipcode') }}</label>
                                                      <div class="col-sm-12">
                                                          <div class="form-group{{ $errors->has('zipcode') ? ' has-danger' : '' }}">
                                                              <input class="{{ $errors->has('zipcode') ? ' is-invalid' : '' }}" name="zipcode" id="input-zipcode" type="text" placeholder="{{ __('Zipcode') }}" value="{{ old('zipcode') }}" required="true" aria-required="true"/>
                                                              @if ($errors->has('zipcode'))
                                                                  <span id="zipcode-error" class="error text-danger" for="input-zipcode">{{ $errors->first('zipcode') }}</span>
                                                              @endif
                                                          </div>
                                                      </div>
                                                    </div>
                                                    <button type="button" id="btn-next-1" class="btn btn-primary next">{{ __('Next') }}</button>
                                                </fieldset>
                                                <fieldset>
                                                    <div class="form-card">
                                                        <label class="col-sm-2 col-form-label">{{ __('Insurance Provider') }}</label>
                                                        <div class="col-sm-12">

                                                            <div class="row" style="justify-content: center">
                                                                <div class="card col-md-3 col-12">
                                                                    <div class="card-content" onclick="setProvider('Amica');">
                                                                        <div class="card-body"> <img class="img" height="64" src="{{ asset('images/amica.png') }}" />
                                                                            <div class="shadow"></div>
                                                                            <div class="card-title"> Amica </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="card col-md-3 col-12 ml-2">
                                                                    <div class="card-content" onclick="setProvider('USAA');">
                                                                        <div class="card-body"> <img class="img" height="64" src="{{ asset('images/usaa.jpeg') }}" />
                                                                            <div class="card-title"> USAA </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="card col-md-3 col-12 ml-2">
                                                                    <div class="card-content" onclick="setProvider('State Farm');">
                                                                        <div class="card-body"> <img class="img" height="64" src="{{ asset('images/state-farm.png') }}" />
                                                                            <div class="card-title"> State Farm </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="card col-md-3 col-12">
                                                                    <div class="card-content" onclick="setProvider('Chubb');">
                                                                        <div class="card-body"> <img class="img" height="64" src="{{ asset('images/chubb.jpeg') }}" />
                                                                            <div class="shadow"></div>
                                                                            <div class="card-title"> Chubb </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="card col-md-3 col-12 ml-2">
                                                                    <div class="card-content" onclick="setProvider('Farmers');">
                                                                        <div class="card-body"> <img class="img" height="64" src="{{ asset('images/farmers.png') }}" />
                                                                            <div class="card-title"> Farmers </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="card col-md-3 col-12 ml-2">
                                                                    <div class="card-content" onclick="setProvider('Progressive');">
                                                                        <div class="card-body"> <img class="img" height="64" src="{{ asset('images/progressive.png') }}" />
                                                                            <div class="card-title"> Progressive </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="card col-md-3 col-12">
                                                                    <div class="card-content" onclick="setProvider('Allstate');">
                                                                        <div class="card-body"> <img class="img" height="64" src="{{ asset('images/allstate.jpeg') }}" />
                                                                            <div class="shadow"></div>
                                                                            <div class="card-title"> Allstate </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="card col-md-3 col-12 ml-2">
                                                                    <div class="card-content" onclick="setProvider('Liberty Mutual');">
                                                                        <div class="card-body"> <img class="img" height="64" src="{{ asset('images/liberty.jpeg') }}" />
                                                                            <div class="card-title"> Liberty Mutual </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="card col-md-3 col-12 ml-2">
                                                                    <div class="card-content" onclick="setProvider('Nationwide');">
                                                                        <div class="card-body"> <img class="img" height="64" src="{{ asset('images/nationwide.jpeg') }}" />
                                                                            <div class="card-title"> Nationwide </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="card col-md-3 col-12 ml-2">
                                                                    <div class="card-content" onclick="setProvider('Erie');">
                                                                        <div class="card-body"> <img class="img" height="64" src="{{ asset('images/erie.jpeg') }}" />
                                                                            <div class="card-title"> Erie </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="form-group{{ $errors->has('provider') ? ' has-danger' : '' }}">
                                                                <input class="{{ $errors->has('provider') ? ' is-invalid' : '' }}" name="provider" id="input-insurance-name" type="text" placeholder="{{ __('Type Insurance name') }}" value="{{ old('provider') }}" required="true" aria-required="true"/>
                                                                @if ($errors->has('provider'))
                                                                    <span id="provider-error" class="error text-danger" for="input-insurance-name">{{ $errors->first('provider') }}</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <button type="button" id="btn-next-2" class="btn btn-primary next">{{ __('Next') }}</button>
                                                </fieldset>
                                                <fieldset>
                                                    <div class="form-card">
                                                        <label class="col-sm-2 col-form-label">{{ __('Type of property') }}</label>
                                                        <div class="col-sm-12">

                                                            <div class="row" style="justify-content: center">
                                                                <div class="card col-md-3 col-12">
                                                                    <div class="card-content" onclick="setTypeProperty('House');">
                                                                        <div class="card-body"> <img class="img" height="64" src="{{ asset('images/house.png') }}" />
                                                                            <div class="shadow"></div>
                                                                            <div class="card-title"> House </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="card col-md-3 col-12 ml-2">
                                                                    <div class="card-content" onclick="setTypeProperty('Apartment');">
                                                                        <div class="card-body"> <img class="img" height="64" src="{{ asset('images/apartment.png') }}" />
                                                                            <div class="card-title"> Apartment </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="card col-md-3 col-12 ml-2">
                                                                    <div class="card-content" onclick="setTypeProperty('Townhouse');">
                                                                        <div class="card-body"> <img class="img" height="64" src="{{ asset('images/townhouse.png') }}" />
                                                                            <div class="card-title"> Townhouse </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="card col-md-3 col-12">
                                                                    <div class="card-content" onclick="setTypeProperty('Commercial');">
                                                                        <div class="card-body"> <img class="img" height="64" src="{{ asset('images/commerce.png') }}" />
                                                                            <div class="shadow"></div>
                                                                            <div class="card-title"> Commercial </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="card col-md-3 col-12 ml-2">
                                                                    <div class="card-content" onclick="setTypeProperty('Other');">
                                                                        <div class="card-body"> <img class="img" height="64" src="{{ asset('images/other.png') }}" />
                                                                            <div class="card-title"> Other </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <input type="hidden" name="property" id="property">
                                                    <button type="button" id="btn-next-3" class="btn btn-primary next hidden">{{ __('Next') }}</button>
                                                </fieldset>
                                                <fieldset>
                                                    <div class="form-card">
                                                        <label class="col-sm-2 col-form-label">{{ __('Type of damages sustained') }}</label>
                                                        <div class="col-sm-12">

                                                            <div class="row" style="justify-content: center">
                                                                <div class="card col-md-3 col-12">
                                                                    <div class="card-content" onclick="setDamages('Hurricane');">
                                                                        <div class="card-body">
                                                                            <div class="shadow"></div>
                                                                            <div class="card-title"> Hurricane </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="card col-md-3 col-12 ml-2">
                                                                    <div class="card-content" onclick="setDamages('Fire');">
                                                                        <div class="card-body">
                                                                            <div class="card-title"> Fire </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="card col-md-3 col-12 ml-2">
                                                                    <div class="card-content" onclick="setDamages('Flood');">
                                                                        <div class="card-body">
                                                                            <div class="card-title"> Flood </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="card col-md-3 col-12">
                                                                    <div class="card-content" onclick="setDamages('Roof');">
                                                                        <div class="card-body">
                                                                            <div class="shadow"></div>
                                                                            <div class="card-title"> Roof </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="card col-md-3 col-12 ml-2">
                                                                    <div class="card-content" onclick="setDamages('Plumbing');">
                                                                        <div class="card-body">
                                                                            <div class="card-title"> Plumbing </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="card col-md-3 col-12 ml-2">
                                                                    <div class="card-content" onclick="setDamages('Burglary');">
                                                                        <div class="card-body">
                                                                            <div class="card-title"> Burglary </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group{{ $errors->has('damages') ? ' has-danger' : '' }}">
                                                                <input class="{{ $errors->has('damages') ? ' is-invalid' : '' }}" name="damages" id="input-damages" type="text" placeholder="{{ __('Type damages sustained') }}" value="{{ old('damages') }}" required="true" aria-required="true"/>
                                                                @if ($errors->has('damages'))
                                                                    <span id="damages-error" class="error text-danger" for="input-damages">{{ $errors->first('damages') }}</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <button type="button" id="btn-next-4" class="btn btn-primary next hidden">{{ __('Next') }}</button>
                                                </fieldset>
                                                <fieldset>
                                                    <div class="form-card">
                                                        <label class="col-sm-2 col-form-label">{{ __('Status') }}</label>
                                                        <div class="col-sm-12">

                                                            <div class="row" style="justify-content: center">
                                                                <div class="card col-md-3 col-12">
                                                                    <div class="card-content" onclick="setState(1);">
                                                                        <div class="card-body">
                                                                            <div class="shadow"></div>
                                                                            <div class="card-title"> Active </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="card col-md-3 col-12 ml-2">
                                                                    <div class="card-content" onclick="setState(2);">
                                                                        <div class="card-body">
                                                                            <div class="card-title"> Denied </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="card col-md-3 col-12 ml-2">
                                                                    <div class="card-content" onclick="setState(3);">
                                                                        <div class="card-body">
                                                                            <div class="card-title"> Not filled </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="card col-md-3 col-12">
                                                                    <div class="card-content" onclick="setState(4);">
                                                                        <div class="card-body">
                                                                            <div class="shadow"></div>
                                                                            <div class="card-title"> Closed </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <input type="hidden" name="state" id="state">
                                                    <button type="button" id="btn-next-5" class="btn btn-primary next hidden">{{ __('Next') }}</button>
                                                </fieldset>
                                                <fieldset>
                                                    <div class="form-card">
                                                        <label class="col-sm-2 col-form-label">{{ __('Finish') }}</label>
                                                        <div class="col-sm-12">

                                                            <div class="row" style="justify-content: center">
                                                                <p>{{ __('Would you like to add anything else?') }}</p>
                                                                <div class="col-sm-12">
                                                                    <div class="form-group{{ $errors->has('text') ? ' has-danger' : '' }}">
                                                                        <textarea id="editor" name="text" rows="5"></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <p class="text-center">By submitting you agree to <a href="{{ route('terms') }}">terms and cond</a></p>
                                                        <p class="text-center"><button type="submit" class="btn btn-primary">{{ __('Submit') }}</button></p>
                                                        <div class="form-check text-center">
                                                            <label class="form-check-label">
                                                                <input name="subscription" class="form-check-input" type="checkbox" value="1">
                                                                Click to have myadjustr recommend you the best professionals
                                                                <span class="form-check-sign">
                                                                    <span class="check"></span>
                                                                </span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </fieldset>
                                        </form>
                                    </div>
                                </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
            </div>
        </div>
      </div>
    </div>
  </div>
@endsection
@push('js')
    <script>

        function setState(state) {
            $('#state').val(state);
            $('#btn-next-5').click();
        }

        function setDamages(damages) {
            $('#input-damages').val(damages);
            $('#btn-next-4').click();
        }

        function setTypeProperty(property) {
            $('#property').val(property);
            $('#btn-next-3').click();
        }

        function setProvider(provider) {
            $('#input-insurance-name').val(provider);
            $('#btn-next-2').click();
        }

        function zipcodeValid() {
            if ($('#input-zipcode').val().length > 3) {
                $('#btn-next-1').show();
            } else {
                $('#btn-next-1').hide();
            }
        }

        function insuranceValid() {
            if ($('#input-insurance-name').val().length > 1) {
                $('#btn-next-2').show();
            } else {
                $('#btn-next-2').hide();
            }
        }

        function damagesValid() {
            if ($('#input-damages').val().length > 1) {
                $('#btn-next-4').show();
            } else {
                $('#btn-next-4').hide();
            }
        }

        $('#input-zipcode').on('input', function () {
            zipcodeValid();
        });

        $('#input-insurance-name').on('input', function () {
            insuranceValid();
        });

        $('#input-damages').on('input', function () {
            damagesValid();
        });

        $(document).ready(function() {
            zipcodeValid();

            var current_fs, next_fs, previous_fs; //fieldsets
            var opacity;

            $(".next").click(function() {

                current_fs = $(this).parent();
                next_fs = $(this).parent().next();

//Add Class Active
                $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
//show the next fieldset
                next_fs.show();
//hide the current fieldset with style
                current_fs.animate({opacity: 0}, {
                    step: function(now) {
// for making fielset appear animation
                        opacity = 1 - now;

                        current_fs.css({
                            'display': 'none',
                            'position': 'relative'
                        });
                        next_fs.css({'opacity': opacity});
                    },
                    duration: 600
                });
                insuranceValid();
                damagesValid();
            });

            $(".previous").click(function(){

                current_fs = $(this).parent();
                previous_fs = $(this).parent().prev();

//Remove class active
                $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

//show the previous fieldset
                previous_fs.show();

//hide the current fieldset with style
                current_fs.animate({opacity: 0}, {
                    step: function(now) {
// for making fielset appear animation
                        opacity = 1 - now;

                        current_fs.css({
                            'display': 'none',
                            'position': 'relative'
                        });
                        previous_fs.css({'opacity': opacity});
                    },
                    duration: 600
                });
            });

            $('.radio-group .radio').click(function(){
                $(this).parent().find('.radio').removeClass('selected');
                $(this).addClass('selected');
            });

            $(".submit").click(function(){
                return false;
            })

        });
    </script>
@endpush
