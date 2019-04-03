<?php $digits = 4;
$autoId = rand(pow(10, $digits-1), pow(10, $digits)-1);
//                                          ?>
<script>
    $(document).ready(function () {
        $('#ZONE_ID').on('change',function(){
            var millTypeId = $("#MILL_TYPE_ID").val();
            var zoneId = $("#ZONE_ID").val();
            var key = Math.floor(10000 + Math.random() * 90000);
            var millersId = millTypeId+'-'+zoneId+'-'+key;
            $('.millersId').val(millersId); //alert(millersId);exit();

        });
    });
</script>