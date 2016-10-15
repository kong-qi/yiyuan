<?php
namespace Admin\Model;
use Think\Model;
class LanMuModel extends Model {
    protected $_validate = array(
        array('name','require','名称为必须'), //默认情况下用正则进行验证
        //array('ename','require','英文名为必须',), // 在新增的时候验证name字段是否唯一
       
        
    );
    protected $_auto = array (
        array('uuid','create_uuid',1,'function') , // 对password字段在新增和编辑的时候使md5函数处理
        array('ctime','time',1,'function')

    );
}