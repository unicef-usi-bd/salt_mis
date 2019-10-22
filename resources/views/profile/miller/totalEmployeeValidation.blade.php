<script>

    $(document).ready(function () {
        $('.finalSubmit').prop('disabled', true);
    });

    $(document).on('keyup','.partTimeMaleEmp',function () {
       var partTimeMale = $(this).val();

       if(partTimeMale > 0){
           $('.fullTimeMaleEmp').removeAttr('required');
       }
    });

    $(document).on('keyup','.partTimeFemaleEmp',function () {
        var partTimeFemale = $(this).val();

        if(partTimeFemale > 0){
            $('.fullTimeFemaleEmp').removeAttr('required');
        }
    });

    $(document).on('keyup','.fullTimeMaleEmp',function () {
        var fullTimeMale = $(this).val();

        if(fullTimeMale > 0){
            $('.partTimeMaleEmp').removeAttr('required');
        }
    });

    $(document).on('keyup','.partTimeFemaleEmp',function () {
        var partTimeFemale = $(this).val();

        if(partTimeFemale > 0){
            $('.fullTimeFemaleEmp').removeAttr('required');
        }
    });

    $(document).on("keyup  change",".empValidation",function(){
        var thisvalue= $(this).val();
        if(!thisvalue){
            $(this).val(0).select();
        }
        var  totalMaleEmp = $('.totalMaleEmp').val();
        var  totalFemaleEmp = $('.totalFemaleEmp').val();
        var  partTimeMaleEmp = $('.partTimeMaleEmp').val();
        var  partTimeFemaleEmp = $('.partTimeFemaleEmp').val();
        var  fullTimeMaleEmp = $('.fullTimeMaleEmp').val();
        var  fullTimeFemaleEmp = $('.fullTimeFemaleEmp').val();
        var total  = parseInt(totalMaleEmp == '' ? 0 : totalMaleEmp)+parseInt(totalFemaleEmp == '' ? 0 :totalFemaleEmp);
        var totalPartFullMaleEmp  = parseInt(partTimeMaleEmp == '' ? 0 :partTimeMaleEmp)+parseInt(fullTimeMaleEmp == '' ? 0 :fullTimeMaleEmp);
        var totalPartFullFemaleEmp  = parseInt(partTimeFemaleEmp == '' ? 0 :partTimeFemaleEmp)+parseInt(fullTimeFemaleEmp == '' ? 0 :fullTimeFemaleEmp);
        var totalPartFullEmp = parseInt(partTimeMaleEmp == '' ? 0 :partTimeMaleEmp)+parseInt(partTimeFemaleEmp == '' ? 0 :partTimeFemaleEmp)+parseInt(fullTimeMaleEmp == '' ? 0 :fullTimeMaleEmp)+parseInt(fullTimeFemaleEmp == '' ? 0 :fullTimeFemaleEmp);

        if(totalPartFullEmp <= 0){
            $('.finalSubmit').prop('disabled', true);
            $('span.error').show();
        }else{
            if(total == totalPartFullEmp && totalMaleEmp == totalPartFullMaleEmp && totalFemaleEmp == totalPartFullFemaleEmp){
                $('.finalSubmit').prop('disabled', false);
                $('span.error').hide();
            }else{
                $('.finalSubmit').prop('disabled', true);
                $('span.error').show();
            }
        }
    });


    // validation for full time employee
//    $(document).on("keyup",".partTimeMaleEmp", function () {
//
//        var  totalMaleEmp = $('.totalMaleEmp').val();
//        var  totalFemaleEmp = $('.totalFemaleEmp').val();
//        var  partTimeMaleEmp = $('.partTimeMaleEmp').val();
//        var  partTimeFemaleEmp = $('.partTimeFemaleEmp').val();
//        var  fullTimeMaleEmp = $('.fullTimeMaleEmp').val();
//        var  fullTimeFemaleEmp = $('.fullTimeFemaleEmp').val();
//        var total  = parseInt(totalMaleEmp)+parseInt(totalFemaleEmp);
//        var totalPartTime  = parseInt(partTimeMaleEmp)+parseInt(partTimeFemaleEmp);
//        var totalFullTime  = parseInt(fullTimeMaleEmp)+parseInt(fullTimeFemaleEmp);
//        var totalPartFullEmp = parseInt(totalPartTime)+parseInt(totalFullTime);
//        if(total!=totalPartFullEmp){
//
//            $('.finalSubmit').prop('disabled', true);
//            $('span.error').show();
//        }else{
//            $('.finalSubmit').prop('disabled', false);
//            $('span.error').hide();
//        }
//
//    });
//    $(document).on("keyup",".partTimeFemaleEmp", function () {
//
//        var  totalMaleEmp = $('.totalMaleEmp').val();
//        var  totalFemaleEmp = $('.totalFemaleEmp').val();
//        var  partTimeMaleEmp = $('.partTimeMaleEmp').val();
//        var  partTimeFemaleEmp = $('.partTimeFemaleEmp').val();
//        var  fullTimeMaleEmp = $('.fullTimeMaleEmp').val();
//        var  fullTimeFemaleEmp = $('.fullTimeFemaleEmp').val();
//        var total  = parseInt(totalMaleEmp)+parseInt(totalFemaleEmp);
//        var totalPartTime  = parseInt(partTimeMaleEmp)+parseInt(partTimeFemaleEmp);
//        var totalFullTime  = parseInt(fullTimeMaleEmp)+parseInt(fullTimeFemaleEmp);
//        var totalPartFullEmp = parseInt(totalPartTime)+parseInt(totalFullTime);
//        if(total!=totalPartFullEmp){
//
//            $('.finalSubmit').prop('disabled', true);
//            $('span.error').show();
//        }else{
//            $('.finalSubmit').prop('disabled', false);
//            $('span.error').hide();
//        }
//
//    });
//    $(document).on("keyup",".fullTimeMaleEmp", function () {
//
//        var  totalMaleEmp = $('.totalMaleEmp').val();
//        var  totalFemaleEmp = $('.totalFemaleEmp').val();
//        var  partTimeMaleEmp = $('.partTimeMaleEmp').val();
//        var  partTimeFemaleEmp = $('.partTimeFemaleEmp').val();
//        var  fullTimeMaleEmp = $('.fullTimeMaleEmp').val();
//        var  fullTimeFemaleEmp = $('.fullTimeFemaleEmp').val();
//        var total  = parseInt(totalMaleEmp)+parseInt(totalFemaleEmp);
//        var totalPartTime  = parseInt(partTimeMaleEmp)+parseInt(partTimeFemaleEmp);
//        var totalFullTime  = parseInt(fullTimeMaleEmp)+parseInt(fullTimeFemaleEmp);
//        var totalPartFullEmp = parseInt(totalPartTime)+parseInt(totalFullTime);
//        if(total!=totalPartFullEmp){
//
//            $('.finalSubmit').prop('disabled', true);
//            $('span.error').show();
//        }else{
//            $('.finalSubmit').prop('disabled', false);
//            $('span.error').hide();
//        }
//
//    });
//    $(document).on("keyup blur change",".fullTimeFemaleEmp", function () {
//
//        var  totalMaleEmp = $('.totalMaleEmp').val();
//        var  totalFemaleEmp = $('.totalFemaleEmp').val();
//        var  partTimeMaleEmp = $('.partTimeMaleEmp').val();
//        var  partTimeFemaleEmp = $('.partTimeFemaleEmp').val();
//        var  fullTimeMaleEmp = $('.fullTimeMaleEmp').val();
//        var  fullTimeFemaleEmp = $('.fullTimeFemaleEmp').val();
//        var total  = parseInt(totalMaleEmp)+parseInt(totalFemaleEmp);
//        var totalPartTime  = parseInt(partTimeMaleEmp)+parseInt(partTimeFemaleEmp);
//        var totalFullTime  = parseInt(fullTimeMaleEmp)+parseInt(fullTimeFemaleEmp);
//        var totalPartFullEmp = parseInt(totalPartTime)+parseInt(totalFullTime);
//        if(total!=totalPartFullEmp){
//
//            $('.finalSubmit').prop('disabled', true);
//            $('span.error').show();
//        }else{
//            $('.finalSubmit').prop('disabled', false);
//            $('span.error').hide();
//        }
//
//    });
//    $(document).on("keyup",".totalMaleEmp", function () {
//
//        var  totalMaleEmp = $('.totalMaleEmp').val();
//        var  totalFemaleEmp = $('.totalFemaleEmp').val();
//        var  partTimeMaleEmp = $('.partTimeMaleEmp').val();
//        var  partTimeFemaleEmp = $('.partTimeFemaleEmp').val();
//        var  fullTimeMaleEmp = $('.fullTimeMaleEmp').val();
//        var  fullTimeFemaleEmp = $('.fullTimeFemaleEmp').val();
//        var total  = parseInt(totalMaleEmp)+parseInt(totalFemaleEmp);
//        var totalPartTime  = parseInt(partTimeMaleEmp)+parseInt(partTimeFemaleEmp);
//        var totalFullTime  = parseInt(fullTimeMaleEmp)+parseInt(fullTimeFemaleEmp);
//        var totalPartFullEmp = parseInt(totalPartTime)+parseInt(totalFullTime);
//        if(total!=totalPartFullEmp){
//
//            $('.finalSubmit').prop('disabled', true);
//            $('span.error').show();
//        }else{
//            $('.finalSubmit').prop('disabled', false);
//            $('span.error').hide();
//        }
//
//    });
//
//    $(document).on("keyup",".totalFemaleEmp", function () {
//
//        var  totalMaleEmp = $('.totalMaleEmp').val();
//        var  totalFemaleEmp = $('.totalFemaleEmp').val();
//        var  partTimeMaleEmp = $('.partTimeMaleEmp').val();
//        var  partTimeFemaleEmp = $('.partTimeFemaleEmp').val();
//        var  fullTimeMaleEmp = $('.fullTimeMaleEmp').val();
//        var  fullTimeFemaleEmp = $('.fullTimeFemaleEmp').val();
//        var total  = parseInt(totalMaleEmp)+parseInt(totalFemaleEmp);
//        var totalPartTime  = parseInt(partTimeMaleEmp)+parseInt(partTimeFemaleEmp);
//        var totalFullTime  = parseInt(fullTimeMaleEmp)+parseInt(fullTimeFemaleEmp);
//        var totalPartFullEmp = parseInt(totalPartTime)+parseInt(totalFullTime);
//        if(total!=totalPartFullEmp){
//
//            $('.finalSubmit').prop('disabled', true);
//            $('span.error').show();
//        }else{
//            $('.finalSubmit').prop('disabled', false);
//            $('span.error').hide();
//        }
//
//    });



</script>