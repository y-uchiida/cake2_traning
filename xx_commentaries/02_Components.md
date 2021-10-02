# 02 Components
コンポーネントの基本的な使い方の確認について  
簡単なコンポーネントを作って導入してみるところから、いくつかのコアコンポーネントの使い方まで行った
作成したコードは、UseComponentSample のコントローラやビューの中にまとめてある  
参照したのはほぼCookBookのみ、説明が簡潔すぎて、ちょっとわかりづらかった  
冒頭から順番に読み進めることが想定されているのかな…

## コンポーネントの作成
コアコンポーネントはいろいろ設定項目があって気軽に試せないので、  
まずは四則演算を行うメソッドを集めたコンポーネントBasicCalcComponentを作成  
保存先は `app/Controller/Component` 内  

Component クラスを継承し、public function でコンポーネントメソッドとして利用したい内容を作成していく

## コンポーネントの読み込み
作成したBasicCalcComponent を使ってみるためのコントローラとして、UseComponentSampleController.phpを作成
コンポーネントをコントローラにロードするための方法は主に2つある  
ひとつは、$components プロパティの配列に、利用するコンポーネント名の文字列をセットする方法  
もしくは、コントローラのbeforeFilterメソッド内で、`$this->components[] = "コンポーネント名"` として追加する方法  
どちらも、コンポーネントのファイルから、「Components」を取り除いたコンポーネント名だけを指定する  
なお、beforeFilter() メソッドを使って設定した場合、beforeFilter以前に実行済みの初期化処理  
initilaizeとstartupが適用されていないので、これも併せて実行する  
Sessionコンポーネントを、beforeFilter()でロードする例は以下
```
    public function beforeFilter()
    {
        $this->Session = $this->Components->load("Session"); /* セッションデータ管理のコンポーネント */
        $this->Session->initialize($this);
        $this->Session->startup($this);
    }
```

読み込みしたコンポーネントは、コントローラのアクションメソッド内で`$this->コンポーネント名` から利用できるようになる  


## Session コンポーネント
$_SESSIONを利用するためのラッパーみたいな使い方ができる  
Session配列内の値の指定は、ドット記法が使える
- $this->Session->write('session.key.name', 'val') ... $_SESSION['session']['kay']['name'] = 'val' の書き込み
- $this->Session->read('session.key.name') ... $_SESSION['session']['kay']['name']の値を読み込む
- $this->Session->comsume('session.key.name') ... $_SESSION['session']['kay']['name'] を読み込んで、データから削除する
- $this->Session->check('session.key.name') ... $_SESSION['session']['kay']['name']の存在確認
- $this->Session->delete('session.key.name') ... $_SESSION['session']['kay']['name']の削除
- $this->Session->destroy() ... セッションデータの破棄

## Flash コンポーネント
表示系の内容でもう一つ...1回限りのメッセージを扱うための仕組みとしてFlashコンポーネントがある  
Flash コンポーネントで任意の内容をSession に保存しておき、ビューからFlash ヘルパ経由でメッセージを取り出す  
Flash で取り出されたメッセージは、表示の直後にSessionから削除される  
Flashコンポーネントのメソッド名は、`app/View/Elements/Flash` ディレクトリ内のctpファイル名に対応している  
`$this->flash->default()` で設定したメッセージは、Flash ヘルパーで呼び出す際にdefault.ctpのテンプレートが利用される  
