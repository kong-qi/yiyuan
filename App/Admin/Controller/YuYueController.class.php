<?php
namespace Admin\Controller;
class YuYueController extends AuthController
{
    protected $onname = ('添加预约');
    protected $rule_qz = 'yuyue';


    public function index()
    {

        //print_r(session('group'));
        $this->check_group($this->rule_qz . "_show");
        $map = array();
        $this->assign('is_search', I('get.is_search'));

        //自己查看自己的
        if (!check_group('root')) {
            if (check_group('yuyue_only')) {
                $map['y1.admin_id'] = session('admin_id');
            }

        }
        //网站来源
        $is_website = I('get.webstie');
        if ($is_website != '') {
            $map['y1.ly_id'] = array('in', get_website());
            $this->assign('is_website', 1);
            $this->assign('webbase', 1);
        }
        if (I('get.websiteall') != '') {
            $this->assign('is_website', 1);
            $this->assign('webbase', 2);
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

            
            a1.realname as admin_name,
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
            ssys.name as ysz_name,

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
        //$join[] = 'LEFT JOIN __JIE_ZHEN__ jz ON y1.id = jz.yy_id';
        //手术医生
        $join[] = 'LEFT JOIN __KE_SHI__ ssys ON ssys.id = y1.ysz_id';

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
        $pagesize=I('get.pagesize')==''?$pagesize:I('get.pagesize');
        echo I('get.pagesize');
        $page = 1;
        if (isset($_GET['p'])) {
            $page = $_GET['p'];
        }

        $list = $model->alias('y1')->field($filed)->join($join)->order('y1.ctime desc,y1.id desc')->where($map)->page($page . ',' . $pagesize)->select();
        //print_r($list);
        $this->assign('list', $list);// 赋值数据集
        $type_arr = 'defalut';
        if (I('get.list_type') != '') {
            $type_arr = I('get.list_type');
        }
        $menu_list = $this->getFiledArray($type_arr);
        $this->menu_list = $menu_list;
        $this->assign('page', page($count, $map, $pagesize));// 赋值分页输出
        $tpl = I('get.tpl');
        if ($tpl != '') {
            $this->display($tpl);
        } else {
            $this->display();
        }

    }

    public function getFiledArray($type)
    {
        switch ($type) {
            case 'yishen_s3':
                $menu_list = array(

                    'td-1' => array('name' => lang('预约号'), 'filed' => 'user_name', 'diy' => 'text-blue', 'is_time' => '', 'fun' => '', 'w' => '', 'h' => '', 'is_hide' => '1'),
                    'td-2' => array('name' => lang('姓名'), 'filed' => 'user_name', 'diy' => 'text-blue', 'is_time' => '', 'fun' => '', 'w' => '', 'h' => '', 'is_hide' => ''),
                    'td-3' => array('name' => lang('性别'), 'filed' => 'sex', 'diy' => '', 'is_time' => '', 'fun' => '', 'w' => '', 'h' => '', 'is_hide' => ''),
                    'td-4' => array('name' => lang('年龄'), 'filed' => 'age', 'diy' => '', 'is_time' => '', 'fun' => '', 'w' => '', 'h' => '', 'is_hide' => ''),
                    'td-5' => array('name' => lang('生日'), 'filed' => 'birthday', 'diy' => '', 'is_time' => '', 'w' => '', 'h' => '', 'is_hide' => '1'),
                    'td-6' => array('name' => lang('职业'), 'filed' => 'zhiye', 'diy' => '', 'is_time' => '', 'w' => '', 'h' => '', 'is_hide' => '1'),
                    'td-7' => array('name' => lang('婚姻'), 'filed' => 'jiehun', 'diy' => '', 'is_time' => '', 'w' => '', 'h' => '', 'is_hide' => '1'),
                    'td-8' => array('name' => lang('咨询时间'), 'filed' => 'birthday', 'diy' => '', 'is_time' => '1', 'fun' => '', 'w' => '', 'h' => '', 'is_hide' => ''),
                    'td-9' => array('name' => lang('预约时间'), 'filed' => 'zhiye', 'diy' => '', 'is_time' => '1', 'fun' => '', 'w' => '', 'h' => '', 'is_hide' => ''),
                    'td-10' => array('name' => lang('具体病种'), 'filed' => 'jiehun', 'diy' => '', 'is_time' => '', 'fun' => '', 'w' => '', 'h' => '', 'is_hide' => ''),
                    'td-11' => array('name' => lang('地区'), 'filed' => 'ae2_name', 'diy' => '', 'is_time' => '', 'fun' => '', 'w' => '', 'h' => '', 'is_hide' => ''),
                    'td-12' => array('name' => lang('来源'), 'filed' => 'ly_name', 'diy' => '', 'is_time' => '', 'fun' => '', 'w' => '', 'h' => '', 'is_hide' => ''),
                    'td-13' => array('name' => lang('网站来源'), 'filed' => 'web_name', 'diy' => '', 'is_time' => '', 'fun' => '', 'w' => '', 'h' => '', 'is_hide' => '1'),
                    'td-14' => array('name' => lang('来院类别'), 'filed' => 'web_name', 'diy' => '', 'is_time' => '', 'fun' => '', 'w' => '', 'h' => '', 'is_hide' => '1'),
                    'td-15' => array('name' => lang('咨询方式'), 'filed' => 'zx_name', 'diy' => '', 'is_time' => '', 'fun' => '', 'w' => '', 'h' => '', 'is_hide' => ''),
                    'td-16' => array('name' => lang('咨询员'), 'filed' => 'admin_name', 'diy' => '', 'is_time' => '', 'fun' => '', 'w' => '', 'h' => '', 'is_hide' => ''),
                    'td-17' => array('name' => lang('预约状态'), 'filed' => 'zx_mark', 'diy' => '', 'is_time' => '', 'fun' => '', 'w' => '', 'h' => '', 'is_hide' => ''),


                );
                break;
            case 'zixun':
                $menu_list = array(


                    'td-1' => array('name' => lang('姓名'), 'filed' => 'user_name', 'diy' => 'text-blue', 'is_time' => '', 'w' => '', 'h' => '', 'is_hide' => ''),
                    'td-2' => array('name' => lang('性别'), 'filed' => 'sex', 'diy' => '', 'is_time' => '', 'w' => '', 'h' => '', 'is_hide' => ''),
                    'td-3' => array('name' => lang('年龄'), 'filed' => 'age', 'diy' => '', 'is_time' => '', 'w' => '', 'h' => '', 'is_hide' => ''),
                    'td-4' => array('name' => lang('生日'), 'filed' => 'birthday', 'diy' => '', 'is_time' => '', 'w' => '', 'h' => '', 'is_hide' => '1'),
                    'td-5' => array('name' => lang('职业'), 'filed' => 'zhiye', 'diy' => '', 'is_time' => '', 'w' => '', 'h' => '', 'is_hide' => '1'),
                    'td-6' => array('name' => lang('婚姻'), 'filed' => 'jiehun', 'diy' => '', 'is_time' => '', 'w' => '', 'h' => '', 'is_hide' => '1'),
                    'td-7' => array('name' => lang('身份证'), 'filed' => 'card', 'diy' => '', 'is_time' => '', 'w' => '', 'h' => '', 'is_hide' => '1'),
                    'td-8' => array('name' => lang('会员级别'), 'filed' => 'level', 'diy' => '', 'is_time' => '', 'w' => '', 'h' => '', 'is_hide' => '1'),
                    'td-9' => array('name' => lang('手机品牌'), 'filed' => 'pbank', 'diy' => '', 'is_time' => '', 'w' => '', 'h' => '', 'is_hide' => '1'),
                    'td-10' => array('name' => lang('咨询方式'), 'filed' => 'zx_name', 'diy' => '', 'is_time' => '', 'w' => '', 'h' => '', 'is_hide' => ''),
                    'td-11' => array('name' => lang('来源'), 'filed' => 'ly_name', 'diy' => '', 'is_time' => '', 'w' => '', 'h' => '', 'is_hide' => ''),
                    'td-12' => array('name' => lang('地区'), 'filed' => 'ae2_name', 'diy' => '', 'is_time' => '', 'w' => '', 'h' => '', 'is_hide' => ''),
                    'td-13' => array('name' => lang('网站来源'), 'filed' => 'web_name', 'diy' => '', 'is_time' => '', 'w' => '', 'h' => '', 'is_hide' => '1'),
                    'td-14' => array('name' => lang('咨询小结'), 'filed' => 'zx_mark', 'diy' => '', 'is_time' => '', 'w' => '', 'h' => '', 'is_hide' => ''),
                    'td-15' => array('name' => lang('咨询员'), 'filed' => 'admin_name', 'diy' => '', 'is_time' => '', 'w' => '', 'h' => '', 'is_hide' => ''),
                    'td-16' => array('name' => lang('咨询时间'), 'filed' => 'yctime', 'diy' => '', 'is_time' => '1', 'w' => '', 'h' => '', 'is_hide' => ''),


                );
                break;
            case 'kefu':
                $menu_list = array(
                    'td-1' => array('name' => lang('姓名'), 'filed' => 'user_name', 'diy' => 'text-blue', 'is_time' => '', 'w' => '', 'h' => '', 'is_hide' => ''),
                    'td-2' => array('name' => lang('性别'), 'filed' => 'sex', 'diy' => '', 'is_time' => '', 'w' => '', 'h' => '', 'is_hide' => ''),
                    'td-3' => array('name' => lang('年龄'), 'filed' => 'age', 'diy' => '', 'is_time' => '', 'w' => '', 'h' => '', 'is_hide' => ''),
                    'td-4' => array('name' => lang('联系电话'), 'filed' => 'tel', 'diy' => '', 'is_time' => '', 'fun' => '', 'w' => '', 'h' => '', 'is_hide' => ''),
                    'td-5' => array('name' => lang('预约状态'), 'filed' => 'ystatus', 'diy' => '', 'is_time' => '', 'fun' => '', 'w' => '', 'h' => '', 'is_hide' => ''),
                    'td-6' => array('name' => lang('预约时间'), 'filed' => 'yctime', 'diy' => 'text-info', 'is_time' => '1', 'fun' => '', 'w' => '', 'h' => '', 'is_hide' => ''),
                    'td-7' => array('name' => lang('预到时间'), 'filed' => 'ydatetime', 'diy' => 'text-blue', 'is_time' => '1', 'fun' => '', 'w' => '', 'h' => '', 'is_hide' => ''),
                    'td-8' => array('name' => lang('到院时间'), 'filed' => 'dztime', 'diy' => 'text-blue', 'is_time' => '1', 'fun' => '', 'w' => '', 'h' => '', 'is_hide' => ''),
                    'td-10' => array('name' => lang('具体病种'), 'filed' => 'bz_name', 'diy' => '', 'is_time' => '', 'fun' => '', 'w' => '', 'h' => '', 'is_hide' => ''),
                    'td-11' => array('name' => lang('来源'), 'filed' => 'ly_name', 'diy' => '', 'is_time' => '', 'fun' => '', 'w' => '', 'h' => '', 'is_hide' => ''),
                    'td-11' => array('name' => lang('回访次数'), 'filed' => 'hf_total', 'diy' => '', 'is_time' => '', 'fun' => '', 'w' => '', 'h' => '', 'is_hide' => ''),
                    'td-12' => array('name' => lang('咨询员'), 'filed' => 'admin_name', 'diy' => '', 'is_time' => '', 'w' => '', 'h' => '', 'is_hide' => '1'),
                    'td-13' => array('name' => lang('接诊医生'), 'filed' => 'ys_name', 'diy' => '', 'is_time' => '', 'w' => '', 'h' => '', 'is_hide' => '1'),
                    'td-14' => array('name' => lang('手术医生'), 'filed' => 'ysz_name', 'diy' => '', 'is_time' => '', 'w' => '', 'h' => '', 'is_hide' => '1')
                );

                break;

            default:
                $menu_list = array(

                    'td-1' => array('name' => lang('预约号'), 'filed' => 'ynumber', 'diy' => 'text-blue', 'is_time' => '', 'fun' => '', 'w' => '', 'h' => '', 'is_hide' => '1'),
                    'td-2' => array('name' => lang('姓名'), 'filed' => 'user_name', 'diy' => 'text-blue', 'is_time' => '', 'fun' => '', 'w' => '', 'h' => '', 'is_hide' => ''),
                    'td-3' => array('name' => lang('性别'), 'filed' => 'sex', 'diy' => '', 'is_time' => '', 'fun' => '', 'w' => '', 'h' => '', 'is_hide' => ''),
                    'td-4' => array('name' => lang('年龄'), 'filed' => 'age', 'diy' => '', 'is_time' => '', 'fun' => '', 'w' => '', 'h' => '', 'is_hide' => ''),
                    'td-5' => array('name' => lang('生日'), 'filed' => 'birthday', 'diy' => '', 'is_time' => '', 'w' => '', 'h' => '', 'is_hide' => '1'),
                    'td-6' => array('name' => lang('职业'), 'filed' => 'zhiye', 'diy' => '', 'is_time' => '', 'w' => '', 'h' => '', 'is_hide' => '1'),
                    'td-7' => array('name' => lang('婚姻'), 'filed' => 'jiehun', 'diy' => '', 'is_time' => '', 'w' => '', 'h' => '', 'is_hide' => '1'),
                    'td-8' => array('name' => lang('预约时间'), 'filed' => 'yctime', 'diy' => 'text-info', 'is_time' => '1', 'fun' => '', 'w' => '', 'h' => '', 'is_hide' => ''),
                    'td-9' => array('name' => lang('预到时间'), 'filed' => 'ydatetime', 'diy' => 'text-blue', 'is_time' => '1', 'fun' => '', 'w' => '', 'h' => '', 'is_hide' => ''),
                    'td-10' => array('name' => lang('具体病种'), 'filed' => 'bz_name', 'diy' => '', 'is_time' => '', 'fun' => '', 'w' => '', 'h' => '', 'is_hide' => ''),
                    'td-11' => array('name' => lang('地区'), 'filed' => 'ae2_name', 'diy' => '', 'is_time' => '', 'fun' => '', 'w' => '', 'h' => '', 'is_hide' => ''),
                    'td-12' => array('name' => lang('来源'), 'filed' => 'ly_name', 'diy' => '', 'is_time' => '', 'fun' => '', 'w' => '', 'h' => '', 'is_hide' => ''),
                    'td-13' => array('name' => lang('网站来源'), 'filed' => 'web_name', 'diy' => '', 'is_time' => '', 'fun' => '', 'w' => '', 'h' => '', 'is_hide' => '1'),
                    'td-14' => array('name' => lang('来院类别'), 'filed' => 'leibie', 'diy' => '', 'is_time' => '', 'fun' => '', 'w' => '', 'h' => '', 'is_hide' => '1'),
                    'td-15' => array('name' => lang('咨询方式'), 'filed' => 'zx_name', 'diy' => '', 'is_time' => '', 'fun' => '', 'w' => '', 'h' => '', 'is_hide' => ''),
                    'td-16' => array('name' => lang('咨询员'), 'filed' => 'admin_name', 'diy' => '', 'is_time' => '', 'fun' => '', 'w' => '', 'h' => '', 'is_hide' => ''),
                    'td-17' => array('name' => lang('预约状态'), 'filed' => 'ystatus', 'diy' => '', 'is_time' => '', 'fun' => '', 'w' => '', 'h' => '', 'is_hide' => ''),

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
        $this->check_group($this->rule_qz . "_add");
        $backurl = U('Admin/YuYue/add');

        if (IS_POST) {
            if (!check_token(I('post.token'))) {
                $msg = lang('操作错误');
                $backurl = U("Admin/YuYue/add");
                return $this->error($msg, $backurl);
            }
            $model = D("YuYue");
            $user = D('User');
            $zixun = D('ZiXun');
            $data = $model->create();
            $udata = $user->create();

            $zdata = $zixun->create();
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
                    } else {
                        $has_user_id = $muser['id'];
                    }
                }


                //判断是否有预约
                if ($data['ydate'] != '') {
                    //预约好前缀获取
                    $yy_qz = M('LanMu')->where(array('type' => 'bingren', 'id' => $data['ly_id']))->find();
                    //取得预约号
                    $data['ynumber'] = $yy_qz['card'] . create_ynumber();
                    //拼接预约时间

                    //判断长度
                    if (strlen($data['ytime']) <= 5) {
                        $data['ytime'] = $data['ytime'] . ":00";
                    }
                    $data['ydatetime'] = $data['ydate'] . ' ' . $data['ytime'];
                    $data['ydatetime'] = strtotime($data['ydatetime']);
                    $data['status'] = '1';//已经预约状态


                    //用户存在时，更新操作，预约添加操作
                    if ($has_user_id != '') {
                        $data['user_id'] = $udata['id'] = $has_user_id;
                        //取消更新admin_id

                        $result = $model->add($data);
                        $uresult = $user->save($udata);
                        if ($result && $uresult) {
                            M()->commit();
                            D('User')->updateCount($data['user_id'], 'yy_total');
                            add_log($this->onname . '：添加成功', $data['user_id']);
                            $msg = lang('添加成功', 'handle');
                            return $this->success($msg . "预约号为：" . $data['ynumber'], $backurl);
                        } else {
                            M()->rollback();
                            add_log($this->onname . '：添加失败', $data['user_id']);
                            $msg = lang('添加失败', 'handle');
                            return $this->success($msg);
                        }
                    } else {
                        //用户不存在时
                        //用户添加，返回user_id
                        $uresult = $user->add($udata);
                        $data['user_id'] = $uresult;
                        $result = $model->add($data);
                        if ($result && $uresult) {
                            M()->commit();
                            D('User')->updateCount($data['user_id'], 'yy_total');
                            add_log($this->onname . '：添加成功', $data['user_id']);
                            $msg = lang('添加成功', 'handle');
                            return $this->success($msg . "预约号为：" . $data['ynumber'], $backurl);
                            //echo "<script language='javascript'>var index = parent.layer.getFrameIndex(window.name); parent.layer.msg('".$msg."');</script>";


                        } else {
                            M()->rollback();
                            add_log($this->onname . '：添加失败', $data['user_id']);
                            $msg = lang('添加失败', 'handle');
                            return $this->success($msg);
                        }
                    }
                } else {
                    $this->onname = '添加咨询';
                    //不是预约，则添加进咨询，且入口user
                    if ($has_user_id != '') {
                        $zdata['user_id'] = $udata['id'] = $has_user_id;
                        $zresult = $zixun->add($zdata);
                        $uresult = $user->save($udata);
                        if ($zresult && $uresult) {

                            M()->commit();
                            D('User')->updateCount($has_user_id, 'zx_total');
                            add_log($this->onname . '：添加成功', $has_user_id);
                            $msg = lang('添加咨询成功', 'handle');
                            return $this->success($msg, $backurl);
                        } else {
                            M()->rollback();
                            add_log($this->onname . '：添加失败', $zdata['user_id']);
                            $msg = lang('添加咨询失败', 'handle');
                            return $this->success($msg);
                        }
                    } else {
                        //用户不存在时
                        //用户添加，返回user_id
                        $this->onname = "添加咨询";
                        $uresult = $user->add($udata);
                        $zdata['user_id'] = $uresult;
                        $zresult = $zixun->add($zdata);
                        if ($zresult && $uresult) {
                            M()->commit();
                            D('User')->updateCount($zdata['user_id'], 'zx_total');
                            add_log($this->onname . '：添加成功', $zdata['user_id']);
                            $msg = lang('添加咨询成功', 'handle');
                            return $this->success($msg, $backurl);
                            //echo "<script language='javascript'>var index = parent.layer.getFrameIndex(window.name); parent.layer.msg('".$msg."');</script>";


                        } else {
                            M()->rollback();
                            add_log($this->onname . '：添加失败', $zdata['user_id']);
                            $msg = lang('添加咨询失败', 'handle');
                            return $this->success($msg);
                        }
                    }
                }


            } else {

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
        $this->burl = U('Admin/YuYue/index');

        $this->check_group('yuyue_edit');
        if (IS_POST) {
            $model = D('YuYue');
            $user = D('User');
            $postdata = I('post.');
            if ($model->create()) {
                $data = $model->create();
                $udata = $user->create();
                $udata['id'] = $data['user_id'];


                foreach ($data as $k => $v) {
                    if ($v == '') {
                        unset($data[$k]);
                    }
                }
                foreach ($udata as $k => $v) {
                    if ($v == '') {
                        unset($udata[$k]);
                    }
                }

                if (count($udata) > 1) {
                    M("User")->save($udata);
                }
                //判断长度
                if (strlen($data['ytime']) <= 5) {
                    $data['ytime'] = $data['ytime'] . ":00";
                }
                $data['ydatetime'] = $data['ydate'] . ' ' . $data['ytime'];
                $data['ydatetime'] = strtotime($data['ydatetime']);

                $result = $model->save($data);

                if ($result) {
                    add_log($this->onname . '：更新成功', $data['user_id']);
                    $msg = lang('更新成功', 'handle');
                    //echo "<script language='javascript'>var index = parent.layer.getFrameIndex(window.name); parent.layer.msg('".$msg."');window.lo</script>";
                    return $this->success($msg, $this->burl);
                } else {
                    $msg = lang('更新成功', 'handle');
                    return $this->success(lang('更新成功', 'handle'), $this->burl);
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
        $this->check_group($this->rule_qz . "_del");
        $id = I('get.id');
        $map = array(
            'uuid' => $id
        );
        $model = D("YuYue");
        $data = $model->where($map)->find();
        $result = $model->where($map)->delete();
        if ($result) {
            D('User')->updateCount($data['user_id'], 'yy_total');
            add_log($this->onname . '：删除成功', $data['user_id']);
            return $this->success(lang('删除成功', 'handle'));;
        }
        add_log($this->onname . '：删除失败', $data['user_id']);
        return $this->error(lang('删除失败', 'handle'));;
    }

    public function zxindex()
    {
        //print_r(session('group'));
        $this->check_group("zixun_show");
        $map = array();

        $this->assign('is_search', I('get.is_search'));
        //自己查看自己的
        if (!check_group('root')) {
            if (check_group('yuyue_only')) {
                $map['y1.admin_id'] = session('admin_id');
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
                'yx_id',
                'zx_id',
                'user_id',
                'admin_id',
                'leibie',


            );
            //print_r($getdata);
            foreach ($getdata as $key => $v) {
                if ($v != '') {

                    if (in_array($key, $y_arr)) {

                        $map["y1." . $key] = $v;
                    }
                }

            }


            if (I('get.user_id') != '') {
                $map['y1.user_id'] = I('get.user_id');

            }
            if (I('get.keyword') != '') {
                $key = I('get.keyword');
                $map['_string'] = "u1.name like '%" . $key . "%' or u1.tel like '%" . $key . "%'";
            }

        }

        $model = M('ZiXun');
        $filed = '
            u1.name as user_name,
            u1.age as age,
            u1.sex,
            u1.uuid as user_uuid,
            u1.id as user_id,
            u1.tel as tel,
            u1.sfcard as card,
            u1.birthday as birthday,
            
            ly1.name as ly_name,
            ly2.name as lyt_name,
            ly3.name as lytt_name,

            y1.uuid as yuuid,
            y1.zx_content as zx_content,
            y1.zx_mark,
            y1.id as yid,
            y1.admin_id,
            y1.ctime as yctime,
            y1.mark as mark,

           

            a1.realname as admin_name,

            k1.name as ks_name,
            k2.name as kst_name,
            k3.name as kstt_name,
            zx.name as zx_name,
            yx.name as yx_name,
            wz.name as web_name,
            ae1.name as ae_name,
            ae2.name as ae2_name,
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
        //关科室1
        $join[] = 'LEFT JOIN __KE_SHI__ k1 ON y1.ks_id = k1.id';
        //关科室2
        $join[] = 'LEFT JOIN __KE_SHI__ k2 ON y1.kst_id = k2.id';
        //关科室3
        $join[] = 'LEFT JOIN __KE_SHI__ k3 ON y1.kstt_id = k3.id';
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

        $list = $model->alias('y1')->field($filed)->join($join)->order('y1.ctime desc,y1.id desc')->where($map)->page($page . ',' . $pagesize)->select();
        //print_r($list);
        $this->assign('list', $list);// 赋值数据集

        $type_arr = 'zixun';

        $menu_list = $this->getFiledArray($type_arr);

        $this->menu_list = $menu_list;


        $this->assign('page', page($count, $map, $pagesize));// 赋值分页输出
        $this->display("YuYue:zixun:index");
    }

    public function zxedit()
    {
        $this->onname = "咨询";
        //权限选择
        $base = I('get.base');
        //网站更新信息
        $this->burl = U('Admin/YuYue/zxindex');

        $this->check_group('zixun_edit');
        if (IS_POST) {
            $model = D('ZiXun');
            $user = D('User');
            $postdata = I('post.');
            if ($model->create()) {
                $data = $model->create();
                $udata = $user->create();
                $udata['id'] = $data['user_id'];


                foreach ($data as $k => $v) {
                    if ($v == '') {
                        unset($data[$k]);
                    }
                }
                foreach ($udata as $k => $v) {
                    if ($v == '') {
                        unset($udata[$k]);
                    }
                }

                if (count($udata) > 1) {
                    M("User")->save($udata);
                }

                $result = $model->save($data);

                if ($result) {
                    add_log($this->onname . '：更新成功', $user['id']);
                    $msg = lang('更新成功', 'handle');
                    //echo "<script language='javascript'>var index = parent.layer.getFrameIndex(window.name); parent.layer.msg('".$msg."');window.lo</script>";
                    return $this->success($msg);
                } else {
                    $msg = lang('更新成功', 'handle');
                    return $this->success(lang('更新成功', 'handle'));
                    //echo "<script language='javascript'>var index = parent.layer.getFrameIndex(window.name); parent.layer.msg('".$msg."');</script>";
                }
            } else {
                return $this->error($model->getError());
            }
        } else {
            $id = I('get.id');
            $map = array(
                'uuid' => $id
            );

            $model = D('ZiXun')->relation(true)->where($map)->find();

            if ($model) {
                $this->data = $model;// 模板变量赋值
            } else {
                return $this->error(lang('数据错误'));
            }

            return $this->display("YuYue:zixun:edit");


        }
    }

    public function zxyyadd()
    {
        $this->onname = "咨询转预约";
        //权限选择
        $base = I('get.base');
        //网站更新信息
        $this->burl = U('Admin/YuYue/zxindex');

        $this->check_group('yuyue_add');
        if (IS_POST) {
            $model = D('YuYue');
            $user = D('User');
            if (!check_token(I('post.token'))) {
                $msg = lang('操作错误');
                $backurl = U("Admin/YuYue/zxyyadd");
                return $this->error($msg, $backurl);
            }
            $postdata = I('post.');
            if ($model->create()) {
                M()->startTrans();
                $data = $model->create();
                $udata = $user->create();
                //预约好前缀获取
                $yy_qz = M('LanMu')->where(array('type' => 'bingren', 'id' => $data['ly_id']))->find();
                //取得预约号
                $data['ynumber'] = $yy_qz['card'] . create_ynumber();
                //拼接预约时间
                $data['ytime'] = $data['ytime'] . ":00";
                $data['ydatetime'] = $data['ydate'] . ' ' . $data['ytime'];
                $data['ydatetime'] = strtotime($data['ydatetime']);
                $data['status'] = '1';//已经预约状态

                $data['uuid'] = create_uuid();
                $data['ctime'] = time();
                unset($data['id']);
                $udata['id'] = $data['user_id'];

                foreach ($data as $k => $v) {
                    if ($v == '') {
                        unset($data[$k]);
                    }
                }
                foreach ($udata as $k => $v) {
                    if ($v == '') {
                        unset($udata[$k]);
                    }
                }
                //print_r($data);
                //print_r($udata);

                //exit();
                if (count($udata) > 1) {
                    M("User")->save($udata);
                }

                $result = $model->add($data);

                if ($result) {
                    M()->commit();
                    D('User')->updateCount($data['user_id'], 'yy_total');
                    add_log($this->onname . '：成功', $data['user_id']);
                    $msg = lang('预约成功', 'handle');

                    //echo "<script language='javascript'>var index = parent.layer.getFrameIndex(window.name); parent.layer.msg('".$msg."');window.lo</script>";
                    return $this->success($msg . "预约号为：" . $data['ynumber'], $backurl);
                } else {
                    M()->rollback();
                    $msg = lang('预约失败', 'handle');
                    return $this->success(lang('预约失败', 'handle'));
                    //echo "<script language='javascript'>var index = parent.layer.getFrameIndex(window.name); parent.layer.msg('".$msg."');</script>";
                }
            } else {
                return $this->error($model->getError());
            }
        } else {
            $id = I('get.id');
            $map = array(
                'uuid' => $id
            );

            $model = D('ZiXun')->relation(true)->where($map)->find();

            if ($model) {
                $this->data = $model;// 模板变量赋值
            } else {
                return $this->error(lang('数据错误'));
            }

            return $this->display("YuYue:zixun:yyadd");


        }
    }

    public function zxadd()
    {
        $this->onname = "咨询添加";
        //权限选择
        $base = I('get.base');
        //网站更新信息
        $this->burl = U('Admin/YuYue/zxindex');
        if (IS_POST) {

            $model = D('ZiXun');
            $user = D('User');
            $postdata = I('post.');
            if ($model->create()) {

                $data = $model->create();


                $data['uuid'] = create_uuid();
                $data['ctime'] = time();
                unset($data['id']);
                $udata['id'] = $data['user_id'];

                foreach ($data as $k => $v) {
                    if ($v == '') {
                        unset($data[$k]);
                    }
                }
                foreach ($udata as $k => $v) {
                    if ($v == '') {
                        unset($udata[$k]);
                    }
                }


                $result = $model->add($data);

                if ($result) {
                    M()->commit();
                    D('User')->updateCount($data['user_id'], 'zx_total');
                    add_log($this->onname . '：成功', $data['user_id']);
                    $msg = lang('咨询添加成功', 'handle');

                    //echo "<script language='javascript'>var index = parent.layer.getFrameIndex(window.name); parent.layer.msg('".$msg."');window.lo</script>";
                    return $this->success($msg, $backurl);
                } else {
                    M()->rollback();
                    $msg = lang('预约失败', 'handle');
                    return $this->success(lang($msg, 'handle'));
                    //echo "<script language='javascript'>var index = parent.layer.getFrameIndex(window.name); parent.layer.msg('".$msg."');</script>";
                }
            } else {
                return $this->error($model->getError());
            }
        } else {
            $id = I('get.id');
            $map = array(
                'id' => $id
            );

            $model = D('User')->where($map)->find();

            if ($model) {
                $this->data = $model;// 模板变量赋值
            } else {
                return $this->error(lang('数据错误'));
            }

            return $this->display("YuYue:zixun:add");


        }
    }

    public function zxdel()
    {
        //权限选择
        $this->check_group($this->rule_qz . "_del");
        $this->onname = "咨询";
        $id = I('get.id');
        $map = array(
            'uuid' => $id
        );
        $model = D("ZiXun");
        $data = $model->where($map)->find();
        $result = $model->where($map)->delete();
        if ($result) {
            D('User')->updateCount($data['user_id'], 'zx_total');
            add_log($this->onname . '：删除成功', $data['user_id']);
            return $this->success(lang('删除成功', 'handle'));;
        }
        add_log($this->onname . '：删除失败', $data['user_id']);
        return $this->error(lang('删除失败', 'handle'));;
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

    public function kfindex()
    {

        //print_r(session('group'));
        $this->check_group($this->rule_qz . "_show");
        $map = array();
        $this->assign('is_search', I('get.is_search'));

        //自己查看自己的
        if (!check_group('root')) {
            if (check_group('yuyue_only')) {
                $map['y1.admin_id'] = session('admin_id');
            }

        }
        //网站来源
        $is_website = I('get.webstie');
        if ($is_website != '') {
            $map['y1.ly_id'] = array('in', get_website());
            $this->assign('is_website', 1);
            $this->assign('webbase', 1);
        }
        if (I('get.websiteall') != '') {
            $this->assign('is_website', 1);
            $this->assign('webbase', 2);
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

            
            a1.realname as admin_name,
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
    
           
            ssys.name as ysz_name,

            xueli.name as xueli,
            zhiye.name as zhiye,
            hunyin.name as jiehun,
            level.name as  level,
            phone.name  as pbank,
            u1.hf_total as hf_total
            
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
        //$join[] = 'LEFT JOIN __JIE_ZHEN__ jz ON y1.id = jz.yy_id';
        //手术医生
        $join[] = 'LEFT JOIN __KE_SHI__ ssys ON ssys.id = y1.ysz_id';

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

        $list = $model->alias('y1')->field($filed)->join($join)->order('y1.ctime desc,y1.id desc')->where($map)->page($page . ',' . $pagesize)->select();
        //print_r($list);
        $this->assign('list', $list);// 赋值数据集
        $type_arr = 'defalut';
        if (I('get.list_type') != '') {
            $type_arr = I('get.list_type');
        }
        $menu_list = $this->getFiledArray($type_arr);
        $this->menu_list = $menu_list;
        $this->assign('page', page($count, $map, $pagesize));// 赋值分页输出
        $this->display("YuYue:kefu:index");


    }
}
