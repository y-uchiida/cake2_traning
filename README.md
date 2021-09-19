# Readme - Cake2 training
このリポジトリは、ウチイダ(yugo uchiida)がCakePHP 2 のハンズオン学習において作成したものです。  
このReadmeには、コーディングの中で気づいたことやつまづいたことなどをメモしておきます  

## コントローラ
(app_name)Controller.php -> app_name で自動的にmodel や view とつながるっぽい  
コントローラのアクションメソッドは、 /app_name/action_name で自動的に設定される  
Laravelのようにルーティング情報を設定しなくてよい

## ビュー
コントローラと名前の規約で連動させるのが原則  
View/[アプリケーション名のディレクトリ]/[アクションメソッド名].ctp  
例えば`View/ViewTest/index.ctp` というようにファイルを作ると、  
ViewTestController@index と連動して、 /ViewTest/index のページの表示時に利用される