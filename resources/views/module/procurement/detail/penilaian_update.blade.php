
<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ubah Penilaian Vendor</h5>
    </div>
    <div class="modal-body">
    <form action="{{route('procurement.penilaian.update')}}" method="POST">
        @csrf
        {{ method_field('PUT') }}
        <div class="row">
            <div class="col-xl-12">
                <div class="form-group">
                    <input name="vendorscore_id" id="vendorscore-id" value="{{$score->id}}" type="hidden"/>
                    <label class="small mb-1">Nilai </label><br>
                    <div class="rateit" data-rateit-backingfld="#scoree-id" data-rateit-resetable="false"></div>
                    <select id="scoree-id" name="score">
                        <option value="1" @if($score->score == 1) selected @endif>Bad</option>
                        <option value="2" @if($score->score == 2) selected @endif>OK</option>
                        <option value="3" @if($score->score == 3) selected @endif>Great</option>
                        <option value="4" @if($score->score == 4) selected @endif>Excellent</option>
                        <option value="5" @if($score->score == 5) selected @endif>Amazing</option>
                    </select>
                    
                    @if ($errors->has('score'))
                        <span class="small" style="color:red" role="alert">
                            <strong>{{ $errors->first('score') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label class="small mb-1">Komentar </label>
                    <textarea name="comment" rows="4" id="comment-id" class="form-control{{ $errors->has('comment') ? ' is-invalid' : '' }}">{{$score->comment}}</textarea>
                    @if ($errors->has('comment'))
                        <span class="small" style="color:red" role="alert">
                            <strong>{{ $errors->first('comment') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
        </div>
        <hr>
        <button style="margin-left:10px;" class="btn btn-primary float-right" type="submit">Simpan</button>
        <button class="btn btn-light float-right" type="button" data-dismiss="modal">Tutup</button>
    </form>
    </div>   
        
</div>

<script src="{{asset('js/plugins/rateit/scripts/jquery.rateit.js')}}"></script>