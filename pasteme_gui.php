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
	</style>
</head>
<body>

	<div id='spinner'>loading ...</div>
	<div id='result'></div>

	<form method='post' action='pasteme_server.php'>
		<label for='limit'></label>
		<select id='limit' name='limit'>
			<option value='0'>Forever</option>
			<option value='365'>1 Year</option>
			<option value='180'>6 Months</option>
			<option value='30' selected='selected'>1 Month</option>
			<option value='7'>1 Weeks</option>
			<option value='1'>1 Day</option>
		</select>

		<label for='textarea'>Text</label>
		<textarea id='textarea' name='textarea'></textarea>

		<input type='submit' name='submit' value='Post'/>
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
				//$(document).append(data);
				//$('#spinner').hide();
				//$('#result').show();
				//$('#result').text('data stored');
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