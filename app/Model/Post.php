<?php
App::uses('AppModel', 'Model');
/**
 * Post Model
 *
 */
class Post extends AppModel
{

/**
 * Display field
 *
 * @var string
 */
    public $displayField = 'title';

/**
 * Associations
 *
 * @var array
 */
	public $belongsTo = [
		'User'
	];
	public $hasMany = 'Comment';
	public $hasAndBelongsToMany = [
		'UserLikedBy' => [
			'className' => 'User',
			'joinTable' => 'likes', /* 中間テーブル名、規約外なので設定が必要 */
			'foreignKey' => 'post_id',
			'associationForeignKey' => 'user_id'
		]
	];

/**
 * Validation rules
 *
 * @var array
 */
    public $validate = array(
        'title' => array(
            'notBlank' => array(
                'rule' => array('notBlank'),
                //'message' => 'Your custom message here',
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'content' => array(
            'notBlank' => array(
                'rule' => array('notBlank'),
                //'message' => 'Your custom message here',
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'user_id' => array(
            'numeric' => array(
                'rule' => array('numeric'),
                //'message' => 'Your custom message here',
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
    );
}
