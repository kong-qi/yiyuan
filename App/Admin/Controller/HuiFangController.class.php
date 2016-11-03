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
        $this->check_group($this->rule_qz."_add");
        $isclose=I('post.close_frame');
        if(IS_POST)
        {

            $tabid=I('post.bktab');
            $model=D(CONTROLLER_NAME);

            if($model->create())
            {
                $result =    $model->add();
                $data=$model->create();
                $renwu_id=$data['renwu_id'];
                if($renwu_id!='')
                {
                    $rdata=array('id'=>$renwu_id,'status'=>1);
                    M('RenWu')->save($rdata);
                }
                if($result) {
                    add_log($this->onname.'：'.$data['name'].'添加成功');
                    if($isclose)
                    {
                        $msg=lang('添加成功','handle');
                        $backurl=U('Admin/YuYue/index',array('is_huifang'=>1));
                        echo "<script language='javascript'>var index = parent.layer.getFrameIndex(window.name); parent.layer.msg('".$msg."'); parent.location.reload();;parent.layer.close(index);</script>";

                    }else
                    {
                        $url=U('Admin/HuiFang/getlist',array('uid'=>$data['user_id'],'bktab'=>$tabid));
                        return $this->success(lang('添加成功','handle'),$url);
                    }

                }else{
                    add_log($this->onname.'：'.$data['name'].'添加失败');
                    if($isclose)
                    {
                        $msg=lang('添加失败','handle');

                        echo "<script language='javascript'>var index = parent.layer.getFrameIndex(window.name); parent.layer.msg('".$msg."'); </script>";

                    }else {
                        return $this->error(lang('添加失败', 'handle'));
                    }
                }
            }else
            {
                $this->error($model->getError());
            }
        }
    }

    public function index(){
        //权限选择
        $map=array();
        $this->assign('is_search',I('get.is_search'));
        $this->check_group("huihfrenwu_list");
        $model = M('HuiFang');
        $join[] = 'LEFT JOIN __USER__ u1 ON rewu.user_id = u1.id';
        $join[] = 'LEFT JOIN __ADMIN__ a1 ON rewu.admin_id = a1.id';
        $join[] = 'LEFT JOIN __ADMIN__ fp ON rewu.handle_id = fp.id';
        $filed ='
        rewu.id as id,
        rewu.status as status,
        rewu.uuid as uuid,
        rewu.name as name,
        rewu.type_text as type_text,
        rewu.ctime as ctime,
        rewu.rtime as rtime,
        a1.name as create_name,
        fp.name as handle_name,
        u1.name as user_name,
        u1.tel as tel,
        u1.id as user_id
        ';
        if(I('get.keyword')!='')
        {
             $key=I('get.keyword');
            $map['_string'] = "u1.name like '%" . $key . "%' or u1.tel like '%" . $key . "%' or rewu.name like '%" . $key . "%'";
        }
         $status='';
         if(I('get.status')!='')
         {
            $status=I('get.status');
            $map['status']=$status;
         }
         $count = $model->alias('rewu')->join($join)->where($map)->count();// 查询满足要求的总记录数
         $pagesize = (C('PAGESIZE')) != '' ? C('PAGESIZE') : '50';
         $page = 1;
         if (isset($_GET['p'])) {
             $page = $_GET['p'];
         }

         $list = $model->alias('rewu')->field($filed)->join($join)->order('rewu.ctime desc,rewu.id desc')->where($map)->page($page . ',' . $pagesize)->select();
         //print_r($list);
         $this->assign('list', $list);// 赋值数据集
         $type_arr='';
         $menu_list = $this->getFiledArray($type_arr);
         
         $this->menu_list = $menu_list;

        
        $this->assign('page', page($count, $map, $pagesize));// 赋值分页输出
        
        $this->display();

    }
    public function getFiledArray($type){
        switch ($type) {
           
            
            default:
                $menu_list = array(

                    
                    'td-1' => array('name' => lang('姓名'), 'filed'=>'user_name','diy'=>'text-blue','is_time'=>'','fun'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                    'td-2' => array('name' => lang('电话'), 'filed'=>'tel','diy'=>'', 'is_time'=>'','fun'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                    'td-3' => array('name' => lang('回访类型'), 'filed'=>'type_text','diy'=>'', 'is_time'=>'','fun'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                    'td-4' => array('name' => lang('回访状态'), 'filed'=>'status','diy'=>'', 'is_time'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                    
                    'td-7' => array('name' => lang('待回访日期'), 'filed'=>'rtime','diy'=>'text-info', 'is_time'=>'1','fun'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                    'td-5' => array('name' => lang('创建日期'), 'filed'=>'ctime','diy'=>'text-blue', 'is_time'=>'1','w' => '', 'h' => '', 'is_hide' => ''),
                    'td-6' => array('name' => lang('创建人'), 'filed'=>'create_name','diy'=>'', 'is_time'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                    'td-8' => array('name' => lang('指定回访人'), 'filed'=>'handle_name','diy'=>'', 'is_time'=>'','fun'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                    
                   

                );
                break;
        }
        return $menu_list;
    }

    public function add($uid){
        //权限选择
        $this->check_group($this->rule_qz."_add");
        $this->data=get_user($uid);
        return $this->display();

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
        $this->check_group($this->rule_qz."_edit");
        $id=I('get.id');
        $map=array(
            'uuid'=>$id
        );
        $model   =   D('HuiFang');
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
