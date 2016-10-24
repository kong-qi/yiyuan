<?php
namespace Admin\Controller;
class YuShenController extends AuthController {
    protected $onname='医生接诊';
    protected $rule_qz='yishenjz';
    public function quecheck(){
        $this->check_group($this->rule_qz."_add");
        $id=I('get.uuid');

        $map=array(
            'uuid'=>$id
        );

        $model   =   D('YuYue')->relation(true)->where($map)->find();

       



        if($model) {
            $this->data =  $model;// 模板变量赋值
        }else{
            return $this->error(lang('数据错误','handle'));
        }

        $this->display();
    }
    //查看确诊，针对病人
    public function showcheck($yid){
        $this->yid=$yid;
        $this->display();

    }
    public function quecheck_edit($id){
        //需要更新到预约表里面，接诊表连接了预约表，ysz_id,手术医生ID，yztime//接诊时间
        //接诊表：yy_id,jztime接诊时间，zl_id：质量评级，ks_id：科室ID，kst_id科室2ID,手术科室jzks_id，手术医生ysz_id
        //预约表：ys_id:医生id，ysz_id：手术医生jzks_id，dz_id质量评级，jztime:接诊时间,qz_id接诊id
        if(IS_POST)
        {
             M()->startTrans();
             $model=D('JieZhen');

             if($data=$model->create())
             {
                $data['jzedtime']=time();//接诊更新时间
                $ydata['id']=$data['yy_id'];
                $ydata['ks_id']=$data['ks_id'];
                $ydata['kst_id']=$data['kst_id'];
                $ydata['kstt_id']=$data['kstt_id'];
                $ydata['ysz_id']=$data['ysz_id'];
                $ydata['jzks_id']=$data['jzks_id'];//手术科室ID
                $ydata['status']=3;
                $ydata['dz_id']=$data['zl_id'];//质量评级
               
                foreach ($ydata as $key => $value) {
                    if($value=='')
                    {
                        unset($ydata[$key]);
                    }
                }
                
               // print_r($ydata);
               /*  print_r($data);
                 exit();*/
                $result =    $model->save($data);
                //如果没有更改这些信息，则无需。
                $yresult=M('YuYue')->data($ydata)->save();

                if($result ) {

                    M()->commit();
                    add_log($this->onname.'：'.$data['name'].'更新成功');
                    $msg=lang('更新成功','handle');

                    add_log($this->onname.'：'.$data['name'].'更新成功');

                    return $this->success($msg);
                    // echo "<script language='javascript'>var index = parent.layer.getFrameIndex(window.name); parent.layer.msg('".$msg."');window.location='".$backurl."';</script>";
                }else{
                    M()->rollback();
                    add_log($this->onname.'：'.$data['name'].'更新失败');
                    $msg=lang('更新失败','handle');
                    return $this->success($msg);
                    //$backurl=U(MODULE_NAME."/".CONTROLLER_NAME."/index");
                    //echo "<script language='javascript'>var index = parent.layer.getFrameIndex(window.name); parent.layer.msg('".$msg."');window.location='".$backurl."';</script>";
                }
            }
            
        }else
        {
            $m=D('JieZhen')->relation(true)->find($id);
            $tpl=I('get.tpl');

            $this->data=$m;
            if($tpl!='')
            {
               $this->display('YuShen:'.$tpl);
            }else
            {
                $this->display();
            }
            
        }
       
    }
    public function queck_edit_thumbs(){
        if(IS_POST)
        {
             
             $model=D('JieZhen');

             if($data=$model->create())
             {
               
                $result =    $model->save($data);
               

                if($result ) {

                  
                    add_log($this->onname.'：'.$data['name'].'更新照片成功');
                    $msg=lang('更新照片成功','handle');

                    add_log($this->onname.'：'.$data['name'].'更新照片成功');

                    return $this->success($msg );
                    // echo "<script language='javascript'>var index = parent.layer.getFrameIndex(window.name); parent.layer.msg('".$msg."');window.location='".$backurl."';</script>";
                }else{
                   
                    add_log($this->onname.'：'.$data['name'].'照片一样，无需更新');
                    $msg=lang('照片一样，无需更新','handle');
                    return $this->success($msg);
                    //$backurl=U(MODULE_NAME."/".CONTROLLER_NAME."/index");
                    //echo "<script language='javascript'>var index = parent.layer.getFrameIndex(window.name); parent.layer.msg('".$msg."');window.location='".$backurl."';</script>";
                }
            }
        }
    }
    public function index(){
        //权限选择
        $this->check_group($this->rule_qz);
        $model=M('XiaoFei');
        $map=array();
        if(IS_GET)
        {
            $map=I('get.');

        }
        $join[] = 'LEFT JOIN __LAN_MU__ l1 ON g1.xf_id = l1.id';

       
       
   
        $page=1;
        if(isset($_GET['p']))
        {
            $page=$_GET['p'];
        }
         $filed = '
            g1.uuid as guuid,
            g1.id as gid,
            l1.name,
            g1.prices,
            g1.clicks,
            g1.shows
           
         ';

        $count = $model->alias('g1')->join($join)->where($map)->count();// 查询满足要求的总记录数

        $pagesize=(C('PAGESIZE'))!=''?C('PAGESIZE'):'20';
        $list =  $model->alias('g1')->field($filed)->join($join)->order('g1.id desc')->page( $page.','.$pagesize)->select();
        
        $this->assign('list',$list);// 赋值数据集

        $this->assign('page',page( $count ,$map,$pagesize));// 赋值分页输出
       
        $this->display();
    }
    //接诊add
    public function add(){
        //权限选择
        $this->check_group($this->rule_qz."_add");
        if(IS_POST)
        {

            $model=D('JieZhen');

            if($model->create())
            {
                M()->startTrans();
                $data=$model->create();
                $data['admin_id']=session('admin_id');
                //更新预约表
                $ydata['ks_id']=$data['ks_id'];
                $ydata['kst_id']=$data['kst_id'];
                $ydata['kstt_id']=$data['kstt_id'];
                $ydata['status']=3;
                $ydata['ysz_id']=$data['ysz_id'];
                $ydata['jzks_id']=$data['jzks_id'];//手术科室ID
                $ydata['jztime']=$data['jztime']= time();//接诊时间
                $ydata['dz_id']=$data['zl_id'];//质量评级
                $ydata['id']=$data['yy_id'];



                //插入，然后更新
                /*print_r($ydata);
                print_r($data);
                exit();*/
                $result =    $model->add($data);
                $backurl=U(MODULE_NAME."/".CONTROLLER_NAME."/kaidan",array('id'=>$result,'yid'=>$data['yy_id']));
                //确诊ID添加进去
                $ydata['qz_id']=$result;
                $yresult=M('YuYue')->data($ydata)->save();

                if($result && $yresult) {

                    M()->commit();
                    add_log($this->onname.'：'.$data['name'].'添加成功');
                    $msg=lang('添加成功','handle');

                    add_log($this->onname.'：'.$data['name'].'添加成功');

                    return $this->success($msg,$backurl );
                    // echo "<script language='javascript'>var index = parent.layer.getFrameIndex(window.name); parent.layer.msg('".$msg."');window.location='".$backurl."';</script>";
                }else{
                    M()->rollback();
                    add_log($this->onname.'：'.$data['name'].'添加失败','/Admin/add');
                    $msg=lang('添加失败','handle');
                    return $this->success($msg,$backurl );
                    //$backurl=U(MODULE_NAME."/".CONTROLLER_NAME."/index");
                    //echo "<script language='javascript'>var index = parent.layer.getFrameIndex(window.name); parent.layer.msg('".$msg."');window.location='".$backurl."';</script>";
                }
            }else
            {
                $this->error($model->getError());
            }
        }else
        {

            $this->display();
        }

    }
    public function kaidan($id,$yid){
       
     /*  $a=[
       1,1,2,3,2
       ];
       $b=[
       10,20,40,50,60
       ];
       $a1=array();
       foreach ($a as $key => $value) {
           $a1[$value][]=$b[$key];
       }
       $lbarray=array();
       foreach ($a1 as $key => $value) {
           $lbarray[$key]=array_sum($a1[$key]);
       }
       print_r($a1);
       print_r($lbarray);*/

        $this->onname='开单';
        $this->assign('onname',$this->onname);

        $m=D('JieZhen')->relation(true)->where(array('checked'=>1))->find($id);
        
        $data=array(

            );
        $this->assign($data);
        $this->data=$m;
        $this->display();
    }
    //开单
    public function postKaiDan(){
        //更新预约状is_kd为1，开单时间kdtime
        //权限选择
        $this->onname='开单';
        $this->check_group("kaidan_add");
        if(IS_POST){
            M()->startTrans();
            $model =D('KaiDan');
             $post=I('post.');
            if($data=$model->create()) {
                $data['admin_id']=session('admin_id');
                $data['jz_id']=$post['qz_id'];
                $data['yy_id']=$post['yuyue_id'];
               

                //统计类别下的数量
                $fid_arr=$post['price_fid'];
                $hj_arr=$post['price_heji'];
                $news_total=array();
                foreach ($fid_arr as $key => $value) {
                    $news_total[$value][]=$hj_arr[$key];
                }
                $price_type=array();
                foreach ($news_total as $key => $value) {
                    $price_type[]=array(
                        'fid'=>$key,
                        'total'=>array_sum($news_total[$key])
                        );
                    
                }
                //消费各个类别合计计算
                $dataList=array();
                $data['price_type']=json_encode($price_type);

                $result =    $model->add($data);
                $dataList=array();
                //批量写入开单详细里面
                $stime=time();
                /*foreach ($post['price_name'] as $key => $value) {
                     $dataList[]=array(
                            'yy_id'=>$post['yuyue_id'],
                            'user_id'=>$post['user_id'],
                            'jz_id'=>$post['qz_id'],
                            'kdys_id'=>$post['kd_kstid'],
                            'ks_id'=>$post['kd_id'],
                            'name'=>$post['price_name'][$key],
                            'ticket_name'=>$post['ticket_name'][$key],
                            'price'=>$post['price_price'][$key],
                            'price_id'=>$post['price_id'][$key],
                            'num'=>$post['price_num'][$key],
                            'xf_name'=>$post['price_xfname'][$key],
                            'total'=>$post['price_heji'][$key],
                            'fid'=>$post['price_fid'][$key],
                            'admin_id'=>session('admin_id'),
                            'ctime'=>$stime,
                            'kd_id'=>$result
                            

                        );
                }*/
               
                //更新预约表
                 $ydata['is_kd']=1;//是否开单
                 $ydata['kdtime']=$data['kd_time']=time();//开单时间

                /*$dataList[] = array('name'=>'thinkphp','email'=>'thinkphp@gamil.com');
                $dataList[] = array('name'=>'onethink','email'=>'onethink@gamil.com');
                $User->addAll($dataList);*/
              
               // $presult=M('ShowPrice')->addAll($dataList);
               
            
               
                
                $ydata['id']=$post['yuyue_id'];
                $yresult=M('YuYue')->data($ydata)->save();

                $backurl=U("Admin/YuYue/index",array('status'=>3,'shenfeng'=>'yishen'));

               
                if($result) {

                    M()->commit();
                    add_log($this->onname.'：'.$data['name'].'添加成功');
                    $msg=lang('添加成功','handle');

                    add_log($this->onname.'：'.$data['name'].'添加成功');

                    return $this->success($msg,$backurl );
                    // echo "<script language='javascript'>var index = parent.layer.getFrameIndex(window.name); parent.layer.msg('".$msg."');window.location='".$backurl."';</script>";
                }else{
                    M()->rollback();
                    add_log($this->onname.'：'.$data['name'].'添加失败','/Admin/add');
                    $msg=lang('添加失败','handle');
                    return $this->success($msg,$backurl );
                    //$backurl=U(MODULE_NAME."/".CONTROLLER_NAME."/index");
                    //echo "<script language='javascript'>var index = parent.layer.getFrameIndex(window.name); parent.layer.msg('".$msg."');window.location='".$backurl."';</script>";
                }

            }
        }
    }
    //消费项目
    public function xiaofei(){
  
         $this->display();
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
    public function kaidanList(){

        
        $this->onname="开单列表";
        $this->assign('onname',$this->onname);
        $this->check_group('kaidan');
        $map=array();
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
            kd.sf_status as sf_status,
            kd.is_yf as is_yf,
            kd.id as id,
            kd_id as kd_id,
            kd.uuid as uuid,
            kd.kd_time as kd_time,
            kd.sf_status,
            kd.js_status,
            kd.price_show,
            kd.price_total,
            jzys.name as sy_name,
            u1.name as user_name,
            ys.realname as kd_name
           
         ';
        //是否只能看到自己开的单

        if(check_group("kaidan_only") )
        {
            
            $map['kd.kd_id']=session('admin_id');
        }


        $count = $model->alias('kd')->join($join)->where($map)->count();// 查询满足要求的总记录数

        $pagesize=(C('PAGESIZE'))!=''?C('PAGESIZE'):'20';
        $list =  $model->alias('kd')->field($filed)->join($join)->where($map)->order('kd.kd_time desc')->page( $page.','.$pagesize)->select();
         $menu_list= array(
          
            2=>'开单时间',
            3=>'姓名',
            4=>'消费项目',
            5=>'单价',
            6=>'单位',
            7=>'数量',
            8=>'合计金额',
            9=>'总计',
            10=>'手术医生',
            11=>'开单人',
            12=>'收费状态',
            13=>'操作'
           
           
            );
        $this->menu_list=$menu_list;

        $this->assign('list',$list);// 赋值数据集
        

        $this->display();
    }
    public function kaidan_edit($id){

        $this->check_group('kaidan_edit');
        $this->onname='开单更新';
        $this->assign('onname',$this->onname);
        if(IS_POST)
        {
            $model =D('KaiDan');
            
            if($model->create()) {
                $data=$model->create();

                $result =   $model->save($data);

                if($result) {

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
           
            $map=array(
            'uuid'=>$id
            );

            $model   =   M('KaiDan')->where($map)->find();

          
            if($model) {
                $this->data =  $model;// 模板变量赋值
            }else{
                return $this->error(lang('数据错误','handle'));
            }
            
            $this->display();
        }
    }
    public function kaidanDel(){
        //权限选择
        $this->check_group('kaidan_del');
        $id=I('get.id');
        $map=array(
            'uuid'=>$id
        );
        $model   =   D('KaiDan');
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
}