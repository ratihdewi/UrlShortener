<script type="text/javascript">

    $('.btn-hapus').on('click', function(e){
        e.preventDefault();
        let deleteUrl = $(this).attr('href');
        swal({
            title: 'Apakah Anda yakin?',
            text: 'Data yang sudah dihapus tidak dapat dikembalikan lagi.',
            type: 'warning',
            confirmButtonColor: '#d26a5c',
            confirmButtonText: 'Ya!',
            showCancelButton: true,
            cancelButtonText: 'Batal!',
            html: false,
            preConfirm: function() {
                return new Promise(function (resolve) {
                    setTimeout(function () {
                        resolve();
                    }, 50);
                });
            }
        }).then(function(result){
            if (result.value) {
                // form action delete
                let form = document.createElement('form');
                form.setAttribute('method', 'post');
                form.setAttribute('action', deleteUrl);

                let csrfField = document.createElement('input');
                csrfField.setAttribute('type', 'hidden');
                csrfField.setAttribute('name', '_token');
                csrfField.setAttribute('value', '{{ csrf_token() }}');
                form.appendChild(csrfField);

                let methodField = document.createElement('input');
                methodField.setAttribute('type', 'hidden');
                methodField.setAttribute('name', '_method');
                methodField.setAttribute('value', 'DELETE');
                form.appendChild(methodField);

                document.body.appendChild(form);
                form.submit();
                    
            }
        });
    });

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
            var name = row.children(".name").text();

            // fill the data in the input fields
            $("#modal-input-id").val(id);
            $("#modal-input-name").val(name);
        })

        // on modal hide
        $('#edit-modal').on('hide.bs.modal', function() {
            $('.edit-item-trigger-clicked').removeClass('edit-item-trigger-clicked')
            $("#edit-form").trigger("reset");
        })
    })
</script>