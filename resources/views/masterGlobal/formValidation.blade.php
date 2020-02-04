<script>
//    Float Number Validation
    function numbersOnly(sender, evt) {
        let txt = sender.value;
        let dotContainer = txt.split('.');
        let charCode = parseInt((evt.which) ? evt.which : event.keyCode);
        if (!(parseFloat(dotContainer.length) === 1 && charCode === 46) && charCode > 31 && (charCode < 48 || charCode > 57)) return false;
        return true;
    }
</script>

