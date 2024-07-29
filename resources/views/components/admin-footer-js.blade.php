<!-- Bootstrap JS -->
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
<!--plugins-->
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/plugins/simplebar/js/simplebar.min.js') }}"></script>
<script src="{{ asset('assets/plugins/metismenu/js/metisMenu.min.js') }}"></script>
<script src="{{ asset('assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
<script src="{{ asset('assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js') }}"></script>
<script src="{{ asset('assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
<script src="{{ asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>
<script src="{{ asset('assets/plugins/chartjs/js/Chart.min.js') }}"></script>
<script src="{{ asset('assets/plugins/chartjs/js/Chart.extension.js') }}"></script>
<script src="{{ asset('assets/js/index.js') }}"></script>
<!--Validation-->
<script src="{{ asset('assets/js/parsley.min.js') }}"></script>
<!--app JS-->
<script src="{{ asset('assets/js/app.js') }}"></script>
<script src="{{ asset('assets/snackbar/dist/js-snackbar.min.js') }}"></script>
<script src="{{ asset('assets/plugins/Multiple-Select-With-Checkboxes/src/jquery.multi-select.js') }}"></script>

<script type="text/javascript">
    $(function () {
        $('.multiSelect').multiSelect();
    });
</script>

<script type="text/javascript">
    /*** For initialize the data table */
    $(document).ready(function() {
        $('#example').DataTable();
    } );
    $(document).ready(function() {
        var table = $('#example2').DataTable( {
            lengthChange: false,
            buttons: [ 'copy', 'excel', 'pdf', 'print']
        } );
        
        table.buttons().container()
            .appendTo( '#example2_wrapper .col-md-6:eq(0)' );
    } );
</script>

<script type="text/javascript">
    /*** For save data */
    $(document).ready( function() {
        $("#formSubmit").on('submit', function(e) {
            if( $(this).parsley().validate() ) {
                e.preventDefault(); 
                var formdata = new FormData(this);
                let html = '<button class="btn btn-primary" type="button" disabled=""> <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...</button>';
                let btn = $("#submitButton").html();
                $.ajax({
                    type: 'POST',
                    url: $(this).attr('action'),
                    data: formdata,
                    cache: false,
                    contentType: false,
                    processData: false,
                    beforeSend: function() {
                        $("#submitButton").html(html);
                    },
                    success: function( result ) {
                        SnackBar({
                            status:result.status,
                            message:result.message,
                            position: "br"
                        });
                        $("#submitButton").html(btn);
                        if(result.data.reload) {
                            location.reload();
                        }
                        if(result.data.url) {
                            location.href = result.data.url;
                        }
                    },
                    error: function(result) {
                        SnackBar({
                            status:result.status,
                            message:result.message,
                            position: "br"
                        });
                        $("#submitButton").html(btn);
                    }
                });
            }
        });
    });
    /*** For Delete Data */
    function deleteData( id, table ) {
        if(confirm('Are you sure want to delete?') == true) {
            $.ajax({
                type: 'GET',
                url: "{{ url('admin/deleteData') }}/"+id+"/"+table,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $(".delete_"+id+" i").removeClass('fadeIn animated bx bx-trash').addClass('spinner-border spinner-border-sm');
                },
                success: function( result ) {
                    SnackBar({
                        status:result.status,
                        message:result.message,
                        position: "br"
                    });
                    $(".delete_"+id+" i").addClass('fadeIn animated bx bx-trash').removeClass('spinner-border spinner-border-sm');
                    if(result.data.reload) {
                        location.reload();
                    }
                },
                error: function(result) {
                    SnackBar({
                        status:result.status,
                        message:result.message,
                        position: "br"
                    });
                    $(".delete_"+id+" i").addClass('fadeIn animated bx bx-trash').removeClass('spinner-border spinner-border-sm');
                }
            });
        }
    }
</script>