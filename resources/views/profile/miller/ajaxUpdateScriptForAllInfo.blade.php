<script>
//    $('.millInfo_msg').hide();
//    $(document).on('click','.btnUpdateMillInfo',function (){
//        //var millerInfoId = $('.millerInfoId').val(); //alert(millerInfoId);exit();
//        var url = $(this).closest('form').attr('action');
//        $.ajax({
//            type : 'POST',
//            url : url,
//            data : $('#millId').serialize(),
//            success: function (data) {
//                console.log(data);
//                $('.millInfo_msg').html('<span>'+ data +'</span>').show();
//                setTimeout(function() { $(".millInfo_msg").hide(); }, 3000);
//
//            }
//        })
//    });
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
                setTimeout(function() { $(".entrepreneur_msg").hide(); }, 3000);

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
                setTimeout(function() { $(".certificate_msg").hide(); }, 3000);

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
                setTimeout(function() { $(".qc_msg").hide(); }, 3000);

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