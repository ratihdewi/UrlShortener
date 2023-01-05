<script type="text/javascript">

	let tempUrl = window.location.href.split('/pl');
	const url = tempUrl[0];
	var arrNego = [];

	$(document).ready(function(){

		$(`#pesertaInternal0`).next().children().children().css('height', '2.95em').css('padding-top', '0.25em');
		$('#spph-negosiasi').hide();
		$('#bapp').hide();
	});

	$(function(){

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

		$('#opsiProcurement').on('change', function(){

			$.ajax({
				type: "GET",
				url: url + "/tender/getProcurement/" + this.value,
				success: function(res) {

					if(parseInt(res.status) >= 5) {
						$('#spph-negosiasi').hide();
						$('#bapp').show();
						$('#fieldSP3').show();
						
						tablePV.clear();
						tableBapp.clear();

						$.ajax({
							type: "GET",
							url:  url + "/tender/getProcurementComponent/" + $('#opsiProcurement').val(),
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

								let spphWon = res.spphs_won[0];
								$('.po_no_memo').val(res.procurement.no_memo);
								$('.po_spph_id').val(spphWon.id);
								$('.po_perihal').val(res.procurement.name);
								$('#po_no_spmp0').val(spphWon.po.no_spmp);
								$('#po_date0').val(spphWon.po.date.slice(0,10));
								$('#po_approved_by0').val(spphWon.po.approved_by);
								$('#ket_kerja0').text(spphWon.po.ketentuan_pekerjaan);
								$('#ket_bayar0').text(spphWon.po.ketentuan_pembayaran);

								ClassicEditor.create(document.querySelector(`#ket_kerja0`));
								ClassicEditor.create(document.querySelector(`#ket_bayar0`));

								$('#bast_vn0').val(spphWon.vendor.name);
								$('#bast_perihal0').val(res.procurement.name);
								$('#bast_nosurat0').val(spphWon.bast.no_surat);
								$('#bast_spmp0').val(spphWon.po.no_spmp);
								$('#bast_nama_pihak_kedua0').val(spphWon.bast.nama_pihak_kedua);
								$('#bast_jabatan_pihak_kedua0').val(spphWon.bast.jabatan_pihak_kedua);

								$('#pihakPertama0').val(spphWon.bast.user_id).trigger('change');
								$(`#pihakPertama0`).next().children().children().css('height', '2.95em').css('padding-top', '0.25em');

								$.ajax({
									type: "GET",
									url: url + "/tender/getSp3/" + $('#opsiProcurement').val(),
									success: function(res) {
										if(typeof res.keterangan !== 'undefined'){
											$('#sp3_keterangan').prop('value', res.keterangan);
										}
									}
								});

							},
						});

						$.ajax({
							type: "GET",
							url: url + "/tender/getVendor/" + $('#opsiProcurement').val(),
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

					} else {
						$('#spph-negosiasi').show();
						$('#bapp').hide();
						$('#fieldSP3').hide();

						myTable.clear();

						$.ajax({
							type: "GET",
							url: url + "/tender/getVendor/" + $('#opsiProcurement').val(),
							success: function(res) {
								$('#opsiVendor_0').html('');
								$('#opsiVendor_0').prop('disabled', false);
								$('#opsiVendor_0').append('<option disabled selected> -- Pilih Vendor -- </option>');
								$.each(res, function(key, value){
									$('#opsiVendor_0').append('<option value='+value.id+'>'+ value.name +'</option>');
								});
							}
						});

						$.ajax({
							type: "GET",
							url: url + "/tender/getPenawaran/" + $('#opsiProcurement').val(),
							success: function(res) {
								let id = 0;
								$.each(res, function(k,v){
									arrNego[id] = -1;
									myTable.row.add([
										`<input type="checkbox" id="checkbox_${id}" onchange="ubahArrNego(${id})" />`,
										v.name,
										v.category_name,
										v.specs,
										`<input type="text" class="form-control" id="harga_satuan_${id}" name="harga_satuan[]" onchange="setHargaTotal(${id},${v.total_unit})" onkeypress="return validateNumber(event)" required>`,
										v.total_unit,
										'',
										v.vendor_id,
										`<textarea rows="3" class="form-control inputDataPenawaran" id="keterangan_${id}" name="keterangan[]"  value="" required> </textarea>`,
										`<textarea rows="3" class="form-control inputDataPenawaran" id="evaluasi_${id}" name="evaluasi[]" value="" required> </textarea>`
										]).node().id = `baris${id}`;
									myTable.draw(false);
									id++;
								});
							}
						});

						$.ajax({
							type: "GET",
							url: url + "/tender/getProcurement/" + $('#opsiProcurement').val(),
							success: function(res) {
								$('#opsiVendor_0').val(res.vendor_id_penunjukan_langsung).trigger('change');
							},
						});
					}
				}
			});

			
		});


		$('#opsiVendor_0').on('change', function(){

			var proc_id = $('#opsiProcurement').val();
			var vendor_id = this.value;

			$.ajax({
				type: "GET",
				url: url + "/tender/getSpph/" + proc_id + "/" + vendor_id,
				success: function(res) {
					$('#nomorSpph_0').prop('value', res.no_spph);
					$('#linkSpph_0').prop('href', "{{ url('/spph-tor/download') }}" + "/" + res.id);
				}
			});

			for (let i=0; i<myTable.rows().count(); i++) {
				myTable.cell(i,7).data(this.options[this.selectedIndex].text);
			}
			
		});

		$('#setTotal').on('click', function(){
			let arr = this.value.split(',');
			myTable.cell(arr[0],6).data(arr[1]);
		});


		$('#save').on('click', function(){

			$('#otherField').append(`<input type="hidden" name="arrNego" value="${arrNego}" />`);

			$.ajax({
				type: "GET",
				url: url + "/tender/getProcurement/" + $('#opsiProcurement').val(),
				success: function(res) {

					$('input:not(:disabled)').css("background-color", "white");
					$('textarea').css("background-color", "white");
					$('select').css("background-color", "white");
					let isEmpty = false;
					let emptyCol = 0;

					if (parseInt(res.status) >= 5) {

						$('#storeData').prop('action', "{{ route('manual.storebapp') }}");

						
						if ($(`#pihakPertama0`).val() == null) {
							$(`#pihakPertama0`).next().children().children().css({"background-color" : "#F67280"});
							isEmpty = true;
							emptyCol++;
						} else {
							$(`#pihakPertama0`).next().children().children().css({"background-color" : "white"});
						}

						let inputAll = $('#bapp input:not(.ck, .ck-hidden, .select2-search__field, :disabled), textarea:not(.inputDataPenawaran), select:not(.pihakPertama)');

						inputAll.each(function(){
							if (this.value.toString() == "" || this.value.toString() == " ") {

								let nodeId = $(`#${this.id}`).parents("nav").get(0).id;
								if (nodeId == 'bapp') {
									isEmpty = true;
									$(`#${this.id}`).css({"background-color" : "#F67280"});
									emptyCol++;
									// console.log(this.id);
								}
							}
						});

					} else {
						$('#storeData').prop('action', "{{ route('manual.store') }}");

						if ($(`#pesertaInternal0`).val().length < 1) {
							$(`#pesertaInternal0`).next().children().children().css({"background-color" : "#F67280"});
							isEmpty = true;
							emptyCol++;
						} else {
							$(`#pesertaInternal0`).next().children().children().css({"background-color" : "white"});
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

	});

	function setHargaTotal(id, qty) {

		var val = $('#harga_satuan_'+id).val();
		var arr = [id, qty*val];

		$('#setTotal').prop('value', arr.toString());
		$('#setTotal').click();
	}

	function validateNumber (event) {
		let val = event.keyCode
		if (val>=48 && val<=57) {
			return true;
		} else {
			return false;
		}
	}

	function ubahArrNego(id) {

		if (arrNego[id] < 0) {
			arrNego[id] = id;
		} else {
			arrNego[id] = -1;
		}

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