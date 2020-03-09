<script>
//    division to district
    $(document).ready(function () {
        $(document).on('change', '.division', function(){
            let divisionId = $(this).val();
            let thisScope = $(this).closest('tr');
            if(thisScope.length===0) thisScope = $(this).closest('form');
            let option = '<option value="">Select District</option>';
            $.ajax({
                type : "get",
                url  : `supplier-profile/get-district/${divisionId}`,
                success:function (data) {
                    for (let i = 0; i < data.length; i++){
                        option = option + '<option value="'+ data[i].DISTRICT_ID +'">'+ data[i].DISTRICT_NAME+'</option>';
                    }
                    thisScope.find('.district').html(option);
                    thisScope.find('.district').trigger("chosen:updated");
                    thisScope.find('.upazila').empty().trigger("chosen:updated");
                }
            });
        });

//      District to Upazilla

        $(document).on('change', '.district', function(){
            let districtId = $(this).val();
            let thisScope = $(this).closest('tr');
            if(thisScope.length===0) thisScope = $(this).closest('form');
            let option = '<option value="">Select Upazila</option>';
            $.ajax({
                type : "get",
                url  : `supplier-profile/get-upazila/${districtId}`,
                success:function (data) {
                    for (let i = 0; i < data.length; i++){
                        option = option + '<option value="'+ data[i].UPAZILA_ID +'">'+ data[i].UPAZILA_NAME+'</option>';
                    }
                    thisScope.find('.upazila').html(option);
                    thisScope.find('.upazila').trigger("chosen:updated");
                }
            });
        });

//    Upazilla to thana

/*        $(document).on('change', '.district', function(){
            let districtId = $(this).val();
            let thisScope = $(this).closest('tr');
            if(typeof thisScope!=='undefined') thisScope = $(this).closest('form');
            let option = '<option value="">Select Thana</option>';
            $.ajax({
                type : "get",
                url  : `supplier-profile/get-thana/${districtId}`,
                data : {'districtId': districtId},
                success:function (data) {
                    for (let i = 0; i < data.length; i++){
                        option = option + '<option value="'+ data[i].THANA_ID +'">'+ data[i].THANA_NAME+'</option>';
                    }
                    thisScope.find('.thana').html(option);
                    thisScope.find('.thana').trigger("chosen:updated");
                }
            });
        });*/

//    Upazilla to Union
        $(document).on('change', 'upazila', function(){
            let upazilaId = $(this).val();
            let thisScope = $(this).closest('tr');
            if(thisScope.length===0) thisScope = $(this).closest('form');
            let option = '<option value="">Select Union</option>';
            $.ajax({
                type : "get",
                url  : `supplier-profile/get-union/${upazilaId}`,
                success:function (data) {
                    for (let i = 0; i < data.length; i++){
                        option = option + '<option value="'+ data[i].UNION_ID +'">'+ data[i].UNION_NAME+'</option>';
                    }
                    thisScope.find('.union').html(option);
                    thisScope.find('.union').trigger("chosen:updated");
                }
            });
        });


    });

</script>