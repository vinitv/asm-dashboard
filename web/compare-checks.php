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

		$(document).ready(function() {
			$(".loader").fadeOut("slow");

			$('#fetchChecks').click(function(){

				$(".loader").show();
				$('#show-results').empty();
				var myDataVar = { allChecks1 : $('#checkDetails1').val(),allChecks2 : $('#checkDetails2').val(),allCount : $('#allCount').val()};
				var saveData = $.ajax({
					type: "POST",
					url: "resources/handler/compareChecks.php",
					data: myDataVar,
					dataType: "json",
					success: function(resultData){
						$('#show-results').append(resultData);
						$(".loader").fadeOut("slow");
						
						drawGraph(resultData);

					}
				});

				saveData.error(function() { console.log("Something went wrong. Check the format of the keys entered."); });

			});



function drawGraph(resultData){

            var  sampleData = resultData;
            var settings = {
                title: "Check Compare",
                description: "ASM Check Response Time",
                padding: { left: 5, top: 5, right: 5, bottom: 5 },
                titlePadding: { left: 90, top: 0, right: 0, bottom: 10 },
                source: sampleData,
                showLegend: true,
                enableAnimations: true,
                categoryAxis:
                    {
                      
                        showGridLines: true
                    },
                colorScheme: 'scheme01',
       
                seriesGroups:
                    [
                        {
                            type: 'line',
                    
                            
                            series: [
                                    { dataField: 'A', displayText: 'Response Time A'},
                                    {dataField: 'B', displayText: 'Response Time B'}
                                ]
                        }
                    ]
            };

            $('#chartContainer1').jqxChart(settings);
}



		} );
	</script>

	<link rel="stylesheet" href="resources/vendor/jqwidgets/styles/jqx.base.css" type="text/css" />
    <script type="text/javascript" src="resources/vendor/jqwidgets/jqxcore.js"></script>
    <script type="text/javascript" src="resources/vendor/jqwidgets/jqxdata.js"></script>
    <script type="text/javascript" src="resources/vendor/jqwidgets/jqxdraw.js"></script>
    <script type="text/javascript" src="resources/vendor/jqwidgets/jqxchart.core.js"></script>

</head>
<body>
	<div class="loader"></div>


	<div class="container">



		<div class="row">

			<div class="col-sm-12">


				<h1>Compare Checks</h1>


				<div class="form-group">
				<!--	<label for="comment">API Key:</label>
					<input class="form-control" id="apiKeys" placeholder="APIKEY"></textarea><br/>-->
					<label for="comment">API URLs A &amp; B:</label>
					<input class="form-control"  id="checkDetails1" placeholder="Full URL A"></input><br/>
					<input class="form-control"  id="checkDetails2" placeholder="Full URL B"></input>


				</div>
				<div class="container">
				<div class="pull-left">
				<label for="allCount">Recent n results</label>
						<select id="allCount" class="form-control">
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
						<option value="6">6</option>
						<option value="7">7</option>
						<option value="8">8</option>
						<option value="9">9</option>
						<option value="10">10</option>
						<option value="11">11</option>
						<option value="12">12</option>
						<option value="13">13</option>
						<option value="14">14</option>
						<option value="15">15</option>
						<option value="16">16</option>
						<option value="17">17</option>
						<option value="18">18</option>
						<option value="19">19</option>
						<option value="20">20</option>
						<option value="21">21</option>
						<option value="22">22</option>
						<option value="23">23</option>
						<option value="24">24</option>
						<option value="25">25</option>
						<option value="26">26</option>
						<option value="27">27</option>
						<option value="28">28</option>
						<option value="29">29</option>
						<option value="30">30</option>
						<option value="31">31</option>
						<option value="32">32</option>
						<option value="33">33</option>
						<option value="34">34</option>
						<option value="35">35</option>
						<option value="36">36</option>
						<option value="37">37</option>
						<option value="38">38</option>
						<option value="39">39</option>
						<option value="40">40</option>
						<option value="41">41</option>
						<option value="42">42</option>
						<option value="43">43</option>
						<option value="44">44</option>
						<option value="45">45</option>
						<option value="46">46</option>
						<option value="47">47</option>
						<option selected="selected" value="48">48</option>

						</select> 
					</div>
					<div class="btn-group pull-right">
						<button type="button" id="fetchChecks" class="btn btn-lg btn-success">Fetch</button>
					</div>
<br/>
				</div>

				<div id="show-results"><!-- --></div>
 <div id='chartContainer1' style="width:100%; height:500px">
    </div>
 


			</div>



		</div>

		<footer class="blog-footer">

			<p>
				<a href="#">Back to top</a>
			</p>
		</footer>


	</body>
	<script type="text/javascript" src="resources/js/filesaver.min.js"></script>
	<script type="text/javascript" src="resources/js/tableexport.min.js"></script>

	</html>