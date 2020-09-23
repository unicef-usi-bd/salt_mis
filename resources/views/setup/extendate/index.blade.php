@extends('master')
@section('mainContent')
    <div class="page-header">
        <h1>
            All Setup
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                Extended date
            </small>
        </h1>
    </div><!-- /.page-header -->
    <div class="col-md-12">
            <div class="col-md-12">
                <div class="col-md-6" style="margin-left: 25%;">
                    <div class="form-group">
                        <label  for="inputSuccess" class="col-sm-3 control-label no-padding-right" for="form-field-1-1"><b>Miller Name</b><span style="color: red;"> </span></label>
                        <div class="col-sm-8">
                        <span class="block input-icon input-icon-right">
                            <select id="form-field-select-3 inputSuccess " class="chosen-select millerName form-control" name="MILL_ID" data-placeholder="Select Mill Name">
                               <option value="">-Select-</option>
                                @foreach($millerId as $row)
                                    <option value="{{$row->MILL_ID}}">{{ $row->MILL_NAME }}</option>
                                @endforeach
                            </select>
                        </span>
                        </div>
                    </div>
                </div>
            </div>
        <br>
        <br>

        <div class="row" style="margin-top: 20px; margin-left: -37px; width: 1185px;">
            <div class="col-sm-12">
                <div class="col-sm-12">

                    <div class="tab-content">

                        <div class="row tblReport" style="padding-left: 10px;padding-right: 10px;">

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


    @include('masterGlobal.chosenSelect')
    @include('masterGlobal.datePicker')
    <script>
        $(document).on('change','.millerName',function () {
            let mill_id = $(this).val();
            let _token = '{{ csrf_token() }}';
            $.ajax({
                type: 'POST',
                url:'{{ url('extended-date/miller-info') }}',
                data:{'mill_id':mill_id,_token: _token},
                success:function (data) {
                    $('.tblReport').html(data.html);
                }
            });
        });
    </script>




@endsection

