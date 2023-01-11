<script type="text/javascript">
	
	$(document).ready(function(){

	});

	$(function(){

		var tableDocVendor = $('#tableDocVendor').DataTable({
			'columnDefs' : [{
				'targets' : [0,1],
				'orderalbe': false,
			}],
			"searching" : false,
			"ordering": false,
		});


		var tablePoBast = $('#tablePoBast').DataTable({
			'columnDefs' : [
				{
                	'targets': -1,
	                'data': null,
	                'defaultContent': '<a style="color:white" class="btn btn-sm btn-danger"> Hapus </button>',
            	},
			],
			"searching" : false,
			"ordering": false,
		});

		$('#addRow').on('click', function (){

			tableDocVendor.row.add([
				`<input type="checkbox" class="chbx" onchange="setChecked()">`,
				`<input type="text" name="vendors[]" class="form-control">`,
				`<input type="file" class="form-control-file" name="spph_pdf[]">`,
				`<input type="file" class="form-control-file" name="penawaran_pdf[]">`,
				`<input type="file" class="form-control-file" id="file_ban" name="ba_negosiasi_pdf[]">`,
				]);
			tableDocVendor.draw(false);

			tablePoBast.row.add([
				'-',
				`<input type="text" class="form-control" name="nilaiPO[]">`,
				`<input type="file" class="form-control-file" id="file_po" name="po_pdf[]">`,
				`<input type="file" class="form-control-file" id="file_bast" name="bast_pdf[]">`,
				`-`,
			]);
			tablePoBast.draw(false);

		});

		$('#tablePoBast tbody').on('click', 'a', function(){
			let index = $(this).parents('tr').index();
			$('#tablePoBast tr').eq(index+1).children().children('input').val('');
			$(this).parents('tr').css('background-color', 'red').hide();
		});

		$('#tableDocVendor tbody').on('input', 'input[type=text]', function(){
			let index = $(this).parents('tr').index();
			tablePoBast.cell(index, 0).data(this.value);
		});

		$('#selectDeselectAll').on('change', function(){
			let allPages = tableDocVendor.rows().nodes();
			$(allPages).find('input[type=checkbox]').prop('checked', $('#selectDeselectAll').is(':checked'));
		});

		$('#deleteRow').on('click', function(){

			let i = 0;
			let arrCheck = [];

			$('.chbx').each(function(){
				if (this.checked) {
					arrCheck.push(i);
				}
				i++;
			});

			if (arrCheck.length == 0) {
				alert('Pilih checkbox');
			}

			arrCheck.sort();
			arrCheck.reverse();

			arrCheck.forEach(function(k){
				tableDocVendor.row(k).remove().draw(false);
				tablePoBast.row(k).remove().draw(false);
			});

			$('#selectDeselectAll').prop('checked', false);

		});

		$('#setChecked').on('click', function(){
			let allPages = tableDocVendor.rows().nodes();

			if (allPages.length == $(allPages).find('.chbx:checked').length) {
				$('#selectDeselectAll').prop('checked', true);
			} else {
				$('#selectDeselectAll').prop('checked', false);
			}
		});

		$('#save').on('click', function(){
			Swal.fire({
				title: 'Konfirmasi',
				text: 'Dokumen-dokumen tersebut akan disimpan pada pengadaan, apakah akan dilanjutkan?',
				showCancelButton: true,
				confirmButtonText: 'Ya',
				cancelButtonText: 'Tidak',
			}).then((result) => {
				if (result.value) {
					tableDocVendor.rows().nodes().page.len(-1).draw();
					tablePoBast.rows().nodes().page.len(-1).draw();

					$('#otherField').html(`<input type="hidden" name="vendor_po" value="${tablePoBast.rows().column(0).data().toArray()}" >`)
					$('#storeData').submit();
				}
			});
		});

	});

	function setChecked() {
		$('#setChecked').click();
	}


</script>