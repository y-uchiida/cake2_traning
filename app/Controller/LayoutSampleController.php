<?php
App::uses('AppController', 'Controller');
 
class LayoutSampleController extends AppController {
 
  public function index() {

    /* これまでつけていた、$autoLayout = false; をtrue; に変える */
    $this->autoLayout = true;
    /* layoutに利用するctpファイルを、Layout/layout_sample.ctp に設定する */
    $this->layout = 'layout_sample';

    $this->set("page_title", 'LayoutSample'); /* ビューからは$string で "hello, world" が参照できる */

  }
}