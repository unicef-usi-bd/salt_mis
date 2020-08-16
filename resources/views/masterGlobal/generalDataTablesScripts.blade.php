{{--Data table Scripts--}}
<script src="{{ asset('assets/dataTable/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/dataTable/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/dataTable/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/dataTable/buttons.bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/dataTable/jszip.min.js') }}"></script>
<script src="{{ asset('assets/dataTable/pdfmake.min.js') }}"></script>
<script src="{{ asset('assets/dataTable/vfs_fonts.js') }}"></script>
<script src="{{ asset('assets/dataTable/buttons.html5.min.js') }}"></script>
<script src="{{ asset('assets/dataTable/buttons.print.min.js') }}"></script>
<script src="{{ asset('assets/dataTable/buttons.colVis.min.js') }}"></script>

<script type="text/javascript">
    //         Data table print
    let logoDir = '{{ url(Session::get('orgLogo')) }}';
    let orgName ='{{ Session::get('orgName') }}';
    let tableName = $('.table').attr('title');
    let dataTables = $('.gridTable').DataTable( {
        dom: 'Blfrtip',
        buttons: [
            {
                extend: 'print',
                text: '<i class="fa fa-print"></i> Print',
                title: '',
                messageTop: tableName,
                className: 'btn btn-xs btn-outline btn-success',
                exportOptions: {
                    columns: ':visible',

                },
                customize: function ( win ) {
                    $(win.document.body)
                        .css( 'font-size', '12pt' )
                        .prepend(
                            '<div><img src="'+logoDir+'" class="img-responsive center-block" height="80px" width="70px"></div>' +
                            '<div style="text-align: center;margin-top: -8px;margin-bottom: -20px;"><h3>'+orgName+'</h3></div>'
                        );
                },
                footer: true,
                autoPrint: true,

            },
            {
                extend: 'pdf',
                text: '<i class="fa fa-file-reportPdf-o"></i> Pdf',
                className: 'btn btn-xs btn-outline btn-danger',
                title: $('h1').text(),
                exportOptions: {
                    columns: ':visible',
                } ,
                footer: true
            },
            {
                extend: 'excel',
                text: '<i class="fa fa-file-excel-o"></i> Excel',
                className: 'btn btn-xs btn-outline btn-warning',
                title: $('h1').text(),
                exportOptions: {
                    columns: ':visible',
                } ,
                footer: true
            },
            {
                extend: 'csv',
                text: '<i class="fa fa-file"></i> Csv',
                className: 'btn btn-xs btn-outline btn-info',
                title: $('h1').text(),
                exportOptions: {
                    columns: ':visible',
                } ,
                footer: true
            },
            {
                extend: 'colvis',
                text: '<i class="fa fa-eye"></i> Visible',
                title: $('h1').text(),
                className: 'btn btn-xs btn-outline btn-primary',
                exportOptions: {
                    columns: ':visible',
                },
                footer: true,
                autoPrint: true,
            },
        ],
    });

    let hasTools = $('table.gridTable').attr('data-tools') || true;
    if(hasTools==='false') $(document).find('div.dt-buttons').remove();
    //        Data table print
</script>
