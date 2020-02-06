<script>
//      Form Submit By Ajax
    $(document).on('click', '.ajaxFormSubmit', function () {
//      Laravel Request Handler
        let finalSubmit = (typeof($(this).attr('finalSubmit'))==="undefined")?'0':1;
        let postType = $("input[name=_method]").val();
        let _method = (typeof(postType)==="undefined")?'post':postType;
        let actionUrl = $(this).attr('data-action');
        let thisForm = document.forms.namedItem("formData");
        let formData = new FormData(thisForm); // Currently empty
        formData.append('isFinalSubmit', finalSubmit);
        $.ajax({
            url: actionUrl,
            type: 'POST',
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            dataType: 'json',
            success: function (data) {
                if(data.success){
                    displayAlertHandler(data.success);
                    if(_method==='post') formClear();
                }else if(data.errors){
                    displayAlertHandler(data.errors, 'danger');
                }else{
                    let defaultMsg = 'Something is wrong there';
                    displayAlertHandler(defaultMsg, 'danger');
                }
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });

//    For Error Message Show
    function displayAlertHandler(message, alert='success') {
        let alertMessage = $('.alert-handler');
        let duration = 20000;
        alertMessage.empty().hide();
        if(message===null) return false;
        message = `<div class="alert alert-${alert} alert-dismissible" role="alert">
                      <strong>Alert !</strong> ${message}
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>`;
        if(alert==='success') duration = 5000;
        alertMessage.delay(duration).append(message).show().fadeOut('very slow');
    }

//    For Clear Form
    function formClear() {
        let today = getCurrentDate();
        $('input[type=text]').val("");
        $('select.chosen-select').val('').trigger('chosen:updated');
        let datepicker = $('input.date-picker');
        if(datepicker) datepicker.val(today).trigger('changeDate');
    }

//    For Get Current Date
    function getCurrentDate() {
        let currentDate = new Date();
        let month = currentDate.getMonth()+1;
        let day = currentDate.getDate();
        currentDate = `${(month<10 ? '0' : '')}${month}/${(day<10 ? '0' : '')}${day}/${currentDate.getFullYear()}`;
        return currentDate;
    }
</script>