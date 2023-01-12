@extends("master.main")

@section("content")

<div class="container mt-4">
    <div class="row">
        <div class="col-xl-12">
            <div class="card mb-4">
                <div class="card-body text-sm">
                	<form method="POST" id="storeData" enctype="multipart/form-data" action="{{ route('proc.manual.storeUmk') }}">
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
						<fieldset class="form-group border p-3">
							<legend class="w-auto px-2"> Dokumen UMK </legend>
							<div class="row mb-4">
								<div class="col">
									<label> Unggah File SP3 (.pdf) </label> <label class="small mb-1" style="color:red">*</label>
									<input type="file" class="form-control-file" id="file_sp3" name="sp3_pdf">
								</div>
								<div class="col">
									<label> Unggah File BAST (.pdf) </label> <label class="small mb-1" style="color:red">*</label>
									<input type="file" class="form-control-file" id="file_bast" name="bast_pdf">
								</div>
							</div>
							<div class="row mb-3">
								<div class="col">
									<label> Unggah File PJ UMK (.pdf) </label> <label class="small mb-1" style="color:red">*</label>
									<input type="file" class="form-control-file" id="file_pjumk" name="pjumk_pdf">
								</div>
								<div class="col">
									<label> Unggah File Invoice (.pdf) </label> <label class="small mb-1" style="color:red">*</label>
									<input type="file" class="form-control-file" id="file_invoice" name="invoice_pdf" disabled>
								</div>
							</div>
						</fieldset>
                	</form>
                	<button id="save" class="btn btn-primary" style="float: right;"> Submit </button>
                </div>
            </div>
        </div>
    </div>
</div>


@include('module.procurement.manual.umk.js')

@endsection