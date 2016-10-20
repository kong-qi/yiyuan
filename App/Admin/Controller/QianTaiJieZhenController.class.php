<?php
namespace Admin\Controller;
class QianTaiJieZhenController extends AuthController {

    protected $onname='前台咨询接诊';
    protected $rule_qz='qiantaijz';
    
    public function index(){
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
    public function add(){
       

    }
    public function edit(){
        //权限选择
        $this->check_group('qiantaijz');
        //网站更新信息
        $this->onname='分配医生';

        $base=I('get.base');
        //网站更新信息
        $backurl=$this->burl=U('Admin/YuYue/index?is_qiantai=1&status=1&'.base64_decode($base));


        if(IS_POST)
        {
            $model =D('YuYue');
            $postdata=I('post.');
            if($model->create()) {
                $data=$model->create();
                $user_arr=array(
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
                $user=array();
                foreach ($user_arr as $uv)
                {
                    if($postdata[$uv]!='')
                    {
                        $user[$uv]=$postdata[$uv];
                    }

                }
                //如果为空，则返回null

                $user['id']=$data['user_id'];


                foreach ($data as $k=>$v)
                {
                    if($v=='')
                    {
                        unset($data[$k]);
                    }
                }

                if(count($user)>1)
                {
                    M("User")->save($user);
                }

                $result =   $model->save($data);

                if($result) {
                    add_log($this->onname.'：'.$data['name'].'更新成功');
                    $msg=lang('更新成功','handle');

                    echo "<script language='javascript'>var index = parent.layer.getFrameIndex(window.name); parent.layer.msg('".$msg."'); parent.window.location='".$backurl."';</script>";

                    //return  $this->success($msg);
                }else{
                    $msg=lang('数据一样无更新','handle');
                    //return  $this->success(lang('无更新','handle'));

                    echo "<script language='javascript'>var index = parent.layer.getFrameIndex(window.name); parent.layer.msg('".$msg."'); parent.window.location='".$backurl."';</script>";

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

                return $this->display('YuYue:qitai');


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