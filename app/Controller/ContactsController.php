<?php

App::uses('AppController', 'Controller');

class ContactsController extends AppController {
	/* スカフォールド機能を利用するため、$scafold を宣言 */
	// public $scaffold;

	public function index(){
	
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