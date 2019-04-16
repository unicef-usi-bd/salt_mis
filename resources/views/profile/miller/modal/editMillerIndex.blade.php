<style>
    .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th{
        border: none;
    }
</style>
<div class="row">
    <div class="col-md-12">
        <div class="col-sm-12">
            <div id="success" class="alert alert-block alert-success" style="display: none;">
                <span id="successMessage"></span>
                <button type="button" class="close" data-dismiss="alert">
                    <i class="ace-icon fa fa-times"></i>
                </button>
            </div>

            <div class="tabbable">
                <ul class="nav nav-tabs" id="myTab">

                    <li class="active"> <a data-toggle="tab" href="#mill_tab"> Mill Information </a> </li>
                    <li class=""> <a data-toggle="tab" href="#entrepreneur_tab"> Entrepreneur Information  </a> </li>
                    <li class=""> <a data-toggle="tab" href="#certificate_tab">  Certificate Information </a> </li>
                    <li class=""> <a data-toggle="tab" href="#qc_tab"> QC Information </a> </li>
                    <li class=""> <a data-toggle="tab" href="#employee_tab"> Employee Information </a> </li>
                </ul>

                <div class="tab-content">
                    {{--Mill Info--}}
                    @include('profile.miller.modal.editMillInformation')
                    {{--/-Miller Info--}}
                    {{--Entrepreneur Information--}}
                    @include('profile.miller.modal.editEntrepreneurInformation')
                    {{--/-Entrepreneur Information--}}

                    {{--Certificate Info--}}
{{--                    @include('profile.miller.modal.editCertificateInformation')--}}
                    @include('profile.miller.modal.editCertificateInformationNormalSubmit')
                    {{--/-Certificate Info--}}

                    {{--QC Info--}}
                    @include('profile.miller.modal.editQcInformation')
                    {{--/- QC Info--}}

                    {{--Employee Info--}}
                    @include('profile.miller.modal.editEmployeeInformation')
                    {{--/- Employee Info--}}


                </div>
            </div>



        </div><!-- /.col -->

        <div class="space"></div>
    </div>
</div><!-- /.row -->



@include('masterGlobal.chosenSelect')
{{--@include('masterGlobal.getDistrict')--}}
{{--@include('masterGlobal.getUpazila')--}}
{{--@include('masterGlobal.getUnion')--}}

<!--Add New Group Modal Start-->
@include('masterGlobal.deleteScript')

@include('masterGlobal.ajaxFormSubmit')
@include('masterGlobal.getMillersId')
<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
{{--<script type="text/javascript" src="//cdn.jsdelivr.net/jquery/1/jquery.min.js"></script>--}}

<script src="{{ asset('assets/js/select2.min.js') }}"></script>
<script>

    $(document).ready(function(){
        $('.rowAddEntp').click(function(){
            var getTr = $('tr.rowFirstEntp:first');
//            alert(getTr.html());
            $("select.chosen-select").chosen('destroy');
            $('tbody.newRowEntp').append("<tr class='removableRow'>"+getTr.html()+"</tr>");
            var defaultRow = $('tr.removableRow:last');
            defaultRow.find(' input.OWNER_NAME').attr('disabled', false);
            defaultRow.find('select.DIVISION_ID').prop('disabled', false);
            defaultRow.find('select.DISTRICT_ID').prop('disabled', false);
            defaultRow.find('select.UPAZILA_ID').prop('disabled', false);
            defaultRow.find('select.UNION_ID').prop('disabled', false);
//            For Ignore array Conflict
            defaultRow.find('input.NID').attr('NID', false);
            defaultRow.find('input.MOBILE_1').attr('MOBILE_1', false);
            defaultRow.find('input.MOBILE_2').attr('disabled', false);
            defaultRow.find('input.EMAIL').attr('disabled', false);
            defaultRow.find('input.REMARKS').attr('disabled', false);
            defaultRow.find('span.budget_against_code').text('');
            defaultRow.find('span.errorMsg').text('');
            $('.chosen-select').chosen(0);
        });
    });
    // Fore Remove Row By Click
    $(document).on("click", "span.rowRemove ", function () {
        $(this).closest("tr.removableRow").remove();
    });

</script>

<script>
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
<script>
    $(document).ready(function () {
        $('#DIVISION_IDD').on('change',function(){
            var divisionId = $(this).val(); //alert(divisionId);exit();
            var option = '<option value="">Select District</option>';
            $.ajax({
                type : "get",
                url  : "supplier-profile/get-district/{id}",
                data : {'divisionId': divisionId},
                success:function (data) {
                    for (var i = 0; i < data.length; i++){
                        option = option + '<option value="'+ data[i].DISTRICT_ID +'">'+ data[i].DISTRICT_NAME+'</option>';
                    }
                    $('.districtt').html(option);
                    $('.districtt').trigger("chosen:updated");
                }
            });
        });
    });

    $(document).ready(function () {
        $('select#DISTRICT_IDD').on('change',function(){
            var districtId = $(this).val(); //alert(districtId); exit();
            var option = '<option value="">Select Upazila</option>';
            $.ajax({
                type : "get",
                url  : "supplier-profile/get-upazila/{id}",
                data : {'districtId': districtId},
                success:function (data) {
                    for (var i = 0; i < data.length; i++){
                        option = option + '<option value="'+ data[i].UPAZILA_ID +'">'+ data[i].UPAZILA_NAME+'</option>';
                    }
                    $('.upazilaa').html(option);
                    $('.upazilaa').trigger("chosen:updated");
                }
            });
        });
    });

    $(document).ready(function () {
        $('#UPAZILA_IDD').on('change',function(){
            var upazilaId = $(this).val(); //alert(upazilaId);exit();
            var option = '<option value="">Select Union</option>';
            $.ajax({
                type : "get",
                url  : "supplier-profile/get-union/{id}",
                data : {'upazilaId': upazilaId},
                success:function (data) {
                    for (var i = 0; i < data.length; i++){
                        option = option + '<option value="'+ data[i].UNION_ID +'">'+ data[i].UNION_NAME+'</option>';
                    }
                    $('.unionn').html(option);
                    $('.unionn').trigger("chosen:updated");
                }
            });
        });
    });
</script>

<script>
    $(document).ready(function () {
        $('select#ENT_DIVISION_ID').on('change',function(){
            var divisionId = $(this).val(); //alert(divisionId);exit();
            var option = '<option value="">Select District</option>';
            $.ajax({
                type : "get",
                url  : "supplier-profile/get-district/{id}",
                data : {'divisionId': divisionId},
                success:function (data) {
                    for (var i = 0; i < data.length; i++){
                        option = option + '<option value="'+ data[i].DISTRICT_ID +'">'+ data[i].DISTRICT_NAME+'</option>';
                    }
                    $('.ent_district').html(option);
                    $('.ent_district').trigger("chosen:updated");
                }
            });
        });
    });

    $(document).ready(function () {
        $('select#ENT_DISTRICT_ID').on('change',function(){
            var districtId = $(this).val(); //alert(districtId); exit();
            var option = '<option value="">Select Upazila</option>';
            $.ajax({
                type : "get",
                url  : "supplier-profile/get-upazila/{id}",
                data : {'districtId': districtId},
                success:function (data) {
                    for (var i = 0; i < data.length; i++){
                        option = option + '<option value="'+ data[i].UPAZILA_ID +'">'+ data[i].UPAZILA_NAME+'</option>';
                    }
                    $('.ent_upazila').html(option);
                    $('.ent_upazila').trigger("chosen:updated");
                }
            });
        });
    });

    $(document).ready(function () {
        $('#ENT_UPAZILA_ID').on('change',function(){
            var upazilaId = $(this).val(); //alert(upazilaId);exit();
            var option = '<option value="">Select Union</option>';
            $.ajax({
                type : "get",
                url  : "supplier-profile/get-union/{id}",
                data : {'upazilaId': upazilaId},
                success:function (data) {
                    for (var i = 0; i < data.length; i++){
                        option = option + '<option value="'+ data[i].UNION_ID +'">'+ data[i].UNION_NAME+'</option>';
                    }
                    $('.ent_union').html(option);
                    $('.ent_union').trigger("chosen:updated");
                }
            });
        });
    });
</script>
<script>
function millTab(){
    $('[href="#entrepreneur_tab"]').tab('show');
}
function entrepreneurTab(){
    $('[href="#certificate_tab"]').tab('show');
}
function certificateTab(){
    $('[href="#qc_tab"]').tab('show');
}
function qcTab(){
    $('[href="#employee_tab"]').tab('show');
}
</script>


