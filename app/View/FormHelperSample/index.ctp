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
		$this->Form->unlockField('email'); /* デフォルトだと、emailのinput typeが使えなくてエラーになる */
		echo $this->Form->input('user_name', [
			/* 第2引数に連想配列で詳細設定ができる */
			'label' => 'お名前',
		]);
		echo $this->Form->radio('gender', ['f' => '男性', 'm' => '女性']);
		echo $this->form->input('email', [
			'label' => 'メールアドレス',
		]);
		echo '<div>';
		echo $this->Form->label('contact_type', 'お問い合わせ種別');
		echo $this->Form->select('contact_type', [
			"" => "選択してください", 
			"1" => '001',
			"2" => '002',
			"3" => '003',
			"4" => '004',
			"5" => '005'
		]);
		echo '</div>';

		echo $this->Form->label('content', 'お問い合わせ内容');
		echo $this->Form->textArea('content', [
			'rows' => 4,
			'cols' => 50			
		]);
		echo $this->Form->input('infomation_confirm', [
			'type' => 'checkbox',
			'label' => '個人情報保護方針に同意します'
		]);
		echo $this->Form->end("Send");
	?>

	<h2>form POSTed data</h2>
	<pre>
<?php
	if (isset($posted)){
		var_dump($posted);
	}
?>
	</pre>
</body>
</html>