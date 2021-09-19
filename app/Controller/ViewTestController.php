<?php
App::uses('AppController', 'Controller');
 
class ViewTestController extends AppController {
 
  public function index() {
    /* あらかじめ用意された画面のレイアウトデータをもとに、自動的にページのレイアウトを生成する機能をON/OFFする
     * コントローラ・アクションの名称に対応するctp ファイルのみを利用してレイアウトを行うようにする設定
     */
    $this->autoLayout = false;

    /* view への値の受け渡しは、$this->set(ビュー側で利用する変数名, コントローラ内のデータ); */
    $str = "hello, world";
    $this->set("string", $str); /* ビューからは$string で "hello, world" が参照できる */

    $this->set("langs", ['PHP', 'Ruby', 'JavaSctipt', 'Python', 'Basic', 'COBOL', 'Java', 'Go', 'Lua']);
  }
}