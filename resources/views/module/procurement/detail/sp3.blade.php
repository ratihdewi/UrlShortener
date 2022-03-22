@if($procurement->status >= 9 && ($procurement->mechanism_id == 1 || $procurement->mechanism_id == 3 || $procurement->mechanism_id == 4 || $procurement->mechanism_id == 6) || $procurement->status >= 2 && ($procurement->mechanism_id == 2 || $procurement->mechanism_id == 5 || $procurement->mechanism_id == 7))
<div class="row">
    <div class="col-xl-12">
        <div class="card mb-4">
            <div class="card-header">
            @if($procurement->status == 9 && ($procurement->mechanism_id == 1 || $procurement->mechanism_id == 3 || $procurement->mechanism_id == 4 || $procurement->mechanism_id == 6) || $procurement->status == 2 && ($procurement->mechanism_id == 2 || $procurement->mechanism_id == 5 || $procurement->mechanism_id == 7))
                <a href="" class="btn btn-sm btn-success float-right" style="margin-left:10px" data-toggle="modal" data-target="#uploadSp3Modal">Unggah SP3</a>
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
                            @forelse($procurement->sp3s as $row)
                                <tr>
                                    <td>{{$row->sp3_file}}<a href="{{route('procurement.file.download', [$row->id, 'sp3'])}}"><i data-feather="download"></i></a></td>
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
                @if($procurement->status == 9 && ($procurement->mechanism_id == 1 || $procurement->mechanism_id == 3 || $procurement->mechanism_id == 4 || $procurement->mechanism_id == 6) || $procurement->status == 2 && ($procurement->mechanism_id == 2 || $procurement->mechanism_id == 5 || $procurement->mechanism_id == 7))
                    <button id="btn-selesai" class="btn btn-primary float-right" style="margin-left:10px">Selesaikan SP3</button>
                @endif
                <a href="{{route('procurement.index')}}" class="btn btn-light float-right" style="margin-left:10px">Kembali</a>
            </div>
        </div>
    </div>
</div>

@include('module.procurement.detail.sp3_input')


<script type="text/javascript">
    $('#btn-selesai').on('click', function(e){
        e.preventDefault();
        var id = $(this).data('id');
        swal({
            title: 'Apakah Anda yakin?',
            text: 'Menyelesaikan proses SP3 sama dengan menyelesaikan seluruh proses procurement.',
            type: 'warning',
            confirmButtonColor: '#d26a5c',
            confirmButtonText: 'Ya!',
            showCancelButton: true,
            cancelButtonText: 'Batal!',
            html: false,
            preConfirm: function() {
                return new Promise(function (resolve) {
                    setTimeout(function () {
                        resolve();
                    }, 50);
                });
            }
        }).then(function(result){
            if (result.value) {
                // form action delete
                href= "{{route('procurement.sp3.done', [$procurement])}}"
                window.location = href;
            }
        });
    });
</script>

@endif
