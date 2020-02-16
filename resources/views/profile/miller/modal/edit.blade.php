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
<script src="{{ asset('assets/js/select2.min.js') }}"></script>
<script>
    $(document).ready(function(){
        $('.rowAdd').click(function(){
            let getTr = $('tr.rowFirst:first');
//            alert(getTr.html());
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
        $(this).closest("tr.removableRow").remove();
    });
</script>



<!--Add New Group Modal Start-->
@include('masterGlobal.getDistrictUpazilaUnion')
@include('masterGlobal.ajaxFormSubmit')





