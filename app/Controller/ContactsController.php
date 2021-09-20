<?php

App::uses('AppController', 'Controller');

class ContactsController extends AppController
{
    /* スカフォールド機能を利用するため、$scafold を宣言 */
    // public $scaffold;

    /* お問い合わせ画面を作成する */
    public function index()
    {
        $this->autoLayout = true;
        $this->layout = 'layout_sample';
		$this->set("page_title", 'お問い合わせフォーム');
    }

	public function list($page = 1){
		define('LIMIT', 5); /* レコードの取得数上限 */

		$this->autoLayout = true;
		$this->layout = 'layout_sample';
		$this->set("page_title", 'お問い合わせ一覧');

		$count = $this->Contact->find('count');
		$page_num = ceil($count / LIMIT);
		$records = $this->Contact->find('all', [
			'limit' => LIMIT,
			'page' => $page
		]);

		$this->set('count', $count);
		$this->set('page', $page);
		$this->set('page_num', $page_num);
		$this->set('records', $records);
	}

    /* POST データを受け取る画面 addを作成 */
    public function add()
    {
        $this->autoLayout = true;
        $this->layout = 'layout_sample';

        /* POST データが送信された際の処理 */
        if ($this->request->is('post')) {
			// print('<pre>');
			// var_dump($this->request->data);
			// print('</pre>');

			/* save()の引数は、受け取ったデータのオブジェクト名？まで設定する必要があるっぽい */
			$result = $this->Contact->save($this->request->data['Contacts']);

            $error = '';
            if ($result) {
                /* 保存成功メッセージを表示 */
                $this->render('thanks');
            } else {
                $this->set('err_msg', 'データ保存時にエラーが発生しました');
				$this->render('index');
            }
        }
    }

	/* 既存データの編集用画面 */
	public function edit($id = -1, $msg = null){
        $this->autoLayout = true;
        $this->layout = 'layout_sample';
		$this->set("page_title", 'お問い合わせ内容の編集');

		/* フォームから送信されたデータ(POST or PUT)があるか確認 */
		if ( $this->request->is('post') || $this->request->is('put') ){
			/* フォームから送信されたデータの保存を試行 */
			$result = $this->Contact->save($this->request->data);

			if ($result){
				/* 成功していれば、その旨を編集画面に表示する */
				$this->set('msg', '編集内容を保存しました');
			}
			else {
				$this->autoRender = false;
				print("<p>データ保存時にエラーが発生しました</p>");
				return ;
			}
		}
		

		/* /Contact/edit/{id} の形式のURLにアクセスされたときに、
		 * 引数 $id に、URLのパスの一部({id}の部分)が設定される
		 * これを使って、編集するデータを特定する
		 */
		if ($id === -1){
			$this->autoRender = false;
			print("<p>編集対象が指定されていません</p>");
			return ;
		}

		$contact_data = $this->Contact->read(null, $id);
		if (empty($contact_data)){
			$this->autoRender = false;
			print("<p>指定された編集対象が存在しません</p>");
			return ;
		}

		/* データベースから取得した内容を、リクエストデータとして渡しておく
		 * これにより、ビュー側で自動的に項目を埋めてくれる
		 */
		$this->request->data = $contact_data;

		if(isset($msg)){
			$this->set("msg", $msg);
		}
	}

    public function model_test()
    {
        $this->autoLayout = false;

        /* モデル経由でデータを取得する
         * Cake の命名規則に沿ったモデルとテーブルを自動で選択してSQLを実行するため、
         * 命名規則通りであれば、各コントローラファイル上でのモデルの読み込みは不要
         */
        $contacts = $this->Contact->find('all');
        $contacts_types = $this->Contact->findByContactType(1);
        $this->set('contacts', $contacts);
        $this->set('contacts_type', $contacts_types);
    }

}
