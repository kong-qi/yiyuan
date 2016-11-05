<?php
namespace Admin\Controller;
class GongZuoLiangController extends AuthController {
    protected $onname='咨询工作量';
    protected $rule_qz='gongzuoliang';
    public function index(){
        //权限选择
        $this->check_group('gongzuoliang');
        $model=M('Gzl');
        $map=array();
        $stime=strtotime(I('get.stime'));
        $etime=strtotime(I('get.etime'));
        if($stime!=='' and $etime !='')
        {
            $timestr =  $stime. "," .$etime;
            $map['g1.cdate'] = array('between', $timestr);
        }
        if(I('get.admin_id')!='')
        {
            $map['g1.admin_id']=I('get.admin_id');
        }
        $gj_id='';
        if(I('get.gj_id')!='')
        {
            $map['g1.gj_id']=I('get.gj_id');
            $gj_id=I('get.gj_id');
        }



        //找出咨询员
        //$zixuner=M('Gzl')->field('admin_id as id')->group('admin_id')->select();
        $zixuner=m()->query("select * from __PREFIX__admin where id in (select admin_id as id from __PREFIX__gzl group by admin_id )");
        $this->assign('zxer',$zixuner);

        $rule=get_huifang_where(array('is_tongji'=>'1','type'=>'zixun'),'1','','', $gj_id);
        $this->rule=$rule;

        $join[] = 'LEFT JOIN __LAN_MU__ l1 ON g1.gj_id = l1.id';
        $join[] = 'LEFT JOIN __ADMIN__ a1 ON g1.admin_id = a1.id';

       
       
   
        $page=1;
        if(isset($_GET['p']))
        {
            $page=$_GET['p'];
        }
         $filed = '
            a1.realname as admin_rname,
            a1.name as admin_name,
            g1.cdate as cdate,
            g1.uuid as guuid,
            g1.id as gid,
            g1.admin_id as admin_id,
            l1.name,
            g1.duihualiang,
            g1.zixunliang,
            g1.aduihua,
            g1.bduihua,
            g1.cduihua,
            g1.dduihua,
            g1.ctime as ctime
         ';

        $count = $model->alias('g1')->join($join)->where($map)->count();// 查询满足要求的总记录数

        $pagesize=(C('PAGESIZE'))!=''?C('PAGESIZE'):'20';
        $list =  $model->alias('g1')->field($filed)->join($join)->where($map)->order('g1.cdate desc')->page( $page.','.$pagesize)->select();
        $this->assign('list',$list);// 赋值数据集

        $this->assign('page',page( $count ,$map,$pagesize));// 赋值分页输出
       
        $this->display();
    }
    public function add(){
        //权限选择
        $this->check_group('gongzuoliang_add');
        if(IS_POST)
        {

            $model=D('Gzl');

            if($model->create())
            {

                $data=$model->create();
                $data['cdate']=strtotime($data['cdate']);
                $data['admin_id']=session('admin_id');
                
                $result =    $model->add($data);
                if($result) {
                    add_log($this->onname.'：'.$data['name'].'添加成功');
                    $msg=lang('添加成功','handle');
                    $backurl=U(MODULE_NAME."/".CONTROLLER_NAME."/add");
                    echo "<script language='javascript'>var index = parent.layer.getFrameIndex(window.name); parent.layer.msg('".$msg."');window.location='".$backurl."';parent.layer.close(index);</script>";
                }else{
                    add_log($this->onname.'：'.$data['name'].'添加失败','/Admin/add');
                    $msg=lang('添加失败','handle');
                    $backurl=U(MODULE_NAME."/".CONTROLLER_NAME."/add");
                    echo "<script language='javascript'>var index = parent.layer.getFrameIndex(window.name); parent.layer.msg('".$msg."');parent.layer.close(index);</script>";
                }
            }else
            {
                $this->error($model->getError());
            }
        }else
        {
            $rule=get_huifang_where(array('is_tongji'=>'1','type'=>'zixun'));
          
            $this->rule=$rule;
            $this->display();
        }

    }
    public function edit(){
        //权限选择

        $this->check_group('gongzuoliang_edit');
        if(IS_POST)
        {
            $model =D('Gzl');

            if($model->create()) {
                $data=$model->create();
                $data['cdate']=strtotime($data['cdate']);
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

            $model   =   M('Gzl')->where($map)->find();
            $rule=get_huifang_where(array('is_tongji'=>'1','type'=>'zixun'),'1','','',$model['gj_id']);
           
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
        $this->check_group('gongzuoliang_del');
        $id=I('get.id');
        $map=array(
            'uuid'=>$id
        );
        $model   =   D('Gzl');
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
        $this->check_group('gongzuoliang_edit');
        $model =M(CONTROLLER_NAME);
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
}