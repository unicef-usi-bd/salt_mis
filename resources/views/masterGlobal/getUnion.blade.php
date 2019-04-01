<script>
    $(document).ready(function () {
        $('#UPAZILA_ID').on('change',function(){
            var upazilaId = $(this).val(); //alert(upazilaId);exit();
            var option = '<option value="">Select Union</option>';
            $.ajax({
                type : "get",
                url  : "supplier-profile/get-union/{id}",
                data : {'upazilaId': upazilaId},
                success:function (data) {
                    for (var i = 0; i < data.length; i++){
                        option = option + '<option value="'+ data[i].UNION_ID +'">'+ data[i].UNION_NAME+'</option>';
                    }
                    $('.union').html(option);
                    $('.union').trigger("chosen:updated");
                }
            });
        });
    });
</script>