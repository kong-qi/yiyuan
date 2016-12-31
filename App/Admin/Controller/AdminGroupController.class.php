<?php
namespace Admin\Controller;
class AdminGroupController extends AuthController {

    protected $onname='管理组';
    protected $noticeAll='<p>超级管理员：表示最高权限</p><p>游客：只能访问，不能操作</p>';
    public function index(){
        //权限选择
        //安全区域
        $save=array('12','1');
        $this->saveArea=$save;
        $this->check_group('group');
        $model=M(CONTROLLER_NAME);
        $map=array();
        if(IS_GET)
        {
            $map=I('get.');
        }
        $count =  $model->where($map)->count();// 查询满足要求的总记录数
        $pagesize=(C('PAGESIZE'))!=''?C('PAGESIZE'):'20';
        $pagesize=I('get.pagesize')==''?$pagesize:I('get.pagesize');
        $page=1;
        if(isset($_GET['p']))
        {
            $page=$_GET['p'];
        }
        $list =  $model->where($map)->page( $page.','.$pagesize)->select();
        $this->assign('list',$list);// 赋值数据集
        $this->assign('page',page( $count ,$map,$pagesize));// 赋值分页输出
        $this->display();
    }
    public function add(){
        //权限选择
        $this->check_group('group_add');
        if(IS_POST)
        {

            $model=D(CONTROLLER_NAME);
            if($model->create())
            {
                $result =    $model->add();
                $data=$model->create();
                if($result) {
                    add_log($this->onname.'：'.$data['name'].'添加成功');
                    return $this->success('操作成功！',__CONTROLLER__);
                }else{
                    add_log($this->onname.'：'.$data['name'].'添加失败');
                    return $this->error('写入错误！');
                }
            }else
            {
                $this->error($model->getError());
            }
        }else
        {




            $this->display();
        }

    }
    public function edit(){
        //权限选择
        $this->check_group('group_edit');
        if(IS_POST)
        {
            $model =D(CONTROLLER_NAME);
           
            if($data=$model->create()) {
                $result =   $model->save();

               if($result) {
                   add_log($this->onname.'：'.$data['name'].'更新成功');
                    return  $this->success('更新操作成功！');
                }else{
                    return $this->error('数据一样，暂无更新');
                }
            }else{
                return $this->error($model->getError());
            }
        }else{
            $id=I('get.uuid');
            $map=array(
                'uuid'=>$id
            );

            $model   =   M(CONTROLLER_NAME)->where($map)->find();

            if($model) {
                $this->data =  $model;// 模板变量赋值
            }else{
                return $this->error('数据错误');
            }
            $this->display();
        }
    }
    public  function del(){
        //权限选择
        $this->check_group('group_del');
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
            return  $this->success('删除成功');
        }
        add_log($this->onname.'：'.$data['name'].'删除失败');
        return $this->error('删除失败');
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