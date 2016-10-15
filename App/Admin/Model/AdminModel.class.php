<?php
namespace Admin\Model;
use Think\Model;
class AdminModel extends Model {
    protected $_validate = array(
        array('name','require','帐号名称已经存在！',1,'unique',3),
        array('pwd','require','密码不能为空',1,'',1), //默认情况下用正则进行验证

    );
    protected $_auto = array (
        array('uuid','create_uuid',1,'function') , // 对password字段在新增和编辑的时候使md5函数处理
        array('ctime','time',1,'function'),
        array('checked','1',1,'string'),
        array('uniqid','create_uniqid',1,'function'),
      
        array('pwd','sha1',1,'function')

    );

}