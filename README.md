# Readme - Cake2 training
このリポジトリは、ウチイダ(yugo uchiida)がCakePHP 2 のハンズオン学習において作成したものです。  
このReadmeには、コーディングの中で気づいたことやつまづいたことなどをメモしておきます  
つまづいたら、まず公式ドキュメントを参照しています
https://book.cakephp.org/2/en/index.html

## コントローラ
(app_name)Controller.php -> app_name で自動的にmodel や view とつながるっぽい  
コントローラのアクションメソッドは、 /app_name/action_name で自動的に設定される  
Laravelのようにルーティング情報を設定しなくてよい

## ビュー
コントローラと名前の規約で連動させるのが原則  
View/[アプリケーション名のディレクトリ]/[アクションメソッド名].ctp  
例えば`View/ViewTest/index.ctp` というようにファイルを作ると、  
ViewTestController@index と連動して、 /ViewTest/index のページの表示時に利用される  

## FormHelper
Webフォームのタグを自動生成してくれるヘルパ関数  
CakeのHelperはビュー側で利用するもの
```
echo $this->Form->create('モデル名', [form要素の属性と設定値を連想配列で記述])
echo $this->Form->text('input要素名');
echo $this->Form->end('submitのボタン名');
```

入力値の無害化について、v2.4 でSanitize クラスが非推奨になった  
以降ではモデルに対するバリデーションの徹底で対処するべきとのこと  
モデルを使わないフォームに対するサニタイズは、ふつうにhtmlspecialchars()でやっておいた

### csrf 対策
FormHelper側では機能がないようで、調べてみたらSecurity Componentというものを導入するのが良いらしい  
コンポーネントは、コントローラ間で共通に実装したい機能をまとめて提供するための仕様とのこと  
https://book.cakephp.org/2/ja/core-libraries/toc-components.html  
https://book.cakephp.org/2/ja/controllers/components.html  
Laravelでいうところのミドルウェア(事前処理のほう)みたいな感じ？  
親クラスのbeforeFilterも実行する場合は、parent::beforeFilter()で明示的に呼び出す必要がある
```
<?php
App::uses('AppController', 'Controller');

class FormHelperSampleController extends AppController
{

    /* コンポーネントのロード、csrf対策などを含むSecurityコンポーネントを読み込んでおく */
    public $components = [
        'Security'
    ];

    public function beforeFilter() {

        /* 親コントローラ(AppController)でbeforeFilter()が定義されている場合に、
         * それを実行するための記述
         * これがないと親のbeforeFilter()は動作しなくなる
         */
        parent::beforeFilter();

        $this->Security->csrfCheck = true; /* csrfトークンを生成する */
        $this->Security->csrfExpires = '+1 hour'; /* csrf トークンの期限を1時間に設定？ */
        $this->Security->csrfUseOnce = false; /* carf トークンを再利用する */
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
    }
}

```
