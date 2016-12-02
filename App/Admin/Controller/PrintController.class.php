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
  
   
}