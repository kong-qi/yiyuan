<?php
namespace Admin\Controller;
class YuYueController extends AuthController
{
    protected $onname = '添加预约';
    protected $rule_qz = 'yuyue';


    public function index($shenfeng = 'zixun')
    {

        //print_r(session('group'));
        $this->check_group($this->rule_qz."_show");
        $map = array();
        $is_website = 0;
        $is_huifang = 0;
        $is_yishen = 0;
        $is_qiantai = 0;
        //是否搜索
     
      
        //自己查看自己的
        if (!check_group('root')) {
            if (check_group('yuyue_only')) {
                $map['y1.admin_id'] = session('admin_id');
            }

            switch ($shenfeng) {
                case 'zixun':

                    break;
                //网站竞价来源
                case 'website':
                    $is_website = 1;

                    $map['y1.ly_id'] = array('in', session('brid'));
                    break;
                //回访人员
                case 'huifang':
                    $is_huifang = 1;


                    break;
                case 'qiantai':

                    $is_qiantai = 1;

                    break;
                case 'yishen':
                    $is_yishen = 1;
                    if(!check_group('root'))
                    {
                        if(check_group('kaidan_only'))
                        {
                            $map['y1.ys_id'] = session('admin_id');
                        }
                    }
                    
                    
                    break;
                case 'all':


                default:
                    # code...
                    break;
            }

        } else {
            switch ($shenfeng) {
                case 'zixun':
                    //$is_qiantai=1;
                    break;
                //网站竞价来源
                case 'website':
                    $is_website = 1;

                    break;
                //回访人员
                case 'huifang':
                    $is_huifang = 1;


                    break;
                case 'qiantai':

                    $is_qiantai = 1;

                    break;
                case 'yishen':
                    $is_yishen = 1;

                case 'all':


                default:
                    # code...
                    break;
            }
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
            //时间1476806399
            if ($getdata['djstime'] != '' && $getdata['djetime'] != '') {
                $getdata['djstime'] .= " 00:00:00";

                $getdata['djetime'] .= " 23:59:59";

                $timestr = strtotime($getdata['djstime']) . "," . strtotime($getdata['djetime']);

                $map['y1.ctime'] = array('between', $timestr);

            }
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

            u1.name as user_name,
            u1.age as age,
            u1.sex,
            u1.uuid as user_uuid,
            u1.id as user_id,

            
            a1.name as admin_name,
            k1.name as ks_name,
            k2.name as kst_name,
            k3.name as kstt_name,
            zx.name as zx_name,
            yx.name as yx_name,
            wz.name as web_name,
            ae1.name as ae_name,
            ae2.name as ae2_name,
            ys.realname as ys_name,

    
            jz.jz_smcontent as jz_smcontent,
            ssys.name as ysz_name
        ';
        //管理会员用户
        $join[] = '__USER__ u1 ON y1.user_id = u1.id';
        //关联ADMIN
        $join[] = 'LEFT JOIN __ADMIN__ a1 ON y1.admin_id = a1.id';
        $join[] = 'LEFT JOIN __ADMIN__ ys ON y1.ys_id = ys.id';
        //关科室1
        $join[] = 'LEFT JOIN __KE_SHI__ k1 ON y1.ks_id = k1.id';
        //关科室2
        $join[] = 'LEFT JOIN __KE_SHI__ k2 ON y1.kst_id = k2.id';
        //关科室3
        $join[] = 'LEFT JOIN __KE_SHI__ k3 ON y1.kstt_id = k3.id';
        //关咨询工具
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
       
      


        $count = $model->alias('y1')->join($join)->where($map)->count();// 查询满足要求的总记录数


        $pagesize = (C('PAGESIZE')) != '' ? C('PAGESIZE') : '50';


        $page = 1;
        if (isset($_GET['p'])) {
            $page = $_GET['p'];
        }

        $list = $model->alias('y1')->field($filed)->join($join)->order('y1.ydatetime desc,y1.id desc')->where($map)->page($page . ',' . $pagesize)->select();
        //print_r($list);
        $this->assign('list', $list);// 赋值数据集

        $type_arr='defalut';
        $staus=I('get.status');
        $tpl='';
        if($shenfeng=='yishen' && $staus==3)
        {
            $type_arr="yishen_s3";
            $tpl='yishen_s3';
        }
        $menu_list = $this->getFiledArray($type_arr);
        //print_r($menu_list);
        if ($is_qiantai) {
            $menu_list['td-ys_name'] = array('name' => lang('接诊医生'), 'w' => '', 'h' => '', 'is_hide' => '');
        }
        $this->menu_list = $menu_list;
        $show_rule = array(
            'is_website' => $is_website,
            'is_huifang' => $is_huifang,
            'is_qiantai' => $is_qiantai,
            'is_yishen' => $is_yishen

        );
        //print_r($show_rule);
        $this->assign($show_rule);
        $this->assign('page', page($count, $map, $pagesize));// 赋值分页输出

        if($tpl!='')
        {
             $this->display('YuYue:tpl:'.$tpl);
        }else
        {
            $this->display();
        }
        

    }
    public function demo(){
        $this->display();
    }
    public function getFiledArray($type){
        switch ($type) {
            case 'yishen_s3':
                    $menu_list = array(

                        'td-yuyue' => array('name' => lang('预约号'), 'w' => '', 'h' => '', 'is_hide' => ''),
                        'td-name' => array('name' => lang('姓名'), 'w' => '', 'h' => '', 'is_hide' => ''),
                        'td-sex' => array('name' => lang('性别'), 'w' => '', 'h' => '', 'is_hide' => ''),
                        'td-ytime' => array('name' => lang('年龄'), 'w' => '', 'h' => '', 'is_hide' => ''),
                        'td-djtime' => array('name' => lang('接诊时间'), 'w' => '', 'h' => '', 'is_hide' => ''),
                        'td-ks' => array('name' => lang('接诊小结'), 'w' => '', 'h' => '', 'is_hide' => ''),
                        'td-bz' => array('name' => lang('接诊医生'), 'w' => '', 'h' => '', 'is_hide' => ''),
                        'td-ly' => array('name' => lang('手术医生'), 'w' => '', 'h' => '', 'is_hide' => ''),
                       
                        'td-status' => array('name' => lang('预约状态'), 'w' => '', 'h' => '', 'is_hide' => ''),
                        'td-handle' => array('name' => lang('操作'), 'w' => '', 'h' => '', 'is_hide' => '')

                    );
                break;
            
            default:
                $menu_list = array(

                    'td-yuyue' => array('name' => lang('预约号'), 'w' => '', 'h' => '', 'is_hide' => ''),
                    'td-name' => array('name' => lang('姓名'), 'w' => '', 'h' => '', 'is_hide' => ''),
                    'td-sex' => array('name' => lang('性别'), 'w' => '', 'h' => '', 'is_hide' => ''),
                    'td-ytime' => array('name' => lang('预约时间'), 'w' => '', 'h' => '', 'is_hide' => ''),
                    'td-djtime' => array('name' => lang('登记时间'), 'w' => '', 'h' => '', 'is_hide' => ''),
                    'td-ks' => array('name' => lang('预约科室'), 'w' => '', 'h' => '', 'is_hide' => ''),
                    'td-bz' => array('name' => lang('预约病种'), 'w' => '', 'h' => '', 'is_hide' => ''),
                    'td-ly' => array('name' => lang('预约来源'), 'w' => '', 'h' => '', 'is_hide' => ''),
                   
                    'td-status' => array('name' => lang('预约状态'), 'w' => '', 'h' => '', 'is_hide' => ''),
                    'td-handle' => array('name' => lang('操作'), 'w' => '', 'h' => '', 'is_hide' => '')

                );
                break;
        }
        return $menu_list;
    }

    public function getDetail()
    {

    }

    public function add()
    {

        //权限选择
        $this->check_group($this->rule_qz);


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
                    $data['ytime'] = $data['ytime'] . ":00";
                    $data['ydatetime'] = $data['ydate'] . ' ' . $data['ytime'];
                    $data['ydatetime'] = strtotime($data['ydatetime']); 
                    $data['status'] = '1';//已经预约状态
                    
                   
                    //用户存在时，更新操作，预约添加操作
                    if ($has_user_id != ''){
                        $data['user_id']=$udata['id']=$has_user_id;
                        $result = $model->add($data);
                        $uresult=$user->save($udata);
                        if($result && $uresult)
                        {
                            M()->commit();
                            add_log($this->onname . '：' . $data['name'] . '添加成功');
                            $msg = lang('添加成功', 'handle');
                            return $this->success($msg . "预约号为：" . $data['ynumber'], $backurl);
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
                            return $this->success($msg . "预约号为：" . $data['ynumber'], $backurl);
                            //echo "<script language='javascript'>var index = parent.layer.getFrameIndex(window.name); parent.layer.msg('".$msg."');</script>";


                        } else {
                            M()->rollback();
                            add_log($this->onname . '：' . $data['name'] . '添加失败', $backurl);
                            $msg = lang('添加失败', 'handle');
                            return $this->success($msg);
                        }
                    }
                }else
                {
                    //不是预约，则添加进咨询，且入口user
                    if ($has_user_id != ''){
                        $zdata['user_id']=$udata['id']=$has_user_id;
                        $zresult = $zixun->add($zdata);
                        $uresult=$user->save($udata);
                        if($zresult && $uresult)
                        {
                            M()->commit();
                            add_log($this->onname . '：' . $data['name'] . '添加成功');
                            $msg = lang('添加成功', 'handle');
                            return $this->success($msg . "预约号为：" . $data['ynumber'], $backurl);
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
                        $this->onname="添加咨询";
                        $uresult=$user->add($udata);
                        $zdata['user_id'] =$uresult;
                        $zresult = $zixun->add($zdata);
                        if ($zresult && $uresult) {
                            M()->commit();
                            add_log($this->onname . '：' . $data['name'] . '添加成功');
                            $msg = lang('添加咨询成功', 'handle');
                            return $this->success($msg , $backurl);
                            //echo "<script language='javascript'>var index = parent.layer.getFrameIndex(window.name); parent.layer.msg('".$msg."');</script>";


                        } else {
                            M()->rollback();
                            add_log($this->onname . '：' . $data['name'] . '添加失败', $backurl);
                            $msg = lang('添加咨询失败', 'handle');
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

            if (I("get.tpl")) {
                return $this->display(I("get.tpl"));
            } else {
                return $this->display();
            }

        }

    }

    public function addUser($data)
    {

        $result = M('User')->data($data)->add();

        if ($result) {
            return ($result);
        } else {
            return false;
        }
    }

    public function getList()
    {
        $rule = M('KeShi')->where(array('checked' => 1, 'type' => 'keshi', 'fid' => 0))->select();
        return $rule;

    }

    public function ajaxList($id)
    {
        $tfid = I('get.tfid');

        $rule = M('KeShi')->where(array('checked' => 1, 'type' => 'keshi', 'fid' => $id))->select();
        $str = '';
        if (count($rule) > 0) {
            foreach ($rule as $k => $v) {
                if ($tfid == $v['id']) {
                    $str .= "<option selected='selected' value='" . $v['id'] . "'>" . $v['name'] . "</option>";
                } else {
                    $str .= "<option value='" . $v['id'] . "'>" . $v['name'] . "</option>";
                }

            }
        }
        return $this->ajaxReturn($str);
    }



    public function edit()
    {
        //权限选择
        $base = I('get.base');
        //网站更新信息
        $this->burl = U('Admin/YuYue/index') . "?" . base64_decode($base);

        $this->check_group('yuyue_edit');
        if (IS_POST) {
            $model = D('YuYue');
            $postdata = I('post.');
            if ($model->create()) {
                $data = $model->create();

                $user_arr = array(
                    'name',
                    'qq',
                    'sex',
                    'birthday',
                    'age',
                    'tel',
                    'is_jiehun',
                    'admin_id',
                    'email',
                    'othetel'

                );
                $user = array();
                foreach ($user_arr as $uv) {
                    if ($postdata[$uv] != '') {
                        $user[$uv] = $postdata[$uv];
                    }

                }
                //如果为空，则返回null

                $user['id'] = $data['user_id'];


                foreach ($data as $k => $v) {
                    if ($v == '') {
                        unset($data[$k]);
                    }
                }

                if (count($user) > 1) {
                    M("User")->save($user);
                }

                $result = $model->save($data);

                if ($result) {
                    add_log($this->onname . '：' . $data['name'] . '更新成功');
                    $msg = lang('更新成功', 'handle');
                    //echo "<script language='javascript'>var index = parent.layer.getFrameIndex(window.name); parent.layer.msg('".$msg."');window.lo</script>";
                    return $this->success($msg);
                } else {
                    $msg = lang('数据一样无更新', 'handle');
                    return $this->success(lang('无更新', 'handle'));
                    //echo "<script language='javascript'>var index = parent.layer.getFrameIndex(window.name); parent.layer.msg('".$msg."');</script>";
                }
            } else {
                return $this->error($model->getError());
            }
        } else {
            $id = I('get.id');
            //自己查看自己的
            /* if(!check_group('root'))
             {
                 $map['admin_id']=session('admin_id');
             }*/


            $map = array(
                'uuid' => $id
            );

            $model = D('YuYue')->relation(true)->where($map)->find();

            if ($model) {
                $this->data = $model;// 模板变量赋值
            } else {
                return $this->error(lang('数据错误', 'handle'));
            }
            if (I("get.tpl")) {
                $this->assign('back_url', I('get.backurl'));
                return $this->display(I("get.tpl"));
            } else {
                return $this->display();
            }

        }
    }

    public function all()
    {

        $id = I('get.id');

        $map = array(
            'id' => $id
        );
        //自己查看自己的
        if (!check_group('root')) {
            //没有如果没有
            if (!check_group('huifangset') or !check_group('hfrenwu') or !check_group('qiantaijz') or !check_group('yishenjz') or !check_group('yishenjz') or !check_group('    kaidan')) {

                //$map['admin_id']=session('admin_id');
            }

        }


        $model = D('YuYue')->relation(true)->where($map)->find();
        
        if ($model) {
            $this->data = $model;// 模板变量赋值
        } else {
            return $this->error(lang('数据错误', 'handle'));
        }

        return $this->display();
    }

    public function del()
    {
        //权限选择
        $this->check_group('yushen');
        $id = I('get.id');
        $map = array(
            'uuid' => $id
        );
        $model = D('Price');
        $data = $model->where($map)->find();
        $result = $model->where($map)->delete();
        if ($result) {
            add_log($this->onname . '：' . $data['name'] . '删除成功');
            return $this->success(lang('删除成功', 'handle'));;
        }
        add_log($this->onname . '：' . $data['name'] . '删除失败');
        return $this->error(lang('删除失败', 'handle'));;
    }

    public function handle($id)
    {
        //权限选择
        $this->check_group('yushen');
        $model = M('Price');
        $type = I('get.type');
        if ($type == 'true') {
            $status = 1;
        } else {
            $status = 0;
        }
        $data['id'] = $id;
        $filed = I('get.filed');
        $logmsg = '';
        if ($filed) {
            $data[$filed] = $status;
            $logmsg = '是否金额可修改';
        } else {
            $data['checked'] = $status;
            $logmsg = '设置状态';
        }


        if ($model->save($data)) {
            add_log($this->onname . '：' . $logmsg . '成功');
            return $this->success(lang('更新成功', 'handle'));
        } else {
            add_log($this->onname . '：' . $logmsg . '失败');
            return $this->error(lang('更新失败', 'handle'));
        }
    }

    public function showContent()
    {
        $id = I('get.id');
        //自己查看自己的
        if (!check_group('root')) {
            $map['admin_id'] = session('admin_id');
        }


        $map = array(
            'uuid' => $id
        );

        $model = D('YuYue')->relation(true)->where($map)->find();

        if ($model) {
            $this->data = $model;// 模板变量赋值
        } else {
            return $this->error(lang('数据错误', 'handle'));
        }
        if (I("get.tpl")) {
            $this->assign('back_url', I('get.backurl'));
            return $this->display(I("get.tpl"));
        } else {
            return $this->display();
        }
    }
}
