<?php
/**
 * Created by PhpStorm.
 * User: kongqi
 * Date: 2016/4/23
 * Time: 11:27
 */

/**
 * @param $str
 * 是否审核
 */
function checked_str($str,$msg=array('通过','禁用')){
    switch ($str)
    {
        case '1':
            echo '<span class="fa fa-check-circle text-success text-14" title="通过"></span>';
            break;
        case '0':
            echo '<span class="fa fa-minus-circle text-error text-14" title="禁用"></span>';
            break;
    }
}

/**
 * @param $str
 *是否推荐
 */
function is_top($str){
    switch ($str)
    {
        case '1':
            echo '<span class="fa fa-thumbs-up text-error text-14" title="通过"></span>';
            break;
        case '0':
            echo '';
            break;
    }
}
/**
 * @return 是否登录
 */
function is_login(){
    $user = @session('uniqid');
    if (empty($user)) {
        return 0;
    } else {
        return 1;
    }
}


/**
 * @param $groupid
 * @return array
 * 取得权限组
 */
function get_group_rule($groupid){
    //算出权限组
    $model=M('AdminGroup');
    $model=$model->where(array('id'=>array('in',$groupid)))->field('ruleid')->select();
    //合并权限
    $grouparr=array();
    foreach ($model as $v)
    {
        $grouparr=array_merge($grouparr,to_arr($v['ruleid']));
    }
    return $grouparr;
}
function load_ueditor($str="content"){
    $dir=WEB_URL.'/Public/ueditor/';
    $str=' <script type="text/javascript" charset="utf-8" src="'.$dir.'ueditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="'.$dir.'ueditor.all.js"> </script>
    <script type="text/javascript" charset="utf-8" src="'.$dir.'lang/zh-cn/zh-cn.js"></script>';
    
    echo $str;


}

//类型
function echo_type($str,$array){
    if(array_key_exists($str,$array))
    {
        echo "<span style='margin-right: 5px' class='btn btn-xs btn-primary'>".$array[$str]."</span>";
    }
}

//权限
 function check_group($str)
{
    $group = session('group');
    if ($group) {
        if(in_array('root',$group))
        {
            return true;
        }
        if(!in_array($str, $group)) {
            return false;
        }
        return true;
    } else {
        return false;
    }
}

function lang($cn,$type){
    $chang_lang='cn';
    if(cookie('lang'))
    {
        $chang_lang=cookie('lang');
    }
   
    if($chang_lang=='cn')
    {
        return $cn;
    }
    return $cn."(VN)";
    $lang=array(
        'login'=>array(
            '用户名不能为空'=>'Tên người dùng không thể để trống',
            '密码不能为空'=>'Mật khẩu không thể để trống',
            '验证码不正确'=>'Mã xác minh sai',
            '管理员被禁用，请联系站长开启'=>'Quản trị viên là người khuyết tật, xin vui lòng liên hệ với quản trị trang web mở',
            '用户名不存在'=>'Tên đăng nhập không tồn tại',
            '密码错误'=>'mật khẩu sai',
            '退出登录成功'=>'Đăng nhập thành công'
        ),
        'public'=>array(
            '系统 提示信息'=>'Thông báo hệ thống',
            '登录成功'=>'Đăng nhập thành công',
            '如果你的浏览器没有自动跳转，请点击这里'=>'Nếu trình duyệt của bạn không hỗ trợ khung, xin vui lòng nhấn vào đây',
            '等待时间'=>'thời gian chờ',
            '还没有登录'=>'Bạn chưa đăng nhập'
        ),
        'menu'=>array(
            '管理员'=>'quản trị viên',
            '管理组'=>'Nhóm quản lý',
            '权限规则'=>'quy định cho phép',
            '权限设置'=>'Quyền',
            '字典设置'=>'cài đặt từ điển',
            '区域'=>'vùng',
            '机构类别'=>'loại tổ chức',
            '机构评定'=>'Cơ quan đánh giá',
            '合作状态'=>'hợp tác Nhà nước',
            '科室'=>'Sở',
            '医生'=>'y khoa',
            '病人来源'=>'nguồn bệnh nhân',
            '咨询工具'=>'Công cụ tư vấn',
            '预约质量'=>'phòng chất lượng',
            '到诊质量'=>'Chất lượng quý khách đến thăm',
            '收银台收费'=>'phí thu ngân',
            '结算'=>'Thanh toán',
            '回访'=>'Quay trở lại',
            '回访方式'=>'Quay trở lại cách',
            '回访类型'=>'trở loại',
            '回访主题'=>'Quay trở lại chủ đề',
            '回访状态'=>'thăm cấp Nhà nước',
            '添加预约'=>'để thêm một cuộc hẹn',
            '我的预约'=>'Đặt phòng của tôi',
            '添加工作量'=>'thêm khối lượng công việc',
            '预约报表'=>'báo cáo phòng',
            '工作量报表'=>'báo cáo khối lượng công việc',
            '添加机构'=>'cơ quan thêm',
            '机构查询'=>'cơ chế truy vấn',
            '预约列表'=>'danh sách đăng ký',
            '添加消费'=>'Thêm tiêu thụ',
            '消费报表'=>'Consumer Reports',
            '病人查询'=>'truy vấn bệnh nhân',
            '复诊列表'=>'danh sách giới thiệu',
            '病人列表'=>'Danh sách bệnh nhân',
            '开单列表'=>'Danh sách thanh toán',
            '结算列表'=>'Xoá danh sách',
            '定金列表'=>'danh mục tiền gửi',
            '回访列表'=>'Quay trở lại danh sách',
            '任务列表'=>'Danh sách nhiệm vụ',
            '短信设置'=>'cài đặt SMS',
            '优惠券'=>'phiếu',
            '收费字典'=>'từ điển Pay',
            '到诊评定'=>'Đánh giá Tham quan',
            '回访字典'=>'từ điển trở lại',
            '结算字典'=>'từ điển thanh toán',
            '机构字典'=>'từ điển các tổ chức',
            '网站字典'=>'từ điển website',
            '科室字典'=>'từ điển Sở'




        ),

        'handle'=>array(
            '添加账号'=>'Thêm tài khoản',
            '已用'=>'Được sử dụng',
            '启用'=>'cho phép',
            '停用'=>'Vô hiệu hóa',
            '更新成功'=>'Cập nhật thành công',
            '更新失败'=>'cập nhật thất bại',
            '数据错误'=>'dữ liệu lỗi',
            '添加成功'=>'thêm thành công',
            '添加失败'=>'Thêm Không',
            '删除失败'=>'xóa thất bại',
            '删除成功'=>'xóa thành công',
            '添加'=>'thêm vào',
            '删除'=>'xóa bỏ',
            '编辑'=>'chỉnh sửa',
            '确定'=>'xác định',
            '提交'=>'đệ trình',
            '修改'=>'sửa đổi',
            '返回'=>'trả lại',
            '操作'=>'điều hành',
            '名字不能为空'=>'Tên không thể để trống',
            '数据一样无更新'=>'Chưa cập nhật dữ liệu',
            '排序'=>'Trình tự',
            '你确定批量操作吗'=>'',
            '没有选择'


        ),
        'filed'=>array(
            '姓名'=>'Họ và tên',
            '帐号'=>'số tài khoản',
            '所属组'=>'nhóm sở hữu',
            '排序'=>'Trình tự',
            '编号'=>'số',
            '状态'=>'trạng thái',
            '创建时间'=>'tạo',
            '操作'=>'làm',

            '请选择'=>'Vui lòng chọn',
            '名称'=>'tên',
            '规则'=>'nguyên tắc',
            '权限选择'=>'Chọn quyền',
            '超级管理员'=>'super Administrator',
            '内容'=>'Nội dung',
            '英文名'=>'Anh',
            '上级'=>'cha mẹ',
            '批量用,分割'=>'Với chia lô',
            '预约号前缀'=>'',
            '是否付费'=>'',
            '预约号前缀'=>'',
            '是否统计到工作量'=>''

        ),
    );
    return $lang[$type][$cn];
}
function add_log($content){

    $log=M('log');
    $data['admin_id']=session('admin_id');
    $data['ctime']=time();
    $data['content']=$content;
    $log->add($data);

}
function get_rule($id){
    $map['fid']=$id;
    $rule=M('AdminRule')->where($map)->select();
    return $rule;
}
function zidian_nav(){
    $rule=array(
        'keshi'=>'科室',
        'bingren'=>'病人来源',

        'area'=>'区域字典',
        'yushen'=>'医生字典',
        'pricezd'=>'收费项目',
        'yuyuezl'=>'预约评定',
        'zixun'=>'咨询工具',
        'danzhen'=>'到诊评定',
        'shuofei'=>'收费字典',
        'jiesuan'=>'结算字典',
        'huifang'=>'回访字典',
        'jigou'=>'机构字典',
        'website'=>'网站字典'
    );
    $url=array(
        'keshi'=>U('Admin/KeShiZiDian/index',array('type'=>'keshi')),
        'bingren'=>U('Admin/BingRenLaiYuanZiDian/index',array('type'=>'bingren')),
        'pricezd'=>U('Admin/PriceZiDian/index'),
        'area'=>U('Admin/AreaZiDian/index',array('type'=>'area')),
        'yushen'=>U('Admin/YuShenZiDian/index',array('type'=>'yushen')),
        'yuyuezl'=>U('Admin/YuYueZiDian/index',array('type'=>'yuyuezl')),
        'danzhen'=>U('Admin/DaoZhengZiDian/index',array('type'=>'daozhen')),
        'zixun'=>U('Admin/ZiXun/index',array('type'=>'zixun')),
        'shuofei'=>U('Admin/ShouFeiZiDian/index',array('type'=>'shuofei')),
        'jiesuan'=>U('Admin/JieSuanZiDian/index',array('type'=>'jiesuan')),
        'huifang'=>U('Admin/HuiFangZiDian/index',array('type'=>'huifang')),
        'jigou'=>U('Admin/JiGouZiDian/index',array('type'=>'jigou')),
        'website'=>U('Admin/WebSiteZiDian/index',array('type'=>'website'))
    );
    $str='';
    foreach ($rule as $k=>$rv)
    {
        if(check_group($k))
        {
            $urlweb= $url[$k];
            $str.='<li>
                        <a class="J_menuItem" href="'.$urlweb.'">'.lang($rv,'menu').'</a>
                    </li>';
        }
    }
    echo $str;
}
