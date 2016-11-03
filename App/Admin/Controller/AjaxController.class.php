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
        $err_arr=array(
                'error' => 1,
                'msg' => '非法操作'
            );
        if (!check_token($token)) {
            echo json_encode($err_arr);
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
                    echo json_encode(array(
                        'error' => 0,
                        'msg' => '删除成功'
                    ));
                } else {
                    add_log($log.'删除失败');
                    echo json_encode(array(
                        'error' => 1,
                        'msg' => '删除失败'
                    ));
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
                    echo json_encode(array(
                        'error' => 0,
                        'msg' => '成功'
                    ));
                }else
                {
                    add_log($log.'设置状态失败');
                    echo json_encode(array(
                        'error' => 1,
                        'msg' => '失败'
                    ));
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
                    echo json_encode(array(
                        'error' => 0,
                        'msg' => '成功'
                    ));
                }else
                {
                    add_log($log.'排序失败');
                    echo json_encode(array(
                        'error' => 1,
                        'msg' => '失败'
                    ));
                }

                break;
            case 'jiesuan':
                $map = array(
                    'uuid' => array(
                        'in',
                        $uuid
                    )
                );



                    $data=array(
                        $filed=>$value
                    );
                
                $result=$model->where($map)->save($data);
                if($result)
                {
                    add_log($log.'设置状态成功');
                    echo json_encode(array(
                        'error' => 0,
                        'msg' => '成功'
                    ));
                }else
                {
                    add_log($log.'设置状态失败');
                    echo json_encode(array(
                        'error' => 1,
                        'msg' => '失败'
                    ));
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
        //print_r($data);
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
       
        $phone=I("get.phone");

        $Model = new \Think\Model();
       /* $result=$Model->query("SELECT u1.id,u1.name,u1.sfcard,u1.tel2,u1.zhiye,u1.xueli,u1.is_jiehun,u1.level,u1.level_card,u1.intro_name,u1.email,u1.zalo,u1.facebook,u1.phone_bank,u1.address,u1.bingshi,u1.birthday,u1.age,u1.sex,y1.ydatetime,y1.admin_id,a1.name as admin_name,a1.realname,y1.ks_id,k1.name 
        as ksname,y1.kstt_id,k2.`name` as kstname from __PREFIX__user as u1 LEFT JOIN __PREFIX__yu_yue 
        as y1 on y1.user_id=u1.id  LEFT JOIN __PREFIX__admin as a1 on a1.id=y1.admin_id LEFT JOIN 
        __PREFIX__ke_shi as k1 on k1.id=y1.ks_id LEFT JOIN __PREFIX__ke_shi as k2 on k2.id=y1.kstt_id  where  u1.tel='".$phone."'");*/
        $result=$Model->query("SELECT u1.id,u1.name,u1.sfcard,u1.tel2,u1.zhiye,u1.xueli,u1.is_jiehun,u1.level,u1.level_card,u1.intro_name,u1.email,u1.zalo,u1.facebook,u1.phone_bank,u1.address,u1.bingshi,u1.birthday,u1.age,u1.sex from __PREFIX__user as u1 LEFT JOIN __PREFIX__yu_yue 
        as y1 on y1.user_id=u1.id  LEFT JOIN __PREFIX__admin as a1 on a1.id=y1.admin_id LEFT JOIN 
        __PREFIX__ke_shi as k1 on k1.id=y1.ks_id LEFT JOIN __PREFIX__ke_shi as k2 on k2.id=y1.kstt_id  where  u1.tel='".$phone."'");


        if(count($result)>0)
        {
            $this->ajaxReturn($result);
        }else
        {
            return false;
        }
    }
    public  function  getYuShen($id,$ysid='',$checked=''){
        $rule=M('KeShi')->where(array('checked'=>1,'type'=>'yushen','fid'=>$id))->select();
        $str='';
        if(count($rule)>0)
        {
            foreach ($rule as $k=>$v)
            {

                if($ysid==$v['id'])
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
                        }else
                        {
                            $checked='';
                        }

                    }

                }
                $str.="<option ".$checked." value='".$v['id']."'>".$v['name']."</option>";


            }
        }
        $arr=array(

            'content'=>$str

        );
        return $this->ajaxReturn($arr);
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
       $pagesize=20;
       $map=array();
       $map['h1.user_id']=$uid;
       $this->check_group("huihfrenwu_list");
       $model = M('HuiFang');
       $join[] = 'LEFT JOIN __USER__ u1 ON h1.user_id = u1.id';
       $join[] = 'LEFT JOIN __LAN_MU__ l2 ON l2.id = h1.type';//类型
       $join[] = 'LEFT JOIN __LAN_MU__ l3 ON l3.id = h1.ways';//方式
       $join[] = 'LEFT JOIN __LAN_MU__ l4 ON l4.id = h1.result_cont';//结果
       $join[] = 'LEFT JOIN __LAN_MU__ l5 ON l5.id = h1.goplace';//去向
       $join[] = 'LEFT JOIN __ADMIN__ a1 ON h1.admin_id = a1.id';
       $filed = '
          h1.ctime,
          h1.status as status,
          h1.uuid as uuid,
          h1.content as content,
          l2.name as type,
          l3.name as ways,
          l5.name as goplace,
          u1.name as user_name ,
          u1.tel as tel,
          u1.id as user_id,
          h1.name as name,
          l4.name as result_cont,
          a1.realname as admin_name
        ';
      
       //是否只能查看自己的
       if(!check_group('root'))
       {
           if(check_group('huifangset_only'))
           {
                $map['_string']="h1.admin_id ='".session('admin_id')."'";
           }
       }
               
        $total = $model->alias('h1')->join($join)->where($map)->count();// 
        $pages=ceil($total/$pagesize);
        

        $list = $model->alias('h1')->field($filed)->join($join)->order('h1.ctime desc,h1.id desc')->where($map)->page($page . ',' . $pagesize)->select();
       

       $content='';
       $status=array(
           '1'=>'已回访',
           '0'=>'待回访'
       );
       if($total)
       {
           foreach ($list as $k=>$v)
           {
              
               $content.="<tr>
               <td>".$v['type']."</td>
               <td><span class='".btn_yycolor($v['status']+1)."'>".$status[$v['status']]."</span></td>
               <td>".$v['ways']."</td>
               <td class='text-blue'><a data-close='' data-w='600px' data-title='".lang('查看情况')."' data-h='500px' data-layer='1' data-url='".U('Admin/HuiFang/show',array('id'=>$v['uuid']))."' class='text-blue' >".$v['name']."</a></td>
               <td>".$v['goplace']."</td>
               <td>".$v['result_cont']."</td>
               <td class='text-info'>".to_time($v['ctime'])."</td>
               
               <td>".$v['admin_name']."</td>
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
        $pagesize=20;
        $map=array('user_id'=>$uid);

        if(I('get.status')!='')
        {
         
           $map['status']=I('get.status');
        }
        $model = M('RenWu');
        //是否只能查看自己的
        if(!check_group('root'))
        {
            if(check_group('hfrenwu_only') && check_group('hfrenwu_only_handle'))
            {
                 $map['_string']="rewu.admin_id ='".session('admin_id')."' or rewu.handle_id ='".session('admin_id')."'";
            }elseif(check_group('hfrenwu_only'))
            {
                 $map['_string']="rewu.admin_id ='".session('admin_id')."'";
            }
        }

        $join[] = 'LEFT JOIN __USER__ u1 ON rewu.user_id = u1.id';
        $join[] = 'LEFT JOIN __ADMIN__ a1 ON rewu.admin_id = a1.id';
        $join[] = 'LEFT JOIN __ADMIN__ fp ON rewu.handle_id = fp.id';
        $join[] = 'LEFT JOIN __LAN_MU__ lx ON lx.id = rewu.type_id';
        $filed ='
        rewu.id as id,
        rewu.status as status,
        rewu.uuid as uuid,
        rewu.name as name,
        lx.name as type_text,
        rewu.ctime as ctime,
        rewu.rtime as rtime,
        a1.realname as create_name,
        fp.realname as handle_name,
        u1.name as user_name,
        u1.tel as tel,
        u1.id as user_id
        ';
        
         
         $total = $model->alias('rewu')->join($join)->where($map)->count();// 查询满足要求的总记录数
         $pagesize = (C('PAGESIZE')) != '' ? C('PAGESIZE') : '50';
         $pages=ceil($total/$pagesize);
        

        $list = $model->alias('rewu')->field($filed)->join($join)->order('rewu.ctime desc,rewu.id desc')->where($map)->page($page . ',' . $pagesize)->select();
        //print_r($list);
        $content='';
        $status=array(
            '1'=>'已回访',
            '0'=>'待回访'
        );
        
        if($total)
        {

            foreach ($list as $k=>$v)
            {
               
                $content.="<tr>
                <td class='text-blue'>".$v['name']."</td>
                <td>".$v['type_text']."</td>
                <td><span class='".btn_yycolor($v['status']+1)."'>".$status[$v['status']]."</span></td>
                <td class='text-blue'>".to_time($v['rtime'])."</td>
                <td class='text-info'>".to_time($v['ctime'])."</td>
                <td>".$v['create_name']."</td>
                <td>".$v['handle_name']."</td>
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
    //查看确诊
   public function getCheckShow($yid){
       
        $page=I('request.page');
        $pagesize=20;
        $map=array(
            'jz.yy_id'=>$yid
            );
        $m=M('JieZhen');
        //病区域
        $join[]='LEFT JOIN __KE_SHI__ ks1 ON jz.ks_id = ks1.id';
        $join[]='LEFT JOIN __KE_SHI__ ks2 ON jz.kst_id = ks2.id';
        $join[]='LEFT JOIN __KE_SHI__ ks3 ON jz.kstt_id = ks3.id';
        //用户，医生
        $join[]='LEFT JOIN __USER__ u1 ON jz.user_id = u1.id';
       //手术医生
        $join[]='LEFT JOIN __KE_SHI__ ys ON jz.ysz_id = ys.id';
        //管理员的医生组
        $join[]='LEFT JOIN __ADMIN__ ys2 ON jz.ys_id = ys2.id';
        $join[]='LEFT JOIN __LAN_MU__ zl ON jz.zl_id = zl.id';

        $filed = '
            jz.thumbs as thumbs,
           jz.id as id,
           jz.jz_content as jz_content,
           jz.uuid as uuid,
           jz.jztime as jztime,
           ks1.name as ksname,
           ks2.name as kstname,
           ks3.name as ksttname,
           u1.name as user_name,
           ys2.realname as yushen_name,
           ys.name as yushenss_name,
           zl.name as zlname
         ';

         $total=$m->alias('jz')->join($join)->where($map)->count();// 查询满足要求的总记录数
         $pages=ceil($total/$pagesize);
         $m=$m->alias('jz')->field($filed)->join($join)->where($map)->order('jz.jztime desc ')->page($page,$pagesize)->select();
        
         
         $content='';
         if($total)
         {
             foreach ($m as $k=>$v)
             {
                 $content.="<tr style='background: #fff' class='js-tr'>";
                 $delurl=U('Admin/HuiFang/del',array('id'=>$v['huuid']));
                  $del='<a href="'.$delurl.'" class="btn btn-xs btn-white" > <span class="fa fa-trash "></span>
                                                          删除</a>
                  ';
                  //查看详情
                  $showurl=U('Admin/YuShen/getCheckshow',array('id'=>$v['id']));
                  $detail='
                    <a href="javascript:void(0)"  class="js-open-more btn btn-xs btn-white"><span
                            class=" glyphicon-plus glyphicon-plus"></span>'.lang('展开').'</a>
                  ';
                  $detail.='
                    <a href="'.U('Admin/YuShen/quecheck_edit',array('id'=>$v['id'],'tpl'=>'quecheck_thumbs')).'"  class=" btn btn-xs btn-white"><span
                            class=" glyphicon-plus glyphicon-plus"></span>'.lang('上传照片').'</a>
                  ';
                  $detail.='
                    <a href="'.U('Admin/YuShen/quecheck_edit',array('id'=>$v['id'])).'"  class=" btn btn-xs btn-white"><span
                            class=" glyphicon-plus glyphicon-plus"></span>'.lang('修改').'</a>
                  ';
                  /*$detail.='
                    <a href="'.U('Admin/YuShen/quecheck_edit',array('id'=>$v['id'])).'"  class=" btn btn-xs btn-primary"><span
                            class=" glyphicon-plus glyphicon-plus"></span>'.lang('开单').'</a>
                  ';*/

                  $v['ksttname']=$v['ksttname']==''?'':"~".$v['ksttname'];
                  $v['kstname']=$v['kstname']==''?'':"~".$v['kstname'];
                 $content.="
                 <td>".to_time($v['jztime'],'d-m-Y')."</td>
                  <td>".$v['user_name']."</td>
                  <td>".$v['yushenss_name']."</td>
                  <td>".$v['yushen_name']."</td>
                  <td>".$v['ksname'].$v['kstname'].$v['ksttname']."</td>
                  <td>".$v['zlname']."</td>
                  <td>". $detail."</td>
                  
                
                  ";
                 
                  $thumbs=json_decode(htmlspecialchars_decode($v['thumbs']),true);
                  $sb=htmlspecialchars_decode($v['jz_content']);
                
                  $pic_str='';
                  if($thumbs)
                  {
                        
                      foreach($thumbs as $v)
                      {
                        $pic_str.='
                        
                          <div class="col-xs-4 col-md-3">
                            <a href="#" class="thumbnail">
                              <img data-url="'.$v['path'].'" src="'.pic_url($v['path']).'" alt="">
                            </a>
                          
                        </div>
                        
                         
                      ';
                      }
                  
                  }

                 $content.="</tr><tr style='display:none'>
                    <td colspan='6'>
                    <div class='roww'>
                        ".$pic_str."
                       
                    </div>
                    <div class='roww'>".$sb."</div>
                        
                    <td>
                 </tr>";
                 
             }
         }
         $data=array(
             'pages'=>$pages,
             'content'=>$content
         );
          //print_r($data);

         return $this->ajaxReturn($data);
   }
    public function getPriceList(){

        $uid=I('request.uid');
        $page=I('request.page');
        $fid=I('request.ks_id');
        $tfid=I('request.kst_id');

        $key=I('request.key');

        $map=array();

        if($fid)
        {
            $map['pr.fid']=$fid;

        }
       
         if($key)
        {
            $map2['pr.name']=array('like','%'.$key.'%');
            $map2['pr.code']=array('like','%'.$key.'%');
            
            $map2['_logic'] = 'OR';
            $map['_complex']=$map2;
           
           
        }
        $field='
        pr.id as id,
        pr.name as name,
        pr.ticket_name as ticket_name,
        pr.price as price,
        pr.danwei as danwei,
        pr.is_update as is_update,
        pr.code as code,
        pr.fid as fid,
        xf.name as xf_name
        ';
        $join[] = 'LEFT JOIN __LAN_MU__ xf ON pr.fid = xf.id';
        $pagesize=12;
        $total=M('Price')->alias('pr')->join($join)->where($map)->count();// 查询满足要求的总记录数
        $pages=ceil($total/$pagesize);
        $m=M('Price')->alias('pr')->field($field)->join($join)->where($map)->order('pr.id desc')->page($page,$pagesize)->select();
        //print_r($m);
        $str='';
        if(count($m)>0)
        {
            foreach ($m as $key => $v) {
                
                if($v['is_update']!='1')
                {
                    $price_edit='readonly';
                }else
                {
                    $price_edit='none';
                }
                 $str.='
                    <div class="col-xs-6 col-sm-3 price_item " data-edit="'.$price_edit.'" data-xfname="'.$v['xf_name'].'" data-id="'.$v['id'].'" data-fid="'.$v['fid'].'" data-name="'.$v['name'].'"  
                    data-price="'.$v['price'].'" data-danwei="'.$v['danwei'].'" data-num="1" data-ticket="'.$v['ticket_name'].'" >
                        <div class="panel panel-default" style="margin-bottom:0">
                           
                             
                             <div class="panel-heading" ><span class="label label-info m-r">'.$v['xf_name'].'</span>'.$v['name'].'</div>
                            
                            
                        </div>
                        
                    </div>
                ';
               /* $str.='
                    <div class="col-xs-6 col-sm-3 price_item">
                        <div class="panel panel-default >
                            <input hidden="fid" class="price_ks" value="'.$v['fid'].'">
                             
                             <div class="panel-heading"><span class="price_title">'.$v['name'].'</span></div>
                             <div class="panel-body">
                                <div class="input-group">
                                    <span class="input-group-addon">'.lang('票据名称').'：</span>
                                    <input type="text" class="form-control price_pj" readonly="" value="'.$v['ticket_name'].'" >
                                </div>
                                <div class="input-group">
                                    <span class="input-group-addon">'.lang('价格').'</span>
                                    <input type="text"  class="form-control price_jg" min="0" '. $price_edit.' value="'.$v['price'].'" >
                                </div>
                                <div class="input-group">
                                    <span class="input-group-addon">'.lang('单位').'</span>
                                    <input type="text" class="form-control price_dw" readonly="" value="'.$v['danwei'].'" >
                                </div>
                                <div class="input-group">
                                    <span class="input-group-addon">'.lang('开单数量').'</span>
                                    <input type="text" class="form-control price_num"  value="1" placeholder="">
                                </div>
                                <div class="input-group">
                                    <span class="input-group-addon">'.lang('合计金额').'</span>
                                    <input type="text" class="form-control price_heji" readonly="" value="'.$v['price'].'" >
                                </div>
                                <div class="panel-footer" style="display:none">
                                    <a href="javascript:void(0)" class="label label-primary js_remove_price">'.lang("删除").'</a>
                                    <a href="javascript:void(0)" class="label label-primary js_left_price">'.lang("上移动").'</a>
                                    <a href="javascript:void(0)" class="label label-primary js_right_price">'.lang("下移动").'</a>
                                </div>
                            </div>
                            
                        </div>
                        
                    </div>
                ';*/
            }
        }

        $data=array(
            'pages'=>$pages,
            'content'=>$str
        );

        return $this->ajaxReturn($data);
       
    }
    public function getUserList(){
        $key=trim(I('request.key'));
        $map=array();

        $map['_string'] = "name like '".$key."%' or tel like '%".$key."%' or id = '".$key."'";
        $m=M('User')->where($map)->find();
        return $this->ajaxReturn($m);
    }

    //查看手机号码
    public function showPhone($uid=''){
        $user=M('User')->find($uid);
        $data=array();
        if(count($user)>0)
        {
            $data=array(
                'phone'=>$user['tel']
                );
            add_smslog($uid);
           
        }
        return $this->ajaxReturn($data);
        
    }
    public function getYouHui(){
        $code=I('get.code');
        $uid=I('get.uid');
        $map=array(
                'code'=>$code,
                'checked'=>1,
                'ltime'=>array('gt',time()),
                'user_id'=>$uid
            );
        $m=M('Card')->where($map)->find();
        if(count($m)>0)
        {
            return $this->ajaxReturn($m);
        }
    }
}
