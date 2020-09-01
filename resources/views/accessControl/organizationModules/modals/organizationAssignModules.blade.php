<style>
    .dual-list .list-group {
        margin-top: 8px;
    }
    .well{
        min-height: 250px;
    }

    .list-left li, .list-right li {
        cursor: pointer;
    }

    .list-arrows {
        padding-top: 100px;
    }

    .list-arrows button {
        margin-bottom: 20px;
    }
</style>
<div class="assignedModule alert alert-success alert-dismissible" style="display: none;">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Success!</strong> Assigned Modules Successfully
</div>
<div class="removedModule alert alert-success alert-dismissible" style="display: none;">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Success!</strong> Removed Modules Successfully
</div>
<div class="col-md-12">
    <div class="dual-list list-left col-md-5">
        <div class="well text-right">
            <div class="row">
                <div class="col-md-10">
                    <div class="input-group" style="width: 100%">
                        <input autocomplete="off" type="text" name="SearchDualList" class="form-control" placeholder="Search" style="padding-left:10px;margin-top: 2px;width: 100%"/>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="btn-group" style="margin-left: -20px !important;">
                        <a class="btn btn-info selector" title="select all"><i class="glyphicon glyphicon-unchecked"></i></a>
                    </div>
                </div>
            </div>
            <ul class="list-group">
                @foreach($modules as $module)
                    @if($module->IS_EXIST_OR_ACTIVE!=1)
                    <li class="list-group-item" data-id="{{ $module->MODULE_ID }}">{{ $module->MODULE_NAME }}</li>
                    @endif
                @endforeach
            </ul>
        </div>
    </div>

    <div class="list-arrows col-md-2 text-center">
        <button class="btn btn-primary btn-sm move-right">
            <span class="glyphicon glyphicon-chevron-right"></span>
        </button>
<br>
        <button class="btn btn-primary btn-sm move-left">
            <span class="glyphicon glyphicon-chevron-left"></span>
        </button>
    </div>

    <div class="dual-list list-right col-md-5">
        <div class="well">
            <div class="row">
                <div class="col-md-2">
                    <div class="btn-group">
                        <a class="btn btn-info selector" title="select all"><i class="glyphicon glyphicon-unchecked"></i></a>
                    </div>
                </div>
                <div class="col-md-10">
                    <div class="input-group" style="width: 100%">
                        <input autocomplete="off" type="text" name="SearchDualList" class="form-control" placeholder="Search"  style="padding-left:10px;margin-top: 2px;width: 100%" />
                    </div>
                </div>
            </div>
            <ul class="list-group">
                @foreach($orgModules as $orgModule)
                    <li class="list-group-item" data-id="{{ $orgModule->MODULE_ID }}"> {{ $orgModule->MODULE_NAME }} </li>
                @endforeach
            </ul>
        </div>
    </div>

</div>

<script>
    $(function () {

        $('body').on('click', '.list-group .list-group-item', function () {
            $(this).toggleClass('active');
        });
        $('.list-arrows button').click(function () {
            var $button = $(this), actives = '';
            if ($button.hasClass('move-left')) {
                actives = $('.list-right ul li.active');
                var modulesId = [];
                for(var i=0;i<actives.length;i++){
                    modulesId[i] = actives.eq(i).attr("data-id");
                }
                actives.clone().appendTo('.list-left ul');
                actives.remove();
                //                =========================== My script==============
                $.ajax({
                    type : "get",
                    url  : "org-remove-mdl-ajax/1",
                    data : {'modulesId': modulesId},
                    success:function (data) {
//                        alert(data);
                        $('.assignedModule').hide();
                        $('.removedModule').hide().fadeIn();
                    }
                });
            } else if ($button.hasClass('move-right')) {
                actives = $('.list-left ul li.active');
                var modulesId = [];
                for(var i=0;i<actives.length;i++){
                    modulesId[i] = actives.eq(i).attr("data-id");
                }
                actives.clone().appendTo('.list-right ul');
                actives.remove();
//                =========================== My script==============
                $.ajax({
                    type : "get",
                    url  : "org-assign-mdl-ajax/1",
                    data : {'modulesId': modulesId},
                    success:function (data) {
//                        alert(data);
                        $('.removedModule').hide();
                        $('.assignedModule').hide().fadeIn();
                    }
                });
            }
        });
        $('.dual-list .selector').click(function () {
            var $checkBox = $(this);
            if (!$checkBox.hasClass('selected')) {
                $checkBox.addClass('selected').closest('.well').find('ul li:not(.active)').addClass('active');
                $checkBox.children('i').removeClass('glyphicon-unchecked').addClass('glyphicon-check');
            } else {
                $checkBox.removeClass('selected').closest('.well').find('ul li.active').removeClass('active');
                $checkBox.children('i').removeClass('glyphicon-check').addClass('glyphicon-unchecked');
            }
        });
        $('[name="SearchDualList"]').keyup(function (e) {
            var code = e.keyCode || e.which;
            if (code == '9') return;
            if (code == '27') $(this).val(null);
            var $rows = $(this).closest('.dual-list').find('.list-group li');
            var val = $.trim($(this).val()).replace(/ +/g, ' ').toLowerCase();
            $rows.show().filter(function () {
                var text = $(this).text().replace(/\s+/g, ' ').toLowerCase();
                return !~text.indexOf(val);
            }).hide();
        });

    });
</script>
