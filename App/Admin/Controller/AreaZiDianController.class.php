<?php
namespace Admin\Controller;
class AreaZiDianController extends AuthController
{
    protected $onname = '区域';
    protected $rule_qz = 'area';

    public function index($type)
    {
        //权限选择

        $this->check_group($type);
        $model = M('Area');
        $map = array();
        if (IS_GET) {
            $map = I('get.');

        }

        $list = $model->where($map)->order('sort desc,id desc')->select();

        $list = get_tree_option($list, 0);


        $this->assign('list', $list);// 赋值数据集


        $this->display();

    }

    public function add()
    {
        //权限选择
        $this->check_group($this->rule_qz);
        if (IS_POST) {

            $model = D('Area');

            $name = I('post.name');


            $fid = I('post.fid');
            if ($name == '') {
                $msg = lang('名字不能为空', 'handle');
                echo "<script language='javascript'>var index = parent.layer.getFrameIndex(window.name); parent.layer.msg('" . $msg . "');</script>";
                exit();
            }
            /*if($crad=='')
            {
                $msg=lang('预约号前缀不能为空','handle');
                echo "<script language='javascript'>var index = parent.layer.getFrameIndex(window.name); parent.layer.msg('".$msg."');</script>";
                exit();
            }*/

            $pname = explode(",", str_replace("，", ",", $name));


            foreach ($pname as $k => $v) {
                $dataList[] = array(
                    'ctime' => time(),
                    'uuid' => create_uuid(),
                    'name' => $v,
                    'type' => 'area',

                    'fid' => $fid,
                    'admin_id' => session('admin_id')
                );
            }

            $result = $model->addAll($dataList);

            if ($result) {
                add_log($this->onname . '：' . $name . '添加成功');
                $msg = lang('添加成功', 'handle');
                echo "<script language='javascript'>var index = parent.layer.getFrameIndex(window.name); parent.layer.msg('" . $msg . "');</script>";
            } else {
                $msg = lang('添加失败', 'handle');
                add_log($this->onname . '：' . $name . '添加失败', '/Admin/add');
                echo "<script language='javascript'>var index = parent.layer.getFrameIndex(window.name); parent.layer.msg('" . $msg . "');</script>";
            }


        } else {
            $rule = get_tree_option($this->getList(), 0);
            $this->assign('rule', $rule);// 赋值数据集
            $this->display();
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

            //从第一行开始读取数据
            for($j=1;$j<=$highestRow;$j++){
                //从A列读取数据
                for($k='A';$k<=$highestColumn;$k++){
                    // 读取单元格
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
                    'name' => $v[1],
                    'type' => 'area',
                    'fid' => $v[0],
                    'admin_id' => session('admin_id')
                );
            }



            $model = D('Area');
            $result = $model->addAll($dataList);
            if ($result) {

                $msg = lang('添加成功', 'handle');
                echo "<script language='javascript'>var index = parent.layer.getFrameIndex(window.name); parent.layer.msg('" . $msg . "');</script>";
            } else {
                $msg = lang('添加失败', 'handle');

                echo "<script language='javascript'>var index = parent.layer.getFrameIndex(window.name); parent.layer.msg('" . $msg . "');</script>";
            }




        }
        $this->display();
    }

    public function getList()
    {
        $rule = M('Area')->where(array('checked' => 1, 'type' => 'area','fid'=>0))->select();
        return $rule;

    }

    public function edit()
    {
        //权限选择

        $this->check_group($this->rule_qz);
        if (IS_POST) {
            $model = D('Area');

            if ($model->create()) {
                $data = $model->create();
                $id = $data['id'];
                if (($data['pwd']) != '') {
                    $data['pwd'] = sha1($data['pwd']);
                } else {
                    unset($data['pwd']);
                }

                $result = $model->save($data);

                if ($result) {
                    add_log($this->onname . '：' . $data['name'] . '更新成功');
                    $msg = lang('更新成功', 'handle');
                    echo "<script language='javascript'>var index = parent.layer.getFrameIndex(window.name); parent.layer.msg('" . $msg . "');</script>";
                    //return  $this->success(lang('更新成功','handle'),'/Admin/edit',$id);
                } else {
                    $msg = lang('数据一样无更新', 'handle');
                    echo "<script language='javascript'>var index = parent.layer.getFrameIndex(window.name); parent.layer.msg('" . $msg . "');</script>";
                }
            } else {
                return $this->error($model->getError());
            }
        } else {
            $id = I('get.uuid');
            $map = array(
                'uuid' => $id
            );

            $model = M('Area')->where($map)->find();
            $rule = get_tree_option($this->getList(), 0);
            $this->rule = $rule;
            if ($model) {
                $this->data = $model;// 模板变量赋值
            } else {
                return $this->error(lang('数据错误', 'handle'));
            }
            $this->display();
        }
    }

    public function del()
    {
        //权限选择
        $this->check_group($this->rule_qz);
        $id = I('get.id');
        $map = array(
            'uuid' => $id
        );
        $model = D('Area');
        $data = $model->where($map)->find();
        $result = $model->where($map)->delete();
        if ($result) {
            add_log($this->onname . '：' . $data['name'] . '删除成功');
            return $this->success(lang('删除成功', 'handle'));;
        }
        add_log($this->onname . '：' . $data['name'] . '删除失败');
        return $this->error(lang('删除失败', 'handle'));;
    }

    public function handle($id)
    {
        //权限选择
        $this->check_group($this->rule_qz);
        $model = M('Area');
        $type = I('get.type');
        if ($type == 'true') {
            $status = 1;
        } else {
            $status = 0;
        }
        $data['id'] = $id;
        $data['checked'] = $status;

        if ($model->save($data)) {
            add_log($this->onname . '：设置状态成功');
            return $this->success(lang('更新成功', 'handle'));
        } else {
            add_log($this->onname . '：设置状态失败');
            return $this->error(lang('更新失败', 'handle'));
        }
    }
}
