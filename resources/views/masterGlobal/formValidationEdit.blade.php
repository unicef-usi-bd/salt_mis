<script type="text/javascript">//This script use for error massage validation on modal
    jQuery('.alert-danger').hide();
       $('#err').hide();
    $(".modal-body form").submit(function(e) {
        e.preventDefault(); // stop the standard form submission
        $.ajax({
            url: this.action,
            type: this.method,
            data: $(this).serialize(),
            success: function(data) {
            if(data.errors){
                jQuery('.alert-danger').html('');
                jQuery.each(data.errors, function(key, value){
                            jQuery('.alert-danger').show();
                            jQuery('.alert-danger').delaunay(3000).append('<li style="list-style-type:none;">'+value+'</li>').fadeOut('very slow');
                        });
                    }
                    else
                    {
                        jQuery('.alert-success').hide();
                        $('#open').hide();
                        $('#myModal').modal('hide');
                        window.location.reload();
                    }
            }

        });

    });
</script>