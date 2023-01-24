<script type="text/javascript">
	$(function(){
		$('#save').on('click', function(){
			Swal.fire({
				title: 'Konfirmasi',
				text: 'Dokumen-dokumen tersebut akan disimpan pada pengadaan, apakah akan dilanjutkan?',
				showCancelButton: true,
				confirmButtonText: 'Ya',
				cancelButtonText: 'Tidak',
			}).then((result) => {
				if (result.value) {
					$('#storeData').submit();
				}
			});
		});

		$('#file_pjumk').on('input', function(){
			$('#file_invoice').prop('disabled', false);
		});
	});
</script>