@extends('admin.master')
@section('title', 'Tag')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Tag</h1>
            </div>
        </div>
    </div>
</section>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5><i class="icon fas fa-check"></i> Berhasil!</h5>{{ $message }}
                    </div>
                @endif
                <div class="card card-primary card-outline card-outline-tabs">
                    <div class="card-header p-0 border-bottom-0">
                      <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                        <li class="nav-item">
                          <a class="nav-link active" id="main-tab" data-toggle="pill" href="#main" role="tab" aria-controls="custom-tabs-four-home" aria-selected="true">Aktif</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" id="archive-tab" data-toggle="pill" href="#archive" role="tab" aria-controls="archive" aria-selected="false">Arsip</a>
                        </li>
                      </ul>
                    </div>
                    <div class="card-body">
                      <div class="tab-content" id="custom-tabs-four-tabContent">
                        <div class="tab-pane fade active show" id="main" role="tabpanel" aria-labelledby="main-tab">
                        <button data-toggle="modal" data-target="#createModal" class="btn btn-md btn-success mb-3"><i class="nav-icon fas fa-plus"></i></button>
                        <!-- Modal create-->
                        <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Tambah Tag</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('tag.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                        <div class="form-group">
                                            <label>Nama Tag:</label>
                                            <input type="text" name="name" class="form-control" placeholder="Nama Tag">
                                        </div>
                                </div>
                                <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-primary">Tambah</button>
                                </form>
                                </div>
                            </div>
                            </div>
                        </div>
                        <table id="dataTable" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">No.</th>
                                    <th scope="col">Nama Tag</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($tags as $tag)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{ $tag->name }}</td>
                                    <td>
                                        <div class="text-center row">
                                            <button data-toggle="modal" data-target="#editModal{{$tag->id}}" class="btn btn-sm btn-primary mr-2"><i class="fa fa-edit"></i></button>
                                            <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                                action="{{ route('tag.destroy', $tag->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-box"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                <!-- Modal edit-->
                                <div class="modal fade" id="editModal{{$tag->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit Tag</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('tag.update', $tag->id) }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('patch')
                                                <div class="form-group">
                                                    <label>Nama Tag:</label>
                                                    <input type="text" name="name" value="{{ $tag->name }}" class="form-control" placeholder="Nama Tag">
                                                </div>
                                        </div>
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                        </form>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                @empty
                                @endforelse
                            </tbody>
                        </table>
                        </div>
                        {{-- ARCHIVE TAG --}}
                        <div class="tab-pane fade" id="archive" role="tabpanel" aria-labelledby="archive-tab">
                            <table id="dataTable2" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">No.</th>
                                        <th scope="col">Nama Tag</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($tags_archive as $tag_arc)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{ $tag_arc->name }}</td>
                                        <td class="text-center">
                                            <button data-toggle="modal" data-target="#editModalArc{{$tag_arc->id}}" class="btn btn-sm btn-primary mr-2"><i class="fa fa-edit"></i></button>
                                            <a href="{{ route('tag.unarchive', $tag_arc->id) }}" class="btn btn-sm btn-warning"><i class="fa fa-box-open"></i></a>
                                        </td>
                                    </tr>
                                    <!-- Modal edit-->
                                    <div class="modal fade" id="editModalArc{{$tag_arc->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Edit Tag</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('tag.update', $tag_arc->id) }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                @method('patch')
                                                    <div class="form-group">
                                                        <label>Nama Tag:</label>
                                                        <input type="text" name="name" value="{{ $tag_arc->name }}" class="form-control" placeholder="Nama Tag">
                                                    </div>
                                            </div>
                                            <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                            </form>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                    @empty
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                      </div>
                    </div>
                    <!-- /.card -->
                  </div>
            </div>
        </div>
    </div>
</section>
@endsection
