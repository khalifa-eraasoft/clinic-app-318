@extends('admin.layouts.app')

@section('title', 'Majors')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Majors</h3>
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
                                    @foreach ($majors as $major)
                                        <tr>
                                            <td>{{ $major->id }}</td>
                                            <td>{{ $major->title }}</td>
                                            <td>{{ $major->status }}</td>
                                            <td>
                                                <img width="200px" src="{{ asset('image/majors/' . $major->image) }}"
                                                    alt="">
                                            </td>
                                            <td>
                                                <a class="btn btn-warning" href="{{ route('majors.show', $major->id) }}">
                                                    Show
                                                </a>

                                                <a class="btn btn-primary"
                                                    href="{{ route('majors.edit', $major->id) }}">Edit</a>


                                                <form action="{{ route('majors.destroy', $major->id) }}" method="POST">
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
                            {{ $majors->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
@endsection
