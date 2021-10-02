<?php

App::uses('AppController', 'Controller');

/*
 * Sample のアプリケーションのコントローラは「SampleController」になる
 * この名称にしておくことで、自動的にModelやView と関連付けされるらしい
 */
class SampleController extends AppController
{

    /* index アクションメソッド
     * URLは、 www.hostname/Sample/index/ になる
     * Laravelのように、ルーティング情報を設定しなくてもよい
     * index アクションはデフォルトなので、 www.hostname/Sample/でもよい(index 無しでOK)
     * index アクションがないと、Sample/ 直下へアクセスするとエラーになる
     */
    public function index($param = "index")
    {

        /* viewを用いたレンダリングを無効にする */
        $this->autoRender = false;

        /* 画面出力はprint/echo でできる */
        print <<<_EOL
<html>
	<body>
		<h1>/Sample/index</h1>
		<p>this is SampleController@index</p>
		<p>\$param: $param</p>
	</body>
</html>
_EOL;
    }

    public function other_action()
    {

        /* viewを用いたレンダリングを無効にする */
        $this->autoRender = false;

        /* 画面出力はprint/echo でできる */
        print <<<_EOL
<html>
	<body>
		<h1>/Sample/other_action</h1>
		<p>this is SampleController@other_action</p>
	</body>
</html>
_EOL;
    }

    /* 外部リダイレクト
     * $this->redirect('URL')
     * ちなみに、redirect() アクションメソッドはAppController で既に作成されている
     */
    public function redirect_test()
    {
        $this->redirect("https://google.co.jp");
    }

    /* 内部リダイレクト(フォワーディング)
     * $this->setAction('action_name', $param);
     * 同一コントローラ内の別のアクションメソッドへ転送できる
     * アクセス元のURLに変更はない
     * 第2引数でパラメータを設定可能
     * なお、別のコントローラのアクションメソッドに渡す場合は
     * App::import() が使えるらしい
     */
    public function forwarding_test()
    {
        $this->setAction("index", "forwarding_test");
    }
}
