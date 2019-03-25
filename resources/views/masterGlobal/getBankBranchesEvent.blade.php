<script>
    $(document).ready(function () {
        $('.bank').on('change',function(){
            var bankId = $(this).val();
            var option = '<option value="">Select One</option>';
            $.ajax({
                type : "get",
                url  : "get-bank-branches",
                data : {'bankId': bankId},
                success:function (data) {
                    for (var i = 0; i < data.length; i++){
                        option = option + '<option value="'+ data[i].bank_branch_id +'">'+ data[i].bank_branch_name+'</option>';
                    }
                    $('.branch').html(option);
                    $('.branch').trigger("chosen:updated");
                }
            });
        });
    });
</script>