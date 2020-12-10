@extends('layouts.app')




@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">



            @if(session()->has('warning'))
            <div class="alert alert-warning">
                {{ session()->get('warning') }}
            </div>
            @endif

            @if(session()->has('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
            @endif



            <div class="card">
                <div class="card-header">{{ __('My Profile') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('profile.update') }}">
                        @csrf
                        <div class="form-group">
                            <label for="first_name" class="text-md-right">{{ __('First Name') }}</label>

                            <input id="first_name" type="text"
                                class="form-control @error('first_name') is-invalid @enderror" name="first_name"
                                value="{{ DVH::set(old('first_name'),$user->first_name) }}" required
                                autocomplete="first_name" autofocus>

                            @error('first_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                        </div>


                        <div class="form-group">
                            <label for="last_name" class="text-md-right">{{ __('Last Name') }}</label>

                            <input id="last_name" type="text"
                                class="form-control @error('last_name') is-invalid @enderror" name="last_name"
                                value="{{ DVH::set(old('last_name'),$user->last_name) }}" required
                                autocomplete="last_name">

                            @error('last_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                        </div>



                        <div class="form-group">
                            <label for="birth_date" class="text-md-right">{{ __('Birth date') }}</label>

                            <input id="birth_date" type="text"
                                class="form-control @error('birth_date') is-invalid @enderror" name="birth_date"
                                value="{{ DVH::set(old('birth_date'),$user->birth_date) }}" autocomplete="birth_date"
                                required>


                            @error('birth_date')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                        </div>





                        <div class="form-group">
                            <label for="trainer_name" class="text-md-right">{{ __('Trainer Name') }}</label>

                            <input id="trainer_name" type="text"
                                class="form-control @error('trainer_name') is-invalid @enderror" name="trainer_name"
                                value="{{ DVH::set(old('trainer_name'),$user->trainer_name) }}" required
                                autocomplete="trainer_name">

                            @error('trainer_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                        </div>

                        <div class="form-group  ">
                            <label for="email" class="text-md-right">{{ __('E-Mail Address') }}</label>

                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ DVH::set(old('email'),$user->email) }}" required
                                autocomplete="email">

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>



                        <div class="form-group  ">
                            <label for="password" class="text-md-right">{{ __('Password') }}</label>

                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password"
                                autocomplete="new-password">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group  ">
                            <label for="password-confirm" class="text-md-right">{{ __('Confirm Password') }}</label>
                            <input id="password-confirm" type="password" class="form-control"
                                name="password_confirmation" autocomplete="new-password">
                        </div>

                        <p class="text-black-50">Leave password as blank if no plan to change</p>

                        <div class="form-group mt-2">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Update') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection



@section('footer')
<script>
    $("#birth_date").datepicker({
        dateFormat: 'yy-mm-dd'
    });

</script>
@stop
