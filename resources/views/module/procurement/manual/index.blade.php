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
					<form method="POST" id="storeData" enctype="multipart/form-data" action="{{ route('manual.store') }}">
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