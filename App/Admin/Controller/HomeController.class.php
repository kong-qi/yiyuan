<?php
namespace Admin\Controller;

class HomeController extends  AuthController {
    public function index(){
    	
       $this->display();
    }
    public function homeTongJi(){
    	//echo date("Y-m-d",strtotime("last month"));
    	//print_r(D('Home')->getGzl_days());
    	$day_arr=array();
        for($i=10;$i>=0;$i--)
        {
            $day_arr[]=get_days(-$i);
        }
        $home=D('Home');
     
      
        //有效咨询
        $has_zixun=$home->getGzl_days();
        $has_zixun_arr=$this->toTongJiArray($day_arr,$has_zixun);
        //有效预约
        $has_yuyue=$home->getYuYue_days();
        $has_yuyue_arr=$this->toTongJiArray($day_arr,$has_yuyue);
        //到院
        $has_yuyue_come=$home->getYuYue_days('dztime');
        $has_yuyue_come=$this->toTongJiArray($day_arr,$has_yuyue);
        
        $has_arr=array(
        		json_encode($has_zixun_arr),
        		json_encode($has_yuyue_arr),
        		json_encode($has_yuyue_come)

        	);
        
        $day_arr_josn=json_encode($day_arr);
     
        $adv=$this->toAdvChert($day_arr);
        $has_adv_chengben=$adv['chenben'];
        $has_adv_data=$adv['total'];
        $data=array(
        	'day_arr_json'=>$day_arr_josn,
        	'has_arr'=>$has_arr,
            
           
        	);
        //消费统计
        
        if(check_group('login_adv_shichang')){
            $data['adv_arr']=$has_adv_data;
            $data['adv_chenben']=$has_adv_chengben;
            $data['gj_title']=json_encode(array_values($adv['gj_name']));
        }
        if (date("w", time()) == 0) {
            $fistday = date("Y-m-d", mktime(0, 0, 0, date("m"), date("d") - date("w") + 1 - 7, date("Y")));
            $lastday = date("Y-m-d", mktime(23, 59, 59, date("m"), date("d") - date("w") + 7 - 7, date("Y")));
        } else {
            $fistday = date("Y-m-d", mktime(0, 0, 0, date("m"), date("d") - date("w") + 1, date("Y")));
            $lastday = date("Y-m-d", mktime(23, 59, 59, date("m"), date("d") - date("w") + 7, date("Y")));
        }

       

    	$this->assign($data);
    	$this->display('home_tongji');
    }
    public function toTongJiArray($day_arr,$data){
    	$has_zixun_arr=array();
    	foreach ($day_arr as $key => $value) {
        	if(array_key_exists($value,$data))
        	{
        		$has_zixun_arr[$key]=$data[$value];
        	}else
        	{
        		$has_zixun_arr[$key]=0;
        	}
        }
        return $has_zixun_arr;
    }
    public function toAdvChert($day_arr){
        $home=D('home');
        //工作量
        $adv=array();
        $adv_day=array();
        $adv_chengben=array();
        $advobj=$home->getToolsToal();
        
        if(count($advobj['data'])>0)
        {
            foreach ($advobj['data'] as $key => $value) {
                /*if(array_key_exists($value['cdate'],$adv_day))
                {

                }*/
                $adv_day[$value['xf_id']][$value['cdate']]=$value['total'];
                $adv_chengben[$value['xf_id']][$value['cdate']]=$value['chengben'];

            }
        }
        
        $adv_chenben_day=array();
        $adv_chenben_gj=array();
        $adv_chenben_has=array();
        $has_adv_chengben=array();

        $adv_day_day=array();
        $adv_has==array();
        $has_adv_data=array();

        if(count($adv_day)>0)
        {
            foreach ($adv_day as $key => $value) {
                # code...
                $adv_day_day[$key]=$this-> toTongJiArray($day_arr,$value);
                

            }
            foreach ($adv_chengben as $key => $value) {
                # code...
                
                $adv_chenben_day[$key]= $this-> toTongJiArray($day_arr,$value);

            }
            foreach ($advobj['gj_name'] as $key => $value) {
                if(array_key_exists($key,$adv_day_day))
                {
                    
                    $adv_has= $adv_day_day[$key];
                }else
                {
                    $adv_has=array(0,0,0,0,0,0,0,0,0,0);
                }
                //成本
                if(array_key_exists($key,$adv_chenben_day))
                {
                    
                    $adv_chenben_has= $adv_chenben_day[$key];
                }else
                {
                    $adv_chenben_has=array(0,0,0,0,0,0,0,0,0,0);
                }

                $has_adv_data[]=array(
                        'name'=>lang($value),
                        'type'=>'bar',
                        'data'=>$adv_has,
                        'itemStyle'=>array(
                                'normal'=>array(
                                    'label'=>array(
                                            'show'=>'true'
                                        )
                                    )
                            ),
                        'markPoint'=>array(
                                'data'=>array(
                                    array(
                                            'type'=>'max',
                                            'name'=>lang('最大值')
                                        ),
                                    array(
                                            'type'=>'min',
                                            'name'=>lang('最小值')
                                        )
                                    )
                            ),
                        'markLine'=>array(
                                'data'=>array(
                                    array(
                                            'type'=>"average",
                                            'name'=>lang('最小值')
                                        )
                                )
                            )
                    );
                $has_adv_chengben[]=array(
                        'name'=>lang($value),
                        'type'=>'bar',
                        'data'=>$adv_chenben_has,
                        'itemStyle'=>array(
                                'normal'=>array(
                                    'label'=>array(
                                            'show'=>'true'
                                        )
                                    )
                            ),
                        'markPoint'=>array(
                                'data'=>array(
                                    array(
                                            'type'=>'max',
                                            'name'=>lang('最大值')
                                        ),
                                    array(
                                            'type'=>'min',
                                            'name'=>lang('最小值')
                                        )
                                    )
                            ),
                        'markLine'=>array(
                                'data'=>array(
                                    array(
                                            'type'=>"average",
                                            'name'=>lang('最小值')
                                        )
                                )
                            )
                    );
                
            }
        }else
        {
            foreach ($advobj['gj_name'] as $key => $value) {
                
                $has_adv_data[]=array(
                        'name'=>lang($value),
                        'type'=>'bar',
                        'data'=>array(0,0,0,0,0,0,0,0,0,0),
                        'itemStyle'=>array(
                                'normal'=>array(
                                    'label'=>array(
                                            'show'=>'true'
                                        )
                                    )
                            ),
                        'markPoint'=>array(
                                'data'=>array(
                                    array(
                                            'type'=>'max',
                                            'name'=>lang('最大值')
                                        ),
                                    array(
                                            'type'=>'min',
                                            'name'=>lang('最小值')
                                        )
                                    )
                            ),
                        'markLine'=>array(
                                'data'=>array(
                                    array(
                                            'type'=>"average",
                                            'name'=>lang('最小值')
                                        )
                                )
                            )
                    );
                $has_adv_chengben[]=array(
                        'name'=>lang($value),
                        'type'=>'bar',
                        'data'=>array(0,0,0,0,0,0,0,0,0,0),
                        'itemStyle'=>array(
                                'normal'=>array(
                                    'label'=>array(
                                            'show'=>'true'
                                        )
                                    )
                            ),
                        'markPoint'=>array(
                                'data'=>array(
                                    array(
                                            'type'=>'max',
                                            'name'=>lang('最大值')
                                        ),
                                    array(
                                            'type'=>'min',
                                            'name'=>lang('最小值')
                                        )
                                    )
                            ),
                        'markLine'=>array(
                                'data'=>array(
                                    array(
                                            'type'=>"average",
                                            'name'=>lang('最小值')
                                        )
                                )
                            )
                    );
            }
        }
        $data_all=array(
            'total'=>$has_adv_data,
            'chenben'=>$has_adv_chengben,
            'gj_name'=>$advobj['gj_name']
            );
        return $data_all;
    }
}