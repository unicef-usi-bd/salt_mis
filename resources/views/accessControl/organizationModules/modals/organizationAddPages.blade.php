<div class="col-md-12">
    <table id="simple-table" class="table  table-bordered table-hover">
        <thead>
        <tr>
            <th width="50%">{{ trans('organizationModule.module_name') }}</th>
            {{--<th>All</th>--}}
            <th>Create</th>
            <th>View</th>
            <th>Update</th>
            <th>Delete</th>
            <th>Status</th>
        </tr>
        </thead>

        <tbody>
        @foreach($modules as $module)
        <tr>
            <td style="background-color: #F8F8F8;" colspan="6">{{ $module->MODULE_NAME }}</td>
        </tr>
        @foreach($moduleLinks as $moduleLink)
            @if($moduleLink->MODULE_ID==$module->MODULE_ID)
                <tr class="center">
                    <td style="text-align: initial;padding-left: 30px;">
                        {{ $moduleLink->LINK_NAME }}
                    </td>
                    {{--<td>--}}
                        {{--<label class="pos-rel">--}}
                            {{-- php--}}
                            {{--if($moduleLink->CREATE==1 && $moduleLink->READ==1 && $moduleLink->UPDATE==1 && $moduleLink->DELETE==1 && $moduleLink->STATUS==1){--}}
                                {{--$allPage = 1;--}}
                            {{--} else{--}}
                                {{--$allPage=0;--}}
                            {{--}--}}
                            {{-- --}}
        {{----}}
                            {{--<input type="checkbox" class="ace arAllPage" {{ $allPage==1?'checked':'' }} value="{{ $orgId . ',' . $module->MODULE_ID . ',' . $moduleLink->LINK_ID . ',' . 'A' }}"/>--}}
                            {{--<span class="lbl"></span>--}}
                        {{--</label>--}}
                    {{--</td>--}}
                    <td>
                        <label class="pos-rel test">
                            <input type="checkbox" class="ace chkAssignPage" {{ $moduleLink->CREATE==1?'checked':'' }} value="{{ $orgId . ',' . $module->MODULE_ID . ',' . $moduleLink->LINK_ID . ',' . 'C' }}"/>
                            <span class="lbl"></span>
                        </label>
                    </td>
                    <td>
                        <label class="pos-rel">
                            <input type="checkbox" class="ace chkAssignPage" {{ $moduleLink->READ==1?'checked':'' }} value="{{ $orgId . ',' . $module->MODULE_ID . ',' . $moduleLink->LINK_ID . ',' . 'V'}}"/>
                            <span class="lbl"></span>
                        </label>
                    </td>
                    <td>
                        <label class="pos-rel">
                            <input type="checkbox" class="ace chkAssignPage" {{ $moduleLink->UPDATE==1?'checked':'' }} value="{{ $orgId . ',' . $module->MODULE_ID . ',' . $moduleLink->LINK_ID . ',' . 'U'}}"/>
                            <span class="lbl"></span>
                        </label>
                    </td>
                    <td>
                        <label class="pos-rel">
                            <input type="checkbox" class="ace chkAssignPage" {{ $moduleLink->DELETE==1?'checked':'' }} value="{{ $orgId . ',' . $module->MODULE_ID . ',' . $moduleLink->LINK_ID . ',' . 'D'}}"/>
                            <span class="lbl"></span>
                        </label>
                    </td>
                    <td>
                        <label class="pos-rel">
                            <input type="checkbox" class="ace chkAssignPage" {{ $moduleLink->STATUS==1?'checked':'' }} value="{{ $orgId . ',' . $module->MODULE_ID . ',' . $moduleLink->LINK_ID . ',' . 'S'}}"/>
                            <span class="lbl"></span>
                        </label>
                    </td>
                </tr>
            @endif
        @endforeach
        @endforeach
        </tbody>
    </table>

</div>


