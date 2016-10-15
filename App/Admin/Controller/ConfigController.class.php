<?php
namespace Admin\Controller;
class ConfigController extends AuthController{
    protected $onname='网站配置';

    public function index(){
        $this->check_group('root');
        if(IS_POST)
        {
            $this->check_group('site_config');
            $model   = D('Config');

            $map=array(
                'basename'=>'kongqi'
            );

            if($model->create()) {
                $result =   $model->where($map)->save();
                if($result) {
                    return  $this->success('更新操作成功！');
                }else{
                    return $this->error('数据一样，暂无更新');
                }
            }else{
                return $this->error($model->getError());
            }
        }else{
            $id='kongqi';
            $map=array(
                'basename'=>$id
            );

            $model   =  M('Config')->where($map)->find();


            if($model) {
                $this->data =  $model;// 模板变量赋值
            }else{
                $data=array(
                    'id'=>1,
                    'uuid'=>create_uuid()
                );
                if(!M('Config')->add($data))
                {
                    return $this->error('数据错误');
                }

            }
            $this->display();
        }
    }
}