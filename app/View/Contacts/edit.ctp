

<?php

if (isset($msg)){
	print("<p>$msg</p>");
}else{
	echo "<p>以下のフォームからお問い合わせ内容を入力してください</p>";
}

/* エラーメッセージがあればそれを表示 */
if (isset($err_msg)){
	echo "<p><font style='color: red'>$err_msg</font></p>";
}

/* email のinput typeを利用可能に変更 */
$this->Form->unlockField('email');

/* FormHelper を使って、Contact モデル用の入力フォームを生成する
 * create() の第1引数は、モデル名にしておくこと
 */
echo $this->Form->create('Contact', ['type' => 'post']);
echo $this->Form->hidden('id');
echo $this->Form->input('name', ['label' => 'お名前']);
echo $this->Form->radio('gender', ['f' => '男性', 'm' => '女性' ]);
echo $this->Form->input('email', ['label' => 'メールアドレス']);
echo '<div>';
echo $this->Form->label('contact_type', 'お問い合わせ種別');
echo $this->Form->select('contact_type', [
	'' => '選択してください',
	'1' => '資料請求',
	'2' => '商品の試用依頼',
	'3' => 'お見積もり依頼(無料)',
	'4' => 'パートナー応募',
	'5' => '採用について',
	'6' => 'その他',
]);
echo '</div>';
echo $this->Form->label('content', 'お問い合わせ内容');
echo $this->Form->textArea('content', ['rows' => 5, 'cols' => 50]);
echo $this->Form->hidden('confirm_privacy_policy', [
	'type' => 'checkbox',
	'label' => '個人情報保護方針に同意します'
]);
echo $this->Form->end('編集');
?>