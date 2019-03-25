@extends('admin_access.layout.master')

@section('style')

@endsection

@section('content')

<h3>User Group List 
    @if($access->CREATE == 1)
    <a href="#" data-toggle="modal" data-target="#modal_add_content" class="btn btn-primary btn-sm pull-right" data-form="{{ route('create_group') }}">{{ trans('common.add_new') }} <i class="fa fa-plus"></i></a>
    @endif
</h3>
<div class="portlet light bordered">
    <div class="portlet-body contentArea">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th style="width:8px;">#</th>
                    <th>Group Name</th>
                    <th style="width: 70px;"></th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($groups as $key => $group) {
                    $group_levels = DB::table('sa_ug_level')->where('USERGRP_ID', '=', $group->USERGRP_ID)->get();
                    ?>
                    <tr>
                        <td>{{ $key +1 }}</td>
                        <td>
                            <div class="panel-group accordion" id="accordion3">
                                <div class="panel panel-default">
                                    <h4 class="panel-title">
                                        <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion3" href="#collapse_3_<?php echo $key; ?>"><?php echo $group->USERGRP_NAME . " " . (!empty($group_levels) ? "(" . count($group_levels) . ")" : ""); ?> </a>
                                        <span class="rht rightLabel">
                                            <?php
                                            if (empty($group_levels)) {
                                                echo "<span style='color:#999999; font-size:10px; font-style:italic; margin-left:20px;'>No Level Created So Far</span>";
                                            }
                                            ?>
                                        </span>
                                    </h4>
                                    <div id="collapse_3_<?php echo $key; ?>" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <?php
                                            if (!empty($group_levels)) {
                                                foreach ($group_levels as $group_level) {
                                                    ?>
                                                    <li><?php echo $group_level->UGLEVE_NAME; ?></li>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            @if($access->CREATE == 1)
                            <a href="#" data-toggle="modal" data-target="#modal_add_content" class="btn btn-primary btn-xs pull-right" data-form="{{ route('create_group_level',  $group->USERGRP_ID) }}">Add Level</a>
                            @endif
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

@endsection