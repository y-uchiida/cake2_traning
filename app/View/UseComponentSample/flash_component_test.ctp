<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>UseComponentSample</title>
</head>
<body>
	<h1>UseComponentSample@flash_component_test.ctp</h1>

	<h2>Flash Messageのテスト</h2>
	<h3>Sessionデータを全表示</h3>
	<pre><?php var_dump($this->Session->read()); ?></pre>

	<h3>Flash ヘルパーを利用してdefault フラッシュメッセージを表示</h3>
	<?php echo $this->Flash->render() ?>

	<h3>再度、Sessionデータを表示してみる</h3>
	<pre><?php var_dump($this->Session->read()); ?></pre>

</body>
</html>