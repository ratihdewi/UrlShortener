@extends("master.main")

@section("title","Ubah PO")

@section("content")

<header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
    <div class="container-fluid">
        <div class="page-header-content">
            <div class="row align-items-center justify-content-between pt-3">
                <div class="col-auto mb-3">
                    <h1 class="page-header-title">
                        <div class="page-header-icon"><i data-feather="book-open"></i></div>
                        <a href="{{route('master.po.index')}}"> Master PO </a> 
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
                    <form action="{{route('master.po.update')}}" method="POST">
                        @csrf
                        {{ method_field('PUT') }}
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="form-group">
                                    <label class="small mb-1">Ketentuan Pekerjaan </label><label class="small mb-1" style="color:red">*</label>
                                    <textarea id="editor" name="ketentuan_pekerjaan" rows="4" class="form-control{{ $errors->has('ketentuan_pekerjaan') ? ' is-invalid' : '' }}">{{ $po->ketentuan_pekerjaan }}</textarea>
                                    @if ($errors->has('ketentuan_pekerjaan'))
                                        <span class="small" style="color:red" role="alert">
                                            <strong>{{ $errors->first('ketentuan_pekerjaan') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="small mb-1">Ketentuan Pembayaran </label><label class="small mb-1" style="color:red">*</label>
                                    <textarea id="editor2" name="ketentuan_pembayaran" rows="4" class="form-control{{ $errors->has('ketentuan_pembayaran') ? ' is-invalid' : '' }}">{{ $po->ketentuan_pembayaran }}</textarea>
                                    @if ($errors->has('ketentuan_pembayaran'))
                                        <span class="small" style="color:red" role="alert">
                                            <strong>{{ $errors->first('ketentuan_pembayaran') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="small mb-1"> Nilai PPN (%) </label><label class="small mb-1" style="color:red">*</label>
                                    <input type="text" name="nilai_ppn" class="form-control{{ $errors->has('nilai_ppn') ? ' is-invalid' : '' }}" value="{{ $po->nilai_ppn }}" />
                                    @if ($errors->has('nilai_ppn'))
                                        <span class="small" style="color:red" role="alert">
                                            <strong>{{ $errors->first('nilai_ppn') }}</strong>
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