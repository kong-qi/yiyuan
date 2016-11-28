<?php
namespace Admin\Controller;
class RenWuController extends AuthController {
    protected $onname='回访任务';
    protected $rule_qz='hfrenwu';



    public function getlistrenwuadd(){
        $isclose=1;

        if(IS_POST)
        {
            $this->check_group($this->rule_qz."_add");
            $this->onname='回访任务';
            $tabid=I('post.bktab');
            $model=D('RenWu');

            if($model->create())
            {

               if(!check_token(I('post.token')))
               {
                   $msg=lang('操作错误');
                   $backurl = U("Admin/RenWu/add");
                   return  $this->error($msg ,$backurl);
               }
                
                $data=$model->create();
                $data['rtime']=strtotime($data['rtime']);
                $result =$model->add( $data);
                if($result) {
                    D('User')->updateCount($data['user_id'],'rw_total');
                    add_log($this->onname.'：添加成功',$data['user_id']);
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
        $this->assign('status',I('get.status'));
        $this->check_group("huihfrenwu_list");
        $this->assign('adminer',get_adder('ren_wu'));
        $model = M('RenWu');
        //是否只能查看自己的
        if(!check_group('root'))
        {
            if(check_group('hfrenwu_only') && check_group('hfrenwu_only_handle'))
            {
                 $map['_string']="rewu.admin_id ='".session('admin_id')."' or rewu.handle_id ='".session('admin_id')."'";
            }elseif(check_group('hfrenwu_only'))
            {
                 $map['_string']="rewu.admin_id ='".session('admin_id')."'";
            }
        }
        if(I('get.handle_id')!='')
        {
            $map['rewu.handle_id']=$this->handle_id=I('get.handle_id');

        }
        if(I('get.admin_id')!='')
        {
            $map['rewu.admin_id']=$this->admin_id=I('get.admin_id');
        }

        //预约时间为预到时间
        $getdata=I('get.');
        if ($getdata['crstime'] != '' && $getdata['cretime'] != '') {
            $getdata['crstime'] .= " 00:00:00";
            $getdata['cretime'] .= " 23:59:59";
           
            $timestr2 = strtotime($getdata['crstime']) . "," . strtotime($getdata['cretime']);

            $map['rewu.ctime'] = array('between', $timestr2);

        }
        
        if ($getdata['dzstime'] != '' && $getdata['dzetime'] != '') {
            $getdata['dzstime'] .= " 00:00:00";
            $getdata['dzetime'] .= " 23:59:59";

            $timestr2 = strtotime($getdata['dzstime']) . "," . strtotime($getdata['dzetime']);

            $map['rewu.rtime'] = array('between', $timestr2);

        }

        //创建时间为预约时间
        if ($getdata['hfstime'] != '' && $getdata['hfetime'] != '') {
            $getdata['hfstime'] .= " 00:00:00";

            $getdata['hfetime'] .= " 23:59:59";

            $timestr = strtotime($getdata['hfstime']) . "," . strtotime($getdata['hfetime']);

            $map['rewu.hftime'] = array('between', $timestr);

        }


        $join[] = 'LEFT JOIN __USER__ u1 ON rewu.user_id = u1.id';
        $join[] = 'LEFT JOIN __ADMIN__ a1 ON rewu.admin_id = a1.id';
        $join[] = 'LEFT JOIN __ADMIN__ fp ON rewu.handle_id = fp.id';
        $join[] = 'LEFT JOIN __LAN_MU__ lx ON lx.id = rewu.type_id';
        $filed ='
        rewu.id as id,
        rewu.status as status,
        rewu.uuid as uuid,
        rewu.name as name,
        lx.name as type_text,
        rewu.ctime as ctime,
        rewu.rtime as rtime,
        rewu.hftime as hftime,
        a1.realname as create_name,
        fp.realname as handle_name,
        u1.name as user_name,
        u1.tel as tel,
        u1.id as user_id
        ';
        if(I('get.keyword')!='')
        {
             $key=I('get.keyword');
            $map['_string'] = "u1.name like '%" . $key . "%' or u1.tel like '%" . $key . "%' or rewu.name like '%" . $key . "%'";
        }
        $type_arr='';
         $status='';
         if(I('get.status')!='')
         {
            $status=I('get.status');
            $map['status']=$status;
            if( $status!=0)
            {
                 $type_arr='yhf';
            }
           
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
         
         $menu_list = $this->getFiledArray($type_arr);
         
         $this->menu_list = $menu_list;

        
        $this->assign('page', page($count, $map, $pagesize));// 赋值分页输出
        
        $this->display();

    }
    public function getFiledArray($type){
        switch ($type) {
           case 'yhf':
                $menu_list = array(

                    
                    'td-1' => array('name' => lang('姓名'), 'filed'=>'user_name','diy'=>'text-blue','is_time'=>'','fun'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                    'td-2' => array('name' => lang('联系电话'), 'filed'=>'tel','diy'=>'', 'is_time'=>'','fun'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                    'td-3' => array('name' => lang('回访类型'), 'filed'=>'type_text','diy'=>'', 'is_time'=>'','fun'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                    
                     'td-4' => array('name' => lang('回访主题'), 'filed'=>'name','diy'=>'', 'is_time'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                    
                    'td-7' => array('name' => lang('回访时间'), 'filed'=>'hftime','diy'=>'text-info', 'is_time'=>'1','fun'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                    'td-8' => array('name' => lang('回访人'), 'filed'=>'handle_name','diy'=>'', 'is_time'=>'','fun'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                    'td-5' => array('name' => lang('创建日期'), 'filed'=>'ctime','diy'=>'text-blue', 'is_time'=>'1','w' => '', 'h' => '', 'is_hide' => ''),
                    'td-6' => array('name' => lang('创建人'), 'filed'=>'create_name','diy'=>'', 'is_time'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                    
                    
                   

                );
           break;
           case 'all':
                $menu_list = array(

                    
                    'td-1' => array('name' => lang('姓名'), 'filed'=>'user_name','diy'=>'text-blue','is_time'=>'','fun'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                    'td-1' => array('name' => lang('年龄'), 'filed'=>'age','diy'=>'text-blue','is_time'=>'','fun'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                    'td-2' => array('name' => lang('联系电话'), 'filed'=>'tel','diy'=>'', 'is_time'=>'','fun'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                    'td-17' => array('name' => lang('预约状态'), 'filed'=>'ystatus','diy'=>'', 'is_time'=>'','fun'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                    
                                            
                    
                   

                );
           break;
            
            default:
                $menu_list = array(

                    
                    'td-1' => array('name' => lang('姓名'), 'filed'=>'user_name','diy'=>'text-blue','is_time'=>'','fun'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                    'td-2' => array('name' => lang('联系电话'), 'filed'=>'tel','diy'=>'', 'is_time'=>'','fun'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                    'td-3' => array('name' => lang('回访类型'), 'filed'=>'type_text','diy'=>'', 'is_time'=>'','fun'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                    
                     'td-4' => array('name' => lang('回访主题'), 'filed'=>'name','diy'=>'', 'is_time'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                    
                    'td-7' => array('name' => lang('待回访日期'), 'filed'=>'rtime','diy'=>'text-info', 'is_time'=>'1','fun'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                    'td-8' => array('name' => lang('回访人'), 'filed'=>'handle_name','diy'=>'', 'is_time'=>'','fun'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                    'td-5' => array('name' => lang('创建日期'), 'filed'=>'ctime','diy'=>'text-blue', 'is_time'=>'1','w' => '', 'h' => '', 'is_hide' => ''),
                    'td-6' => array('name' => lang('创建人'), 'filed'=>'create_name','diy'=>'', 'is_time'=>'','w' => '', 'h' => '', 'is_hide' => ''),
                    
                    
                   

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

        $this->check_group($this->rule_qz."_edit");
        if(IS_POST)
        {
            $model =D('RenWu');

            if($model->create()) {

                $data=$model->create();
                $data['rtime']=strtotime($data['rtime']);
                $result =   $model->save($data);

                if($result) {
                    add_log($this->onname.'：更新成功',$data['user_id']);
                    $msg=lang('更新成功','handle');
                    
                     echo "<script language='javascript'>var index = parent.layer.getFrameIndex(window.name); parent.layer.msg('".$msg."'); parent.location.reload();;parent.layer.close(index);</script>";
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

            $model=M('RenWu')->where($map)->find();

            if($model) {
                $this->data =  $model;// 模板变量赋值

            }else{
                return $this->error(lang('数据错误','handle'));
            }
            $user=get_user($model['user_id']);
           
            $this->assign('user_name',$user['name']);
            $this->display();
        }
    }
    public  function del(){
        //权限选择
        $this->check_group($this->rule_qz."_del");

        $id=I('get.id');
        $map=array(
            'uuid'=>$id
        );
        //自己删除自己
        if(!check_group('root'))
        {
            if(check_group('hfrenwu_only'))
            {
                $map['admin_id']=session('admin_id');
            }
        }
        $model   =   D('RenWu');
        $data=$model->where($map)->find();
        $result=$model->where($map)->delete();
        if($result)
        {
            D('User')->updateCount($data['user_id'],'rw_total');
            add_log($this->onname.'：删除成功',$data['user_id']);
            return  $this->success(lang('删除成功','handle'));;
        }
        add_log($this->onname.'：删除失败',$data['user_id']);
        return $this->error(lang('删除失败','handle'));;
    }
    public function handle($id){
        //权限选择
        $this->check_group($this->rule_qz."_edit");;
        $model =M('RenWu');
        $type=I('get.type');
        if($type=='true')
        {
            $status=1;
        }else
        {
            $status=0;
        }
        $data['id'] =$id;
        $data['status'] = $status;


        if($model->save($data)){
            add_log($this->onname.'：设置状态成功',$data['user_id']);
            return  $this->success(lang('更新成功','handle'));
        }else
        {
            add_log($this->onname.'：设置状态失败',$data['user_id']);
            return $this->error(lang('更新失败','handle'));
        }
    }
}
