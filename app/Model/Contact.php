<?php

/* モデルの基底クラスAppModelを読み込み */
App::uses('AppModel', 'Model');

/* データベースとの連携をするだけであれば、クラスの内容は空でOK
 * データベースとの連携に関する内容の基本は、すべて基底クラス内で実装されているということらしい
 * なお、モデルのクラス名の規約は、連携するデータベーステーブルの名前の単数形
 */
class Contact extends AppModel {

}