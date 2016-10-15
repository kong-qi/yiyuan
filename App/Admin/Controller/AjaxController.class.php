<?php
namespace Admin\Controller;
class AjaxController extends AuthController
{

    public function handle()
    {

        $uuid = I('post.uuid');
        $sort=I('post.sort');
        $token = I('post.token');
        $ajaxtype = I('post.type');
        $value=I('post.value')==''?'':I('post.value');
        $filed=I('post.filed')==''?'':I('post.filed');
        $model = I('post.model');
        $log=I('post.log')==''?'':I('post.log');

        if (!check_token($token)) {
            echo json_encode(array(
                'error' => 1,
                'msg' => '非法操作'
            ));
        }

        $model = M($model);
        switch ($ajaxtype) {
            case "del":
                $map = array(
                    'uuid' => array(
                        'in',
                        $uuid
                    )
                );
                if(I('post.model')=='File')
                {
                    $fild=$model->where($map)->select();
                    foreach ($fild as $v)
                    {
                        @unlink($v['aburl']);
                    }
                }
                $result = $model->where($map)->delete();
                if ($result) {
                    add_log($log.'删除成功');
                    echo json_encode([
                        'error' => 0,
                        'msg' => '删除成功'
                    ]);
                } else {
                    add_log($log.'删除失败');
                    echo json_encode([
                        'error' => 1,
                        'msg' => '删除失败'
                    ]);
                }

                break;
            case 'checked':
                $map = array(
                    'uuid' => array(
                        'in',
                        $uuid
                    )
                );

                if($filed=='pay_send')
                {
                    $data=array(
                        $filed=>$value,
                        'wuliu_name'=>'',
                        'wuliu_num'=>''
                    );
                }else
                {
                    $data=array(
                        $filed=>$value
                    );
                }
                $result=$model->where($map)->save($data);
                if($result)
                {
                    add_log($log.'设置状态成功');
                    echo json_encode([
                        'error' => 0,
                        'msg' => '成功'
                    ]);
                }else
                {
                    add_log($log.'设置状态失败');
                    echo json_encode([
                        'error' => 1,
                        'msg' => '失败'
                    ]);
                }
                break;
            case "sort":
                $status=0;
                foreach ($uuid as $key=>$v)
                {
                    $data=array(
                        'sort'=>$sort[$key]
                    );
                    $result=$model->where(array('uuid'=>$v))->save($data);
                    if($result)
                    {
                        $status=1;
                    }else
                    {
                        $status=1;
                    }
                }
                if($status)
                {
                    add_log($log.'排序成功');
                    echo json_encode([
                        'error' => 0,
                        'msg' => '成功'
                    ]);
                }else
                {
                    add_log($log.'排序失败');
                    echo json_encode([
                        'error' => 1,
                        'msg' => '失败'
                    ]);
                }

                break;
        }


    }
    public function clearCache(){

        if(file_exists(RUNTIME_PATH))
        {
            del_dir(RUNTIME_PATH);
            return $this->success('清除缓存成功',U('Admin/Index/index'));
        }else
        {
           return $this->error('清除失败');
        }
    }
    public  function fileList(){
        $type='image';
        if(I('get.type'))
        {
            $type=I('get.type');
        }

        $defalut=array(
            'type'=>$type
        );

        $page=I('get.page')==''?1:I('get.page');

        $pagesize=20;
        $model=M('file');

        $total=M('file')->where($defalut)->count();
        $pages=ceil($total/$pagesize);
        $data=$model->where($defalut)->page($page,$pagesize)->select();
        $str='';

        foreach ($data as $key=>$v)
        {
            $abdir=substr(WEB_ROOT,0,-1);
            $abfile=$abdir.pic_url($v["name"]);

            $pic_type=explode(".",$v["name"] );
            $pic_ext=$pic_type[1];
            $images_array=array(
                'jpg','gif','jpeg','png','bmp'
            );
            if(in_array($pic_ext,$images_array))
            {
                if(file_exists($abfile))
                {
                    $str.= '<li><img data-root="'.$abdir.pic_url($v["name"]).'" src="'.pic_url($v["name"]).'" data-src="'.$v['name'].'"></li>';
                }
            }else
            {


                    $file_url=WEB_URL."/Public/Admin/images/file.png";
                    $str.= '<li><img data-root="'.$abdir.pic_url($v["name"]).'" src="'.$file_url.'" data-src="'.$v['name'].'"><p>'.$v['name'].'</p></li>';
                
            }
          


            
        }
        $list=array(
            'pages'=>$pages,
            'contents'=>$str
        );
        echo (json_encode($list));

    }
    function anli(){
       
    }
}