<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>FormHelperSample</title>
</head>
<body>
	<h1>FormHelperSample</h1>
	<?php
		echo $this->Form->create(false, [
			'type' => 'post',
		]);
		echo $this->Form->text('user_input', ['value' => $user_input]);
		echo $this->Form->end("Send");
	?>

	<h2>form POSTed data</h2>
	<pre>
<?php
	var_dump($posted);
?>
	</pre>
</body>
</html>