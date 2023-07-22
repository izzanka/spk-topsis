@extends('layout.app')

@section('content')

<div class="mt-2">
    <span class="fs-4">Register</span>
    <hr>
    @include('layout.alert')
    <div class="row">
        <div class="col-4">
            <form action="{{ route('register.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="username" class="form-label">Username <span class="text-danger">*</span></label>
                    <div class="input-group">
                      <input placeholder="Username" type="text" class="rounded-1 form-control @error('username') is-invalid @enderror" id="username" name="username" value="{{ old('username') }}">
                      @error('username')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                      @enderror
                    </div>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                    <div class="input-group">
                      <input placeholder="Password" type="password" class="rounded-1 form-control @error('password') is-invalid @enderror" id="password" name="password" value="{{ old('password') }}">
                      @error('password')
                        <span class="invalid-feedback">
                            {{ $message }}
                        </span>
                      @enderror
                    </div>
                </div>
                <button class="btn btn-primary btn-sm" type="submit"> Register</button>
            </form>
            <div class="mt-2">
                <small>Already have an account? <a href="{{ route('login') }}">login</a> here</small>
            </div>
        </div>
    </div>
</div>


@endsection
