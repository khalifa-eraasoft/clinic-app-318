@extends('admin.layouts.app')

@section('title', 'Send Message')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Send Message</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        {{-- <ul> --}}
                        {{-- @foreach ($errors->all() as $error)
                            <li>{{ toastr()->addError($error) }}</li>
                        @endforeach --}}
                        {{-- </ul> --}}
                        <form method="POST" action="{{ route('contact-us.store') }}">
                            @csrf
                            <input type="hidden" name="email" value="{{ $contact->email }}">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Reply</label>
                                    <textarea name="reply" class="form-control" cols="30" rows="10">{{ old('message') }}</textarea>
                                </div>
                                @error('reply')
                                    <div class="alert alert-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Send</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
@endsection
