<script>
    $('.millInfo_msg').hide();
    $(document).on('click','.btnUpdateMillInfo',function (){
        //var millerInfoId = $('.millerInfoId').val(); //alert(millerInfoId);exit();
        var url = $(this).closest('form').attr('action');
        $.ajax({
            type : 'POST',
            url : url,
            data : $('#millId').serialize(),
            success: function (data) {
                console.log(data);
                $('.millInfo_msg').html('<span>'+ data +'</span>').show();

            }
        })
    });
    $('.entrepreneur_msg').hide();
    $(document).on('click','.btnUpdateEntrepInfo',function (){
        //var millerInfoId = $('.millerInfoId').val(); //alert(millerInfoId);exit();
        var url = $(this).closest('form').attr('action');
        $.ajax({
            type : 'POST',
            url : url,
            data : $('#entrepreneurId').serialize(),
            success: function (data) {
                console.log(data);
                $('.entrepreneur_msg').html('<span>'+ data +'</span>').show();

            }
        })
    });
    $('.certificate_msg').hide();
    $(document).on('click','.btnUpdateCertificateInfo',function (){
        //var millerInfoId = $('.millerInfoId').val(); //alert(millerInfoId);exit();
        var url = $(this).closest('form').attr('action');
        $.ajax({
            type : 'POST',
            url : url,
            data : $('#certtificateId').serialize(),
            success: function (data) {
                console.log(data);
                $('.certificate_msg').html('<span>'+ data +'</span>').show();

            }
        })
    });
    $('.qc_msg').hide();
    $(document).on('click','.btnUpdateQcInfo',function (){
        //var millerInfoId = $('.millerInfoId').val(); //alert(millerInfoId);exit();
        var url = $(this).closest('form').attr('action');
        $.ajax({
            type : 'POST',
            url : url,
            data : $('#qcId').serialize(),
            success: function (data) {
                console.log(data);
                $('.qc_msg').html('<span>'+ data +'</span>').show();

            }
        })
    });

    function millTab(){
        $('[href="#entrepreneur"]').tab('show');
    }
    function entrepreneurTab(){
        $('[href="#certificate"]').tab('show');
    }
    function certificateTab(){
        $('[href="#qc"]').tab('show');
    }
    function qcTab(){
        $('[href="#employee"]').tab('show');
    }
</script>