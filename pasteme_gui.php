<?php

// Should be a simple text area with a paste button. Clicking the button needs to generate a href link to the pasted content.

// There also needs to be a drop down for how long the pasted content is retained for.
// 1 day
// 7 days
// 30 days (default)
// 6 months
// 1 year
// Forever

// Needs to be a ajax interface to prevent page refreshes. 


?>

<!doctype html>
<html>
<head>
	<style type="text/css">
		#spinner{
			display: none;
			position: fixed;
			top: 0;
			background: yellow;
			height: 50px;
			width: 200px;
			border: 1px solid black;
		}
		#result{
			display: none;
			position: fixed;
			top: 200px;
			background: red;
			height: 50px;
			width: 200px;
			border: 1px solid black;
		}


		td:first-child {
		    width: 25%;
		    vertical-align: top;
		}
		textarea {
		    height: 150px;
		    width: 100%;
		}
		select {
		    height: 30px;
		    padding: 3px;
		    width: 100px;		}
		input {
		    height: 30px;
		    width: 100px;
		}
		form {
		    width: 400px;
		}
		table {
		    width: 100%;
		}
		tr {
		}
		td {
		    padding: 10px 0;
		}
	</style>
</head>
<body>

	<div id='spinner'>loading ...</div>
	<div id='result'></div>

	<form action="pasteme_server.php" method="post">
		<fieldset>
			<table style="">
				<tbody>
					<tr>
						<td>
							<label for="limit">Time to keep</label>
						</td>
						<td>
							<select name="limit" id="limit">
								<option value="0">Forever</option>
								<option value="365">1 Year</option>
								<option value="180">6 Months</option>
								<option selected="selected" value="30">1 Month</option>
								<option value="7">1 Weeks</option>
								<option value="1">1 Day</option>
							</select>
						</td>
					</tr>
					<tr>
						<td style="">
							<label for="textarea" style="">Text</label>
						</td>
						<td>
							<textarea name="textarea" id="textarea" style="width: 265px; height: 152px;"></textarea>
						</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td>
							<input type="submit" value="Post" name="submit">
						</td>
					</tr>
				</tbody>
			</table>
		</fieldset>
	</form>

	<script type="text/javascript" src='jquery.js'></script>

	<script type="text/javascript">
	$('form').submit(function(e){
		e.preventDefault();

		var params = {
						'd'		: $('#limit').val(),
						'text' 	: $('#textarea').val()
					};


		$('#spinner').show();

		$.post('pasteme_server.php',params,function(data){
				if(data=='true'){
					$('#result').text('data stored');
				
				}else{
					$('#result').text('unable to store data');
				}
			})
			.done(function(){
				if(	$('#result').text()=='data stored'){
					$('#result').text('data stored');
				}else{
					$('#result').text('unable to store data');
				}

			})
			.fail(function(){
				$('#result').text('unable to store data');
			})
			.always(function(){
				$('#spinner').hide();
				$('#result').show();
			})

	})
	</script>

</body>
</html>