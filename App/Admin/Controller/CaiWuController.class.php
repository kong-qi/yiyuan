<?php
namespace Admin\Controller;
class CaiWuController extends AuthController {
    protected $onname='收费';
    protected $rule_qz='shouyinn';
    public function index(){
        $this->check_group('shouyin');
        $map=array();
        $model=M('KaiDan');
        $join[] = 'LEFT JOIN __USER__ u1 ON kd.user_id = u1.id';
        $join[] = 'LEFT JOIN __ADMIN__ a1 ON kd.admin_id = a1.id';
        $join[] = 'LEFT JOIN __LAN_MU__ sf ON kd.shoufei_id = sf.id';
        $join[] = 'LEFT JOIN __LAN_MU__ js ON kd.js_status = js.id';

        $page=1;
        if(isset($_GET['p']))
        {
            $page=$_GET['p'];
        }
         $filed = '
            kd.id as id,
            kd.yuyue_id as yid,
            kd.uuid as uuid,
            kd.kd_time as kd_time,
            kd.kd_name as kd_name,
            kd.is_liaoxiao as is_liaoxiao,
            kd.price_show,
            kd.price_total,
            kd.shoufei_id as shoufei_id,
            kd.js_status as js_status,
            u1.name as user_name,
            sf.name as sfname,
            js.name as jsname
           
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
            8=>'收费状态',
            9=>'结算状态',
            10=>'操作'
           
           
            );
        $this->menu_list=$menu_list;
        print_r($list);
        //取得结算
        $js_arr=set_arr_to('LanMu',array('type'=>'jiesuan'));
        print_r($js_arr);

        $this->assign('list',$list);// 赋值数据集
        

        $this->display();
    }
  
    
    public function add($id){
        //权限选择
        //$this->check_group($this->rule_qz."_check");
        $map=array();
        $model=M('KaiDan');
        $join[] = 'LEFT JOIN __USER__ u1 ON kd.user_id = u1.id';
        $join[] = 'LEFT JOIN __ADMIN__ a1 ON kd.admin_id = a1.id';
        $join[] = 'LEFT JOIN __LAN_MU__ sf ON kd.shoufei_id = sf.id';
        $join[] = 'LEFT JOIN __LAN_MU__ js ON kd.js_status = js.id';

        $filed = '
           kd.id as id,
           kd.yuyue_id as yid,
           kd.uuid as uuid,
           kd.kd_time as kd_time,
           kd.kd_name as kd_name,
           kd.is_liaoxiao as is_liaoxiao,
           kd.price_show,
           kd.price_total,
           kd.shoufei_id as shoufei_id,
           kd.js_status as js_status,
           u1.name as user_name,
           u1.age as age ,
           u1.sex as sex,
           sf.name as sfname,
           js.name as jsname
          
        ';
        $m=$model->alias('kd')->field($filed)->join($join)->find($uid);
        print_r($m);
        $this->data=$m;

        
        $this->display();
        

    }
   
 
    public function edit(){
        //权限选择

        $this->check_group($this->rule_qz."_edit");
        if(IS_POST)
        {
            $model =D('XiaoFei');

            if($model->create()) {
                $data=$model->create();
                $id=$data['id'];
                if(($data['pwd'])!='')
                {
                    $data['pwd']=sha1($data['pwd']);
                }else
                {
                    unset($data['pwd']);
                }

                $result =   $model->save($data);

                if($result) {
                    $msg=lang('更新成功','handle');
                     add_log($this->onname.'：'.$data['name'].'更新成功');
                    $msg=lang('更新成功','handle');
                    $backurl=U(MODULE_NAME."/".CONTROLLER_NAME."/index");
                    echo "<script language='javascript'>var index = parent.layer.getFrameIndex(window.name); parent.layer.msg('".$msg."'); parent.location.reload();;parent.layer.close(index);</script>";
                    //return  $this->success(lang('更新成功','handle'),'/Admin/edit',$id);
                }else{

                    $msg=lang('数据一样无更新','handle');
                    echo "<script language='javascript'>var index = parent.layer.getFrameIndex(window.name); parent.layer.msg('".$msg."');parent.layer.close(index);;parent.layer.close(index)</script>";
                }
            }else{
                return $this->error($model->getError());
            }
        }else{
            $id=I('get.uuid');
            $map=array(
            'uuid'=>$id
            );

            $model   =   M('XiaoFei')->where($map)->find();
            
            $rule=get_wangixao_where(array('is_website'=>'1','type'=>'bingren'),'1','',$model['xf_id']);
           
            $this->rule=$rule;


          
            if($model) {
                $this->data =  $model;// 模板变量赋值
            }else{
                return $this->error(lang('数据错误','handle'));
            }
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