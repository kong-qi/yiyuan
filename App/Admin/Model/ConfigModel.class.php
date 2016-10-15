<?php
namespace Admin\Model;
use Think\Model;
class ConfigModel extends Model {
    protected $_validate = array(
        array('name','require','网站名称不能为空',1),
    );
    protected $_auto = array (
        array('uuid','create_uuid',1,'function') ,
        array('ctime','time',1,'function'),
    );

}