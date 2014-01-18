<?php

$get_url = parse_url($_SERVER['REQUEST_URI']);
$get_url = explode('/',$get_url['path']);
$get_url = $get_url[count($get_url)-1];


//get the db & display it.
if(strlen($get_url)>0 &&  ($get_url!='index.php') ){
	include('pasteme_server.php');
}



if(isset($stored_data)){
	$d=$stored_data['d'];
	$text = $stored_data['text'];
}else{
	$d='30';
	$text = '';
}
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
			width: 330px;
			border: 1px solid black;
		}

		td:first-child {
		    width: 25%;
		    vertical-align: top;
		}
		textarea {
		    width: 265px; 
		    height: 152px;
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
							<?php  
								if(isset($stored_data)): 

									switch($d){
										case '0'  : echo 'Forever'; break;
										case '365': echo '1 Year';  break;
										case '180': echo '6 Months';break;
										case '30' : echo '1 Month'; break;
										case '7'  : echo '1 Weeks'; break;
										case '1'  : echo '1 Day';   break;
									}

								else: ?>
									<select name="limit" id="limit">
										<option <?= ($d=='0'? 'selected=selected':'')  ?> value="0">Forever</option>
										<option <?= ($d=='365'?'selected=selected':'') ?> value="365">1 Year</option>
										<option <?= ($d=='180'?'selected=selected':'') ?> value="180">6 Months</option>
										<option <?= ($d=='30'?'selected=selected':'')  ?> value="30">1 Month</option>
										<option <?= ($d=='7'? 'selected=selected':'')  ?> value="7">1 Weeks</option>
										<option <?= ($d=='1'? 'selected=selected':'')  ?> value="1">1 Day</option>
									</select>
							<?php endif ?>
						</td>
					</tr>
					<tr>
						<td style="">
							<label for="textarea" style="">Text</label>
						</td>
						<td>
							<textarea name="textarea" id="textarea" <?= 
																isset($stored_data)?'readonly="true"':'' 
																	?>><?= $text ?></textarea>
						</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td>
							<input type="submit" value="Post" name="submit" id="submit" disabled="disabled">
						</td>
					</tr>
				</tbody>
			</table>
		</fieldset>
	</form>

	<script type="text/javascript" src='http://code.jquery.com/jquery-latest.min.js'></script>

	<script type="text/javascript">

	$(function(){

		//enable-disable submit button
		$('#textarea').keyup(function(){
			if($(this).val().length<1){
				$('#submit').attr('disabled','disabled');
			}else{
				$('#submit').removeAttr('disabled');
			}

		})


		$('form').submit(function(e){
			e.preventDefault();


			var params = {
							'd'		: $('#limit').val(),
							'text' 	: $('#textarea').val()
						};


			$('#spinner').show();

			$.post('pasteme_server.php',params,function(data){
				data = JSON.parse(data);
				//console.log(data)
					if(typeof data==='object'){
						
						//$('<a>').attr({'href':data.url}).append(data.url)
						var url = $('<a>').attr({'href':data.url}).append(data.url)
						console.log(url)
						$('#result').text('Data stored at ').append(url);
					
					}else{
						$('#result').text('unable to store data');
					}
				})
				// .done(function(){
				// 	if(	$('#result').text()=='data stored'){
				// 		$('#result').text('data stored');
				// 	}else{
				// 		$('#result').text('unable to store data');
				// 	}

				// })
				.fail(function(){
					$('#result').text('unable to store data');
				})
				.always(function(){
					$('#spinner').hide();
					$('#result').show();
				})

		})
		$('#result').text('unable to store data');
	})
	</script>

</body>
</html>