<?php
namespace Admin\Controller;
class AdminController extends AuthController {
    protected $onname='管理员';

    public function index(){
        //权限选择
        
        $this->check_group('admin');
        $model=M(CONTROLLER_NAME);
        $map=array();
        if(IS_GET)
        {
            $map=I('get.');

        }
        $rule=M('AdminGroup')->where(array('checked'=>1))->select();
        $newrule=array();
        foreach ($rule as $key => $v)
        {

            $newrule[$v['id']]=$v['name'];

        }
        ;
        $map['groupid']=array('neq',12);
        $count =  $model->where($map)->count();// 查询满足要求的总记录数
        $pagesize=(C('PAGESIZE'))!=''?C('PAGESIZE'):'20';
   
        $page=1;
        if(isset($_GET['p']))
        {
            $page=$_GET['p'];
        }

        $list =  $model->where($map)->order('sort desc,id desc')->page( $page.','.$pagesize)->select();
        $this->assign('list',$list);// 赋值数据集
        $this->assign('gpdata',$newrule);
        $this->assign('page',page( $count ,$map,$pagesize));// 赋值分页输出

        $this->display();
    }
    public function pwd(){
        if(IS_POST)
        {
            $model =D(CONTROLLER_NAME);

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
                    $backurl=U(MODULE_NAME."/".CONTROLLER_NAME."/index");
                    echo "<script language='javascript'>var index = parent.layer.getFrameIndex(window.name); parent.layer.msg('".$msg."');parent.window.location.reload();parent.layer.close(index);</script>";
                    //return  $this->success(lang('更新成功','handle'),'/Admin/edit',$id);
                }else{

                    $msg=lang('数据一样无更新','handle');
                    echo "<script language='javascript'>var index = parent.layer.getFrameIndex(window.name); parent.layer.msg('".$msg."');parent.layer.close(index);</script>";
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
            $rule=M('AdminGroup')->where(array('checked'=>1))->select();
            $this->rule=$rule;
            if($model) {
                $this->data =  $model;// 模板变量赋值
            }else{
                return $this->error(lang('数据错误','handle'));
            }
            $this->display();
        }
    }
    public function add(){

        //权限选择
        $save=array('12','1');
        $this->saveArea=$save;
        $this->check_group('admin_add');
        if(IS_POST)
        {

            $model=D(CONTROLLER_NAME);

            if($model->create())
            {
                $data=$model->create();
                $result =    $model->add();
                if($result) {
                    add_log($this->onname.'：'.$data['name'].'添加成功');
                    $msg=lang('添加成功','handle');
                    $backurl=U(MODULE_NAME."/".CONTROLLER_NAME."/index");
                    echo "<script language='javascript'>var index = parent.layer.getFrameIndex(window.name); parent.layer.msg('".$msg."');parent.window.location='".$backurl."';;parent.layer.close(index);</script>";
                }else{
                    add_log($this->onname.'：'.$data['name'].'添加失败','/Admin/add');
                    $msg=lang('添加失败','handle');
                    $backurl=U(MODULE_NAME."/".CONTROLLER_NAME."/index");
                    echo "<script language='javascript'>var index = parent.layer.getFrameIndex(window.name); parent.layer.msg('".$msg."');parent.window.location='".$backurl."';parent.layer.close(index);</script>";
                }
            }else
            {
                $this->error($model->getError());
            }
        }else
        {
            $rule=M('AdminGroup')->where(array('checked'=>1))->select();
            $this->assign('rule',$rule);// 赋值数据集
            $this->display();
        }

    }
    public function yslist(){
        //权限选择
        $this->onname='医生列表';
        $this->check_group('admin');
        $model=M(CONTROLLER_NAME);
        $map=array();
        $map['groupid']=12;
        
        $rule=M('AdminGroup')->select();
        $newrule=array();
        foreach ($rule as $key => $v)
        {
            $newrule[$v['id']]=$v['name'];

        }
        ;
        $count =  $model->where($map)->count();// 查询满足要求的总记录数
        $pagesize=(C('PAGESIZE'))!=''?C('PAGESIZE'):'20';
        
        $page=1;
        if(isset($_GET['p']))
        {
            $page=$_GET['p'];
        }

        $list =  $model->where($map)->order('sort desc,id desc')->page( $page.','.$pagesize)->select();
        $this->assign('list',$list);// 赋值数据集
        $this->assign('gpdata',$newrule);
        $this->assign('page',page( $count ,$map,$pagesize));// 赋值分页输出

        $this->display();
    }
    public function ysadd(){
        //权限选择
        $this->check_group('admin_add');

        if(IS_POST)
        {

            $model=D(CONTROLLER_NAME);
             $backurl=U(MODULE_NAME."/".CONTROLLER_NAME."/yslist");
            if($model->create())
            {
                $data=$model->create();
                $result =    $model->add();
                if($result) {
                    add_log($this->onname.'：'.$data['name'].'添加成功');
                    $msg=lang('添加成功','handle');
                   
                    echo "<script language='javascript'>var index = parent.layer.getFrameIndex(window.name);parent.window.location='".$backurl."'; parent.layer.msg('".$msg."');</script>";
                }else{
                    add_log($this->onname.'：'.$data['name'].'添加失败','/Admin/add');
                    $msg=lang('添加失败','handle');
                    $backurl=U(MODULE_NAME."/".CONTROLLER_NAME."/ysadd");
                    echo "<script language='javascript'>var index = parent.layer.getFrameIndex(window.name); parent.layer.msg('".$msg."');parent.window.location='".$backurl."';</script>";
                }
            }else
            {
                $this->error($model->getError());
            }
        }else
        {
            $rule=M('AdminGroup')->where(array('checked'=>1))->select();
            $this->assign('rule',$rule);// 赋值数据集
            $this->display();
        }

    }
    public function ysedit(){
        //权限选择
        $save=array('12');
        $this->saveArea=$save;
        $this->check_group('admin_edit');
        if(IS_POST)
        {
            $model =D(CONTROLLER_NAME);

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
                    $backurl=U(MODULE_NAME."/".CONTROLLER_NAME."/index");
                    echo "<script language='javascript'>var index = parent.layer.getFrameIndex(window.name); parent.layer.msg('".$msg."'); parent.location.reload();;parent.layer.close(index);</script>";
                    //return  $this->success(lang('更新成功','handle'),'/Admin/edit',$id);
                }else{

                    $msg=lang('数据一样无更新','handle');
                    echo "<script language='javascript'>var index = parent.layer.getFrameIndex(window.name); parent.layer.msg('".$msg."');parent.layer.close(index);;parent.layer.close(index)</script>";
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
            $rule=M('AdminGroup')->where(array('checked'=>1))->select();
            $this->rule=$rule;
            if($model) {
                $this->data =  $model;// 模板变量赋值
            }else{
                return $this->error(lang('数据错误','handle'));
            }
            $this->display();
        }
    }
    public function edit(){
        //权限选择
        $save=array('12','1');
        $this->saveArea=$save;
        $this->check_group('admin_edit');
        if(IS_POST)
        {
            $model =D(CONTROLLER_NAME);

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
                    $backurl=U(MODULE_NAME."/".CONTROLLER_NAME."/index");
                    echo "<script language='javascript'>var index = parent.layer.getFrameIndex(window.name); parent.layer.msg('".$msg."'); parent.location.reload();;parent.layer.close(index);</script>";
                    //return  $this->success(lang('更新成功','handle'),'/Admin/edit',$id);
                }else{

                    $msg=lang('数据一样无更新','handle');
                    echo "<script language='javascript'>var index = parent.layer.getFrameIndex(window.name); parent.layer.msg('".$msg."');parent.layer.close(index);;parent.layer.close(index)</script>";
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
            $rule=M('AdminGroup')->where(array('checked'=>1))->select();
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
        $this->check_group('admin_del');
        $id=I('get.id');
        $map=array(
            'uuid'=>$id
        );
        $model   =   D(CONTROLLER_NAME);
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
            $msg=lang('更新成功','handle');
            $backurl=U(MODULE_NAME."/".CONTROLLER_NAME."/index");
            echo "<script language='javascript'>var index = parent.layer.getFrameIndex(window.name); parent.layer.msg('".$msg."');parent.layer.close(index);window.location='".$backurl."';</script>";
        }else
        {
            $msg=lang('更新失败','handle');
            return  $this->success(lang('更新失败','handle'));
            $backurl=U(MODULE_NAME."/".CONTROLLER_NAME."/index ");
            echo "<script language='javascript'>var index = parent.layer.getFrameIndex(window.name); parent.layer.msg('".$msg."');parent.layer.close(index);window.location='".$backurl."';</script>";
        }
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
             $highestColumnIndex = \PHPExcel_Cell::columnIndexFromString($highestColumn);//将，A,B,D,这些转为0,1,2,3,4
            //从第一行开始读取数据
            for($j=2;$j<=$highestRow;$j++){
                //从A列读取数据
                for($k=0;$k<=$highestColumnIndex;$k++){
                    // 读取单元格
                   
                    
                        $strs[$k]=$objPHPExcel->getActiveSheet()->getCellByColumnAndRow($k, $j)->getValue();
                    

                }
                $data[] = array(
                 'a'=>"$strs[0]",
                 'b'=>"$strs[1]",
                 'c'=>"$strs[2]",
                 'd'=>"$strs[3]",
                );
            }
            
            foreach ($data as $k=>$v)
            {
                $dataList[] = array(
                    'ctime' => time(),
                    'uuid' => create_uuid(),
                    'name' => $v['a'],
                    'realname'=>$v['b'],
                    'pwd' => sha1($v['c']),
                    'groupid' => $v['d'],
                    'uniqid'=>create_uniqid(),
                    'checked'=>1
                );
            }
            
           
            $model = D('Admin');
            $result = $model->addAll($dataList);
            if ($result) {

                $msg = lang('添加成功', 'handle');
                echo "<script language='javascript'>var index = parent.layer.getFrameIndex(window.name); parent.layer.msg('" . $msg . "');;parent.window.location.reload()</script>";
            } else {
                $msg = lang('添加失败', 'handle');

                echo "<script language='javascript'>var index = parent.layer.getFrameIndex(window.name); parent.layer.msg('" . $msg . "');;parent.window.location.reload()</script>";
            }

        }
        $this->display();
    }
   
}