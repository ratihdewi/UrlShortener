<div class="modal fade" id="nilaiVendorModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Penilaian Vendor</h5>
            </div>
            <div class="modal-body">
            <form action="{{route('procurement.penilaian.store')}}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-xl-12">
                        <div class="form-group">
                            <input name="spph_id" id="spph-id" value="" type="hidden"/>
                            <label class="small mb-1">Nilai </label><br>
                            <select id="score-id" name="score">
                                <option value="1">Bad</option>
                                <option value="2" selected="selected">OK</option>
                                <option value="3">Great</option>
                                <option value="4">Excellent</option>
                                <option value="5">Amazing</option>
                            </select>
                            <div class="rateit" data-rateit-backingfld="#score-id" data-rateit-resetable="false" ></div>
                            @if ($errors->has('score'))
                                <span class="small" style="color:red" role="alert">
                                    <strong>{{ $errors->first('score') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="small mb-1">Komentar </label>
                            <textarea name="comment" rows="4" class="form-control{{ $errors->has('comment') ? ' is-invalid' : '' }}">{{ old('comment') }}</textarea>
                            @if ($errors->has('comment'))
                                <span class="small" style="color:red" role="alert">
                                    <strong>{{ $errors->first('comment') }}</strong>
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