<?php
namespace Admin\Controller;
class KeShiZiDianController extends AuthController {
    protected $onname='科室字典';
    protected $rule_qz='keshi';


    public function index($type){
        //权限选择

        $this->check_group($type);
        $model=M('KeShi');
        $map=array();
        if(IS_GET)
        {
            $map=I('get.');

        }

        $list =  $model->where($map)->order('sort desc,id desc')->select();
        $list=get_tree_option($list,0);

        $this->assign('list',$list);// 赋值数据集



        $this->display();

    }

    public function add(){
        //权限选择
        $this->check_group('keshi');
        if(IS_POST)
        {

            $model=D('KeShi');

            $name=I('post.name');
            $fid=I('post.fid');
            if($name=='')
            {
                $msg=lang('名字不能为空','handle');
                echo "<script language='javascript'>var index = parent.layer.getFrameIndex(window.name); parent.layer.msg('".$msg."');</script>";
                exit();
            }
            $pname=explode(",",str_replace("，",",",$name));

            foreach ($pname as $k=>$v)
            {
                $dataList[]=array(
                    'ctime'=>time(),
                    'uuid'=>create_uuid(),
                    'name'=>$v,
                    'type'=>'keshi',
                    'fid'=>$fid,
                    'admin_id'=>session('admin_id')
                );
            }

            $result = $model->addAll($dataList);

            if($result) {
                add_log($this->onname.'：'.$name.'添加成功');
                $msg=lang('添加成功','handle');
                echo "<script language='javascript'>var index = parent.layer.getFrameIndex(window.name); parent.layer.msg('".$msg."');</script>";
            }else{
                $msg=lang('添加失败','handle');
                add_log($this->onname.'：'.$name.'添加失败','/Admin/add');
                echo "<script language='javascript'>var index = parent.layer.getFrameIndex(window.name); parent.layer.msg('".$msg."');</script>";
            }


        }else
        {
            $rule=get_tree_option($this->getList(),0);
            $this->assign('rule',$rule);// 赋值数据集
            $this->display();
        }

    }
    public function getList(){
        $rule=M('KeShi')->where(array('checked'=>1))->select();
        return $rule;
        
    }
    public function edit(){
        //权限选择

        $this->check_group('keshi');
        if(IS_POST)
        {
            $model =D('KeShi');

            if($model->create()) {
                $data=$model->create();
                $id=$data['id'];
                if(($data['pwd'])!='')
                {
                    $data['pwd']=sha1($data['pwd']);
                }else
                {
                    unset($data['pwd']);
                }

                $result =   $model->save($data);

                if($result) {
                    add_log($this->onname.'：'.$data['name'].'更新成功');
                    $msg=lang('更新成功','handle');
                    echo "<script language='javascript'>var index = parent.layer.getFrameIndex(window.name); parent.layer.msg('".$msg."');</script>";
                    //return  $this->success(lang('更新成功','handle'),'/Admin/edit',$id);
                }else{
                    $msg=lang('数据一样无更新','handle');
                    echo "<script language='javascript'>var index = parent.layer.getFrameIndex(window.name); parent.layer.msg('".$msg."');</script>";
                }
            }else{
                return $this->error($model->getError());
            }
        }else{
            $id=I('get.uuid');
            $map=array(
                'uuid'=>$id
            );

            $model   =   M('KeShi')->where($map)->find();
            $rule=get_tree_option($this->getList(),0);
            $this->rule=$rule;
            if($model) {
                $this->data =  $model;// 模板变量赋值
            }else{
                return $this->error(lang('数据错误','handle'));
            }
            $this->display();
        }
    }
    public  function del(){
        //权限选择
        $this->check_group('keshi');
        $id=I('get.id');
        $map=array(
            'uuid'=>$id
        );
        $model   =   D('KeShi');
        $data=$model->where($map)->find();
        $result=$model->where($map)->delete();
        if($result)
        {
            add_log($this->onname.'：'.$data['name'].'删除成功');
            return  $this->success(lang('删除成功','handle'));;
        }
        add_log($this->onname.'：'.$data['name'].'删除失败');
        return $this->error(lang('删除失败','handle'));;
    }
    public function handle($id){
        //权限选择
        $this->check_group('keshi');
        $model =M('KeShi');
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
            add_log($this->onname.'：设置状态成功');
            return  $this->success(lang('更新成功','handle'));
        }else
        {
            add_log($this->onname.'：设置状态失败');
            return $this->error(lang('更新失败','handle'));
        }
    }
}
