/**
 * Created by Administrator on 2016/4/20.
 */
 $(function(){
    //上移
    $(document).on('click', '.js_left_pic', function(event) {
      
       
       var onthis = $(this).parents(".itempic");

       var getup = $(this).parents(".itempic").prev(".itempic");
      
       if(getup.html()!=null)
       {
        
        $(getup).before(onthis);
        
       }
      
    });
    //下移动
    $(document).on('click', '.js_right_pic', function(event) {
      
       var onthis = $(this).parents(".itempic");
       var getup = $(this).parents(".itempic").next(".itempic");
       if(getup.html()!=null)
       {
       
        $(getup).after(onthis);
        
       }
      
    });
    //删除
    $(document).on('click', '.js_remove_pic', function(event) {
        var onthis = $(this).parents(".itempic");
       layer.confirm('你确定要取消删除吗？', {
           btn: ['删除','取消'] //按钮
       }, function(index){
          
          onthis.remove();
          layer.close(index)
       }, function (index){
          
          layer.close(index)
       });
      
    });
    $(document).on('click', '.js_file_remove', function(event) {
        var onthis = $(this).parents(".js_file_id");
       layer.confirm('你确定要取消删除吗？', {
           btn: ['删除','取消'] //按钮
       }, function(index){
          
          onthis.empty();
          $(".js_file").val('');
          layer.close(index)
       }, function (index){
          
          layer.close(index)
       });
      
    });
 })
function tab() {
    $(document).on("click", ".tab ul li", function() {
        $(this).addClass("active").siblings('li').removeClass('active');
        $index = $(this).index();
        $tab_box = $(".tab-box");
        $tab_box.eq($index).show().siblings(".tab-box").hide();
    });
}
function close_alert() {
    $(document).on("click", ".alert-close", function() {

        $(this).parent(".alert").remove();
    })

}
function drop(){
    $(document).on("mouseover mouseout", "[data-toggle='drop-down']", function(event) {
        if (event.type == "mouseover") {
            $(this).addClass("active");
            $(this).find("[data-toggle='drop-menu']").show();
        } else if (event.type == "mouseout") {
            $(this).removeClass("active");
            $(this).find("[data-toggle='drop-menu']").hide();
        }
    })
}
function select_all(){
    $("#chkall").click(function(event) {
        if(this.checked){
            $(".checkbox-select").each(function(){
                this.checked = true;
            });
        }else{
            $(".checkbox-select").each(function(){
                this.checked = false;
            });
        }

    });
}
function del_confirm()
{
    $(document).on("click", "[date-del='1']", function(event) {
       
        $str='确定删除吗？';
        if(confirm($str))
        {
            return true
        }
        return false;
    });


}
function checked_box_id(){
    $uuid=new Array();
    $(".checkbox-select:checked").each(function () {
        $uuid.push($(this).val());
    });
    if($uuid.length>0)
    {
        return $uuid;
    }
    return false;

}
function checked_sort_id(){
    var check_id_array=new Array();
    var checkid=$(".checkbox-select:checked");
    if(checkid.size()>0){
        checkid.each(function(index, el) {
            p=$(this).parents("tr");
            sort_v=p.find('[data-sort="1"]').val();
            check_id_array.push(sort_v);
        });
    }else{
        return false;
    }
    return check_id_array;

}
function checked_log_name(){
    var check_id_array=new Array();
    var checkid=$(".checkbox-select:checked");
    if(checkid.size()>0){
        checkid.each(function(index, el) {
            p=$(this).parents("tr");
            sort_v=p.find('[data-log="1"]').text();
            check_id_array.push(sort_v);
        });
    }else{
        return false;
    }
    return check_id_array.join(",");

}

/**
 *
 * @param $url 地址
 * @param $inserid 插入ID
 * @param $more 是否多选
 * @param $type 类型
 */
function upload_file($url,$inserid,$more,$style,$type) {

    $pic_more=1;
    $filetype='image';
    if($type)
    {
        $filetype=$type;
    }
    if($more)
    {
        $pic_more=$more;
    }
    $more_input='';
   
    if($style=='1')
    {
        $more_input='<p class="m_t_10"> <input class="input" value="" id="name" placeholder="名称" type="text"> </p>';
    }else if($style=='2')
    {
        $more_input+='<p class="m_t_10"> <input class="input js_name" value="" id="name" placeholder="名称" type="text"> </p>';
        $more_input+='<p class="m_t_10"> <input class="input js_url" value=""  id="name" placeholder="网址" type="text"> </p>';
    }
    console.log($style);
    var ly=layer.open({
        type: 2,
        title: '上传文件',
        //shadeClose: true,
        shade: 0.8,
        closeBtn:1,
        btn: ['确定','取消'],
        area: ['50%', '80%'],
        content: $url, //iframe的url

        yes: function(index){
            //alert($filetype);
            if($filetype=='image')
            {
                ifrmae=$("#layui-layer-iframe"+index).contents();
                list_pic=ifrmae.find(".tuku_pic_list ul").find('.chose');
                if($pic_more!='1')
                {
                    $htmlstr='';
                    if(list_pic.size()==0)
                    {
                        alert('请选择图片');
                    }else{
                        list_pic.each(function(index, el) {
                            imgpic=$(this).find('img').attr('src');
                            imgsrc=$(this).find('img').attr('data-src');
                            $htmlstr+='<li class="itempic"> <img  data-url="'+imgsrc+'" src="'+imgpic+'" alt="" width="220"> '+$more_input+
                            '<p class="m_t_10"> <a href="javascript:void(0)" class="btn btn-white btn-xs js_left_pic"><i class="fa fa-angle-left"></i>上移</a> '+
                            '<a href="javascript:void(0)" class="btn btn-white btn-xs js_right_pic"><i class="fa fa-angle-right"></i>下移</a> '+
                            '<a href="javascript:void(0)" class="btn btn-danger btn-xs js_remove_pic"><i class="fa fa-trash"></i>删除</a> </p> </li>';
                        });
                        $($inserid).find(".insert_img_more").append($htmlstr);
                        //console.log($htmlstr);
                        layer.close(index);
                    }

                }else{


                    if(list_pic.size()>0)
                    {
                        if(list_pic.size()!=1)
                        {
                            alert('只能选择一张');
                            return false;
                        }else{
                            imghtml=list_pic.find('img').attr('src');
                            imgsrc=list_pic.find('img').attr('data-src');
                            
                            $($inserid).find(".insert_img").empty().append('<img height="120" data-url="'+imgsrc+'" src="'+imghtml+'" >');
                            $($inserid).find('.insert_input').val(imgsrc);
                            //$(id).val(imgsrc);
                            //$($ypicid).show().empty().append('<img height="120" data-url="'+imgsrc+'" src="'+imghtml+'" >');
                            layer.close(index);
                        }

                    }else{
                        alert('请点击选择，没有选择');
                    }
                }
            }



        }
    });




}
/*配置参数
 expandable:1/0是否可以固定展开，
 initialState:是展开还是折腾
 Possible values: "expanded" or "collapsed".
*/
function jqtable($id,$col,$close){
    $open='expanded';
    if($close)
    {
        $open='collapsed';
    }
    $($id).treetable(
        {
            expandable: true ,
            clickableNodeNames:true,
            initialState:$open,
            column:$col
        });
}
function bd_ueditor($id){
    var ue = UE.getEditor($id, {
            toolbars: [
                ['fullscreen', 'source', 'undo', 'redo', 'bold', 'italic', 'underline', 'fontborder','fontfamily', 
        'fontsize',  'strikethrough', 'superscript', 'subscript', 'removeformat', 'formatmatch', 'autotypeset', 'blockquote', 'pasteplain', '|', 'forecolor', 'backcolor', 'map', //Baidu地图
        'gmap', 'insertvideo',  'insertorderedlist', 'insertunorderedlist', 'insertimage', 'selectall', 'cleardoc','preview', ]
            ],
           
            initialFrameHeight:350,
            initialFrameWidth:'80%',
            autoHeightEnabled: true,
            autoFloatEnabled: true,
            fontfamily:[ {
                label: '',
                name: 'yahei',
                val: '微软雅黑,Microsoft YaHei'
            }, 
            {
                label: '',
                name: 'songti',
                val: '宋体,SimSun'
            }, {
                label: '',
                name: 'kaiti',
                val: '楷体,楷体_GB2312, SimKai'
            },
            {
                label: '',
                name: 'heiti',
                val: '黑体, SimHei'
            }, {
                label: '',
                name: 'lishu',
                val: '隶书, SimLi'
            }, {
                label: '',
                name: 'andaleMono',
                val: 'andale mono'
            }, {
                label: '',
                name: 'arial',
                val: 'arial, helvetica,sans-serif'
            }, {
                label: '',
                name: 'arialBlack',
                val: 'arial black,avant garde'
            }, {
                label: '',
                name: 'comicSansMs',
                val: 'comic sans ms'
            }, {
                label: '',
                name: 'impact',
                val: 'impact,chicago'
            }, {
                label: '',
                name: 'timesNewRoman',
                val: 'times new roman'
            }]
        });
    return ue;
        

}
function return_pic_json($item,$insert,$debug){
    var $array=new Array();
    var name='';
    var url='';
    var pic='';
    var debug='';
    
    $($item).each(function(index, el) {
        url=$(this).find('.js_url').val();
        name=$(this).find('.js_name').val();
        pic=$(this).find("img").attr('data-url');
        $array.push({'url':url,'path':pic,'name':name});
    });
    if($array.length=='1')
    {
        if($array[0]['path']=='' || $array[0]['url']=='' || $array[0]['name']=='')
        {
            return false;
        }
    }
    if($debug)
    {
        debug=$debug;
    }
    $result=JSON.stringify($array);
    if(debug){
        console.log($result);
    }
    if($insert)
    {
        console.log($insert);
        $("input[name='"+$insert+"']").val($result);
    }
    return $result;

}
function return_pic_json2($item,$insert,$debug){
    var $array=new Array();
    var name='';
    var url='';
    var pic='';
    var debug='';
    
    $($item).each(function(index, el) {
        url=$(this).find('.js_url').val();
        name=$(this).find('.js_name').val();
        pic=$(this).find("img").attr('data-url');
        $array.push({'url':url,'path':pic,'name':name});
    });
    if($array.length=='1')
    {
        if($array[0]['path']=='' || $array[0]['url']=='' || $array[0]['name']=='')
        {
            return false;
        }
    }
    if($debug)
    {
        debug=$debug;
    }
    $result=JSON.stringify($array);
    if(debug){
        console.log($result);
    }
    if($insert)
    {
        
        $($insert).val($result);
    }
    return $result;

}
$("#select_lm").click(function(event) {
    //v=$(this).val();
   // $("#select_lm_path").val(v);
    
});