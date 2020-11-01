@extends('layouts.app')

@section('title', 'Detail Travel')

@push('prepend-style')
    <!-- Libraries -->
    <link rel="stylesheet" href="{{ url('frontend/libraries/xzoom/xzoom.css') }}">
@endpush

@section('content')
    <main>
        <section class="section-details-header"></section>
        <section class="section-details-content">
            <div class="container">
                <div class="row">
                    <div class="col p-md-0">
                        <nav>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    Paket Travel
                                </li>
                                <li class="breadcrumb-item active">
                                    Details
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 pl-lg-0">
                        <div class="card card-details">
                            <h1>Tanah Lot</h1>
                            <p class="mb-2">
                                Republic of Indonesia
                            </p>
                            <div class="gallery">
                                <div class="xzoom-container">
                                    <img src="{{ url('frontend/images/popular-1.jpg') }}" class="xzoom" id="xzoom-default" xoriginal="{{ url('frontend/images/popular-1.jpg') }}">
                                    <div class="xzoom-thumbs">
                                        <a href="{{ url('frontend/images/popular-1.jpg') }}">
                                            <img src="{{ url('frontend/images/popular-1.jpg') }}" class="xzoom-gallery" width="128" xpreview="{{ url('frontend/images/popular-1.jpg') }}">
                                        </a>
                                        <a href="{{ url('frontend/images/popular-1a.jpg') }}">
                                            <img src="{{ url('frontend/images/popular-1a.jpg') }}" class="xzoom-gallery" width="128" xpreview="{{ url('frontend/images/popular-1a.jpg') }}">
                                        </a>
                                        <a href="{{ url('frontend/images/popular-1b.jpg') }}">
                                            <img src="{{ url('frontend/images/popular-1b.jpg') }}" class="xzoom-gallery" width="128" xpreview="{{ url('frontend/images/popular-1b.jpg') }}">
                                        </a>
                                        <a href="{{ url('frontend/images/popular-1c.jpg') }}">
                                            <img src="{{ url('frontend/images/popular-1c.jpg') }}" class="xzoom-gallery" width="128" xpreview="{{ url('frontend/images/popular-1c.jpg') }}">
                                        </a>
                                        <a href="{{ url('frontend/images/popular-1d.jpg') }}">
                                            <img src="{{ url('frontend/images/popular-1d.jpg') }}" class="xzoom-gallery" width="128" xpreview="{{ url('frontend/images/popular-1d.jpg') }}">
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <h2>Tentang Wisata</h2>
                            <p>
                                Nusa Penida adalah sebuah pulau nusa bagian dari negara Republik Indonesia yang
                                terletak di sebelah tenggara Bali yang dipisahkan oleh Selat Badung. Di dekat pulau ini
                                terdapat juga pulau-pulau kecil lainnya yaitu Nusa Ceningan dan Nusa Lembongan.
                            </p>
                            <p>
                                Perairan pulau Nusa Penida terkenal dengan kawasan selamnya di antaranya terdapat di
                                Crystal Bay, Manta Point, Batu Meling, Batu Lumbung, Batu Abah, Toyapakeh dan Malibu
                                Point.
                            </p>
                            <div class="features row">
                                <div class="col-md-4">
                                    <div class="description">
                                        <img src="{{ url('frontend/images/ic_event.png') }}" alt="icon features" class="features-image">
                                        <div class="description">
                                            <h3>Featured Event</h3>
                                            <p>Tari Kecak</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 border-left">
                                    <div class="description">
                                        <img src="{{ url('frontend/images/ic_bahasa.png') }}" alt="icon features" class="features-image">
                                        <div class="description">
                                            <h3>Language</h3>
                                            <p>Bahasa Indonesia</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 border-left">
                                    <div class="description">
                                        <img src="{{ url('frontend/images/ic_foods.png') }}" alt="icon features" class="features-image">
                                        <div class="description">
                                            <h3>Foods</h3>
                                            <p>Local Foods</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card card-details card-right">
                            <h2>Members are going</h2>
                            <div class="members my-2">
                                <img src="{{ url('frontend/images/testimonial-1.jpg') }}" alt="member-1" class="member-image rounded-circle mr-1">
                                <img src="{{ url('frontend/images/testimonial-2.jpg') }}" alt="member-1" class="member-image rounded-circle mr-1">
                                <img src="{{ url('frontend/images/testimonial-3.jpg') }}" alt="member-1" class="member-image rounded-circle mr-1">
                                <img src="{{ url('frontend/images/testimonial-4.jpg') }}" alt="member-1" class="member-image rounded-circle mr-1">
                            </div>
                            <hr>
                            <h2>Trip Information</h2>
                            <table class="trip-information">
                                <tr>
                                    <th width="50%">Date of Departure</th>
                                    <td width="50%" class="text-right">22 Nov, 2020</td>
                                </tr>
                                <tr>
                                    <th width="50%">Duration</th>
                                    <td width="50%" class="text-right">4D 3N</td>
                                </tr>
                                <tr>
                                    <th width="50%">Type</th>
                                    <td width="50%" class="text-right">Open Trip</td>
                                </tr>
                                <tr>
                                    <th width="50%">Price</th>
                                    <td width="50%" class="text-right">$80,00 / person</td>
                                </tr>
                            </table>
                        </div>
                        <div class="join-container">
                            <a href="checkout.html" class="btn btn-block btn-join-now mt-3 py-2">
                                Join Now
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

@push('addon-script')
    <script src="{{ url('frontend/libraries/xzoom/xzoom.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.xzoom, .xzoom-gallery').xzoom({
                zoomWidth: 500,
                title: false,
                tint: '#333',
                Xoffset: 15
            });
        });
    </script>
@endpush