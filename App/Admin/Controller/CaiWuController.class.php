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
            $join[] = 'LEFT JOIN __YU_YUE__ yy ON kd.yy_id= yy.id';
            //最终兵种
            $join[] = 'LEFT JOIN __KE_SHI__ k4 ON yy.ksall_id = k4.id';
            //手术医生
            $join[]= 'LEFT JOIN __ADMIN__ ssys ON ssys.id = yy.ysz_id';
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
                kd.js_status,
                kd.price_show,
                kd.price_total,
                kd.pay_ways as pay_ways,
                kd.pay_price as pay_price,
                kd.sf_time as sf_time,
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
                ly1.name as ly_name,
                ae1.name as ae_name,
                a1.name as admin_name,
                u1.id as user_id,
                kd.yy_id as yid,
                (kd.price_total-kd.true_price-youhui_price) as sx_price
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
            
            $map['kd.sf_status']=0;
            if(I('get.sf_status')!='')
            {
                $map['kd.sf_status']=I('get.sf_status');
            }
            if($map['kd.sf_status']=='2')
            {
                $map['_string']="kd.sf_status='2' or kd.sf_status='5'";
                unset($map['kd.sf_status']);
            }
            if(I('get.sf_status')=='all')
            {

                $map['kd.sf_status']=array('in',array(1,2,3));
               
                $stime=trim(strtotime(I('get.stime')));
                $etime=trim(strtotime(I('get.etime')));
                if($stime!=='' and $etime !='')
                {
                    $timestr =  $stime. "," .$etime;
                    $map['kd.sf_time'] = array('between', $timestr);
                }
            }

            if($map['kd.sf_status']=='3')
            {
                $map['_string']="kd.sf_status='6' or kd.sf_status='3'";
                unset($map['kd.sf_status']);
            }
            //echo print_r($map);
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

            
            $count = $model->alias('kd')->join($join)->where($map)->count();// 查询满足要求的总记录数
            $pagesize=(C('PAGESIZE'))!=''?C('PAGESIZE'):'20';
            $list =  $model->alias('kd')->field($filed)->join($join)->where($map)->order('kd.kd_time desc')->page( $page.','.$pagesize)->select();
            $this->assign('list',$list);// 赋值数据集
            $handle_tpl='df';
            $sbtn=U('Admin/CaiWu/waitPriceList',array('sf_status'=>'all','is_search'=>1));
            
            //判断模版
            if(I('get.sf_status')=='all')
            {
                $type_arr='has';
                $handle_tpl='status_1';
            }elseif(I('get.sf_status')==2)
            {
                 $handle_tpl="status_2";
                $type_arr='dingjing';
                $sbtn=U('Admin/CaiWu/waitPriceList',array('sf_status'=>2,'is_search'=>1));
            }
            elseif(I('get.sf_status')==3)
            {
                 $handle_tpl="status_3";
                $type_arr='yukuan';
                $sbtn=U('Admin/CaiWu/waitPriceList',array('sf_status'=>3,'is_search'=>1));
            }
            $this->assign('sbtn',$sbtn);
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
                     'td-1' => array('name' => lang('预约号'), 'filed'=>'ynumber','diy'=>'text-blue','is_time'=>'','fun'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                     'td-2' => array('name' => lang('收费时间'), 'filed'=>'sf_time','diy'=>'text-blue','is_time'=>'1','fun'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                     'td-3' => array('name' => lang('姓名'), 'filed'=>'user_name','diy'=>'text-blue','is_time'=>'','fun'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                     'td-4' => array('name' => lang('付款类型'), 'filed'=>'pay_ways','diy'=>'', 'is_time'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                     'td-5' => array('name' => lang('付款金额'), 'filed'=>'pay_price','diy'=>'', 'is_time'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                     
                     'td-5-1' => array('name' => lang('开单人'), 'filed'=>'kd_name','diy'=>'','is_time'=>'','fun'=>'','w' => '', 'h' => '', 'is_hide' => ''),

                      'td-6' => array('name' => lang('收费状态'), 'filed'=>'sf_status','diy'=>'', 'is_time'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                      'td-7' => array('name' => lang('结算状态'), 'filed'=>'js_status','diy'=>'', 'is_time'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                      'td-11' => array('name' => lang('余款金额'), 'filed'=>'sx_price','diy'=>'', 'is_time'=>'','w' => '', 'h' => '', 'is_hide' => ''),

                      'td-12' => array('name' => lang('消费项目'), 'filed'=>'price_show','diy'=>'', 'is_time'=>'','fun'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                      'td-14' => array('name' => lang('合计'), 'filed'=>'price_total','diy'=>'', 'is_time'=>'','fun'=>'','w' => '', 'h' => '', 'is_hide' => ''),

                      'td-9' => array('name' => lang('手术医生'), 'filed'=>'ysz_name','diy'=>'', 'is_time'=>'','fun'=>'','w' => '', 'h' => '', 'is_hide' => '1'),
                      'td-8' => array('name' => lang('到院时间'), 'filed'=>'dztime','diy'=>'text-blue', 'is_time'=>'1','fun'=>'','w' => '', 'h' => '', 'is_hide' => '1'),
                      'td-10' => array('name' => lang('开单时间'), 'filed'=>'kd_time','diy'=>'text-blue','is_time'=>'1','fun'=>'','w' => '', 'h' => '', 'is_hide' => '1'),
                 );
            break;
             case "ok":
                $menu_list = array(
                    'td-0' => array('name' => lang('结算时间'), 'filed'=>'js_time','diy'=>'text-blue','is_time'=>'1','fun'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                    'td-1' => array('name' => lang('收费时间'), 'filed'=>'sf_time','diy'=>'text-blue','is_time'=>'1','fun'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                    'td-2' => array('name' => lang('预约号'), 'filed'=>'ynumber','diy'=>'text-blue','is_time'=>'','fun'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                    'td-3' => array('name' => lang('姓名'), 'filed'=>'user_name','diy'=>'text-blue','is_time'=>'','fun'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                    'td-4' => array('name' => lang('结算状态'), 'filed'=>'js_status','diy'=>'', 'is_time'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                    'td-5' => array('name' => lang('收费人'), 'filed'=>'sfy_name','diy'=>'', 'is_time'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                    'td-6' => array('name' => lang('实收金额'), 'filed'=>'true_price','diy'=>'', 'is_time'=>'','w' => '', 'h' => '', 'is_hide' => ''),

                    'td-7' => array('name' => lang('消费项目'), 'filed'=>'price_show','diy'=>'', 'is_time'=>'','fun'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                    'td-8' => array('name' => lang('合计'), 'filed'=>'price_total','diy'=>'', 'is_time'=>'','fun'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                    
                    'td-9' => array('name' => lang('手术医生'), 'filed'=>'ysz_name','diy'=>'', 'is_time'=>'','fun'=>'','w' => '', 'h' => '', 'is_hide' => '1'),
                    'td-10' => array('name' => lang('到院时间'), 'filed'=>'dztime','diy'=>'text-blue', 'is_time'=>'1','fun'=>'','w' => '', 'h' => '', 'is_hide' => '1'),
                    'td-11' => array('name' => lang('开单时间'), 'filed'=>'kd_time','diy'=>'text-blue','is_time'=>'1','fun'=>'','w' => '', 'h' => '', 'is_hide' => '1'),
               
                    

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
            case 'all':
               $menu_list = array(
                    'td-1' => array('name' => lang('预约号'), 'filed'=>'ynumber','diy'=>'text-blue','is_time'=>'','fun'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                    'td-2' => array('name' => lang('姓名'), 'filed'=>'user_name','diy'=>'text-blue','is_time'=>'','fun'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                    'td-3' => array('name' => lang('性别'), 'filed'=>'sex','diy'=>'', 'is_time'=>'','fun'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                    'td-4' => array('name' => lang('年龄'), 'filed'=>'age','diy'=>'', 'is_time'=>'','fun'=>'','w' => '', 'h' => '', 'is_hide' =>''), 
                    'td-5' => array('name' => lang('接诊时间'), 'filed'=>'jztime','diy'=>'text-blue', 'is_time'=>'1','fun'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                    'td-6' => array('name' => lang('预约状态'), 'filed'=>'ystatus','diy'=>'', 'is_time'=>'','fun'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                    'td-7' => array('name' => lang('来院类别'), 'filed'=>'leibie','diy'=>'', 'is_time'=>'','fun'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                    'td-8' => array('name' => lang('接诊医生'), 'filed'=>'ys_name','diy'=>'', 'is_time'=>'','fun'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                    'td-9' => array('name' => lang('手术医生'), 'filed'=>'ysz_name','diy'=>'', 'is_time'=>'','fun'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                    'td-10' => array('name' => lang('前台员'), 'filed'=>'fzname','diy'=>'', 'is_time'=>'','fun'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                    'td-11' => array('name' => lang('咨询员'), 'filed'=>'admin_name','diy'=>'', 'is_time'=>'','fun'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                    'td-12' => array('name' => lang('接诊小结'), 'filed'=>'jz_smcontent','diy'=>'', 'is_time'=>'','fun'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                    'td-13' => array('name' => lang('来源'), 'filed'=>'ly_name','diy'=>'', 'is_time'=>'','fun'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                    'td-14' => array('name' => lang('地区'), 'filed'=>'ae2_name','diy'=>'', 'is_time'=>'','fun'=>'','w' => '', 'h' => '', 'is_hide' => ''),

                    'td-15' => array('name' => lang('预约时间'), 'filed'=>'yctime','diy'=>'text-info', 'is_time'=>'1','fun'=>'','w' => '', 'h' => '', 'is_hide' => '1'),

                    'td-16' => array('name' => lang('预到时间'), 'filed'=>'ydatetime','diy'=>'text-blue', 'is_time'=>'1','fun'=>'','w' => '', 'h' => '', 'is_hide' => '1'),
                                           
               
                    'td-17' => array('name' => lang('到院时间'), 'filed'=>'dztime','diy'=>'text-blue', 'is_time'=>'1','fun'=>'','w' => '', 'h' => '', 'is_hide' => '1'),
                    'td-18' => array('name' => lang('具体病种'), 'filed'=>'bz_name','diy'=>'', 'is_time'=>'','fun'=>'','w' => '', 'h' => '', 'is_hide' => '1'),
                                        
                    'td-19' => array('name' => lang('咨询方式'), 'filed'=>'zx_name','diy'=>'', 'is_time'=>'','fun'=>'','w' => '', 'h' => '', 'is_hide' => '1'),
                );
                break;
            default:
                $menu_list = array(
                        'td-0' => array('name' => lang('开单时间'), 'filed'=>'kd_time','diy'=>'text-blue', 'is_time'=>'1','fun'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                         'td-1' => array('name' => lang('预约号'), 'filed'=>'ynumber','diy'=>'text-blue','is_time'=>'','fun'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                         'td-2' => array('name' => lang('姓名'), 'filed'=>'user_name','diy'=>'text-blue','is_time'=>'','fun'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                         'td-3' => array('name' => lang('付款类型'), 'filed'=>'pay_ways','diy'=>'','is_time'=>'','fun'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                        

                         'td-4' => array('name' => lang('付款金额'), 'filed'=>'pay_total','diy'=>'','is_time'=>'','fun'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                         'td-5' => array('name' => lang('开单人'), 'filed'=>'kd_name','diy'=>'','is_time'=>'','fun'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                        
                         'td-6' => array('name' => lang('消费项目'), 'filed'=>'price_show','diy'=>'','is_time'=>'','fun'=>'','w' => '', 'h' => '', 'is_hide' => ''),

                         'td-7' => array('name' => lang('合计总价'), 'filed'=>'price_total','diy'=>'','is_time'=>'','fun'=>'','w' => '', 'h' => '', 'is_hide' => ''),

                         
                         'td-8' => array('name' => lang('到院时间'), 'filed'=>'dztime','diy'=>'text-blue', 'is_time'=>'1','fun'=>'','w' => '', 'h' => '', 'is_hide' => '1'),
                         'td-9' => array('name' => lang('接诊时间'), 'filed'=>'jztime','diy'=>'text-blue', 'is_time'=>'1','fun'=>'','w' => '', 'h' => '', 'is_hide' => '1'),
                         'td-10' => array('name' => lang('手术医生'), 'filed'=>'ysz_name','diy'=>'', 'is_time'=>'','fun'=>'','w' => '', 'h' => '', 'is_hide' => '1')

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
            $join[] = 'LEFT JOIN __YU_YUE__ yy ON kd.yy_id= yy.id';
            //最终兵种
            $join[] = 'LEFT JOIN __KE_SHI__ k4 ON yy.ksall_id = k4.id';
            //手术医生
            $join[]= 'LEFT JOIN __ADMIN__ ssys ON ssys.id = yy.ysz_id';
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
            $sbtn=U('Admin/CaiWu/index',array('is_search'=>1));
            $this->assign('sbtn',$sbtn);
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
                kd.js_status,
                kd.price_show,
                kd.price_total,
                kd.pay_ways as pay_ways,
                kd.pay_price as pay_price,
                kd.sf_time as sf_time,
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
                ly1.name as ly_name,
                ae1.name as ae_name,
                a1.name as admin_name,
                u1.id as user_id,
                kd.yy_id as yid,
                kd.js_time as js_time,
                (kd.true_price+kd.bq_money) as true_price,
                (kd.price_total-kd.true_price-youhui_price) as sx_price,
                 sfy.name as  sfy_name
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
            $map['kd.sf_status']=1;
            $map['kd.js_status']=1;
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
    //收费
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
            $data['js_time']=time();
        } else {
            $status = 0;
             $name='撤销结算';
             $data['js_time']='';
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
    public function kaidanList()
    {
       
        //print_r(session('group'));
        $this->check_group('shouyin_check');
        $map = array();
        $this->assign('is_search',I('get.is_search'));
        $stpl="YuYue:so:caiwu";
        $sbtn=U('Admin/CaiWu/kaidanList',array('is_search'=>1));
        $onstatus=I('get.stpl');
        if($onstatus=='2')
        {
             //$sbtn=U('Admin/CaiWu/kaidanList',array('is_search'=>1));
        }
        if($onstatus=='3')
        {
             //$sbtn=U('Admin/CaiWu/kaidanList',array('is_search'=>1));
        }
        $this->assign('stpl',$stpl);
        $this->assign('sbtn',$sbtn);
        //网站来源
        
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

        
        $map['y1.status']=3;
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
            ys.name as ys_name,
    
            jz.jz_smcontent as jz_smcontent,
            jz.id as qz_id,
            ssys.name as ysz_name,
            fz.name as fzname,

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

        $type_arr='all';
        
        $menu_list = $this->getFiledArray($type_arr);
        
       
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
            $orderstr='y1.jztime desc,y1.id desc';
        }
        $list = $model->alias('y1')->field($filed)->join($join)->order($orderstr)->where($map)->page($page . ',' . $pagesize)->select();
        //print_r($list);
        $this->assign('list', $list);// 赋值数据集
       
        
        $this->menu_list = $menu_list;
        $this->assign('page', page($count, $map, $pagesize));// 赋值分页输出
        $this->display("CaiWu:kaidanList");
        
        
    }
    //开单收费
    public function addKaiDanPrice($id,$yid){

        $this->check_group('kaidan_add');
        $this->onname='开单收费';
        $this->assign('onname',$this->onname);

        $m=D('JieZhen')->relation(true)->where(array('checked'=>1))->find($id);
       
        $data=array(

            );
        $this->assign($data);
        $this->data=$m;
        $this->display("CaiWu:kaidan_add");
    }
    //收费POST
    public function addKaiDanPricePost(){
        if(IS_POST){
            M()->startTrans();
            $model =D('KaiDan');
            $post=I('post.');
            if($data=$model->create()) {
                $data['admin_id']=session('admin_id');
                $data['jz_id']=$post['qz_id'];//接诊表ID
                $data['yy_id']=$post['yy_id'];//预约ID
               

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

              
                $dataList=array();
                //更新预约表
             
                $ydata['status']=4;//状态
                $ydata['kdtime']=$post['ykd_time'];
                //$data['kd_time']=time();//开单时间
                $ydata['id']=$post['yy_id'];

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
                $data['true_price']=$data['cash_price']+$data['shuaka_price']+$data['other_price'];
                //付了金额
                foreach ($data as $key => $value) {
                    if($value=='')
                    {
                        unset($data[$key]);
                    }
                }
                //print_r($data);
                //print_r($ydata);
                //exit();
                $yresult=M('YuYue')->data($ydata)->save();

                $backurl=U("Admin/CaiWu/kaidanList");

                $result =    $model->add($data);
                return '';
                if($result) {
                    //更新优惠券
                    if ($data['youhui_id'] != '') {
                        $yhq_data = array(
                            'utime' => time(),
                            'status'=>1,
                            'kd_id' => $result
                        );
                        M('Card')->where(array('id' => $data['youhui_id']))->save($yhq_data);
                    }
                    M()->commit();
                    add_log($this->onname.'：'.$this->logname.'添加成功');
                    $msg=lang('添加成功','handle');

                   
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

}