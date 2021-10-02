<?php

/*    UseComponentSampleController
 *    コンポーネントを読み込んで動作させるテスト用のコントローラ
 */

App::uses('AppController', 'Controller');

class UseComponentSampleController extends Controller
{
    /* コントローラのクラスプロパティとして、$components を宣言し、
     * その中でコンポーネント名を設定することでコントローラ内に読み込むことができる
     */
    public $components = [
        'BasicCalc', /* 四則演算コンポーネント */
        'MultilingualHello', /* 多言語挨拶コンポーネント */
        'Flash' /* フラッシュメッセージ表示用コンポーネント */
    ];

    /* コントローラのbeforeFilterメソッドで、コンポーネントを読み込むこともできる
     * $components プロパティに値を入れる場合と違って、メソッドなので別の関数の処理結果などを
     * コンポーネントに渡したい場合などに便利
     * beforeFilterで動的にコンポーネントをロードした場合、beforeFilter以前に実行済みの初期化処理
     * initilaizeとstartupが適用されていないので、これも併せて実行する
     */
    public function beforeFilter()
    {
        $this->Session = $this->Components->load("Session"); /* セッションデータ管理のコンポーネント */
        $this->Session->initialize($this);
        $this->Session->startup($this);
    }

    public function index()
    {
        $this->autoLayout = false;

        print("<h1>UseComponentSampleController.index()</h1>");

        /* コントローラのオブジェクトのメソッドのように、$this->コンポーネント名->メソッド()
         * でコンポーネントのメソッドを実行することができる
         */
        print("calc test... \$this->BasicCalc->add(14, 28) = {$this->BasicCalc->add(14, 28)} <br>");
        print("hello in Spanish: {$this->MultilingualHello->spa()}. <br>");

        print("<p>コントローラでprintした内容、ここまで</p>");

        $this->set([
            'eng' => $this->MultilingualHello->eng(),
            'fra' => $this->MultilingualHello->fra(),
        ]);
    }

    public function session_component_test()
    {
        $this->autoLayout = false;

        /* ビューでSession ヘルパを使いたいので、読み込みしておく
         * (他のビューでは使わないので、public $helpers のほうではなくここに追加的に記載)
         */
        $this->helpers[] = "Session";

        $this->Session->write("cats.cat1.name", "tama"); /* $_SESSION['cats']['cat1']['name'] = 'tama' を追加 */
        $this->Session->write("cats.cat1.weight", 2500); /* $_SESSION['cats']['cat1']['weight'] = '2500' を追加 */

        $this->Session->write("cats.cat2.name", "kuro"); /* $_SESSION['cats']['cat2']['name'] = 'kuro' を追加 */
        $this->Session->write("cats.cat2.weight", 3000); /* $_SESSION['cats']['cat2']['weight'] = 3000 を追加 */

        $this->Session->delete("cats.cat2.weight"); /* $_SESSION['cats']['cat2']['weight']を削除 */

    }

    public function flash_component_test()
    {
        $this->autoLayout = false;
        
        /* ビュー側でFlash メッセージを表示するため、Flash ヘルパを導入 */
        $this->helpers[] = "Flash";

        /* 動作検証のため、こちらのアクションでもSession ヘルパを導入 */
        $this->helpers[] = "Session";

        /* $_SESSION['Message'] の中に保存される
         * メソッド名は、app/View/Elements/Flash 内のctpファイルに対応している
         */
        $this->Flash->default('This is Flash Message');

        /* app/View/Elements/Flash/my_flash.ctp をテンプレートとして利用したい場合 */
        $this->Flash->myFlash('using my_flash Element, show message whith bold and red charactors');

    }
}
