<script type="text/javascript">
	
	$(function(){

		var tableApproval = $('#tableApproval').DataTable({
			"searching" : false,
			"paging": false,
			"lengthChange": false,
			"ordering": false,
		});


		$('#opsiProcurement').on('change', function(){

			$.ajax({

				type: "GET",
				url: window.location.href + "/getProcurementUmk/" + $('#opsiProcurement').val(),
				success: function(res) {
					$.each(res.items, function(k,v){
						tableApproval.row.add([
							v.name,
							v.category_id,
							v.price_est,
							v.total_unit,
							v.specs,
							v.brosur_file,
							v.price_total,
							k,
							`<button type="button" class="btn btn-danger btn-sm mr-2"> Hapus </button>`
						]);
						tableApproval.draw(false);
					});
				}
			});

		});

	});

</script>