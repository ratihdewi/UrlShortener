@extends("master.main")

@section("content")
<?php 
	$bapp = "Test word!";
?>
<div class="container mt-4">
    <div class="row">
        <div class="col-xl-12">
            <div class="card mb-4">
                <div class="card-body text-sm">
					@if ($errors->any())
						<div class="alert alert-danger">
							<ul>
								@foreach($errors->all() as $error)
								<li> {{ $error }} </li>
								@endforeach
							</ul>
						</div>
					@endif
					<form method="POST" id="storeData" enctype="multipart/form-data" action="">
						@csrf
						<div class="form-group mb-4">
							<label> Pengadaan </label>
							<select name="procurement" id="opsiProcurement" class="form-control select2 sm">
								<option disabled selected> Pilih Pengadaan </option>
								@foreach($procurements as $procurement)
									<option value="{{ $procurement->id }}"> {{ $procurement->name }} </option>
								@endforeach
							</select>
						</div>
						<nav id="spph-negosiasi">
							<fieldset class="form-group border p-3">
								<legend class="w-auto px-2">Dokumen</legend>
								<span id="fieldSpph">
								</span>
							</fieldset>
							<fieldset class="form-group border p-3">
								<legend class="w-auto px-2">Penawaran dan Tender Evaluasi</legend>
								<div class="col-md-5 mb-4 mt-2">
									<label> Unggah File Evaluasi Tender (.pdf) </label>
									<input type="file" class="form-control" name="eval_tender_pdf">
								</div>
								<table class="table mt-5 mb-5" id="tabelItem">
									<thead>
										<tr>
											<th> Negosiasi </th>
											<th> Nama Barang </th>
											<th> Kategori </th>
											<th> Spesifikasi </th>
											<th> Harga Satuan </th>
											<th> Kuantitas </th>
											<th width="10%"> Harga Total </th>
											<th> Nama Vendor </th>
											<th width="10%"> Keterangan </th>
											<th width="10%"> Evaluasi </th>
											@if($procurement->mechanism_id!=3)<th width="10%"> Nilai </th> @endif
										</tr>
									</thead>
								</table>
							</fieldset>
							<fieldset class="form-group border p-3">
								<legend class="w-auto px-2"> BA Negosiasi </legend>
								<div id="fieldBA-Negosiasi">
								</div>
							</fieldset>
							<div id="otherField"></div>
						</nav>
						<nav id="bapp">
							<fieldset class="form-group border p-3">
								<legend class="w-auto px-2">BAPP</legend>
								<div class="row">
									<div class="col-xl-6">
										<div class="form-group">
											<label class="small mb-1">Nomor Memo </label>
											<input disabled name="nomor_memo_bapp" class="form-control" type="text"/>
										</div>
										<div class="form-group">
											<label class="small mb-1">Nomor Surat </label>
											<input class="form-control" name="no_surat_bapp" type="text" required/>
										</div>
										<div class="form-group">
											<label class="small mb-1">Tanggal BAPP</label>
											<input class="form-control" name="tanggal_bapp" type="date"/>
										</div>
										<div class="form-group">
											<label class="small mb-1">Tanggal Pengiriman SPPH</label>
											<input class="form-control" name="tanggal_kirim_spph" type="date" required/>
										</div>
									</div>
									<div class="col-xl-6">
										<div class="form-group">
											<label class="small mb-1">Perihal </label>
											<input class="form-control" name="perihal" type="text" disabled/>
										</div>
										<div class="form-group">
											<label class="small mb-1">Dari</label>
											<select class="form-control" name="dari" style="width:100%">
												@foreach($users as $user)
													<option @if($procurement->bapp->dari == $user->id) selected @endif value="{{$user->id}}">{{$user->name}} - {{$user->jabatan_caption}}</option>
												@endforeach
											</select>
										</div>
										<div class="form-group">
											<label class="small mb-1">Kepada</label>
											<select class="form-control" name="kepada" style="width:100%">
												@foreach($users as $user)
													<option @if($procurement->bapp->kepada == $user->id) selected @endif value="{{$user->id}}">{{$user->name}} - {{$user->jabatan_caption}}</option>
												@endforeach
											</select>
										</div>
										<div class="form-group">
											<label class="small mb-1">Tempat </label>
											<input name="location" class="form-control" type="text"/>
										</div>
									</div>
								</div>
								<table class="table mt-5 mb-4" id="tableBappVendor" width="100%" cellspacing="0">
									<thead>
										<tr>
											<th>Nama Barang</th>
											<th>Kategori</th>
											<th>Spesifikasi</th>
											<th>Harga Satuan</th>
											<th>Kuantitas</th>
											<th>Total Harga</th>
											<th>Nama Vendor</th>
										</tr>
									</thead>
								</table>
							</fieldset>
						</nav>
					</form>
					<button class="btn btn-info" style="float: left" id="tambahDokumen"> Tambah Dokumen </button>
					<button id="save" class="btn btn-primary" style="float: right;"> Submit </button>
					<button id="addRowTable" hidden> </button>
					<button id="initTable" hidden> </button>
					<button id="setTotal" hidden> </button>
                </div>
            </div>
        </div>
    </div>
</div>

@include('module.procurement.manual.manualjs')

@endsection