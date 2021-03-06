<?php
namespace Admin\Controller;
class JiGouController extends AuthController {

    protected $onname=('合作机构');
    protected $rule_qz='jiugouset';
    
    public function index(){
        //权限选择
        $this->check_group('jiugouset');
        $model=M('LanMu');
        $map=array(
            'jg.fid'=>array('in',jigou_id()),
            'jg.is_jigou'=>1,
            'jg.type'=>'bingren'
        );
        $filed = '
            jg.uuid as uuid,jg.id as id,
            jg.hetong as hetong,jg.code as code,jg.name as name,jg.funame as funame,jg.futel as futel,jg.checked as checked,jg.buname as buname,
            lb.name as lbname,
            pj.name as pjname,
            ae.name as area_name,
            ae2.name as area2_name,
            zt.name as status_name
            
            
        ';
        //关联评级
        $join[] = 'LEFT JOIN __LAN_MU__ pj ON jg.pj_id = pj.id';
        $join[] = 'LEFT JOIN __LAN_MU__ zt ON jg.join_id = zt.id';
        $join[] = 'LEFT JOIN __AREA__ ae ON jg.area_id = ae.id';
        $join[] = 'LEFT JOIN __AREA__ ae2 ON jg.areat_id = ae2.id';
        $join[] = 'LEFT JOIN __LAN_MU__ lb ON jg.fid = lb.id';

        $count =  $model->alias('jg')->join($join)->where($map)->count();// 查询满足要求的总记录数
        $page=1;
        if(isset($_GET['p']))
        {
            $page=$_GET['p'];
        }

        $pagesize=(C('PAGESIZE'))!=''?C('PAGESIZE'):'50';
        $pagesize=I('get.pagesize')==''?$pagesize:I('get.pagesize');
        $list = $model->alias('jg')->field($filed)->join($join)->order('jg.id desc')->where($map)->page( $page.','.$pagesize)->select();

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
    public function add(){
        //权限选择
        $this->check_group($this->rule_qz."_add");
        if(IS_POST)
        {

            $model=D('LanMu');
            if($model->create())
            {
                $data=$model->create();
                $data['type']='bingren';
                $data['admin_id']=session('admin_id');
                $data['is_jigou']='1';
                $result =    $model->add($data);

                if($result) {
                    $msg=lang('添加成功');
                    add_log($this->onname.'：'.$data['name'].'添加成功');
                    return $this->success($msg);
                }else{
                    add_log($this->onname.'：'.$data['name'].'添加失败');
                    $msg=lang('添加失败');
                    return $this->error($msg);
                }
            }else
            {
                $this->error($model->getError());
            }
        }else
        {




            $this->display();
        }

    }
    public function edit(){
        //权限选择
        $this->check_group($this->rule_qz."_edit");
        if(IS_POST)
        {
            $model =D('LanMu');
           
            if($data=$model->create()) {
                $result =   $model->save();
               if($result) {
                   $msg=lang('更新成功');
                   add_log($this->onname.'：'.$data['name'].'更新成功');
                    return  $this->success($msg,__CONTROLLER__);
                }else{
                   $msg=lang('数据一样，无需更新');
                    return $this->error($msg);
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
                return $this->error('数据错误');
            }
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
        $model   =  D('LanMu');
        $data=$model->where($map)->find();
        $result=$model->where($map)->delete();
        if($result)
        {
            add_log($this->onname.'：'.$data['name'].'删除成功');
            $msg=lang('删除成功');
            return  $this->success($msg);
        }
        add_log($this->onname.'：'.$data['name'].'删除失败');
        $msg=lang('删除成功');
        return $this->error($msg);
    }
    public function handle($id){
        //权限选择
        $this->check_group($this->rule_qz."_edit");
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
            return  $this->success(lang('更新成功','handle'));
        }else
        {
            return $this->error(lang('更新失败','handle'));
        }
    }
}