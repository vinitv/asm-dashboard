<!DOCTYPE html>
<html>
<head>
	<title>WPM Dashboard</title>

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs-3.3.6/jqc-1.12.3/dt-1.10.12/fh-3.1.2/r-2.1.0/sc-1.4.2/datatables.min.css"/>

	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-T8Gy5hrqNKT+hzMclPo118YTQO6cYprQmhrYwIiQ/3axmI1hQomh7Ud2hPOy8SP1" crossorigin="anonymous">
	<script type="text/javascript" src="https://cdn.datatables.net/v/bs-3.3.6/jqc-1.12.3/dt-1.10.12/fh-3.1.2/r-2.1.0/sc-1.4.2/datatables.min.js"></script>
	<link href="resources/css/custom.css" rel="stylesheet" />

	<script type="text/javascript">
		function startTables(){
			$('[data-toggle="tooltip"]').tooltip();

			$('.mychecks').DataTable({

				"order": [[ 5, "desc" ]],
				"columnDefs": [
				{
					"targets": [ 5 ],
					"visible": false
				},
				{
					"targets": [ 3 ],
					"sortable": false
				}
				]
			} );
		}


		$(document).ready(function() {
			$(".loader").fadeOut("slow");

			$('#fetchChecks').click(function(){

				$(".loader").show();
				$('#show-results').empty();
				var myDataVar = { allChecks : $('#checkDetails').val(),mySilo : $('#pickSilo').val()};
				var saveData = $.ajax({
					type: "POST",
					url: "resources/handler/getChecks.php",
					data: myDataVar,
					dataType: "text",
					success: function(resultData){
						$('#show-results').append(resultData);
						$(".loader").fadeOut("slow");
						startTables();
					}
				});

				saveData.error(function() { console.log("Something went wrong. Check the format of the keys entered."); });

			});


		} );
	</script>

</head>
<body>
	<div class="loader"></div>


	<div class="container">



		<div class="row">

			<div class="col-sm-12">


				<h1>WPM Checks</h1>


				<div class="form-group">
					<label for="comment">API Keys:</label>
					<textarea class="form-control" rows="5" id="checkDetails" placeholder="APIKEY:Label,APIKEY:Label,.."></textarea>


				</div>
				<div class="container">
				<div class="pull-left">
						<select id="pickSilo" class="form-control"><option value="">Silo #1</option><option value="2">Silo #2</option><option value="3">Silo #3</option><option value="4">Silo #4</option></select>
					</div>
					<div class="btn-group pull-right">
						<button type="button" id="fetchChecks" class="btn btn-lg btn-success">Fetch</button>
					</div>

				</div>

				<div id="show-results"><!-- --></div>



			</div>



		</div>

		<footer class="blog-footer">

			<p>
				<a href="#">Back to top</a>
			</p>
		</footer>


	</body>
	</html>