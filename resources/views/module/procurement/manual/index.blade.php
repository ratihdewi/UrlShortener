@extends("master.main")

@section("content")

<div class="container mt-4">
    <div class="row">
        <div class="col-xl-12">
            <div class="card mb-4">
                <div class="card-body text-sm">
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
                        <legend class="w-auto px-2">SPPH</legend>
						<span id="fieldSpph">
						</span>
						<button class="btn btn-info btn-sm" style="float: right" id="tambahSpph"> Tambah SPPH </button>
                    </fieldset>
                    <fieldset class="form-group border p-3">
                    	<legend class="w-auto px-2">Penawaran dan Tender Evaluasi</legend>
                    	<div class="form-row mb-5">
                        	<div class="col">
	                            <label> Unggah File Penawaran Harga (.pdf) </label>
	                            <input type="file" class="form-control" name="penawaran_pdf">
                        	</div>
                        	<div class="col">
	                            <label> Unggah File Evaluasi Tender (.pdf) </label>
	                            <input type="file" class="form-control" name="eval_tender_pdf">
                        	</div>
                        </div>

                        <table class="table mt-5 mb-5" id="tabelItem">
							<thead>
								<tr>
									<th> Nama Barang </th>
									<th> Kategori </th>
									<th> Spesifikasi </th>
									<th> Harga Satuan </th>
									<th> Kuantitas </th>
									<th> Harga Total </th>
									<th> Nama Vendor </th>
									<th> Evaluasi </th>
									@if($procurement->mechanism_id!=3)<th style="text-align: center;"> Nilai </th> @endif
								</tr>
							</thead>
                        </table>

                     </fieldset>
                    <button class="btn btn-primary" style="float: right;"> Submit </button>
					<button id="addRowTable" hidden> </button>
					<button id="initTable" hidden> </button>
                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">

	$(document).ready(function() {
        $('#opsiVendor').prop('disabled', true);
		$('#opsiVendor').append('<option disabled selected> Pilih Vendor </option>');
    });

	var vendorSelect = [];

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
			$('#fieldSpph').html('');
			$('#tambahSpph').click();
		});

		$('#tambahSpph').on('click', function() {

			var logHtml = '<div class="form-row"> <div class="col"> <label> No.SPPH </label> <input type="text" id="nomorSpph_'+jumlahVendor+'" class="form-control" name="no_spph[]"> </div> <div class="col"> <label> Nama Vendor </label> <select name="name_vendor[]" class="form-control" class="temp" id="opsiVendor_'+jumlahVendor+'" onchange="ubahVendor('+jumlahVendor+')"></select> </div> </div> <div class="form-group mt-3 mb-3"> <a href="" id="linkSpph_'+jumlahVendor+'"> Unduh Dokumen SPPH </a> </div>';

			$('#fieldSpph').append(logHtml);
			generateOption(jumlahVendor);

			jumlahVendor++;
		});

		$('#addRowTable').on('click', function() {
			let numRow = myTable.column(0).data().length;
			for (let i=0; i<numRow; i++) {
				let row = myTable.row(i).data().toString();
				let arrRow = row.split(',');
				
				if (arrRow[6] == '') {
					myTable.cell(i, 6).data(this.value);
				}
			}
		});

		$('#initTable').on('click', function() {
			$.ajax({
				type: "GET",
				url: currUrl + "/getPenawaran/" + this.value,
				success: function(res) {
					$.each(res, function(k,v){
						myTable.row.add([
							v.name,
							v.category_id,
							v.specs,
							'',
							v.total_unit,
							'',
							v.vendor_id,
							'',
							''
						]).draw(false);
					});
				}
			});
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
				
				$('#addRowTable').prop('value', vendor_id);
				$('#addRowTable').click();
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
	
				$.each(res, function(key, value){
					if (!vendorSelect.includes(value.id.toString())){
						$('#opsiVendor_'+i).append('<option value='+value.id+'>'+ value.name +'</option>');
					}
				})
			}
		});

		$('#initTable').prop('value', proc_id);
		$('#initTable').click();
	}

</script>

@endsection