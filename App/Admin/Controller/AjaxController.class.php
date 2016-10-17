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
    public function ajaxKeShiList($id=''){
        if($id=='')
        {
            return false;
        }
        $first_id=$id;
        $tfid=I('get.tfid');

        $rule=M('KeShi')->where(array('checked'=>1,'type'=>'keshi','fid'=>$id))->select();
        $str='';
        $checked='';
        if(count($rule)>0)
        {
            foreach ($rule as $k=>$v)
            {
                if($k==0)
                {
                    $first_id=$v['id'];
                }
                if($tfid==$v['id'])
                {
                    $checked="selected='selected'";
                }else
                {
                    $checked='';
                    if($checked=='')
                    {
                        if($k==0)
                        {
                            $checked="selected='selected'";
                        }
                        $checked='';
                    }

                }
                $str.="<option ".$checked." value='".$v['id']."'>".$v['name']."</option>";

            }
        }
        $arr=array(
            'first_id'=>$first_id,
            'content'=>$str,
            'code'=>''

        );
        return $this->ajaxReturn($arr);
    }
    public function ajaxKeShiJson($id=0){
        $first_id=$id;
        $tfid=I('get.tfid');
        $data=array();
        $rule=M('KeShi')->where(array('checked'=>1,'type'=>'keshi','fid'=>$id))->select();
        if(count($rule)>0)
        {
            foreach ($rule as $key => $v) {
                
                
                $rule2=M('KeShi')->where(array('checked'=>1,'type'=>'keshi','fid'=> $v['id']))->select();
                if(count($rule2)>0)
                {
                   foreach ($rule2 as $key => $v2) {
                        
                        $rule3=M('KeShi')->where(array('checked'=>1,'type'=>'keshi','fid'=> $v2['id']))->select();
                        if(count($rule3)>0)
                        {
                            foreach ($rule3 as $key => $v3) {
                              $data[]=array(
                                    'sf'=>array(
                                        'id'=>$v['id'],
                                        'name'=>$v['name'],
                                        'city'=>array(
                                                'id'=>$v2['id'],
                                                'name'=>$v2['name'],
                                            )
                                        )
                                );
                              
                            }
                        }
                    }
                }
            }
            
        }
        print_r($data);
        return $this->ajaxReturn($data);
    }
    public function ajaxLaiYuanList($id){
        if($id=='')
        {
            return false;
        }
        $first_id=$id;
        $tfid=I('get.tfid');
        
        $rule=M('LanMu')->where(array('checked'=>1,'type'=>'bingren','fid'=>$id))->select();
        $str='';
        if(count($rule)>0)
        {
            foreach ($rule as $k=>$v)
            {
                if($k==0)
                {
                    $first_id=$v['id'];
                }
                if($tfid==$v['id'])
                {
                    $checked="selected='selected'";
                }else
                {
                    $checked='';
                    if($checked=='')
                    {
                        if($k==0)
                        {
                            $checked="selected='selected'";
                        }
                        $checked='';
                    }

                }
                $str.="<option ".$checked." value='".$v['id']."'>".$v['name']."</option>";
              

            }
        }
        $arr=array(
            'first_id'=>$first_id,
            'content'=>$str

        );
        return $this->ajaxReturn($arr);
    }
    public function ajaxAreaList($id=''){
        if($id=='')
        {
            return false;
        }
        $first_id=$id;
        $tfid=I('get.tfid');

        $rule=M('Area')->where(array('checked'=>1,'fid'=>$id))->select();
        $str='';
        if(count($rule)>0)
        {
            foreach ($rule as $k=>$v)
            {
                if($k==0)
                {
                    $first_id=$v['id'];
                }
                if($tfid==$v['id'])
                {
                    $checked="selected='selected'";
                }else
                {
                    $checked='';
                    if($checked=='')
                    {
                        if($k==0)
                        {
                            $checked="selected='selected'";
                        }
                        $checked='';
                    }

                }
                $str.="<option ".$checked." value='".$v['id']."'>".$v['name']."</option>";


            }
        }
        $arr=array(
            'first_id'=>$first_id,
            'content'=>$str

        );
        return $this->ajaxReturn($arr);
    }

    public  function check_phone(){
        $name=I('get.name');
        $phone=I("get.phone");
        $Model = new \Think\Model();
        $result=$Model->query("SELECT u1.id,u1.name,y1.ydatetime,y1.admin_id,a1.name as admin_name,a1.realname,y1.ks_id,k1.name 
        as ksname,y1.kstt_id,k2.`name` as kstname from __PREFIX__user as u1 LEFT JOIN __PREFIX__yu_yue 
        as y1 on y1.user_id=u1.id  LEFT JOIN __PREFIX__admin as a1 on a1.id=y1.admin_id LEFT JOIN 
        __PREFIX__ke_shi as k1 on k1.id=y1.ks_id LEFT JOIN __PREFIX__ke_shi as k2 on k2.id=y1.kstt_id  where u1.name='".$name."' and u1.tel='".$phone."'");


        if(count($result)>0)
        {
            $this->ajaxReturn($result);
        }else
        {
            return false;
        }
    }
    /*
     * 生产预约码
     */
    public function create_number($qz=''){
        $number=$number=date('Ymdhis').rand(1000,9999);
        $number=$qz.$number;
        return $this->ajaxReturn( $number);
        
    }
   public function getHuifang(){
       $uid=I('request.uid');
       $page=I('request.page');
       $pagesize=1;
       $map=array('user_id'=>$uid);
       $total=M('HuiFang')->where($map)->count();
       $pages=ceil($total/$pagesize);
       $hf=M('HuiFang')->where($map)->page($page,$pagesize)->select();
       $content='';
       if($total)
       {
           foreach ($hf as $k=>$v)
           {
               $content.="<tr>";
               $content.="
               <td>".$v['name']."</td>
                <td>".$v['type']."</td>
                <td>".$v['ways']."</td>
                <td>".$v['status']."</td>
                <td>".$v['goplace']."</td>
                <td>".to_time($v['nctime'])."</td>
               ";
               $content.="</tr>";
           }
       }
       $data=array(
           'pages'=>$pages,
           'content'=>$content
       );
       return $this->ajaxReturn($data);
   }
   public function getHuifangRenWu(){
        $uid=I('request.uid');
        $page=I('request.page');
        $pagesize=1;
        $map=array('user_id'=>$uid);
        $total=M('RenWu')->where($map)->count();
        $pages=ceil($total/$pagesize);
        $hf=M('HuiFang')->where($map)->page($page,$pagesize)->select();
        $content='';
        if($total)
        {
            foreach ($hf as $k=>$v)
            {
                $content.="<tr>";
                $content.="
               <td>".$v['name']."</td>
              
                <td>".$v['status']."</td>
          
                <td>".to_time($v['rctime'])."</td>
               ";
                $content.="</tr>";
            }
        }
        $data=array(
            'pages'=>$pages,
            'content'=>$content
        );
        return $this->ajaxReturn($data);
    }

}