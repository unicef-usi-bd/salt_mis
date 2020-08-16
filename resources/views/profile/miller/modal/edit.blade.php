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
            <li class=""> <a data-toggle="tab" href="#entrepreneur"> Entrepreneur Information  </a> </li>
            <li class=""> <a data-toggle="tab" href="#certificate">  Certificate Information </a> </li>
            <li class=""> <a data-toggle="tab" href="#qc"> QC Information </a> </li>
            <li class=""> <a data-toggle="tab" href="#employee"> Employee Information </a> </li>
        </ul>

        <div class="tab-content">
            {{--Mill Info--}}
            @include('profile.miller.modal.edit.millInformation')
            {{--/-Miller Info--}}

            {{--Entrepreneur Information--}}
            @include('profile.miller.modal.edit.entrepreneurInformation')
            {{--/-Entrepreneur Information--}}

            {{--Certificate Info--}}
            @include('profile.miller.modal.edit.certificateInformation')
            {{--/-Certificate Info--}}

            {{--QC Info--}}
            @include('profile.miller.modal.edit.qcInformation')
            {{--/- QC Info--}}

            {{--Employee Info--}}
            @include('profile.miller.modal.edit.employeeInformation')
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
@include('masterGlobal.getMillersId')
@include('masterGlobal.locationMapping')
<script src="{{ asset('assets/js/select2.min.js') }}"></script>
<script>
    // Fore Remove Row By Click
    $(document).on("click", "span.rowRemove ", function () {
        $(this).closest("tr.removableRow").remove();
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
    // Owner type wise enterprenur info handling
    $(document).on('change', '.OWNER_TYPE_ID', function () {
        let ownerType = parseInt($(this).val()||0);
        if(ownerType===12){
            $('.rowAddEntrepreneur').hide();
        }else{
            $('.rowAddEntrepreneur').hide();
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
                    }
                }
            })
        }
    });

</script>
<!--Add New Group Modal Start-->
@include('masterGlobal.ajaxFormSubmit')





