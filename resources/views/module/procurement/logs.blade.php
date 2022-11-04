<div class="modal fade" id="procurementLogModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog mw-100 w-75" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="col-xl-10">
                    @if(Auth::user()->role_id!=4)
                    <form action="{{route('procurement.logs.store', [$procurement->id])}}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-xl-8">
                                <input name="keterangan" equired="true" placeholder="Keterangan" class="form-control" type="text"/>
                            </div>
                            <div class="col-xl-4">
                                <button class="btn btn-primary" type="submit">Simpan</button>
                            </div>
                        </div>
                    </form>
                    @endif
                </div>
                <div class="col-xl-2">
                    <button class="btn btn-light float-right" type="button" data-dismiss="modal">Tutup</button>
                </div>
            </div>
            <div class="modal-body">
                <div class="row">
                <div class="col-xl-8">
                    <center><b>Riwayat Proses Pengadaan</b></center>
                    <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Log</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($logs as $log)
                                <tr>
                                    <td>{{date('d M Y H:i', strtotime($log->created_at))}}</td>
                                    <td> <?php echo "{$log->logs}" ?> @if($log->keterangan=="") oleh @else dari @endif <font style="color:blue;">{{$log->user->name}}</font></td>
                                    <td>{{$log->keterangan}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="col-xl-4">
                    @if($procurement->status>1)
                    <center><b>Service Level Agreement</b></center>
                    <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Proses</th>
                                <th>SLA</th>
                                <th>Realisasi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($slas as $sla)
                                <tr>
                                    <td>{{$sla->process}}</td>
                                    <td class="text-center">{{$sla->time}}</td>
                                    <td class="text-center">{{$sla->realisasi($procurement->id, $mechanism_type)}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                </div>
                </div> 
            </div>
        </div>
    </div>
</div>
           