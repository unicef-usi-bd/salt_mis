<script>

    // validation for full time employee
    $(document).on("change",".partTimeMaleEmp", function () {

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
    $(document).on("change",".partTimeFemaleEmp", function () {

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
    $(document).on("change",".fullTimeMaleEmp", function () {

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
    $(document).on("change",".fullTimeFemaleEmp", function () {

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