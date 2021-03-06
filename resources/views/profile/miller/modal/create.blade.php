<style>
    .chosen-container { width: 100% !important; }

    .select2{
        width:100% !important;
    }
    li.disabledTab{
        pointer-events: none;
    }
    li .disabledTab:hover{
        cursor:not-allowed
    }
</style>
<div class="col-md-12">
    <div class="col-md-12">
        <ul class="nav nav-tabs" id="myTab">
            <li class="active"> <a data-toggle="tab" href="#mill"> Mill Information </a> </li>
            <li class="disabledTab"> <a data-toggle="tab" href="#entrepreneur"> Entrepreneur Information  </a> </li>
            <li class="disabledTab"> <a data-toggle="tab" href="#certificate">  Certificate Information </a> </li>
            <li class="disabledTab"> <a data-toggle="tab" href="#qc"> QC Information </a> </li>
            <li class="disabledTab"> <a data-toggle="tab" href="#employee"> Employee Information </a> </li>
        </ul>

        <div class="tab-content">
            {{--Mill Info--}}
            @include('profile.miller.modal.create.millInformation')
            {{--/-Miller Info--}}

            {{--Entrepreneur Information--}}
            @include('profile.miller.modal.create.entrepreneurInformation')
            {{--/-Entrepreneur Information--}}

            {{--Certificate Info--}}
            @include('profile.miller.modal.create.certificateInformation')
            {{--/-Certificate Info--}}

            {{--QC Info--}}
            @include('profile.miller.modal.create.qcInformation')
            {{--/- QC Info--}}

            {{--Employee Info--}}
            @include('profile.miller.modal.create.employeeInformation')
            {{--/- Employee Info--}}
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $(document).on('change', '.insertIdContainer', function () {
            let insertId = $(this).val();
            if(insertId!=='') $('#myTab').find('li').removeClass('disabledTab');
        });
    });

</script>

@include('masterGlobal.chosenSelect')
@include('masterGlobal.locationMapping')
@include('masterGlobal.getMillersId')
<script src="{{ asset('assets/js/select2.min.js') }}"></script>
<script>
    $(document).ready(function(){
        $('.rowAdd').click(function(){
            let getTr = $('tr.rowFirst:first');
            $("select.chosen-select").chosen('destroy');
            $('tbody.newRow').append("<tr class='removableRow'>"+getTr.html()+"</tr>");
            let defaultRow = $('tr.removableRow:last');
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
            $('.chosen-select').chosen(0);
        });
    });

    // Fore Remove Row By Click
    $(document).on("click", "span.rowRemove ", function () {
        let thisRow = $(this).closest("tr");
        let isLast = thisRow.is(":last-child");
        if(!isLast) thisRow.remove();
    });

//    For Certificate and Provider Mapping
    $(document).on('change', '.CERTIFICATE_TYPE_ID', function () {
        let thisRow = $(this).closest('tr');
        let certificateId = $(this).val();
        if(certificateId){
            $.ajax({
                type : 'get',
                url : `certificate/${certificateId}/providers`,
                success: function (data) {
                    thisRow.find('.ISSURE_ID').html(data).trigger("chosen:updated");
                }
            })
        }
    });

    //    Check Duplicate Certificates
    $(document).on('change', '.CERTIFICATE_TYPE_ID', function () {
        let certificateId = $(this).val();
        let duplicates = hasDuplicateCertificate(certificateId);
        if(duplicates){
            let certificateName = $(this).find(":selected").text();
            let message = `${certificateName} certificate already exist.`;
            displayAlertHandler(message, 'danger');
            $(this).val('').trigger('chosen:updated');
        }
    });

    $(document).on('change', '#MILL_TYPE_ID', function () {
        let millType = parseInt($(this).val()||0);
        if(millType){
            $.ajax({
                type : 'get',
                url : `certificate-by-mill-type/${millType}`,
                success: function (data) {
                    if(data){
                        $('.CERTIFICATE_TYPE_ID').html(data).trigger("chosen:updated");
                        $('.ISSURE_ID').val('').trigger("chosen:updated");
                    }
                }
            })
        }
    });

    const hasDuplicateCertificate = (certificateId) => {
        let count = 0;
        let eachCertificateId;
        $('.certificateTable tr').each(function () {
            eachCertificateId = $(this).find('.CERTIFICATE_TYPE_ID').val();
            if(eachCertificateId===certificateId) count++;
            if(count===2) return;
        });
        return count>1;
    }

    // Owner type wise enterprenur info handling
    $(document).on('change', '.OWNER_TYPE_ID', function () {
        let ownerType = parseInt($(this).val()||0);
        if(ownerType===12){
            $('.rowAddEntrepreneur').hide();
        }else{
            $('.rowAddEntrepreneur').show();
        }
    });

</script>



<!--Add New Group Modal Start-->
@include('masterGlobal.locationMapping')
@include('masterGlobal.ajaxFormSubmit')





