<?php
namespace Admin\Controller;
class YuYueController extends AuthController {
    protected $onname='添加预约';
    protected $rule_qz='yuyue';


    public function index(){
        ;
        //权限选择
       /* print_r( get_date('bw'));
        print_r(get_date('sw'));
        print_r(get_date('sm'));
        print_r(get_date('by'));
        print_r(get_date('diy',-1));
        print_r(get_date('year'));*/
        $this->check_group($this->rule_qz);
        $map=array();
        //自己查看自己的
        if(!check_group('root'))
        {
            $map['y1.admin_id']=session('admin_id');
        }

        

        if(IS_GET)
        {
            $getdata=I('get.');

            $y_arr=array(
                    'ks_id',
                    'kst_id',
                    'kstt_id',
                    'ly_id',
                    'lyt_id',
                    'lytt_id',
                    'area_id',
                    'areat_id',
                    'is_fz',
                    'yx_id',
                    'zx_id',
                    'user_id',
                    'admin_id',
                    'status'
                    
                );
            //print_r($getdata);
            foreach ($getdata as $key => $v) {
                if($v!='')
                {

                    if(in_array($key, $y_arr))
                    {

                     $map["y1.".$key]=$v;
                    }
                }
               
            }
            //时间1476806399
            if($getdata['djstime']!='' && $getdata['djetime'] !='')
            {
                $getdata['djstime'].=" 00:00:00";

                $getdata['djetime'].=" 23:59:59";
               
                $timestr = strtotime($getdata['djstime']) . "," . strtotime($getdata['djetime']);
               
                $map['y1.ctime']=array('between', $timestr);

            }
            if($getdata['ystime']!='' && $getdata['yetime'] !='')
            {
                $getdata['ystime'].=" 00:00:00";
                $getdata['yetime'].=" 23:59:59";

                $timestr2 = strtotime($getdata['ystime']) . "," . strtotime($getdata['yetime']);

                $map['y1.ydatetime']=$map2['ydatetime']=array('between', $timestr2);

            }


            if(I('get.user_id')!='')
            {
                $map['y1.user_id']=I('get.user_id');

            }
            if(I('get.keyword')!='')
            {
                $key=I('get.keyword');
                 $map['_string'] = "u1.name like '%".$key."%' or u1.tel like '%".$key."%' or y1.ynumber like '%".$key."%'";
            }
           
            //print_r($map);
            //判断是否是网站人员
            //获取
            if(I('get.is_website'))
            {
                $website_arr=M('LanMu')->field('id')->where(array('type'=>'bingren','is_website'=>1,'fid'=>array('neq',0)))->select();
                $wb_arrid=array();
                if(count($website_arr)>0)
                {
                    foreach ( $website_arr as $key => $value) {
                        $wb_arrid[]=$value['id'];
                    }
                }
                if(count( $wb_arrid)>0)
                {
                    $map['y1.lyall_id']=array('in', $wb_arrid);
                }
                
                

            }

        }


        $model=M('YuYue');
        $filed = '
            y1.uuid as yuuid,
            y1.zx_mark,
            y1.ynumber,y1.id as yid,y1.admin_id,y1.status as ystatus,y1.ydatetime,y1.ctime as yuctime,y1.zx_content,y1.mark as ymark,
            u1.name as user_name,u1.sex,u1.uuid as user_uuid,u1.id as user_id,
            ly1.name as ly_name,ly2.name as lyt_name, ly3.name as lytt_name,
            a1.name as admin_name,
            k1.name as ks_name,
            k2.name as kst_name,
            k3.name as kstt_name,
            zx.name as zx_name,
            yx.name as yx_name,
            wz.name as web_name,
            ae1.name as ae_name,
            ae2.name as ae2_name
        ';
        //管理会员用户
        $join[] = '__USER__ u1 ON y1.user_id = u1.id';
        //关联ADMIN
        $join[] = 'LEFT JOIN __ADMIN__ a1 ON y1.admin_id = a1.id';
        //关科室1
        $join[] = 'LEFT JOIN __KE_SHI__ k1 ON y1.ks_id = k1.id';
        //关科室2
        $join[] = 'LEFT JOIN __KE_SHI__ k2 ON y1.kst_id = k2.id';
        //关科室3
        $join[] = 'LEFT JOIN __KE_SHI__ k3 ON y1.kstt_id = k3.id';
        //关咨询工具
        $join[] = 'LEFT JOIN __LAN_MU__ zx ON y1.zx_id = zx.id';
        //网站
        $join[] = 'LEFT JOIN __LAN_MU__ wz ON y1.web_id = wz.id';
        //意向
        $join[] = 'LEFT JOIN __LAN_MU__ yx ON y1.zx_id = yx.id';
        //病人来源
        $join[] = 'LEFT JOIN __LAN_MU__ ly1 ON y1.ly_id = ly1.id';
        $join[] = 'LEFT JOIN __LAN_MU__ ly2 ON y1.lyt_id = ly2.id';
        $join[] = 'LEFT JOIN __LAN_MU__ ly3 ON y1.lytt_id = ly3.id';

        //区域
        $join[] = 'LEFT JOIN __AREA__ ae1 ON y1.area_id = ae1.id';
        //意向
        $join[] = 'LEFT JOIN __AREA__ ae2 ON y1.areat_id = ae2.id';

       
        $count =  $model->alias('y1')->join($join)->where($map)->count();// 查询满足要求的总记录数
       
        
       
      
        
        $pagesize=(C('PAGESIZE'))!=''?C('PAGESIZE'):'50';



        $page=1;
        if(isset($_GET['p']))
        {
            $page=$_GET['p'];
        }
        
        // $list =$model->where($map);

       /* if(I('sorttype'))
        {
            $sorttype=I('sorttype');
            $sort=I('sort');
            if($sort!=='none')
            {
                $list=$list->order(
                    array(
                        $sorttype=>$sort
                    )
                );
            }

        }else
        {
            $list=$list->order('sort desc,id desc');
        }*/

        $list = $model->alias('y1')->field($filed)->join($join)->order('y1.ydatetime desc,y1.id desc')->where($map)->page( $page.','.$pagesize)->select();
     
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
    public function getDetail(){

    }
    public function add(){

        //权限选择
        $this->check_group($this->rule_qz);
        if(IS_POST)
        {

            $model=D("YuYue");
            $postdata=I('post.');
            if($model->create())
            {
                $data=$model->create();
                //写入数据拉
                //预约好前缀获取
                $yy_qz=M('LanMu')->where(array('type'=>'bingren','id'=>$data['ly_id']))->find();
                $data['ynumber']=$yy_qz['card'].create_ynumber();
                $data['ytime']=  $data['ytime'].":00";
                $data['ydatetime']=$data['ydate'].' '.$data['ytime'];
                $data['ydatetime']=strtotime($data['ydatetime']);

                $data['status']='1';

                //插入到用户里面
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
                    $user[$uv]=$postdata[$uv];
                }
                $user['ctime']=time();
                $user['uuid']=create_uuid();
                $has_user_id=$postdata['user_id'];
                //如果前端被忽略，后端查询病返回,并且检查是否存在
                if($has_user_id=='')
                {
                    $muser=M('User')->where(array('name'=>$user['name'],'tel'=>$user['tel']))->find();
                    if(count($muser)>0)
                    {
                       $has_user_id=$muser['id'];
                    }
                }else
                {
                    $muser=M('User')->find($has_user_id);
                    if(count($muser)<0)
                    {
                        $has_user_id='';
                    }
                }
                //清楚空的
                foreach ($data as $ak=>$av)
                {
                    if($av=='')
                    {
                        unset($data[$ak]);
                    }

                }
                //用户存在时
                if($has_user_id!='')
                {
                    $result =    $model->add($data);
                    if($result ) {
                        M()->commit();
                        add_log($this->onname.'：'.$data['name'].'添加成功');
                        $msg=lang('添加成功','handle');
                        return $this->success($msg."预约号为：". $data['ynumber'],'/Admin/YuYue/add');
                        //echo "<script language='javascript'>var index = parent.layer.getFrameIndex(window.name); parent.layer.msg('".$msg."');</script>";


                    }else{
                        M()->rollback();
                        add_log($this->onname.'：'.$data['name'].'添加失败','/Admin/YuYue/add');
                        $msg=lang('添加失败','handle');
                        return $this->success($msg);
                    }
                }else
                {
                    M()->startTrans();

                    $user_result=M('User')->data($user)->add();
                    $data['user_id']=$user_result;
                    $result =    $model->add($data);
                    if($result && $user_result) {
                        M()->commit();
                        add_log($this->onname.'：'.$data['name'].'添加成功');
                        $msg=lang('添加成功','handle');
                        return $this->success($msg."预约号为：". $data['ynumber']);
                        //echo "<script language='javascript'>var index = parent.layer.getFrameIndex(window.name); parent.layer.msg('".$msg."');</script>";


                    }else{
                        M()->rollback();
                        add_log($this->onname.'：'.$data['name'].'添加失败','/Admin/add');
                        $msg=lang('添加失败','handle');
                        return $this->success($msg);
                    }
                }

            }else
            {

                $this->error($model->getError());
            }
        }else
        {
            $rule=get_tree_option($this->getList(),0);
            $this->assign('rule',$rule);// 赋值数据集

            if(I("get.tpl"))
            {
                return $this->display(I("get.tpl"));
            }else
            {
                return $this->display();
            }
            
        }

    }
    public function addUser($data){

        $result=M('User')->data($data)->add();

        if($result){
            return ($result);
        }else
        {
            return false;
        }
    }
    public function getList(){
        $rule=M('KeShi')->where(array('checked'=>1,'type'=>'keshi','fid'=>0))->select();
        return $rule;

    }
    public function ajaxList($id){
        $tfid=I('get.tfid');

        $rule=M('KeShi')->where(array('checked'=>1,'type'=>'keshi','fid'=>$id))->select();
        $str='';
        if(count($rule)>0)
        {
            foreach ($rule as $k=>$v)
            {
                if($tfid==$v['id'])
                {
                    $str.="<option selected='selected' value='".$v['id']."'>".$v['name']."</option>";
                }else
                {
                    $str.="<option value='".$v['id']."'>".$v['name']."</option>";
                }

            }
        }
        return $this->ajaxReturn($str);
    }
    public function excel()
    {
        if (IS_POST) {
            $file=I('post.file');
            error_reporting(E_ALL); //开启错误
            set_time_limit(0); //脚本不超时
            date_default_timezone_set('Europe/London'); //设置时间
            header('Content-type: text/html; charset=utf-8');

            vendor('PHPExcel.Classes.PHPExcel');
            $type = pathinfo($file);
            $type = strtolower($type["extension"]);
            $type=$type==='csv' ? $type : 'Excel5';
            ini_set('max_execution_time', '0');
            $file = WEB_ROOT.pic_url($file,'','file');
            // 判断使用哪种格式
            $objReader = \PHPExcel_IOFactory::createReader('Excel2007');
            $objPHPExcel = $objReader->load($file);
            $sheet = $objPHPExcel->getSheet(0);
            // 取得总行数
            $highestRow = $sheet->getHighestRow();
            // 取得总列数
            $highestColumn = $sheet->getHighestColumn();
            //循环读取excel文件,读取一条,插入一条

            //从第一行开始读取数据
            for($j=1;$j<=$highestRow;$j++){
                //从A列读取数据
                for($k='A';$k<=$highestColumn;$k++){
                    // 读取单元格
                    //去掉第一行说明
                    if($j!=1)
                    {
                        $data[$j][]=$objPHPExcel->getActiveSheet()->getCell("$k$j")->getValue();
                    }

                }
            }
            foreach ($data as $k=>$v)
            {
                $dataList[] = array(
                    'ctime' => time(),
                    'uuid' => create_uuid(),
                    'name' => $v[0],
                    'fid' => $v[1],
                    'tfid'=>$v[2],
                    'ticket_name'=>$v[3],
                    'price'=>$v[4],
                    'danwei'=>$v[5],
                    'is_update'=>$v[6],
                    'code'=>$v[7],
                    'admin_id' => session('admin_id')
                );
            }




          $model = M('Price');
            $result = $model->addAll($dataList);
            if ($result) {

                $msg = lang('导入成功', 'handle');
                echo "<script language='javascript'>var index = parent.layer.getFrameIndex(window.name); parent.layer.msg('" . $msg . "');</script>";
            } else {
                $msg = lang('导入失败', 'handle');

                echo "<script language='javascript'>var index = parent.layer.getFrameIndex(window.name); parent.layer.msg('" . $msg . "');</script>";
            }




        }
        $this->display();
    }

    public function edit(){
        //权限选择
        $base=I('get.base');
        $this->burl=U('Admin/YuYue/index')."?".base64_decode($base);

        $this->check_group('yushen');
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
            //自己查看自己的
            if(!check_group('root'))
            {
                $map['admin_id']=session('admin_id');
            }
            $map=array(
                'uuid'=>$id
            );

            $model   = D('YuYue')->relation(true)->where($map)->find();

            if($model) {
                $this->data =  $model;// 模板变量赋值
            }else{
                return $this->error(lang('数据错误','handle'));
            }
            if(I("get.tpl"))
            {
                return $this->display(I("get.tpl"));
            }else
            {
                return $this->display();
            }
            
        }
    }
    public function all(){
        echo json_decode();
        $id=I('get.id');
        //自己查看自己的
        if(!check_group('root'))
        {
            $map['admin_id']=session('admin_id');
        }
        $map=array(
            'uuid'=>$id
        );

        $model   = D('YuYue')->relation(true)->where($map)->find();

        if($model) {
            $this->data =  $model;// 模板变量赋值
        }else{
            return $this->error(lang('数据错误','handle'));
        }

        return $this->display();
    }
    public  function del(){
        //权限选择
        $this->check_group('yushen');
        $id=I('get.id');
        $map=array(
            'uuid'=>$id
        );
        $model   =   D('Price');
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
        $this->check_group('yushen');
        $model =M('Price');
        $type=I('get.type');
        if($type=='true')
        {
            $status=1;
        }else
        {
            $status=0;
        }
        $data['id'] =$id;
        $filed=I('get.filed');
        $logmsg='';
        if($filed)
        {
            $data[$filed] = $status;
            $logmsg='是否金额可修改';
        }else
        {
            $data['checked'] = $status;
            $logmsg='设置状态';
        }


        if($model->save($data)){
            add_log($this->onname.'：'.$logmsg.'成功');
            return  $this->success(lang('更新成功','handle'));
        }else
        {
            add_log($this->onname.'：'.$logmsg.'失败');
            return $this->error(lang('更新失败','handle'));
        }
    }
}
