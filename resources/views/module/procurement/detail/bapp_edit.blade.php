
<form action="{{route('procurement.bapp.update', [$procurement])}}" method="POST" enctype="multipart/form-data">
@csrf
{{ method_field('PUT') }}
<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Ubah BAPP</h5>
</div>
<div class="modal-body">
    <div class="row">
        <div class="col-xl-12">
            <!-- Account details card-->
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-6">
                            <div class="form-group">
                                <label class="small mb-1">Nomor Memo </label>
                                <input disabled value="{{ $procurement->no_memo }}" class="form-control"type="text"/>
                            </div>
                            <div class="form-group">
                                <label class="small mb-1">Nomor Surat </label>
                                <input name="no_surat" required="true" value="{{ $procurement->bapp->no_surat }}" class="form-control{{ $errors->has('no_surat') ? ' is-invalid' : '' }}" type="text"/>
                                @if ($errors->has('no_surat'))
                                    <span class="small" style="color:red" role="alert">
                                        <strong>{{ $errors->first('no_surat') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label class="small mb-1">Tanggal BAPP</label>
                                <input name="date" required="true" value="{{ date('Y-m-d', strtotime($procurement->bapp->date)) }}" class="datepicker form-control{{ $errors->has('date') ? ' is-invalid' : '' }}" placeholder="yyyy-mm-dd" type="text"/>
                                @if ($errors->has('date'))
                                    <span class="small" style="color:red" role="alert">
                                        <strong>{{ $errors->first('date') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label class="small mb-1">Tanggal Pengiriman SPPH</label>
                                <input name="spph_date" required="true" value="{{ $procurement->spph_sending_date }}" class="datepicker form-control{{ $errors->has('spph_date') ? ' is-invalid' : '' }}" placeholder="yyyy-mm-dd" type="text"/>
                                @if ($errors->has('spph_date'))
                                    <span class="small" style="color:red" role="alert">
                                        <strong>{{ $errors->first('spph_date') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <!-- Form Group (username)-->
                            <div class="form-group">
                                <label class="small mb-1">Perihal </label>
                                <input disabled value="{{ $procurement->name }}" class="form-control"type="text"/>
                            </div>
                            <div class="form-group">
                                <label class="small mb-1">Dari</label>
                                <select class="form-control select2" name="dari" style="width:100%">
                                    @foreach($users as $user)
                                        <option @if($procurement->bapp->dari == $user->id) selected @endif value="{{$user->id}}">{{$user->name}} - {{$user->jabatan_caption}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="small mb-1">Kepada</label>
                                <select class="form-control select2" name="kepada" style="width:100%">
                                    @foreach($users as $user)
                                        <option @if($procurement->bapp->kepada == $user->id) selected @endif value="{{$user->id}}">{{$user->name}} - {{$user->jabatan_caption}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="small mb-1">Tempat </label>
                                <input name="location" required="true" value="{{$procurement->bapp->location}}" class="form-control{{ $errors->has('location') ? ' is-invalid' : '' }}" type="text"/>
                                @if ($errors->has('location'))
                                    <span class="small" style="color:red" role="alert">
                                        <strong>{{ $errors->first('location') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12">
                            @if($procurement->mechanism_id == 3)
                            <div class="form-group">
                                <label class="small mb-1">Alasan </label>
                                <textarea id="editor" name="reason" rows="4" class="form-control{{ $errors->has('reason') ? ' is-invalid' : '' }}">{{$procurement->bapp->reason}}</textarea>
                                @if ($errors->has('reason'))
                                    <span class="small" style="color:red" role="alert">
                                        <strong>{{ $errors->first('reason') }}</strong>
                                    </span>
                                @endif
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
        </div>
    </div> 
</div>
<div class="modal-footer">
    <button class="btn btn-light" type="button" data-dismiss="modal">Tutup</button>
    <button class="btn btn-primary" type="submit">Simpan</button>
</div>
</form>

<script type="text/javascript">
    
    $(document).ready(function() {
        $(".datepicker").datepicker({
            startDate: new Date(),
            format: 'yyyy-mm-dd',
            autoclose: true,
            todayHighlight: true,
        });
    } );

    ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .catch( error => {
            console.error( error );
        } );
    
</script>
