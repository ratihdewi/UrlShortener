@extends("master.main")

@section("content")

<div class="container mt-4">
    <div class="row">
        <div class="col-xl-12">
            <div class="card mb-4">
                <div class="card-body text-sm">
					<form method="POST" id="storeData" enctype="multipart/form-data" action="{{ route('proc.manual.store') }}">
						@csrf
						<div class="form-group mb-4">
							<label> Pengadaan </label> <label class="small mb-1" style="color:red">*</label>
							<select name="procurement" id="opsiProcurement" class="form-control select2 sm">
								<option disabled selected> Pilih Pengadaan </option>
								@foreach($procurements as $procurement)
									<option value="{{ $procurement->id }}"> {{ $procurement->name }} </option>
								@endforeach
							</select>
							@if ($errors->has('procurement'))
								<span class="small" style="color:red" role="alert">
									<div class="mt-2"> <i> *Pengadaan wajib diisi </i> </div>
								</span>
							@endif
						</div>
						<span id="fieldFile">
							<fieldset class="form-group border p-3">
								<legend class="w-auto px-2">Dokumen Vendor</legend>
								<div class="datatable">
									<table class="table" id="tableDocVendor">
										<thead>
											<tr>
												<th width="5%"> <input type="checkbox" id="selectDeselectAll"> </th>
												<th width="20%"> Nama Vendor </th>
												<th width="25%"> Dokumen SPPH </th>
												<th width="25%"> Dokumen Penawaran </th>
												<th width="25%"> Dokumen BA Negosiasi </th>
											</tr>
										</thead>
									</table>
								</div>
							</fieldset>
							<fieldset class="form-group border p-3">
								<legend class="w-auto px-2">Dokumen Pengadaan</legend>
								<div class="row">
									<div class="col">
										<div class="mt-1"> 
											<label> Unggah File Evaluasi Tender (.pdf) </label> <label class="small mb-1" style="color:red">*</label>
											<input type="file" class="form-control-file" id="file_et" name="eval_tender_pdf"> 
										</div>
										<div class="mt-4">
											<label> Unggah File SP3 (.pdf) </label> <label class="small mb-1" style="color:red">*</label>
											<input type="file" class="form-control-file" id="file_sp3" name="sp3_pdf"> 
										</div>
									</div>
									<div class="col">
										<div class="mt-1">
											<label> Unggah File BAPP (.pdf) </label> <label class="small mb-1" style="color:red">*</label>
											<input type="file" class="form-control-file" id="file_bapp" name="bapp_pdf">
										</div>							
									</div>
								</div>
								<div class="mt-5">
									<div class="datatable">
										<table class="table" id="tablePoBast">
											<thead>
												<tr>
													<th width="15%"> Nama Vendor </th>
													<th width="17%"> Nilai PO </th>
													<th width="30%"> Dokumen PO </th>
													<th width="30%"> Dokumen BAST </th>
													<th width="8%"> Tindakan </th>
												</tr>
											</thead>
										</table>
									</div>
								</div>
							</fieldset>
						</span>
						<div id="otherField"> </div>
					</form>
					<button id="save" class="btn btn-primary" style="float: right;"> Submit </button>
					<button class="btn btn-info" style="float: left" id="addRow"> Tambah Vendor </button>
					<button id="deleteRow" class="btn btn-danger ml-2" style="float: left;"> Hapus vendor </button>
					<button id="setChecked" hidden></button>
				</div>
			</div>
		</div> 
	</div>
</div>

@include('module.procurement.manual.tender.js')

@endsection