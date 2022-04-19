@extends("master.main")

@section("title","Ubah SPPH")

@section("content")

<header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
    <div class="container-fluid">
        <div class="page-header-content">
            <div class="row align-items-center justify-content-between pt-3">
                <div class="col-auto mb-3">
                    <h1 class="page-header-title">
                        <div class="page-header-icon"><i data-feather="book-open"></i></div>
                        <a href="{{route('master.spph.index')}}"> Master Spph </a> 
                    </h1>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- Main page content-->
<div class="container mt-4">
@include('partial.alert')
    <div class="row">
        <div class="col-xl-12">
            <!-- Account details card-->
            <div class="card mb-4">
                <div class="card-body">
                    <form action="{{route('master.spph.update')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        {{ method_field('PUT') }}
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="form-group">
                                    <label class="small mb-1">Syarat </label><label class="small mb-1" style="color:red">*</label>
                                    <textarea id="editor" name="syarat" rows="4" class="form-control{{ $errors->has('syarat') ? ' is-invalid' : '' }}">{{ $spph->syarat }}</textarea>
                                    @if ($errors->has('syarat'))
                                        <span class="small" style="color:red" role="alert">
                                            <strong>{{ $errors->first('syarat') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="small mb-1">Kriteria Penilaian </label><label class="small mb-1" style="color:red">*</label>
                                    <textarea id="editor2" name="kriteria_penilaian" rows="4" class="form-control{{ $errors->has('kriteria_penilaian') ? ' is-invalid' : '' }}">{{ $spph->kriteria_penilaian }}</textarea>
                                    @if ($errors->has('kriteria_penilaian'))
                                        <span class="small" style="color:red" role="alert">
                                            <strong>{{ $errors->first('kriteria_penilaian') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="small mb-1">TTD (.jpg)&nbsp;</label>
                                    <input name="ttd" value="{{ old('ttd') }}" class="form-control{{ $errors->has('ttd') ? ' is-invalid' : '' }}" type="file" accept="image/*" />
                                    @if ($errors->has('ttd'))
                                        <span class="small" style="color:red" role="alert">
                                            <strong>{{ $errors->first('ttd') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary float-right" type="submit">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .catch( error => {
            console.error( error );
        } );

    ClassicEditor
        .create( document.querySelector( '#editor2' ) )
        .catch( error => {
            console.error( error );
        } );
</script>

@endsection