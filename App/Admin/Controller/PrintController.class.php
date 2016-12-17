<?php
namespace Admin\Controller;
class PrintController extends AuthController {
    protected $onname='打印';
    public function shoufei(){
        $uuid=I('get.id');
        $map=array();
        $map['kd.uuid']=$uuid;
        $model=M('KaiDan');
        $join[] = 'LEFT JOIN __USER__ u1 ON kd.user_id = u1.id';
        $join[] = 'LEFT JOIN __ADMIN__ ys ON kd.kdys_id = ys.id';
        
        $join[] = 'LEFT JOIN __JIE_ZHEN__ jz ON kd.jz_id = jz.id';
       
        $join[] = 'LEFT JOIN __YU_YUE__ yy ON kd.yy_id= yy.id';
        //接诊医生
         $join[] = 'LEFT JOIN __ADMIN__ jzys ON yy.ys_id = jzys.id';
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
            ykd.sf_status as ysf_status,


            yy1.dztime as ydztime,
            yy1.jztime as yjztime,
            yjz.name as yjz_name,


            
          
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
            u1.name as user_name,
            u1.sex as user_sex,
            u1.birthday as birthday,
            kd.yy_id as yid,
            (kd.price_oktotal-kd.pay_price) as sx_price,
            sfy.name as  sfy_name,
            jzys.name as jzys_name
         ';
        $show=$model->alias('kd')->field($filed)->join($join)->where($map)->find();
       
        $this->assign('show',$show);
        $this->display();
    } 
    public function caiwu_day(){
        $this->onname="收费结算";
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

        $order_sort='kd.kd_time desc';
        $page=1;
        if(isset($_GET['p']))
        {
            $page=$_GET['p'];
        }
        //查询条件
        //是否只能看到自己开的单
        /*if(!check_group('root')){
        
            if(check_group("kaidan_only")  )
            {

                $map['kd.kd_id']=session('admin_id');
            }
        }*/
       
        $where_str=array();
        $sbtn=U('Admin/CaiWu/waitPriceList',array('sf_status'=>'all','is_search'=>1));
        $handle_tpl='df';
        $handle_tpl="status_3";
        $map['kd.js_status']=1;
        $map['kd.sf_status']=array('not in',array(0,7,8,9,11,12,4,5,6));
        //结算当天时间
        

        $getdata = I('get.');
        if ($getdata['js_stime'] != '' && $getdata['js_etime'] != '') {
           
            $map['_string']="FROM_UNIXTIME(kd.js_time,'%Y-%m-%d') >= str_to_date('".$getdata['js_stime']."','%Y-%m-%d') and FROM_UNIXTIME(kd.js_time,'%Y-%m-%d') <= str_to_date('".$getdata['js_etime']."','%Y-%m-%d')";
        }else
        {
            $map['_string']="FROM_UNIXTIME(kd.js_time,'%Y-%m-%d') = str_to_date('".get_days(0)."','%Y-%m-%d')";
        }

        $type_arr='ok';
        $sbtn=U('Admin/CaiWu/waitPriceList',array('sf_status'=>'ok','is_search'=>1));
        
        $order_sort='kd.js_time desc';
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
            u1.sex as user_sex,
            kd.yy_id as yid,
            (kd.price_oktotal-kd.pay_price) as sx_price,
            sfy.name as  sfy_name
         ';
        
        $list =  $model->alias('kd')->field($filed)->join($join)->where($map)->order($order_sort)->select();
        $this->assign('list',$list);// 赋值数据集

        $this->display();
    }
    public function caiwu_day_tui(){
        $this->onname="收费结算";
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

        $order_sort='kd.kd_time desc';
        $page=1;
        if(isset($_GET['p']))
        {
            $page=$_GET['p'];
        }
        //查询条件
        //是否只能看到自己开的单
        /*if(!check_group('root')){
        
            if(check_group("kaidan_only")  )
            {

                $map['kd.kd_id']=session('admin_id');
            }
        }*/
       
        $where_str=array();
        $sbtn=U('Admin/CaiWu/waitPriceList',array('sf_status'=>'all','is_search'=>1));
        $handle_tpl='df';
        $handle_tpl="status_3";
        $map['kd.js_status']=1;
        $map['kd.sf_status']=array('in',array(6,4,5));
        //结算当天时间
        $getdata = I('get.');
        if ($getdata['js_stime'] != '' && $getdata['js_etime'] != '') {
            
           
            $map['_string']="FROM_UNIXTIME(kd.js_time,'%Y-%m-%d') >= str_to_date('".$getdata['js_stime']."','%Y-%m-%d') and FROM_UNIXTIME(kd.js_time,'%Y-%m-%d') <= str_to_date('".$getdata['js_etime']."','%Y-%m-%d')";
        }else
        {
            $map['_string']="FROM_UNIXTIME(kd.js_time,'%Y-%m-%d') = str_to_date('".get_days(0)."','%Y-%m-%d')";
        }
        $type_arr='ok';
        $sbtn=U('Admin/CaiWu/waitPriceList',array('sf_status'=>'ok','is_search'=>1));
        
        $order_sort='kd.js_time desc';
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
            sfy.name as  sfy_name
         ';
        $list =  $model->alias('kd')->field($filed)->join($join)->where($map)->order($order_sort)->select();
        $this->assign('list',$list);// 赋值数据集

        $this->display();
    }
    public function shousu($id){

        $this->onname="手术管理";
        $this->check_group('shousu');
        $map=array();
        $map['shousu.id']=$id;
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
           
            u1.sex as user_sex,
            u1.birthday as birthday,
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
        
        $list =  $model->alias('shousu')->field($filed)->join($join)->where($map)->find();
        $this->assign('data',$list);// 赋值数据集
        
        
       
        $this->display();
    }
  
   
}