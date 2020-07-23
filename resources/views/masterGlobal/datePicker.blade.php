<script>
    $(document).ready(function () {
        let minDate = "<?php echo session('startDate'); ?>";
        let maxDate = "<?php echo session('endDate'); ?>";
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
