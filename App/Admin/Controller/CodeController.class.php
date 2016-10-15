<?php
namespace Admin\Controller;
use Think\Controller;
class CodeController extends Controller {
    public function index(){
        code();
    }
    public function qtindex(){
        $config=array(
            'fontSize'=>'20',
            'imageW'=>'100',
            'imageH'=>'35',
            'length'=>4,
            'useCurve'=>0

        );
        code($config);
    }
}