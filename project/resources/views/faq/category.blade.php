@extends('frontend.app', ['activePage' => 'faq', 'title' => __('FAQ - My Adjustr')])

@section('content')

    <section id="sec1">
        <div class="container">
            <div class="row">
                <div class="col text-center">
                    <h1>{{ $category->getTitle() }}</h1>
                    <hr class="blue-line">
                </div>
            </div>

            @foreach($questions as $question)
                <div class="uk-panel uk-panel-header">
                    <a name="question{{ $question->getIdentity() }}"><h2 class="uk-panel-title">{{ $question->getTitle() }}</h2></a>

                    <div class="uk-grid">
                        <div class="uk-width-1-1">
                            <p>{!! $question->getAnswer() !!}</p>
                        </div>
                    </div>
                </div>
            @endforeach

            <div class="row mt-5  mb-5 text-center">
                <div class="col">
                    <button type="submit" onclick="window.location='{{ route('register') }}'" class="btn btn-primary">Get Started</button>
                </div>
            </div>
        </div>
    </section>

@endsection
