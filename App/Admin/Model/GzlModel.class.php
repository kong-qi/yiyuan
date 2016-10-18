<?php
namespace Admin\Model;
use Think\Model;
use Think\Model\RelationModel;
class GzlModel extends  RelationModel{
    protected $_validate = array(
        array('name','require','名称为必须'), //默认情况下用正则进行验证
        //array('ename','require','英文名为必须',), // 在新增的时候验证name字段是否唯一
       
        
    );
    protected $_auto = array (
        array('uuid','create_uuid',1,'function') , // 对password字段在新增和编辑的时候使md5函数处理
        array('ctime','time',1,'function')


    );
     protected $_link = array(
        'Gname'=>array(
            'mapping_type'      => self::BELONGS_TO,
            'class_name'        => 'LanMu',
            'foreign_key'=>'gj_id',
            'as_fields' => 'name:gname',
            'mapping_name'=>'lanmugj'

            ),

         

    );

}