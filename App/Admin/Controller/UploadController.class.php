<?php
namespace Admin\Controller;
use Think\Controller;
use \Admin\Model\UploadExtendsHandlerModel;
class UploadController extends Controller
{
    public function uploadFilePost()
    {
        $defalut=array(
            'type'=>'image',
            'dir'=>'images',
            'sthumbs'=>C('THUMBS_TRUE'),
            'smax_width'=>'',
            'smax_height'=>''
        );
        if (I('get.')) {
            $defalut=  I('get.')+$defalut;
        }
        //允许上传的正则设置
        // 'accept_file_types' => '/.+$/i',
        switch ($defalut['type'])
        {
            case 'image':
                $zz=  '/\.(gif|jpe?g|png|bmp)$/i';
                break;
            case 'file':
                $zz='/\.(pdf|doc?|docx|xlsx|xls|txt|zip|rar|gz|ppt|png|zip|rar|exe|apk|PDF)$/i';
                break;
            case 'flash':
                $zz='/\.(swf|flv)$/i';
                break;
            case 'vedio':
                $zz='/\.(swf|flv|wav|wmv|mp3|mp4|avi|rmvb|rm|wma)$/i';
                break;
            case 'all':
                $zz=  '/\.(gif|jpe?g|png|bmp|pdf|doc?|xlsx|xls|txt|zip|rar|gz|ppt|png|swf|flv|wav|wmv|mp3|mp4|avi|rmvb|rm|wma|swf|flv)$/i';
                break;
            default :
                $zz=  '/\.(gif|jpe?g|png|bmp)$/i';

                break;
        };
        //压缩缩略图
        $samllimg=C('THUMBS_SMALL');
        if($defalut['smax_width'] && $defalut['smax_width']){
            $samllimg=array(
                $defalut['smax_width']."x".$defalut['smax_height']=>array(
                    'max_width'=>$defalut['smax_width'],
                    'max_height'=>$defalut['smax_height']
                )
            );
        }
        //图片处理
        $imagehandle= array(
            '' => array(
                // Automatically rotate images based on EXIF meta data:
                'auto_orient' => true
            )
        );
       if($defalut['sthumbs'])
        {
            $imagehandle=array_merge($imagehandle,$samllimg);
           
        }

        $config=array(
            /* 'upload_dir'=>'F:/server/test/up/',
             'script_url'=>'F:/server/test/up/',*/
            'upload_dir'=>C(UPLOAD)."/".$defalut['dir']."/",
            'file_type'=>$defalut['type'],
            'accept_file_types'=>$zz,
            'upload_url'=>C(UPLOAD_URL)."/".$defalut['dir']."/",
            'image_versions' =>$imagehandle,

        );
        new UploadExtendsHandlerModel($config);
    }

    public function uploadFile(){
        $this->assign('data',I('get.'));
        $this->display();
    }
}