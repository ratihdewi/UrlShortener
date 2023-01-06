@extends("master.main")

@section("content")

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
									<span id="partSpph0">
										<div class="form-row">
											<div class="col">
												<label> No.SPPH </label>
												<label class="small mb-1" style="color:red">*</label>
												<input type="text" id="nomorSpph_0" class="form-control" name="no_spph[]" required>
											</div> 
											<div class="col"> 
												<label> Nama Vendor </label> 
												<label class="small mb-1" style="color:red">*</label>  
												<select name="name_vendor[]" class="form-control sm temp" id="opsiVendor_0"></select>
											</div>
										</div>
										<div class="form-group mt-3 mb-3">
											<a href="" id="linkSpph_0"> Unduh Dokumen SPPH </a> 
										</div>
										<div class="form-row mb-5">
											<div class="col">
												<label> Update File SPPH (.pdf) </label>
												<label class="small mb-1" style="color:red">*</label> 
												<input type="file" class="form-control" name="spph_pdf[]" id="spph_pdf_0" required>
											</div>
											<div class="col">
												<label> Unggah File Penawaran Harga (.pdf) </label> 
												<label class="small mb-1" style="color:red">*</label> 
												<input type="file" class="form-control" name="penawaran_pdf[]" id="penawaran_pdf_0" required>
											</div>
										</div>
									</span>
								</span>
							</fieldset>
							<fieldset class="form-group border p-3">
								<legend class="w-auto px-2">Penawaran dan Tender Evaluasi</legend>
								<div class="col-md-5 mb-4 mt-2">
									<label> Unggah File Evaluasi Tender (.pdf) </label> <label class="small mb-1" style="color:red">*</label>
									<input type="file" class="form-control" id="eval_tender_pdf" name="eval_tender_pdf">
								</div>
								<table width="150%" class="table mt-5 mb-5" id="tabelItem">
									<thead>
										<tr>
											<th> Negosiasi </th>
											<th> Nama Barang </th>
											<th> Kategori </th>
											<th> Spesifikasi </th>
											<th class="hargaSatuan"> Harga Satuan <label class="small mb-1" style="color:red">*</label> </th>
											<th> Kuantitas </th>
											<th class="inputTextArea"> Harga Total </th>
											<th> Nama Vendor </th>
											<th class="inputTextArea"> Keterangan <label class="small mb-1" style="color:red">*</label> </th>
											<th class="inputTextArea"> Evaluasi <label class="small mb-1" style="color:red">*</label> </th>
										</tr>
									</thead>
								</table>
							</fieldset>
							<fieldset class="form-group border p-3">
								<legend class="w-auto px-2"> BA Negosiasi </legend>
								<div id="fieldBA-Negosiasi">
									<span class="form-row mb-2">
										<div class="col">
											<label class="small">Hari/Tanggal </label> <label class="small mb-1" style="color:red">*</label> 
											<input name="date[]" id="date0" class="form-control" required="true" type="date"/>
										</div>
										<div class="col">
											<label class="small">Waktu </label> <label class="small mb-1" style="color:red">*</label> 
											<input name="time[]" id="time0" class="form-control" required="true" type="time"/>
										</div>
									</span>

									<span class="form-row mb-2 mt-3">
										<div class="col">
											<label class="small"> Tempat </label> <label class="small mb-1" style="color:red">*</label> 
											<input name="location[]" id="location0" class="form-control" required="true" type="text"/>
										</div>
										<div class="col">
											<label class="small">Peserta Rapat Eksternal <i> Pisahkan dengan tanda koma "," </i> </label> <label class="small mb-1" style="color:red">*</label> 
											<input name="peserta_eksternal[]" id="peserta_eksternal_0" class="form-control" required="true" type="text"/>
										</div>
									</span>

									<div class="form-row mb-2 mt-3">
										<div class="col-xl-12">
											<div class="form-group">
												<label class="small">Peserta Rapat Internal</label> <label class="small mb-1" style="color:red">*</label> 
												<select id="pesertaInternal0" class="form-control select2 sm" name="peserta_id[0][]" style="width:100%" multiple>
													@foreach($pesertas as $peserta)
													<option class="mt-1 mb-1" value="{{$peserta->id}}">{{$peserta->name}}</option>
													@endforeach
												</select>
											</div>
										</div>
									</div>

									<div class="form-row mb-2 mt-3">
										<div class="col-xl-12">
											<div class="form-group">
												<label class="small mb-1">Hasil Rapat </label> <label class="small mb-1" style="color:red">*</label> 
												<textarea name="meeting_result[]" id="meeting_result_0" rows="4" class="form-control{{ $errors->has('meeting_result') ? ' is-invalid' : '' }}">{{ old('meeting_result') }}</textarea>
											</div>
										</div>
									</div>

									<div class="form-row mb-2 mt-3">
										<div class="col">
											<div class="form-group">
												<label class="small mb-1">Upload Dokumentasi Meeting (.jpg | .png) </label> <label class="small mb-1" style="color:red">*</label> 
												<input name="photo_doc[]" id="photo_doc_0" required class="form-control" type="file"/>
											</div>
										</div>
										<div class="col">
											<div class="form-group">
												<label class="small mb-1">Negosiasi </label> <label class="small mb-1" style="color:red">*</label> (Rp)
												<input name="negosiasi[]" id="negosiasi0" required="true" class="form-control" type="text"/>
											</div>
										</div>
									</div>
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
								<div id="fieldPO">
									<div class="row">
										<div class="col-xl-6">
											<div class="form-group">
												<label class="small mb-1">Nomor Memo </label> <label class="small mb-1" style="color:red">*</label> 
												<input name="po_no_memo[]" disabled class="form-control po_no_memo" type="text"/>
											</div>

											<input name="po_job_terms[]" value="Sesuai dengan hasil rapat Negosiasi dan klarifikasi harga" type="hidden"/>
											<input name="po_spph_id[]" class="po_spph_id" hidden type="text" />

											<div class="form-group">
												<label class="small mb-1">Perihal </label> <label class="small mb-1" style="color:red">*</label> 
												<input name="po_perihal[]" disabled class="form-control po_perihal" type="text"/>
											</div>
											<div class="form-group">
												<label class="small mb-1">No SPMP </label> <label class="small mb-1" style="color:red">*</label> 
												<input name="po_no_spmp[]" id="po_no_spmp0" class="form-control" type="text" onchange="setSpmpBast(0)" />
											</div>
										</div>
										<div class="col-xl-6">
											<div class="form-group">
												<label class="small mb-1">Tanggal </label> <label class="small mb-1" style="color:red">*</label> 
												<input name="po_date[]" id="po_date0" class="form-control" type="date"/>
											</div>
											<div class="form-group">
												<label class="small mb-1">Disetujui Oleh </label> <label class="small mb-1" style="color:red">*</label> 
												<select class="form-control" name="po_approved_by[]" id="po_approved_by0">
													@foreach($users as $user)
													<option value="{{$user->id}}">{{$user->name}} - {{$user->jabatan_caption}}</option>
													@endforeach
												</select>
											</div>
											<div class="form-group">
												<div class="row">
													<div class="col-md-10">
														<label class="small mb-1">Dokumen Pendukung</label> <label class="small mb-1" style="color:red">*</label> 
														<input name="po_dok_pendukung[]" id="po_dok_pendukung0" class="form-control" type="file"/>
													</div>
													<div class="col-md-2">
														<label class="small mb-1">PPN </label> <label class="small mb-1" style="color:red">*</label> 
														<input name="po_ppn[]" id="po_ppn0" style="width:20px" checked value="1" class="form-control" type="checkbox"/>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-xl-12">
											<div class="form-group">
												<label class="small mb-1">Ketentuan Pekerjaan </label> <label class="small mb-1" style="color:red">*</label> 
												<textarea id="ket_kerja0" name="po_ketentuan_pekerjaan[]" rows="4" class="form-control"> </textarea>
											</div>
											<div class="form-group">
												<label class="small mb-1">Ketentuan Pembayaran </label> <label class="small mb-1" style="color:red">*</label>
												<textarea id="ket_bayar0" name="po_ketentuan_pembayaran[]" rows="4" class="form-control"> </textarea>
											</div>
										</div>
									</div>
								</div>
							</fieldset>
							<fieldset class="form-group border p-3">
								<legend class="w-auto px-2"> BAST </legend>
								<div id="fieldBAST">
									<div class="row">
										<div class="col-xl-6">
											<div class="form-group">
												<label class="small mb-1">Nama Vendor </label> <label class="small mb-1" style="color:red">*</label> 
												<input disabled id="bast_vn0" class="form-control" type="text"/>
											</div>
											<div class="form-group">
												<label class="small mb-1">Perihal </label> <label class="small mb-1" style="color:red">*</label> 
												<input disabled id="bast_perihal0" class="form-control" type="text"/>
											</div>
											<div class="form-group">
												<label class="small mb-1">No Surat </label> <label class="small mb-1" style="color:red">*</label> 
												<input name="bast_no_surat[]" id="bast_nosurat0" class="form-control" type="text"/>
											</div>
											<div class="form-group">
												<label class="small mb-1">Pihak Pertama </label> <label class="small mb-1" style="color:red">*</label> 
												<select class="form-control select2 pihakPertama" id="pihakPertama0" name="bast_user_id[]" style="width:100%">
													@foreach($generalUsers as $user)
													<option value="{{$user->id}}">
														{{$user->name}} - {{$user->role_caption}}
													</option>
													@endforeach
												</select>
											</div>
										</div>
										<div class="col-xl-6">
											<div class="form-group">
												<label class="small mb-1">Nomor SPMP </label> <label class="small mb-1" style="color:red">*</label> 
												<input disabled id="bastSpmp0" class="form-control" type="text"/>
											</div>
											<div class="form-group">
												<label class="small mb-1">Nama Pihak Kedua </label> <label class="small mb-1" style="color:red">*</label> 
												<input name="bast_nama_pihak_kedua[]" class="form-control" id="bast_nama_pihak_kedua0" type="text"/>
											</div>
											<div class="form-group">
												<label class="small mb-1">Jabatan Pihak Kedua</label> <label class="small mb-1" style="color:red">*</label> 
												<input name="bast_jabatan_pihak_kedua[]" id="bast_jabatan_pihak_kedua0" class="form-control" type="text"/>
											</div>
											<div class="form-group">
												<label class="small mb-1">Upload Dokumen&nbsp;</label> <label class="small mb-1" style="color:red">*</label> 
												<input name="bast_file[]" id="bast_file0" class="form-control" type="file" />
											</div>
										</div>
									</div>
								</div>
							</fieldset>
							<fieldset class="form-group border p-3">
								<legend class="w-auto px-2"> Penilaian Vendor </legend>
								<div style="margin-top: 1.5% !important; margin-bottom: 3.5% !important;">
									<div class="table-responsive">
										<table class="table" id="tablePV" width="100%" cellspacing="0">
											<thead>
												<tr>
													<th> Nama Vendor </th>
													<th> Nomor SPPH </th>
													<th> Skor </th>
													<th> Komentar </th>
													<th> Action </th>
												</tr>
											</thead>
										</table>
									</div>
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

@include('module.procurement.manual.penunjukkan-langsung.js')

@endsection