<?php
namespace Admin\Model;
use Think\Model;
class HomeModel extends Model {
    Protected $autoCheckFields = false;
    public function getTotal($name='RenWu',$map=array(),$date=0,$type='ctime',$all=''){
        //回访任务  已完成的回访任务    待回访 新增回访记录
        $where=array();
        $where['_string']="FROM_UNIXTIME(".$type.",'%Y-%m-%d') = str_to_date('".get_days($date)."','%Y-%m-%d')";
        if($all=='')
        {
            if(!check_group('root'))
            {
                 $where['admin_id']=session('admin_id');
            }
        }
       
        $where=$map+$where;
       
        $m= M($name)->where($where)->count();
        return $m;
        
    }
    public function getTotal_month($name='RenWu',$map=array(),$type='by',$type_time='ctime',$all=''){
        //回访任务  已完成的回访任务    待回访 新增回访记录
        $where=array();
        switch ($type) {
            case 'by':
                $fistday = date("Y-m-d", mktime(0, 0, 0, date("m"), 1, date("Y")));
                $lastday = date("Y-m-d", mktime(23, 59, 59, date("m"), date("t"), date("Y")));
                break;
            
            case 'sy':
                $fistday = date("Y-m-d", mktime(0, 0, 0, date("m") - 1, 1, date("Y")));
                $lastday = date("Y-m-d", mktime(23, 59, 59, date("m"), 0, date("Y")));
                break;
            case "bz":
                if (date("w", time()) == 0) {
                    $fistday = date("Y-m-d", mktime(0, 0, 0, date("m"), date("d") - date("w") + 1 - 7, date("Y")));
                    $lastday = date("Y-m-d", mktime(23, 59, 59, date("m"), date("d") - date("w") + 7 - 7, date("Y")));
                } else {
                    $fistday = date("Y-m-d", mktime(0, 0, 0, date("m"), date("d") - date("w") + 1, date("Y")));
                    $lastday = date("Y-m-d", mktime(23, 59, 59, date("m"), date("d") - date("w") + 7, date("Y")));
                }
            break;
            case "zq":
                $arr=prev_week();
                $fistday=$arr['firstday'];
                $lastday=$arr['lastday'];
            break;
            
        }
        /*$fistday=strtotime($fistday);
        $lastday=strtotime($lastday);*/
        //$where[$type_time]=array('between',array( $fistday,$lastday));
        $where['_string']="FROM_UNIXTIME(".$type_time.",'%Y-%m-%d') >= str_to_date('".$fistday."','%Y-%m-%d') and FROM_UNIXTIME(".$type_time.",'%Y-%m-%d') <= str_to_date('".$lastday."','%Y-%m-%d')";
        if($all=='')
        {
            if(!check_group('root'))
            {
                 $where['admin_id']=session('admin_id');
            }
        }
       
       
        $where=$map+$where;
       
        $m= M($name)->where($where)->count();
        return $m;
        
    }
    //月对话
    public function getTotalGzl_has($date=0,$map=array(),$all=''){
        $where=array();
        $day=get_days($date);
        $where['_string']="FROM_UNIXTIME(cdate,'%Y-%m-%d') = str_to_date('".$day."','%Y-%m-%d')";
        if($all=='')
        {
            if(!check_group('root'))
            {
                 $where['admin_id']=session('admin_id');
            }
        }
        
        $where=$map+$where;
        
        $m= M('Gzl')->field('sum(aduihua+bduihua+cduihua) as total')->where($where)->find();

        return $m['total']==''?0:$m['total'];
    }
    //月对话量
    public function getTotalGzl_month($type='by',$map=array(),$all=''){
        $where=array();
        switch ($type) {
            case 'by':
                $fistday = date("Y-m-d", mktime(0, 0, 0, date("m"), 1, date("Y")));
                $lastday = date("Y-m-d", mktime(23, 59, 59, date("m"), date("t"), date("Y")));
                break;
            
            case 'sy':
                $fistday = date("Y-m-d", mktime(0, 0, 0, date("m") - 1, 1, date("Y")));
                $lastday = date("Y-m-d", mktime(23, 59, 59, date("m"), 0, date("Y")));
                break;
            case "zq":
                $arr=prev_week();
                $fistday=$arr['firstday'];
                $lastday=$arr['lastday'];
            break;
            
            default:
                # code...
                break;
        }
        //$fistday=strtotime($fistday);
        //$lastday=strtotime($lastday);
        if($all=='')
        {
            if(!check_group('root'))
            {
                 $where['admin_id']=session('admin_id');
            }
        }
        $type_time='cdate';
        $where['_string']="FROM_UNIXTIME(".$type_time.",'%Y-%m-%d') >= str_to_date('".$fistday."','%Y-%m-%d') and FROM_UNIXTIME(".$type_time.",'%Y-%m-%d') <= str_to_date('".$lastday."','%Y-%m-%d')";

        $m= M('Gzl')->field('sum(aduihua+bduihua+cduihua) as total')->where($where)->find();
        return $m['total']==''?0:$m['total'];
       
       
       
       
    }
    //咨询
    public function getTotalZiXun($date=0,$map=array(),$all=''){
        $where=array();
        $day=get_days($date);
        $where['_string']="FROM_UNIXTIME(ctime,'%Y-%m-%d') = str_to_date('".$day."','%Y-%m-%d')";
        if($all=='')
        {
            if(!check_group('root'))
            {
                 $where['admin_id']=session('admin_id');
            }
        }
        
        $where=$map+$where;
        
        $m= M('ZiXun')->where($where)->count();

        return $m;
    }
    //咨询月
    public function getTotalZiXun_month($type='by',$map=array(),$all=''){
        $where=array();
        switch ($type) {
            case 'by':
                $fistday = date("Y-m-d", mktime(0, 0, 0, date("m"), 1, date("Y")));
                $lastday = date("Y-m-d", mktime(23, 59, 59, date("m"), date("t"), date("Y")));
                break;
            
            case 'sy':
                $fistday = date("Y-m-d", mktime(0, 0, 0, date("m") - 1, 1, date("Y")));
                $lastday = date("Y-m-d", mktime(23, 59, 59, date("m"), 0, date("Y")));
                break;
            case "zq":
                $arr=prev_week();
                $fistday=$arr['firstday'];
                $lastday=$arr['lastday'];
            break;
            
            default:
                # code...
                break;
        }
        //$fistday=strtotime($fistday);
        //$lastday=strtotime($lastday);
        
        //$where['ctime']=array('between',array( $fistday,$lastday));
        $type_time='ctime';
        $where['_string']="FROM_UNIXTIME(".$type_time.",'%Y-%m-%d') >= str_to_date('".$fistday."','%Y-%m-%d') and FROM_UNIXTIME(".$type_time.",'%Y-%m-%d') <= str_to_date('".$lastday."','%Y-%m-%d')";
        if($all=='')
        {
            if(!check_group('root'))
            {
                 $where['admin_id']=session('admin_id');
            }
        }
        
        $where=$map+$where;
        
        $m= M('ZiXun')->where($where)->count();

        return $m;
    }
    //十天有效咨询量数组
    function getGzl_days($days="-10",$type_time='cdate',$all=''){
        $where=array();
        $fistday=get_days($days);
        $lastday=get_days(0);
        $fistday=strtotime($fistday);
        $lastday=strtotime($lastday);

        $where[$type_time]=array('between',array( $fistday,$lastday));
         if($all=='')
        {
            if(!check_group('root'))
            {
                 $where['admin_id']=session('admin_id');
            }
        }
        //print_r($where);
        $m=M('Gzl')->field(' FROM_UNIXTIME(cdate,"%Y-%m-%d") as cdate,sum(aduihua+bduihua+cduihua )as total')->where($where)->group('cdate')->order($type_time." asc")->select();
        $data=array();
       
        foreach ($m as $key => $value) {
            $data[$value['cdate']]=$value['total'];
            
        }

        return $data;
    }
    //十天预约量
    function getYuYue_days($type_time='ctime',$days="-10",$map=array(),$all=''){
        $where=array();
        $fistday=get_days($days);
        $lastday=get_days(0);
        $fistday=strtotime($fistday);
        $lastday=strtotime($lastday);

        $where[$type_time]=array('between',array( $fistday,$lastday));
         if($all=='')
        {
            if(!check_group('root'))
            {
                 $where['admin_id']=session('admin_id');
            }
        }
        $where=$map+$where;
        //print_r($where);
        $m=M('YuYue')->field(' FROM_UNIXTIME('.$type_time.',"%Y-%m-%d") as cdate,count(*)as total')->where($where)->group('cdate')->order($type_time." asc")->select();
        $data=array();
       
        foreach ($m as $key => $value) {
            $data[$value['cdate']]=$value['total'];
            
        }

        return $data;
    }
    //市场开发
    public function getMarket_between($type='bz',$map=array(),$all=''){
        $where=array();
        switch ($type) {
            case 'by':
                $fistday = date("Y-m-d", mktime(0, 0, 0, date("m"), 1, date("Y")));
                $lastday = date("Y-m-d", mktime(23, 59, 59, date("m"), date("t"), date("Y")));
                break;
            
            case 'sy':
                $fistday = date("Y-m-d", mktime(0, 0, 0, date("m") - 1, 1, date("Y")));
                $lastday = date("Y-m-d", mktime(23, 59, 59, date("m"), 0, date("Y")));
                break;
            case "zq":
                $arr=prev_week();
                $fistday=$arr['firstday'];
                $lastday=$arr['lastday'];
            break;
            case "bz":
                if (date("w", time()) == 0) {
                    $fistday = date("Y-m-d H:i:s", mktime(0, 0, 0, date("m"), date("d") - date("w") + 1 - 7, date("Y")));
                    $lastday = date("Y-m-d H:i:s", mktime(23, 59, 59, date("m"), date("d") - date("w") + 7 - 7, date("Y")));
                } else {
                    $fistday = date("Y-m-d H:i:s", mktime(0, 0, 0, date("m"), date("d") - date("w") + 1, date("Y")));
                    $lastday = date("Y-m-d H:i:s", mktime(23, 59, 59, date("m"), date("d") - date("w") + 7, date("Y")));
                }
            break;
                
            default:
                # code...
                break;
        }

        //$fistday=strtotime($fistday);
        //$lastday=strtotime($lastday);
        $where['type']='bingren';
        $where['is_jigou']='1';
        //$where['ctime']=array('between',array( $fistday,$lastday));
        $type_time='ctime';
        $where['_string']="FROM_UNIXTIME(".$type_time.",'%Y-%m-%d') >= str_to_date('".$fistday."','%Y-%m-%d') and FROM_UNIXTIME(".$type_time.",'%Y-%m-%d') <= str_to_date('".$lastday."','%Y-%m-%d')";
        if($type=='all')
        {
            unset($where['ctime']);
        }
        if($all=='')
        {
            if(!check_group('root'))
            {
                 $where['admin_id']=session('admin_id');
            }
        }
        
        $where=$map+$where;
        
        $m= M('LanMu')->where($where)->count();

        return $m;
    }
    //10天点击工具
    public function getToolsToal($days="-10",$type_time='cdate',$all=''){
        $m=M('LanMu')->where(array('is_price'=>1,'type'=>'bingren','checked'=>1))->select();
        $gj_id=array();
        $gj_name=array();
        foreach ($m as $key => $value) {
            $gj_id[]=$value['id'];
            $gj_name[$value['id']]=$value['name'];
        }
        $where=array();
        $where['xf_id']=array('in',$gj_id);
        $where[''];
        




        $fistday=get_days($days);
        $lastday=get_days(0);

        $fistday=strtotime($fistday);
        $lastday=strtotime($lastday);

        $where[$type_time]=array('between',array( $fistday,$lastday));
         if($all=='')
        {
            if(!check_group('root'))
            {
                 $where['admin_id']=session('admin_id');
            }
        }
        //FORMAT(sum(prices)/sum(clicks),0) as chenben
        $xf=M("XiaoFei")->field(' FROM_UNIXTIME('.$type_time.',"%Y-%m-%d") as cdate,sum(prices)as total,sum(clicks) as cltotal,xf_id,FORMAT(sum(prices)/sum(clicks),2) as chengben')->where($where)->group('xf_id,cdate')->order($type_time." asc, xf_id asc")->select();
        $data['gj_name']=$gj_name;
        $data['data']=$xf;
        //print_r($data);
       return $data;

    }
    //开单总额
    public function getTotalPrice($name='KaiDan',$map=array(),$date=0,$time='kd_time',$all=''){
        //回访任务  已完成的回访任务    待回访 新增回访记录
        $where=array();
        $where['_string']="FROM_UNIXTIME(".$time.",'%Y-%m-%d') = str_to_date('".get_days($date)."','%Y-%m-%d')";
        if($all=='')
        {
            if(!check_group('root'))
            {
                 $where['admin_id']=session('admin_id');
            }
        }
       
        $where=$map+$where;
       
        $m= M($name)->field('sum(price_total) as total')->where($where)->find();
        return $m['total']==''?0:$m['total'];
        
    }
    //月开单数据
    //市场开发
    public function getPrice_between($type='bz',$name='KaiDan',$map=array(),$type_time='kd_time',$all=''){
        $where=array();
        switch ($type) {
            case 'by':
                $fistday = date("Y-m-d", mktime(0, 0, 0, date("m"), 1, date("Y")));
                $lastday = date("Y-m-d", mktime(23, 59, 59, date("m"), date("t"), date("Y")));
                break;
            
            case 'sy':
                $fistday = date("Y-m-d", mktime(0, 0, 0, date("m") - 1, 1, date("Y")));
                $lastday = date("Y-m-d", mktime(23, 59, 59, date("m"), 0, date("Y")));
                break;
            case "zq":
                $arr=prev_week();
                $fistday=$arr['firstday'];
                $lastday=$arr['lastday'];
            break;
            case "bz":
                if (date("w", time()) == 0) {
                    $fistday = date("Y-m-d", mktime(0, 0, 0, date("m"), date("d") - date("w") + 1 - 7, date("Y")));
                    $lastday = date("Y-m-d", mktime(23, 59, 59, date("m"), date("d") - date("w") + 7 - 7, date("Y")));
                } else {
                    $fistday = date("Y-m-d", mktime(0, 0, 0, date("m"), date("d") - date("w") + 1, date("Y")));
                    $lastday = date("Y-m-d", mktime(23, 59, 59, date("m"), date("d") - date("w") + 7, date("Y")));
                }
            break;
                
            default:
                # code...
                break;
        }

        //$fistday=strtotime($fistday);
        //$lastday=strtotime($lastday);
        if($all=='')
        {
            if(!check_group('root'))
            {
                 $where['admin_id']=session('admin_id');
            }
        }
        //$where[$type_time]=array('between',array( $fistday,$lastday));
        $where['_string']="FROM_UNIXTIME(".$type_time.",'%Y-%m-%d') >= str_to_date('".$fistday."','%Y-%m-%d') and FROM_UNIXTIME(".$type_time.",'%Y-%m-%d') <= str_to_date('".$lastday."','%Y-%m-%d')";
        $where=$map+$where;
        
        $m= M($name)->field('sum(price_total) as total')->where($where)->find();
        return $m['total']==''?0:$m['total'];
    }
    //收费合计
    public function getTotalSum($name='KaiDan',$map=array(),$date=0,$type='sf_time',$all='',$field='true_price'){
        //回访任务  已完成的回访任务    待回访 新增回访记录
        $where=array();
        $where['_string']="FROM_UNIXTIME(".$type.",'%Y-%m-%d') = str_to_date('".get_days($date)."','%Y-%m-%d')";
        if($all=='')
        {
            if(!check_group('root'))
            {
                 $where['admin_id']=session('admin_id');
            }
        }
       
        $where=$map+$where;
       
        $m= M($name)->where($where)->sum($field);

        return $m==''?0:$m;
        
    }
    //收费合计月份
    public function getTotalSumMonth($name='KaiDan',$map=array(),$date_type='bz',$type_time='sf_time',$all='',$field='true_price'){
        //回访任务  已完成的回访任务    待回访 新增回访记录
        $where=array();
        switch ($date_type) {
            case 'by':
                $fistday = date("Y-m-d", mktime(0, 0, 0, date("m"), 1, date("Y")));
                $lastday = date("Y-m-d", mktime(23, 59, 59, date("m"), date("t"), date("Y")));
                break;
            
            case 'sy':
                $fistday = date("Y-m-d", mktime(0, 0, 0, date("m") - 1, 1, date("Y")));
                $lastday = date("Y-m-d", mktime(23, 59, 59, date("m"), 0, date("Y")));
                break;
            case "zq":
                $arr=prev_week();
                $fistday=$arr['firstday'];
                $lastday=$arr['lastday'];
            break;
            case "bz":
                if (date("w", time()) == 0) {
                    $fistday = date("Y-m-d", mktime(0, 0, 0, date("m"), date("d") - date("w") + 1 - 7, date("Y")));
                    $lastday = date("Y-m-d", mktime(23, 59, 59, date("m"), date("d") - date("w") + 7 - 7, date("Y")));
                } else {
                    $fistday = date("Y-m-d", mktime(0, 0, 0, date("m"), date("d") - date("w") + 1, date("Y")));
                    $lastday = date("Y-m-d", mktime(23, 59, 59, date("m"), date("d") - date("w") + 7, date("Y")));
                }
            break;
                
            default:
                # code...
                break;
        }

        if($all=='')
        {
            if(!check_group('root'))
            {
                 $where['admin_id']=session('admin_id');
            }
        }
        $where['_string']="FROM_UNIXTIME(".$type_time.",'%Y-%m-%d') >= str_to_date('".$fistday."','%Y-%m-%d') and FROM_UNIXTIME(".$type_time.",'%Y-%m-%d') <= str_to_date('".$lastday."','%Y-%m-%d')";
        
        $where=$map+$where;
       
        $m= M($name)->where($where)->sum($field);

        return $m==''?0:$m;
        
    }
    
}