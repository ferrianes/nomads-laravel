@extends('layouts.success')

@section('title', 'Checkout Success')

@section('content')
    <main class="section-success d-flex align-items-center">
        <div class="col text-center">
            <img src="{{ url('frontend/images/ic_post_mail.png') }}" alt="icon mail">
            <h1 class="mt-4">Yay! Success</h1>
            <p>
                We've sent you email for trip instruction
                <br>
                please read it as well
            </p>
            <a href="{{ route('home') }}" class="btn btn-home-page mt-3 px-5">
                Home Page
            </a>
        </div>
    </main>
@endsection