<script type="text/javascript">

    let vendorUrl = window.location.origin + '/procurement/get-vendor/';

    $(document).ready(function() {
        $('#inputManual').hide();
        $('#inputList').hide();
    });

    $('#methodVendor').on('change', function(){

        if(this.value == 1){
            $('#inputManual').hide();
            $('#inputList').show();

            loadVendorOption();
        } else if (this.value == 2) {
            $('#inputManual').show();
            $('#inputList').hide();

            $('#listVendor').html('');
        } else {
            $('#inputManual').show();
            $('#inputList').show();   

            loadVendorOption();         
        }

    });

    $('#category').on('change', function(){
        loadVendorOption();
    });

    function loadVendorOption () {
        $('#listVendor').html('');
        $.ajax({
            type: "GET",
            url: vendorUrl + $('#category').val(),
            success: function (res) {
                $('#listVendor').append('<option disabled selected> -- Pilih Vendor -- </option>');
                $.each(res.vendors, function(k,v){
                    $('#listVendor').append(`<option value="${v.id}"> ${v.name} </option>`);
                });
            }
        });
    }

    $('#btn-hapus-procurement').on('click', function(e){
        e.preventDefault();
        var id = $(this).data('id');
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
                document.getElementById('form-hapus-procurement').submit();
                    
            }
        });
    });

    $('#btn-batal-procurement').on('click', function(e){
        e.preventDefault();
        var id = $(this).data('id');
        swal({
            title: 'Apakah Anda yakin?',
            text: 'Data yang sudah diubah tidak dapat dikembalikan lagi.',
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
                document.getElementById('form-batal-procurement').submit();
                    
            }
        });
    });

    $('#btn-ajukan-procurement').on('click', function(e){
        e.preventDefault();
        var id = $(this).data('id');
        swal({
            title: 'Apakah Anda yakin ingin mengirim pengadaan ini?',
            text: 'Data yang sudah disetujui tidak dapat dikembalikan lagi.',
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
                document.getElementById('form-ajukan-procurement').submit();
                    
            }
        });
    });

    /*$('#category').change(function() {
        id = $(this).val()
        $('#vendor').empty()
        $.ajax({
            url: "{{url('procurement/get-vendor')}}"+"/"+id,
            success: data => {
                data.vendors.forEach(vendor =>
                    $('#vendor').append(`<option value="${vendor.id}">${vendor.name}</option>`)
                )
            }
        })
    })*/

    $("#add").click(function() {
    	var lastField = $("#vendor-form div:last");
        var intId = (lastField && lastField.length && lastField.data("idx") + 1) || 1;
        var fieldWrapper = $("<div class=\"row\" style=\"margin-top:5px\" id=\"field" + intId + "\"/>");
        fieldWrapper.data("idx", intId);
        var fName = $("<input style=\"width:40%;margin-left:10px;margin-right:8px;\" placeholder=\"nama vendor\" type=\"text\" name=\"vendor_name[]\" class=\"form-control\" />");
        var fEmail = $("<input style=\"width:40%;margin-right:15px;\" type=\"email\" placeholder=\"email\" name=\"vendor_email[]\" class=\"form-control\" />");
        var removeButton = $("<input type=\"button\" class=\"btn btn-danger btn-sm remove\" value=\"-\" />");
        removeButton.click(function() {
            $(this).parent().remove();
        });
        fieldWrapper.append(fName);
        fieldWrapper.append(fEmail);
        fieldWrapper.append(removeButton);
        $("#vendor-form").append(fieldWrapper);
        
    });

    $(function(){
      // bind change event to select
      $('#status_select').on('change', function () {
          var url = $(this).val(); // get selected value
          if (url) { // require a URL
              window.location = url; // redirect
          }
          return false;
      });

      $('#select_assign').on('change', function () {
            document.getElementById('form-assign').submit();
      });

      $('#select_assign_type').on('change', function () {
            document.getElementById('form-assign-type').submit();
      });
    });
    
</script>