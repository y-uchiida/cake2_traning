<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>UseComponentSample</title>
</head>
<body>
	<h1>UseComponentSample@session_component_test.ctp</h1>

	<h2>Sessionからデータを読み取り</h2>
	<p>
		<?php print("\$_SESSION['cat1']['name']: {$this->Session->read("cat1.name")}"); ?>
	</p>

	<h2>Sessionデータを全表示</h2>
	<pre><?php var_dump($this->Session->read()); ?></pre>

</body>
</html>