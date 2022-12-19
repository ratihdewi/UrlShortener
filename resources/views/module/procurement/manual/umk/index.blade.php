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

					<form method="POST" id="submitData" enctype="multipart/form-data">
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
						<nav id="approval" class="mt-4 mb-4">
							<fieldset class="form-group border p-3">
								<legend class="w-auto px-2">Approval</legend>
								<table class="table mt-5 mb-5" width="150%" id="tableApproval">
									<thead>
										<tr>
											<th> Nama Barang </th>
											<th> Kategori </th>
											<th> Harga </th>
											<th> Unit </th>
											<th> Spesifikasi </th>
											<th width="20%"> Brosur </th>
											<th> Harga Total </th>
											<th width="15%"> Vendor </th>
											<th> Aksi </th>
										</tr>
									</thead>
								</table>
							</fieldset>
						</nav>
						<nav id="sp3">
							<fieldset class="form-group border p-3">
								<legend class="w-auto px-2"> SP3 </legend>
								<div class="form-group">
									<label> Keterangan </label>
									<input type="text" name="sp3_keterangan" id="sp3_keterangan"  class="form-control" value="" />
								</div>
								<div class="form-group">
									<label> Unggah File SP3 (.pdf) </label>
									<input type="file" name="sp3_file" id="sp3_file"  class="form-control" value="" />
								</div>
							</fieldset>
						</nav>
						<nav id="bast">
							<fieldset class="form-group border p-3">
								<legend class="w-auto px-2"> BAST </legend>
								<div class="form-group">
									<label> Keterangan </label>
									<input type="text" name="bast_keterangan" id="bast_keterangan"  class="form-control" value="" />
								</div>
								<div class="form-group">
									<label> Unggah File BAST (.pdf) </label>
									<input type="file" name="bast_file" id="bast_file"  class="form-control" value="" />
								</div>
							</fieldset>
						</nav>
						<nav id="pjUmk">
							<fieldset class="form-group border p-3">
								<legend class="w-auto px-2"> PJ UMK </legend>
								<div class="row">
									<div class="col-xl-6">
										<div class="form-group">
											<label class="small mb-1">Nomor Memo </label>
											<input name="no_memo" id="no_memo" disabled  class="form-control" type="text"/>
										</div>
										<div class="form-group">
											<label class="small mb-1">Perihal </label>
											<input name="perihal" id="perihal" disabled  class="form-control" type="text"/>
										</div>
										<div class="form-group">
											<label class="small mb-1">No Memo UMK </label>
											<input name="no_memo_umk" id="no_memo_umk" class="form-control" type="text"/>
										</div>
										<div class="form-group">
											<label class="small mb-1">Nama </label>
											<input name="name" id="name" class="form-control" type="text"/>
										</div>
										<div class="form-group">
											<label class="small mb-1">No Pekerja</label>
											<input name="no_pekerja" id="no_pekerja" class="form-control" type="text"/>
										</div>
										<div class="form-group">
											<label class="small mb-1">Jabatan </label>
											<input name="jabatan" id="jabatan" class="form-control" type="text"/>
										</div>
									</div>
									<div class="col-xl-6">
										<div class="form-group">
											<label class="small mb-1">Fungsi </label>
											<input name="fungsi" id="fungsi" class="form-control" type="text"/>
										</div>
										<div class="form-group">
											<label class="small mb-1">GL Account/ Cost Element</label>
											<input name="gl_account" id="gl_account" class="form-control" type="text"/>
										</div>
										<div class="form-group">
											<label class="small mb-1">Cost Center </label>
											<input name="cost_center" id="cost_center" class="form-control" type="text"/>
										</div>
										<div class="form-group">
											<label class="small mb-1">Jumlah </label>
											<input name="total" id="total" class="form-control" type="text"/>
										</div>
										<div class="form-group">
											<label class="small mb-1">Upload Invoice</label>
											<input name="invoice_file" id="invoice_file" class="form-control" type="file"/>
										</div>
									</div>
								</div>
							</fieldset>
						</nav>
					</form>
					<button id="save" class="btn btn-primary" style="float: right;"> Submit </button>
				</div>
			</div>
		</div>
	</div>
</div>

@include('module.procurement.manual.umk.js')

@endsection