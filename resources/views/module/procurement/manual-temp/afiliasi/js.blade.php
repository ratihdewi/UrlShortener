<script type="text/javascript">

	$(document).ready(function() {
        $('#opsiVendor').prop('disabled', true);
		$('#opsiVendor').append('<option disabled selected> Pilih Vendor </option>');
		$('#tambahDokumen').hide();
		$('#spph-negosiasi').hide();
		$('#bapp').hide();
		$('#hapusDokumen').hide(); 
    });

	let tempUrl = window.location.href.split('/afiliasi');
	const url = tempUrl[0];
	var vendorSelect = [];
	var arrNego = [];
	var jumlahItem = 0;
	var currOpt = 0;

	const subSpph = $('#spph-negosiasi').clone();
	const subBapp = $('#bapp').clone();

	$(function(){
		
	
		var jumlahVendor = 0;
		
		var myTable = $('#tabelItem').DataTable({
			"searching" : false,
			"scrollX": true,
			"paging": false,
			"lengthChange": false,
			"ordering": false,
			"bInfo" : false,
		});

		var tableBapp = $('#tableBappVendor').DataTable({
			"searching" : false,
			"paging": false,
			"lengthChange": false,
			"ordering": false,
			"bInfo" : false,
		});

		var tablePV = $('#tablePV').DataTable({
			"searching" : false,
			"paging": false,
			"lengthChange": false,
			"ordering": false,
			"bInfo" : false,
		});

		$('#opsiProcurement').on('change', function() {

			vendorSelect = [];
			myTable.clear();
			tableBapp.clear();
			tablePV.clear();
			jumlahVendor = 0;
			vendorSelect = [];
			arrNego = [];
			jumlahItem = 0;
			currOpt = 0;

			$('#storeData').prop('action', '');

			$.ajax({
				type: "GET",
				url: url + "/tender" + "/getProcurement/" + this.value,
				success: function(res) {

					if(parseInt(res.status) >= 5) {
						$('#spph-negosiasi').hide();
						$('#bapp').show();
						$('#fieldPO').html('');
						$('#fieldBAST').html('');
						$('#fieldBA-Negosiasi').html('');
						$('#fieldSP3').show();
						
						tablePV.clear();

						$('#loadBapp').click();
						$('#tambahDokumen').hide();

					} else {
						$('#spph-negosiasi').show();
						$('#bapp').hide();

						$('#fieldSpph').html('');
						$('#fieldSP3').hide();
						$('#fieldBA-Negosiasi').html('');

						myTable.clear();

						$('#tambahDokumen').show();
						$('#tambahDokumen').click();
						$('#tambahDokumen').hide();
					}
				}
			});
		});

		$('#tambahDokumen').on('click', function() {

			var logHtml = '<span id="partSpph'+vendorSelect.length+'"> <div class="form-row"> <div class="col"> <label> No.SPPH </label> <label class="small mb-1" style="color:red">*</label>  <input type="text" id="nomorSpph_'+vendorSelect.length+'" class="form-control" name="no_spph[]" required> </div> <div class="col"> <label> Nama Vendor </label> <label class="small mb-1" style="color:red">*</label>  <select name="name_vendor[]" class="form-control" class="temp" id="opsiVendor_'+vendorSelect.length+'" onchange="ubahVendor('+vendorSelect.length+')"></select> </div> </div> <div class="form-group mt-3 mb-3"> <a href="" id="linkSpph_'+vendorSelect.length+'"> Unduh Dokumen SPPH </a> </div>  <div class="form-row mb-5"><div class="col"><label> Update File SPPH (.pdf) </label> <label class="small mb-1" style="color:red">*</label> <input type="file" class="form-control" name="spph_pdf[]" id="spph_pdf_'+vendorSelect.length+'" required></div><div class="col"><label> Unggah File Penawaran Harga (.pdf) </label> <label class="small mb-1" style="color:red">*</label> <input type="file" class="form-control" name="penawaran_pdf[]" id="penawaran_pdf_'+vendorSelect.length+'" required></div></div> </span>';

			var collapse = `<div class="accordion" id="accordionBA${vendorSelect.length}">
				<div class="card" style="margin: 1.5%">
					<div class="card-header" id="headingBA${vendorSelect.length}">
						<h2 class="mb-0">
							<button class="btn text-left" type="button" data-toggle="collapse" data-target="#collapseBA${vendorSelect.length}" aria-expanded="true" aria-controls="collapseBA${vendorSelect.length}">
								<div id="headerBA${vendorSelect.length}"> -- </div>
							</button>
						</h2>
					</div>
					<div id="collapseBA${vendorSelect.length}" class="collapse" aria-labelledby="headingBA${vendorSelect.length}" data-parent="#accordionBA${vendorSelect.length}">
						<div class="card-body" style="border: none !important">
							<span class="form-row mb-2">
								<div class="col">
									<label class="small">Hari/Tanggal </label> <label class="small mb-1" style="color:red">*</label> 
									<input name="date[]" id="date${vendorSelect.length}" class="form-control" required="true" type="date"/>
								</div>
								<div class="col">
									<label class="small">Waktu </label> <label class="small mb-1" style="color:red">*</label> 
									<input name="time[]" id="time${vendorSelect.length}" class="form-control" required="true" type="time"/>
								</div>
							</span>

							<span class="form-row mb-2 mt-3">
								<div class="col">
									<label class="small"> Tempat </label> <label class="small mb-1" style="color:red">*</label> 
									<input name="location[]" id="location${vendorSelect.length}" class="form-control" required="true" type="text"/>
								</div>
								<div class="col">
									<label class="small">Peserta Rapat Eksternal <i> Pisahkan dengan tanda koma "," </i> </label> <label class="small mb-1" style="color:red">*</label> 
									<input name="peserta_eksternal[]" id="peserta_eksternal_${vendorSelect.length}" class="form-control" required="true" type="text"/>
								</div>
							</span>

							<div class="form-row mb-2 mt-3">
								<div class="col-xl-12">
									<div class="form-group">
										<label class="small">Peserta Rapat Internal</label> <label class="small mb-1" style="color:red">*</label> 
										<select id="pesertaInternal${vendorSelect.length}" class="form-control" name="peserta_id[${vendorSelect.length}][]" style="width:100%" multiple>
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
										<textarea name="meeting_result[]" id="meeting_result_${vendorSelect.length}" rows="4" class="form-control{{ $errors->has('meeting_result') ? ' is-invalid' : '' }}">{{ old('meeting_result') }}</textarea>
									</div>
								</div>
							</div>

							<div class="form-row mb-2 mt-3">
							<div class="col">
									<div class="form-group">
										<label class="small mb-1">Upload Dokumentasi Meeting (.jpg | .png) </label> <label class="small mb-1" style="color:red">*</label> 
										<input name="photo_doc[]" id="photo_doc_${vendorSelect.length}" required class="form-control" type="file"/>
									</div>
								</div>
								<div class="col">
									<div class="form-group">
										<label class="small mb-1">Negosiasi </label> <label class="small mb-1" style="color:red">*</label> (Rp)
										<input name="negosiasi[]" id="negosiasi${vendorSelect.length}" required="true" class="form-control" type="text"/>
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
			$(`#pesertaInternal${vendorSelect.length}`).select2();
			$(`#pesertaInternal${vendorSelect.length}`).next().children().children().css('height', '2.95em').css('padding-top', '0.25em');

			$(`#opsiVendor_${vendorSelect.length}`).select2();
			$(`#opsiVendor_${vendorSelect.length}`).next().children().children().css('height', '2.95em').css('padding-top', '0.25em');
			generateOption(vendorSelect.length);

			jumlahVendor++;
			$('#tambahDokumen').hide();
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
				url: url + "/tender" + "/getVendorCategory/" + arrValue[0],
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
					url: url + "/tender" + "/getPenawaran/" + this.value,
					success: function(res) {
						$.each(res, function(k,v){   
							let id = counter*vendorSelect.length+k;
							arrNego[id] = -1;
							myTable.row.add([
								`<input type="checkbox" id="checkbox_${id}" onchange="ubahArrNego(${id})" />`,
								v.name,
								v.category_name,
							    `
							    <button type="button" class="btn btn-light btn-sm" data-toggle="modal" data-target="#modalSpesifikasi${id}">
								  Lihat spesifikasi
								</button>
							    <div class="modal fade" id="modalSpesifikasi${id}" tabindex="-1" role="dialog" aria-labelledby="modalSpesifikasiTitle${id}" aria-hidden="true">
								  <div class="modal-dialog" role="document">
								    <div class="modal-content">
								      <div class="modal-header">
								        <h5 class="modal-title" id="modalSpesifikasiTitle${id}">Spesifikasi ${v.name}</h5>
								        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
								          <span aria-hidden="true">&times;</span>
								        </button>
								      </div>
								      <div class="modal-body">
								       <div style="margin: 1%">
								       ${v.specs}
								       </div>
								      </div>
								    </div>
								  </div>
								</div>`,
								`<input type="text" class="form-control" id="harga_satuan_${id}" name="harga_satuan[]" onchange="setHargaTotal(${id},${v.total_unit})" onkeypress="return validateNumber(event)" required>`,
								v.total_unit,
								'',
								v.vendor_id,
								`<textarea rows="3" class="form-control inputDataPenawaran" id="keterangan_${id}" name="keterangan[]"  value="" required> </textarea>`,
								`<textarea rows="3" class="form-control inputDataPenawaran" id="evaluasi_${id}" name="evaluasi[]" value="" required> </textarea>`,
								`<textarea rows="3" class="form-control inputDataPenawaran" id="nilai_${id}" name="nilai[]" value="" required> </textarea>`
							]).node().id = `baris${id}`;
							myTable.draw(false);
							jumlahItem++;
						});
						$('.hargaSatuan').css('width', '12%').trigger('change');
						$('.inputTextArea').css('width', '11%').trigger('change');
					}
				});
			}
			
		});

		$(window).on('resize', function(){
			$('.hargaSatuan').css('width', '12%').trigger('change');
			$('.inputTextArea').css('width', '11%').trigger('change');
		});

		$('#setTotal').on('click', function(){
			let arr = this.value.split(',');
			myTable.cell(arr[0],6).data(arr[1]);
		});

		$('#deleteRowTable').on('click', function() {

			myTable.row(this.value).remove().draw(false);

			arrNego = [];

			let baris = $("[id ^= 'baris']").length;

			for (let i=0; i<baris; i++) {

				$("[id ^= 'baris']").get(i).id = `baris${i}`;

				$("[id ^= 'checkbox_']").get(i).id = `checkbox_${i}`;
				$("[id ^= 'harga_satuan_']").get(i).id = `harga_satuan_${i}`;
				$("[id ^= 'keterangan_']").get(i).id = `keterangan_${i}`;
				$("[id ^= 'evaluasi_']").get(i).id = `evaluasi_${i}`;
				$("[id ^= 'nilai_']").get(i).id = `nilai_${i}`;

				let qty = $(`#baris${i}`).children().eq(5).get(0).innerHTML;
				$(`#harga_satuan_${i}`).attr('onchange', `setHargaTotal(${i}, ${qty})`);
				$(`#checkbox_${i}`).attr('onchange', `ubahArrNego(${i})`);

				if ($(`#checkbox_${i}`).is(':checked')) {
					arrNego[i] = i;
				} else {
					arrNego[i] = -1;
				}
				
			}


			let partSpph = $("[id ^= 'partSpph']").length;

			for (let j=0; j<partSpph; j++) {

				$("[id ^= 'partSpph']").get(j).id = `partSpph${j}`;

				$("[id ^= 'nomorSpph_']").get(j).id = `nomorSpph_${j}`;
				$("[id ^= 'linkSpph_']").get(j).id = `linkSpph_${j}`;
				$("[id ^= 'opsiVendor_']").get(j).id = `opsiVendor_${j}`;
				$("[id ^= 'spph_pdf_']").get(j).id = `spph_pdf_${j}`;
				$("[id ^= 'penawaran_pdf_']").get(j).id = `penawaran_pdf_${j}`;
				$(`#opsiVendor_${j}`).attr('onchange', `ubahVendor(${j})`);

				$("[id ^= 'accordionBA']").get(j).id = `accordionBA${j}`;
				$("[id ^= 'date']").get(j).id = `date${j}`;
				$("[id ^= 'time']").get(j).id = `time${j}`;
				$("[id ^= 'location']").get(j).id = `location${j}`;
				$("[id ^= 'peserta_eksternal_']").get(j).id = `peserta_eksternal_${j}`;
				$("[id ^= 'pesertaInternal']").get(j).id = `pesertaInternal${j}`;

				$(`#pesertaInternal${j}`).attr('name', `peserta_id[${j}][]`);

				$("[id ^= 'meeting_result_']").get(j).id = `meeting_result_${j}`;
				$("[id ^= 'photo_doc_']").get(j).id = `photo_doc_${j}`;
				$("[id ^= 'negosiasi']").get(j).id = `negosiasi${j}`;


				$(`#accordionBA${j} button`).attr('data-target', `#collapseBA${j}`);
				$(`#accordionBA${j} button`).attr('aria-controls', `#collapseBA${j}`);

				$("[id ^= 'collapseBA']").get(j).id = `collapseBA${j}`;
				$("[id ^= 'headerBA']").get(j).id = `headerBA${j}`;
				$(`#collapseBA${j}`).attr('aria-labelledby', `headingBA${j}`);
				$(`#collapseBA${j}`).attr('data-parent', `#accordionBA${j}`);
			}

		});

		$('#save').on('click', function(){

			$('#otherField').append(`<input type="hidden" name="arrNego" value="${arrNego}" />`);

			$.ajax({
				type: "GET",
				url: url + "/tender" + "/getProcurement/" + $('#opsiProcurement').val(),
				success: function(res) {

					$('input:not(:disabled)').css("background-color", "white");
					$('textarea').css("background-color", "white");
					$('select').css("background-color", "white");
					let isEmpty = false;
					let emptyCol = 0;

					if(parseInt(res.status) >= 5) {
						$('#storeData').prop('action', "{{ route('manual.storebapp') }}");

						let vendorName = $("[id ^= 'pihakPertama']").length;
						for (let i=0; i<vendorName; i++) {
							if ($(`#pihakPertama${i}`).val() == null) {
								$(`#pihakPertama${i}`).next().children().children().css({"background-color" : "#F67280"});
								isEmpty = true;
								emptyCol++;
							} else {
								$(`#pihakPertama${i}`).next().children().children().css({"background-color" : "white"});
							}
						}


						let inputAll = $('#bapp input:not(.ck, .ck-hidden, .select2-search__field, :disabled), textarea:not(.inputDataPenawaran), select:not(.pihakPertama)');

						inputAll.each(function(){
							if (this.value.toString() == "" || this.value.toString() == " ") {
								isEmpty = true;
								$(`#${this.id}`).css({"background-color" : "#F67280"});
								emptyCol++;
								// console.log(this.id);
							}
						});

					} else {

						$('#storeData').prop('action', "{{ route('manual.store') }}");

						let pesertaInternalName = $("[id ^= 'pesertaInternal']").length;
						for (let l=0; l<pesertaInternalName; l++) {
							if ($(`#pesertaInternal${l}`).val().length < 1) {
								$(`#pesertaInternal${l}`).next().children().children().css({"background-color" : "#F67280"});
								isEmpty = true;
								emptyCol++;
							} else {
								$(`#pesertaInternal${l}`).next().children().children().css({"background-color" : "white"});
							}
						}


						let vendorName = $("[id ^= 'opsiVendor_']").length;
						for (let i=0; i<vendorName; i++) {
							if ($(`#opsiVendor_${i}`).val() == null) {
								$(`#opsiVendor_${i}`).next().children().children().css({"background-color" : "#F67280"});
								isEmpty = true;
								emptyCol++;
							} else {
								$(`#opsiVendor_${i}`).next().children().children().css({"background-color" : "white"});
							}
						}

						let allInput = $('#spph-negosiasi input:not(.ck, .ck-hidden, .select2-search__field), textarea');
						allInput.each(function(){
							if (this.value.toString() == "" || this.value.toString() == " " || this.value.toString() == "Pilih Vendor") {
								isEmpty = true;
								$(`#${this.id}`).css({"background-color" : "#F67280"});
								emptyCol++;
							}
						});
					}

					if (!isEmpty){

						Swal.fire({
						  title: 'Konfirmasi',
						  text: 'Tindakan berikut akan melanjutkan / menyelesaikan proses penawaran, apakah akan dilanjutkan?',
						  showCancelButton: true,
						  confirmButtonText: 'Ya',
						  cancelButtonText: 'Tidak',
						}).then((result) => {
						  if (result.value) {
						    $('#storeData').submit();
						  }
						});
						
					} else {
						Swal.fire({
						  icon: 'error',
						  title: 'Maaf, ',
						  text: `Terdapat ${emptyCol} kolom yang belum diisi`,
						});
					}
				}
			});
			
		});

		$('#loadBapp').on('click', function(){
			$.ajax({
				type: "GET",
				url: url + "/tender" + "/getProcurementComponent/" + $('#opsiProcurement').val(),
				success: function(res) {
					$('input[name=nomor_memo_bapp]').prop('value', res.procurement.no_memo);
					$('input[name=perihal]').prop('value', res.procurement.name);
					$('input[name=location]').prop('value', res.bapp.location);
					$('input[name=no_surat_bapp]').prop('value', res.bapp.no_surat);
					$('input[name=tanggal_bapp]').prop('value', res.bapp.date.slice(0,10));
					$('input[name=lokasi]').prop('value', res.bapp.location);
					$('#dari').val(res.bapp.dari);
					$('#kepada').val(res.bapp.kepada);

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
								            <label class="small mb-1">Nomor Memo </label> <label class="small mb-1" style="color:red">*</label> 
								            <input name="po_no_memo[]" value="${res.procurement.no_memo}" disabled class="form-control" type="text"/>
								        </div>

								        <input name="po_job_terms[]" value="Sesuai dengan hasil rapat Negosiasi dan klarifikasi harga" type="hidden"/>
										<input name="po_spph_id[]" value="${val.id}" hidden type="text" />

								        <div class="form-group">
								            <label class="small mb-1">Perihal </label> <label class="small mb-1" style="color:red">*</label> 
								            <input name="po_perihal[]" value="${res.procurement.name}" disabled class="form-control" type="text"/>
								        </div>
								        <div class="form-group">
								            <label class="small mb-1">No SPMP </label> <label class="small mb-1" style="color:red">*</label> 
								            <input name="po_no_spmp[]" id="po_no_spmp${index}" value="${val.po.no_spmp}" class="form-control" type="text" onchange="setSpmpBast(${index})" />
								        </div>
								    </div>
								    <div class="col-xl-6">
								        <div class="form-group">
								            <label class="small mb-1">Tanggal </label> <label class="small mb-1" style="color:red">*</label> 
								            <input name="po_date[]" id="po_date${index}" class="form-control" value="${val.po.date.slice(0,10)}" type="date"/>
								        </div>
								        <div class="form-group">
								            <label class="small mb-1">Disetujui Oleh </label> <label class="small mb-1" style="color:red">*</label> 
								            <select class="form-control select2" name="po_approved_by[]" id="po_approved_by${index}">
								                @foreach($users as $user)
								                <option value="{{$user->id}}">{{$user->name}} - {{$user->jabatan_caption}}</option>
								                @endforeach
								            </select>
								        </div>
								        <div class="form-group">
											<div class="row">
												<div class="col-md-10">
													<label class="small mb-1">Dokumen Pendukung</label> <label class="small mb-1" style="color:red">*</label> 
								            		<input name="po_dok_pendukung[]" id="po_dok_pendukung${index}" class="form-control" type="file"/>
												</div>
												<div class="col-md-2">
													<label class="small mb-1">PPN </label> <label class="small mb-1" style="color:red">*</label> 
								            		<input name="po_ppn[]" id="po_ppn${index}" style="width:20px" checked value="1" class="form-control" type="checkbox"/>
												</div>
											</div>
								        </div>
								    </div>
								</div>
								<div class="row">
								    <div class="col-xl-12">
								        <div class="form-group">
								            <label class="small mb-1">Ketentuan Pekerjaan </label> <label class="small mb-1" style="color:red">*</label> 
								            <textarea name="po_ketentuan_pekerjaan[]" id="po_ketentuan_pekerjaan${index}" rows="4" class="form-control"> ${val.po.ketentuan_pekerjaan} </textarea>
								        </div>
								        <div class="form-group">
								            <label class="small mb-1">Ketentuan Pembayaran </label> <label class="small mb-1" style="color:red">*</label>
								            <textarea name="po_ketentuan_pembayaran[]" id="po_ketentuan_pembayaran${index}" rows="4" class="form-control"> ${val.po.ketentuan_pembayaran} </textarea>
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
						                            <label class="small mb-1">Nama Vendor </label> <label class="small mb-1" style="color:red">*</label> 
						                            <input disabled value="${val.vendor.name}" id="bast_vn${index}" class="form-control" type="text"/>
						                        </div>
						                        <div class="form-group">
						                            <label class="small mb-1">Perihal </label> <label class="small mb-1" style="color:red">*</label> 
						                            <input disabled value="${res.procurement.name}" id="bast_perihal${index}" class="form-control" type="text"/>
						                        </div>
						                        <div class="form-group">
						                            <label class="small mb-1">No Surat </label> <label class="small mb-1" style="color:red">*</label> 
						                            <input name="bast_no_surat[]" value="${val.bast.no_surat}" id="bast_nosurat${index}" class="form-control" type="text"/>
						                        </div>
						                        <div class="form-group">
						                            <label class="small mb-1">Pihak Pertama </label> <label class="small mb-1" style="color:red">*</label> 
						                            <select class="form-control select2 pihakPertama" id="pihakPertama${index}" name="bast_user_id[]" style="width:100%">
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
						                            <input disabled value="${val.po.no_spmp}" id="bastSpmp${index}" class="form-control" type="text"/>
						                        </div>
						                        <div class="form-group">
						                            <label class="small mb-1">Nama Pihak Kedua </label> <label class="small mb-1" style="color:red">*</label> 
						                            <input name="bast_nama_pihak_kedua[]" value="${val.bast.nama_pihak_kedua}" class="form-control" id="bast_nama_pihak_kedua${index}" type="text"/>
						                        </div>
						                        <div class="form-group">
						                            <label class="small mb-1">Jabatan Pihak Kedua</label> <label class="small mb-1" style="color:red">*</label> 
						                            <input name="bast_jabatan_pihak_kedua[]" value="${val.bast.jabatan_pihak_kedua}" id="bast_jabatan_pihak_kedua${index}" class="form-control" type="text"/>
						                        </div>
						                        <div class="form-group">
						                            <label class="small mb-1">Upload Dokumen&nbsp;</label> <label class="small mb-1" style="color:red">*</label> 
						                            <input name="bast_file[]" id="bast_file${index}" class="form-control" type="file" />
						                        </div>
						                    </div>
						                </div>
						            </div>
						        </div>
						    </div>
						</div>`;
				
						$('#fieldBAST').append(bastTag);
						setSelectName(index, val.bast.user_id);
						$(`#po_approved_by${index}`).val(val.po.approved_by);
						$(`#pihakPertama${index}`).select2();
						$(`#pihakPertama${index}`).next().children().children().css('height', '2.95em').css('padding-top', '0.25em');

						$.ajax({
							type: "GET",
							url: url + "/tender" + "/getSp3/" + $('#opsiProcurement').val(),
							success: function(res) {
								if(typeof res.keterangan !== 'undefined'){
									$('#sp3_keterangan').prop('value', res.keterangan);
								}
							}
						});
					});
				}
			});

			$.ajax({
				type: "GET",
				url: url + "/tender" + "/getVendor/" + $('#opsiProcurement').val(),
				success: function (res) {
					$.each(res, function (key, value){
						let komentar = ((value.comment == null) ? "-" : value.comment);
						tablePV.row.add([
							value.name,
							value.no_spph,
							`
							<input type="hidden" name="pv_spph_id[]" value="${value.spph_id}" />
							<input type="hidden" name="pv_vendor_id[]" value="${value.id}" />
							<input type="range" id="pv_score${key+1}" onchange="showIndikatorPV(${key+1})" class="mt-1 custom-range" min="0" max="5" step="1" name="pv_score[]" value="${value.score}">
							<div class="rateit rateit-bg" data-rateit-backingfld="#pv_score${key+1}" data-rateit-resetable="false"  data-rateit-ispreset="true"> </div>
							<div id="indikatorPV${key+1}"> (${value.score}/5) </div>
							`,
							`<textarea name="pv_comment[]" id="pv_comment${key+1}" class="form-control" rows="2"> ${komentar} </textarea>`,
							`<a style="color: white" class="mt-2 btn btn-sm btn-danger" onclick="javascript:deletePV(${key+1})">
								Hapus 
							</a>`,
						]).node().id = `linePV${key+1}`;
						tablePV.draw(false);
					});
					$(`.rateit`).rateit();
				}
			});
			
		});

	});

	function deletePV(id) {
		$(`#linePV${id}`).remove();
	}

	function ubahVendor(id) {

		var proc_id = $('#opsiProcurement').val();
		var vendor_id = $('#opsiVendor_'+id).val();

		if (vendor_id != null) {

			vendorSelect[id] = vendor_id;
			$('#nomorSpph_'+id).prop('value', '');
			$('#tambahDokumen').show();
			$('#hapusDokumen').show();

			$.ajax({
				type: "GET",
				url: url + "/tender" + "/getSpph/" + proc_id + "/" + vendor_id,
				success: function(res) {
					$('#nomorSpph_'+id).prop('value', res.no_spph);
					$('#linkSpph_'+id).prop('href', "{{ url('/spph-tor/download') }}" + "/" + res.id);
					
					var arr = [vendor_id, res.vendor_name];

					if ($('.item-hapus-vendor').children().get(id) == null) {
						$('.item-hapus-vendor').append(`<a class="dropdown-item" id="itemVendor${id}" style="cursor: pointer" onclick="deleteVendorSel(${id})"> ${res.vendor_name} </a>`);
					} else {
						$(`#itemVendor${id}`).get(0).innerHTML = res.vendor_name;
					}
					

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

	}


	function deleteVendorSel(id) {

		$(`#partSpph${id}`).remove();
		$(`#accordionBA${id}`).remove();

		let name = $(`#itemVendor${id}`).get(0).innerHTML;
		let indexItemStart = id*jumlahItem;
		let indexItemFinish = indexItemStart+jumlahItem-1;


		for (let i=indexItemFinish; i>=indexItemStart; i--) {
			$('#deleteRowTable').prop('value', i);
			$('#deleteRowTable').click();
		}

		$(`#itemVendor${id}`).remove();

		let partItemVendor = $("[id ^= 'itemVendor']").length;
		for (let k=0; k<partItemVendor; k++) {
			$("[id ^= 'itemVendor']").get(k).id = `itemVendor${k}`;
			$(`#itemVendor${k}`).attr('onclick', `deleteVendorSel(${k})`);
		}

		vendorSelect.splice(id, 1);


		if ($('.item-hapus-vendor').children().length == 0) {
			$('#hapusDokumen').hide();
		} else {
			$('#hapusDokumen').show();
		}
	}

	function validateNumber (event) {
		let val = event.keyCode
		if (val>=48 && val<=57) {
			return true;
		} else {
			return false;
		}
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
			url: url + "/tender" + "/getVendor/" + proc_id,
			success: function(res) {
				$('#opsiVendor_'+i).prop('disabled', false);
				currOpt = 0;
				$.each(res, function(key, value){
					if (!vendorSelect.includes(value.id.toString())){
						currOpt++;
						$('#opsiVendor_'+i).append('<option value='+value.id+'>'+ value.name +'</option>');
					}
				});

				$('#opsiVendor_'+i).val('').trigger('change');
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