@extends('layout.master')

@push('plugin-styles')
    <!-- Plugin css import here -->
@endpush

@section('content')
    <!-- Page content here -->
    <div class="row">
        <div class="col-md-12">
            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    <h5><i class="icon fas fa-check"></i> Berhasil!</h5>{{ $message }}
                </div>
            @endif
            <div class="card">
                <div class="card-header">
                    <ul class="nav nav-tabs card-header-tabs" data-bs-tabs="tabs">
                        <li class="nav-item">
                            <a class="nav-link active" id="main-tab" data-bs-toggle="tab" href="#main" role="tab"
                                aria-controls="custom-tabs-four-home" aria-selected="true">Aktif</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="archive-tab" data-bs-toggle="tab" href="#archive" role="tab"
                                aria-controls="archive" aria-selected="false">Arsip</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="custom-tabs-four-tabContent">
                        <div class="tab-pane fade active show" id="main" role="tabpanel" aria-labelledby="main-tab">
                            <a href="{{ route('post.create') }}" class="btn btn-md btn-success mb-3"><i
                                    class="nav-icon fas fa-plus"></i></a>
                            <table id="dataTableExample" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">No.</th>
                                        <th scope="col">Kategori</th>
                                        <th scope="col">Judul Post</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($posts as $post)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $post->name }}</td>
                                            <td>{{ $post->title }}</td>
                                            <td class="text-center">
                                                <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                                    action="{{ route('post.destroy', $post->id) }}" method="POST">
                                                    <a href="{{ route('post.edit', $post->id) }}"
                                                        class="btn btn-sm btn-primary mr-2"><i
                                                            class="fa fa-edit"></i></a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger"><i
                                                            class="fa fa-box"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                    @endforelse
                                </tbody>
                            </table>
                            {{ $posts->links() }}
                        </div>
                        {{-- ARCHIVE POST --}}
                        <div class="tab-pane fade" id="archive" role="tabpanel" aria-labelledby="archive-tab">
                            <table id="dataTableExample2" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">No.</th>
                                        <th scope="col">Kategori</th>
                                        <th scope="col">Judul Post</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($posts_archive as $posts_arc)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $posts_arc->name }}</td>
                                            <td>{{ $posts_arc->title }}</td>
                                            <td class="text-center">
                                                <a href="{{ route('post.edit', $posts_arc->id) }}"
                                                    class="btn btn-sm btn-primary mr-2"><i class="fa fa-edit"></i></a>
                                                <a href="{{ route('post.unarchive', $posts_arc->id) }}"
                                                    class="btn btn-sm btn-warning"><i class="fa fa-box-open"></i></a>
                                            </td>
                                        </tr>
                                    @empty
                                    @endforelse
                                </tbody>
                            </table>
                            {{ $posts->links() }}
                        </div>
                    </div>
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
@endsection

@push('plugin-scripts')
    <!-- Plugin js import here -->
@endpush

@push('custom-scripts')
    <!-- Custom js here -->
@endpush
