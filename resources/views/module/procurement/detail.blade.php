@extends("master.main")

@section("title","Detail Pengadaan")

@section("content")
<header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
    <div class="container-fluid">
        <div class="page-header-content">
            <div class="row align-items-center justify-content-between pt-3">
                <div class="col-auto mb-3">
                    <h1 class="page-header-title">
                        <div class="page-header-icon"><i data-feather="book-open"></i></div>
                        @if(Auth::user()->role_id!=4)
                            <a style="width:250px;" href="{{route('procurement.index')}}"> Daftar Pengadaan </a>
                            <a style="width:140px;color:black;" href="#"> &nbsp;> Detail > </a>
                            @if($procurement->mechanism_id==1 || $procurement->mechanism_id==3 || $procurement->mechanism_id==4 || $procurement->mechanism_id==6)
                            <select style="margin-left:10px;" class="form-control form-control-sm" name="status_select" id="status_select" >
                                <option value="{{route('procurement.show', [$procurement, 1])}}" @if($status_choosen == 1) selected @endif>Approval Pengajuan</option>
                                <option value="{{route('procurement.show', [$procurement, 2])}}" @if($status_choosen == 2) selected @endif>SPPH</option>
                                <option value="{{route('procurement.show', [$procurement, 3])}}" @if($status_choosen == 3) selected @endif>Tender Evaluasi</option>
                                <option value="{{route('procurement.show', [$procurement, 4])}}" @if($status_choosen == 4) selected @endif>BA Negosiasi dan Klarifikasi</option>
                                <option value="{{route('procurement.show', [$procurement, 5])}}" @if($status_choosen == 5) selected @endif>BAPP</option>
                                <option value="{{route('procurement.show', [$procurement, 6])}}" @if($status_choosen == 6) selected @endif>PO</option>
                                <option value="{{route('procurement.show', [$procurement, 7])}}" @if($status_choosen == 7) selected @endif>BAST</option>
                                <option value="{{route('procurement.show', [$procurement, 8])}}" @if($status_choosen == 8) selected @endif>Penilaian</option>
                                <option value="{{route('procurement.show', [$procurement, 9])}}" @if($status_choosen == 9) selected @endif>Input SP3</option>
                            </select>
                            @elseif($procurement->mechanism_id==2 || $procurement->mechanism_id==5 || $procurement->mechanism_id==7)
                            <select style="margin-left:10px;" class="form-control form-control-sm" name="status_select" id="status_select" >
                                <option value="{{route('procurement.show', [$procurement, 1])}}" @if($status_choosen == 1) selected @endif>Approval Pengajuan</option>
                                <option value="{{route('procurement.show', [$procurement, 2])}}" @if($status_choosen == 2) selected @endif>SP3</option>
                                <option value="{{route('procurement.show', [$procurement, 3])}}" @if($status_choosen == 3) selected @endif>BAST</option>
                                <option value="{{route('procurement.show', [$procurement, 4])}}" @if($status_choosen == 4) selected @endif>PJ @if($procurement->mechanism_id==7) CC @else UMK @endif</option>
                            </select>
                            @endif
                        @else
                            <a href="{{route('procurement.index')}}"> Daftar Pengadaan </a>  &nbsp;> Detail
                        @endif
                    </h1>
                    
                </div>
                <div style="margin-bottom:10px;">
                @if($procurement->status != 0)
                <button class="btn btn-primary btn-sm" type="button" data-toggle="modal" data-target="#procurementLogModal">
                    <small>Lihat Logs</small>
                </button>
                @endif
                <button class="btn btn-primary btn-sm" type="button" data-toggle="modal" data-target="#procurementDocModal">
                    <small>Lihat Dokumen</small>
                </button></div>
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
                    <div class="row">
                        <div class="col-xl-6">
                            <!-- Form Group (username)-->
                            <div class="form-group">
                                <label class="small mb-1">Perihal </label>
                                <h3 style="margin-left:10px;">{{$procurement->name}}</h3>
                            </div>
                            <div class="form-group">
                                <label class="small mb-1">No. Memo </label>
                                <h3 style="margin-left:10px;">{{$procurement->no_memo}}</h3>
                            </div>
                            <div class="form-group">
                                <label class="small mb-1"> Tanggal</label>
                                <h3 style="margin-left:10px;">{{$procurement->tanggal_caption}}</h3>
                            </div>
                            <div class="form-group">
                                <label class="small mb-1">Status </label>
                                <h1 style="margin-left:10px;">{{$procurement->status_caption}}</h1>
                            </div>

                            @if($procurement->mechanism_id==3 || $procurement->mechanism_id==4)
                                <div class="form-group">
                                    <label class="small mb-1">Vendor </label>
                                    @if(isset($procurement->vendor->name))
                                        <h1 style="margin-left:10px;"> {{ $procurement->vendor->name }} </h1>
                                    @else
                                        <h1 style="margin-left:10px; color: gray;"> <i> Vendor belum ditentukan </i> </h1>
                                    @endif
                                </div>
                            @endif
                        </div>
                        <div class="col-xl-6 float-right">
                            <div class="form-group">
                                <label class="small mb-1">Total </label>
                                <h3 style="margin-left:10px;">Rp{{number_format($procurement->items->sum('price_total'),2)}}</h3>
                            </div>
                            <div class="form-group">
                                <label class="small mb-1">Tipe </label>
                                <h1 style="margin-left:10px;">{{$procurement->mechanism->name}}</h1>
                            </div>
                            <div class="form-group">
                                <label class="small mb-1"> PIC</label>
                                <h3 style="margin-left:10px;">@if($procurement->staff_id!=NULL) {{$procurement->staff['name']}} @else Blm di-assign @endif</h3>
                            </div>
                            <div class="form-group">
                                <label class="small mb-1"> No. RKA</label>
                                <h3 style="margin-left:10px;">{{$procurement->no_rka}}</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    @if(($procurement->status <= 6 && Auth::user()->role_id < 4) || ($procurement->status <= 1 && Auth::user()->role_id == 4))
                        <button type="button" class="btn btn-primary btn-md float-right" style="margin-left:10px" data-toggle="modal" data-target="#edit-detail-modal">Ubah</button>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @if(Auth::user()->role_id==4)
        @if($status_choosen==8 || $status_choosen==9)
            @include('module.procurement.detail.penilaian')
        @elseif($status_choosen==3)
            @include('module.procurement.detail.tender_evaluasi')
        @else
            @include('module.procurement.detail.pengajuanuser')
        @endif
    @else
        @if($procurement->mechanism_id==1 || $procurement->mechanism_id==4 || $procurement->mechanism_id==6)
            @if($status_choosen==0 || $status_choosen==1 || $status_choosen==10)
                @include('module.procurement.detail.pengajuanuser')
            @elseif($status_choosen==2 && !isset($tenderterbuka))
                @include('module.procurement.detail.spph')
            @elseif($status_choosen==2 && isset($tenderterbuka))
                @include('module.procurement.detail.spph_penawaran_tender_terbuka')
            @elseif($status_choosen==3)
                @include('module.procurement.detail.tender_evaluasi')
            @elseif($status_choosen==4)
                @include('module.procurement.detail.banegosiasi')
            @elseif($status_choosen==5)
                @include('module.procurement.detail.bapp')
            @elseif($status_choosen==6)
                @include('module.procurement.detail.po')
            @elseif($status_choosen==7)
                @include('module.procurement.detail.bast')
            @elseif($status_choosen==8)
                @include('module.procurement.detail.penilaian')
            @elseif($status_choosen==9)
                @include('module.procurement.detail.sp3')
            @endif
        @elseif($procurement->mechanism_id==3 )
            @if($procurement->vendor_id_penunjukan_langsung != 0)
                @if($status_choosen==0 || $status_choosen==1 || $status_choosen==10)
                    @include('module.procurement.detail.pengajuanuser')
                @elseif($status_choosen==2 && !isset($tenderterbuka))
                    @include('module.procurement.detail.spph')
                @elseif($status_choosen==2 && isset($tenderterbuka))
                    @include('module.procurement.detail.spph_penawaran_tender_terbuka')
                @elseif($status_choosen==3)
                    @include('module.procurement.detail.tender_evaluasi')
                @elseif($status_choosen==4)
                    @include('module.procurement.detail.banegosiasi')
                @elseif($status_choosen==5)
                    @include('module.procurement.detail.bapp')
                @elseif($status_choosen==6)
                    @include('module.procurement.detail.po')
                @elseif($status_choosen==7)
                    @include('module.procurement.detail.bast')
                @elseif($status_choosen==8)
                    @include('module.procurement.detail.penilaian')
                @elseif($status_choosen==9)
                    @include('module.procurement.detail.sp3')
                @endif
            @endif
        @elseif($procurement->mechanism_id==2 || $procurement->mechanism_id==5 || $procurement->mechanism_id==7)
            @if($status_choosen==0 || $status_choosen==1 || $status_choosen==5)
                @include('module.procurement.detail.pengajuanuser')
            @elseif($status_choosen==2)
                @include('module.procurement.detail.sp3')
            @elseif($status_choosen==3)
                @include('module.procurement.umk.bast')
            @elseif($status_choosen==4)
                @include('module.procurement.umk.pj')
            @endif
        @endif
    @endif

    @if($procurement->status == 0)
        <!-- <button class="btn btn-danger float-left" id="btn-hapus-procurement">Hapus Pengajuan</button> -->
        <button class="btn btn-danger float-left ml-3" id="btn-batal-procurement">Batalkan Pengajuan</button>
    @endif
    @if($procurement->status == 1)
        <button class="btn btn-danger float-left" id="btn-batal-procurement">Batalkan Pengajuan</button>
    @endif
</div>

<form id="form-hapus-procurement" method="POST" action="{{route('procurement.delete', [$procurement])}}">
    @csrf
    {{ method_field('DELETE') }}
</form>

<form id="form-ajukan-procurement" method="POST" action="{{route('procurement.ajukan', [$procurement])}}">
    @csrf
</form>

@include('module.procurement.additem')
@include('module.procurement.js')
@include('module.procurement.import')
@include('module.procurement.detailupdate')
@include('module.procurement.dokumen')
@include('module.procurement.logs')
@include('module.procurement.upload_penawaran')
@include('module.procurement.upload_tender_evaluasi')

@endsection