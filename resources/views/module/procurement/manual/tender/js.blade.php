<script type="text/javascript">
	
	$(document).ready(function(){
		
	});

	$(function(){

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

		$('#opsiProcurement').on('change', function(){
			if (tablePoBast.rows().count() < 1) {
				$('#addRow').click();
			}
		});

		$('#addRow').on('click', function (){

			tablePoBast.row.add([
				'<input type="text" name="vendors[]" class="form-control">',
				`<input type="file" class="form-control-file" accept="application/pdf" name="bapp_pdf[]">`,
				`<input type="file" class="form-control-file" accept="application/pdf" id="file_po" name="po_pdf[]">`,
				`<input type="file" class="form-control-file" accept="application/pdf" id="file_bast" name="bast_pdf[]">`,
				`<input type="text" class="form-control" name="nilaiPO[]">`,
				`-`,
			]);
			tablePoBast.draw(false);

		});

		$('#tablePoBast tbody').on('click', 'a', function(){
			let index = $(this).parents('tr').index();
			tablePoBast.row(index).remove().draw(false);
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
					tablePoBast.rows().nodes().page.len(-1).draw();
					$('#storeData').submit();
				}
			});
		});

	});

	function setChecked() {
		$('#setChecked').click();
	}


</script>