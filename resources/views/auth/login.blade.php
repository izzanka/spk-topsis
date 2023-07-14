@extends('layout.app')

@section('content')

<div class="mt-2">
    <span class="fs-4">Login</span>
    <hr>
    @include('layout.alert')
    <div class="row">
        <div class="col-4">
            <form action="{{ route('login.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="username" class="form-label">Username <span class="text-danger">*</span></label>
                    <div class="input-group">
                      <input type="text" class="rounded-1 form-control @error('username') is-invalid @enderror" id="username" name="username">
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
                      <input type="password" class="rounded-1 form-control @error('password') is-invalid @enderror" id="password" name="password">
                      @error('password')
                        <span class="invalid-feedback">
                            {{ $message }}
                        </span>
                      @enderror
                    </div>
                </div>
                <button class="btn btn-primary btn-sm" type="submit"> Login</button>
            </form>
        </div>
    </div>
</div>


@endsection
