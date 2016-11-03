<?php
namespace Admin\Controller;
class HuiFangController extends AuthController {
    protected $onname='回访管理';
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
        $this->check_group("huifangset_add");
        $isclose=I('post.close_frame');
        if(IS_POST)
        {

            $tabid=I('post.bktab');
            $model=D(CONTROLLER_NAME);

            if($model->create())
            {
                
                $data=$model->create();
                $data['ntime']=time();
                $data['status']=1;
                $result =    $model->add($data);
                $renwu_id=$data['renwu_id'];
                if($renwu_id!='')
                {
                    $rdata=array('id'=>$renwu_id,'status'=>1,'hftime'=>time());

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
        $join[] = 'LEFT JOIN __USER__ u1 ON h1.user_id = u1.id';
        $join[] = 'LEFT JOIN __LAN_MU__ l2 ON l2.id = h1.type';//类型
        $join[] = 'LEFT JOIN __LAN_MU__ l3 ON l3.id = h1.ways';//方式
        $join[] = 'LEFT JOIN __LAN_MU__ l4 ON l4.id = h1.result_cont';//结果
        $join[] = 'LEFT JOIN __LAN_MU__ l5 ON l5.id = h1.goplace';//去向
        $join[] = 'LEFT JOIN __ADMIN__ a1 ON h1.admin_id = a1.id';
        $filed = '
           h1.ctime,
           h1.status as status,
           h1.uuid as uuid,
           h1.content as content,
           l2.name as type,
           l3.name as ways,
           l5.name as goplace,
           u1.name as user_name ,
           u1.tel as tel,
           u1.id as user_id,
           h1.name as name,
           l4.name as result_cont,
           a1.realname as admin_name
         ';
        if(I('get.keyword')!='')
        {
             $key=I('get.keyword');
            $map['_string'] = "u1.name like '%" . $key . "%' or u1.tel like '%" . $key . "%' or h1.name like '%" . $key . "%'";
        }
        //是否只能查看自己的
        if(!check_group('root'))
        {
            if(check_group('huifangset_only'))
            {
                 $map['_string']="h1.admin_id ='".session('admin_id')."'";
            }
        }
         $status='';
         if(I('get.status')!='')
         {
            $status=I('get.status');
            $map['status']=$status;
         }
         //预约时间为预到时间
         $getdata=I('get.');
         if ($getdata['crstime'] != '' && $getdata['cretime'] != '') {
             $getdata['crstime'] .= " 00:00:00";
             $getdata['cretime'] .= " 23:59:59";
            
             $timestr2 = strtotime($getdata['crstime']) . "," . strtotime($getdata['cretime']);

             $map['h1.ctime'] = array('between', $timestr2);

         }
         if(I('get.is_search')==1)
         {
            $sdata=I('get.');
            $ndata=array();
            unset($sdata['crstime']);
            unset($sdata['cretime']);
            unset($sdata['keyword']);
            unset($sdata['is_search']);
            foreach ($sdata as $key => $value) {
                if($value!='')
                {
                    $ndata["h1.".$key]=$value;
                }
                
            }
            $map=$ndata+$map;
            
         }
         
         $count = $model->alias('h1')->join($join)->where($map)->count();// 查询满足要求的总记录数
         $pagesize = (C('PAGESIZE')) != '' ? C('PAGESIZE') : '20';
         $page = 1;
         if (isset($_GET['p'])) {
             $page = $_GET['p'];
         }

         $list = $model->alias('h1')->field($filed)->join($join)->order('h1.ctime desc,h1.id desc')->where($map)->page($page . ',' . $pagesize)->select();
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
                    'td-3' => array('name' => lang('回访类型'), 'filed'=>'type','diy'=>'', 'is_time'=>'','fun'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                    'td-4' => array('name' => lang('回访状态'), 'filed'=>'status','diy'=>'', 'is_time'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                    'td-5' => array('name' => lang('回访方式'), 'filed'=>'ways','diy'=>'', 'is_time'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                    'td-6' => array('name' => lang('回访主题'), 'filed'=>'name','diy'=>'', 'is_time'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                    'td-7' => array('name' => lang('回访结果'), 'filed'=>'result_cont','diy'=>'', 'is_time'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                    'td-8' => array('name' => lang('客户流向'), 'filed'=>'goplace','diy'=>'', 'is_time'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                    'td-9' => array('name' => lang('回访时间'), 'filed'=>'ctime','diy'=>'text-info', 'is_time'=>'1','fun'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                    'td-10' => array('name' => lang('回访人'), 'filed'=>'admin_name','diy'=>'', 'is_time'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                  
                    
                   

                );
                break;
        }
        return $menu_list;
    }
    public function show($id){
        $m=M('HuiFang')->where(array('uuid'=>$id))->find();
        $this->assign('data',$m);
        $this->display();
    }
    public function add($uid){
        //权限选择
        $this->check_group($this->rule_qz."_add");
        $rwid=I('get.rw_id');
        $lx_id='';
        if($rwid!='')
        {
            $renwu=M('RenWu')->where(array('id'=>$rwid))->find();
            $lx_id=$renwu['type_id'];
        }
        $this->assign('type_id',$lx_id);
        $this->data=get_user($uid);
        return $this->display();

    }
    public function edit(){
        //权限选择

        $this->check_group('huifang_edit');
        if(IS_POST)
        {
            $model =D('HuiFang');

            if($model->create()) {
                $data=$model->create();
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
            $id=I('get.id');
            $map=array(
                'uuid'=>$id
            );

            $model= M('HuiFang')->where($map)->find();

            if($model) {
                $this->data =  $model;// 模板变量赋值

            }else{
                return $this->error(lang('数据错误','handle'));
            }
            $this->user=get_user($model->user_id);
            $this->display();
        }
    }
    public function rwedit(){
        //权限选择

        $this->check_group('huifang_edit');
        if(IS_POST)
        {
            $model =D('HuiFang');

            if($model->create()) {
                $data=$model->create();

                $result =   $model->save($data);

               
                if($result) {
                    add_log($this->onname.'：'.$data['name'].'更新成功');
                    $msg=lang('更新成功','handle');
                    echo "<script language='javascript'>var index = parent.layer.getFrameIndex(window.name); parent.layer.msg('".$msg."');parent.window.location.reload();</script>";
                    //return  $this->success(lang('更新成功','handle'),'/Admin/edit',$id);
                }else{
                    $msg=lang('数据一样无更新','handle');
                    echo "<script language='javascript'>var index = parent.layer.getFrameIndex(window.name); parent.layer.msg('".$msg."');</script>";
                }
            }else{
                return $this->error($model->getError());
            }
        }else{
            $id=I('get.id');
            $map=array(
                'renwu_id'=>$id
            );

            $model= M('HuiFang')->where($map)->find();

            if($model) {
                $this->data =  $model;// 模板变量赋值

            }else{
                return $this->error(lang('数据错误','handle'));
            }
            $this->user=get_user($model->user_id);
            $this->display("edit");
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
