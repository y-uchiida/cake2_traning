<?php
App::uses('AppController', 'Controller');

class FormHelperSampleController extends AppController
{

    /* コンポーネントのロード、csrf対策などを含むSecurityコンポーネントを読み込んでおく */
    public $components = [
        'Security'
    ];

    /* beforeFilter():
     * アクションメソッドの実行前に共通して実施される処理を記述できる
     * ここでは、SecurityComponentの設定をコントローラ内で共通で行うために利用
     * Laravelでいうところのミドルウェア(事前処理のほう)みたいな感じ？
     */
    public function beforeFilter() {

        /* 親コントローラ(AppController)でbeforeFilter()が定義されている場合に、
         * それを実行するための記述
         * これがないと親のbeforeFilter()は動作しなくなる
         */
        parent::beforeFilter();

        $this->Security->csrfCheck = true; /* csrfトークンを生成する */
        $this->Security->csrfExpires = '+1 hour'; /* csrf トークンの期限を1時間に設定？ */
        $this->Security->csrfUseOnce = false; /* csrf トークンを再利用する */
    }

    public function index()
    {    
        $this->autoLayout = false;

        /* フォームを処理するモデルの設定をnullに変更 */
        $this->modelClass = null;

        $user_input = "";
        if ($this->request->data){ /* POSTデータが送信されてきているかを確認する */
            $user_input = htmlspecialchars($this->request->data['user_input'], ENT_QUOTES);
        }

        $this->set("user_input", $user_input);
        $this->set("posted", $this->request->data);
    }
}
