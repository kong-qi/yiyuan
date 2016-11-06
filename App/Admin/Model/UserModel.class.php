<?php
namespace Admin\Model;
use Think\Model;
use Think\Model\RelationModel;
class UserModel extends RelationModel {
    protected $_validate = array(
        array('name','require','名称为必须'), //默认情况下用正则进行验证
        //array('ename','require','英文名为必须',), // 在新增的时候验证name字段是否唯一
       
        
    );
    protected $_auto = array (
        array('uuid','create_uuid',1,'function') , // 对password字段在新增和编辑的时候使md5函数处理
        array('ctime','time',1,'function'),
        array('admin_id','create_admin_id',1,'function')
        

    );
    protected $pk='id';
    public function updateTotal($id,$col,$num=1){

    }
    public function updateCount($id,$col,$num = 1){
        $id = (int)$id;
        $total=0;
       	switch ($col) {
       		case 'hf_total':
       			$total=M('HuiFang')->where(array('user_id'=>$id))->count();
       			break;
       		case 'rw_total':
       			$total=M('RenWu')->where(array('user_id'=>$id))->count();
       			break;
       		case 'zx_total':
       			$total=M('ZiXun')->where(array('user_id'=>$id))->count();
       			break;
       		case 'yy_total':
       			$total=M('YuYue')->where(array('user_id'=>$id))->count();
       			break;
       		case 'jz_total':
       			$total=M('JieZhen')->where(array('user_id'=>$id))->count();
       			break;
       		case 'kd_total':
       			$total=M('KaiDan')->where(array('user_id'=>$id))->count();
       			break;
       		case 'xf_total':
       			$total=M('KaiDan')->where(array('user_id'=>$id))->count();
       			break;
       		
       		default:
       			# code...
       			break;
       	}
        $first=$this->execute(" update ".$this->getTableName()." set {$col} ={$total} where ".$this->pk." = '{$id}' ");
        
    }
    
   
}