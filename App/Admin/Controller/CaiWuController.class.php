<?php
namespace Admin\Controller;
class CaiWuController extends AuthController
{
    protected $onname = '收费';
    protected $rule_qz = 'shouyin';

    public function waitPriceList(){
        
            $this->assign('is_search',I('get.is_search'));
            $this->onname="待收费列表3";
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
                kd.pay_ways,
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
            $stime=trim(strtotime(I('get.stime')));
            $etime=trim(strtotime(I('get.etime')));
            if($stime!=='' and $etime !='')
            {
                $timestr =  $stime. "," .$etime;
                $map['kd.kd_time'] = array('between', $timestr);
            }
            $map['sf_status']=0;
            $count = $model->alias('kd')->join($join)->where($map)->count();// 查询满足要求的总记录数
            $pagesize=(C('PAGESIZE'))!=''?C('PAGESIZE'):'20';
            $list =  $model->alias('kd')->field($filed)->join($join)->where($map)->order('kd.kd_time desc')->page( $page.','.$pagesize)->select();
            $this->assign('list',$list);// 赋值数据集
            $menu_list = $this->getFiledArray($type_arr);
            $this->menu_list = $menu_list;
            $this->display();
        
    }
    public function getFiledArray($type){
        switch ($type) {
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
    public function index($status = 0,$js_status='0')
    {
        $this->check_group('shouyin');

        $map = array( );
        $map['kd.sf_status']=$status;
        $map['kd.js_status']=$js_status;
        $model = M('KaiDan');
        $join[] = 'LEFT JOIN __USER__ u1 ON kd.user_id = u1.id';
        $join[] = 'LEFT JOIN __ADMIN__ ys ON kd.kd_id = ys.id';
        $join[] = 'LEFT JOIN __JIE_ZHEN__ jz ON kd.jz_id = jz.id';
        $join[] = 'LEFT JOIN __KE_SHI__ jzys ON jz.ysz_id = jzys.id';
        $join[] = 'LEFT JOIN __ADMIN__ sf ON kd.sf_admin_id = sf.id';



        $page = 1;
        if (isset($_GET['p'])) {
            $page = $_GET['p'];
        }
        $filed = '
            kd.id as id,
            kd.uuid as uuid,
            kd.is_yf as is_yf,
            kd.sf_status as sf_status,
            kd.js_status as js_status,
            kd.kd_time as kd_time,
            kd.price_show,
            kd.price_total,
            kd.sf_time as sf_time,
            kd.js_time as js_time,
            kd.yf_money as yf_money,
            kd.bq_money as bq_money,
            kd.youhui_code youhui_code,
            kd.youhui_price as youhui_price,
            kd.shishou_price as shishou_price,
            kd.youhui_total as youhui_total,
            kd.shuaka_price as shuaka_price,
            kd.other_price as other_price,
            kd.price_type as price_type,
            jzys.name as sy_name,
            u1.name as user_name,
            ys.realname as kd_name,
            ys.id as ysid,
            jzys.name as shoushu_name,
            sf.realname as sf_name
           
         ';
        $stime=trim(strtotime(I('get.stime')));
        $etime=trim(strtotime(I('get.etime')));
        if($stime!=='' and $etime !='')
        {
            $timestr =  $stime. "," .$etime;
            $map['kd.kd_time'] = array('between', $timestr);
        }
        $key=trim(I('get.keyword'));
        if($key!='')
        {
            $map['u1.name']=$key;
        }

        $count = $model->alias('kd')->join($join)->where($map)->count();// 查询满足要求的总记录数

        $pagesize = (C('PAGESIZE')) != '' ? C('PAGESIZE') : '20';
        $list = $model->alias('kd')->field($filed)->join($join)->where($map)->order('kd.id desc')->page($page . ',' . $pagesize)->select();
        $menu_list = array();
        $menu_list['td_kd_time'] = array('name' => lang('开单时间'), 'w' => '', 'h' => '', 'is_hide' => '');
        //已经收费显示时间
        if($status!=0){
            $menu_list['td_sf_time'] = array('name' => lang('收费时间'), 'w' => '', 'h' => '', 'is_hide' => '');
        }
        $menu_list['td_user'] = array('name' => lang('姓名'), 'w' => '', 'h' => '', 'is_hide' => '');
        $menu_list['td_show_price'] = array('name' => lang('消费项目'), 'w' => '', 'h' => '', 'is_hide' => '');
        $menu_list['td_show_total'] = array('name' => lang('合计'), 'w' => '', 'h' => '', 'is_hide' => '');

        $menu_list['td_kd_name'] = array('name' => lang('开单人'), 'w' => '', 'h' => '', 'is_hide' => '');
        $menu_list['td_sf_status'] = array('name' => lang('收费状态'), 'w' => '', 'h' => '', 'is_hide' => '');
        $menu_list['td_js_status'] = array('name' => lang('结算状态'), 'w' => '', 'h' => '', 'is_hide' => '');

        if($status!=0) {
            $menu_list['td_sf_name'] = array('name' => lang('收费人'), 'w' => '', 'h' => '', 'is_hide' => '');
        }
        $menu_list['td_handle'] = array('name' => lang('操作'), 'w' => '', 'h' => '', 'is_hide' => '');

        //print_r($menu_list);
        $this->menu_list = $menu_list;


        $this->assign('list', $list);// 赋值数据集

        $this->status=$status;
        //根据类型设置模板
        switch ($status)
        {
            case "1":
                $this->assign('onname','结算列表');
                $this->assign('is_js',1);
                if($js_status==1)
                {
                    $this->assign('is_js',0);
                }

                break;
            case "2":
                $this->assign('onname','已结算列表');
                break;
            default:
                $this->assign('onname','收费列表');

                break;
        }
        $this->display();


    }
    public function  edit(){
        $this->check_group('dingjing');
        if(IS_POST)
        {
            $model =D('KaiDan');

            if($model->create()) {
                $data=$model->create();
                $data['sf_status']=1;
                $result =   $model->save($data);

                if($result) {

                    add_log($this->onname.'：'.$data['name'].'更新成功');
                    $msg=lang('更新成功','handle');
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
            $post = I('post.');
            $data['id'] = $post['id'];
            $data['sf_time'] = time();
            $data['sf_admin_id'] = session('admin_id');
            if ($post['youhui_id'] != '') {
                $data['youhui_id'] = $post['youhui_id'];
            }
            if ($post['sf_status'] == '2') {
                $data['yf_money'] = $post['yf_money'];
                $data['sf_status'] = 2;

                $data['is_yf'] = 1;

            } else {
                if ($post['shishou_price'] != '') {
                    $data['shishou_price'] = $post['shishou_price'];
                }
                if ($post['shuaka_price'] != '') {
                    $data['shuaka_price'] = $post['shuaka_price'];
                }
                if ($post['other_price'] != '') {
                    $data['other_price'] = $post['other_price'];
                }
                if ($post['youhui_total'] != '') {
                    $data['youhui_total'] = $post['youhui_total'];
                }
                if ($post['youhui_price'] != '') {
                    $data['youhui_price'] = $post['youhui_price'];
                }
                $data['sf_status'] = 1;
            }

            $result = M('KaiDan')->save($data);
            if ($result) {
                //更新优惠券
                if ($post['youhui_id'] != '') {
                    $yhq_data = array(
                        'utime' => time(),
                        'kd_id' => $data['id']
                    );
                    M('Card')->where(array('id' => $post['youhui_id']))->save($yhq_data);
                }
                add_log($this->onname . '：' . $data['name'] . '提交成功');
                $msg = lang('提交成功', 'handle');
                $backurl = U(MODULE_NAME . "/" . CONTROLLER_NAME . "/index");
                echo "<script language='javascript'>var index = parent.layer.getFrameIndex(window.name); parent.layer.msg('" . $msg . "'); parent.location.reload();;parent.layer.close(index);</script>";
                //return  $this->success(lang('更新成功','handle'),'/Admin/edit',$id);
            } else {

                $msg = lang('数据一样无更新', 'handle');
                echo "<script language='javascript'>var index = parent.layer.getFrameIndex(window.name); parent.layer.msg('" . $msg . "');parent.layer.close(index);;parent.layer.close(index)</script>";
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


    public function del()
    {
        //权限选择
        $this->check_group($this->rule_qz . "_del");
        $id = I('get.id');
        $map = array(
            'uuid' => $id
        );
        $model = D("XiaoFei");
        $data = $model->where($map)->find();
        $result = $model->where($map)->delete();
        if ($result) {
            add_log($this->onname . '：' . $data['name'] . '删除成功');
            return $this->success(lang('删除成功', 'handle'));;
        }
        add_log($this->onname . '：' . $data['name'] . '删除失败');
        return $this->error(lang('删除失败', 'handle'));;
    }

    public function setJsStatus($id)
    {
        //结算权限选择
        $this->check_group("shouyin_jiesuan");
        $model = M("KaiDan");
        $type = I('get.type');
        if ($type == 'true') {
            $status = 1;
        } else {
            $status = 0;
        }
        $data['id'] = $id;
        $data['js_status'] = 1;

        if ($model->save($data)) {

            return $this->success(lang('结算成功', 'handle'));
            $msg = lang('结算成功', 'handle');
            $backurl = U(MODULE_NAME . "/" . CONTROLLER_NAME . "/index");
            echo "<script language='javascript'>var index = parent.layer.getFrameIndex(window.name); parent.layer.msg('" . $msg . "');parent.layer.close(index);window.location='" . $backurl . "';</script>";
        } else {
            $msg = lang('结算失败', 'handle');
            return $this->success(lang('结算失败', 'handle'));
            $backurl = U(MODULE_NAME . "/" . CONTROLLER_NAME . "/index ");
            echo "<script language='javascript'>var index = parent.layer.getFrameIndex(window.name); parent.layer.msg('" . $msg . "');parent.layer.close(index);window.location='" . $backurl . "';</script>";
        }
    }

    public function kaidanList()
    {
        $this->check_group('kaidan');
        $map = array();
        $model = M('KaiDan');
        $join[] = 'LEFT JOIN __USER__ u1 ON kd.user_id = u1.id';
        $join[] = 'LEFT JOIN __ADMIN__ a1 ON kd.admin_id = a1.id';

        $page = 1;
        if (isset($_GET['p'])) {
            $page = $_GET['p'];
        }
        $filed = '
            kd.id as id,kd.uuid as uuid,kd.kd_time as kd_time,kd.kd_name as kd_name,kd.is_liaoxiao as is_liaoxiao,kd.price_show,kd.price_total,
            u1.name as user_name
           
         ';

        $count = $model->alias('kd')->join($join)->where($map)->count();// 查询满足要求的总记录数

        $pagesize = (C('PAGESIZE')) != '' ? C('PAGESIZE') : '20';
        $list = $model->alias('kd')->field($filed)->join($join)->order('kd.id desc')->page($page . ',' . $pagesize)->select();
        $menu_list = array(

            2 => '开单时间',
            3 => '姓名',
            4 => '消费项目',
            5 => '合计总价',
            6 => '是否疗程次数消费',
            7 => '咨询医生',


        );
        $this->menu_list = $menu_list;

        $this->assign('list', $list);// 赋值数据集


        $this->display();
    }
}