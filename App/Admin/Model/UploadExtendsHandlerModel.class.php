<?php
namespace Admin\Model;
use \Org\Util\UploadHandler;
/**
 * Created by PhpStorm.
 * User: kongqi
 * Date: 2016/4/22
 * Time: 10:28
 */
class  UploadExtendsHandlerModel extends UploadHandler
{

    protected function get_file_name($file_path, $name, $size, $type, $error, $index, $content_range)
    {
        $name = $this->trim_file_name($file_path, $name, $size, $type, $error, $index, $content_range);
        $ext = strtolower(strrchr($name, '.'));
        $name = time() . rand(1, 300) . $ext;
        return $this->get_unique_filename(
            $file_path,
            $this->fix_file_extension($file_path, $name, $size, $type, $error,
                $index, $content_range),
            $size,
            $type,
            $error,
            $index,
            $content_range
        );
    }
    protected function handle_file_upload($uploaded_file, $name, $size, $type, $error,$index = null, $content_range = null)
    {
        $file = parent::handle_file_upload($uploaded_file, $name, $size, $type, $error, $index, $content_range
        );

        if (empty($file->error)) {
            $path=$this->get_upload_path($file->name);
            $file->file_type=$this->options['file_type'];
            $model=M('File');
            $model->uuid=create_uuid();
            $model->ctime=time();
            $model->name=$file->name;
            $model->type=$file->file_type;
            $model->url=$file->url;
            $model->aburl=$path;
            $model->add();
        }
        return $file;
    }

    /*   protected function handle_file_upload($uploaded_file, $name, $size, $type, $error,$index = null, $content_range = null) {
            $file = parent::handle_file_upload($uploaded_file, $name, $size, $type, $error, $index, $content_range
        );
        if (empty($file->error)) {

            $wc=new Weixin("wx73cbba95f1d99f22","7d5f0074a8c89ed6193584a3bf51a1d6");
            $file->wxmedia=$wc->GetMedia('kongqi',$file_path);
        }
        return $file;
    }

    protected function set_additional_file_properties($file) {
        parent::set_additional_file_properties($file);
       $file->wxmedia=>$file->wxmedia;
    }*/

}