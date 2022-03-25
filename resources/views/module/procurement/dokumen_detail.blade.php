@if(file_exists(public_path($file)))
    <iframe src="{{asset($file)}}?time={{date('Y-m-d H:i:s')}}" width="100%" @if($type=='po' || $type=='bapp') style="height:95%;" @else style="height:100%;" @endif>
    </iframe>
    <br>
    @if($type=='po' || $type=='bapp') 
    <form action="{{route('procurement.file.update', [$id])}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-xl-6"></div>
            <input name="type" type="hidden" value="{{$type}}"/>
            <div class="col-xl-4">
                <input name="file" required="true" class="form-control form-control-sm" type="file"/>
            </div>
            <div class="col-xl-2">
                <button class="btn btn-primary btn-sm" style="margin-right:20px;"  type="submit">Update</button>
            </div>
        </div>
    </form>
    @endif
@else
    Silahkan cetak file terlebih dahulu.
@endif