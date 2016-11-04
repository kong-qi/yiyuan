<?php
namespace Admin\Controller;
class QianTaiJieZhenController extends AuthController {

    protected $onname='前台咨询接诊';
    protected $rule_qz='qiantaijz';
    
    public function index2(){
        //权限选择
        $this->check_group('qiantaijz_add');
        $model=M('LanMu');
        $map=array(
            'jg.fid'=>array('in',jigou_id()),
            'jg.is_jigou'=>1,
            'jg.type'=>'bingren'
        );
        $filed = '
            jg.uuid as uuid,jg.id as id,
            jg.hetong as hetong,jg.code as code,jg.name as name,jg.funame as funame,jg.futel as futel,jg.checked as checked,jg.buname as buname,
            lb.name as lbname,
            pj.name as pjname,
            ae.name as area_name,
            ae2.name as area2_name,
            zt.name as status_name
            
            
        ';
        //关联评级
        $join[] = 'LEFT JOIN __LAN_MU__ pj ON jg.pj_id = pj.id';
        $join[] = 'LEFT JOIN __LAN_MU__ zt ON jg.join_id = zt.id';
        $join[] = 'LEFT JOIN __AREA__ ae ON jg.area_id = ae.id';
        $join[] = 'LEFT JOIN __AREA__ ae2 ON jg.areat_id = ae2.id';
        $join[] = 'LEFT JOIN __LAN_MU__ lb ON jg.fid = lb.id';

        $count =  $model->alias('jg')->join($join)->where($map)->count();// 查询满足要求的总记录数
        $page=1;
        if(isset($_GET['p']))
        {
            $page=$_GET['p'];
        }

        $pagesize=(C('PAGESIZE'))!=''?C('PAGESIZE'):'50';

        $list = $model->alias('jg')->field($filed)->join($join)->order('jg.id desc')->where($map)->page( $page.','.$pagesize)->select();

        $this->assign('list',$list);// 赋值数据集


        $menu_list= array(
            '编号',
            '预约号',
            '姓名',
            '性别',
            '预约时间',
            '登记时间',
            '预约科室',
            '预约病种',
            '预约来源',
            '预约状态',
            '操作'
        );
        $this->menu_list=$menu_list;
        $this->assign('page',page( $count ,$map,$pagesize));// 赋值分页输出

        $this->display();

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
            y1.qz_id as qz_id,
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
        $type_arr='defalut';
        if(I('list_type')!='')
        {

            $menu_list = $this->getFiledArray('has');
            //print_r($menu_list);
        }else
        {
            $menu_list = $this->getFiledArray($type_arr);
        }
        
        $this->menu_list = $menu_list;
        $this->assign('page', page($count, $map, $pagesize));// 赋值分页输出
        $this->display("YuYue:qiantai:index");
        
        
    }
    public function getFiledArray($type){
        switch ($type) {
            case 'has':
                   $menu_list = array(
                        'td-1' => array('name' => lang('预约号'), 'filed'=>'ynumber','diy'=>'text-blue','is_time'=>'','fun'=>'','w' => '', 'h' => '', 'is_hide' => '1'),
                        'td-2' => array('name' => lang('姓名'), 'filed'=>'user_name','diy'=>'text-blue','is_time'=>'','fun'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                        'td-3' => array('name' => lang('性别'), 'filed'=>'sex','diy'=>'', 'is_time'=>'','fun'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                        'td-4' => array('name' => lang('年龄'), 'filed'=>'age','diy'=>'', 'is_time'=>'','fun'=>'','w' => '', 'h' => '', 'is_hide' =>''), 
                        'td-5' => array('name' => lang('生日'), 'filed'=>'birthday','diy'=>'', 'is_time'=>'','w' => '', 'h' => '', 'is_hide' => '1'),
                        'td-6' => array('name' => lang('职业'), 'filed'=>'zhiye','diy'=>'', 'is_time'=>'','w' => '', 'h' => '', 'is_hide' => '1'),
                        'td-7' => array('name' => lang('婚姻'), 'filed'=>'jiehun','diy'=>'', 'is_time'=>'','w' => '', 'h' => '', 'is_hide' => '1'),

                        'td-10' => array('name' => lang('具体病种'), 'filed'=>'bz_name','diy'=>'', 'is_time'=>'','fun'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                        'td-17' => array('name' => lang('预约状态'), 'filed'=>'ystatus','diy'=>'', 'is_time'=>'','fun'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                        'td-8' => array('name' => lang('预约时间'), 'filed'=>'yctime','diy'=>'text-info', 'is_time'=>'1','fun'=>'','w' => '', 'h' => '', 'is_hide' => '1'),
                        
                        'td-9' => array('name' => lang('预到时间'), 'filed'=>'ydatetime','diy'=>'text-blue', 'is_time'=>'1','fun'=>'','w' => '', 'h' => '', 'is_hide' => '1'),
                        'td-8' => array('name' => lang('预约时间'), 'filed'=>'yctime','diy'=>'text-info', 'is_time'=>'1','fun'=>'','w' => '', 'h' => '', 'is_hide' => '1'),
                        'td-18' => array('name' => lang('到院时间'), 'filed'=>'dztime','diy'=>'text-blue', 'is_time'=>'1','fun'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                        'td-19' => array('name' => lang('分诊人'), 'filed'=>'fzname','diy'=>'', 'is_time'=>'','fun'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                        'td-20' => array('name' => lang('接诊医生'), 'filed'=>'ys_name','diy'=>'', 'is_time'=>'','fun'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                        'td-11' => array('name' => lang('地区'), 'filed'=>'ae2_name','diy'=>'', 'is_time'=>'','fun'=>'','w' => '', 'h' => '', 'is_hide' => '1'),
                        'td-12' => array('name' => lang('来源'), 'filed'=>'ly_name','diy'=>'', 'is_time'=>'','fun'=>'','w' => '', 'h' => '', 'is_hide' => '1'),
                        'td-13' => array('name' => lang('网站来源'), 'filed'=>'web_name','diy'=>'', 'is_time'=>'','fun'=>'','w' => '', 'h' => '', 'is_hide' => '1'),
                        'td-14' => array('name' => lang('来源类别'), 'filed'=>'leibie','diy'=>'', 'is_time'=>'','fun'=>'','w' => '', 'h' => '', 'is_hide' => '1'),
                        'td-15' => array('name' => lang('咨询方式'), 'filed'=>'zx_name','diy'=>'', 'is_time'=>'','fun'=>'','w' => '', 'h' => '', 'is_hide' => '1'),
                        'td-16' => array('name' => lang('咨询员'), 'filed'=>'admin_name','diy'=>'', 'is_time'=>'','fun'=>'','w' => '', 'h' => '', 'is_hide' => '1'),
                       
                       
                        

                    );
                break;
            case 'zixun':
                    $menu_list = array(

                       
                        'td-1' => array('name' => lang('姓名'), 'filed'=>'user_name','diy'=>'text-blue','is_time'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                        'td-2' => array('name' => lang('性别'), 'filed'=>'sex','diy'=>'', 'is_time'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                        'td-3' => array('name' => lang('年龄'), 'filed'=>'age','diy'=>'', 'is_time'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                        'td-4' => array('name' => lang('生日'), 'filed'=>'birthday','diy'=>'', 'is_time'=>'','w' => '', 'h' => '', 'is_hide' => '1'),
                        'td-5' => array('name' => lang('职业'), 'filed'=>'zhiye','diy'=>'', 'is_time'=>'','w' => '', 'h' => '', 'is_hide' => '1'),
                        'td-6' => array('name' => lang('婚姻'), 'filed'=>'jiehun','diy'=>'', 'is_time'=>'','w' => '', 'h' => '', 'is_hide' => '1'),
                        'td-7' => array('name' => lang('身份证'), 'filed'=>'card','diy'=>'', 'is_time'=>'','w' => '', 'h' => '', 'is_hide' => '1'),
                        'td-8' => array('name' => lang('会员级别'), 'filed'=>'level','diy'=>'', 'is_time'=>'','w' => '', 'h' => '', 'is_hide' => '1'),
                        'td-9' => array('name' => lang('手机品牌'), 'filed'=>'pbank','diy'=>'', 'is_time'=>'','w' => '', 'h' => '', 'is_hide' => '1'),
                        'td-10' => array('name' => lang('咨询方式'), 'filed'=>'zx_name','diy'=>'', 'is_time'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                        'td-11' => array('name' => lang('来源'), 'filed'=>'ly_name','diy'=>'', 'is_time'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                        'td-12' => array('name' => lang('地区'), 'filed'=>'ae2_name','diy'=>'', 'is_time'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                        'td-13' => array('name' => lang('网站来源'), 'filed'=>'web_name','diy'=>'', 'is_time'=>'','w' => '', 'h' => '', 'is_hide' => '1'),
                        'td-14' => array('name' => lang('咨询小结'), 'filed'=>'zx_mark','diy'=>'', 'is_time'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                        'td-15' => array('name' => lang('咨询员'), 'filed'=>'admin_name','diy'=>'', 'is_time'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                        'td-16' => array('name' => lang('咨询时间'), 'filed'=>'yctime','diy'=>'', 'is_time'=>'1','w' => '', 'h' => '', 'is_hide' => ''),
                        

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
                    'td-17' => array('name' => lang('预约状态'), 'filed'=>'ystatus','diy'=>'', 'is_time'=>'','fun'=>'','w' => '', 'h' => '', 'is_hide' => ''),

                );
                break;
        }
        return $menu_list;
    }
    public function getList()
    {
        $rule = M('KeShi')->where(array('checked' => 1, 'type' => 'keshi', 'fid' => 0))->select();
        return $rule;

    }
    public function add()
    {

        //权限选择
        $this->check_group($this->rule_qz."_add");
        $backurl=U('Admin/QianTaiJieZhen/add');

        if (IS_POST) {

            $model = D("YuYue");
            $user=D('User');
            $zixun=D('ZiXun');
            $data=$model->create();
            $udata=$user->create();

            $zdata=$zixun->create();
            //清空的为空的值
            foreach ($data as $ak => $av) {
                if ($av == '') {
                    unset($data[$ak]);
                }

            }
            foreach ($udata as $ak => $av) {
                if ($av == '') {
                    unset($udata[$ak]);
                }

            }
            foreach ($zdata as $ak => $av) {
                if ($av == '') {
                    unset($zdata[$ak]);
                }

            }

            $postdata = I('post.');
            if ($model->create()) {
                M()->startTrans();
                
                //先取得用户是否存在
                
                //判断病人库是否存在
                $has_user_id = $postdata['user_id'];
                //如果前端被忽略，后端查询病返回,并且检查是否存在
                if ($has_user_id == '') {
                    $muser = M('User')->where(array('tel' => $udata['tel']))->find();
                    if (count($muser) > 0) {
                        $has_user_id = $muser['id'];
                    }
                } else {
                    $muser = M('User')->find($has_user_id);
                    if (count($muser) < 0) {
                        $has_user_id = '';
                    }else
                    {
                        $has_user_id = $muser['id'];
                    }
                }


                //判断是否有预约
                if($data['ydate']!='')
                {
                    //预约好前缀获取
                    $yy_qz = M('LanMu')->where(array('type' => 'bingren', 'id' => $data['ly_id']))->find();
                    //取得预约号
                    $data['ynumber'] = $yy_qz['card'] . create_ynumber();
                    //拼接预约时间
                    
                    //判断长度
                    if(strlen($data['ytime'])<=5)
                    {
                        $data['ytime'] = $data['ytime'] . ":00";
                    }
                    $data['ydatetime'] = $data['ydate'] . ' ' . $data['ytime'];
                    $data['ydatetime'] = strtotime($data['ydatetime']); 
                    $data['status'] = '2';//已经预约状态
                    
                   
                    //用户存在时，更新操作，预约添加操作
                    if ($has_user_id != ''){
                        $data['user_id']=$udata['id']=$has_user_id;
                        //取消更新admin_id
                        
                        $result = $model->add($data);
                        $uresult=$user->save($udata);
                        if($result && $uresult)
                        {
                            M()->commit();
                            add_log($this->onname . '：' . $data['name'] . '添加成功');
                            $msg = lang('添加成功', 'handle');
                            return $this->success($msg, $backurl);
                        }else
                        {
                            M()->rollback();
                            add_log($this->onname . '：' . $data['name'] . '添加失败');
                            $msg = lang('添加失败', 'handle');
                            return $this->success($msg);
                        }
                    }else
                    {
                        //用户不存在时
                        //用户添加，返回user_id
                        $uresult=$user->add($udata);
                        $data['user_id'] =$uresult;
                        $result = $model->add($data);
                        if ($result && $uresult) {
                            M()->commit();
                            add_log($this->onname . '：' . $data['name'] . '添加成功');
                            $msg = lang('添加成功', 'handle');
                            return $this->success($msg, $backurl);
                            //echo "<script language='javascript'>var index = parent.layer.getFrameIndex(window.name); parent.layer.msg('".$msg."');</script>";


                        } else {
                            M()->rollback();
                            add_log($this->onname . '：' . $data['name'] . '添加失败', $backurl);
                            $msg = lang('添加失败', 'handle');
                            return $this->success($msg);
                        }
                    }
                }


            }else {

                $this->error($model->getError());
            }
        } else {
            //显示添加页面
            $rule = get_tree_option($this->getList(), 0);
            $this->assign('rule', $rule);// 赋值数据集

           
            return $this->display("YuYue:qiantai:qiantai");
            

        }

    }
    public function ysedit(){
        //权限选择
        $this->check_group('qiantaijz_edit');
        //网站更新信息
        $this->onname='分配医生';

        if(IS_POST)
        {
            $model =D('YuYue');
            $postdata=I('post.');
            if($model->create()) {
                $data=$model->create();
                $udata=M('User')->create();
                unset($udata['id']);
                $udata['id']=$data['user_id'];

                $data['status']=2;
                M('User')->save($udata);
               
                $result =   $model->save($data);

                if($result) {
                    add_log($this->onname.'：'.$data['name'].'更新成功');
                    $msg=lang('更新成功','handle');
                  
                    echo "<script language='javascript'>var index = parent.layer.getFrameIndex(window.name); parent.layer.msg('".$msg."'); parent.window.location.reload();</script>";

                    //return  $this->success($msg);
                }else{
                    $msg=lang('数据一样无更新','handle');
                    //return  $this->success(lang('无更新','handle'));

                    echo "<script language='javascript'>var index = parent.layer.getFrameIndex(window.name); parent.layer.msg('".$msg."'); parent.layer.close(index)</script>";

                }
            }else{
                return $this->error($model->getError());
            }
        }else{
            $id=I('get.uuid');
           
            //自己查看自己的

            $map=array(
                'uuid'=>$id
            );

            $model   = D('YuYue')->relation(true)->where($map)->find();

            if($model) {
                $this->data =  $model;// 模板变量赋值
            }else{
                return $this->error(lang('数据错误','handle'));
            }

                return $this->display('YuYue:qiantai:edit');


        }
    }
   
    public  function del(){
        //权限选择
        $this->check_group('qiantaijz_del');
        $id=I('get.id');
        $map=array(
                'uuid'=>$id
            );
        $model   =  D(CONTROLLER_NAME);
        $data=$model->where($map)->find();
        $result=$model->where($map)->delete();
        if($result)
        {
            add_log($this->onname.'：'.$data['name'].'删除成功');
            $msg=lang('删除成功');
            return  $this->success($msg);
        }
        add_log($this->onname.'：'.$data['name'].'删除失败');
        $msg=lang('删除成功');
        return $this->error($msg);
    }
    public function handle($id){
        //权限选择
        $this->check_group('group_edit');
        $model =M(CONTROLLER_NAME);
        $type=I('get.type');
        if($type=='true')
        {
            $status=1;
        }else
        {
            $status=0;
        }
        $data['id'] =$id;
        $data['checked'] = $status;


        if($model->save($data)){
            return  $this->success(lang('更新成功','handle'));
        }else
        {
            return $this->error(lang('更新失败','handle'));
        }
    }
}