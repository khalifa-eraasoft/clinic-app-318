@extends('front.layouts.app')
@section('title', 'Register')

@section('content')
    <div class="container">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="fw-bold my-4 h4">
            <ol class="breadcrumb justify-content-center">
                <li class="breadcrumb-item"><a class="text-decoration-none" href="./index.html">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Register</li>
            </ol>
        </nav>
        <div class="d-flex flex-column gap-3 account-form mx-auto mt-5">
            <form class="form" method="POST" action="{{ route('register') }}">
                @csrf
                <div class="form-items">
                    <div class="mb-3">
                        <label class="form-label required-label" for="name">Name</label>
                        <input type="text" name="name" value="{{ old('name') }}" class="form-control"
                            id="name">
                    </div>
                    @error('name')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror
                    <div class="mb-3">
                        <label class="form-label required-label" for="phone">Phone</label>
                        <input type="text" name="phone" value="{{ old('phone') }}" class="form-control"
                            id="phone">
                    </div>
                    @error('phone')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror
                    <div class="mb-3">
                        <label class="form-label required-label" for="email">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" class="form-control"
                            id="email">
                    </div>
                    @error('email')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror
                    <div class="mb-3">
                        <label class="form-label required-label" for="password">password</label>
                        <input type="password" name="password" class="form-control" id="password">
                    </div>
                    @error('password')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror
                    <div class="mb-3">
                        <label class="form-label required-label" for="password">confirm password</label>
                        <input type="password" name="password_confirmation" class="form-control" id="password">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Create account</button>
            </form>
            <div class="d-flex justify-content-center gap-2">
                <span>already have an account?</span><a class="link" href="./login.html"> login</a>
            </div>
        </div>

    </div>
@endsection
