@extends('layouts.app')

@push('prepend-style')
    <!-- Libraries -->
    <link rel="stylesheet" href="{{ url('frontend/libraries/gijgo/css/gijgo.min.css') }}">
@endpush

@section('title', 'Register | NOMADS')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('Username') }}</label>

                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>
                                <small class="text-muted">Change space character to underscore</small>

                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nationality" class="col-md-4 col-form-label text-md-right">{{ __('Nationality') }}</label>

                            <div class="col-md-6">
                                <select name="nationality" class="form-control @error('nationality') is-invalid @enderror" required>
                                    <option disabled selected>Choose Nationality</option>
                                    @foreach ($nationalities as $nationality)
                                        <option value="{{ $nationality['id'] }}">{{ $nationality['name'] }}</option>
                                    @endforeach
                                </select>

                                @error('nationality')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row align-items-center">
                            <label for="is_visa" class="col-md-4 col-form-label text-md-right">{{ __('is your VISA active?') }}</label>

                            <div class="col-md-6">
                                <div class="custom-control custom-switch">
                                    <input type='hidden' value='0' name='is_visa'>
                                    <input type="checkbox" class="custom-control-input @error('is_visa') is-invalid @enderror" id="is_visa" name="is_visa" autofocus value="1" {{ old('is_visa') ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="is_visa" id="is_visa_label">{{ old('is_visa') ? 'Active' : 'Not Active' }}</label>
                                </div>

                                @error('is_visa')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="doe_passport" class="col-md-4 col-form-label text-md-right">{{ __('Date of End Passport') }}</label>

                            <div class="col-md-6">
                                <input id="doe_passport" type="text" class="form-control datepicker @error('doe_passport') is-invalid @enderror" name="doe_passport" value="{{ old('doe_passport') }}" required autocomplete="off" maxlength="2" autofocus>

                                @error('doe_passport')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('addon-script')
    <!-- Libraries -->
    <script src="{{ url('frontend/libraries/gijgo/js/gijgo.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#is_visa').change(function() {
                if(this.checked) {
                    $('#is_visa_label').text('Active')
                } else {
                    $('#is_visa_label').text('Not Active')
                }
            })

            $('.datepicker').datepicker({
                uiLibrary: 'bootstrap4',
                format: 'mmmm dd, yyyy',
                icons: {
                    rightIcon: '<img src="{{ url('frontend/images/ic_date.png') }}">'
                }
            })
        });
    </script>
@endpush
