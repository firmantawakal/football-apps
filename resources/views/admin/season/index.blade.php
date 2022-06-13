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
            <div class="card card-primary card-outline">
                <div class="card-body">
                    <h6 class="card-title">Data Musim</h6>
                    <button data-bs-toggle="modal" data-bs-target="#createModal" class="btn btn-success mb-3"><i
                            class="nav-icon fas fa-plus"></i></button>
                    <!-- Modal create-->
                    <div class="modal fade" id="createModal" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Tambah Musim</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('season.store') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <label>Nama Musim:</label>
                                            <input type="text" name="season_name" class="form-control"
                                                placeholder="2022/2023">
                                        </div>
                                        <div class="form-group">
                                            <label>Aktif:</label>
                                            <div class="col">
                                                <div class="d-inline-block me-1">Off</div>
                                                <div class="form-check form-switch d-inline-block">
                                                    <input type="checkbox" class="form-check-input" name="isActive" id="site_state" style="cursor: pointer;">
                                                    <label for="site_state" class="form-check-label">On</label>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                    <button type="submit" class="btn btn-primary">Tambah</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <table id="dataTableExample" class="table table-stripe">
                        <thead>
                            <tr>
                                <th scope="col">No.</th>
                                <th scope="col">Nama Musim</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($seasons as $season)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $season->season_name }} &nbsp;&nbsp;
                                    @php echo ($season->isActive==1) ? '<span class="badge bg-success">Aktif</span>':'<span class="badge bg-secondary">Nonaktif</span>'; @endphp
                                    </td>
                                    <td>
                                        <button data-bs-toggle="modal" data-bs-target="#editModal{{ $season->id }}"
                                            class="btn btn-primary mr-2"><i class="fas fa-edit"></i></button>
                                    </td>
                                </tr>
                                <!-- Modal edit-->
                                <div class="modal fade" id="editModal{{ $season->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Edit Musim</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('season.update', $season->id) }}" method="POST"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    @method('patch')
                                                    <div class="form-group mb-3">
                                                        <label>Nama Musim:</label>
                                                        <input type="text" name="season_name" value="{{ $season->season_name }}"
                                                            class="form-control" placeholder="2022/2023">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Aktif:</label>
                                                        <div class="col">
                                                            <div class="d-inline-block me-1">Off</div>
                                                            <div class="form-check form-switch d-inline-block">
                                                                <input type="checkbox" class="form-check-input" name="isActive"
                                                                @php echo ($season->isActive) ? 'checked':''; @endphp id="site_state" style="cursor: pointer;">
                                                                <label for="site_state" class="form-check-label">On</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Tutup</button>
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
