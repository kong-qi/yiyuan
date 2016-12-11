<?php
namespace Admin\Model;
use Think\Model;
use Think\Model\RelationModel;
class KaiDanModel extends  RelationModel  {
    protected $_validate = array(
        /*array('name','require','名称为必须'), //默认情况下用正则进行验证
        array('fid','require','名称为必须'), //默认情况下用正则进行验证*/
        //array('ename','require','英文名为必须',), // 在新增的时候验证name字段是否唯一
       
        
    );
    protected $pk='id';
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
        'Jiez'=>array(
            'mapping_type'      => self::BELONGS_TO,
            'class_name'        => 'JieZhen',
            'foreign_key'=>'jz_id',
        ),
    );

    public function updateCount($id,$col,$num = 1){
        $id = (int)$id;
        $total=0;
        switch ($col) {
            case 'kd_total':
                $total=M('KaiDan')->where(array('jz_id'=>$id))->count();
                break;
            
            
            default:
                # code...
                break;
        }
        $first=$this->execute(" update __PREFIX__jie_zhen set {$col} ={$total} where ".$this->pk." = '{$id}' ");
        
    }
}