<?php
namespace Admin\Controller;

use Think\Controller;

class LoginController extends Controller
{
    public function index()
    {
        if (IS_POST) {
            $lang=I('post.lang');
            
            cookie('lang',$lang,3600*24);
            $map = array(
                'name' => I('post.name'),
                'pwd' => sha1(I('post.pwd'))
            );
            if (I('post.name') == '') {
                return $this->error(lang('用户名不能为空','login'));
            }
            if (I('post.pwd') == '') {
                return $this->error(lang('密码不能为空','login'));
            }
            if(C('CHECK_YZM'))
            {
                if(!check_code(I('post.yzm'))){
                    return $this->error(lang('验证码不正确','login'));
                }
            }




            $admin = M('Admin');
            $ckname = $admin->where(array('name' => I('post.name')))->find();
            if ($ckname) {
                $ckpwd = $admin->where($map)->find();

                if ($ckpwd) {

                    if($ckpwd['checked']!='1')
                    {
                        return  $this->error(lang('管理员被禁用，请联系站长开启','login'));

                    }else
                    {
                        //更新一定预到没有到的为逾期
                        

                        session('name',$ckpwd['name']);
                        session('admin_id',$ckpwd['id']);
                        //session('ys_id',$ckpwd['ys_id']);
                        session('uuid',$ckpwd['uuid']);
                        session('admin_info',$ckpwd);
                        session('uniqid',$ckpwd['uniqid']);
                        session('group_info',get_group_info($ckpwd['groupid']));
                        session('group',(get_group_rule($ckpwd['groupid'])));//取得权限字符串
                        session('brid',(get_brly_rule($ckpwd['groupid'])));//取得B人来源
                        add_log($ckpwd['name'].'登录成功');
                       
                        return $this->success(lang('登录成功','login'),U('Admin/Index/index'));
                    }

                } else {
                    return $this->error(lang('密码错误','login'));
                }
            } else {
                return $this->error(lang('用户名不存在','login'));
            }

        } else {
            $this->display();
        }

    }

    public function outlogin()
    {
        add_log('退出成功');
        session('[destroy]');

        $this->success('退出登录成功/Bấm Refresh',U('Admin/Login/index'));
    }
}