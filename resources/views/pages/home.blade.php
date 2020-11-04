@extends('layouts.app')

@section('title', 'NOMADS')

@section('content')
    <!-- Header -->
    <header class="text-center">
        <div class="d-flex justify-content-center">
            <h1>Explore The Beautiful World As Easy One Click</h1>
        </div>
        <div class="d-flex justify-content-center">
            <p class="mt-3">
                You will see beautiful moment you never seen before
            </p>
        </div>
        <a href="#popular" class="btn btn-get-started px-4 mt-4">Get Started</a>
    </header>

    <!-- Main -->
    <main>
        <div class="container">
            <section class="section-stats row justify-content-center" id="stats">
                <div class="col-3 col-md-2 stats-detail pl-md-4 pl-lg-5">
                    <h2>20K</h2>
                    <p>Member</p>
                </div>
                <div class="col-3 col-md-2 stats-detail pl-md-4 pl-lg-5">
                    <h2>12</h2>
                    <p>Countries</p>
                </div>
                <div class="col-3 col-md-2 stats-detail pl-md-4 pl-lg-5">
                    <h2>3K</h2>
                    <p>Hotels</p>
                </div>
                <div class="col-3 col-md-2 stats-detail pl-md-4 pl-lg-5">
                    <h2>72</h2>
                    <p>Partners</p>
                </div>
            </section>
        </div>

        <section class="section-popular" id="popular">
            <div class="container">
                <div class="row">
                    <div class="col text-center section-popular-heading">
                        <h2>Wisata Popular</h2>
                        <p>
                            Something that you never try
                            <br>
                            before in this world
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <section class="section-popular-content" id="popularContent">
            <div class="container">
                <div class="section-popular-travel row justify-content-center">
                @foreach ($items as $item)
                    <div class="col-sm-6 col-md-4 col-lg-3">
                        <div class="card-travel text-center d-flex flex-column" style="background-image: linear-gradient(180deg, rgba(0, 0, 0, 0.58) 0%, rgba(0, 0, 0, 0) 76.71%), url('{{ $item->galleries->count() ? Storage::url($item->galleries->first()->images) : '' }}');">
                            <div class="travel-country">{{ $item->location }}</div>
                            <div class="travel-location">{{ $item->title }}</div>
                            <div class="travel-button mt-auto">
                                <a href="{{ route('detail', $item->slug) }}" class="btn btn-travel-details px-4">
                                    View Details
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
                </div>
            </div>
        </section>

        <section class="section-social-networks" id="networks">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-4">
                        <h2>Our Networks</h2>
                        <p>
                            Companies are trusted us
                            <br>
                            more than just a trip.
                        </p>
                    </div>
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-6 col-md-3">
                                <img src="frontend/images/ana.png" alt="Logo Partners" class="img-partner">
                            </div>
                            <div class="col-6 col-md-3">
                                <img src="frontend/images/disney.png" alt="Logo Partners" class="img-partner">
                            </div>
                            <div class="col-6 col-md-3">
                                <img src="frontend/images/shangri-la.png" alt="Logo Partners" class="img-partner">
                            </div>
                            <div class="col-6 col-md-3">
                                <img src="frontend/images/visa.png" alt="Logo Partners" class="img-partner">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section-testimonial-heading" id="testimonialHeading">
            <div class="container">
                <div class="row">
                    <div class="col text-center">
                        <h2>They Are Loving Us</h2>
                        <p>
                            Moments were giving them
                            <br>
                            the best experience
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <section class="section section-testimonial-content" id="testimonialContent">
            <div class="container">
                <div class="section-testimonial-content row justify-content-center">
                    <div class="col-sm-6 col-md-6 col-lg-4">
                        <div class="card card-testimonial text-center">
                            <div class="testimonial-content">
                                <img src="frontend/images/testimonial-1.jpg" alt="Testimonial" class="mb-4 rounded-circle">
                                <h3 class="mb-4">Ferrian Septiawan</h3>
                                <p class="testimonial">
                                    "It was glorious and I could 
                                    not stop to say wohooo for 
                                    every single moment
                                    Dankeeeeee"
                                </p>
                            </div>
                            <hr>
                            <p class="trip-to mt-2">
                                Trip to Tanah Lot
                            </p>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-4">
                        <div class="card card-testimonial text-center">
                            <div class="testimonial-content">
                                <img src="frontend/images/testimonial-2.jpg" alt="Testimonial" class="mb-4 rounded-circle">
                                <h3 class="mb-4">Kevin Sanjaya</h3>
                                <p class="testimonial">
                                    "The trip was insane,
                                    I and my friends enjoy
                                    the vacation.""
                                </p>
                            </div>
                            <hr>
                            <p class="trip-to mt-2">
                                Trip to Bromo
                            </p>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-4">
                        <div class="card card-testimonial text-center">
                            <div class="testimonial-content">
                                <img src="frontend/images/testimonial-3.jpg" alt="Testimonial" class="mb-4 rounded-circle">
                                <h3 class="mb-4">Bob Kane</h3>
                                <p class="testimonial">
                                    "This is my first trip
                                    to Indonesia. And I very
                                    Excited. I hope I can visit
                                    Indonesia again next year."
                                </p>
                            </div>
                            <hr>
                            <p class="trip-to mt-2">
                                Trip to Nusa Penida
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 text-center">
                        <a href="#" class="btn btn-need-help px-4 mt-4 mx-1">
                            I Need Help
                        </a>
                        <a href="{{ route('register') }}" class="btn btn-get-started px-4 mt-4 mx-1">
                            Get Started
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection