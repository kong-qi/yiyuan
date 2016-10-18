<?php
namespace Admin\Controller;
class HuiFangController extends AuthController {
    protected $onname='回访';
    protected $rule_qz='huifangset';
    protected $subjg=array(

        'hf_way'=>'回访方式',
        'hf_type'=>'回访类型',
        'hf_theme'=>'回访主题',
        'hf_status'=>'回访状态',
        'hf_go'=>'客户流向'
    );
    public function look(){
        
        return $this->display();
    }
    public function getlist($uid){
        $this->data=get_user($uid);
        return $this->display();
    }
    public function getlistadd(){
        if(IS_POST)
        {
            $this->onname='回访任务';
            $tabid=I('post.bktab');
            $model=D(CONTROLLER_NAME);

            if($model->create())
            {
                $result =    $model->add();
                $data=$model->create();
                if($result) {
                    add_log($this->onname.'：'.$data['name'].'添加成功');
                    $url=U('Admin/HuiFang/getlist',array('uid'=>$data['user_id'],'bktab'=>$tabid));
                    return $this->success(lang('添加成功','handle'),$url);
                }else{
                    add_log($this->onname.'：'.$data['name'].'添加失败');
                    return $this->error(lang('添加失败','handle'));
                }
            }else
            {
                $this->error($model->getError());
            }
        }
    }

    public function index(){
        //权限选择

        $this->check_group('huifangset');
       
        

    }

    public function add(){
        //权限选择
        $this->check_group('huifang');
        if(IS_POST)
        {

            $model=D('LanMu');

            $name=I('post.name');

            $subtype=I('post.subtype');
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
                    'type'=>'huifang',
                    'subtype'=>$subtype,
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
            $this->assign('subcategory',$this->subjg);
            $this->display();
        }

    }
    public function edit(){
        //权限选择

        $this->check_group('huifang');
        if(IS_POST)
        {
            $model =D('LanMu');

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

            $model   =   M('LanMu')->where($map)->find();

            if($model) {
                $this->data =  $model;// 模板变量赋值

            }else{
                return $this->error(lang('数据错误','handle'));
            }
            $this->assign('subcategory',$this->subjg);
            $this->display();
        }
    }
    public  function del(){
        //权限选择
        $this->check_group('huifang');
        $id=I('get.id');
        $map=array(
            'uuid'=>$id
        );
        $model   =   D('LanMu');
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
        $this->check_group('admin_edit');
        $model =M('LanMu');
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
