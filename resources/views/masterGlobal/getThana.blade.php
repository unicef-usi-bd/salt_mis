<script>
    $(document).ready(function () {
        $('select#DISTRICT_ID').on('change',function(){
            var districtId = $(this).val(); //alert(districtId); exit();
            var option = '<option value="">Select Thana</option>';
            $.ajax({
                type : "get",
                url  : "supplier-profile/get-thana/{id}",
                data : {'districtId': districtId},
                success:function (data) {
                    for (var i = 0; i < data.length; i++){
                        option = option + '<option value="'+ data[i].THANA_ID +'">'+ data[i].THANA_NAME+'</option>';
                    }
                    $('.thana').html(option);
                    $('.thana').trigger("chosen:updated");
                }
            });
        });
    });
</script>