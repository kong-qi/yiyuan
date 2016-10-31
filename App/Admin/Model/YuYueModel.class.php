<?php
namespace Admin\Model;
use Think\Model;
use Think\Model\RelationModel;
class YuYueModel extends RelationModel {
    protected $_validate = array(
        array('name','require','名称为必须'), //默认情况下用正则进行验证
        //array('ename','require','英文名为必须',), // 在新增的时候验证name字段是否唯一
       
        
    );
    protected $_auto = array (
        array('uuid','create_uuid',1,'function') , // 对password字段在新增和编辑的时候使md5函数处理
        array('ctime','time',1,'function'),
       

    );
    //关联用户
    protected $_link = array(
        'User'=>array(
            'mapping_type'      => self::BELONGS_TO,
            'class_name'        => 'User',
            'foreign_key'=>'user_id',


            ),
        'Bing'=>array(
            'mapping_type'      => self::BELONGS_TO,
            'class_name'        => 'KeShi',
            'foreign_key'=>'kstt_id',


            ),
        );
}