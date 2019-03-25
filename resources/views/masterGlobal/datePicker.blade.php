<script>
//    $(document).ready(function () {
//        $('.date-picker').datepicker({
//            uiLibrary: 'bootstrap'
//        });
//    });

    $(document).ready(function () {
        var minDate = "<?php echo session('startDate'); ?>";
        var maxDate = "<?php echo session('endDate'); ?>";
        $('.date-picker').datepicker({
            uiLibrary: 'bootstrap',
            minDate: new Date(minDate),
            maxDate: new Date(maxDate)

        });
    });
    $(document).ready(function () {
        $('.end-date').datepicker({
            uiLibrary: 'bootstrap'
        });
    });
</script>