<?php
/**
 * Created by PhpStorm.
 * User: kongqi
 * Date: 2016/4/23
 * Time: 11:27
 */
function create_admin_id(){
    return session('admin_id');
}
function echo_html($str){
    return htmlspecialchars_decode($str);
}
//取得网站来源
function get_website(){
    $map=array(
        'is_website'=>'1',
        'checked'=>1,
        );
    $arr=array();
    $m=M('LanMu')->where($map)->select();
    if(count($m)>0)
    {
        foreach ($m as $key => $value) {
            # code...
            $arr[]=$value['id'];
        }
        return $arr;
    }
    return '';
}
//取得回访记录数
//
//取得创建人，传入TABLE
function get_adder($table){
    
     $m=M()->query("select * from __PREFIX__admin where id in (select admin_id from __PREFIX__".$table." group by admin_id) and checked='1'");
     return $m;
}
//数组转option
function arr_to_option($data,$checkid){
   
        
            if(count($data)>0)
            {
                foreach ($data as $k=>$v)
                {
                    if($checkid==$v['id'])
                    {
                        $check='selected="selected"';
                    }else
                    {
                        $check='';
                    }
                    $str.="<option ". $check." value='".$v['id']."'>".$v['realname']."</option>";
                }
            }
            return  $str;

    
}
/**
 * @param $str
 * 是否审核
 */
//取得登录的信息
function admin($filed='',$group=''){
    if(session('admin_info'))
    {
        $admin_info=session('admin_info');
        if($group!='')
        {
            $gn=M('AdminGroup')->find($admin_info['groupid']);
            return $gn['name'];
        }
        if($filed!='')
        {

            return $admin_info[$filed];
        }
        return $admin_info;
    }
}

function checked_str($str,$msg=array('通过','禁用')){
    switch ($str)
    {
        case '1':
            echo '<span class="fa fa-check-circle text-success text-14" title="通过"></span>';
            break;
        case '0':
            echo '<span class="fa fa-minus-circle text-error text-14" title="禁用"></span>';
            break;
    }
}

/**
 * @param $str
 *是否推荐
 */
function is_top($str){
    switch ($str)
    {
        case '1':
            echo '<span class="fa fa-thumbs-up text-error text-14" title="通过"></span>';
            break;
        case '0':
            echo '';
            break;
    }
}
/**
 * @return 是否登录
 */
function is_login(){
    $user = @session('uniqid');
    if (empty($user)) {
        return 0;
    } else {
        return 1;
    }
}


/**
 * @param $groupid
 * @return array
 * 取得权限组
 */
function get_group_rule($groupid){
    //算出权限组
    $model=M('AdminGroup');
    $model=$model->where(array('id'=>array('in',$groupid)))->field('ruleid')->select();
    //合并权限
    $grouparr=array();
    foreach ($model as $v)
    {
        $grouparr=array_merge($grouparr,to_arr($v['ruleid']));
    }

    return $grouparr;
}
/**
 * @param $groupid
 * @return array
 * 取得权限组里面病人来源的操作
 */
function get_brly_rule($groupid){
    //算出权限组
    $model=M('AdminGroup');
    $model=$model->where(array('id'=>array('in',$groupid)))->field('brly_id')->find();
    if(count($model)>0)
    {
        return $model['brly_id'];
    }

}

/**
 * 传入ID，取得权限组信息
 * @param $groupid
 * @return mixed|Model|\Think\Model
 */
function get_group_info($groupid){
    //算出权限组
    $model=M('AdminGroup');
    $model=$model->where(array('id'=>array('in',$groupid)))->find();
    if(count($model)>0)
    {
        return $model;
    }

}

/**
 * 加载编辑器
 * @param string $str
 */

function load_ueditor($str="content"){
    $dir=WEB_URL.'/Public/ueditor/';
    $str=' <script type="text/javascript" charset="utf-8" src="'.$dir.'ueditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="'.$dir.'ueditor.all.js"> </script>
    <script type="text/javascript" charset="utf-8" src="'.$dir.'lang/zh-cn/zh-cn.js"></script>';
    
    echo $str;


}

/**
 * 输出类型
 * @param $str
 * @param $array
 */
function echo_type($str,$array){
    if(array_key_exists($str,$array))
    {
        echo "<span style='margin-right: 5px' class='btn btn-xs btn-primary'>".$array[$str]."</span>";
    }
}

//权限
 function check_group($str)
{
    $group = session('group');
    if ($group) {
        if(in_array('root',$group))
        {
            return true;
        }
        if(!in_array($str, $group)) {
            return false;
        }
        return true;
    } else {
        return false;
    }
}

/**
 * 语言设置
 * @param $cn
 * @param $type
 * @return mixed
 */
function lang($cn,$type=''){
    $chang_lang='cn';
    if(cookie('lang'))
    {
        $chang_lang=cookie('lang');
    }
   
    if($chang_lang=='cn')
    {
        return $cn;
    }
    $lang_list=array();
    $chache_lang='lang';
    if(S($chache_lang))
    {
        $lang_list=S($chache_lang);
    }else
    {
         $lang=M('Lang')->where(array('checked'=>1,'type'=>$chang_lang))->select();
         if(count($lang)>0)
         {
             foreach ($lang as $key => $value) {
                 $lang_list[$value['name']]=$value['ename'];
             }
         }
         S($chache_lang,$lang_list,60*60*24*365);
    }
   
    
   if(array_key_exists($cn,$lang_list))
    {
       
        return $lang_list[ $cn];
    }else
    {
        return $cn;
    }

    
}
//操作日志
function add_log($content){

    $log=M('log');
    $data['admin_id']=session('admin_id');
    $data['ctime']=time();
    $data['content']=$content;
    $log->add($data);

}
//手机查看日志
function add_smslog($uid,$content='查看手机'){

    $log=M('SmsLog');
    $data['admin_id']=session('admin_id');
    $data['ctime']=time();
    $data['uid']=$uid;
    $data['content']=$content;
    $log->add($data);

}

/**
 * 取得权限规则
 * @param $id
 * @return mixed
 */
function get_rule($id){
    $map['fid']=$id;
    $rule=M('AdminRule')->where($map)->select();
    return $rule;
}

/**
 * 字典导航
 */
function zidian_nav(){
    $rule=array(
        'keshi'=>'科室',
        'bingren'=>'病人来源',

        'area'=>'区域字典',
        'yushen'=>'医生字典',
        'xiaofei'=>'收费类别',
        'pricezd'=>'收费项目',
        'yuyuezl'=>'预约评定',
        'zixun'=>'咨询工具',
        'danzhen'=>'到诊评定',
        
       // 'shuofei'=>'收费字典',//'jiesuan'=>'结算字典',
        'huifang'=>'回访字典',
        'jigou'=>'机构字典',
        'website'=>'网站字典',
        'user'=>'个人属性'
    );
    $url=array(
        'xiaofei'=>U('Admin/XiaoFeiZiDian/index',array('type'=>'xiaofei')),
        'keshi'=>U('Admin/KeShiZiDian/index',array('type'=>'keshi')),
        'bingren'=>U('Admin/BingRenLaiYuanZiDian/index',array('type'=>'bingren')),
        'pricezd'=>U('Admin/PriceZiDian/index'),
        'area'=>U('Admin/AreaZiDian/index',array('type'=>'area')),
        'yushen'=>U('Admin/YuShenZiDian/index',array('type'=>'yushen')),
        'yuyuezl'=>U('Admin/YuYueZiDian/index',array('type'=>'yuyuezl')),
        'danzhen'=>U('Admin/DaoZhengZiDian/index',array('type'=>'daozhen')),
        'zixun'=>U('Admin/ZiXun/index',array('type'=>'zixun')),
        //'shuofei'=>U('Admin/ShouFeiZiDian/index',array('type'=>'shuofei')),
        //'jiesuan'=>U('Admin/JieSuanZiDian/index',array('type'=>'jiesuan')),
        'huifang'=>U('Admin/HuiFangZiDian/index',array('type'=>'huifang')),
        'jigou'=>U('Admin/JiGouZiDian/index',array('type'=>'jigou')),
        'user'=>U('Admin/UserZiDian/index',array('type'=>'user')),
        'website'=>U('Admin/WebSiteZiDian/index',array('type'=>'website'))
    );
    $str='';
    foreach ($rule as $k=>$rv)
    {
        if(check_group($k))
        {
            $urlweb= $url[$k];
            $str.='<li>
                        <a class="J_menuItem" href="'.$urlweb.'">'.lang($rv,'menu').'</a>
                    </li>';
        }
    }
    echo $str;
}

/**
 * 取得科室里面的信息
 * @param int $id
 * @param int $echo，返回select option
 * @param string $checkid 是否选中
 * @return mixed|string
 */
function get_keshi($id=0,$echo=1,$checkid=''){
    $rule=M('KeShi')->where(array('checked'=>1,'fid'=>0,'type'=>'keshi'))->select();
    $str='';
    $check='';
    if($echo)
    {
        if(count($rule)>0)
        {
            foreach ($rule as $k=>$v)
            {
                if($checkid==$v['id'])
                {
                    $check='selected="selected"';
                }else
                {
                    $check='';
                }
                $str.="<option ". $check." value='".$v['id']."'>".$v['name']."</option>";
            }
        }
        return  $str;

    }
    return $rule;
}
/*

 */
function get_shyishen($checkid='',$echo=1){
    $rule=M('KeShi')->where(array('checked'=>1,'type'=>'yushen'))->select();
    $str='';
    $check='';
    if($echo)
    {
        if(count($rule)>0)
        {
            foreach ($rule as $k=>$v)
            {
                if($checkid==$v['id'])
                {
                    $check='selected="selected"';
                }else
                {
                    $check='';
                }
                $str.="<option ". $check." value='".$v['id']."'>".$v['name']."</option>";
            }
        }
        return  $str;

    }
    return $rule;
}

/**
 * 取得单个栏目信息
 * @param string $type 类型
 * @param int $echo 输出格式
 * @param string $fid 父ID,FIRST 为根父ID
 * @param string $sid
 * @return mixed|string
 */
function get_lanmu_onelist($type="zixun",$echo=1,$fid="",$sid='',$checked=''){
    $check='';
    $map=array();
    $map['checked']=1;
    $map['type']=$type;
    if($fid!='')
    {
        if($fid=='first')
        {
            $map['fid']=0;
        }else
        {
            $map['fid']=array('in',$fid);
        }

    }
    if($sid!='')
    {
        $map['id']=array('in',$sid);
    }



    $rule=M('LanMu')->where($map)->select();
    $str='';
    if($echo)
    {
        if(count($rule)>0)
        {
            foreach ($rule as $k=>$v)
            {
                if($checked==$v['id'])
                {
                    $check='selected="selected"';
                }else
                {
                    $check='';
                }
                $str.="<option $check value='".$v['id']."'>".$v['name']."</option>";
            }
        }
        return  $str;

    }
    return $rule;
}

/**
 * 取得回访
 * @param string $subtype
 * @param string $type
 * @param int $echo
 * @param string $fid
 * @param string $sid
 * @param string $checked
 * @return mixed|string
 */
function get_huifang_onelist($subtype='hf_theme',$type="huifang",$echo=1,$fid="",$sid='',$checked=''){
    $check='';
    $map=array();
    $map['checked']=1;
    $map['type']=$type;
    $map['subtype']=$subtype;
    if($fid!='')
    {
        if($fid=='first')
        {
            $map['fid']=0;
        }else
        {
            $map['fid']=array('in',$fid);
        }

    }
    if($sid!='')
    {
        $map['id']=array('in',$sid);
    }



    $rule=M('LanMu')->where($map)->select();
    $str='';
    if($echo)
    {
        if(count($rule)>0)
        {
            foreach ($rule as $k=>$v)
            {
                if($checked==$v['id'])
                {
                    $check='selected="selected"';
                }else
                {
                    $check='';
                }
                $str.="<option $check value='".$v['id']."'>".$v['name']."</option>";
            }
        }
        return  $str;

    }
    return $rule;
}
function get_huifang_onelist_li($subtype='hf_theme',$type="huifang",$echo=1,$fid="",$sid='',$checked=''){
    $check='';
    $map=array();
    $map['checked']=1;
    $map['type']=$type;
    $map['subtype']=$subtype;
    if($fid!='')
    {
        if($fid=='first')
        {
            $map['fid']=0;
        }else
        {
            $map['fid']=array('in',$fid);
        }

    }
    if($sid!='')
    {
        $map['id']=array('in',$sid);
    }



    $rule=M('LanMu')->where($map)->select();
    $str='';
    if($echo)
    {
        if(count($rule)>0)
        {
            foreach ($rule as $k=>$v)
            {
               
                $str.=' <li data-id="'.$v['id'].'"><a href="#">'.$v['name'].'</a></li>';
            }
        }
        return  $str;

    }
    return $rule;
}

/**
 * 回访带查询条件
 * @param $where
 * @param int $echo
 * @param string $fid
 * @param string $sid
 * @param string $checked
 * @return mixed|string
 */
function get_huifang_where($where,$echo=1,$fid="",$sid='',$checked=''){
    $check='';
    $map=array();
    $map['checked']=1;
    $map=$where+$map;
  
    if($fid!='')
    {
        if($fid=='first')
        {
            $map['fid']=0;
        }else
        {
            $map['fid']=array('in',$fid);
        }

    }
    if($sid!='')
    {
        $map['id']=array('in',$sid);
    }



    $rule=M('LanMu')->where($map)->select();
    $str='';
    if($echo)
    {
        if(count($rule)>0)
        {
            foreach ($rule as $k=>$v)
            {
                if($checked==$v['id'])
                {
                    $check='selected="selected"';
                }else
                {
                    $check='';
                }
                $str.="<option $check value='".$v['id']."'>".$v['name']."</option>";
            }
        }
        return  $str;

    }
    return $rule;
}
//取得机构来源的二级
function jigou_id(){
    $arr=array();
    //找出第一级
    $m1=M('LanMu')->where(array('fid'=>0,'checked'=>1,'type'=>'bingren','is_jigou'=>1))->find();

    if(count($m1)>0)
    {
        $m=M('LanMu')->where(array('fid'=>$m1['id'],'checked'=>1,'type'=>'bingren','is_tongji'))->select();
        if(count($m)>0)
        {
            foreach ($m as $v)
            {
                $arr[]=$v['id'];
            }
        }
    }
    return $arr;

}

/**
 * 取得接诊医生,ADMIN表
 * @param array $where
 * @param int $echo
 * @param string $checked
 * @return mixed|string
 */
function get_doc($where=array(),$echo=1,$checked=''){

    $map=array();
    $map['checked']=1;
    $map['groupid']=12;
    $map=$where+$map;
    $m=M('Admin')->where($map)->select();
    $str='';
    if($echo)
    {
        if(count($m)>0)
        {
            foreach ($m as $k=>$v)
            {
                if($checked==$v['id'] && $checked!='')
                {
                    $check='selected="selected"';
                }else
                {
                    $check='';
                }

                $str.="<option $check value='".$v['id']."'>".$v['realname']."</option>";
            }
        }
        return  $str;

    }
    return $m;
}
function get_huifang_er($echo=1,$checked='',$where=array()){

    $map=array();
    $map['checked']=1;
    $map['groupid']=12;
    $map=$where+$map;
    $m=M()->query("select * from __PREFIX__admin where groupid in (select id from __PREFIX__admin_group where is_hf='1') and checked='1'");
    $str='';
    if($echo)
    {
        if(count($m)>0)
        {
            foreach ($m as $k=>$v)
            {
                if($checked==$v['id'])
                {
                    $check='selected="selected"';
                }else
                {
                    $check='';
                }
                $str.="<option $check value='".$v['id']."'>".$v['realname']."</option>";
            }
        }
        return  $str;

    }
    return $m;
}

//竞价使用
function get_wangixao_where($where,$echo=1,$sid='',$checked=''){
    $check='';
    $map=array();
    $map['checked']=1;
    $map=$where+$map;
   
    if($sid!='')
    {
        $map['id']=array('in',$sid);
    }

    //$map['fid']=array('neq',0);

    $rule=M('LanMu')->where($map)->select();
    $str='';
    if($echo)
    {
        if(count($rule)>0)
        {
            foreach ($rule as $k=>$v)
            {
                if($checked==$v['id'])
                {
                    $check='selected="selected"';
                }else
                {
                    $check='';
                }
                $str.="<option $check value='".$v['id']."'>".$v['name']."</option>";
            }
        }
        return  $str;

    }
    return $rule;
}

/**
 * 取得地区
 * @param int $echo
 * @param string $fid
 * @param string $sid
 * @param string $checked
 * @return mixed|string
 */
function get_area_list($echo=1,$fid="",$sid='',$checked=''){
    $check='';
    $map=array();
    $map['checked']=1;
    if($fid!='')
    {
        if($fid=='first')
        {
            $map['fid']=0;
        }else
        {
            $map['fid']=array('in',$fid);
        }

    }
    if($sid!='')
    {
        $map['id']=array('in',$sid);
    }



    $rule=M('Area')->where($map)->select();
    $str='';
    if($echo)
    {
        if(count($rule)>0)
        {
            foreach ($rule as $k=>$v)
            {
                if($checked==$v['id'])
                {
                    $check='selected="selected"';
                }else
                {
                    $check='';
                }
                $str.="<option $check value='".$v['id']."'>".$v['name']."</option>";
            }
        }
        return  $str;

    }
    return $rule;
}


//在线客户
function onkefu($type='is_zixun',$merg=0,$aid='',$ready=''){
    $str='';
    if(check_group('root'))
    {
        //
        $option='';
        //查询组
        $Model = new \Think\Model();
        $admin_arr=$Model->query("select * from __PREFIX__admin where groupid in (select id from __PREFIX__admin_group where is_zixun='1') and checked='1'");
        if(count($admin_arr)>0)
        {
            foreach ($admin_arr as $key=>$v)
            {
                if($v['id']==$aid)
                {
                    $checked="selected='selsected'";
                }else
                {
                    $checked="";
                }
                $option.="<option value='".$v['id']."' ".$checked." >".$v['name']."(".$v['realname'].")</option>";
            }
        }
        $real='';
        if($ready!='')
        {
            $real='disabled';
        }
        $str='
                    <select class="form-control inline wb50" '.$real.' name="admin_id" required id="userinfoZxy">
                        <option value="">'.lang('请选择咨询员').'</option>
                        '.  $option.'
                    </select>
          
        ';
    }else
    {
        $str=' <input type="hidden" name="admin_id" value="'.session('admin_id').'">';
    }
    return $str;
}
//在线客户
function onkefu2($type='is_zixun',$merg=0,$aid=''){
    $str='';
    $admin_id=I('request.admin_id');
    if(check_group('root'))
    {
        //
        $option='';
        //查询组
        $Model = new \Think\Model();
        $admin_arr=$Model->query("select * from __PREFIX__admin where groupid in (select id from __PREFIX__admin_group where is_zixun='1') and checked='1'");
        if(count($admin_arr)>0)
        {
            foreach ($admin_arr as $key=>$v)
            {
                if($admin_id==$v['id'] or $v['id']==$aid)
                {
                    $checked="selected='selsected'";
                }else
                {
                    $checked="";
                }
                $option.="<option value='".$v['id']."'  ".$checked." >".$v['name']."(".$v['realname'].")</option>";
            }
        }

        $str='<div class="col-sm-3">
             <div class="input-group m-b">
                                    <span class="input-group-addon">'.lang('咨询客服').'</span>
                                   
                                        <select class="form-control" name="admin_id" id="userinfoZxy">
                                            <option value="">'.lang('全部').'</option>
                                            '.  $option.'
                                        </select>
                                   
           </div></div>
        ';
    }else
    {

    }
    return $str;
}
//年龄设置
function echo_age($id=''){
    
    $str='';
   
    $ckstr='';
    for($i=10;$i<=80;$i++)
    {
      if($id==$i)
      {
        $ckstr='selected="selected"';
        
      }else
      {
        $ckstr='';
      }
        


        $str.='<option '.$ckstr.' value="'.$i.'">'.$i.'</option>';


    }
    return $str;
}

//预约生成
function create_ynumber(){
    $model=M('YuYueNumber');

    $data['ctime']=time();
    $data['admin_id']=session('admin_id');

    $result=$model->data($data)->add();

    if($result){
        // 如果主键是自动增长型 成功后返回值就是最新插入的值

        return ($result);
    }else
    {
        return false;
    }


};

/**
 * 设置select选中单个状态
 * @param $str2 传入的变量，默认是请求
 * @param $v 传入的值
 * @return bool
 */
function set_on($str2,$v){
    $str=I("request.".$str2);
    if($str=='')
    {
        return false;
    }
    if($str==$v)
    {
        echo "selected='selected'";
    }
}

/**
 * 传值选中
 * @param $str
 * @param $v
 * @return bool
 */
function set_on2($str,$v){

    if($str=='')
    {
        return false;
    }
    if($str==$v)
    {
        echo "selected='selected'";
    }
}
/*
 * 取得日期
 */
function get_date($type, $num = 1,$field='')
{
    $array = array();
    switch ($type) {
        case 'sw':
            $fistday = date("Y-m-d H:i:s", mktime(0, 0, 0, date("m"), date("d") - date("w") + 1 - 7, date("Y")));
            $lastday = date("Y-m-d H:i:s", mktime(23, 59, 59, date("m"), date("d") - date("w") + 7 - 7, date("Y")));
            break;
        case 'bw':
            //如果是星期天则返回上周，
            if (date("w", time()) == 0) {
                $fistday = date("Y-m-d H:i:s", mktime(0, 0, 0, date("m"), date("d") - date("w") + 1 - 7, date("Y")));
                $lastday = date("Y-m-d H:i:s", mktime(23, 59, 59, date("m"), date("d") - date("w") + 7 - 7, date("Y")));
            } else {
                $fistday = date("Y-m-d H:i:s", mktime(0, 0, 0, date("m"), date("d") - date("w") + 1, date("Y")));
                $lastday = date("Y-m-d H:i:s", mktime(23, 59, 59, date("m"), date("d") - date("w") + 7, date("Y")));
            }

            break;
        case 'sm':
            $fistday = date("Y-m-d H:i:s", mktime(0, 0, 0, date("m") - 1, 1, date("Y")));
            $lastday = date("Y-m-d  H:i:s", mktime(23, 59, 59, date("m"), 0, date("Y")));
            break;

        case 'bm':
            $fistday = date("Y-m-d  H:i:s", mktime(0, 0, 0, date("m"), 1, date("Y")));
            $lastday = date("Y-m-d  H:i:s", mktime(23, 59, 59, date("m"), date("t"), date("Y")));
            break;
        case 'bjd':
            $season = ceil((date('n')) / 3);//当月是第几季度
            $fistday = date('Y-m-d H:i:s', mktime(0, 0, 0, $season * 3 - 3 + 1, 1, date('Y')));
            $lastday = date('Y-m-d H:i:s', mktime(23, 59, 59, $season * 3, date('t', mktime(0, 0, 0, $season * 3, 1, date("Y"))), date('Y')));
            break;
        case 'diy':
            $fistday = date("Y-m-d H:i:s", mktime(0, 0, 0, date("m"), date("d"), date("Y")));
            $lastday = date("Y-m-d", strtotime($num . " day"))." 00:00:00";
            break;
        case 'diy2':
            $fistday = date("Y-m-d", mktime(0, 0, 0, date("m"), date("d"), date("Y")));
            $lastday = date("Y-m-d", strtotime($num . " day"));
            break;

        case 'year':
            $fistday = date("Y-m-d H:i:s",strtotime(date("Y",time())."-1"."-1")); //本年开始
            $lastday = date("Y-m-d H:i:s",strtotime(date("Y",time())."-12"."-31")); //本年结束
            break;


    }
    return $array = array(
        'firstday' => $fistday,
        'lastday' => $lastday
    );
}

/**
 * 天数设置，+1明天，-1昨天
 * @param $num
 * @return bool|string
 */
function get_days($num){
    $day=date("Y-m-d", strtotime($num . " day"));
    return $day;


}
function yuyue_status($checked=''){
    $arr=array(
        '1'=>lang('已预约'),
        '2'=>lang('已到院'),
        '3'=>lang('已接诊'),
        '4'=>lang('已开单'),
        '5'=>lang('逾期未到')
    );
    if($checked!='')
    {
        return $arr[$checked];
    }
    return $arr;
}
function ren_status($checked=''){
    $arr=array(
        '0'=>lang('未回访'),
        '1'=>lang('已回访'),
       
    );
    if($checked!='')
    {
        return $arr[$checked];
    }
    return $arr;
}

function yuyue_leibie($checked=''){
    $arr=array(

        '1'=>lang('初诊'),
        '2'=>lang('复诊'),
        '3'=>lang('复查'),
        '4'=>lang('再消费'),
        '5'=>lang('其他')
    );
    if($checked!='')
    {
        return $arr[$checked];
    }
    return $arr;
}
function yuyue_option_leibie($checked='none'){
    $arr=yuyue_leibie();
    $str='';
    foreach ($arr as $key => $v) {
        # code...
        
        if($key==$checked)
        {
            $on="selected='selected'";
        }else
        {
            $on='';
        }

        $str.="<option value='".$key."' ".$on.">".$v."</option>";

    }
    return $str;
}
function btn_yycolor($checked=''){
     $arr=array(
        '1'=>'badge badge-grey',
        '2'=>'badge badge-info',
        '3'=>'badge  badge-green',

    );
    if($checked!='')
    {
        return $arr[$checked];
    }
    return $arr;
}
function sf_status($checked=''){
    $arr=array(
        '0'=>lang('未收费'),
        '1'=>lang('已收费'),
        '2'=>lang('已收定金'),

    );
    if($checked!='')
    {
        return $arr[$checked];
    }
    return $arr;
}
function js_status($checked=''){
    $arr=array(
        '0'=>lang('未结算'),
        '1'=>lang('已结算'),


    );
    if($checked!='')
    {
        return $arr[$checked];
    }
    return $arr;
}
function btn_color($checked=''){
     $arr=array(
        '0'=>'badge',
        '1'=>'badge badge-info',
        '2'=>'badge badge-danger',

    );
    if($checked!='')
    {
        return $arr[$checked];
    }
    return $arr;
}

function get_select_jstatus($checkid = 'all')
{
    $checkid=trim($checkid);
    $str='';
    $check = '';
    $rule = js_status();
    foreach ($rule as $k => $v) {

        if ($checkid == $k && $checkid!='') {
            $check = 'selected="selected"';
        } else {
            $check = '';
        }
        $str .= "<option " . $check . " value='" . $k . "'>" . $v . "</option>";
    }
    return $str;


}
function get_select_sftatus($checkid = 'all')
{
    $checkid=trim($checkid);
    $str = '';
    $check = '';
    $rule = sf_status();
    foreach ($rule as $k => $v) {
        if($checkid!='')
        {
            if ($checkid == $k ) {
                $check = 'selected="selected"';
            } else {
                $check = '';
            }
        }

        $str .= "<option " . $check . " value='" . $k . "'>" . $v . "</option>";
    }
    return $str;


}


function set_arr_to($table,$where){
    $map=array('checked'=>1);
    $map=$where+$map;
    $js_arr=M($table)->where($map)->select();
    $narr=array();
    if(count($js_arr)>0)
    {
        foreach ($js_arr as $key => $value) {
            # code...
            $narr[$value['id']]=$value['name'];
        }
    }
    return $narr;
}

function get_yushen($id=0,$echo=1,$checkid=''){
    $rule=M('KeShi')->where(array('checked'=>1,'type'=>'yushen'))->select();
  
    $str='';
    $check='';
    if($echo)
    {
        if(count($rule)>0)
        {
            foreach ($rule as $k=>$v)
            {
                if($checkid==$v['id'])
                {
                    $check='selected="selected"';
                }else
                {
                    $check='';
                }
                $str.="<option ". $check." value='".$v['id']."'>".$v['name']."</option>";
            }
        }
        return  $str;

    }
    return $rule;
}

function get_yushen_ks($id=0,$echo=1,$checkid=''){
    $join[] = 'LEFT JOIN __KE_SHI__ a1 ON k1.fid = a1.id';
    $filed='
        k1.name as name ,k1.id as id,
        a1.name as ksname,a1.id as ks_id
    ';
    $rule=M('KeShi')->field($filed)->alias('k1')->join($join)->where(array('k1.checked'=>1,'k1.type'=>'yushen'))->select();
   
    $str='';
    $check='';
    if($echo)
    {
        if(count($rule)>0)
        {
            foreach ($rule as $k=>$v)
            {
                if($checkid==$v['id'])
                {
                    $check='selected="selected"';
                }else
                {
                    $check='';
                }
                $str.="<option data-ksid='".$v['ks_id']."' ". $check." value='".$v['id']."'>".$v['ksname']."——".$v['name']."</option>";
            }
        }
        return  $str;

    }
    return $rule;
}
function to_time($time,$f='d-m-Y H:i:s'){
    if($time=='')
    {
        return '';
    }
    return date($f,$time);
}
function to_date_time($time,$f='Y-m-d H:i:s'){
    return date($f,strtotime($time));
}
/*短信模板
 * /
 */
function get_sms_tpl($type=1,$checked){
    $checkstr='';
    $str='';
    $m=M('sms')->where(array('checked'=>1))->select();
    if($type==1)
    {
        if(count($m)>0)
        {
            foreach ($m as $k=>$v)
            {
                $str.='<option value="'.$v['content'].'">'.$v['name'].'</option>';
            }
        }
        return $str;
    }
   
}
//隐藏手机
function hide_tel($phone,$start,$num){
    $IsWhat = preg_match('/(0[0-9]{2,3}[-]?[2-9][0-9]{6,7}[-]?[0-9]?)/i',$phone); //固定电话
    if($IsWhat == 1){
        $str=preg_replace('/(0[0-9]{2,3}[-]?[2-9])[0-9]{3,4}([0-9]{3}[-]?[0-9]?)/i','$1****$2',$phone);
    }else{
        $str=preg_replace('/(1[358]{1}[0-9])[0-9]{4}([0-9]{4})/i','$1****$2',$phone);
    }
    return substr_replace($phone,'****',3,4);
}
//取得病人库
function get_user($uid){
    $user=M('User')->find($uid);
    if(count($user)>0)
    {
        return $user;
    }
    return false;
}
function checked_on2($str,$id){
    $arr=str_to_arr($str);
    if($arr)
    {
        return in_array($id,$arr);
    }
    return '';
}

/**
 * 分割字符串为数组，
 * @param $str
 * @param string $type
 * @return array|bool
 */
function str_to_arr($str,$type=","){
    if($str){
        $newstr=explode($type,$str);
        if(!$newstr) return false;
        return  $newstr;
    }
    return false;
}