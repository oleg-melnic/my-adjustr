@extends('frontend.app', ['activePage' => 'how-it-works', 'title' => __('My Adjustr')])

@section('content')

    <section id="sec1">
        <div class="container">
            <div class="row">
                <div class="col text-center">
                    <h1>How It Works</h1>
                    <hr class="blue-line">
                </div>
            </div>

            <div class="row">
                <div class="main-timeline">
                    <div class="timeline ">
                        <div class="row ">
                            <div class="col-8  text-right">
                                <h3 class="title">Submit Claim</h3>
                                <p class="description">
                                    Tell us a little about your problem
                                </p>
                            </div>
                            <div class="col-4 ">
                                <div class="timeline-icon">
                                    <span>1</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="timeline">
                        <div class="row">
                            <div class="col-4">
                                <div class="timeline-icon">
                                    <span>2</span>
                                </div>
                            </div>
                            <div class="col-8 ">
                                <h3 class="title">Mitigation of Damages</h3>
                                <p class="description">
                                    The policyholder is required to protect their property from additional damages and to mitigate the extent of losses both physical and economic.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="timeline">
                        <div class="row">
                            <div class="col-8 text-right">
                                <h3 class="title">Evaluation of Coverages</h3>
                                <p class="description">
                                    We connect you with a claims specialist that will evaluate the terms and conditions of your policy, including coverage limitations and valuation methods.
                                </p>
                            </div>
                            <div class="col-4">
                                <div class="timeline-icon">
                                    <span>3</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="timeline">
                        <div class="row">
                            <div class="col-4">
                                <div class="timeline-icon">
                                    <span>4</span>
                                </div>
                            </div>
                            <div class="col-8">
                                <h3 class="title">Claim preparation & Documentation</h3>
                                <p class="description">
                                    Sheduling a Free Inspections with the claims specialist who will gather experts reports, estimates and document every detail before negotiating with your insurance.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="timeline">
                        <div class="row">
                            <div class="col-8 text-right">
                                <h3 class="title">Evaluation of Coverages</h3>
                                <p class="description">
                                    We connect you with a claims specialist that will evaluate the terms and conditions of your policy, including coverage limitations and valuation methods.
                                </p>
                            </div>
                            <div class="col-4">
                                <div class="timeline-icon">
                                    <span>5</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-5  mb-5 text-center">
                <div class="col">
                    <button type="submit" onclick="window.location='{{ route('register') }}'" class="btn btn-primary">Get Started</button>
                </div>
            </div>
        </div>
    </section>

@endsection
