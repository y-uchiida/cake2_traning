<?php
class CreateLikesTable extends CakeMigration {

/**
 * Migration description
 *
 * @var string
 */
	public $description = 'create_likes_table';

/**
 * Actions to be performed
 *
 * @var array $migration
 */
	public $migration = array(
		'up' => array(
			'create_table' => array(
				'likes' => array(
					'id' => array('type' => 'biginteger', 'null' => false, 'default' => null, 'unsigned' => true, 'key' => 'primary'),
					'post_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'unsigned' => true),
					'user_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'unsigned' => true),
					'indexes' => array(
						'PRIMARY' => array('column' => 'id', 'unique' => 1),
					),
					'tableParameters' => array('charset' => 'utf8mb4', 'collate' => 'utf8mb4_general_ci', 'engine' => 'InnoDB', 'comment' => 'Intermediate table between posts and users for like(LGTM)'),
				),
			),
		),
		'down' => array(
			'drop_table' => array(
				'comments', 'likes', 'posts', 'users'
			),
		),
	);

/**
 * Before migration callback
 *
 * @param string $direction Direction of migration process (up or down)
 * @return bool Should process continue
 */
	public function before($direction) {
		return true;
	}

/**
 * After migration callback
 *
 * @param string $direction Direction of migration process (up or down)
 * @return bool Should process continue
 */
	public function after($direction) {
		return true;
	}
}
