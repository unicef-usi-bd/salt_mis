<style>
    .chosen-container-single .chosen-single {
        border-radius: 0;
        height: 35px;
        padding: 5px 4px 6px;
        border: 1px solid #D5D5D5;
        font-size: 14px;
        background: none;
    }
    .chosen-container-single .chosen-single div {
        margin-top: 5px;
    }
    .chosen-container-single .chosen-single abbr {
        margin-top: 5px;
    }
</style>
<!-- page specific plugin scripts -->
<script src="{{ asset('assets/js/chosen.jquery.min.js') }}"></script>
<!-- inline scripts related to this page -->
<script type="text/javascript">
    jQuery(function($) {
        if(!ace.vars['touch']) {
            $('.chosen-select').chosen({allow_single_deselect:true});
            //resize the chosen on window resize
            $(window)
                .off('resize.chosen')
                .on('resize.chosen', function() {
                    $('.chosen-select').each(function() {
                        var $this = $(this);
                        $this.next().css({'width': $this.parent().width()});
                    })
                }).trigger('resize.chosen');
            //resize chosen on sidebar collapse/expand
            $(document).on('settings.ace.chosen', function(e, event_name, event_val) {
                if(event_name != 'sidebar_collapsed') return;
                $('.chosen-select').each(function() {
                    var $this = $(this);
                    $this.next().css({'width': $this.parent().width()});
                })
            });
        }
    });
</script>