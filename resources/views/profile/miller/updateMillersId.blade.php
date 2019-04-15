<script>  // millers Id
    $(document).ready(function () {
        $('#ZONE_IDD').on('change',function(){
            var millTypeId = $("#MILL_TYPE_IDD").val();
            var zoneId = $("#ZONE_IDD").val();
            var key = Math.floor(10000 + Math.random() * 90000);
            var millersIdd = millTypeId+'-'+zoneId+'-'+key;
            $('.millersIdd').val(millersIdd); //alert(millersId);exit();

        });
    });
</script>