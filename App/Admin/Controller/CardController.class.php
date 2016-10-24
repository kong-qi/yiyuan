<?php
namespace Admin\Controller;
class CardController extends AuthController {
    protected $onname='优惠券';
    protected $rule_qz='card';
    public function index(){
        $this->check_group('card');
        $model=M(CONTROLLER_NAME);
        $map=array();
        if(IS_GET)
        {
            $map=I('get.');

        }
        $filed='
        cr.uuid as uuid,
		cr.id as id,
		cr.ltime as ltime,
		cr.price as price,
		cr.checked as checked,
		cr.code as code,
		cr.ftime as ftime,
		cr.utime as utime,
		cr.ctime as ctime,
		u1.name as user_name,
		a1.name as admin_name
        ';
		
        $join[] = 'LEFT JOIN __USER__ u1 ON cr.user_id = u1.id';
        $join[] = 'LEFT JOIN __KAI_DAN__ kd ON cr.kd_id = kd.id';
        $join[] = 'LEFT JOIN __ADMIN__ a1 ON cr.admin_id = a1.id';

        $count =  $model->alias('cr')->join($join)->where($map)->count();// 查询满足要求的总记录数
        $pagesize=(C('PAGESIZE'))!=''?C('PAGESIZE'):'20';
        $page=1;
        if(isset($_GET['p']))
        {
            $page=$_GET['p'];
        }
		
        $list =  $model->alias('cr')->field($filed)->join($join)->where($map)->order('cr.ctime desc')->page( $page.','.$pagesize)->select();
		//print_r($list);
        $this->assign('list',$list);// 赋值数据集
        $this->assign('page',page( $count ,$map,$pagesize));// 赋值分页输出

        $this->display();
    }
	
	public function add()
	{
		 $this->check_group('card');
		
		if(IS_POST)
        {
			$model=D('Card');

			$max_num=M('Card')->where('checked=1')->max('code');
			//生产10位数的优惠券码
			
			$b=10000;
			$num = $max_num ? floor($max_num/$b) : 100000;
			$cnum=I('post.num');
			$price=I('post.price');
			$ltime=strtotime(I('post.ltime'));
			
			for ($i=0; $i <$cnum ; $i++) { 
				$code = ($num + $i) . str_pad(mt_rand(0, 9999), 4, '0', STR_PAD_LEFT);
				$dataList[]=array(
					'ltime'=>$ltime,
				    'ctime'=>time(),
				    'uuid'=>create_uuid(),
				    'code_pwd'=>mt_rand(10000000,9999999999),
				   	'code'=>$code,
				   	'price'=>$price,
				   	'checked'=>1,
				    'admin_id'=>session('admin_id')
				);
			}
			
			$result = $model->addAll($dataList);

			if($result) {
			    add_log($this->onname.'：'.$name.'添加成功');
                $backurl=U('Admin/Card/index');
			    $msg=lang('添加成功','handle');
			    echo "<script language='javascript'>var index = parent.layer.getFrameIndex(window.name); parent.layer.msg('".$msg."');window.location.href='".$backurl."';</script>";
			}else{
			    $msg=lang('添加失败','handle');
			    add_log($this->onname.'：'.$name.'添加失败');
			    echo "<script language='javascript'>var index = parent.layer.getFrameIndex(window.name); parent.layer.msg('".$msg."');</script>";
			}
		}
		else
		{
			
		    $this->display();	
		}
	}
	public function send($id){
 		if(IS_POST)
        {
            $model =D(CONTROLLER_NAME);

            if($model->create()) {
                $data=$model->create();
                $data['utime']=time();
                
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
        }else
 		{

 		}
		 $m=M('Card')->find($id);
		 $this->data=$m;
		 $this->display();	
	}
	
     public  function del(){
        //权限选择
         $this->check_group('card');
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
         $this->check_group('card');
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
    
}