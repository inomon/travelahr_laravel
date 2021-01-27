@extends('layout.base', ['selectedCity' => $selectedCity, 'showFooterForm' => $showFooterForm, 'pageName' => $pageName])

@section('content')

    <!-- Masthead -->
    <header class="masthead text-white text-center" style="background-image: url('{{ $mastheadImageLink }}');">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-xl-9 mx-auto">
                    <h1 class="mb-5">{{ $selectedCity }}, {{ $selectedCountry }}</h1>
                    <p class="h3">Here is the weather for {{ $selectedCity }} and some suggestions for places you can explore and enjoy!</p>
                </div>
            </div>
        </div>
    </header>


    <!-- Weather Grid -->
    <section class="features-icons bg-light text-center">
        <div class="container">
            <div class="row mb-5">
                <div class="col-lg-12">
                    <span class="h1">Weather Forecast</span>
                </div>
            </div>
            <div class="row">
            @foreach ($weather as $forecast)
                <div class="col-lg-2">
                    <div class="features-icons-item mx-auto mb-5 mb-lg-0 mb-lg-3">
                        <div class="">
                            <img class="img-fluid" alt="{{ $forecast['weather'][0]['main'] }}" src="{{ $forecast['weather'][0]['icon_link'] }}" />
                        </div>
                        <h3>{{ $forecast['weather'][0]['formatted_date'] }}</h3>
                        <p class="lead mb-0">{{ $forecast['weather'][0]['description'] }}</p>
                    </div>
                </div>
            @endforeach
            </div>
        </div>
    </section>

    <!-- Venue Showcase -->
    <section class="showcase">
        <div class="container-fluid p-0">
            <div class="row mb-5 text-center">
                <div class="col-lg-12">
                    <span class="h1">Places</span>
                </div>
            </div>
            @foreach ($venues as $index => $venue)
                @if ($index != 'masthead_image_link')
                    @include('blocks.location', ['index' => $index, 'venue' => $venue])
                @endif
            @endforeach
        </div>
    </section>

@endsection
