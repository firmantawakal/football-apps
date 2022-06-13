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
                <form action="{{ route('post.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('patch')
                        <input type="hidden" name="id_author" class="form-control" value="{{Session::get('user')->id}}">

                        <div class="form-group mb-3">
                            <label>Kategori:</label>
                            <select class="form-control select2" name="id_category" style="width: 100%;">
                                <option value="">-- Pilih --</option>
                                @foreach ($category as $cat)
                                    @php
                                        $sel='';
                                        if ($cat->id == $post->id_category) {
                                            $sel = 'selected';
                                        }
                                    @endphp
                                    <option {{$sel}} value="{{$cat->id}}">{{$cat->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label>Judul Post:</label>
                            <input type="text" name="title" value="{{ $post->title }}" class="form-control" placeholder="Judul Post">
                        </div>
                        <div class="form-group mb-3">
                            <label>Konten:</label>
                            <textarea type="text" class="ckeditor form-control" name="content"
                                placeholder="Konten">{{ $post->content }}</textarea>
                        </div>
                        <div class="form-group mb-3">
                            <label>Image:</label>
                            <input type="file" name="image[]" multiple accept="image/*" class="form-control mb-3" placeholder="image">
                            <div id="image-list">
                                <div class="row">
                                    @foreach ($images as $image)
                                    <div class="col-sm-3 mt-3" style="display: block;text-align:center">
                                        <img src="/image/post/{{ $image->name }}" height="100px" style="max-width: 180px">
                                        <button type="button" class="btn btn-danger btn-block btn-sm mt-3" onclick="deleteImages({{$image->id}})">Hapus</button>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    <!-- /.card-body -->
                        <button type="submit" class="btn btn-primary mt-4">Simpan</button>
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
  <script type="text/javascript">
    function deleteImages(id){
        $.ajax({
            url: '/admin/post/delete_images/'+id,
            type: 'get',
            success: function(data) {
                if (data.response=='success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: 'Gambar berhasil di hapus',
                        confirmButtonText: 'ok'
                    })
                }
                $( "#image-list" ).load(window.location.href + " #image-list" );
            },
        });
    };
    </script>
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
