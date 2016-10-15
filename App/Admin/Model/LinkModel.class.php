<?php
namespace Admin\Model;
use Think\Model;
class linkModel extends Model {
    protected $_validate = array(
        array('name','require','名称不能为空'), //默认情况下用正则进行验证
        array('url','require','地址不能为空'),

    );
    protected $_auto = array (
        array('uuid','create_uuid',1,'function') , // 对password字段在新增和编辑的时候使md5函数处理
        array('ctime','time',1,'function'),


    );
}