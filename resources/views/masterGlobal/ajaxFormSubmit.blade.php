<script>
    function formSubmit(form_data){
        let url = jQuery(form_data).attr('action');
        let postType = $("input[name=_method]").val();
        let _method = (typeof(postType) === "undefined") ? 'post' : postType;
        let doEmptyForm = $(this).attr('data-clear') || true;
        let finalSubmit = (typeof($(this).attr('finalSubmit'))==="undefined")?'0':1;
        let formData = new FormData(form_data); // Currently empty
        formData.append('isFinalSubmit', finalSubmit);
        if(_method!=='post') doEmptyForm = false;
        $.ajax({
            type: 'post',
            url: url,
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            dataType: 'json'
        }).done(function(data) {
            if(data.success){
                displayAlertHandler(data.success);
                if(doEmptyForm===true) formClear();
                if(data.insertId) putInsertIdInClassAttribute(data.insertId);
            }else if(data.errors){
                displayAlertHandler(data.errors, 'danger');
            }else{
                let defaultMsg = 'Something is wrong there';
                displayAlertHandler(defaultMsg, 'danger');
            }
        }).fail(function(data) {
            console.log('Error:', data);
        });
    }

    function putInsertIdInClassAttribute(insertId){
        let hasContainer = $(document).find('.insertIdContainer');
        if(hasContainer.length) {
            hasContainer.val(insertId).trigger('change');
        }
    }

//    For Error Message Show
    function displayAlertHandler(message, alert='success') {
        let alertMessage = $('.alertHandlerInModal');
        let hasModalOpen = alertMessage.closest('.modal').hasClass('in');
        if(!hasModalOpen) alertMessage = $('.alertHandlerOutModal');
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

    //    Float Number Validation
    function numbersOnly(sender, evt) {
        let txt = sender.value;
        let dotContainer = txt.split('.');
        let charCode = parseInt((evt.which) ? evt.which : event.keyCode);
        if (!(parseFloat(dotContainer.length) === 1 && charCode === 46) && charCode > 31 && (charCode < 48 || charCode > 57)) return false;
        return true;
    }
</script>