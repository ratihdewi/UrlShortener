<div class="modal fade" id="ubahBatasTenderTerbukaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ubah Tanggal Batas Penawarans</h5>
            </div>
            <div class="modal-body">
            <form action="{{route('procurement.tenderterbuka.batas')}}" method="POST">
                @csrf
                {{ method_field('PUT') }}
                <div class="row">
                    <div class="col-xl-12">
                        <div class="form-group">
                            <input name="procurement_id" id="procurement-id" value="" type="hidden"/>
                            <label class="small mb-1">Tanggal Batas Penawaran </label>
                            <input id="modal-tanggal" name="batas_penawaran" required="true" value="{{ old('batas_penawaran') }}" class="datepicker form-control{{ $errors->has('batas_penawaran') ? ' is-invalid' : '' }}" placeholder="yyyy-mm-dd" type="text"/>
                            @if ($errors->has('batas_penawaran'))
                                <span class="small" style="color:red" role="alert">
                                    <strong>{{ $errors->first('batas_penawaran') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-light" type="button" data-dismiss="modal">Tutup</button>
                <button class="btn btn-primary" type="submit">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(function(){
        $(".datepicker").datepicker({
            startDate: new Date(),
            format: 'yyyy-mm-dd',
            autoclose: true,
            todayHighlight: true,
        });
    });
</script>