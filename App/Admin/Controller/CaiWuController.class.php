<?php
namespace Admin\Controller;
class CaiWuController extends AuthController {
    protected $onname='收费';
    protected $rule_qz='shouyinn';
    public function index($status=0,$is_js=0){
        $this->check_group('shouyin');
        $map=array(
            'kd.sf_status'=>$status,
            'kd.js_status'=>$is_js
            );
        $model=M('KaiDan');
        $join[] = 'LEFT JOIN __USER__ u1 ON kd.user_id = u1.id';
        $join[] = 'LEFT JOIN __ADMIN__ ys ON kd.kd_id = ys.id';
         
        
         $join[] = 'LEFT JOIN __JIE_ZHEN__ jz ON kd.jz_id = jz.id';
          $join[] = 'LEFT JOIN __KE_SHI__ jzys ON jz.ysz_id = jzys.id';

        $page=1;
        if(isset($_GET['p']))
        {
            $page=$_GET['p'];
        }
         $filed = '
            kd.id as id,
            kd.is_yf as is_yf,
            kd.sf_status as sf_status,
            kd.uuid as uuid,
            kd.kd_time as kd_time,
           
            kd.js_status as js_status,
            kd.price_show,
            kd.price_total,
            jzys.name as sy_name,
            u1.name as user_name,
            ys.realname as kd_name
           
         ';

        $count = $model->alias('kd')->join($join)->where($map)->count();// 查询满足要求的总记录数

        $pagesize=(C('PAGESIZE'))!=''?C('PAGESIZE'):'20';
        $list =  $model->alias('kd')->field($filed)->join($join)->where($map)->order('kd.id desc')->page( $page.','.$pagesize)->select();
         $menu_list= array(
          
            2=>'开单时间',
            3=>'姓名',
            4=>'消费项目',
            5=>'合计总价',
            6=>'是否疗程次数消费',
            7=>'咨询医生',
            8=>'收费状态',
            9=>'结算状态',
            10=>'操作'
           
           
            );
        $this->menu_list=$menu_list;
       
        //取得结算
        $js_arr=set_arr_to('LanMu',array('type'=>'jiesuan'));
        
        if($status==1 and $is_js==0)
        {
             $this->is_js=$is_js;
        }
       

        $this->assign('list',$list);// 赋值数据集
        

        $this->display();
    }
  
    
    public function add(){
        //权限选择
        //$this->check_group($this->rule_qz."_check");
        if(IS_POST)
        {
            $post=I('post.');
            $data['id']=$post['id'];
            $data['sf_time']=time();
            $data['sf_admin_id']=session('admin_id');
            if($post['youhui_id']!='')
            {
                $data['youhui_id']=$post['youhui_id'];
            }
            if($post['sf_status']=='2')
            {
                $data['yf_money']=$post['yf_money'];
                $data['sf_status']=2;

                $data['is_yf']=1;

            }else
            {
                if($post['shishou_price']!='')
                {
                    $data['shishou_price']=$post['shishou_price'];
                }
                if($post['shuaka_price']!='')
                {
                    $data['shuaka_price']=$post['shuaka_price'];
                }
                if($post['other_price']!='')
                {
                    $data['other_price']=$post['other_price'];
                }
                if($post['youhui_total']!='')
                {
                    $data['youhui_total']=$post['youhui_total'];
                }
                if($post['youhui_price']!='')
                {
                    $data['youhui_price']=$post['youhui_price'];
                }
                $data['sf_status']=1;
            }
            
            $result=M('KaiDan')->save($data);
            if($result) {
                //更新优惠券
                if($post['youhui_id']!=''){
                    $yhq_data=array(
                            'utime'=>time(),
                            'kd_id'=>$data['id']
                        );
                    M('Card')->where(array('id'=>$post['youhui_id']))->save($yhq_data);
                }
                add_log($this->onname.'：'.$data['name'].'提交成功');
                $msg=lang('提交成功','handle');
                $backurl=U(MODULE_NAME."/".CONTROLLER_NAME."/index");
                echo "<script language='javascript'>var index = parent.layer.getFrameIndex(window.name); parent.layer.msg('".$msg."'); parent.location.reload();;parent.layer.close(index);</script>";
                //return  $this->success(lang('更新成功','handle'),'/Admin/edit',$id);
            }else{

                $msg=lang('数据一样无更新','handle');
                echo "<script language='javascript'>var index = parent.layer.getFrameIndex(window.name); parent.layer.msg('".$msg."');parent.layer.close(index);;parent.layer.close(index)</script>";
            }

        }else
        {
            $uid=I('get.id');
            $map=array();
            $model=M('KaiDan');
            $join[] = 'LEFT JOIN __USER__ u1 ON kd.user_id = u1.id';
            $join[] = 'LEFT JOIN __KE_SHI__ ys ON kd.kd_id = ys.id';
             
            
             $join[] = 'LEFT JOIN __JIE_ZHEN__ jz ON kd.jz_id = jz.id';
              $join[] = 'LEFT JOIN __KE_SHI__ jzys ON jz.ysz_id = jzys.id';

            

            $filed = '
                kd.id as id,
                kd.sf_status as sf_status,
                kd.yy_id as yy_id,
                kd.uuid as uuid,
                kd.kd_time as kd_time,
                kd.sf_status,
                kd.js_status,
                kd.price_show,
                kd.price_total,
                jzys.name as sy_name,
                u1.name as user_name,
                u1.id as user_id,
                ys.name as kd_name
               
             ';

            $m=$model->alias('kd')->field($filed)->join($join)->where(array('kd.id'=>$uid))->find();
            //print_r($m);
            $this->data=$m;

            
            $this->display();
        }
        
        

    }
   
 
   
    public  function del(){
        //权限选择
        $this->check_group($this->rule_qz."_del");
        $id=I('get.id');
        $map=array(
            'uuid'=>$id
        );
        $model   =   D("XiaoFei");
        $data=$model->where($map)->find();
        $result=$model->where($map)->delete();
        if($result)
        {
            add_log($this->onname.'：'.$data['name'].'删除成功');
            return  $this->success(lang('删除成功','handle'));;
        }
        add_log($this->onname.'：'.$data['name'].'删除失败');
        return $this->error(lang('删除失败','handle'));;
    }
    public function handle($id){
        //权限选择
        $this->check_group($this->rule_qz."_edit");
        $model =M("XiaoFei");
        $type=I('get.type');
        if($type=='true')
        {
            $status=1;
        }else
        {
            $status=0;
        }
        $data['id'] =$id;
        $data['checked'] = $status;


        if($model->save($data)){

            return  $this->success(lang('更新成功','handle'));
            $msg=lang('更新成功','handle');
            $backurl=U(MODULE_NAME."/".CONTROLLER_NAME."/index");
            echo "<script language='javascript'>var index = parent.layer.getFrameIndex(window.name); parent.layer.msg('".$msg."');parent.layer.close(index);window.location='".$backurl."';</script>";
        }else
        {
            $msg=lang('更新失败','handle');
            return  $this->success(lang('更新失败','handle'));
            $backurl=U(MODULE_NAME."/".CONTROLLER_NAME."/index ");
            echo "<script language='javascript'>var index = parent.layer.getFrameIndex(window.name); parent.layer.msg('".$msg."');parent.layer.close(index);window.location='".$backurl."';</script>";
        }
    }
    public function kaidanList(){
        $this->check_group('kaidan');
        $map=array();
        $model=M('KaiDan');
        $join[] = 'LEFT JOIN __USER__ u1 ON kd.user_id = u1.id';
        $join[] = 'LEFT JOIN __ADMIN__ a1 ON kd.admin_id = a1.id';

        $page=1;
        if(isset($_GET['p']))
        {
            $page=$_GET['p'];
        }
         $filed = '
            kd.id as id,kd.uuid as uuid,kd.kd_time as kd_time,kd.kd_name as kd_name,kd.is_liaoxiao as is_liaoxiao,kd.price_show,kd.price_total,
            u1.name as user_name
           
         ';

        $count = $model->alias('kd')->join($join)->where($map)->count();// 查询满足要求的总记录数

        $pagesize=(C('PAGESIZE'))!=''?C('PAGESIZE'):'20';
        $list =  $model->alias('kd')->field($filed)->join($join)->order('kd.id desc')->page( $page.','.$pagesize)->select();
         $menu_list= array(
          
            2=>'开单时间',
            3=>'姓名',
            4=>'消费项目',
            5=>'合计总价',
            6=>'是否疗程次数消费',
            7=>'咨询医生',
           
           
            );
        $this->menu_list=$menu_list;

        $this->assign('list',$list);// 赋值数据集
        

        $this->display();
    }
}