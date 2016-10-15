<?php
namespace Admin\Controller;
class NavController extends AuthController {
    protected $onname='栏目管理';

    public function getLanMu($name='data')
    {
        $model=M(CONTROLLER_NAME);
        $data=$model->select();
        $data=get_tree_option($data,'0');

        return $this->assign($name,$data);
    }
    public function index(){
        $this->check_group('nav');
        //权限选择
        $model=M(CONTROLLER_NAME);
        $map=array();
       
        if(IS_GET)
        {
            $map=I('get.');

        }
        if(!isset($map['type']))
        {
             $map['type']='index';
        }
        $rule=$model->select();
        $newrule=array();
        foreach ($rule as $key => $v)
        {
            $newrule[$v['id']]=$v['name'];

        }
        
        $count =  $model->where($map)->count();// 查询满足要求的总记录数
        $pagesize=20;
        $page=1;
        if(isset($_GET['p']))
        {
            $page=$_GET['p'];
        }

        $list =  $model->where($map)->order('sort desc,id desc')->page( $page.','.$pagesize)->select();
        $list=$list;
        $this->assign('list',$list);// 赋值数据集
        $this->assign('gpdata',$newrule);
        $this->assign('page',page( $count ,$map,$pagesize));// 赋值分页输出

        $this->display();
    }
    public  function del(){
        $this->check_group('nav_del');
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
    public  function  add(){
        $this->check_group('nav_add');
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
            $this->getLanMu('sdata');
            $this->display();
        }
    }
    public function getManBan(){
        $model=M('ManBan')->where('checked=1')->select();
        $this->assign('moban',$model);
    }
    public function edit(){
        $this->check_group('nav_edit');
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
         
            $this->getLanMu('sdata');
            $this->display();
        }
    }

}
