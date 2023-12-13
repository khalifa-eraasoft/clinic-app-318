@extends('admin.layouts.app')

@section('title', $major->title)

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">{{ $major->title }}</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Title</th>
                                        <th>Status</th>
                                        <th>Image</th>
                                        <th style="width: 40px">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($doctors as $doctor)
                                        <tr>
                                            <td>{{ $doctor->id }}</td>
                                            <td>{{ $doctor->name }}</td>
                                            <td>{{ $doctor->bio }}</td>
                                            <td>{{ $doctor->status }}</td>
                                            <td>
                                                <img width="200px" src="{{ asset('image/majors/' . $doctor->image) }}"
                                                    alt="">
                                            </td>
                                            <td>
                                                <a class="btn btn-warning" href="{{ route('doctors.show', $doctor->id) }}">
                                                    Show
                                                </a>

                                                <a class="btn btn-primary"
                                                    href="{{ route('doctors.edit', $doctor->id) }}">Edit</a>


                                                <form action="{{ route('doctors.destroy', $doctor->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-delete">
                                                        Delete
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">
                            {{ $doctors->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
@endsection
