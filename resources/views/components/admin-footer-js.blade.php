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

<script>
		$(document).ready(function() {
			$('#example').DataTable();
		  } );
	</script>
	<script>
		$(document).ready(function() {
			var table = $('#example2').DataTable( {
				lengthChange: false,
				buttons: [ 'copy', 'excel', 'pdf', 'print']
			} );
		 
			table.buttons().container()
				.appendTo( '#example2_wrapper .col-md-6:eq(0)' );
		} );
	</script>
<script>
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
                        if(result.reload != 'undefined') {
                            location.reload();
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

    function deleteData( id, table ) {
        
    }
</script>