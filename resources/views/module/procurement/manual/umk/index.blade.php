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
					<form method="POST" id="submitData">
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
								<table class="table" id="tableApproval">
									<thead>
										<tr>
											<th> Nama Barang </th>
											<th> Kategori </th>
											<th> Harga </th>
											<th> Unit </th>
											<th> Spesifikasi </th>
											<th> Brosur </th>
											<th> Harga Total </th>
											<th> Vendor </th>
											<th> Aksi </th>
										</tr>
									</thead>
								</table>
							</fieldset>
						</nav>
					</form>

				</div>
			</div>
		</div>
	</div>
</div>

@include('module.procurement.manual.umk.js')

@endsection