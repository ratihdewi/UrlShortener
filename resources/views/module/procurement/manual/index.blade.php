@extends("master.main")

@section("content")

<div class="container mt-4">
    <div class="row">
        <div class="col-xl-12">
            <div class="card mb-4">
                <div class="card-body text-sm">
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


<script type="text/javascript">

	$(document).ready(function() {
        $('#opsiVendor').prop('disabled', true);
		$('#opsiVendor').append('<option disabled selected> Pilih Vendor </option>');
		$('#tambahDokumen').hide();
    });

	var vendorSelect = [];
	var jumlahItem = 0;
	var currOpt = 0;

	$(function(){
		
		var currUrl = "{{ \Request::fullUrl() }}";
		var jumlahVendor = 0;
		
		var myTable = $('#tabelItem').DataTable({
			"searching" : false,
			"lengthChange": false,
			"ordering": false,
		});

		$('#opsiProcurement').on('change', function() {
			vendorSelect = [];
			myTable.clear();
			jumlahVendor = 0;
			
			$('#fieldSpph').html('');
			$('#tambahDokumen').show();
			$('#tambahDokumen').click();
		});

		$('#tambahDokumen').on('click', function() {

			var logHtml = '<div class="form-row"> <div class="col"> <label> No.SPPH </label> <input type="text" id="nomorSpph_'+jumlahVendor+'" class="form-control" name="no_spph[]"> </div> <div class="col"> <label> Nama Vendor </label> <select name="name_vendor[]" class="form-control" class="temp" id="opsiVendor_'+jumlahVendor+'" onchange="ubahVendor('+jumlahVendor+')"></select> </div> </div> <div class="form-group mt-3 mb-3"> <a href="" id="linkSpph_'+jumlahVendor+'"> Unduh Dokumen SPPH </a> </div>  <div class="form-row mb-5"><div class="col"><label> Update File SPPH (.pdf) </label><input type="file" class="form-control" name="spph_pdf[]"></div><div class="col"><label> Unggah File Penawaran Harga (.pdf) </label><input type="file" class="form-control" name="penawaran_pdf[]"></div><div class="col"><label> Unggah File Evaluasi Tender (.pdf) </label><input type="file" class="form-control" name="eval_tender_pdf[]"></div></div>';

			$('#fieldSpph').append(logHtml);
			generateOption(jumlahVendor);

			jumlahVendor++;
		});

		$('#addRowTable').on('click', function() {
			
			let arrValue = this.value.split(',');

			let numRow = myTable.column(0).data().length;
			let index = vendorSelect.indexOf(arrValue[0]);

			let start = index*jumlahItem;
			let finish = start + jumlahItem;
			let namaVendor = '';

			for (let i=start; i<finish; i++) {
				let row = myTable.row(i).data().toString();
				let arrRow = row.split(',');
				myTable.cell(i, 6).data(arrValue[1]);
			}

		});

		$('#initTable').on('click', function() {
			let numRow = myTable.column(0).data().length;
			let counter = jumlahItem;

			if (!vendorSelect.includes('-')){
				jumlahItem = 0;
				$.ajax({
					type: "GET",
					url: currUrl + "/getPenawaran/" + this.value,
					success: function(res) {
						$.each(res, function(k,v){
							let id = counter*vendorSelect.length+k;
							myTable.row.add([
								v.name,
								v.category_name,
								v.specs,
								`<input type="text" class="form-control" id="harga_satuan_${id}" name="harga_satuan[]" onchange="setHargaTotal(${id},${v.total_unit})">`,
								v.total_unit,
								'',
								v.vendor_id,
								`<input type="text" class="form-control" id="keterangan_${id}" name="keterangan[]">`,
								`<input type="text" class="form-control" id="evaluasi_${id}" name="evaluasi[]">`,
								`<input type="text" class="form-control" id="nilai_${id}" name="nilai[]">`
							]).draw(false);
							jumlahItem++;
						});
					}
				});
			}
			
		});

		$('#setTotal').on('click', function(){
			let arr = this.value.split(',');
			myTable.cell(arr[0],5).data(arr[1]);
		});

		$('#save').on('click', function(){
			$('#storeData').submit();
		});

	});

	function ubahVendor(id) {

		var proc_id = $('#opsiProcurement').val();
		var vendor_id = $('#opsiVendor_'+id).val();
		vendorSelect[id] = vendor_id;
		$('#nomorSpph_'+id).prop('value', '');

		$.ajax({
			type: "GET",
			url: window.location.href + "/getSpph/" + proc_id + "/" + vendor_id,
			success: function(res) {
				$('#nomorSpph_'+id).prop('value', res.no_spph);
				$('#linkSpph_'+id).prop('href', "{{ url('/spph-tor/download') }}" + "/" + res.id);
				
				var arr = [vendor_id, res.vendor_name];

				$('#addRowTable').prop('value', arr);
				$('#addRowTable').click();

				for(let i=id+1; i<vendorSelect.length; i++){
					vendorSelect[i] = '-';
					generateOption(i);
				}
			}
		});
	}

	function generateOption(i) {

		$('#opsiVendor_'+i).html('');
		$('#linkSpph_'+i).prop('href', '');
		$('#nomorSpph_'+i).prop('value', '');

		$('#opsiVendor_'+i).append('<option disabled selected> Pilih Vendor </option>');
		$('#opsiVendor_'+i).prop('disabled', true);

		var proc_id = $('#opsiProcurement').val();

		$.ajax({
			type: "GET",
			url: window.location.href + "/getVendor/" + proc_id,
			success: function(res) {
				$('#opsiVendor_'+i).prop('disabled', false);
				currOpt = 0;
				$.each(res, function(key, value){
					if (!vendorSelect.includes(value.id.toString())){
						currOpt++;
						$('#opsiVendor_'+i).append('<option value='+value.id+'>'+ value.name +'</option>');
					}
				});

				if (currOpt < 2) {
					$('#tambahDokumen').hide();
				}
			}
		});

		$('#initTable').prop('value', proc_id);
		$('#initTable').click();
	}

	function setHargaTotal(id, qty) {

		var val = $('#harga_satuan_'+id).val();
		var arr = [id, qty*val];

		$('#setTotal').prop('value', arr.toString());
		$('#setTotal').click();
	}

</script>

@endsection