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
							`<select name="category_id[]" id="opsiKategori${k}" class="form-control select2"> 
							@foreach($itemCategory as $ic)
							<option value="{{ $ic->id }}"> {{ $ic->name }} </option>
							@endforeach
							</select>`,
							`<input type="text" name="harga[]" value="${v.price_est}" class="form-control" id="harga${k}" onchange="setHargaTotal(${k})">`,
							`<input type="text" name="total_unit[]" value="${v.total_unit}" class="form-control" id="total_unit${k}" onchange="setHargaTotal(${k})">`,
							`<input type="text" name="specs[]" value="${v.specs}" class="form-control" id="specs${k}">`,
							`<input type="file" name="brosur[]" class="form-control not-required" id="brosur${k}">`,
							`<input type="text" id="harga_total${k}" class="form-control" name="harga_total[]" disabled value="${v.price_total}" />`,
							`<select name="vendor_id[]" id="vendor_id${k}" class="form-control"> </select>`,
							`<button type="button" class="btn btn-danger btn-sm mr-2"> Hapus </button>`
							]);
						tableApproval.draw(false);

						arrItemId.push(v.id);
						sumItem++;

						$(`#opsiKategori${k}`).val(v.category_id);
					});

					for (let i=0; i<sumItem; i++) {
						$.each(res.vendors, function(k,v){
							$(`#vendor_id${i}`).append(`<option value="${v.id}"> ${v.name} </option>`);
						});
					}

					$.each(res.umkItem, function(k,v){

						let index = arrItemId.indexOf(v.item_id);
						$(`#vendor_id${index}`).val(v.vendor_id);

					});

					$('#no_memo').val(res.procurement.no_memo);
					$('#perihal').val(res.procurement.name);
				}
			});

		});

		$('#save').on('click', function(){

			$('input:not(:disabled)').css("background-color", "white");
			let isEmpty = false;
			let emptyCol = 0;

			let inputAll = $('input:not(.ck, .ck-hidden, .not-required), select');
			inputAll.each(function(){
				if (this.value.toString() == "" || this.value.toString() == " ") {
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

</script>