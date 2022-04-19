@extends("master.main")

@section("title","Ubah Isi Mail")

@section("content")

<header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
    <div class="container-fluid">
        <div class="page-header-content">
            <div class="row align-items-center justify-content-between pt-3">
                <div class="col-auto mb-3">
                    <h1 class="page-header-title">
                        <div class="page-header-icon"><i data-feather="book-open"></i></div>
                        <a href="{{route('master.mail.index')}}"> Master Mail </a> 
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
                    <form action="{{ route('master.mail.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        {{ method_field('PUT') }}
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="form-group">
                                    <label class="small mb-1"> Approve Mail </label><label class="small mb-1" style="color:red">*</label>
                                    <textarea id="editor" name="approve_mail" rows="8"> {{ $dataMail->approve_mail }} </textarea>
                                </div>
                                <div class="form-group">
                                    <label class="small mb-1"> Reject Mail </label><label class="small mb-1" style="color:red">*</label>
                                    <textarea id="editor2" name="reject_mail" rows="8"> {{ $dataMail->reject_mail }} </textarea>
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