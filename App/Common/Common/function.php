<?php
/**
 * Created by PhpStorm.
 * User: kongqi
 * Date: 2016/4/20
 * Time: 14:41
 */
/**
 * @param $array 验证码生成封装函数
 */
function code($array=array(),$num=0)
{
    $config=array(
        'fontSize'=>'16',
        'imageW'=>'120',
        'imageH'=>'30',
        'length'=>4,
        'useCurve'=>0
        
    );

    $set_array=$config+$array;
    $Verify = new \Think\Verify($set_array);
    //多个验证码
    if($num>=1)
    {
        for ($i=1;$i<=$num;$i++)
        {
            $Verify->entry($i);
        }
    }else
    {
        $Verify->entry();
    }


}

/**
 * @param $code
 * @param string $id
 * @return bool
 * 封装验证码检验
 */
function check_code($code, $id = '')
{
    $verify = new \Think\Verify();
    return $verify->check($code, $id);
}

/**
 * @param $count
 * @param $map
 * @param int $pagesize
 * @return string
 * 分页封装
 */
function page($count,$map,$pagesize=20,$url=''){

    $Page       = new \Think\Page($count,$pagesize);// 实例化分页类 传入总记录数和每页显示的记录数
    if($url)
    {
        $Page->diy_url($url);
    }

    //分页跳转的时候保证查询条件
    foreach($map as $key=>$val) {
        $Page->parameter[$key]   =   urlencode($val);
    }
    $Page->setConfig('header', '共&nbsp;&nbsp;<b>%TOTAL_ROW%</b>&nbsp;&nbsp;条记录&nbsp;&nbsp;每页<b>%ROWS%</b>条&nbsp;&nbsp; <b>%NOW_PAGE%/%TOTAL_PAGE%</b>页&nbsp;&nbsp;');
    $Page->setConfig('prev', '<span class="icon icon-backward"></span>');
    $Page->setConfig('next', '<span class="icon icon-forward"></span>');
    $Page->setConfig('last', '<span class="icon icon-step-forward"></span>');
    $Page->setConfig('first', '<span class="icon icon-step-backward"></span>');
    $Page->setConfig('theme', '%HEADER%%FIRST%%UP_PAGE%%LINK_PAGE%%DOWN_PAGE%%END%%SELECT%');
    $Page->lastSuffix = false;//最后一页不显示为总页数
    return  $Page->show();// 分页显示输出
}

/**
 * @return string
 * 创建唯一UUID
 */
function create_uuid(){
    return md5(uniqid(rand(),true).rand(1,time()));
}

/**
 * @return string
 * token防表单攻击
 */
function token(){
    $token=md5(uniqid(time()));
    session('kq_token',$token);
    return $token;
}

/**
 * @param $token
 * @return bool
 * 验证token
 */
function check_token($token){
    if($token== session('kq_token'))
    {
        session('kq_token',null);
        return true;
    }
    return false;
}

function check_token_ajax($token){
    if($token== session('kq_token'))
    {
        
        return true;
    }
    return false;
}

/**
 * @param $arr
 * @param string $type
 * @return bool|string
 * 数组转字符串
 *
 */
function to_str($arr,$type=","){
   if($arr){
       $newarr=implode($type,$arr);
       if(!$newarr) return false;
       return  $newarr;
   }
    return false;
}

/**
 * @param $str
 * @param string $type
 * @return array|bool
 * 字符串装换为数组
 */
function to_arr($str,$type=","){
    if($str){
        $newstr=explode($type,$str);
        if(!$newstr) return false;
        return  $newstr;
    }
    return false;
}

/**
 * @return string
 * 生产UNIQID
 */
function create_uniqid(){
    return sha1(uniqid());
}

/**
 * @param $str
 * @param $id
 * @return bool|string
 * 判断某个字符，是否在这个字符串中
 */
function checked_on($str,$id){
    $arr=to_arr($str);
    if($arr)
    {
        return in_array($id,$arr);

    }
    return '';
}

/**
 * @param $str
 * @param $arr
 * 字符串输出列表
 */
function echo_list_str($str,$arr){
    $yarr=to_arr($str);
    if($yarr)
    {
        foreach ($yarr as $v)
        {
            echo "<span style='margin:0 5px;'>".$arr[$v]."</span>";
        }
    }
}




/**
 * @param $dirName
 * 删除文件和目录
 */
function del_dir( $dirName )
{
    if ( $handle = opendir( "$dirName" ) ) {
        while ( false !== ( $item = readdir( $handle ) ) ) {
            if ( $item != "." && $item != ".." ) {
                if ( is_dir( "$dirName/$item" ) ) {
                    del_dir( "$dirName/$item" );
                } else {
                    if( unlink( "$dirName/$item" ) )echo "成功清除缓存文件： $dirName/$item<br />\n";
                }
            }
        }
        closedir( $handle );
        if( rmdir( $dirName ) )echo "成功缓存目录： $dirName<br />\n";
    }
};
/**
 * @param $str
 * @param string $size
 * @param string $type
 * @return string
 * 图片地址
 */
function pic_url($str,$size='',$type='images'){
    $size=$size==''?'':$size."/";
    $dir=C('UPLOAD_URL')."/".$type."/".$size;
    return $dir.$str;

}

/**
 * [get_tree_child 查找某一分类的所有子类]
 * @param  [type] $data [description]
 * @param  [type] $fid  [description]
 * @return [type]       [description]
 */
function get_tree_child($data, $fid) {
    $result = array();
    $fids = array($fid);
    do {
        $cids = array();
        $flag = false;
        foreach($fids as $fid) {
            for($i = count($data) - 1; $i >=0 ; $i--) {
                $node = $data[$i];
                if($node['fid'] == $fid) {
                    array_splice($data, $i , 1);
                    $result[] = $node['id'];
                    $cids[] = $node['id'];
                    $flag = true;
                }
            }
        }
        $fids = $cids;
    } while($flag === true);
    return $result;
}
/**
 * [get_tree_parent 查找某一分类的所有父类]
 * $children = get_tree_child($list, 0);
 *implode(',', $children);    // 输出：1,3,2,7,6,5,8,4
 * @param  [type] $data [description]
 * @param  [type] $id   [description]
 * @return [type]       [description]
 */
function get_tree_parent($data, $id) {
    $nid=$id;
    $result = array();
    $obj = array();
    foreach($data as $node) {
        $obj[$node['id']] = $node;
    }

    $value = isset($obj[$id]) ? $obj[$id] : null;
    while($value) {
        $id = null;
        foreach($data as $node) {
            if($node['id'] == $value['fid']) {
                $id = $node['id'];
                $result[] = $node['id'];
                break;
            }
        }
        if($id === null) {
            //$result[] = $value['fid'];
        }
        $value = isset($obj[$id]) ? $obj[$id] : null;
    }
    $result[]=$nid;
    unset($obj);
    return $result;
}
/**
 * [get_tree_ul UL输出树形]
 * @param  [type] $data [description]
 * @param  [type] $fid  [description]
 * @return [type]       [description]
 */
function get_tree_ul($data, $fid) {
    $stack = array($fid);
    $child = array();
    $added_left = array();
    $added_right= array();
    $html_left     = array();
    $html_right    = array();
    $obj = array();
    $loop = 0;
    foreach($data as $node) {
        $pid = $node['fid'];
        if(!isset($child[$pid])) {
            $child[$pid] = array();
        }
        array_push($child[$pid], $node['id']);
        $obj[$node['id']] = $node;
    }

    while (count($stack) > 0) {
        $id = $stack[0];
        $flag = false;
        $node = isset($obj[$id]) ? $obj[$id] : null;
        if (isset($child[$id])) {
            $cids = $child[$id];
            $length = count($cids);
            for($i = $length - 1; $i >= 0; $i--) {
                array_unshift($stack, $cids[$i]);
            }
            $obj[$cids[$length - 1]]['isLastChild'] = true;
            $obj[$cids[0]]['isFirstChild'] = true;
            $flag = true;
        }
        if ($id != $fid && $node && !isset($added_left[$id])) {
            if(isset($node['isFirstChild']) && isset($node['isLastChild']))  {
                $html_left[] = '<li class="first-child last-child">';
            } else if(isset($node['isFirstChild'])) {
                $html_left[] = '<li class="first-child">';
            } else if(isset($node['isLastChild'])) {
                $html_left[] = '<li class="last-child">';
            } else {
                $html_left[] = '<li>';
            }
            $html_left[] = ($flag === true) ? "<div>{$node['title']}</div><ul>" : "<div>{$node['title']}</div>";
            $added_left[$id] = true;
        }
        if ($id != $fid && $node && !isset($added_right[$id])) {
            $html_right[] = ($flag === true) ? '</ul></li>' : '</li>';
            $added_right[$id] = true;
        }

        if ($flag == false) {
            if($node) {
                $cids = $child[$node['fid']];
                for ($i = count($cids) - 1; $i >= 0; $i--) {
                    if ($cids[$i] == $id) {
                        array_splice($child[$node['fid']], $i, 1);
                        break;
                    }
                }
                if(count($child[$node['fid']]) == 0) {
                    $child[$node['fid']] = null;
                }
            }
            array_push($html_left, array_pop($html_right));
            array_shift($stack);
        }
        $loop++;
        if($loop > 5000) return $html_left;
    }
    unset($child);
    unset($obj);
    return implode('', $html_left);
}
//树形分类输出全部
function get_tree_option($data, $fid) {
    $stack = array($fid);
    $child = array();
    $added = array();
    $options = array();
    $obj = array();
    $loop = 0;
    $depth = -1;
    foreach($data as $node) {
        $pid = $node['fid'];
        if(!isset($child[$pid])) {
            $child[$pid] = array();
        }
        array_push($child[$pid], $node['id']);
        $obj[$node['id']] = $node;
    }

    while (count($stack) > 0) {
        $id = $stack[0];
        $flag = false;
        $node = isset($obj[$id]) ? $obj[$id] : null;
        if (isset($child[$id])) {
            for($i = count($child[$id]) - 1; $i >= 0; $i--) {
                array_unshift($stack, $child[$id][$i]);
            }
            $flag = true;
        }
        if ($id != $fid && $node && !isset($added[$id])) {
            $node['depth'] = $depth;
            $options[] = $node;
            $added[$id] = true;
        }
        if($flag == true){
            $depth++;
        } else {
            if($node) {
                for ($i = count($child[$node['fid']]) - 1; $i >= 0; $i--) {
                    if ($child[$node['fid']][$i] == $id) {
                        array_splice($child[$node['fid']], $i, 1);
                        break;
                    }
                }
                if(count($child[$node['fid']]) == 0) {
                    $child[$node['fid']] = null;
                    $depth--;
                }
            }
            array_shift($stack);
        }
        $loop++;
        if($loop > 5000) return $options;
    }
    unset($child);
    unset($obj);
    return $options;
}

function get_nav($id,$type=1){
    $lanmu=M('LanMu')->where(array('checked'=>1))->order('sort desc, id desc')->select();
    $lanmu=get_tree_parent($lanmu,$id);
    //print_r($lanmu);
    $map['id']  = array('in',$lanmu);
    $map['checked']=1;
    $nlanmu=M('LanMu')->where($map)->order('id asc')->select();
    $nav_str='';

    if(count($nlanmu)>0)
    {
        foreach ($nlanmu as $k=>$v)
        {
            $url=U('/project/'.$v['ename']);
            $span='<span>&lt;</span>';
            if($v['fid']==0)
            {
                $url=U('/project');
            }
            if($k==count($lanmu)-1)
            {
               
                $url='';
                $span='';
            }

            $nav_str.='
                <li>
                    <a href="'.$url.'">'.$v['name'].$span.'</a>
                </li>
            ';
        }
    }
    switch ($type)
    {
        case '1':
            return '
            <ul>
                <li>
                    <a href="/">
                     首页
                    <span>&lt;</span>
                    </a>
                </li>
                   '.$nav_str.'
               </ul>
                ';
            break;
    }


}
/**
 * json转数组转义化
 * @param $json
 * @param $name
 * @param string $trag
 * @return mixed
 */
function json_get_value($json,$name,$trag='1'){
    if($trag)
    {
        $arr=json_decode((htmlspecialchars_decode($json)),true);
        if($arr)
        {
            return $arr[$name];
        }
    }
    
}
//转义
function to_html($data){
       foreach ($data as $key=>$value)
       {
            if(is_array($value)){
               to_html($value);
            }else{
                   
                $data[$key]=htmlspecialchars_decode($value);
            }
            
                 
       }
    return $data;
}
/**
 * json转数组
 * @param $json
 * @return mixed
 */
function json_to_arr($json){
    if($json)
    {
        $data=json_decode($json,true);
        if($data)
        {
            return $data;
        }
    }
}
function is_mobile($phonenumber){
    if(preg_match("/^1[1|3|4|6|7|8|9|5]{1}[0-9]{9}$/",$phonenumber)){  
        return true ;
    }else{  
        return false;
    }  
}
/**
 * @param $str
 * 选中状态，控制器判断
 */

function left_menu_on($str,$two=''){


        if(CONTROLLER_NAME==$str)
        {
            echo "class='on'";
        }
    

}
/**
 * 取得配置信息
 * @param $id
 * @param string $filed
 * @return mixed|string
 */
function get_seting($id,$filed=''){
    $map=array(
        'id'=>$id
        );
    $model=M('Seting')->where($map)->find();
    if($model)
    {
        if($filed)
        {
            return htmlspecialchars_decode($model[$filed]);
        }else
        {
            return to_html($model);
        }
    }

}
function get_seting_thumbs($id,$filed='',$index='all')
{
    $map=array(
        'id'=>$id
    );
    $model=M('Seting')->where($map)->find();
    if($model)
    {
        if($filed)
        {
            $pic=htmlspecialchars_decode($model[$filed]);
            $pic=json_to_arr($pic);
            if($index=='all')
            {
                //return $pic;
            }else
            {
                return $pic[$index-1]['path'];
            }
        }else
        {
            return to_html($model);
        }
    }
}
//扩展分类
function get_extends($fid,$limit=''){
    if($limit)
    {
        $xiaoguo=M('LanMuExtends')->where(array('fid'=>$fid))->limit($limit)->select();
    }else
    {
        $xiaoguo=M('LanMuExtends')->where(array('fid'=>$fid))->select();
    }

    if($xiaoguo)
    {
        return $xiaoguo;
    }
}
/**
 * 取得JSON的THUMBS，返回数组
 * @param $json
 * @return bool|mixed|string
 */
function get_thumbs($json){
    $json=htmlspecialchars_decode($json);
    $json=json_decode($json,true);
    if($json)
    {
        return $json;
    }
    return false;
}
function get_link(){
    $map3=array(
        'checked'=>1,
    );
    $link=M('Link')->where($map3)->select();
    return $link;
}
/**
 * 配置信息的图片得第一张图片
 * @param $id
 * @param string $ok
 * @return bool|mixed|string
 */
function get_frist_pic($id,$ok=''){
    $path=get_seting($id,'content');
    if($path)
    {
        $path=get_thumbs($path);
        if($path)
        {
            if($ok)
            {
                return $path[0]['path'];
            }
            return $path;
        }
    }
}
//取得扩展分类
function get_index_nav($id='26'){
    $xiaoguo=M('LanMuExtends')->where(array('fid'=>$id))->select();
    return ($xiaoguo);
}
//
function get_lanmu($map=array()){
    $where=array(
        'checked'=>'1'
        );
    if($map!='')
    {
        $where=$map+$where;   
       
    }
     $lanmu=M('LanMu')->where($where)->order('sort desc,id desc')->select();
    return $lanmu;
}

//查出FID的
function get_fid($id){

    $sql=M('LanMu')->find($id);

    if($sql['fid']==0){

        return $sql['id'];
    }else{
        return get_fid($sql['fid']);
    }



}
//找出所以子类
function get_sub_class($id,&$array=array()){

    $array=$array;
    $sql=M('LanMu')->where(array('fid'=>$id))->select();
    if($sql)
    {
        foreach ($sql as $v)
        {
            get_sub_class( $v['id'],$array);
        }

    }else
    {
        $array[]=$id;
    }
    return $array;

}
function get_lanmu_msg($id){
    $model=M('LanMu')->find($id);
    return $model;
}
function get_filed_msg($table,$map,$filed){
    $model=M($table)->where($map)->find();
    if($filed){
        return $model[$filed];
    }
     return $model;
}
//计算等级的更新
function level($filed='',$type=''){
    $zhe=array();
    $map=array();
    $map['source']='sale';

    $order_total=M('Order')->where(array('user_id'=>auth('id'),'client_pay_send'=>1,'status'=>1,'order_status'=>1,'pay_send'=>1))->sum('total');

    //查询顶级
    $fined=M('Level')->where($map)->max('max_num');
    $maxmap=array();
    $maxmap['source']='sale';
    $maxmap['max_num']=$fined;
    $fined_level=M('Level')->where($maxmap)->find();
    //最大等级


    if($order_total>=$fined)
    {

        $zhe=array(
            'level'=>$fined_level['level'],
            'discount'=>$fined_level['discount'],
            'name'=>$fined_level['name'],
            'type'=>$fined_level['type'],
            'user_total'=>$order_total
        );
    }else
    {
        if(count($order_total)>0)
        {
            $xmap=array();
            $xmap['source']='sale';
            $xmap['max_num']=array('gt',$order_total);
            $xmap['min_num']=array('elt',$order_total);

            $pay_total=M('Level')->where($xmap)->find();
           
            if(count($pay_total)>0){
               
                $zhe=array(
                'level'=>$pay_total['level'],
                'discount'=>$pay_total['discount'],
                'type'=>$pay_total['type'],
                'name'=>$pay_total['name'],
                'user_total'=>$order_total
            );
            }
            
        }

    }
    if(count($zhe))
    {
        if($filed!='')
        {
            return $zhe[$fined];
        }else
        {
            return $zhe;
        }

    }
    if($type)
    {
        return $order_total;
    }
    return false;

}

function browser(){
    if(strpos($_SERVER["HTTP_USER_AGENT"],"MSIE 8.0"))
        return "ie8x";
    else if(strpos($_SERVER["HTTP_USER_AGENT"],"MSIE 7.0"))
        return "ie8x";
    else if(strpos($_SERVER["HTTP_USER_AGENT"],"MSIE 6.0"))
        return "ie8x";
    else if(strpos($_SERVER["HTTP_USER_AGENT"],"Firefox"))
        return "Fx";

    else if(strpos($_SERVER["HTTP_USER_AGENT"],"Chrome"))
        return "wk";
    else if(strpos($_SERVER["HTTP_USER_AGENT"],"Safari"))
        return "sf";
    else if(strpos($_SERVER["HTTP_USER_AGENT"],"Opera"))
        return "Op";
   return false;
}
function nav($type){
     $model=M('Nav');
     $data=$model->where(array('type'=>$type,'checked'=>1))->order('sort desc,id asc')->select();
     return $data;
}
function to_url($url,$aburl=''){
   
    if($url=="#" or $url=='')
    {
        $url='';
    }else
    {
        $url=str_replace("http://","",$url);
        $url=$url=='/'?"":"".$url;
        

        $url="http://".$_SERVER['HTTP_HOST'].$url;

    }
    if($aburl)
    {
        $url=$aburl;
    }
    return $url;
}

function isMobile()
{ 
    // 如果有HTTP_X_WAP_PROFILE则一定是移动设备
    if (isset ($_SERVER['HTTP_X_WAP_PROFILE']))
    {
        return true;
    } 
    // 如果via信息含有wap则一定是移动设备,部分服务商会屏蔽该信息
    if (isset ($_SERVER['HTTP_VIA']))
    { 
        // 找不到为flase,否则为true
        return stristr($_SERVER['HTTP_VIA'], "wap") ? true : false;
    } 
    // 脑残法，判断手机发送的客户端标志,兼容性有待提高
    if (isset ($_SERVER['HTTP_USER_AGENT']))
    {
        $clientkeywords = array ('nokia',
            'sony',
            'ericsson',
            'mot',
            'samsung',
            'htc',
            'sgh',
            'lg',
            'sharp',
            'sie-',
            'philips',
            'panasonic',
            'alcatel',
            'lenovo',
            'iphone',
            'ipod',
            'blackberry',
            'meizu',
            'android',
            'netfront',
            'symbian',
            'ucweb',
            'windowsce',
            'palm',
            'operamini',
            'operamobi',
            'openwave',
            'nexusone',
            'cldc',
            'midp',
            'wap',
            'mobile'
            ); 
        // 从HTTP_USER_AGENT中查找手机浏览器的关键字
        if (preg_match("/(" . implode('|', $clientkeywords) . ")/i", strtolower($_SERVER['HTTP_USER_AGENT'])))
        {
            return true;
        } 
    } 
    // 协议法，因为有可能不准确，放到最后判断
    if (isset ($_SERVER['HTTP_ACCEPT']))
    { 
        // 如果只支持wml并且不支持html那一定是移动设备
        // 如果支持wml和html但是wml在html之前则是移动设备
        if ((strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') !== false) && (strpos($_SERVER['HTTP_ACCEPT'], 'text/html') === false || (strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') < strpos($_SERVER['HTTP_ACCEPT'], 'text/html'))))
        {
            return true;
        } 
    } 
    return false;
}
function get_op($str){
    $id=json_get_value(site_config('openconfig'),$str);
    return $id;
} 
