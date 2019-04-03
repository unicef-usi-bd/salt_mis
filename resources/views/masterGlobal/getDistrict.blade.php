<script>
    $(document).ready(function () {
        $('#DIVISION_ID').on('change',function(){
            var divisionId = $(this).val(); //alert(divisionId);exit();
            var option = '<option value="">Select District</option>';
            $.ajax({
                type : "get",
                url  : "supplier-profile/get-district/{id}",
                data : {'divisionId': divisionId},
                success:function (data) {
                    for (var i = 0; i < data.length; i++){
                        option = option + '<option value="'+ data[i].DISTRICT_ID +'">'+ data[i].DISTRICT_NAME+'</option>';
                    }
                    $('.district').html(option);
                    $('.district').trigger("chosen:updated");
                }
            });
        });
    });
</script>