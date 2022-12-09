<script type="text/javascript">

	$(document).ready(function() {
        $('#opsiVendor').prop('disabled', true);
		$('#opsiVendor').append('<option disabled selected> Pilih Vendor </option>');
		$('#tambahDokumen').hide();
		$('#spph-negosiasi').hide();
		$('#bapp').hide();
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
			"scrollX": true,
			"paging": false,
			"lengthChange": false,
			"ordering": false,
		});

		var tableBapp = $('#tableBappVendor').DataTable({
			"searching" : false,
			"paging": false,
			"lengthChange": false,
			"ordering": false,
		});

		var tablePV = $('#tablePV').DataTable({
			"searching" : false,
			"paging": false,
			"lengthChange": false,
			"ordering": false,
		});

		$('#opsiProcurement').on('change', function() {
			vendorSelect = [];
			myTable.clear();
			tableBapp.clear();
			tablePV.clear();
			jumlahVendor = 0;

			$.ajax({
				type: "GET",
				url: window.location.href + "/getProcurement/" + this.value,
				success: function(res) {

					if(parseInt(res.status) >= 5) {
						$('#spph-negosiasi').hide();
						$('#bapp').show();
						$('#fieldPO').html('');
						$('#fieldBAST').html('');
						$('#storeData').prop('action', "{{ route('manual.storebapp') }}");
						tablePV.clear();

						$('#loadBapp').click();
						$('#tambahDokumen').hide();

					} else {
						$('#spph-negosiasi').show();
						$('#bapp').hide();
						$('#storeData').prop('action', "{{ route('manual.store') }}");

						$('#fieldSpph').html('');
						$('#fieldBA-Negosiasi').html('');
						$('#tambahDokumen').show();
						$('#tambahDokumen').click();
					}
				}
			});
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
									<input name="location[]" class="form-control" required="true" type="text"/>
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
										<input name="photo_doc[]" required class="form-control" type="file"/>
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
			let arrCat = [];

			let numRow = myTable.column(0).data().length;
			let index = vendorSelect.indexOf(arrValue[0]);

			let start = index*jumlahItem;
			let finish = start + jumlahItem;
			let namaVendor = '';

			$.ajax({
				type: "GET",
				url: window.location.href + "/getVendorCategory/" + arrValue[0],
				success: function(res) {
					$.each(res, function(k,v){
						arrCat.push(v.category_name);
					});

					for (let i=start; i<finish; i++) {
						showHideRow(i, true);
						let row = myTable.row(i).data().toString();
						let arrRow = row.split(',');

						if(arrCat.includes(arrRow[2])){
							myTable.cell(i, 7).data(arrValue[1]);
						} else {
							myTable.cell(i, 7).data('');
							showHideRow(i, false);
						}		
					}
				}
			});

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
								`<input type="checkbox" id="checkbox_${id}" onchange="ubahArrNego(${id})" />`,
								v.name,
								v.category_name,
								v.specs,
								`<input type="text" class="form-control" id="harga_satuan_${id}" name="harga_satuan[]" onchange="setHargaTotal(${id},${v.total_unit})" required>`,
								v.total_unit,
								'',
								v.vendor_id,
								`<textarea rows="3" class="form-control" id="keterangan_${id}" name="keterangan[]"  value="" required> </textarea>`,
								`<textarea rows="3" class="form-control" id="evaluasi_${id}" name="evaluasi[]" value="" required> </textarea>`,
								`<textarea rows="3" class="form-control" id="nilai_${id}" name="nilai[]" value="" required> </textarea>`
							]).node().id = `baris${id}`;
							myTable.draw(false);
							jumlahItem++;
						});
					}
				});
			}
			
		});

		$('#setTotal').on('click', function(){
			let arr = this.value.split(',');
			myTable.cell(arr[0],6).data(arr[1]);
		});

		$('#save').on('click', function(){
			$('#otherField').append(`<input type="hidden" name="arrNego" value="${arrNego}" />`);
			$('#storeData').submit();
		});

		$('#loadBapp').on('click', function(){
			$.ajax({
				type: "GET",
				url: window.location.href + "/getProcurementComponent/" + $('#opsiProcurement').val(),
				success: function(res) {
					$('input[name=nomor_memo_bapp]').prop('value', res.procurement.no_memo);
					$('input[name=perihal]').prop('value', res.procurement.name);
					$('input[name=location]').prop('value', res.bapp.location);
					$('input[name=no_surat_bapp]').prop('value', res.bapp.no_surat);
					$('input[name=tanggal_bapp]').prop('value', res.bapp.date.slice(0,10));
					$('input[name=lokasi]').prop('value', res.bapp.location);

					if (res.procurement.spph_sending_date != null) {
						$('input[name=tanggal_kirim_spph]').prop('value', res.procurement.spph_sending_date.slice(0,10));
					}
					
					$.each(res.penawaran, function(k,v){

						if (v.minimum){
							tableBapp.row.add([
								`<div style="font-weight: bold"> ${v.item.name} </div>`,
								`<div style="font-weight: bold"> ${v.item.category.name} </div>`,
								`<div style="font-weight: bold"> ${v.item.specs} </div>`,
								`<div style="font-weight: bold"> ${v.harga_satuan} </div>`,
								`<div style="font-weight: bold"> ${v.item.total_unit} </div>`,
								`<div style="font-weight: bold"> ${v.item.total_unit * v.harga_satuan} </div>`,
								`<div style="font-weight: bold"> ${v.keterangan} </div>`,
								`<div style="font-weight: bold"> ${v.spph.vendor.name} </div>`,
							]).draw(false);
						}
						
						else {
							tableBapp.row.add([
								v.item.name,
								v.item.category.name,
								v.item.specs,
								v.harga_satuan,
								v.item.total_unit,
								v.item.total_unit * v.harga_satuan,
								v.keterangan,
								v.spph.vendor.name,
							]).draw(false);
						}
					});

					$.each(res.spphs_won, function(index, val){
						let isiField = `
						<div class="accordion" id="accordionPO${index}">
						  <div class="card" style="margin: 1.5%">
						    <div class="card-header" id="headingPO${index}">
						      <h2 class="mb-0">
						        <button class="btn text-left" type="button" data-toggle="collapse" data-target="#collapsePO${index}" aria-expanded="true" aria-controls="collapsePO${index}">
						          ${val.vendor.name}
						        </button>
						      </h2>
						    </div>

						    <div id="collapsePO${index}" class="collapse" aria-labelledby="headingPO${index}" data-parent="#accordionPO${index}">
						      <div class="card-body">
						        
						        <div class="row">
								    <div class="col-xl-6">
								        <div class="form-group">
								            <label class="small mb-1">Nomor Memo </label>
								            <input name="po_no_memo[]" value="${res.procurement.no_memo}" disabled class="form-control" type="text"/>
								        </div>

								        <input name="po_job_terms[]" value="Sesuai dengan hasil rapat Negosiasi dan klarifikasi harga" type="hidden"/>
										<input name="po_spph_id[]" value="${val.id}" hidden type="text" />

								        <div class="form-group">
								            <label class="small mb-1">Perihal </label>
								            <input name="po_perihal[]" value="${res.procurement.name}" disabled class="form-control" type="text"/>
								        </div>
								        <div class="form-group">
								            <label class="small mb-1">No SPMP </label>
								            <input name="po_no_spmp[]" id="po_no_spmp${index}" value="${val.po.no_spmp}" class="form-control" type="text" onchange="setSpmpBast(${index})" />
								        </div>
								    </div>
								    <div class="col-xl-6">
								        <div class="form-group">
								            <label class="small mb-1">Tanggal </label>
								            <input name="po_date[]" id="po_date${index}" class="form-control" value="${val.po.date.slice(0,10)}" type="date"/>
								        </div>
								        <div class="form-group">
								            <label class="small mb-1">Disetujui Oleh </label>
								            <select class="form-control select2" name="po_approved_by[]" id="po_approved_by${index}">
								                @foreach($users as $user)
								                <option value="{{$user->id}}">{{$user->name}} - {{$user->jabatan_caption}}</option>
								                @endforeach
								            </select>
								        </div>
								        <div class="form-group">
											<div class="row">
												<div class="col-md-10">
													<label class="small mb-1">Dokumen Pendukung</label>
								            		<input name="po_dok_pendukung[]" id="po_dok_pendukung${index}" class="form-control" type="file"/>
												</div>
												<div class="col-md-2">
													<label class="small mb-1">PPN </label>
								            		<input name="po_ppn[]" id="po_ppn${index}" style="width:20px" checked value="1" class="form-control" type="checkbox"/>
												</div>
											</div>
								        </div>
								    </div>
								</div>
								<div class="row">
								    <div class="col-xl-12">
								        <div class="form-group">
								            <label class="small mb-1">Ketentuan Pekerjaan </label><label class="small mb-1" style="color:red">*</label>
								            <textarea id="ket_kerja${index}" name="po_ketentuan_pekerjaan[]" id="po_ketentuan_pekerjaan${index}" rows="4" class="form-control"> ${val.po.ketentuan_pekerjaan} </textarea>
								        </div>
								        <div class="form-group">
								            <label class="small mb-1">Ketentuan Pembayaran </label><label class="small mb-1" style="color:red">*</label>
								            <textarea id="ket_bayar${index}" name="po_ketentuan_pembayaran[]" id="po_ketentuan_pembayaran${index}" rows="4" class="form-control"> ${val.po.ketentuan_pembayaran} </textarea>
								        </div>
								    </div>
								</div>

						      </div>
						    </div>
						  </div>
						</div>
						`;

						$('#fieldPO').append(isiField);
						ClassicEditor.create(document.querySelector(`#ket_kerja${index}`));
						ClassicEditor.create(document.querySelector(`#ket_bayar${index}`));

						let bastTag = `
						<div class="accordion" id="accordionBAST${index}">
						    <div class="card" style="margin: 1.5%">
						        <div class="card-header" id="headingBAST${index}">
						            <h2 class="mb-0">
						                <button class="btn text-left" type="button" data-toggle="collapse" data-target="#collapseBAST${index}" aria-expanded="true" aria-controls="collapseBAST${index}">
						                    ${val.vendor.name}
						                </button>
						            </h2>
						        </div>

						        <div id="collapseBAST${index}" class="collapse" aria-labelledby="headingBAST${index}" data-parent="#accordionBAST${index}">
						            <div class="card-body">
						                <div class="row">
						                    <div class="col-xl-6">
						                        <div class="form-group">
						                            <label class="small mb-1">Nama Vendor </label>
						                            <input disabled value="${val.vendor.name}" required class="form-control" type="text"/>
						                        </div>
						                        <div class="form-group">
						                            <label class="small mb-1">Perihal </label>
						                            <input disabled value="${res.procurement.name}" required class="form-control" type="text"/>
						                        </div>
						                        <div class="form-group">
						                            <label class="small mb-1">No Surat </label>
						                            <input name="bast_no_surat[]" value="${val.bast.no_surat}" required class="form-control" type="text"/>
						                        </div>
						                        <div class="form-group">
						                            <label class="small mb-1">Pihak Pertama </label>
													<button id="setSelectName${index}" onClick="setSelectName(${index}, ${val.bast.user_id})" hidden></button>
						                            <select class="form-control select2" id="pihakPertama${index}" name="bast_user_id[]" style="width:100%">
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
						                            <label class="small mb-1">Nomor SPMP </label>
						                            <input disabled value="${val.po.no_spmp}" id="bastSpmp${index}" required class="form-control" type="text"/>
						                        </div>
						                        <div class="form-group">
						                            <label class="small mb-1">Nama Pihak Kedua </label>
						                            <input name="bast_nama_pihak_kedua[]" value="${val.bast.nama_pihak_kedua}" required class="form-control" type="text"/>
						                        </div>
						                        <div class="form-group">
						                            <label class="small mb-1">Jabatan Pihak Kedua</label>
						                            <input name="bast_jabatan_pihak_kedua[]" value="${val.bast.jabatan_pihak_kedua}" required class="form-control" type="text"/>
						                        </div>
						                        <div class="form-group">
						                            <label class="small mb-1">Upload Dokumen&nbsp;</label>
						                            <input name="bast_file[]" required class="form-control" type="file"/>
						                        </div>
						                    </div>
						                </div>
						            </div>
						        </div>
						    </div>
						</div>`;
				
						$('#fieldBAST').append(bastTag);
						$(`#setSelectName${index}`).click();
					});
				}
			});

			$.ajax({
				type: "GET",
				url: window.location.href + "/getVendor/" + $('#opsiProcurement').val(),
				success: function (res) {
					$.each(res, function (key, value){
						let komentar = ((value.comment == null) ? "-" : value.comment);
						tablePV.row.add([
							value.name,
							value.no,
							`<div class="form-inline">
								<div class="form-group">
									<label> <div id="indikatorPV${key+1}"> (${value.score}/5) </div> </label>
									<input type="range" id="pv_score${key+1}" onchange="showIndikatorPV(${key+1})" class="mt-1 custom-range" min="0" max="5" step="1" name="pv_score[]" value="${value.score}">
								</div>
							</div>`,
							`<textarea name="pv_comment[]" class="form-control" rows="2"> ${komentar} </textarea>`,
						]).node().id = `barisPV${key+1}`;
						tablePV.draw(false);
					})
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

	function showHideRow (id, status) {
		if (status) {
			$(`#baris${id}`).show();
		} else {
			$(`#baris${id}`).hide();
		}
	}

	function setSelectName(id, userId) {
		$(`#pihakPertama${id}`).val(userId);
	}

	function setSpmpBast (id) {
		var value = $(`#po_no_spmp${id}`).val();
		$(`#bastSpmp${id}`).prop('value', value);
	}

	function showIndikatorPV (id) {
		var value = $(`#pv_score${id}`).val();
		$(`#indikatorPV${id}`).html(`(${value}/5)`);
	}
	

</script>