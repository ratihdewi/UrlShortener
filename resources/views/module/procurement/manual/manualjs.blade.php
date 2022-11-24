<script type="text/javascript">

	$(document).ready(function() {
        $('#opsiVendor').prop('disabled', true);
		$('#opsiVendor').append('<option disabled selected> Pilih Vendor </option>');
		$('#tambahDokumen').hide();
    });

	var vendorSelect = [];
	var arrNego = [];
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
			$('#fieldBA-Negosiasi').html('');
			$('#tambahDokumen').show();
			$('#tambahDokumen').click();
		});

		$('#tambahDokumen').on('click', function() {

			var logHtml = '<div class="form-row"> <div class="col"> <label> No.SPPH </label> <input type="text" id="nomorSpph_'+jumlahVendor+'" class="form-control" name="no_spph[]" required> </div> <div class="col"> <label> Nama Vendor </label> <select name="name_vendor[]" class="form-control" class="temp" id="opsiVendor_'+jumlahVendor+'" onchange="ubahVendor('+jumlahVendor+')"></select> </div> </div> <div class="form-group mt-3 mb-3"> <a href="" id="linkSpph_'+jumlahVendor+'"> Unduh Dokumen SPPH </a> </div>  <div class="form-row mb-5"><div class="col"><label> Update File SPPH (.pdf) </label><input type="file" class="form-control" name="spph_pdf[]" required></div><div class="col"><label> Unggah File Penawaran Harga (.pdf) </label><input type="file" class="form-control" name="penawaran_pdf[]" required></div></div>';
			var collapse = `<div class="accordion" id="accordion${jumlahVendor}">
				<div class="card" style="margin: 1.5%">
					<div class="card-header" id="heading${jumlahVendor}">
						<h2 class="mb-0">
							<button class="btn text-left" type="button" data-toggle="collapse" data-target="#collapse${jumlahVendor}" aria-expanded="true" aria-controls="collapse${jumlahVendor}">
								<div id="headerBA${jumlahVendor}"> -- </div>
							</button>
						</h2>
					</div>
					<div id="collapse${jumlahVendor}" class="collapse" aria-labelledby="heading${jumlahVendor}" data-parent="#accordion${jumlahVendor}">
						<div class="card-body" style="border: none !important">
							<span class="form-row mb-2">
								<div class="col">
									<label class="small">Hari/Tanggal </label>
									<input name="date[]" class="form-control" required="true" type="date"/>
								</div>
								<div class="col">
									<label class="small">Waktu </label>
									<input name="time[]" class="form-control" required="true" type="time"/>
								</div>
							</span>

							<span class="form-row mb-2 mt-3">
								<div class="col">
									<label class="small"> Tempat </label>
									<input name="location[]" class="form-control" required="true" type="ztext"/>
								</div>
								<div class="col">
									<label class="small">Peserta Rapat Vendor/Eksternal</label> <label style="font-size:8pt" class="small mb-1">Pisahkan nama dengan tanda koma ","</label>
									<input name="peserta_eksternal[]" class="form-control" required="true" type="text"/>
								</div>
							</span>

							<div class="form-row mb-2 mt-3">
								<div class="col-xl-12">
									<div class="form-group">
										<label class="small">Peserta Rapat Internal</label>
										<select size="10" class="form-control select2" multiple="multiple" name="peserta_id[${jumlahVendor}][]" style="width:100%">
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
										<label class="small mb-1">Hasil Rapat </label>
										<textarea name="meeting_result[]" rows="4" class="form-control{{ $errors->has('meeting_result') ? ' is-invalid' : '' }}">{{ old('meeting_result') }}</textarea>
									</div>
								</div>
							</div>

							<div class="form-row mb-2 mt-3">
								<div class="col">
									<div class="form-group">
										<label class="small mb-1">Upload Dokumentasi Meeting (.jpg | .png) </label>
										<input name="photo_doc[]" required="true" class="form-control" type="file"/>
									</div>
								</div>
								<div class="col">
									<div class="form-group">
										<label class="small mb-1">Negosiasi </label>(Rp)
										<input name="negosiasi[]" required="true" class="form-control" type="text"/>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			`;

			$('#fieldSpph').append(logHtml);
			$('#fieldBA-Negosiasi').append(collapse);
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
							arrNego[id] = -1;
							myTable.row.add([
								`<input type="checkbox" onchange="ubahArrNego(${id})" />`,
								v.name,
								v.category_name,
								v.specs,
								`<input type="text" class="form-control" id="harga_satuan_${id}" name="harga_satuan[]" onchange="setHargaTotal(${id},${v.total_unit})" required>`,
								v.total_unit,
								'',
								v.vendor_id,
								`<input type="text" class="form-control" id="keterangan_${id}" name="keterangan[]" required>`,
								`<input type="text" class="form-control" id="evaluasi_${id}" name="evaluasi[]" required>`,
								`<input type="text" class="form-control" id="nilai_${id}" name="nilai[]" required>`
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
			$('#otherField').append(`<input type="hidden" name="arrNego" value="${arrNego}" />`);
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

				$(`#headerBA${id}`).html(res.vendor_name);
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

	function ubahArrNego(id) {

		if (arrNego[id] < 0) {
			arrNego[id] = id;
		} else {
			arrNego[id] = -1;
		}

	}
	

</script>