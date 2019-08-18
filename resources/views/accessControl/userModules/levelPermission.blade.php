<div class="col-md-8 assignMbox">
    <div class="col-md-5" style="padding: 0px;font-size: 16px;"><a href="#">Modules</a></div>
    <div class="col-md-7 ActionHeader">
        <span>Create</span>
        <span>View</span>
        <span>Update</span>
        <span>Delete</span>
        <span>Status</span>
    </div>
    <ul style="margin-top: 30px;">
        @foreach($modules as $module)
            <li class="moduleTop"> <a href="#">{{ $module->MODULE_NAME }}</a></li>
            <li class="module_link">
                <ul>
                    @foreach($moduleLinks as $moduleLink)
                        @if($moduleLink->MODULE_ID==$module->MODULE_ID)
                            @if(Auth::user()->id==1)
                                <li>
                                    <div class="col-md-5" style="padding: 0px;">{{ $moduleLink->LINK_NAME }} </div>
                                    <div class="col-md-7 checkbox_style">
                                        <label><input type="checkbox" {{ $moduleLink->OP_CREATE==0?'disabled':'' }} class="chkUserPermission" {{ $moduleLink->CREATE==1?'checked':'' }} value="{{ $orgId.','.$userGroupId . ','.$userGroupLevelId.','. $module->MODULE_ID . ',' . $moduleLink->LINK_ID .  ',' . $moduleLink->ORG_MLINKS_ID . ',' . 'C' }}"></label>
                                        <label><input type="checkbox" {{ $moduleLink->OP_READ==0?'disabled':'' }} class="chkUserPermission" {{ $moduleLink->READ==1?'checked':'' }} value="{{ $orgId.','.$userGroupId . ','.$userGroupLevelId.','. $module->MODULE_ID . ',' . $moduleLink->LINK_ID . ',' . $moduleLink->ORG_MLINKS_ID . ',' . 'V' }}"></label>
                                        <label><input type="checkbox" {{ $moduleLink->OP_UPDATE==0?'disabled':'' }} class="chkUserPermission" {{ $moduleLink->UPDATE==1?'checked':'' }} value="{{ $orgId.','.$userGroupId . ','.$userGroupLevelId.','. $module->MODULE_ID . ',' . $moduleLink->LINK_ID . ',' . $moduleLink->ORG_MLINKS_ID . ',' . 'U' }}"></label>
                                        <label><input type="checkbox" {{ $moduleLink->OP_DELETE==0?'disabled':'' }} class="chkUserPermission" {{ $moduleLink->DELETE==1?'checked':'' }} value="{{ $orgId.','.$userGroupId . ','.$userGroupLevelId.','. $module->MODULE_ID . ',' . $moduleLink->LINK_ID . ',' . $moduleLink->ORG_MLINKS_ID . ',' . 'D' }}"></label>
                                        <label><input type="checkbox" {{ $moduleLink->OP_STATUS==0?'disabled':'' }} class="chkUserPermission" {{ $moduleLink->STATUS==1?'checked':'' }} value="{{ $orgId.','.$userGroupId . ','.$userGroupLevelId.','. $module->MODULE_ID . ',' . $moduleLink->LINK_ID . ',' . $moduleLink->ORG_MLINKS_ID . ',' . 'S' }}"></label>
                                    </div>
                                    <hr style="padding: 0px;width: 100%;margin-bottom: 3px;">
                                </li>
                            @else
                                @if($moduleLink->LINK_ID!=175)
                                <li>
                                    <div class="col-md-5" style="padding: 0px;">{{ $moduleLink->LINK_NAME }} </div>
                                    <div class="col-md-7 checkbox_style">
                                        <label><input type="checkbox" {{ $moduleLink->OP_CREATE==0?'disabled':'' }} class="chkUserPermission" {{ $moduleLink->CREATE==1?'checked':'' }} value="{{ $orgId.','.$userGroupId . ','.$userGroupLevelId.','. $module->MODULE_ID . ',' . $moduleLink->LINK_ID .  ',' . $moduleLink->ORG_MLINKS_ID . ',' . 'C' }}"></label>
                                        <label><input type="checkbox" {{ $moduleLink->OP_READ==0?'disabled':'' }} class="chkUserPermission" {{ $moduleLink->READ==1?'checked':'' }} value="{{ $orgId.','.$userGroupId . ','.$userGroupLevelId.','. $module->MODULE_ID . ',' . $moduleLink->LINK_ID . ',' . $moduleLink->ORG_MLINKS_ID . ',' . 'V' }}"></label>
                                        <label><input type="checkbox" {{ $moduleLink->OP_UPDATE==0?'disabled':'' }} class="chkUserPermission" {{ $moduleLink->UPDATE==1?'checked':'' }} value="{{ $orgId.','.$userGroupId . ','.$userGroupLevelId.','. $module->MODULE_ID . ',' . $moduleLink->LINK_ID . ',' . $moduleLink->ORG_MLINKS_ID . ',' . 'U' }}"></label>
                                        <label><input type="checkbox" {{ $moduleLink->OP_DELETE==0?'disabled':'' }} class="chkUserPermission" {{ $moduleLink->DELETE==1?'checked':'' }} value="{{ $orgId.','.$userGroupId . ','.$userGroupLevelId.','. $module->MODULE_ID . ',' . $moduleLink->LINK_ID . ',' . $moduleLink->ORG_MLINKS_ID . ',' . 'D' }}"></label>
                                        <label><input type="checkbox" {{ $moduleLink->OP_STATUS==0?'disabled':'' }} class="chkUserPermission" {{ $moduleLink->STATUS==1?'checked':'' }} value="{{ $orgId.','.$userGroupId . ','.$userGroupLevelId.','. $module->MODULE_ID . ',' . $moduleLink->LINK_ID . ',' . $moduleLink->ORG_MLINKS_ID . ',' . 'S' }}"></label>
                                    </div>
                                    <hr style="padding: 0px;width: 100%;margin-bottom: 3px;">
                                </li>
                                @endif
                            @endif
                        @endif
                    @endforeach
                </ul>
            </li>
        @endforeach
    </ul>
</div>