<?php
namespace Admin\Controller;
class ShouSuController extends AuthController {
    protected $onname='医生接诊';
    protected $rule_qz='yishenjz';
 
    public function getFiledArray($type){
        switch ($type) {
            case 'shousu':
            
                   $menu_list = array(
                     'td-1' => array('name' => lang('收费号'), 'filed'=>'kd_number','diy'=>'text-blue','is_time'=>'','fun'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                    
                     'td-2' => array('name' => lang('姓名'), 'filed'=>'user_name','diy'=>'text-blue','is_time'=>'','fun'=>'','w' => '', 'h' => '', 'is_hide' => ''),

                     'td-3' => array('name' => lang('性别'), 'filed'=>'user_sex','diy'=>'text-blue','is_time'=>'','fun'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                     'td-4' => array('name' => lang('年龄'), 'filed'=>'age','diy'=>'text-blue','is_time'=>'','fun'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                     
                     'td-6' => array('name' => lang('手术名称'), 'filed'=>'shousu_name','diy'=>'text-blue','is_time'=>'','fun'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                     'td-7' => array('name' => lang('手术医生'), 'filed'=>'sy_name','diy'=>'text-blue','is_time'=>'','fun'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                     'td-8' => array('name' => lang('预约做手术的时间'), 'filed'=>'shous_ytime','diy'=>'text-blue','is_time'=>'1','fun'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                     'td-9' => array('name' => lang('手术状态'), 'filed'=>'shous_status','diy'=>'text-blue','is_time'=>'','fun'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                     
                     'td-10' => array('name' => lang('手术完成时间'), 'filed'=>'shous_oktime','diy'=>'', 'is_time'=>'1','w' => '', 'h' => '', 'is_hide' => ''),
                     'td-11' => array('name' => lang('开单人'), 'filed'=>'kd_name','diy'=>'', 'is_time'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                     
                     
                      
                 );
                break;
            case 'shousu_lc':
            
                   $menu_list = array(
                     'td-1' => array('name' => lang('收费号'), 'filed'=>'kd_number','diy'=>'text-blue','is_time'=>'','fun'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                    
                     'td-2' => array('name' => lang('姓名'), 'filed'=>'user_name','diy'=>'text-blue','is_time'=>'','fun'=>'','w' => '', 'h' => '', 'is_hide' => ''),

                     'td-3' => array('name' => lang('性别'), 'filed'=>'user_sex','diy'=>'text-blue','is_time'=>'','fun'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                     'td-4' => array('name' => lang('年龄'), 'filed'=>'age','diy'=>'text-blue','is_time'=>'','fun'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                     
                     'td-5' => array('name' => lang('治疗项目名称'), 'filed'=>'shousu_name','diy'=>'text-blue','is_time'=>'','fun'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                     'td-6' => array('name' => lang('手术医生'), 'filed'=>'sy_name','diy'=>'text-blue','is_time'=>'','fun'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                     'td-7' => array('name' => lang('疗程有效期'), 'filed'=>'limit_time','diy'=>'text-blue','is_time'=>'1','fun'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                     'td-8-1' => array('name' => lang('疗程次数'), 'filed'=>'shous_times','diy'=>'text-blue','is_time'=>'','fun'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                     'td-8' => array('name' => lang('治疗进度'), 'filed'=>'jindu','diy'=>'text-blue','is_time'=>'','fun'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                     'td-9' => array('name' => lang('疗程状态'), 'filed'=>'shous_status','diy'=>'text-blue','is_time'=>'','fun'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                     'td-10' => array('name' => lang('疗程开始时间'), 'filed'=>'ctime','diy'=>'text-blue','is_time'=>'1','fun'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                    
                     
                     'td-11' => array('name' => lang('疗程结束时间'), 'filed'=>'shous_etime','diy'=>'', 'is_time'=>'1','w' => '', 'h' => '', 'is_hide' => ''),
                     'td-12' => array('name' => lang('开单人'), 'filed'=>'kd_name','diy'=>'', 'is_time'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                     'td-13' => array('name' => lang('开单时间'), 'filed'=>'kd_time','diy'=>'', 'is_time'=>'1','w' => '', 'h' => '', 'is_hide' => ''),
                     
                     
                      
                 );
                break;
            
            case "has_price":
                //收费单号，姓名，收费时间，已收金额，收费状态，付费类型，收费项目，合计总价。
                $menu_list = array(
                     'td-1' => array('name' => lang('收费号'), 'filed'=>'kd_number','diy'=>'text-blue','is_time'=>'','fun'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                    
                     'td-2' => array('name' => lang('姓名'), 'filed'=>'user_name','diy'=>'text-blue','is_time'=>'','fun'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                     'td-3' => array('name' => lang('收费时间'), 'filed'=>'sf_time','diy'=>'text-blue','is_time'=>'1','fun'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                     
                     'td-4' => array('name' => lang('已收金额'), 'filed'=>'true_price','diy'=>'', 'is_time'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                     'td-5' => array('name' => lang('收费状态'), 'filed'=>'sf_status','diy'=>'', 'is_time'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                     'td-6' => array('name' => lang('付费类型'), 'filed'=>'pay_ways','diy'=>'', 'is_time'=>'','w' => '', 'h' => '', 'is_hide' => ''),

                      'td-7' => array('name' => lang('消费项目'), 'filed'=>'price_show','diy'=>'', 'is_time'=>'','fun'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                      'td-8' => array('name' => lang('合计总价'), 'filed'=>'price_total','diy'=>'', 'is_time'=>'','fun'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                     
                      
                 );
            break;
            
            default:
                $menu_list = array(

                    'td-1' => array('name' => lang('预约号'), 'filed'=>'ynumber','diy'=>'text-blue','is_time'=>'','fun'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                    'td-2' => array('name' => lang('姓名'), 'filed'=>'user_name','diy'=>'text-blue','is_time'=>'','fun'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                    'td-3' => array('name' => lang('性别'), 'filed'=>'sex','diy'=>'', 'is_time'=>'','fun'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                    'td-4' => array('name' => lang('年龄'), 'filed'=>'age','diy'=>'', 'is_time'=>'','fun'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                     'td-15' => array('name' => lang('到院时间'), 'filed'=>'dztime','diy'=>'text-blue', 'is_time'=>'1','fun'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                    'td-5' => array('name' => lang('来院类别'), 'filed'=>'leibie','diy'=>'', 'is_time'=>'','fun'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                    'td-6' => array('name' => lang('接诊医生'), 'filed'=>'ys_name','diy'=>'', 'is_time'=>'','fun'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                    'td-7' => array('name' => lang('前台接待员'), 'filed'=>'fzname','diy'=>'', 'is_time'=>'','fun'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                    'td-8' => array('name' => lang('咨询员'), 'filed'=>'admin_name','diy'=>'', 'is_time'=>'','fun'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                    'td-9' => array('name' => lang('具体病种'), 'filed'=>'bz_name','diy'=>'', 'is_time'=>'','fun'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                    'td-10' => array('name' => lang('来源'), 'filed'=>'ly_name','diy'=>'', 'is_time'=>'','fun'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                    'td-11' => array('name' => lang('地区'), 'filed'=>'ae2_name','diy'=>'', 'is_time'=>'','fun'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                    'td-12' => array('name' => lang('咨询方式'), 'filed'=>'zx_name','diy'=>'', 'is_time'=>'','fun'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                    'td-13' => array('name' => lang('预约时间'), 'filed'=>'yctime','diy'=>'text-info', 'is_time'=>'1','fun'=>'','w' => '', 'h' => '', 'is_hide' => '1'),
                    'td-14' => array('name' => lang('预到时间'), 'filed'=>'ydatetime','diy'=>'text-blue', 'is_time'=>'1','fun'=>'','w' => '', 'h' => '', 'is_hide' => '1'),
                   

                );
                break;
        }
        return $menu_list;
    }
 

    
   
    public function waitPriceList(){

            $type_arr='has_price';
            $handle_tpl='yishen_has';
            $this->onname="已收费列表";
            $this->check_group('yishenjz');
            $map=array();
            $model=M('KaiDan');
            $join[] = 'LEFT JOIN __USER__ u1 ON kd.user_id = u1.id';
            $join[] = 'LEFT JOIN __ADMIN__ ys ON kd.kdys_id = ys.id';
            
            $join[] = 'LEFT JOIN __JIE_ZHEN__ jz ON kd.jz_id = jz.id';
            $join[] = 'LEFT JOIN __KE_SHI__ jzys ON jz.ysz_id = jzys.id';
            $join[] = 'LEFT JOIN __YU_YUE__ yy ON kd.yy_id= yy.id';
            //最终兵种
            $join[] = 'LEFT JOIN __KE_SHI__ k4 ON yy.ksall_id = k4.id';
            //手术医生
            $join[]= 'LEFT JOIN __KE_SHI__ ssys ON ssys.id = yy.ysz_id';
            //咨询人员
            $join[] = 'LEFT JOIN __ADMIN__ a1 ON yy.admin_id = a1.id';
            //前台
            //分证人
            $join[] = 'LEFT JOIN __ADMIN__ fz ON yy.fz_id = fz.id';
            //关咨询方式
            $join[] = 'LEFT JOIN __LAN_MU__ zx ON yy.zx_id = zx.id';
            //病人来源
            $join[] = 'LEFT JOIN __LAN_MU__ ly1 ON yy.ly_id = ly1.id';
            $join[] = 'LEFT JOIN __LAN_MU__ ly2 ON yy.lyt_id = ly2.id';
            $join[] = 'LEFT JOIN __LAN_MU__ ly3 ON yy.lytt_id = ly3.id';
            //区域
            $join[] = 'LEFT JOIN __AREA__ ae1 ON yy.area_id = ae1.id';
            $join[] = 'LEFT JOIN __AREA__ ae2 ON yy.areat_id = ae2.id';
            
            //原订单
            $join[] = 'LEFT JOIN __KAI_DAN__ ykd ON kd.base_order_id = ykd.id';
            //原订单预约
            $join[] = 'LEFT JOIN __YU_YUE__ yy1 ON ykd.yy_id = yy1.id';
            //原订单接诊医生
            $join[] = 'LEFT JOIN __ADMIN__ yjz ON yy1.ys_id = yjz.id';
            //收费员
            $join[] = 'LEFT JOIN __ADMIN__ sfy ON kd.sf_admin_id = sfy.id';
            //手术管理
            $join[] = 'LEFT JOIN __SHOU_SU__ shousu ON kd.id = shousu.kd_id';

            $order_sort='kd.kd_time desc';
            $page=1;
            if(isset($_GET['p']))
            {
                $page=$_GET['p'];
            }
            //查询条件
            //是否只能看到自己开的单
            //是否只能看到自己开的单
            if(check_group('root'))
            {

            }else
            {
                if(check_group("yishenjz_only_list"))
                {

                    $map['kd.kdys_id']=session('admin_id');
                }
            }
            $map['kd.sf_status']=array('in',array(1,3));
            $sf_status=I('get.sf_status');
            $where_str=array();
            $sbtn=U('Admin/YuShen/waitPriceList',array('is_search'=>1));

            if($sf_status!=''){
                switch ($sf_status) {
                    

                   
                    default:
                        $map['kd.sf_status']=$sf_status;

                        break;
                }
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
                $where_str[]= "u1.name like '%" . $key . "%' or u1.tel like '%" . $key . "%' or kd.kd_number like '%" . $key . "%' ";
            }
            if(I('get.pay_ways')!='')
            {
                $map['kd.pay_ways']=I('get.pay_ways');
            }
            if(I('get.ys_id')!='')
            {
                $map['yy.ys_id']=I('get.ys_id');
            }
            if(I('get.ys_id')!='')
            {
                $map['yy.ys_id']=I('get.ys_id');
            }
            if(I('get.ysz_id')!='')
            {
                $map['yy.ysz_id']=I('get.ysz_id');
            }

            if(I('get.js_status')!='')
            {
                $map['kd.js_status']=I('get.js_status');
            }
            $getdata = I('get.');
            if ($getdata['dzstime'] != '' && $getdata['dzetime'] != '') {
                $getdata['dzstime'] .= " 00:00:00";
                $getdata['dzetime'] .= " 23:59:59";

                $timestr2 = strtotime($getdata['dzstime']) . "," . strtotime($getdata['dzetime']);
               
                $map['yy.dztime'] = array('between', $timestr2);

            }
            $stime=trim((I('get.stime')));
            $etime=trim((I('get.etime')));
            if($stime!=='' and $etime !='')
            {
                $stime .=" 00:00:00";
                $etime.=" 23:59:59";
                $stime=strtotime($stime);
                $etime=strtotime($etime);

                $timestr =  $stime. "," .$etime;
                $map['kd.sf_time'] = array('between', $timestr);
            }
            //合并字符搜索
            if(count($where_str)>0)
            {
                $map['_string']=implode($where_str, " and ");
            }
            //查询END------------------
            $filed = '
                kd.sf_status as sf_status,
                kd.id as id,
                kd.kdys_id as kdys_id,
                kd.jz_id as jz_id,
                kd.uuid as uuid,
                kd.kd_time as kd_time,
                kd.js_status,
                kd.price_show,
                kd.price_total,
                kd.pay_ways as pay_ways,
                kd.pay_price as pay_price,
                kd.sf_time as sf_time,
                kd.kd_number as kd_number,
                kd.price_zhekou as price_zhekou,
                kd.price_oktotal as price_oktotal,
                kd.js_time as js_time,
                kd.true_price as true_price,
                kd.base_oktotal as base_oktotal,
                kd.base_pay_price as base_pay_price,

                ykd.sf_time as ysf_time,
                ykd.kd_number as ykd_number,


                yy1.dztime as ydztime,
                yy1.jztime as yjztime,
                yjz.name as yjz_name,


                jzys.name as sy_name,
                u1.name as user_name,
                ys.name as kd_name,
                yy.ynumber as ynumber,
                ssys.name as ysz_name,
                fz.name as fzname,
                yy.ydatetime as ydatetime,
                yy.ctime as yctime,
                yy.dztime as dztime,
                yy.leibie as leibie,
                k4.name as bz_name,
                zx.name as zx_name,
                jz.jz_smcontent as jz_smcontent,
                jz.jztime as jztime,
                ly1.name as ly_name,
                ae1.name as ae_name,
                a1.name as admin_name,
                ae2.name as ae2_name,
                u1.id as user_id,
                kd.yy_id as yid,
                (kd.price_oktotal-kd.pay_price) as sx_price,
                sfy.name as  sfy_name,
                shousu.id as sus_id,
                shousu.shous_type as shous_type,
                shousu.name as shousu_name,
                shousu.shous_etime as shous_etime

               
             ';
            $count = $model->alias('kd')->join($join)->where($map)->count();// 查询满足要求的总记录数
            $pagesize=(C('PAGESIZE'))!=''?C('PAGESIZE'):'20';
            $list =  $model->alias('kd')->field($filed)->join($join)->where($map)->order($order_sort)->page( $page.','.$pagesize)->select();
            $this->assign('list',$list);// 赋值数据集


            $assing_data=array(
                'onname'=>'onname',
                'adminer'=>get_sfadder('kai_dan'),
                'createer'=>get_kdadder('kai_dan'),
                'is_search'=>I('get.is_search'),
               
            );
            $this->assign('sbtn',$sbtn);
            $this->assign('handle_tpl',$handle_tpl);
            $this->assign('page',page($count, $map, $pagesize));
            $menu_list = $this->getFiledArray($type_arr);
            $this->menu_list = $menu_list;
            $this->assign($assing_data);
            $this->display();

            
            
    }
    //手术管理
    public function add($id=''){
        $this->check_group('shousu_add');
        $this->onname='手术管理';
        $this->assign('onname',$this->onname);
        if(IS_POST)
        {
            $post=I('post.');
            $backurl = U("Admin/ShouSu/aad",array('id'=>$id));
            if(!check_token(I('post.token')))
            {
                $msg=lang('非法操作');
                return  $this->error($msg,$backurl );
            }
            $data=D('ShouSu')->create();
            $data['shous_ytime']=strtotime($data['shous_ytime']);
            foreach ($data as $key => $value) {
                if($value=='')
                {
                    unset($data[$key]);
                }
            }
           
            $result = M('ShouSu')->add($data);
            $backurl = U("Admin/ShouSu/waitPriceList");
            if($result)
            {
                add_log($this->onname . '：手术管理添加成功',$data['user_id']);
                $msg = lang('手术管理添加成功');
                $print=I('post.print');
                if($print==1)
                {
                    $backurl = U("Admin/Print/liaocheng",array('id'=>$result));
                }
                return  $this->success(lang( $msg,'handle'),$backurl);

            }else
            {
                add_log($this->onname . '：手术管理添加失败',$data['user_id']);
                $msg = lang('手术管理添加失败');
                 $backurl = U("Admin/ShouSu/add",array('id'=>$id));
                return  $this->success(lang( $msg,'handle'),$backurl);
            }
            return '';
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
    //疗程管理
     //疗程管理
    public function lcadd($id=''){
        $this->check_group('shousu_add');
        $this->onname='疗程管理';
        $this->assign('onname',$this->onname);
        if(IS_POST)
        {
            $post=I('post.');
            $backurl = U("Admin/ShouSu/lcaad",array('id'=>$id));
            if(!check_token(I('post.token')))
            {
                $msg=lang('非法操作');
                return  $this->error($msg,$backurl );
            }
            $data=D('ShouSu')->create();
            $data['limit_time']=strtotime($data['limit_time']);
            foreach ($data as $key => $value) {
                if($value=='')
                {
                    unset($data[$key]);
                }
            }
            
            $result = M('ShouSu')->add($data);
            
            $backurl = U("Admin/ShouSu/waitPriceList");
            
            
            if($result)
            {
                add_log($this->onname . '：疗程管理添加成功',$data['user_id']);
                $msg = lang('疗程管理添加成功');
                $print=I('post.print');
                if($print==1)
                {
                    $backurl = U("Admin/Print/liaocheng",array('id'=>$result));
                }
                return  $this->success(lang( $msg,'handle'),$backurl);

            }else
            {
                add_log($this->onname . '：疗程管理添加失败',$data['user_id']);
                $msg = lang('疗程管理添加失败');
                 $backurl = U("Admin/ShouSu/lcadd",array('id'=>$id));
                return  $this->success(lang( $msg,'handle'),$backurl);
            }
            return '';
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
    public function edit($id=''){
        $this->check_group('shousu_edit');
        if(IS_POST)
        {
            $m=D('ShouSu');
            $backurl=U('Admin/ShouSu/edit',array('id'=>$id));
            if(!check_token(I('post.token')))
            {
                $msg=lang('非法操作');
                return  $this->error($msg,$backurl );
            }
            if($data=$m->create()){
                $data['shous_oktime']=strtotime($data['shous_oktime']);
                $result=$m->save($data);
                if($result)
                {
                    $backurl=U('Admin/ShouSu/index',array('is_search'=>1,'shous_type'=>'ss'));
                    add_log($this->onname . '：手术管理更新成功',$data['user_id']);
                    $msg = lang('手术管理更新成功');
                    
                    
                    echo "<script language='javascript'>var index = parent.layer.getFrameIndex(window.name); parent.layer.msg('".$msg."');parent.window.location.reload();parent.layer.close(index);</script>";
                }else
                {
                    
                    add_log($this->onname . '：手术管理更新失败',$data['user_id']);
                    $msg = lang('手术管理更新失败');
                     $backurl = U("Admin/ShouSu/lcadd",array('id'=>$id));
                     echo "<script language='javascript'>var index = parent.layer.getFrameIndex(window.name); parent.layer.msg('".$msg."');parent.window.location.reload();parent.layer.close(index);</script>";
                }
            }
            
        }else
        {
            $m=D('ShouSu')->relation(true)->where(array('uuid'=>$id))->find();
           
            $this->assign('data',$m);
            $this->display();
        }
    }
    public function index(){

            $type_arr='shousu';
            $handle_tpl='shousu';
            if(I('get.handle_tpl')!='')
            {
                $handle_tpl=$type_arr=I('get.handle_tpl');
            }
            $this->onname="手术管理";
            $this->check_group('shousu');
            $map=array();
            $model=M('ShouSu');
            $join[] = 'LEFT JOIN __KAI_DAN__ kd ON kd.id = shousu.kd_id';
            $join[] = 'LEFT JOIN __USER__ u1 ON kd.user_id = u1.id';
            $join[] = 'LEFT JOIN __ADMIN__ ys ON kd.kdys_id = ys.id';
            
            $join[] = 'LEFT JOIN __JIE_ZHEN__ jz ON kd.jz_id = jz.id';
            //手术医生
            $join[] = 'LEFT JOIN __KE_SHI__ jzys ON shousu.shouys_id = jzys.id';
            $join[] = 'LEFT JOIN __YU_YUE__ yy ON kd.yy_id= yy.id';
            //最终兵种
            $join[] = 'LEFT JOIN __KE_SHI__ k4 ON yy.ksall_id = k4.id';
            //接诊医生
            $join[]= 'LEFT JOIN __ADMIN__ ssys ON ssys.id = yy.ys_id';
            //咨询人员
            $join[] = 'LEFT JOIN __ADMIN__ a1 ON yy.admin_id = a1.id';
            //前台
            //分证人
            $join[] = 'LEFT JOIN __ADMIN__ fz ON yy.fz_id = fz.id';
            //关咨询方式
            $join[] = 'LEFT JOIN __LAN_MU__ zx ON yy.zx_id = zx.id';
            //病人来源
            $join[] = 'LEFT JOIN __LAN_MU__ ly1 ON yy.ly_id = ly1.id';
            $join[] = 'LEFT JOIN __LAN_MU__ ly2 ON yy.lyt_id = ly2.id';
            $join[] = 'LEFT JOIN __LAN_MU__ ly3 ON yy.lytt_id = ly3.id';
            //区域
            $join[] = 'LEFT JOIN __AREA__ ae1 ON yy.area_id = ae1.id';
            $join[] = 'LEFT JOIN __AREA__ ae2 ON yy.areat_id = ae2.id';
            
            //原订单
            $join[] = 'LEFT JOIN __KAI_DAN__ ykd ON kd.base_order_id = ykd.id';
            //原订单预约
            $join[] = 'LEFT JOIN __YU_YUE__ yy1 ON ykd.yy_id = yy1.id';
            //原订单接诊医生
            $join[] = 'LEFT JOIN __ADMIN__ yjz ON yy1.ys_id = yjz.id';
            //收费员
            $join[] = 'LEFT JOIN __ADMIN__ sfy ON kd.sf_admin_id = sfy.id';

           
            $page=1;
            if(isset($_GET['p']))
            {
                $page=$_GET['p'];
            }
            //查询条件
            //是否只能看到自己开的单
            //是否只能看到自己开的单
            if(check_group('root'))
            {

            }else
            {
                if(check_group("shousu_only"))
                {

                    $map['shousu.admin_id']=session('admin_id');
                }
            }
            $where_str=array();
            $stype='ss';
            if(I('get.shous_type')!='')
            {
                $map['shousu.shous_type']=I('get.shous_type');
                $stype=I('get.shous_type');
            }
           
                 $order_sort='shousu.id desc';


            $sbtn=U('Admin/ShouSu/index',array('is_search'=>1,'shous_type'=>$stype,'handle_tpl'=>$handle_tpl));
           
            if(I('get.kdys_id')!='')
            {
                $map['kd.kdys_id']=I('get.kdys_id');
            }
            if(I('get.ysz_id')!='')
            {
                $map['shousu.ysz_id']=I('get.ysz_id');
            }
            if (I('get.keyword') != '') {
                $key = I('get.keyword');
                $where_str[]= "u1.name like '%" . $key . "%' or u1.tel like '%" . $key . "%' or kd.kd_number like '%" . $key . "%' or shousu.name like '%" . $key . "%' ";
            }
            //shous_status
            if(I('get.shous_status')!='')
            {
                $map['shousu.shous_status']=I('get.shous_status');
            }
            
            
            
            $getdata = I('get.');
            if ($getdata['sf_stime'] != '' && $getdata['sf_etime'] != '') {
                $getdata['sf_stime'] .= " 00:00:00";
                $getdata['sf_etime'] .= " 23:59:59";

                $timestr2 = strtotime($getdata['sf_stime']) . "," . strtotime($getdata['sf_etime']);
                $map['kd.sf_time'] = array('between', $timestr2);
            }
            if ($getdata['su_stime'] != '' && $getdata['su_etime'] != '') {
                $getdata['su_stime'] .= " 00:00:00";
                $getdata['su_etime'] .= " 23:59:59";

                $timestr2 = strtotime($getdata['su_stime']) . "," . strtotime($getdata['su_etime']);
                $map['shousu.shous_ytime'] = array('between', $timestr2);
            }
            if ($getdata['kd_stime'] != '' && $getdata['kd_etime'] != '') {
                $getdata['kd_stime'] .= " 00:00:00";
                $getdata['kd_etime'] .= " 23:59:59";

                $timestr2 = strtotime($getdata['kd_stime']) . "," . strtotime($getdata['kd_etime']);
                $map['kd.kd_time'] = array('between', $timestr2);
            }
            if ($getdata['lm_stime'] != '' && $getdata['lm_etime'] != '') {
                $getdata['lm_stime'] .= " 00:00:00";
                $getdata['lm_etime'] .= " 23:59:59";

                $timestr2 = strtotime($getdata['lm_stime']) . "," . strtotime($getdata['lm_etime']);
                $map['shousu.limit_time'] = array('between', $timestr2);
            }
            
            //合并字符搜索
            if(count($where_str)>0)
            {
                $map['_string']=implode($where_str, " and ");
            }
            //查询END------------------
            $filed = '
                kd.sf_status as sf_status,
                kd.kdys_id as kdys_id,
                kd.jz_id as jz_id,
                kd.kd_time as kd_time,
                kd.js_status,
                kd.price_show,
                kd.price_total,
                kd.pay_ways as pay_ways,
                kd.pay_price as pay_price,
                kd.sf_time as sf_time,
                kd.kd_number as kd_number,
                kd.price_zhekou as price_zhekou,
                kd.price_oktotal as price_oktotal,
                kd.js_time as js_time,
                kd.true_price as true_price,
                kd.base_oktotal as base_oktotal,
                kd.base_pay_price as base_pay_price,

                ykd.sf_time as ysf_time,
                ykd.kd_number as ykd_number,


                yy1.dztime as ydztime,
                yy1.jztime as yjztime,
                yjz.name as yjz_name,


                jzys.name as sy_name,
                u1.name as user_name,
                ys.name as kd_name,
                yy.ynumber as ynumber,
                ssys.name as ysz_name,
                fz.name as fzname,
                yy.ydatetime as ydatetime,
                yy.ctime as yctime,
                yy.dztime as dztime,
                yy.leibie as leibie,
                k4.name as bz_name,
                zx.name as zx_name,
                jz.jz_smcontent as jz_smcontent,
                jz.jztime as jztime,
                ly1.name as ly_name,
                ae1.name as ae_name,
                a1.name as admin_name,
                ae2.name as ae2_name,
                u1.id as user_id,
                kd.yy_id as yid,
                (kd.price_oktotal-kd.pay_price) as sx_price,
                sfy.name as  sfy_name,

                shousu.id as id,
                shousu.ctime as ctime,
                shousu.name as shousu_name,
                shousu.uuid as uuid,
                shousu.shous_type as shous_type,
                shousu.shous_ytime as shous_ytime,
                shousu.shous_oktime as shous_oktime,
                shousu.shous_status as shous_status,
                shousu.shous_times as shous_times,
                shousu.limit_time as limit_time,
                shousu.mark as shousu_mark,
                shousu.shous_type as shous_type,
                shousu.shous_hastimes as shous_hastimes,
                shousu.shous_etime as shous_etime
               
             ';
            $count = $model->alias('shousu')->join($join)->where($map)->count();// 查询满足要求的总记录数
            $pagesize=(C('PAGESIZE'))!=''?C('PAGESIZE'):'20';
            $list =  $model->alias('shousu')->field($filed)->join($join)->where($map)->order($order_sort)->page( $page.','.$pagesize)->select();
            $this->assign('list',$list);// 赋值数据集
            
            $assing_data=array(
                'onname'=>'onname',
                'adminer'=>get_sfadder('kai_dan'),
                'createer'=>get_kdadder('kai_dan'),
                'is_search'=>I('get.is_search'),
               
            );
            $this->assign('sbtn',$sbtn);
            $this->assign('handle_tpl',$handle_tpl);
            $this->assign('page',page($count, $map, $pagesize));
            $menu_list = $this->getFiledArray($type_arr);
            $this->menu_list = $menu_list;
            $this->assign($assing_data);
            $this->display();

            
            
    }
    public function del($id=''){
        //权限选择
        $this->check_group('shousu_del');
        $map=array(
            'id'=>$id
        );
        
        $model   =D('ShouSu');
        $result=$model->where($map)->delete();
       
        if($result)
        {
             //删除日志
            
            add_log($this->onname.'：'.$data['name'].'删除手术成功');
            return  $this->success(lang('删除手术成功','handle'));;
        }
        add_log($this->onname.'：'.$data['name'].'删除手术失败');
        return $this->error(lang('删除手术失败','handle'));;
    }
    public function logSu($id=''){

        if(IS_POST)
        {
            M()->startTrans();
            $post=I('post.');
            $backurl = U("Admin/ShouSu/logSu",array('id'=>$id));
            if(!check_token(I('post.token')))
            {
                $msg=lang('非法操作');
                return  $this->error($msg,$backurl );
            }
            $data=D('ShousuLog')->create();
            
            foreach ($data as $key => $value) {
                if($value=='')
                {
                    unset($data[$key]);
                }
            }

            $result = D('ShousuLog')->add($data);
            $backurl = U("Admin/ShouSu/index",array('is_search'=>1,'shous_type'=>'lc','handle_tpl'=>'shousu_lc'));
            //次数统计
            $times_total=I("post.shous_times");
            $on_times=I('post.shous_hastimes');//当前
            $ldata=array();
            $on_times=$on_times==''?0:($on_times);
            $on_times=$on_times+1;
            $ldata['shous_hastimes']=$on_times;
            
            $ldata['id']=I('post.lc_id');
            if($on_times<$times_total)
            {
                
               
            }else
            {
                $ldata['shous_status']=5;
                
                $ldata['shous_etime']=time();
            }
            $lc_result=D('ShouSu')->save($ldata);
           
            if($result)
            {
                M()->commit();
                add_log($this->onname . '：添加治疗记录成功',$data['user_id']);
                $msg = lang('添加治疗记录成功');
                $print=I('post.print');
                if($print==1)
                {
                    $backurl = U("Admin/Print/liaocheng",array('id'=>$result));
                }
                echo "<script language='javascript'>var index = parent.layer.getFrameIndex(window.name); parent.layer.msg('".$msg."');parent.window.location.reload();parent.layer.close(index);</script>";

            }else
            {
                M()->rollback();
                add_log($this->onname . '：添加治疗记录失败',$data['user_id']);
                $msg = lang('添加治疗记录失败');
                 $backurl = U("Admin/ShouSu/logSu",array('id'=>$id));
                echo "<script language='javascript'>var index = parent.layer.getFrameIndex(window.name); parent.layer.msg('".$msg."');parent.window.location.reload();parent.layer.close(index);</script>";
            }
            return '';
        }else
        {
            $m=D('ShouSu')->relation(true)->where(array('uuid'=>$id))->find();
            
            $this->assign('data',$m);
            $this->display();
        }
    }
    public function getLogSu($id=''){
        $m=D('ShousuLog')->relation(true)->where(array('shous_id'=>$id))->select();
        $this->assign('data',$m);
        $this->display();
    }
    public function lcdel($id=''){
        //权限选择
        $this->check_group('shousu_del');
        $map=array(
            'id'=>$id
        );
        
        $model   =D('ShouSu');
        $result=$model->where($map)->delete();
       
        if($result)
        {
             //删除日志
            $log_result=M('ShousuLog')->where(array('shous_id'=>$id))->delete();
            add_log($this->onname.'：'.$data['name'].'删除疗程成功');
            return  $this->success(lang('删除疗程成功','handle'));;
        }
        add_log($this->onname.'：'.$data['name'].'删除疗程失败');
        return $this->error(lang('删除疗程失败','handle'));;
    }
    public function setStatus($id=''){
         $this->check_group('shousu_edit');
        if(IS_POST)
        {
            $m=D('ShouSu');
            $backurl=U('Admin/ShouSu/setStatus',array('id'=>$id));
            if(!check_token(I('post.token')))
            {
                $msg=lang('非法操作');
                return  $this->error($msg,$backurl );
            }
            if($data=$m->create()){
                
                if($data['shous_status']==5)
                {
                    $data['shous_etime']=time();
                    $data['shous_hastimes']=$data['shous_times'];
                }
                $result=$m->save($data);
                if($result)
                {
                    $backurl = U("Admin/ShouSu/index",array('is_search'=>1,'shous_type'=>'lc','handle_tpl'=>'shousu_lc'));
                    add_log($this->onname . '：手术管理更新成功',$data['user_id']);
                    $msg = lang('手术管理更新成功');
                    
                    
                   echo "<script language='javascript'>var index = parent.layer.getFrameIndex(window.name); parent.layer.msg('".$msg."');parent.window.location.reload();parent.layer.close(index);</script>";
                }else
                {
                    
                    add_log($this->onname . '：手术管理更新失败',$data['user_id']);
                    $msg = lang('手术管理更新失败');
                     $backurl = U("Admin/ShouSu/index",array('is_search'=>1,'shous_type'=>'lc','handle_tpl'=>'shousu_lc'));
                    echo "<script language='javascript'>var index = parent.layer.getFrameIndex(window.name); parent.layer.msg('".$msg."');parent.window.location.reload();parent.layer.close(index);</script>";
                }
                return '';
            }
        }else
        {
            $m=D('ShouSu')->relation(true)->where(array('id'=>$id))->find();
           
            $this->assign('data',$m);
            $this->display();
        }
        
    }
}