<script type="text/javascript">
	
	$(document).ready(function() {
		$('#sp3').hide();
		$('#bast').hide();
		$('#pjUmk').hide();
	});

	$(function(){

		var tableApproval = $('#tableApproval').DataTable({
			"searching" : false,
			"scrollX": true,
			"paging": false,
			"lengthChange": false,
			"ordering": false,
		});


		$('#opsiProcurement').on('change', function(){

			$('#sp3').show();
			$('#bast').show();
			$('#pjUmk').show();

			$('#sp3 input').val('');
			$('#bast input').val('');
			$('#pjUmk input').val('');

			tableApproval.clear();

			$.ajax({

				type: "GET",
				url: window.location.href + "/getProcurementUmk/" + $('#opsiProcurement').val(),
				success: function(res) {

					let sumItem = 0;
					let arrItemId = [];

					$.each(res.items, function(k,v){
						tableApproval.row.add([
							`<input type="hidden" name="item_id[]" value="${v.id}" class="form-control" id="item_id${k}" />
							<input type="text" name="nama_barang[]" value="${v.name}" class="form-control" id="nama_barang${k}">`,
							`<select name="category_id[]" id="opsiKategori${k}" onchange="changeVendorOption(${k})" class="form-control"> 
							@foreach($itemCategory as $ic)
							<option value="{{ $ic->id }}"> {{ $ic->name }} </option>
							@endforeach
							</select>`,
							`<input type="text" name="harga[]" value="${v.price_est}" class="form-control" id="harga${k}" onchange="setHargaTotal(${k})">`,
							`<input type="text" name="total_unit[]" value="${v.total_unit}" class="form-control" id="total_unit${k}" onchange="setHargaTotal(${k})">`,
							`
							<button type="button" class="btn btn-light btn-sm" data-toggle="modal" data-target="#modalSpesifikasi">
							  Edit spesifikasi
							</button>


							<div class="modal fade" id="modalSpesifikasi" tabindex="-1" role="dialog" aria-labelledby="modalSpesifikasiTitle" aria-hidden="true">
							  <div class="modal-dialog" role="document">
							    <div class="modal-content">
							      <div class="modal-header">
							        <h5 class="modal-title" id="modalSpesifikasiTitle">Edit spesifikasi</h5>
							        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
							          <span aria-hidden="true">&times;</span>
							        </button>
							      </div>
							      <div class="modal-body">
							        <textarea name="specs[]" class="form-control" rows="6" id="specs${k}"> ${v.specs} </textarea>
							      </div>
							    </div>
							  </div>
							</div>

							`,
							`<input type="file" name="brosur[]" class="form-control not-required" id="brosur${k}">`,
							`<input type="text" id="harga_total${k}" class="form-control" name="harga_total[]" disabled value="${v.price_total}" />`,
							`<select name="vendor_id[]" id="vendor_id${k}" class="form-control"> </select>`,
							`<button type="button" class="btn btn-danger btn-sm mr-2" onclick="deleteItem(this, ${v.id})" > Hapus </button>`
							]);
						tableApproval.draw(false);

						arrItemId.push(v.id);
						sumItem++;

						$(`#opsiKategori${k}`).val(v.category_id);

						$(`#opsiKategori${k}`).select2();
						$(`#opsiKategori${k}`).next().children().children().css('height', '2.95em').css('padding-top', '0.25em');

						$(`#vendor_id${k}`).select2();
						$(`#vendor_id${k}`).next().children().children().css('height', '2.95em').css('padding-top', '0.25em');
					});

					for (let i=0; i<sumItem; i++) {
						$(`#vendor_id${i}`).append(`<option disabled selected> Pilih Vendor </option>`);
						$.each(res.vendors, function(k,v){
							$(`#vendor_id${i}`).append(`<option value="${v.id}"> ${v.name} </option>`);
						});
					}

					$.each(res.umkItem, function(k,v){

						let index = arrItemId.indexOf(v.item_id);
						$(`#vendor_id${index}`).val(v.vendor_id).trigger('change');

					});

					$('#no_memo').val(res.procurement.no_memo);
					$('#perihal').val(res.procurement.name);
				}
			});


			$.ajax({
				type: "GET",
				url: window.location.href + "/loadDataUmk/" + $('#opsiProcurement').val(),
				success: function (res) {

					for (const [key, value] of Object.entries(res)) {
						$(`input[name=${key}]`).val(value);
					}
				}
			});

		});

		$('#save').on('click', function(){

			$('input:not(:disabled)').css("background-color", "white");
			$('select').css("background-color", "white");
			$('textarea').css("background-color", "white");
			let isEmpty = false;
			let emptyCol = 0;

			let listVendor = $("[id ^= 'vendor_id']").length;
			for (let k=0; k<listVendor; k++) {
				if ($(`#vendor_id${k}`).val() == null) {
					$(`#vendor_id${k}`).next().children().children().css({"background-color" : "#F67280"});
					isEmpty = true;
					emptyCol++;
				} else {
					$(`#vendor_id${k}`).next().children().children().css({"background-color" : "white"});
				}
			}

			let inputAll = $('input:not(.ck, .ck-hidden, .not-required), textarea');
			inputAll.each(function(){
				if (this.value.toString() == "" || this.value.toString() == " " || this.value.toString() == "Pilih Vendor") {
					isEmpty = true;
					$(`#${this.id}`).css({"background-color" : "#F67280"});
					emptyCol++;
				}
			});


			if (!isEmpty){

				Swal.fire({
					title: 'Konfirmasi',
					text: 'Tindakan berikut akan melanjutkan / menyelesaikan proses penawaran, apakah akan dilanjutkan?',
					showCancelButton: true,
					confirmButtonText: 'Ya',
					cancelButtonText: 'Tidak',
				}).then((result) => {
					if (result.value) {
						$('#submitData').prop('action', "{{ route('manual.umk.store') }}");
						$('#submitData').submit();
					}
				});

			} else {
				Swal.fire({
					icon: 'error',
					title: 'Maaf, ',
					text: `Terdapat ${emptyCol} kolom yang belum diisi`,
				});
			}
		});

	});

	function setHargaTotal (id) {

		let x = $(`#harga${id}`).val();
		let y = $(`#total_unit${id}`).val();

		$(`#harga_total${id}`).prop('value', x*y);
	}

	function changeVendorOption (id) {

		$(`#vendor_id${id}`).html('');

		$.ajax({

			type: "GET",
			url: window.location.href + "/getVendorByCategory/" + $(`#opsiKategori${id}`).val(),

			success: function (res) {

				$.each(res, function(k,v){
					$(`#vendor_id${id}`).append(`<option value="${v.id}"> ${v.name} </option>`);
				});

			}

		});

		$(`#vendor_id${id}`).val('').trigger('change');
	}

	function deleteItem(v, id) {

		Swal.fire({
			title: 'Perhatian',
			text: `Tindakan berikut akan menghapus item dan tidak dapat dikembalikan lagi, apakah akan dilanjutkan?`,
			showCancelButton: true,
			confirmButtonText: 'Ya',
			cancelButtonText: 'Tidak',
		}).then((result) => {
			if (result.value) {
				v.closest('tr').remove();

				$.ajax({
					type: "DELETE",
					headers: {
						'X-CSRF-TOKEN': '{{ csrf_token() }}'
					},
					url: window.location.href + "/deleteItem/" + id,
					success: function(res) {
						console.log(res);
					}
				});
			}
		});
		
	}

</script>