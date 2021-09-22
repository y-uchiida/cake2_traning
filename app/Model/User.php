<?php
App::uses('AppModel', 'Model');
/**
 * User Model
 *
 */
class User extends AppModel
{

/**
 * Display field
 *
 * @var string
 */
    public $displayField = 'name';

/**
 * Associations
 *
 * @var array
 */
	public $hasMany = [
		'Comment' => [ /* Post モデルとの関連を設定 */
			'className' => 'Comment' /* 命名規約に従っているので、書かなくても大丈夫 */
		],
		'Post' => [
			'className' => 'Post'
		]
	];
	public $hasAndBelongsToMany = [
		'LikePost' => [
			'className' => 'Post',
			'joinTable' => 'likes', /* 中間テーブル名、規約外なので設定が必要 */
			'foreignKey' => 'user_id',
			'associationForeignKey' => 'Post_id'
		]
	];

/**
 * Validation rules
 *
 * @var array
 */
    public $validate = array(
        'name' => array(
            'maxLength' => array(
                'rule' => array('maxLength', 255),
                'message' => 'name should be less than 255 characters',
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'email' => array(
            'email' => array(
                'rule' => array('email'),
                //'message' => 'Your custom message here',
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'password' => array(
            'notBlank' => array(
                'rule' => array('notBlank'),
                //'message' => 'Your custom message here',
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
    );
}
