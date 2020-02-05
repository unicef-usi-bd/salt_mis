<div id="myModal" class="modal" tabindex="-1">
    <div class="modal-dialog removeModalClass">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="blue bigger pageTitle"></h4>
            </div>

            <div class="modal-body">
                {{--Custom Alert for Ajax form submit--}}
                <div class="col-md-12 alert-handler">
                    {{--Custom Alert Here--}}
                </div>
                <div class="row printFormGlobal">
                    {{--Modal Global Form Here--}}
                </div>
            </div>

            <div class="modal-footer">
                <button class="btn btn-sm" data-dismiss="modal">
                    <i class="ace-icon fa fa-times"></i>
                    {{ trans('dashboard.cancel') }}
                </button>
                {{--<button class="btn btn-sm btn-primary">--}}
                    {{--<i class="ace-icon fa fa-check"></i>--}}
                    {{--Save--}}
                {{--</button>--}}
            </div>
        </div>
    </div>
</div><!-- PAGE CONTENT ENDS -->

<script>
    $(document).on("click", ".showModalGlobal", function () {
//        For Remove Existing Modal Size
        var isMdSize = ['modal-md', 'modal-lg', 'modal-bg'];
        for (var i= 0; i < isMdSize.length; i++) {
            var check = $('.removeModalClass').hasClass(isMdSize[i]);
            if(check==true){
                $('.removeModalClass').removeClass(isMdSize[i])
            }
        }
        var modalSize = $(this).attr("modal-size");
        $('.modal-dialog').addClass(modalSize);
        var pageTitle = $(this).attr("title") ;
        $(".modal-header .pageTitle").html(pageTitle);
        var routUrl = $(this).attr("id") ;
        var destination = '{{url("/")}}'+'/'+routUrl;
//        Check Permistion
        var permission = $(this).attr('data-permission');
       // console.log(permission);
        if(permission != 1) {
            $('div.printFormGlobal').html('<h3 style="text-align: center;color: red;">You have No Permission For This Action</h3>');
        } else {
            $.ajax({
                type: "GET",
                url: destination,
                success: function (data) {
//                alert(data);exit();
                    $("div.printFormGlobal").html(data);

                }
            });
        }
    });
    
    $('#myModal').on('hidden.bs.modal', function () {
      window.location.reload();
    });

</script>
