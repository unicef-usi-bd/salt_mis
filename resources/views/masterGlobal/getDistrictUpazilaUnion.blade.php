<script>
    $(document).ready(function () {
        $('#ENT_DIVISION_ID').on('change',function(){
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
                    $('.ent_district').html(option);
                    $('.ent_district').trigger("chosen:updated");
                }
            });
        });
    });

    $(document).ready(function () {
        $('select#ENT_DISTRICT_ID').on('change',function(){
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
                    $('.ent_upazila').html(option);
                    $('.ent_upazila').trigger("chosen:updated");
                }
            });
        });
    });

    $(document).ready(function () {
        $('#ENT_UPAZILA_ID').on('change',function(){
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
                    $('.ent_union').html(option);
                    $('.ent_union').trigger("chosen:updated");
                }
            });
        });
    });
</script>