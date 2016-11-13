<?php
namespace Admin\Controller;

use Think\Controller;

class AuthController extends Controller
{
    protected $onname = '';

    //通知传入数组
    protected $noticeAll = '';
    protected $notice = array();
    protected $rule_qz='';

    protected function _initialize()
    {
        update_yuyue_over_time();
        $this->logname=I('param.logname');
        $this->isLogin();
        //全局开启，无需单个模块开启

        $this->assign('onname', lang($this->onname));
        $this->assign('rule_qz', $this->rule_qz);

        //通知模块设计，可重写。
        if ($this->noticeAll) {
            //判断是否是游客


            $this->setNotice($this->noticeAll);
            if (array_key_exists(ACTION_NAME, $this->notice)) {
                $this->setNotice($this->notice[ACTION_NAME]);
            }
            if ($this->isGuest() == '1') {
                $this->setNotice('<p>游客：只能访问，不能操作</p>');
            }

        } else {
            if (array_key_exists(ACTION_NAME, $this->notice)) {
                $this->setNotice($this->notice[ACTION_NAME]);
            }
            if ($this->isGuest() == '1') {
                $this->setNotice('<p>游客：只能访问，不能操作</p>');
            }
        }


    }

    public function setNotice($str)
    {
        $this->assign('notice', $str);
    }

    public functIon isGuest()
    {
        $group = session('group');
        if (in_array('guest', $group)) {
            return 1;
        } else {
            return 0;
        }
    }

    public function isLogin()
    {
        if (!is_login()) {
            return $this->error(lang('还没有登录','public'), U('Admin/Login/index'));
        }
    }

    public function check_group($str)
    {
        if(!check_group($str))
        {
            //return $this->error('非常抱歉，权限不够');
            $msg=lang('非常抱歉，权限不够','handle');
            echo "<script language='javascript'>var index = parent.layer.getFrameIndex(window.name); parent.layer.msg('".$msg."');    </script>";
            exit();

        }
        
    }

}