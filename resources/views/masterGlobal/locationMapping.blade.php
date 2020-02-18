<script>
//    division to district
    $(document).ready(function () {
        $('#DIVISION_ID').on('change',function(){
            let divisionId = $(this).val();
            let option = '<option value="">Select District</option>';
            $.ajax({
                type : "get",
                url  : "supplier-profile/get-district/{id}",
                data : {'divisionId': divisionId},
                success:function (data) {
                    for (let i = 0; i < data.length; i++){
                        option = option + '<option value="'+ data[i].DISTRICT_ID +'">'+ data[i].DISTRICT_NAME+'</option>';
                    }
                    $('.district').html(option);
                    $('.district').trigger("chosen:updated");
                }
            });
        });
    });

//    District to Upazilla
    $(document).ready(function () {
        $('select#DISTRICT_ID').on('change',function(){
            let districtId = $(this).val(); //alert(districtId); exit();
            let option = '<option value="">Select Upazila</option>';
            $.ajax({
                type : "get",
                url  : "supplier-profile/get-upazila/{id}",
                data : {'districtId': districtId},
                success:function (data) {
                    for (let i = 0; i < data.length; i++){
                        option = option + '<option value="'+ data[i].UPAZILA_ID +'">'+ data[i].UPAZILA_NAME+'</option>';
                    }
                    $('.upazila').html(option);
                    $('.upazila').trigger("chosen:updated");
                }
            });
        });
    });
//    Upazilla to thana
    $(document).ready(function () {
        $('select#DISTRICT_ID').on('change',function(){
            let districtId = $(this).val(); //alert(districtId); exit();
            let option = '<option value="">Select Thana</option>';
            $.ajax({
                type : "get",
                url  : "supplier-profile/get-thana/{id}",
                data : {'districtId': districtId},
                success:function (data) {
                    for (let i = 0; i < data.length; i++){
                        option = option + '<option value="'+ data[i].THANA_ID +'">'+ data[i].THANA_NAME+'</option>';
                    }
                    $('.thana').html(option);
                    $('.thana').trigger("chosen:updated");
                }
            });
        });
    });

//    Upazilla to Union
    $(document).ready(function () {
        $('#UPAZILA_ID').on('change',function(){
            let upazilaId = $(this).val(); //alert(upazilaId);exit();
            let option = '<option value="">Select Union</option>';
            $.ajax({
                type : "get",
                url  : "supplier-profile/get-union/{id}",
                data : {'upazilaId': upazilaId},
                success:function (data) {
                    for (let i = 0; i < data.length; i++){
                        option = option + '<option value="'+ data[i].UNION_ID +'">'+ data[i].UNION_NAME+'</option>';
                    }
                    $('.union').html(option);
                    $('.union').trigger("chosen:updated");
                }
            });
        });
    });

</script>