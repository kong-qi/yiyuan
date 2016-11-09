<?php
namespace Admin\Controller;
class CaiWuController extends AuthController
{
    protected $onname = '收费';
    protected $rule_qz = 'shouyin';

    public function waitPriceList(){
            $this->assign('adminer',get_sfadder('kai_dan'));
            $this->assign('createer',get_kdadder('kai_dan'));
            $this->assign('is_search',I('get.is_search'));
            $this->onname="待收费列表";
            $this->assign('onname',$this->onname);
            $this->check_group('shouyin_check');
            $map=array();
            $model=M('KaiDan');
            $join[] = 'LEFT JOIN __USER__ u1 ON kd.user_id = u1.id';
            $join[] = 'LEFT JOIN __ADMIN__ ys ON kd.kdys_id = ys.id';
                     
            $join[] = 'LEFT JOIN __JIE_ZHEN__ jz ON kd.jz_id = jz.id';
            $join[] = 'LEFT JOIN __KE_SHI__ jzys ON jz.ysz_id = jzys.id';


            $page=1;
            if(isset($_GET['p']))
            {
                $page=$_GET['p'];
            }
             $filed = '
                kd.sf_status as sf_status,
                kd.id as id,
                kdys_id as kdys_id,
                kd.jz_id as jz_id,
                kd.uuid as uuid,
                kd.kd_time as kd_time,
                kd.sf_status,
                kd.js_status,
                kd.price_show,
                kd.price_total,
                kd.pay_price as pay_price,
                kd.pay_ways,
                kd.sf_time as sf_time,
                kd.true_price as true_price,
                (kd.price_total-kd.true_price) as sx_price,

                jzys.name as sy_name,
                u1.name as user_name,
                ys.realname as kd_name
               
             ';
            //是否只能看到自己开的单
            if(check_group('root'))
            {

            }else
            {
                if(check_group("kaidan_only")  )
                {

                    $map['kd.kd_id']=session('admin_id');
                }
            }
            
            $map['sf_status']=0;
            if(I('get.sf_status')!='')
            {
                $map['sf_status']=I('get.sf_status');
            }
            if($map['sf_status']=='2')
            {
                $map['_string']="sf_status='2' or sf_status='5'";
                unset($map['sf_status']);
            }
            if($map['sf_status']=='1')
            {
                $map['_string']="sf_status='1' or sf_status='4'";
                unset($map['sf_status']);
                $stime=trim(strtotime(I('get.stime')));
                $etime=trim(strtotime(I('get.etime')));
                if($stime!=='' and $etime !='')
                {
                    $timestr =  $stime. "," .$etime;
                    $map['kd.sf_time'] = array('between', $timestr);
                }
            }
            if($map['sf_status']=='3')
            {
                $map['_string']="sf_status='6' or sf_status='3'";
                unset($map['sf_status']);
            }
            if(I('get.kdys_id')!='')
            {
                $map['kd.kdys_id']=I('get.kdys_id');
            }
            if(I('get.sf_admin_id')!='')
            {
                $map['kd.sf_admin_id']=I('get.sf_admin_id');
            }
            if (I('get.keyword') != '') {
                $key = I('get.keyword');
                $map['_string'] = "u1.name like '%" . $key . "%' or u1.tel like '%" . $key . "%' ";
            }
            
            $count = $model->alias('kd')->join($join)->where($map)->count();// 查询满足要求的总记录数
            $pagesize=(C('PAGESIZE'))!=''?C('PAGESIZE'):'20';
            $list =  $model->alias('kd')->field($filed)->join($join)->where($map)->order('kd.kd_time desc')->page( $page.','.$pagesize)->select();
            $this->assign('list',$list);// 赋值数据集
            $handle_tpl='df';
            //判断模版
            if(I('get.sf_status')==1)
            {
                $type_arr='has';
                $handle_tpl='status_1';
            }elseif(I('get.sf_status')==2)
            {
                 $handle_tpl="status_2";
                $type_arr='dingjing';
            }
            elseif(I('get.sf_status')==3)
            {
                 $handle_tpl="status_3";
                $type_arr='yukuan';
            }
            
            $this->assign('handle_tpl',$handle_tpl);
            $this->assign('page',page($count, $map, $pagesize));
            $menu_list = $this->getFiledArray($type_arr);
            $this->menu_list = $menu_list;
            $this->display();
        
    }

    public function getFiledArray($type){
        switch ($type) {
            case "has":
                $menu_list = array(

                    'td-1' => array('name' => lang('收费时间'), 'filed'=>'sf_time','diy'=>'text-blue','is_time'=>'1','fun'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                    'td-2' => array('name' => lang('姓名'), 'filed'=>'user_name','diy'=>'text-blue','is_time'=>'','fun'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                    'td-3' => array('name' => lang('消费项目'), 'filed'=>'price_show','diy'=>'', 'is_time'=>'','fun'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                    'td-4' => array('name' => lang('合计'), 'filed'=>'price_total','diy'=>'', 'is_time'=>'','fun'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                    'td-5' => array('name' => lang('开单人'), 'filed'=>'kd_name','diy'=>'', 'is_time'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                    'td-6' => array('name' => lang('收费状态'), 'filed'=>'sf_status','diy'=>'', 'is_time'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                    'td-7' => array('name' => lang('结算状态'), 'filed'=>'js_status','diy'=>'', 'is_time'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                    

                );
            break;
             case "ok":
                $menu_list = array(

                    'td-1' => array('name' => lang('收费时间'), 'filed'=>'sf_time','diy'=>'text-blue','is_time'=>'1','fun'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                    'td-3' => array('name' => lang('消费项目'), 'filed'=>'price_show','diy'=>'', 'is_time'=>'','fun'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                    'td-4' => array('name' => lang('合计'), 'filed'=>'price_total','diy'=>'', 'is_time'=>'','fun'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                    'td-5' => array('name' => lang('收费人'), 'filed'=>'sfy_name','diy'=>'', 'is_time'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                    'td-7' => array('name' => lang('结算状态'), 'filed'=>'js_status','diy'=>'', 'is_time'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                    

                );
            break;
            case "dingjing":
                $menu_list = array(

                    'td-0' => array('name' => lang('开单时间'), 'filed'=>'kd_time','diy'=>'text-blue','is_time'=>'1','fun'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                    'td-1' => array('name' => lang('收订金时间'), 'filed'=>'sf_time','diy'=>'text-blue','is_time'=>'1','fun'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                    'td-2' => array('name' => lang('姓名'), 'filed'=>'user_name','diy'=>'text-blue','is_time'=>'','fun'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                    'td-3' => array('name' => lang('消费项目'), 'filed'=>'price_show','diy'=>'', 'is_time'=>'','fun'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                    'td-4' => array('name' => lang('合计'), 'filed'=>'price_total','diy'=>'', 'is_time'=>'','fun'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                    'td-5' => array('name' => lang('已收订金金额'), 'filed'=>'true_price','diy'=>'', 'is_time'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                    'td-5' => array('name' => lang('余款金额'), 'filed'=>'sx_price','diy'=>'', 'is_time'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                    'td-6' => array('name' => lang('收费状态'), 'filed'=>'sf_status','diy'=>'', 'is_time'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                    'td-7' => array('name' => lang('结算状态'), 'filed'=>'js_status','diy'=>'', 'is_time'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                    

                );
            break;
            case "yukuan":
                $menu_list = array(

                    'td-0' => array('name' => lang('开单时间'), 'filed'=>'kd_time','diy'=>'text-blue','is_time'=>'1','fun'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                    'td-1' => array('name' => lang('收订金时间'), 'filed'=>'sf_time','diy'=>'text-blue','is_time'=>'1','fun'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                    'td-2' => array('name' => lang('姓名'), 'filed'=>'user_name','diy'=>'text-blue','is_time'=>'','fun'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                    'td-3' => array('name' => lang('消费项目'), 'filed'=>'price_show','diy'=>'', 'is_time'=>'','fun'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                    'td-4' => array('name' => lang('合计'), 'filed'=>'price_total','diy'=>'', 'is_time'=>'','fun'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                    'td-5' => array('name' => lang('已收费金额'), 'filed'=>'true_price','diy'=>'', 'is_time'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                    'td-5' => array('name' => lang('余款金额'), 'filed'=>'sx_price','diy'=>'', 'is_time'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                    'td-6' => array('name' => lang('收费状态'), 'filed'=>'sf_status','diy'=>'', 'is_time'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                    'td-7' => array('name' => lang('结算状态'), 'filed'=>'js_status','diy'=>'', 'is_time'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                    

                );
            break;
            default:
                $menu_list = array(

                    'td-1' => array('name' => lang('开单时间'), 'filed'=>'kd_time','diy'=>'text-blue','is_time'=>'1','fun'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                    'td-2' => array('name' => lang('姓名'), 'filed'=>'user_name','diy'=>'text-blue','is_time'=>'','fun'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                    'td-3' => array('name' => lang('消费项目'), 'filed'=>'price_show','diy'=>'', 'is_time'=>'','fun'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                    'td-4' => array('name' => lang('合计'), 'filed'=>'price_total','diy'=>'', 'is_time'=>'','fun'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                    'td-5' => array('name' => lang('开单人'), 'filed'=>'kd_name','diy'=>'', 'is_time'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                    'td-6' => array('name' => lang('付费类型'), 'filed'=>'pay_ways','diy'=>'', 'is_time'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                    'td-7' => array('name' => lang('付款金额'), 'filed'=>'pay_price','diy'=>'', 'is_time'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                    

                );
                break;
        }
        return $menu_list;
    }
    public function index(){
            $this->assign('adminer',get_sfadder('kai_dan'));
            $this->assign('is_search',I('get.is_search'));
            $this->onname="已结算列表";
            $this->assign('onname',$this->onname);
            $this->check_group('shouyin_check');
            $map=array();
            $model=M('KaiDan');
            $join[] = 'LEFT JOIN __USER__ u1 ON kd.user_id = u1.id';
            $join[] = 'LEFT JOIN __ADMIN__ ys ON kd.kdys_id = ys.id';
            $join[] = 'LEFT JOIN __ADMIN__ sfy ON kd.sf_admin_id = sfy.id';
                     
            $join[] = 'LEFT JOIN __JIE_ZHEN__ jz ON kd.jz_id = jz.id';
            $join[] = 'LEFT JOIN __KE_SHI__ jzys ON jz.ysz_id = jzys.id';


            $page=1;
            if(isset($_GET['p']))
            {
                $page=$_GET['p'];
            }
             $filed = '
                kd.sf_status as sf_status,
                kd.id as id,
                kdys_id as kdys_id,
                kd.jz_id as jz_id,
                kd.uuid as uuid,
                kd.kd_time as kd_time,
                kd.sf_status,
                kd.js_status,
                kd.price_show,
                kd.price_total,
                kd.pay_price as pay_price,
                kd.pay_ways,
                kd.sf_time as sf_time,
                kd.true_price as true_price,
                (kd.price_total-kd.true_price) as sx_price,

                jzys.name as sy_name,
                u1.name as user_name,
                ys.realname as kd_name,
                sfy.realname as sfy_name
               
             ';
            //是否只能看到自己开的单
            if(check_group('root'))
            {

            }else
            {
                if(check_group("kaidan_only")  )
                {

                    $map['kd.kd_id']=session('admin_id');
                }
            }
            if(I('get.sf_admin_id')!='')
            {
                $map['kd.sf_admin_id']=I('get.sf_admin_id');
            }
            $stime=trim(strtotime(I('get.stime')));
            $etime=trim(strtotime(I('get.etime')));
            if($stime!=='' and $etime !='')
            {
                $timestr =  $stime. "," .$etime;
                $map['kd.sf_time'] = array('between', $timestr);
            }
            $map['sf_status']=1;
            $map['js_status']=1;
            if (I('get.keyword') != '') {
                $key = I('get.keyword');
                $map['_string'] = "u1.name like '%" . $key . "%' or u1.tel like '%" . $key . "%' ";
            }
            
            $count = $model->alias('kd')->join($join)->where($map)->count();// 查询满足要求的总记录数
            $pagesize=(C('PAGESIZE'))!=''?C('PAGESIZE'):'20';
            $list =  $model->alias('kd')->field($filed)->join($join)->where($map)->order('kd.kd_time desc')->page( $page.','.$pagesize)->select();
            $this->assign('list',$list);// 赋值数据集
            $handle_tpl=$type_arr='ok';
            //判断模版
            $this->assign('handle_tpl',$handle_tpl);
            $this->assign('page',page($count, $map, $pagesize));
            $menu_list = $this->getFiledArray($type_arr);
            $this->menu_list = $menu_list;
            $this->display();
        
    }
    public function  edit(){
        $this->check_group('shouyin');
        if(IS_POST)
        {
            $model =D('KaiDan');

            if($model->create()) {
                $data=$model->create();
                $data['sf_status']=1;
                $result =   $model->save($data);

                if($result) {

                    add_log($this->onname.'：'.$this->logname.'补交成功');
                    $msg=lang('补交成功','handle');
                    $backurl=U("Admin/CaiWu/index",array('status'=>2));
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

            $model   =   D("KaiDan")->relation(true)->where($map)->find();
           

            if($model) {
                $this->data =  $model;// 模板变量赋值
            }else{
                return $this->error(lang('数据错误','handle'));
            }
            $this->display();
        }
    }

    public function add()
    {
        //权限选择
        //$this->check_group($this->rule_qz."_check");
        if (IS_POST) {
            $m=D('KaiDan');
            if(!check_token(I('post.token')))
            {
                $msg=lang('非法操作');
                $backurl = U("Admin/CaiWu/waitPriceList");
                return  $this->error($msg,$backurl );
            }
            $data=$m->create();
            $data['true_price']=$data['cash_price']+$data['shuaka_price']+$data['other_price'];
            //付了金额
            foreach ($data as $key => $value) {
                if($value=='')
                {
                    unset($data[$key]);
                }
            }
            
            //付款类型
            if($data['pay_ways']==1)
            {
                $data['sf_status']=1;
            }elseif ($data['pay_ways']==2) {
                $data['sf_status']=2;
                $data['yf_money']=$data['true_price'];
            }
            elseif ($data['pay_ways']==3) {
                $data['sf_status']=3;
                $data['yf_money']=$data['true_price'];
            }

           /* print_r($data);
            exit();*/
            $result = M('KaiDan')->save($data);
            if ($result) {
                //更新优惠券
                if ($data['youhui_id'] != '') {
                    $yhq_data = array(
                        'utime' => time(),
                        'status'=>1,
                        'kd_id' => $data['id']
                    );
                    M('Card')->where(array('id' => $data['youhui_id']))->save($yhq_data);
                }
                add_log($this->onname . '：' . $this->logname. '收费提交成功');
                $msg = lang('收费成功');
                $backurl = U("Admin/CaiWu/waitPriceList");
                //echo "<script language='javascript'>var index = parent.layer.getFrameIndex(window.name); parent.layer.msg('" . $msg . "'); parent.location.reload();;parent.layer.close(index);</script>";
                return  $this->success(lang( $msg,'handle'),$backurl);
            } else {

                $msg = lang('数据一样无更新', 'handle');
                return  $this->error(lang( $msg,'handle'));
                //echo "<script language='javascript'>var index = parent.layer.getFrameIndex(window.name); parent.layer.msg('" . $msg . "');parent.layer.close(index);;parent.layer.close(index)</script>";
            }

        } else {
            $uid = I('get.id');
            $map = array();
            $model = M('KaiDan');
            $join[] = 'LEFT JOIN __USER__ u1 ON kd.user_id = u1.id';
            $join[] = 'LEFT JOIN __ADMIN__ kdys ON kdys_id = kdys.id';
            $join[] = 'LEFT JOIN __JIE_ZHEN__ jz ON kd.jz_id = jz.id';
            $join[] = 'LEFT JOIN __KE_SHI__ jzys ON jz.ysz_id = jzys.id';

            $filed = '
                kd.id as id,
                kd.yy_id as yy_id,
                kd.uuid as uuid,
                             
                kd.kd_time as kd_time,
                kd.sf_status as sf_status,
                kd.sf_status,
                kd.js_status,
            
                kd.pay_ways as  pay_ways,
                kd.pay_price as pay_price,
                kd.price_show as price_show,
                kd.price_total as price_total,
                jzys.name as sy_name,
                u1.name as user_name,
                u1.id as user_id,
                kdys.name as kd_name
               
             ';

            $m = $model->alias('kd')->field($filed)->join($join)->where(array('kd.id' => $uid))->find();
            //print_r($m);
            $this->data = $m;


            $this->display();
        }


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
               /* print_r($data);
                exit();*/
                $result =   $model->save($data);

                if($result) {

                    add_log($this->onname.'：'.$this->logname.'开单更新成功');
                    $msg=lang('更新成功','handle');
                    $backurl=U('Admin/CaiWu/waitPriceList');
                    
                    return  $this->success($msg,$backurl);
                }else{

                    $msg=lang('数据一样无更新','handle');
                    return  $this->success($msg,$backurl);
                }
            }else{
                return $this->error($model->getError());
            }
        }else{
           
            $map=array(
            'uuid'=>$id
            );

            $model   =  D('KaiDan')->relation(true)->where($map)->find();

          
            if($model) {
                $this->data =  $model;// 模板变量赋值
            }else{
                return $this->error(lang('数据错误','handle'));
            }
            
            $this->display();
        }
    }



    public function setJsStatus($id)
    {
        //结算权限选择
        $this->check_group("shouyin_jiesuan");
        $model = M("KaiDan");
        $type = I('get.type');
        $name='结算';
        if ($type == 'true') {
            $status = 1;
        } else {
            $status = 0;
             $name='撤销结算';
        }
        
        $data['js_status'] =$status;

        if ($model->where(array('uuid'=>$id))->save($data)) {
            add_log($this->onname.'：'.$this->logname.$name."成功");
            return $this->success(lang($name.'成功', 'handle'));
            $msg = lang($name.'成功', 'handle');
            $backurl = U(MODULE_NAME . "/" . CONTROLLER_NAME . "/index");
            echo "<script language='javascript'>var index = parent.layer.getFrameIndex(window.name); parent.layer.msg('" . $msg . "');parent.layer.close(index);window.location='" . $backurl . "';</script>";
        } else {
            $msg = lang($name.'失败', 'handle');
            return $this->success(lang($name.'失败', 'handle'));
            $backurl = U(MODULE_NAME . "/" . CONTROLLER_NAME . "/index ");
            echo "<script language='javascript'>var index = parent.layer.getFrameIndex(window.name); parent.layer.msg('" . $msg . "');parent.layer.close(index);window.location='" . $backurl . "';</script>";
        }
    }
    public function tui($id){
        //结算权限选择
        $this->check_group("shouyin_jiesuan");
        $model = M("KaiDan");
        $type = I('get.type');
        if($type=='dingjing')
        {
             $name='退定金';
             $status=5;
        }
        if($type=='bufeng')
        {
             $name='部分退费';
             $status=6;
        }
        if($type=='all')
        {
             $name='已退费';
             $status=4;
        }
       
        
       
        $data['sf_status'] =$status;

        if ($model->where(array('uuid'=>$id))->save($data)) {
            add_log($this->onname.'：'.$this->logname.$name."成功");
            return $this->success(lang($name.'成功', 'handle'));
            $msg = lang($name.'成功', 'handle');
            $backurl = U(MODULE_NAME . "/" . CONTROLLER_NAME . "/index");
            echo "<script language='javascript'>var index = parent.layer.getFrameIndex(window.name); parent.layer.msg('" . $msg . "');parent.layer.close(index);window.location='" . $backurl . "';</script>";
        } else {
            $msg = lang($name.'失败', 'handle');
            return $this->success(lang($name.'失败', 'handle'));
            $backurl = U(MODULE_NAME . "/" . CONTROLLER_NAME . "/index ");
            echo "<script language='javascript'>var index = parent.layer.getFrameIndex(window.name); parent.layer.msg('" . $msg . "');parent.layer.close(index);window.location='" . $backurl . "';</script>";
        }
    }
   

}