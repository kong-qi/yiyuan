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
    public function quecheck_show($yid){
        $this->yid=$yid;
        $this->display();

    }
    public function quecheck_edit($id){
        //需要更新到预约表里面，接诊表连接了预约表，ysz_id,手术医生ID，yztime//接诊时间
        //接诊表：yy_id,jztime接诊时间，zl_id：质量评级，ks_id：科室ID，kst_id科室2ID,手术科室jzks_id，手术医生ysz_id
        //预约表：ys_id:医生id，ysz_id：手术医生jzks_id，dz_id质量评级，jztime:接诊时间,qz_id接诊id
        $this->check_group($this->rule_qz."_edit");
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
                //$ydata['jzks_id']=$data['jzks_id'];//手术科室ID。已去掉
                $ydata['status']=3;
                $ydata['dz_id']=$data['zl_id'];//质量评级
               
                foreach ($ydata as $key => $value) {
                    if($value=='')
                    {
                        unset($ydata[$key]);
                    }
                }
                
               
                $result =    $model->save($data);
                //如果没有更改这些信息，则无需。
                $yresult=M('YuYue')->data($ydata)->save();

                if($result ) {
                   /*  print_r($ydata);
                     print_r($data);
                      exit();*/
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
    public function beijin(){
        if(IS_POST)
        {
             
             $model=D('JieZhen');

             if($data=$model->create())
             {
               
               
                $result =    $model->save($data);
                

                if($result ) {

                  
                  
                    $msg=lang('更新背景成功','handle');

                    add_log($this->onname.'：'.$data['name'].'更新背景成功');

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
        }else
        {
            $m=D('JieZhen')->relation(true)->find($id);
        
            $this->data=$m;
           
            
            $this->display();
        }
    }
    public function index()
    {
       
        //print_r(session('group'));
        $this->check_group('qiantaijz');
        $map = array();
        $this->assign('is_search',I('get.is_search'));

        //自己查看自己的
        if (!check_group('root')) {
            if (check_group('yuyue_only')) {
                $map['y1.admin_id'] = session('admin_id');
            }
           
        }
        //网站来源
        $is_website=I('get.webstie');
        if($is_website!='')
        {
            $map['y1.ly_id'] = array('in', get_website());
            $this->assign('is_website',1);
        }
        if (IS_GET) {
            $getdata = I('get.');

            $y_arr = array(
                'ks_id',
                'kst_id',
                'kstt_id',
                'ly_id',
                'lyt_id',
                'lytt_id',
                'area_id',
                'areat_id',
                'is_fz',
                'yx_id',
                'zx_id',
                'user_id',
                'leibie',
                'admin_id',
                'status'

            );
            //print_r($getdata);
            foreach ($getdata as $key => $v) {
                if ($v != '') {

                    if (in_array($key, $y_arr)) {

                        $map["y1." . $key] = $v;
                    }
                }

            }
            //创建时间为预约时间
            if ($getdata['djstime'] != '' && $getdata['djetime'] != '') {
                $getdata['djstime'] .= " 00:00:00";

                $getdata['djetime'] .= " 23:59:59";

                $timestr = strtotime($getdata['djstime']) . "," . strtotime($getdata['djetime']);

                $map['y1.ctime'] = array('between', $timestr);

            }
            //预约时间为预到时间
            if ($getdata['ystime'] != '' && $getdata['yetime'] != '') {
                $getdata['ystime'] .= " 00:00:00";
                $getdata['yetime'] .= " 23:59:59";

                $timestr2 = strtotime($getdata['ystime']) . "," . strtotime($getdata['yetime']);

                $map['y1.ydatetime'] = array('between', $timestr2);

            }
            
            if ($getdata['dzstime'] != '' && $getdata['dzetime'] != '') {
                $getdata['dzstime'] .= " 00:00:00";
                $getdata['dzetime'] .= " 23:59:59";

                $timestr2 = strtotime($getdata['dzstime']) . "," . strtotime($getdata['dzetime']);

                $map['y1.dztime'] = array('between', $timestr2);

            }


            if (I('get.user_id') != '') {
                $map['y1.user_id'] = I('get.user_id');

            }
            if (I('get.keyword') != '') {
                $key = I('get.keyword');
                $map['_string'] = "u1.name like '%" . $key . "%' or u1.tel like '%" . $key . "%' or y1.ynumber like '%" . $key . "%'";
            }

        }


        $model = M('YuYue');
        $filed = '
            ly1.name as ly_name,
            ly2.name as lyt_name,
            ly3.name as lytt_name,
            y1.uuid as yuuid,
            y1.status as ystatus,
            y1.zx_content as zx_content,
            y1.zx_mark,
            y1.ys_id as ys_id,
            y1.is_kd as is_kd,
           
            y1.kd_id as kd_id,
            y1.kdtime as kdtime,
            y1.ynumber,
            y1.id as yid,
            y1.admin_id,
            y1.ydatetime as ydatetime,
            y1.ctime as yctime,
            y1.mark as mark,
            y1.jztime as jztime,
            y1.dztime as dztime,
            y1.leibie as leibie,

            u1.name as user_name,
            u1.age as age,
            u1.sex,
            u1.uuid as user_uuid,
            u1.id as user_id,
            u1.tel as tel,
            u1.sfcard as card,
            u1.birthday as birthday,

            
            a1.name as admin_name,
            k1.name as ks_name,
            k2.name as kst_name,
            k3.name as kstt_name,
            k4.name as bz_name,
            zx.name as zx_name,
            yx.name as yx_name,
            wz.name as web_name,
            ae1.name as ae_name,
            ae2.name as ae2_name,
            ys.realname as ys_name,
    
            jz.jz_smcontent as jz_smcontent,
            jz.id as qz_id,
            ssys.name as ysz_name,
            fz.realname as fzname,

            xueli.name as xueli,
            zhiye.name as zhiye,
            hunyin.name as jiehun,
            level.name as  level,
            phone.name  as pbank
        ';
        //管理会员用户
        $join[] = '__USER__ u1 ON y1.user_id = u1.id';
        //关联ADMIN
        $join[] = 'LEFT JOIN __ADMIN__ a1 ON y1.admin_id = a1.id';
        $join[] = 'LEFT JOIN __ADMIN__ ys ON y1.ys_id = ys.id';
        //分证人
        $join[] = 'LEFT JOIN __ADMIN__ fz ON y1.fz_id = fz.id';
        //关科室1
        $join[] = 'LEFT JOIN __KE_SHI__ k1 ON y1.ks_id = k1.id';
        //关科室2
        $join[] = 'LEFT JOIN __KE_SHI__ k2 ON y1.kst_id = k2.id';
        //关科室3
        $join[] = 'LEFT JOIN __KE_SHI__ k3 ON y1.kstt_id = k3.id';
        //最终兵种
        $join[] = 'LEFT JOIN __KE_SHI__ k4 ON y1.ksall_id = k4.id';
        //关咨询方式
        $join[] = 'LEFT JOIN __LAN_MU__ zx ON y1.zx_id = zx.id';
        //网站
        $join[] = 'LEFT JOIN __LAN_MU__ wz ON y1.web_id = wz.id';
        //意向
        $join[] = 'LEFT JOIN __LAN_MU__ yx ON y1.zx_id = yx.id';
        //病人来源
        $join[] = 'LEFT JOIN __LAN_MU__ ly1 ON y1.ly_id = ly1.id';
        $join[] = 'LEFT JOIN __LAN_MU__ ly2 ON y1.lyt_id = ly2.id';
        $join[] = 'LEFT JOIN __LAN_MU__ ly3 ON y1.lytt_id = ly3.id';
        //区域
        $join[] = 'LEFT JOIN __AREA__ ae1 ON y1.area_id = ae1.id';
        //意向
        $join[] = 'LEFT JOIN __AREA__ ae2 ON y1.areat_id = ae2.id';
        //接诊
        $join[] = 'LEFT JOIN __JIE_ZHEN__ jz ON y1.id = jz.yy_id';
        //手术医生
        $join[]= 'LEFT JOIN __ADMIN__ ssys ON ssys.id = y1.ysz_id';

        //关联学历
        $join[] = 'LEFT JOIN __LAN_MU__ xueli ON u1.xueli = xueli.id';
        //职业
        $join[] = 'LEFT JOIN __LAN_MU__ zhiye ON u1.zhiye = zhiye.id'; 
        //婚姻
        $join[] = 'LEFT JOIN __LAN_MU__ hunyin ON u1.is_jiehun = hunyin.id'; 
        //会员级别
        $join[] = 'LEFT JOIN __LAN_MU__ level ON u1.level = level.id'; 
        //手机品牌
        $join[] = 'LEFT JOIN __LAN_MU__ phone ON u1.phone_bank = phone.id'; 

        $type_arr='defalut';
        if(I('list_type')!='')
        {
            if(I('list_type')=='only')
            {
                if(!check_group('roor'))
                {
                    $map['y1.ys_id']=session('admin_id');
                }
                
            }
            $menu_list = $this->getFiledArray(I('list_type'));
            $this->assign('handle_tpl',I('list_type'));
            //print_r($menu_list);
        }else
        {
            $menu_list = $this->getFiledArray($type_arr);
        }
       
        $count = $model->alias('y1')->join($join)->where($map)->count();// 查询满足要求的总记录数
        $pagesize = (C('PAGESIZE')) != '' ? C('PAGESIZE') : '50';
        $page = 1;
        if (isset($_GET['p'])) {
            $page = $_GET['p'];
        }
        if(I('get.status')=='2')
        {
            $orderstr='y1.dztime desc,y1.id desc';
        }else
        {
            $orderstr='y1.ctime desc,y1.id desc';
        }
        $list = $model->alias('y1')->field($filed)->join($join)->order($orderstr)->where($map)->page($page . ',' . $pagesize)->select();
        //print_r($list);
        $this->assign('list', $list);// 赋值数据集
       
        
        $this->menu_list = $menu_list;
        $this->assign('page', page($count, $map, $pagesize));// 赋值分页输出
        $this->display("YuYue:yushen:index");
        
        
    }
    public function getFiledArray($type){
        switch ($type) {
            case 'only':
            case 'all':
                   $menu_list = array(
                        'td-1' => array('name' => lang('预约号'), 'filed'=>'ynumber','diy'=>'text-blue','is_time'=>'','fun'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                        'td-2' => array('name' => lang('姓名'), 'filed'=>'user_name','diy'=>'text-blue','is_time'=>'','fun'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                        'td-3' => array('name' => lang('性别'), 'filed'=>'sex','diy'=>'', 'is_time'=>'','fun'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                        'td-4' => array('name' => lang('年龄'), 'filed'=>'age','diy'=>'', 'is_time'=>'','fun'=>'','w' => '', 'h' => '', 'is_hide' =>''), 
                        'td-5' => array('name' => lang('生日'), 'filed'=>'birthday','diy'=>'', 'is_time'=>'','w' => '', 'h' => '', 'is_hide' => '1'),
                        'td-6' => array('name' => lang('职业'), 'filed'=>'zhiye','diy'=>'', 'is_time'=>'','w' => '', 'h' => '', 'is_hide' => '1'),
                        'td-7' => array('name' => lang('婚姻'), 'filed'=>'jiehun','diy'=>'', 'is_time'=>'','w' => '', 'h' => '', 'is_hide' => '1'),

                        
                        'td-8' => array('name' => lang('预约状态'), 'filed'=>'ystatus','diy'=>'', 'is_time'=>'','fun'=>'','w' => '', 'h' => '', 'is_hide' => '1'),
                        'td-9' => array('name' => lang('预约时间'), 'filed'=>'yctime','diy'=>'text-info', 'is_time'=>'1','fun'=>'','w' => '', 'h' => '', 'is_hide' => '1'),

                        'td-10' => array('name' => lang('预到时间'), 'filed'=>'ydatetime','diy'=>'text-blue', 'is_time'=>'1','fun'=>'','w' => '', 'h' => '', 'is_hide' => '1'),
                       
                        
                        'td-11' => array('name' => lang('接诊时间'), 'filed'=>'jztime','diy'=>'text-blue', 'is_time'=>'1','fun'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                        'td-12' => array('name' => lang('预约时间'), 'filed'=>'yctime','diy'=>'text-info', 'is_time'=>'1','fun'=>'','w' => '', 'h' => '', 'is_hide' => '1'),
                        'td-13' => array('name' => lang('到院时间'), 'filed'=>'dztime','diy'=>'text-blue', 'is_time'=>'1','fun'=>'','w' => '', 'h' => '', 'is_hide' => '1'),
                        'td-14' => array('name' => lang('具体病种'), 'filed'=>'bz_name','diy'=>'', 'is_time'=>'','fun'=>'','w' => '', 'h' => '', 'is_hide' => '1'),
                        'td-15' => array('name' => lang('地区'), 'filed'=>'ae2_name','diy'=>'', 'is_time'=>'','fun'=>'','w' => '', 'h' => '', 'is_hide' => '1'),
                        'td-16' => array('name' => lang('分诊人'), 'filed'=>'fzname','diy'=>'', 'is_time'=>'','fun'=>'','w' => '', 'h' => '', 'is_hide' => '1'),
                        'td-17' => array('name' => lang('接诊医生'), 'filed'=>'ys_name','diy'=>'', 'is_time'=>'','fun'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                        'td-25' => array('name' => lang('手术医生'), 'filed'=>'ysz_name','diy'=>'', 'is_time'=>'','fun'=>'','w' => '', 'h' => '', 'is_hide' => '1'),

                        'td-26' => array('name' => lang('接诊小结'), 'filed'=>'jz_smcontent','diy'=>'', 'is_time'=>'','fun'=>'','w' => '', 'h' => '', 'is_hide' => ''),

                        'td-18' => array('name' => lang('地区'), 'filed'=>'ae2_name','diy'=>'', 'is_time'=>'','fun'=>'','w' => '', 'h' => '', 'is_hide' => '1'),
                        'td-19' => array('name' => lang('来源'), 'filed'=>'ly_name','diy'=>'', 'is_time'=>'','fun'=>'','w' => '', 'h' => '', 'is_hide' => '1'),
                        'td-20' => array('name' => lang('网站来源'), 'filed'=>'web_name','diy'=>'', 'is_time'=>'','fun'=>'','w' => '', 'h' => '', 'is_hide' => '1'),
                        'td-21' => array('name' => lang('来源类别'), 'filed'=>'leibie','diy'=>'', 'is_time'=>'','fun'=>'','w' => '', 'h' => '', 'is_hide' => '1'),
                        'td-22' => array('name' => lang('咨询方式'), 'filed'=>'zx_name','diy'=>'', 'is_time'=>'','fun'=>'','w' => '', 'h' => '', 'is_hide' => '1'),
                        'td-23' => array('name' => lang('咨询员'), 'filed'=>'admin_name','diy'=>'', 'is_time'=>'','fun'=>'','w' => '', 'h' => '', 'is_hide' => '1'),
                        'td-24' => array('name' => lang('前台接待员'), 'filed'=>'fzname','diy'=>'', 'is_time'=>'','fun'=>'','w' => '', 'h' => '', 'is_hide' => '1'),
                       
                        

                    );
                break;
           
            
            default:
                $menu_list = array(

                    'td-1' => array('name' => lang('预约号'), 'filed'=>'ynumber','diy'=>'text-blue','is_time'=>'','fun'=>'','w' => '', 'h' => '', 'is_hide' => '1'),
                    'td-2' => array('name' => lang('姓名'), 'filed'=>'user_name','diy'=>'text-blue','is_time'=>'','fun'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                    'td-3' => array('name' => lang('性别'), 'filed'=>'sex','diy'=>'', 'is_time'=>'','fun'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                    'td-4' => array('name' => lang('年龄'), 'filed'=>'age','diy'=>'', 'is_time'=>'','fun'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                    'td-5' => array('name' => lang('生日'), 'filed'=>'birthday','diy'=>'', 'is_time'=>'','w' => '', 'h' => '', 'is_hide' => '1'),
                    'td-6' => array('name' => lang('职业'), 'filed'=>'zhiye','diy'=>'', 'is_time'=>'','w' => '', 'h' => '', 'is_hide' => '1'),
                    'td-7' => array('name' => lang('婚姻'), 'filed'=>'jiehun','diy'=>'', 'is_time'=>'','w' => '', 'h' => '', 'is_hide' => '1'),
                    'td-8' => array('name' => lang('预约时间'), 'filed'=>'yctime','diy'=>'text-info', 'is_time'=>'1','fun'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                    'td-9' => array('name' => lang('预到时间'), 'filed'=>'ydatetime','diy'=>'text-blue', 'is_time'=>'1','fun'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                    'td-10' => array('name' => lang('具体病种'), 'filed'=>'bz_name','diy'=>'', 'is_time'=>'','fun'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                    'td-11' => array('name' => lang('地区'), 'filed'=>'ae2_name','diy'=>'', 'is_time'=>'','fun'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                    'td-12' => array('name' => lang('来源'), 'filed'=>'ly_name','diy'=>'', 'is_time'=>'','fun'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                    'td-13' => array('name' => lang('网站来源'), 'filed'=>'web_name','diy'=>'', 'is_time'=>'','fun'=>'','w' => '', 'h' => '', 'is_hide' => '1'),
                    'td-14' => array('name' => lang('来源类别'), 'filed'=>'leibie','diy'=>'', 'is_time'=>'','fun'=>'','w' => '', 'h' => '', 'is_hide' => '1'),
                    'td-15' => array('name' => lang('咨询方式'), 'filed'=>'zx_name','diy'=>'', 'is_time'=>'','fun'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                    'td-16' => array('name' => lang('咨询员'), 'filed'=>'admin_name','diy'=>'', 'is_time'=>'','fun'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                    'td-17' => array('name' => lang('前台接待员'), 'filed'=>'fzname','diy'=>'', 'is_time'=>'','fun'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                   

                );
                break;
        }
        return $menu_list;
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
                //$ydata['jzks_id']=$data['jzks_id'];//手术科室ID,起去掉
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
                 $ydata['stats']=4;
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
            kd.jz_id as jz_id,
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
        if(check_group('root'))
        {

        }else
        {
            if(check_group("kaidan_only")  )
            {

                $map['kd.kd_id']=session('admin_id');
            }
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
    public function kaidanPrint($id){
        $m=M('JieZhen');
        $filed='
            jz.jztime as jztime,
            u1.name as user_name,
            u1.age as age,
            jz.jz_content as jz_content,
            a1.name as jz_name,
            y1.mark as mark

        ';
        $map=array(
            'jz.id'=>$id
            );
        $join[] = 'LEFT JOIN __YU_YUE__ y1 ON jz.yy_id = y1.id';
        $join[] = 'LEFT JOIN __ADMIN__ a1 ON jz.ys_id = a1.id';
        $join[] = 'LEFT JOIN __USER__ u1 ON jz.user_id = u1.id';
        $data=$m->alias('jz')->field($filed)->where($map)->join($join)->find();
        //print_r($data);
        $this->data=$data;
        $this->display();
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