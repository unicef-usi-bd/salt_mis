<script>
    //    Mark Run Form Submit By Ajax
    $(document).on('click', '.ajaxFormSubmitE', function () {
//      Laravel Request Handler
        var postType = $("input[name=_method]").val();
        var _method = (typeof(postType)==="undefined")?'POST':postType;
        var finalSubmit = (typeof($(this).attr('finalSubmit'))==="undefined")?'0':1;
        var actionUrl = $(this).attr('data-action');
        var thisForm = document.forms.namedItem("formData");
        var formData = new FormData(thisForm); // Currently empty
        formData.append('isFinalSubmit', finalSubmit);
        var object = {};
        formData.forEach(function(value, key){ object[key] = value; });
        var jsonData = JSON.stringify(object);
//        Request by Ajax
        $.ajax({
            url: actionUrl,
            type: _method,
            data: JSON.parse(jsonData),
            dataType: 'json',
            success: function (data) {
                if(data.success){
                    $('#successMessage').html('<span>'+data.success+'</span>');
                    $('input[type=text]').val("");
                    $('#success').delay(1000).show().fadeOut('slow');
                    jQuery('.alert-danger').hide();
                }else if(data.errors){
                    jQuery('.alert-danger').html('');
                    jQuery.each(data.errors, function(key, value){
                        jQuery('.alert-danger').show();
                        jQuery('.alert-danger').delay(3000).append('<li style="list-style-type:none;">'+value+'</li>').fadeOut('very slow');
                    });
                }
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });
</script>