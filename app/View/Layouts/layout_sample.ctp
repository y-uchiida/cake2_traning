<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php if (isset($page_title)) {echo $page_title;}?></title>

    <!-- Mobile Specific Metas
	–––––––––––––––––––––––––––––––––––––––––––––––––– -->
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- FONT
	–––––––––––––––––––––––––––––––––––––––––––––––––– -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Kosugi+Maru&family=Open+Sans&display=swap" rel="stylesheet">

	<!-- CSS
	–––––––––––––––––––––––––––––––––––––––––––––––––– -->
	<?php

/* HTMLHelperからcssを読み込むためのlink要素を書き出しできる */
echo $this->Html->css('normalize');
echo $this->Html->css('skeleton');
echo $this->Html->css('page');
?>
</head>

</head>
<body>
	<!-- Primary Page Layout
	–––––––––––––––––––––––––––––––––––––––––––––––––– -->
	<div class="container">
		<div class="row">
			<div style="margin-top: 10%">

<h1><?php
if (isset($page_title)) {echo $page_title;}
?></h1>

<?php
/* $content_for_layout は、元のviewファイルの内容を自動的に読み込んで表示してくれる、
 * CakePHP で用意された変数
 * これを出力しておかないと、アクションメソッドによって可変となるコンテンツ部分がレイアウトファイル内に反映されない
 */
echo $content_for_layout;
?>

			</div>
		</div>
	</div>
</body>
</html>