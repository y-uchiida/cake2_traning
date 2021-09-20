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
    }
}

```

### FormHelperの設定内容
動作がまちまちで使いづらかった...  
慣れが必要かもしれない

## レイアウトの作成
View/Layouts ディレクトリ内に保存したctp ファイルがテンプレート？ひな形？として利用できるようになる  
利用するファイルの選択は、 アクションメソッド内で`$this->layout = "LayoutName"` と設定する  
この場合は、 `View/Layout/LayoutName.ctp` が読み込まれる  
各コントローラ・アクションメソッドに対応するctpファイル(LayoutSample/index.ctpなど)は  
各画面やコントローラの処理結果で変動するコンテンツ部分だけを出力するように作成しておく  
レイアウトファイル内で、 `$content_for_layout` を出力すると、これらの内容が表示できる  
つまり、`$content_for_layout` を表示しないと、どんな場合も同じ表示になってしまうので注意

## モデルの利用
とりあえず、フォームヘルパーのハンズオンで利用した「お問い合わせフォーム的なもの」のレコードを  
保存するためのテーブル「contacts」を作成し、そのモデルを操作してみることに  
データベース名はcake2_trainingにした  
テーブル作成時のSQLは、`app/db_migration/create_contacts_table.sql` に保存しておいた
データベースとの連携をするだけであれば、クラスの内容は空でOK  
データベースとの連携に関する内容の基本は、すべて基底クラス内で実装されているということらしい  
なお、モデルのクラス名の規約は、連携するデータベーステーブルの名前の単数形

### スカフォールドを用いて簡単にCRUDを実装してみる
対応するコントローラを作成し、`public $scafold`を宣言するだけ、アクションメソッドも不要  
今回であれば、`ContactsController.php` を作成する  
コントローラ名は「Contacts」となり、モデル名ではなくテーブル名になるので注意
すると、contactsテーブルのデータの一覧、編集、追加、削除を行う機能を持った画面が表示される

### コントローラ上からモデルを利用する
コントローラは、Cakeの命名規則に沿ったモデルとデータベーステーブルがあればそれを利用するので、  
命名規則通りになっていれば各コントローラからモデルファイルの読み込みを記述する必要はない  
`$this->[モデル名]->データベースアクセスメソッド()` の形式でSQLを実行し、データを読み込める  
`$this->Contact->find('all')` で取得した結果を`View/Contacts/index.ctp` に渡してvar_dumpした  
その結果は連想配列になっていた  
Laravelのようにモデルのオブジェクトのコレクションになっているわけではない  
| # | メソッド名 | 概要 |
| ---- | ---- | ---- |
| 1 | find('keyword', [param, ...]) | モデルに対応したテーブルからデータを取り出す <br> - 'all': データを全件取得する <br> - 'first': データを1件だけ取得する <br> - 'list': インデックス付きの配列を返します <br> - 'count': 検索されるデータ数を取得する　<br> - 'threaded': 入れ子になった配列を返す |
| 2 | findAllBy<fieldName>(['condition', ...]) | テーブル内の特定のカラムの内容でデータを取得する場合に利用できる<br>例えばcontactsテーブルのcontact_typeで探す場合は、`$this->Contact->findByContactType(1);` になる
| 3 | findBy<fieldName>('condition') | テーブル内の特定のカラムに、引数で指定したデータがセットされたレコードを取り出す |
| 4 | query('SQL query') | 引数に記述したSQLを実行して結果を返す |

#### find() の第2引数のパラメータ
連想配列の形式で、条件を設定できる  
- 'conditions' => ['field_name' => 'value'] の形式で、テーブル内のカラムとその値を指定して検索できる。WHERE 句
- 'fieelds' => ['field_name', ...] の形式で、取り出すカラム名を指定する。SELECT 句
- 'recursive' で、再起的に取得する階層数を指定できる
- 'order' => ['field_name', ...] で、取得する結果に表示されるカラムの並び順を指定できる
- 'limit' で、取得するデータの最大数を制限する
- 'page' でページ番号を指定、 'limit' で指定した件数を1ページと考えるので、'limit' と併用してページングを行える
- 'offset' でデータの取得を開始する番号を設定する

#### find() の検索条件の設定方法
第2引数の'conditions'で、連想配列にして渡す方法が汎用的  
キー名は、単にカラムではなく`(モデル名).(カラム名)` になるところが注意点  
また、大小関係やnotなどを利用する場合は、 `(モデル名).(カラム名) >=` のように、キーに含める必要がある  
LIKEもおなじく、キー名に含める