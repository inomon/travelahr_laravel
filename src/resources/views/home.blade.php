@extends('layout.base', ['showFooterForm' => $showFooterForm, 'pageName' => $pageName])

@section('content')
    <!-- Masthead -->
    <header class="masthead text-white text-center mb-5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
            <div class="col-xl-9 mx-auto">
                <h1 class="mb-5">Look for places in Japan! <br />Visit and enjoy!</h1>
            </div>
            <div class="col-md-10 col-lg-8 col-xl-7 mx-auto">
                @include('blocks.places-form')
            </div>
            </div>
        </div>
    </header>

    <!-- Venue Showcase -->
    <section class="showcase mt-5">
        <div class="container-fluid p-0">
            <div class="row mb-5 text-center">
                <div class="col-lg-12">
                    <span class="h1">Places you can visit and enjoy</span>
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
