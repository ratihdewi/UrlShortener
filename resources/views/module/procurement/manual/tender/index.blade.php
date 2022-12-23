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
							<label> Pengadaan </label> <label class="small mb-1" style="color:red">*</label>
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
									<label> Unggah File Evaluasi Tender (.pdf) </label> <label class="small mb-1" style="color:red">*</label>
									<input type="file" class="form-control" id="eval_tender_pdf" name="eval_tender_pdf">
								</div>
								<table width="130%" class="table mt-5 mb-5" id="tabelItem">
									<thead>
										<tr>
											<th> Negosiasi </th>
											<th> Nama Barang </th>
											<th> Kategori </th>
											<th> Spesifikasi </th>
											<th> Harga Satuan <label class="small mb-1" style="color:red">*</label> </th>
											<th> Kuantitas </th>
											<th width="10%"> Harga Total </th>
											<th> Nama Vendor </th>
											<th width="20%"> Keterangan <label class="small mb-1" style="color:red">*</label> </th>
											<th width="20%"> Evaluasi <label class="small mb-1" style="color:red">*</label> </th>
											@if($procurement->mechanism_id!=3)<th width="10%"> Nilai <label class="small mb-1" style="color:red">*</label> </th> @endif
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
											<label class="small mb-1">Nomor Memo </label> <label class="small mb-1" style="color:red">*</label>
											<input disabled name="nomor_memo_bapp" id="nomor_memo_bapp" class="form-control" type="text"/>
										</div>
										<div class="form-group">
											<label class="small mb-1">Nomor Surat </label> <label class="small mb-1" style="color:red">*</label>
											<input class="form-control" name="no_surat_bapp" id="no_surat_bapp" type="text" required/>
										</div>
										<div class="form-group">
											<label class="small mb-1">Tanggal BAPP</label> <label class="small mb-1" style="color:red">*</label>
											<input class="form-control" name="tanggal_bapp" id="tanggal_bapp" type="date"/>
										</div>
										<div class="form-group">
											<label class="small mb-1">Tanggal Pengiriman SPPH</label> <label class="small mb-1" style="color:red">*</label>
											<input class="form-control" name="tanggal_kirim_spph" id="tanggal_kirim_spph" type="date" required/>
										</div>
									</div>
									<div class="col-xl-6">
										<div class="form-group">
											<label class="small mb-1">Perihal </label> <label class="small mb-1" style="color:red">*</label>
											<input class="form-control" name="perihal" id="perihal" type="text" disabled/>
										</div>
										<div class="form-group">
											<label class="small mb-1">Dari</label> <label class="small mb-1" style="color:red">*</label>
											<select class="form-control" name="dari" id="dari" style="width:100%">
												@foreach($users as $user)
													<option value="{{$user->id}}">{{$user->name}} - {{$user->jabatan_caption}}</option>
												@endforeach
											</select>
										</div>
										<div class="form-group">
											<label class="small mb-1">Kepada</label> <label class="small mb-1" style="color:red">*</label>
											<select class="form-control" name="kepada" id="kepada" style="width:100%">
												@foreach($users as $user)
													<option value="{{$user->id}}">{{$user->name}} - {{$user->jabatan_caption}}</option>
												@endforeach
											</select>
										</div>
										<div class="form-group">
											<label class="small mb-1">Tempat </label> <label class="small mb-1" style="color:red">*</label>
											<input name="lokasi" id="lokasi" class="form-control" type="text"/>
										</div>
									</div>
								</div>
								<div style="margin-top: 3.5% !important; margin-bottom: 3.5% !important;">
									<table class="table" id="tableBappVendor" width="100%" cellspacing="0">
										<thead>
											<tr>
												<th>Nama Barang</th>
												<th>Kategori</th>
												<th>Spesifikasi</th>
												<th>Harga Satuan</th>
												<th>Kuantitas</th>
												<th>Total Harga</th>
												<th>Keterangan</th>
												<th>Nama Vendor</th>
											</tr>
										</thead>
									</table>
								</div>
							</fieldset>
							<fieldset class="form-group border p-3">
								<legend class="w-auto px-2"> PO </legend>
								<div id="fieldPO"></div>
							</fieldset>
							<fieldset class="form-group border p-3">
								<legend class="w-auto px-2"> BAST </legend>
								<div id="fieldBAST"></div>
							</fieldset>
							<fieldset class="form-group border p-3">
								<legend class="w-auto px-2"> Penilaian Vendor </legend>
								<div style="margin-top: 1.5% !important; margin-bottom: 3.5% !important;">
									<table class="table" id="tablePV" width="130%" cellspacing="0">
										<thead>
											<tr>
												<th> Nama Vendor </th>
												<th> Nomor SPPH </th>
												<th> Skor </th>
												<th> Komentar </th>
											</tr>
										</thead>
									</table>
								</div>
							</fieldset>
							<fieldset class="form-group border p-3">
								<legend class="w-auto px-2"> Input SP3 </legend>
								<div id="fieldSP3">
									<div class="form-group">
										<label> Keterangan </label> <label class="small mb-1" style="color:red">*</label>
										<input type="text" name="sp3_keterangan" id="sp3_keterangan"  class="form-control" value="" />
									</div>
									<div class="form-group">
										<label> Unggah File SP3 (.pdf) </label> <label class="small mb-1" style="color:red">*</label>
										<input type="file" name="sp3_file" id="sp3_file"  class="form-control" value="" />
									</div>
								</div>
							</fieldset>
						</nav>
					</form>
					<button class="btn btn-info" style="float: left" id="tambahDokumen"> Tambah Dokumen </button>
					<div class="btn-group" role="group">
						<button data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn btn-danger ml-2 dropdown-toggle" style="float: left" id="hapusDokumen"> Hapus Dokumen </button>
						<div class="dropdown-menu item-hapus-vendor" aria-labelledby="hapusDokumen">
					    </div>
					</div>
					<button id="save" class="btn btn-primary" style="float: right;"> Submit </button>
					<button id="addRowTable" hidden> </button>
					<button id="initTable" hidden> </button>
					<button id="setTotal" hidden> </button>
					<button id="loadBapp" hidden></button>
					<button id="deleteRowTable" hidden> </button>
                </div>
            </div>
        </div>
    </div>
</div>

@include('module.procurement.manual.tender.manualjs')

@endsection