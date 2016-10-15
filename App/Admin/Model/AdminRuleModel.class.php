<?php
namespace Admin\Model;
use Think\Model;
class AdminRuleModel extends Model {
    protected $_validate = array(
        array('name','require','中文名必须'), //默认情况下用正则进行验证
        array('ename','require','英文名必须存在',), // 在新增的时候验证name字段是否唯一
    );
    protected $_auto = array (
        array('uuid','create_uuid',1,'function') , // 对password字段在新增和编辑的时候使md5函数处理
    );
}