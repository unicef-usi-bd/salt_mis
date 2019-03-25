<script>

    $(document).on("click", ".clickForDelete", function () {
        var actionUrl = $(this).attr("data-action") ;
        var token = $(this).attr("data-token") ;
        swal({
                title: 'Are you sure ?',
                text: "Please click confirm to delete this",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: true
            },
            function (isConfirm) {
                if (isConfirm) {
                    $.ajax({
                        type: 'delete',
                        data: {
                            "_token": token
                        },
                        url: actionUrl,
                        success: function (data) {
                            var getData = JSON.parse(data);
                            var id = getData.id;
                            var type = getData.type;
                            var message = getData.message;
                            if(getData.flag==true) {
                                swal("Deleted", message, "success");
                                $('.row'+id).closest(type).remove();
                            } else {
                                swal("NOT Deleted!", message, "error");
                            }
                        }
                    });
                } else {
                    swal("Cancelled", "Your imaginary file is safe :)", "error");
                }
            });
    })

</script>