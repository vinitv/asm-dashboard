<!DOCTYPE html>
<html>
<head>
	<title>WPM Dashboard</title>

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-T8Gy5hrqNKT+hzMclPo118YTQO6cYprQmhrYwIiQ/3axmI1hQomh7Ud2hPOy8SP1" crossorigin="anonymous">

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/jq-2.2.4/jszip-2.5.0/pdfmake-0.1.18/dt-1.10.13/af-2.1.3/b-1.2.4/b-colvis-1.2.4/b-flash-1.2.4/b-html5-1.2.4/b-print-1.2.4/cr-1.3.2/fc-3.2.2/r-2.1.0/sc-1.4.2/se-1.2.0/datatables.min.css"/>
 
<script type="text/javascript" src="https://cdn.datatables.net/v/bs/jq-2.2.4/jszip-2.5.0/pdfmake-0.1.18/dt-1.10.13/af-2.1.3/b-1.2.4/b-colvis-1.2.4/b-flash-1.2.4/b-html5-1.2.4/b-print-1.2.4/cr-1.3.2/fc-3.2.2/r-2.1.0/sc-1.4.2/se-1.2.0/datatables.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>



	<link href="resources/css/custom.css" rel="stylesheet" />

	<script type="text/javascript">
		function startTables(){
			//$('[data-toggle="tooltip"]').tooltip();

			$('.mychecks').DataTable({

				"order": [[ 5, "desc" ]],
				dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
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
					//	startExport();
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

			<nav class="navbar navbar-default">
			  <div class="container-fluid">
			    <div class="navbar-header">
			      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
			        <span class="sr-only">Toggle navigation</span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			      </button>
			      
			    </div>

			    <!-- Collect the nav links, forms, and other content for toggling -->
			    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			      <ul class="nav navbar-nav">
			       
			        <li class="dropdown">
			          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Tools <span class="caret"></span></a>
			          <ul class="dropdown-menu">
			            <li><a href="index.php">Get Checks</a></li>
			            <li><a href="compare-checks.php">Compare Checks</a></li>
			            <li><a href="check-results.php">Get Slowest</a></li>
			  
			          </ul>
			        </li>
			      </ul>

			 
			    </div><!-- /.navbar-collapse -->
			  </div><!-- /.container-fluid -->
			</nav>

				<h1>Get Checks</h1>


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