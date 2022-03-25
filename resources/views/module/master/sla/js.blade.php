<script type="text/javascript">

    $(document).ready(function() {
        $('#dataTable').DataTable( {
            "ordering": false
        } );
    } );

    $(document).ready(function() {
        /**
         * for showing edit item popup
         */

        $(document).on('click', "#edit-item", function() {
            $(this).addClass('edit-item-trigger-clicked'); //useful for identifying which trigger was clicked and consequently grab data from the correct row and not the wrong one.

            var options = {
            'backdrop': 'static'
            };
            $('#edit-modal').modal(options)
        })

        // on modal show
        $('#edit-modal').on('show.bs.modal', function() {
            var el = $(".edit-item-trigger-clicked"); // See how its usefull right here? 
            var row = el.closest(".data-row");

            // get the data
            var id = el.data('item-id');
            var time = row.children(".time").text();
            var process = row.children(".process").text();

            // fill the data in the input fields
            $("#modal-input-id").val(id);
            $("#modal-input-time").val(time);
            $("#modal-input-process").val(process);
        })

        // on modal hide
        $('#edit-modal').on('hide.bs.modal', function() {
            $('.edit-item-trigger-clicked').removeClass('edit-item-trigger-clicked')
            $("#edit-form").trigger("reset");
        })
    })

</script>