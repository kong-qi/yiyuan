<?php
namespace Admin\Controller;
class FileController extends AuthController {
    protected $onname='文件管理';
    public function index(){

        $this->check_group('root');
        //权限选择
        $model=M('File');
        $map=array();
        if(IS_GET)
        {
            $map=I('get.');

        }
        $count =  $model->where($map)->count();// 查询满足要求的总记录数
        $pagesize=50;
        $page=1;
        if(isset($_GET['p']))
        {
            $page=$_GET['p'];
        }

        $list =  $model->where($map)->order('sort desc,id desc')->page( $page.','.$pagesize)->select();

        $this->assign('list',$list);// 赋值数据集

        $this->assign('page',page( $count ,$map,$pagesize));// 赋值分页输出

        $this->display();
    }
    public  function del(){
        $this->check_group('root');
        $id=I('get.id');
        $map=array(
            'uuid'=>$id
        );
        $model   =   M('File');
        $file=$model->where($map)->find();

        @unlink($file['aburl']);
        $result=$model->where($map)->delete();
        if($result)
        {
            return  $this->success('删除成功');
        }
        return $this->error('删除失败');
    }
}