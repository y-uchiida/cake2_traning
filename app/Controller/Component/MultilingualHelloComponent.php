<?php

/*	MultilingualHelloComponent
 *	各国の言葉で"Hello"をしてくれるコンポーネント
 */

/* Component の宣言のusesは、 'Component', 'Controller'になるので注意
 * (Controllerに読み込んで使うので、当然と言えば当然なのだけど)
 */
App::uses('Component', 'Controller');
class MultilingualHelloComponent extends Component {

	public function eng() {
		return ("Hello");
	}

	public function spa() {
		return ("¡Hola!");
	}

	public function fra() {
		return ("Bonjour");
	}

	public function por() {
		return ("Boa tarde");
	}

	public function ger() {
		return ("Hallo");
	}

}