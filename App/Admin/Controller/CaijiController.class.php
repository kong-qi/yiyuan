<?php
namespace Admin\Controller;

use Think\Controller;
class CaijiController extends Controller {

    public function add(){


            $model=M('LanMuExtends');
            $fid=136;
            $str="红色, 橙色, 黄色, 绿色, 青色, 蓝色, 黑白, 棕色, 粉色, 白色, 米色, 灰色, 黑色";
            $strarr=explode(",",$str);
            foreach ($strarr as $v)
            {
                $data=[

                    'uuid'=>create_uuid(),
                    'name'=>$v,
                    'ctime'=>time(),
                    'fid'=>$fid,

                ];
                $result =$model->add($data);
                if($result) {
                   echo "ok<br/>";
                }else{
                    echo "fail<br/>";
                }
            }






    }

}
