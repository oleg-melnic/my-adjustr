@extends('frontend.app', ['activePage' => 'faq', 'title' => __('FAQ - My Adjustr')])

@section('content')

    <section id="sec1">
        <div class="container">
            <div class="row">
                <div class="col text-center">
                    <h1>FAQ</h1>
                    <hr class="blue-line">
                </div>
            </div>

            @foreach($catList as $category)
                <div class="uk-panel uk-panel-header">
                    <h2 class="uk-panel-title">{{ $category['title'] }}</h2>

                    <div class="uk-grid">
                        <div class="uk-width-1-1">
                            <ul class="uk-list uk-list-space gt-list-decor">
                                @foreach($category['items'] as $question)
                                    <li>
                                        <a class="gt-list-decor-question gt-list-decor-link" href="/faq/{{ $category['alias'] }}/#question{{ $question->getIdentity() }}">
                                            <span>{{ $question->getTitle() }}</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
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
