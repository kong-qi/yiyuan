<?php
namespace Admin\Controller;
class ManBanController extends AuthController {

    protected $onname='模板';

    public function index(){
        $this->check_group('root');
        $model=M(CONTROLLER_NAME);
        $map=array();
        if(IS_GET)
        {
            $map=I('get.');
        }
        $count =  $model->where($map)->count();// 查询满足要求的总记录数
        $pagesize=(C('PAGESIZE'))!=''?C('PAGESIZE'):'20';
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
        $this->check_group('root');
        if(IS_POST)
        {
            $model=D(CONTROLLER_NAME);
            if($model->create())
            {
                $result =    $model->add();
                if($result) {
                    return $this->success('操作成功！',__CONTROLLER__);
                }else{
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
        $this->check_group('root');
        if(IS_POST)
        {
            $model =D(CONTROLLER_NAME);
            if($model->create()) {
                $result =   $model->save();

               if($result) {
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
        $this->check_group('root');
        $id=I('get.uuid');
        $map=array(
            'uuid'=>$id
        );
        $model   =   D(CONTROLLER_NAME);
        $result=$model->where($map)->delete();
        if($result)
        {
            return  $this->success('删除成功');
        }
        return $this->error('删除失败');
    }

}