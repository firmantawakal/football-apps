@extends('layout.master')

@push('plugin-styles')
  <!-- Plugin css import here -->
@endpush

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-body">
                @if($errors->any())
                    <div class="alert alert-danger">
                        <label>Whoops!</label> There were some problems with your input.<br><br>
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <a class="btn btn-default mb-3" href="{{ route('post.index') }}"><i class="fas fa-arrow-left"></i></a>
                <!-- form start -->
                <form action="{{ route('post.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                        <input type="hidden" name="id_author" class="form-control" value="{{Session::get('user')->id}}">

                        <div class="form-group mb-3">
                            <label>Kategori:</label>
                            <select class="form-control select2" name="id_category" style="width: 100%;">
                                <option value="">-- Pilih --</option>
                                @foreach ($category as $cat)
                                    <option value="{{$cat->id}}">{{$cat->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label>Judul:</label>
                            <input type="text" name="title" class="form-control" placeholder="Judul Post">
                        </div>
                        <div class="form-group mb-3">
                            <label>Konten:</label>
                            <textarea class="ckeditor form-control" name="content" placeholder="Konten"></textarea>
                        </div>
                        <div class="form-group mb-3">
                            <label>Image:</label>
                            <input type="file" name="image[]" multiple accept="image/*" class="form-control" placeholder="image">
                        </div>
                    <!-- /.card-body -->
                        <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('plugin-scripts')
  <!-- Plugin js import here -->
@endpush

@push('custom-scripts')
  <!-- Custom js here -->
  <script>
    ClassicEditor
        .create( document.querySelector( '.ckeditor' ) )
        .then( editor => {
                console.log( editor );
        } )
        .catch( error => {
                console.error( error );
        });
</script>
@endpush
