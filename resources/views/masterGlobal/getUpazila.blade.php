<script>
    $(document).ready(function () {
        $('select#DISTRICT_ID').on('change',function(){
            var districtId = $(this).val(); //alert(districtId); exit();
            var option = '<option value="">Select Upazila</option>';
            $.ajax({
                type : "get",
                url  : "supplier-profile/get-upazila/{id}",
                data : {'districtId': districtId},
                success:function (data) {
                    for (var i = 0; i < data.length; i++){
                        option = option + '<option value="'+ data[i].UPAZILA_ID +'">'+ data[i].UPAZILA_NAME+'</option>';
                    }
                    $('.upazila').html(option);
                    $('.upazila').trigger("chosen:updated");
                }
            });
        });
    });
</script>