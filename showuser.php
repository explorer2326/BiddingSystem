<!DOCTYPE html>
<html lang="en">
    
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">        
    
        <!-- add jQuery library and css file -->
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
        <script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    </head>

    <body>    	
	    <table id="users" class="display" cellspacing="0" width="100%">
	        <thead>
	            <tr>
	                <th>Name</th>
	                <th>Password</th>
	                <th>Edit</th>
	            </tr>
	        </thead>
	        <tfoot>
	            <tr>
	                <th>Name</th>
	                <th>Password</th>
	                <th>Edit</th>
	            </tr>
	        </tfoot>       
        </table>
        <hr>
        <button style="font-size:large" onclick="window.location.href='login&regis/logout.php'">Back to Login</button>

        <script type="text/javascript" language="javascript">
	         $(document).ready(function() {
			    var dataTable = $('#users').DataTable( {
			        "processing": true,
			        "serverSide": true,
			        "ajax": {
			        	url: "ManageUser.php",
			        	type: "post"
			    	},
			    } );
			    console.log(dataTable);

		        $('#search_text').keyup(function(){
		          	dataTable.search($(this).val()).draw();
		        })
			});
		</script>
    </body>
</html>



