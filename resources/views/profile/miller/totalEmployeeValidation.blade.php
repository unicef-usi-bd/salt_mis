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


    // validation for full time employee
    $(document).on("keyup",".partTimeMaleEmp", function () {

        var  totalMaleEmp = $('.totalMaleEmp').val();
        var  totalFemaleEmp = $('.totalFemaleEmp').val();
        var  partTimeMaleEmp = $('.partTimeMaleEmp').val();
        var  partTimeFemaleEmp = $('.partTimeFemaleEmp').val();
        var  fullTimeMaleEmp = $('.fullTimeMaleEmp').val();
        var  fullTimeFemaleEmp = $('.fullTimeFemaleEmp').val();
        var total  = parseInt(totalMaleEmp)+parseInt(totalFemaleEmp);
        var totalPartTime  = parseInt(partTimeMaleEmp)+parseInt(partTimeFemaleEmp);
        var totalFullTime  = parseInt(fullTimeMaleEmp)+parseInt(fullTimeFemaleEmp);
        var totalPartFullEmp = parseInt(totalPartTime)+parseInt(totalFullTime);
        if(total!=totalPartFullEmp){

            $('.finalSubmit').prop('disabled', true);
            $('span.error').show();
        }else{
            $('.finalSubmit').prop('disabled', false);
            $('span.error').hide();
        }

    });
    $(document).on("keyup",".partTimeFemaleEmp", function () {

        var  totalMaleEmp = $('.totalMaleEmp').val();
        var  totalFemaleEmp = $('.totalFemaleEmp').val();
        var  partTimeMaleEmp = $('.partTimeMaleEmp').val();
        var  partTimeFemaleEmp = $('.partTimeFemaleEmp').val();
        var  fullTimeMaleEmp = $('.fullTimeMaleEmp').val();
        var  fullTimeFemaleEmp = $('.fullTimeFemaleEmp').val();
        var total  = parseInt(totalMaleEmp)+parseInt(totalFemaleEmp);
        var totalPartTime  = parseInt(partTimeMaleEmp)+parseInt(partTimeFemaleEmp);
        var totalFullTime  = parseInt(fullTimeMaleEmp)+parseInt(fullTimeFemaleEmp);
        var totalPartFullEmp = parseInt(totalPartTime)+parseInt(totalFullTime);
        if(total!=totalPartFullEmp){

            $('.finalSubmit').prop('disabled', true);
            $('span.error').show();
        }else{
            $('.finalSubmit').prop('disabled', false);
            $('span.error').hide();
        }

    });
    $(document).on("keyup",".fullTimeMaleEmp", function () {

        var  totalMaleEmp = $('.totalMaleEmp').val();
        var  totalFemaleEmp = $('.totalFemaleEmp').val();
        var  partTimeMaleEmp = $('.partTimeMaleEmp').val();
        var  partTimeFemaleEmp = $('.partTimeFemaleEmp').val();
        var  fullTimeMaleEmp = $('.fullTimeMaleEmp').val();
        var  fullTimeFemaleEmp = $('.fullTimeFemaleEmp').val();
        var total  = parseInt(totalMaleEmp)+parseInt(totalFemaleEmp);
        var totalPartTime  = parseInt(partTimeMaleEmp)+parseInt(partTimeFemaleEmp);
        var totalFullTime  = parseInt(fullTimeMaleEmp)+parseInt(fullTimeFemaleEmp);
        var totalPartFullEmp = parseInt(totalPartTime)+parseInt(totalFullTime);
        if(total!=totalPartFullEmp){

            $('.finalSubmit').prop('disabled', true);
            $('span.error').show();
        }else{
            $('.finalSubmit').prop('disabled', false);
            $('span.error').hide();
        }

    });
    $(document).on("keyup",".fullTimeFemaleEmp", function () {

        var  totalMaleEmp = $('.totalMaleEmp').val();
        var  totalFemaleEmp = $('.totalFemaleEmp').val();
        var  partTimeMaleEmp = $('.partTimeMaleEmp').val();
        var  partTimeFemaleEmp = $('.partTimeFemaleEmp').val();
        var  fullTimeMaleEmp = $('.fullTimeMaleEmp').val();
        var  fullTimeFemaleEmp = $('.fullTimeFemaleEmp').val();
        var total  = parseInt(totalMaleEmp)+parseInt(totalFemaleEmp);
        var totalPartTime  = parseInt(partTimeMaleEmp)+parseInt(partTimeFemaleEmp);
        var totalFullTime  = parseInt(fullTimeMaleEmp)+parseInt(fullTimeFemaleEmp);
        var totalPartFullEmp = parseInt(totalPartTime)+parseInt(totalFullTime);
        if(total!=totalPartFullEmp){

            $('.finalSubmit').prop('disabled', true);
            $('span.error').show();
        }else{
            $('.finalSubmit').prop('disabled', false);
            $('span.error').hide();
        }

    });
    $(document).on("keyup",".totalMaleEmp", function () {

        var  totalMaleEmp = $('.totalMaleEmp').val();
        var  totalFemaleEmp = $('.totalFemaleEmp').val();
        var  partTimeMaleEmp = $('.partTimeMaleEmp').val();
        var  partTimeFemaleEmp = $('.partTimeFemaleEmp').val();
        var  fullTimeMaleEmp = $('.fullTimeMaleEmp').val();
        var  fullTimeFemaleEmp = $('.fullTimeFemaleEmp').val();
        var total  = parseInt(totalMaleEmp)+parseInt(totalFemaleEmp);
        var totalPartTime  = parseInt(partTimeMaleEmp)+parseInt(partTimeFemaleEmp);
        var totalFullTime  = parseInt(fullTimeMaleEmp)+parseInt(fullTimeFemaleEmp);
        var totalPartFullEmp = parseInt(totalPartTime)+parseInt(totalFullTime);
        if(total!=totalPartFullEmp){

            $('.finalSubmit').prop('disabled', true);
            $('span.error').show();
        }else{
            $('.finalSubmit').prop('disabled', false);
            $('span.error').hide();
        }

    });

    $(document).on("keyup",".totalFemaleEmp", function () {

        var  totalMaleEmp = $('.totalMaleEmp').val();
        var  totalFemaleEmp = $('.totalFemaleEmp').val();
        var  partTimeMaleEmp = $('.partTimeMaleEmp').val();
        var  partTimeFemaleEmp = $('.partTimeFemaleEmp').val();
        var  fullTimeMaleEmp = $('.fullTimeMaleEmp').val();
        var  fullTimeFemaleEmp = $('.fullTimeFemaleEmp').val();
        var total  = parseInt(totalMaleEmp)+parseInt(totalFemaleEmp);
        var totalPartTime  = parseInt(partTimeMaleEmp)+parseInt(partTimeFemaleEmp);
        var totalFullTime  = parseInt(fullTimeMaleEmp)+parseInt(fullTimeFemaleEmp);
        var totalPartFullEmp = parseInt(totalPartTime)+parseInt(totalFullTime);
        if(total!=totalPartFullEmp){

            $('.finalSubmit').prop('disabled', true);
            $('span.error').show();
        }else{
            $('.finalSubmit').prop('disabled', false);
            $('span.error').hide();
        }

    });



</script>