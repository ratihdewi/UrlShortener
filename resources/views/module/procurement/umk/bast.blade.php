
@if($procurement->status >= 3 && $procurement->mechanism_id == 2 || $procurement->status >= 3 && $procurement->mechanism_id == 5 || $procurement->status >= 3 && $procurement->mechanism_id == 7)
<div class="row">
    <div class="col-xl-12">
        <div class="card mb-4">
            <div class="card-header">
            @if($procurement->status == 3 && $procurement->mechanism_id == 2 || $procurement->status == 3 && $procurement->mechanism_id == 5 || $procurement->status == 3 && $procurement->mechanism_id == 7)
                <a href="" class="btn btn-sm btn-success float-right" style="margin-left:10px" data-toggle="modal" data-target="#uploadBastModal">Unggah BAST</a>
            @endif
            </div>
            <div class="card-body">
                <div class="datatable">
                    <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>File</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($procurement->bastUmks as $row)
                                <tr>
                                    <td>{{$row->bast_file}}<a href="{{route('procurement.file.download', [$row->id, 'bast_umk'])}}"><i data-feather="download"></i></a></td>
                                    <td>{{$row->keterangan}}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2"><center><i>Tidak ada data.</i></center></td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer">
                @if($procurement->status == 3 && $procurement->mechanism_id == 2 || $procurement->status == 3 && $procurement->mechanism_id == 5 || $procurement->status == 3 && $procurement->mechanism_id == 7)
                    <a href="{{route('procurement.umk.bast.done', [$procurement])}}" class="btn btn-primary float-right" style="margin-left:10px">Selesaikan BAST</a>
                @endif
                <a href="{{route('procurement.index')}}" class="btn btn-light float-right" style="margin-left:10px">Kembali</a>
            </div>
        </div>
    </div>
</div>

@include('module.procurement.umk.bast_input')

@endif
