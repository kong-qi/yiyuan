<?php
namespace Admin\Controller;
class NewsController extends AuthController {
    protected $onname='信息管理';
    protected $share_root=1;
    public function index(){
        $this->check_group('news');
        //权限选择
        $lmid='';
        if(I('get.lmid'))
        {
            $lmid=I('get.lmid');
        }
        if(!$lmid)
        {
            $map=array(
                'checked'=>'1'
            );
            $model=M('LanMu')->where($map)->select();
            $sdata=get_tree_option($model,0);
            $this->assign('list',$sdata);

            $this->display('chose');
        }else
        {

            //栏目信息
            $lmmsg=M('LanMu')->where(array('id'=>$lmid))->find();
            $this->assign('onname',$lmmsg['name']);
            if(!$lmmsg)
            {
                return $this->error('数据错误');
            }
            //模板选择这里开始
            if($lmmsg['list'])
            {
                $model=M(CONTROLLER_NAME);
                $map=array(
                    'lmid'=>$lmid
                );

                $count =  $model->where($map)->count();// 查询满足要求的总记录数
                $pagesize=(C('PAGESIZE'))!=''?C('PAGESIZE'):'20';
                $page=1;
                if(isset($_GET['p']))
                {
                    $page=$_GET['p'];
                }
                $list =  $model->where($map)->order('sort desc,id desc')->page( $page.','.$pagesize)->select();
                $this->assign('list',$list);// 赋值数据集
             
                $this->assign('lmmsg',$lmmsg);

                $this->assign('page',page( $count ,$map,$pagesize));// 赋值分页输出


                $this->display();
                
            }else
            {
                    $this->assign('lmmsg',$lmmsg);
                    //判断单页信息是否存在
                    $news=M('News')->where(array('lmid'=>$lmmsg['id']))->order('id desc')->find();
                    if($news)
                    {

                        $this->assign('data',$news);
                        $this->display('Tpl:'.$lmmsg['model'].'_edit');
                    }else
                    {
                        switch ($lmmsg['model'])
                        {
                            case "company":
                                $xiaoguo=M('LanMuExtends')->where(array('fid'=>'150','checked'=>1))->order('sort desc,id desc')->select();

                                $this->assign('fenlei',$xiaoguo);

                                break;

                        }

                        $this->display('Tpl:'.$lmmsg['model']);
                    }


                    
            }
            /*switch ($lmmsg['model']){
                case 'danye':
                case 'room':
                    $this->assign('lmmsg',$lmmsg);
                    //判断单页信息是否存在
                    $news=M('News')->where(array('lmid'=>$lmmsg['id']))->order('id desc')->find();
                    if($news)
                    {

                        $this->assign('data',$news);
                        $this->display('Tpl:'.$lmmsg['model'].'_edit');
                    }else
                    {
                        $this->display('Tpl:'.$lmmsg['model']);
                    }


                    break;
                case 'cp':
                case 'news':
                    $model=M(CONTROLLER_NAME);
                    $map=array(
                        'lmid'=>$lmid
                    );

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
                    $this->assign('lmmsg',$lmmsg);
                    $this->assign('page',page( $count ,$map,$pagesize));// 赋值分页输出
                    $this->display();
                    break;

            }*/

        }

    }
    public  function del(){
        $this->check_group('news_del');
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
    public function add(){
        $this->check_group('news_add');
        $lmid='';
        if(I('get.lmid'))
        {
            $lmid=I('get.lmid');
        }else
        {
            return $this->error('数据错误');
        }
        if(IS_POST)
        {
            $model= D(CONTROLLER_NAME);

            if($model->create())
            {
                $result =    $model->add();
                if($result) {
                    return $this->success('添加成功！',U(__CONTROLLER__.'/index/',array('lmid'=>$lmid)));
                }else{
                    return $this->error('写入错误！');
                }
            }else
            {
                $this->error($model->getError());
            }
        }else
        {
            $lmmsg=get_lanmu_msg($lmid);
            $this->assign('lmmsg',$lmmsg);
            //查询分类

            switch ($lmmsg['model'])
            {
                case "company":
                    $xiaoguo=M('LanMuExtends')->where(array('fid'=>'150','checked'=>1))->order('sort desc,id desc')->select();

                    $this->assign('fenlei',$xiaoguo);

                    break;

            }
            $this->assign('onname',$lmmsg['name']);
            $this->display('Tpl:'.$lmmsg['model']);

           /* if($lmmsg['list'])
            {

            }else
            {

            }
            switch ($lmmsg['model'])
            {
                case 'news':
                    $this->display('Tpl:'.$lmmsg['model']);
                    break;
                case 'cp':
                    $this->display('Tpl:'.$lmmsg['model']);
                    break;
                case defalut:
                    $this->display('Tpl:'.$lmmsg['model']."_edit");
                break;
            }*/

        }

    }

    public function edit(){

        $this->check_group('news_edit');
        if(IS_POST)
        {
            $model= D(CONTROLLER_NAME);

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
        }else
        {
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
            $lmid=$model['lmid'];
            $lmmsg=get_lanmu_msg($lmid);
            $this->assign('lmmsg',$lmmsg);
            //查询分类

            switch ($lmmsg['model'])
            {
                case "company":
                    $xiaoguo=M('LanMuExtends')->where(array('fid'=>'150','checked'=>1))->order('sort desc,id desc')->select();

                    $this->assign('fenlei',$xiaoguo);

                    break;

            }
            /*switch ($lmmsg['model'])
            {
                case 'defalut':
                    $this->display('Tpl:'.$lmmsg['model']."_edit");
                    break;
                case 'cp':
                    $this->display('Tpl:'.$lmmsg['model']."_edit");
                    break;
                case defalut:
                    $this->display('Tpl:'.$lmmsg['model']."_edit");
                break;
            }*/
            $this->assign('onname',$lmmsg['name']);
            $this->display('Tpl:'.$lmmsg['model']."_edit");
        }
    }
}