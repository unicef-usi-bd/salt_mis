<div class="col-md-12">

    <div class="row">

        <div class="col-md-12">
            <div class="col-md-8">
                <div class="col-md-6" style="padding: 0px;">
                    <label for="inputSuccess" class="col-md-4 control-label no-padding-right" for="form-field-1-1"><b>{{ trans('sendEmail.ccType') }}</b><span style="color: red;"> *</span></label>
                    <div class="col-md-8">
                    <span class="block input-icon input-icon-right">
                        <select id="form-field-select-3 inputSuccess cost_center_type cc_search" class="cost_center_type_id form-control" name="cost_center_type_id" data-placeholder="Select or search data">
                            <option value="">-Select One-</option>
                            @foreach($costCenterTypes as $costCenterType)
                                <option value="{{$costCenterType->cost_center_type_id}}"> {{$costCenterType->cost_center_type_name}}</option>
                            @endforeach
                        </select>
                     </span>
                    </div>
                </div>

                <div class="col-md-6" style="padding: 0px;">
                    <label for="inputSuccess" class="col-sm-5 control-label no-padding-right" for="form-field-1-1"><b>{{ trans('sendEmail.cost_center') }}</b><span style="color: red;"> *</span></label>
                    <div class="col-md-7">
                    <span class="block input-icon input-icon-right">
                        <select id="form-field-select-3 inputSuccess cost_center" class="cost_center_id form-control chosen-select" name="cost_center_id" data-placeholder="Select or search data">
                            <option></option>
                        </select>
                     </span>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <span style="margin-left: 12px;">
                    <button class="search btn btn-primary btn-md" type="submit" style="height: 36px;line-height: 0;"><i class="fa fa-search"></i> {{ trans('sendEmail.search') }}</button>
                </span>
            </div>

        </div>

    </div>

    <hr>

    <form action="{{ url('send-mails') }}" method="post" class="form-horizontal checkValidation" role="form">
        @csrf
    <div class="row">
        <div class="col-xs-12">

            <h5><b>{{ trans('sendEmail.receiver_list') }}</b></h5>

            <table class="table table-striped table-bordered table-hover gridTable" title="User List">
                <thead>
                <tr>
                    <th class="center">
                        <label class="pos-rel">
                            <input type="checkbox" class="ace checkAll" />
                            <span class="lbl"></span>
                        </label>
                    </th>
                    <th>{{ trans('sendEmail.user') }}</th>
                    <th>{{ trans('sendEmail.email') }}</th>
                    <th>{{ trans('sendEmail.contract') }}</th>
                </tr>
                </thead>


                <tbody id="tblUser">
                </tbody>
            </table>
            <hr>
        </div><!-- /.col -->

        <div class="col-sm-6 col-sm-offset-3">
            <div class="form-group">
                <label for="inputSuccess" class="col-sm-4 control-label" for="form-field-1-1"><b>{{ trans('emailTemplete.email_type_name') }}</b><span style="color: red;"> *</span></label>
                <div class="col-sm-8">
                    <span class="block input-icon input-icon-right">
                        <select id="form-field-select-3 inputSuccess email_type_id" class="chosen-select form-control templateType" name="email_type_id" data-placeholder="Select or search data">
                            <option value="">-Select One- </option>
                            @foreach($emailTypes as $emailType)
                                <option value="{{$emailType->lookup_group_data_id}}"> {{$emailType->group_data_name}}</option>
                            @endforeach
                        </select>
                     </span>
                </div>
            </div>
        </div>


        <div class="col-xs-12 emailTemplate">
            <hr>

            <h5><b>{{ trans('breadcrumb.email_template') }}</b></h5>
            <div id="warning" class="alert alert-block alert-warning">
                <span>This Type of Email Template isn't Store.</span>
                <button type="button" class="close" data-dismiss="alert">

                    <i class="ace-icon fa fa-times"></i>
                </button>
            </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>{{ trans('sendEmail.cc') }}</b></label>
                    <div class="col-sm-8">
                        <input style="color: #000;" type="text" id="inputSuccess cc" placeholder="Example:- example@mail.com,abc@mail.com" name="cc" class="form-control col-xs-10 col-sm-5"/>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>{{ trans('sendEmail.bcc') }}</b></label>
                    <div class="col-sm-8">
                        <input style="color: #000;" type="text" id="inputSuccess bcc" placeholder="Example:- example@mail.com,abc@mail.com" name="bcc" class="form-control col-xs-10 col-sm-5"/>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>{{ trans('emailTemplete.subject') }}</b><span style="color: red;"> *</span> </label>
                    <div class="col-sm-8">
                        <input style="color: #000;" type="text" id="inputSuccess email_subject" placeholder="{{ trans('emailTemplete.ex_email_subject') }}" name="email_subject" class="form-control col-xs-10 col-sm-5 email_subject"/>
                    </div>
                </div>


                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> <b>{{ trans('lookupGroupIndex.description') }}</b><span style="color: red;"> *</span> </label>
                    <div class="col-sm-8">
                        <textarea class="form-control email_body" name="email_body" id="editor1" rows="10" cols="80"></textarea>
                    </div>
                </div>


                <hr>

                <div class="clearfix">
                    <div class="col-md-offset-3 col-md-9">
                        <button type="reset" class="btn">
                            <i class="ace-icon fa fa-undo bigger-110"></i>
                            {{ trans('dashboard.reset') }}
                        </button>
                        <button type="submit" class="btn btn-info">
                            <i class="ace-icon fa fa-check bigger-110"></i>
                            {{ trans('sendEmail.send_email') }}
                        </button>
                    </div>
                </div>


        </div><!-- /.col -->
    </div><!-- /.row -->
    </form>
</div>
@include('masterGlobal.chosenSelect')
@include('masterGlobal.formValidation')

<script src="{{asset('assets/ckEditor/ckeditor.js')}}"></script>

<script>
    $(document).ready(function(){
        $('.search').prop('disabled', true);
        //Edit Email Template Editor
        CKEDITOR.replace( 'editor1' );

        $('#warning').hide();

        //Email Template row
        $('.emailTemplate').hide();

        $('.templateType').on('change', function(){
            $templatetypeId =  $(this).val();
            console.log($templatetypeId);
            $.ajax({
                type : "get",
                url  : "get-email-template",
                data : {'templatetypeId': $templatetypeId},
                success:function (data) {
                    var templateData = JSON.parse(data);

                    if(templateData.length>0){
                        for (var i = 0; i < templateData.length; i++) {
                            $('.email_subject').val(templateData[i].email_subject);
                            CKEDITOR.instances.editor1.setData(templateData[i].email_body);
                        }
                    }else{
                        $('#warning').show();
                        $('.email_subject').val('');
                        CKEDITOR.instances.editor1.setData('');
                    }
                }
            });

            $('.emailTemplate').show();
        });

        //search box
        $('.search').on('click', function(){
            var ccTypeID = $('.cost_center_type_id').val();
            var rows = '';
            $.ajax({
                type : "get",
                url  : "get-search-result",
                data : {'ccTypeID': ccTypeID},
                success:function (data) {
                    var userData = JSON.parse(data);
                    for (var i = 0; i < userData.length; i++){
                        rows += '<tr>' +
                            '<td class="center"> <label class="pos-rel"> <input name="user_id[]" type="checkbox" class="ace" value="'+ userData[i].id +'"/> <span class="lbl"></span> </label></td>'+
                            '<td>'+ userData[i].username +'</td>' +
                            '<td>'+ userData[i].email +'</td>' +
                            '<td>'+ userData[i].contact_no +'</td>' +
                            '</tr>'
                    }
                    $('#tblUser').html(rows);
                }
            });
        })

        //Cost Center type wise cost center
        $('.cost_center_type_id').on('change',function () {
            $('.search').prop('disabled', false);
            var costCenterTypeId = $(this).val();
            var option = '<option value=""> Select One </option>';

            $.ajax({
                type : "get",
                url  : "get-cost_center",
                data : {'costCenterTypeId': costCenterTypeId},
                success:function (data) {
                    var costCenterData = JSON.parse(data);
                    for (var i = 0; i < costCenterData.length; i++){
                        option = option + '<option value="'+ costCenterData[i].cost_center_id +'">'+ costCenterData[i].cost_center_name+'</option>';
                    }

                    $('.cost_center_id').html(option);
                    $('.cost_center_id').trigger("chosen:updated");
                }
            });
        })


        //Cost Center Wise User List
        $('.cost_center_id').on('change',function(){
            var costCenterId = $(this).val();
            var rows = '';

            $.ajax({
                type : "get",
                url  : "get-users",
                data : {'costCenterId': costCenterId},
                success:function (data) {
                    var userData = JSON.parse(data);
                    for (var i = 0; i < userData.length; i++){
                        rows += '<tr>' +
                        '<td class="center"> <label class="pos-rel"> <input name="user_id[]" type="checkbox" class="ace" value="'+ userData[i].id +'"/> <span class="lbl"></span> </label></td>'+
                        '<td>'+ userData[i].username +'</td>' +
                        '<td>'+ userData[i].email +'</td>' +
                        '<td>'+ userData[i].contact_no +'</td>' +
                        '</tr>'
                    }
                    $('#tblUser').html(rows);
                }
            });
        })


        $(".checkAll").click(function () {
            $('input:checkbox').not(this).prop('checked', this.checked);
        });
    });
</script>

