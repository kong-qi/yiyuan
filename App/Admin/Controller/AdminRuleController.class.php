<?php
namespace Admin\Controller;
class AdminRuleController extends AuthController
{

    protected $onname = '权限规则';

    protected $notice = array(
        'index' => '<p>游客：只能访问，不能操作</p>'
    );

    public function index()
    {
        $this->check_group('root');
        $model = M('AdminRule');
        $map = array();
        if (IS_GET) {
            $map = I('get.');
            if (isset($map['name'])) {
                $map['name'] = array(
                    'like', '%' . $map['name'] . '%'
                );
            }

        }

        $count = $model->where($map)->count();// 查询满足要求的总记录数
        $pagesize = 200;

        $page = 1;
        if (isset($_GET['p'])) {
            $page = $_GET['p'];
        }

        $list = $model->where($map)->page($page . ',' . $pagesize)->order('sort desc')->select();
        $list = get_tree_option($list, 0);

        $this->assign('list', $list);// 赋值数据集
        $this->assign('page', page($count, $map, $pagesize));// 赋值分页输出
        $this->display();
    }

    public function add()
    {
        $this->check_group('root');
        if (IS_POST) {
            $this->check_group('root');
            $model = D('AdminRule');
            if ($data=$model->create()) {
                $result = $model->add();
                if ($result) {
                    add_log($this->onname.'：'.$data['name'].'添加成功');
                    return $this->success('添加成功！', __CONTROLLER__);
                } else {
                    add_log($this->onname.'：'.$data['name'].'添加失败');
                    add_log($this->onname.'：添加失败');
                    return $this->error('添加失败！');
                }
            } else {
                $this->error($model->getError());
            }
        } else {
            $this->getRule();
            $this->display();
        }

    }

    public function add2()
    {
        $this->check_group('root');
        if (IS_POST) {
            $this->check_group('root');
            $name = I('post.name');;

            for ($k = 0; $k <= 2; $k++) {
                $model = D('AdminRule');


                if ($model->create()) {
                    $data = $model->create();


                    if ($k == 0) {
                        $data['ename'] = $model->ename . "_add";
                        $data['name'] = "添加" . $name;
                    }
                    if ($k == 1) {
                        $data['ename'] = $model->ename . "_edit";
                        $data['name'] = "编辑" . $name;

                    }
                    if ($k == 2) {
                        $data['ename'] = $model->ename . "_del";
                        $data['name'] = "删除" . $name;

                    }
                    // print_r($model->create($data));
                    $result = $model->add($data);
                    if ($result) {

                    } else {
                        //return $this->error('写入错误！');
                    }
                } else {
                    $this->error($model->getError());
                }
            }
            return $this->success('操作成功！', __CONTROLLER__);

        } else {
            $this->getRule();
            $this->display();
        }

    }

    public function getRule($name = 'data')
    {
        $model = D('AdminRule');
        $data = $model->select();
        $data = get_tree_option($data, '0');
        return $this->assign($name, $data);
    }

    public function edit()
    {
        $this->check_group('root');
        if (IS_POST) {
            $model = D('AdminRule');
            if ($data=$model->create()) {
                $result = $model->save();
                if ($result) {
                    add_log($this->onname.'：'.$data['name'].'更新成功');
                    return $this->success('更新成功！');
                } else {
                    return $this->error('数据一样，暂无更新');
                }
            } else {
                return $this->error($model->getError());
            }
        } else {
            $id = I('get.id');
            $map = array(
                'uuid' => $id
            );

            $model = M('AdminRule')->where($map)->find();

            if ($model) {
                $this->data = $model;// 模板变量赋值
            } else {
                return $this->error('数据错误');
            }
            $this->getRule('lanmu');
            $this->display();
        }
    }

    public function del()
    {
        $this->check_group('root');
        $id = I('get.id');
        $map = array(
            'uuid' => $id
        );
        $model = D('AdminRule');
        $data=$model->where($map)->find();
        $result = $model->where($map)->delete();
        if ($result) {
            add_log($this->onname.'：'.$data['name'].'更新成功');
            return $this->success('删除成功');
        }
        add_log($this->onname.'：删除失败');
        return $this->error('删除失败');
    }

    public function handle()
    {

        $uuid = I('get.uuid');
        $token = I('get.token');
        $ajaxtype = I('get.type');

        if (!check_token($token)) {
            echo json_encode(array(
                'error' => 1,
                'msg' => '非法操作'
            ));
        }

        $model = D('AdminRule');
        switch ($ajaxtype) {
            case "del":
                $map = array(
                    'uuid' => array(
                        'in',
                        $uuid
                    )
                );

                $result = $model->where($map)->delete();
                if ($result) {
                    echo json_encode(array(
                        'error' => 0,
                        'msg' => '删除成功'
                    ));
                } else {
                    echo json_encode(array(
                        'error' => 1,
                        'msg' => '删除失败'
                    ));
                }

                break;
        }


    }
}
