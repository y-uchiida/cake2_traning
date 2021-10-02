<?php

/*	BasicCalcComponent
 *	基本的な計算を行うメソッドを持つコンポーネント
 */

App::uses('Component', 'Controller');
class BasicCalcComponent extends Component {

	public function add($n1, $n2) {
		return ($n1 + $n2);
	}

	public function sub($n1, $n2) {
		return ($n1 - $n2);
	}

	public function mul($n1, $n2) {
		return ($n1 * $n2);
	}

	public function div($n1, $n2) {
		return ($n1 / $n2);
	}

}