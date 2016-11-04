/**
 * Created by Administrator on 2016/4/20.
 */
$(function() {
    //选择打开，关闭TABLE
    $('[data-change="select"]').click(function(){
        classid=$(this).attr("data-class");
        if($(this).is(":checked"))
        {
           
            $("."+classid).show();
        }else
        {
             
            $("."+classid).hide();
        }
        
    })
    //上移
    $(document).on('click', '.js_left_pic', function(event) {


        var onthis = $(this).parents(".itempic");

        var getup = $(this).parents(".itempic").prev(".itempic");

        if (getup.html() != null) {

            $(getup).before(onthis);

        }

    });

    //下移动
    $(document).on('click', '.js_right_pic', function(event) {

        var onthis = $(this).parents(".itempic");
        var getup = $(this).parents(".itempic").next(".itempic");
        if (getup.html() != null) {

            $(getup).after(onthis);

        }

    });
    //删除
    $(document).on('click', '.js_remove_pic', function(event) {
        var onthis = $(this).parents(".itempic");
        layer.confirm(lang.del_msg+'？', {
            btn: [lang.del, lang.cancel] //按钮
        }, function(index) {

            onthis.remove();
            layer.close(index)
        }, function(index) {

            layer.close(index)
        });

    });
    $(document).on('click', '.js_file_remove', function(event) {
        var onthis = $(this).parents(".js_file_id");
        layer.confirm(lang.del_msg+'？', {
            btn: [lang.del, lang.cancel] //按钮
        }, function(index) {

            onthis.empty();
            $(".js_file").val('');
            layer.close(index)
        }, function(index) {

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

function drop() {
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

function select_all() {
    $("#chkall").click(function(event) {
        if (this.checked) {
            $(".checkbox-select").each(function() {
                this.checked = true;
            });
        } else {
            $(".checkbox-select").each(function() {
                this.checked = false;
            });
        }

    });
}

function del_confirm() {
    $(document).on("click", "[date-del='1']", function(event) {

        $str = lang.del_msg+'？';
        if (confirm($str)) {
            return true
        }
        return false;
    });


}

function checked_box_id() {
    $uuid = new Array();
    $(".checkbox-select:checked").each(function() {
        $uuid.push($(this).val());
    });
    if ($uuid.length > 0) {
        return $uuid;
    }
    return false;

}

function checked_sort_id() {
    var check_id_array = new Array();
    var checkid = $(".checkbox-select:checked");
    if (checkid.size() > 0) {
        checkid.each(function(index, el) {
            p = $(this).parents("tr");
            sort_v = p.find('[data-sort="1"]').val();
            check_id_array.push(sort_v);
        });
    } else {
        return false;
    }
    return check_id_array;

}

function checked_log_name() {
    var check_id_array = new Array();
    var checkid = $(".checkbox-select:checked");
    if (checkid.size() > 0) {
        checkid.each(function(index, el) {
            p = $(this).parents("tr");
            sort_v = p.find('[data-log="1"]').text();
            check_id_array.push(sort_v);
        });
    } else {
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
function upload_file($url, $inserid, $more, $style, $type) {

    $pic_more = 1;
    $filetype = 'image';
    if ($type) {
        $filetype = $type;
    }
    if ($more) {
        $pic_more = $more;
    }
    $more_input = '';

    if ($style == '1') {
        $more_input = '<p class="m_t_10"> <input class="input" value="" id="name" placeholder="名称" type="text"> </p>';
    } else if ($style == '2') {
        $more_input += '<p class="m_t_10"> <input class="input js_name" value="" id="name" placeholder="名称" type="text"> </p>';
        $more_input += '<p class="m_t_10"> <input class="input js_url" value=""  id="name" placeholder="网址" type="text"> </p>';
    }
    console.log($style);
    var ly = layer.open({
        type: 2,
        title: lang.upfile,
        //shadeClose: true,
        shade: 0.8,
        closeBtn: 1,
        btn: [lang.ok, lang.cancel],
        area: ['80%', '80%'],
        content: $url, //iframe的url

        yes: function(index) {
            //alert($filetype);
            if ($filetype == 'image') {
                ifrmae = $("#layui-layer-iframe" + index).contents();
                list_pic = ifrmae.find(".tuku_pic_list ul").find('.chose');
                if ($pic_more != '1') {
                    $htmlstr = '';
                    if (list_pic.size() == 0) {
                        alert(lang.changpic);
                    } else {
                        list_pic.each(function(index, el) {
                            imgpic = $(this).find('img').attr('src');
                            imgsrc = $(this).find('img').attr('data-src');
                            $htmlstr += '<li class="itempic"> <img  data-url="' + imgsrc + '" src="' + imgpic + '" alt="" width="220"> ' + $more_input +
                                '<p class="m_t_10"> <a href="javascript:void(0)" class="btn btn-white btn-xs js_left_pic"><i class="fa fa-angle-left"></i>'+lang.upmove+'</a> ' +
                                '<a href="javascript:void(0)" class="btn btn-white btn-xs js_right_pic"><i class="fa fa-angle-right"></i>'+lang.downmove+'</a> ' +
                                '<a href="javascript:void(0)" class="btn btn-danger btn-xs js_remove_pic"><i class="fa fa-trash"></i>'+lang.del+'</a> </p> </li>';
                        });
                        $($inserid).find(".insert_img_more").append($htmlstr);
                        //console.log($htmlstr);
                        layer.close(index);
                    }

                } else {


                    if (list_pic.size() > 0) {
                        if (list_pic.size() != 1) {
                            alert(lang.piconly);
                            return false;
                        } else {
                            imghtml = list_pic.find('img').attr('src');
                            imgsrc = list_pic.find('img').attr('data-src');

                            $($inserid).find(".insert_img").empty().append('<img height="120" data-url="' + imgsrc + '" src="' + imghtml + '" >');
                            $($inserid).find('.insert_input').val(imgsrc);
                            //$(id).val(imgsrc);
                            //$($ypicid).show().empty().append('<img height="120" data-url="'+imgsrc+'" src="'+imghtml+'" >');
                            layer.close(index);
                        }

                    } else {
                        alert(lang.nochange);
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
function jqtable($id, $col, $close) {
    $open = 'expanded';
    if ($close) {
        $open = 'collapsed';
    }
    $($id).treetable({
        expandable: true,
        clickableNodeNames: true,
        initialState: $open,
        column: $col
    });
}

function bd_ueditor($id,$h) {
    $h=$h || 200;
    var ue = UE.getEditor($id, {
        toolbars: [
            ['fullscreen', 'source', 'undo', 'redo', 'bold', 'italic', 'underline', 'fontborder', 'fontfamily', 'forecolor',
                'fontsize', 'strikethrough', 'pasteplain', '|', 'backcolor', 'map', //Baidu地图
                'gmap', 'insertorderedlist', 'insertunorderedlist', 'insertimage', 'preview',
            ]
        ],

        initialFrameHeight: $h,
        initialFrameWidth: '100%',
        autoHeightEnabled: true,
        autoFloatEnabled: true,
        wordCount: false,
        elementPathEnabled: false,
        fontfamily: [{
            label: '',
            name: 'yahei',
            val: '微软雅黑,Microsoft YaHei'
        }, {
            label: '',
            name: 'songti',
            val: '宋体,SimSun'
        }, {
            label: '',
            name: 'kaiti',
            val: '楷体,楷体_GB2312, SimKai'
        }, {
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

function return_pic_json($item, $insert, $debug) {
    var $array = new Array();
    var name = '';
    var url = '';
    var pic = '';
    var debug = '';

    $($item).each(function(index, el) {
        url = $(this).find('.js_url').val();
        name = $(this).find('.js_name').val();
        pic = $(this).find("img").attr('data-url');
        $array.push({ 'url': url, 'path': pic, 'name': name });
    });
    if ($array.length == '1') {
        if ($array[0]['path'] == '' || $array[0]['url'] == '' || $array[0]['name'] == '') {
            return false;
        }
    }
    if ($debug) {
        debug = $debug;
    }
    $result = JSON.stringify($array);
    if (debug) {
        console.log($result);
    }
    if ($insert) {
        console.log($insert);
        $("input[name='" + $insert + "']").val($result);
    }
    return $result;

}
//项目价格加上
function return_price_json($item, $insert, $debug) {
    var $array = new Array();
    var title = '';
    var title2 = '';
    var price = '';
    var num='';
    var total='';
    var danwei='';
    var ks_id='';
    var kst_id='';

    var debug = '';

    $($item).each(function(index, el) {
        title=$(this).find('.pr_name').text();//标题
        title2=$(this).find('.pr_name').attr('data-ticket');//收据标题
        price=$(this).find('.pr_price').val();//价格
        num=$(this).find('.pr_num').val();//数量
        total=$(this).find('.pr_heji').text();//小计
        danwei=$(this).find('.pr_danwei').text();//单位
        fid=$(this).find('.pr_name').attr('data-fid');//FID
        id=$(this).find('.pr_name').attr('data-id');//id
        xfname=$(this).find('.pr_name').attr('data-xfname');//类名
       
       //还原价格
        price=accounting.unformat(price);
        total=accounting.unformat(total);
        $array.push(
            { 
                'title': encodeURI(title), 
                'title2': encodeURI(title2), 
                'price':price,
                'num':num,
                'total':total,
                'danwei':danwei,
                'fid':fid,
                'xfname':xfname,
                'id':id 
            }
        );
    });
    if ($array.length == '1') {
        if ($array[0]['title'] == '' || $array[0]['xfname'] == '' || $array[0]['fid'] == '' || $array[0]['id'] == '' || $array[0]['title2'] == '' || $array[0]['ks_id'] == '' || $array[0]['kst_id'] == '' || $array[0]['danwei'] == '' || $array[0]['num'] == '' || $array[0]['total'] == '' ||  $array[0]['price'] == '') {
            return false;
        }
    }
    if ($debug) {
        debug = $debug;
    }
    $result = JSON.stringify($array);
    if (debug) {
        console.log($result);
    }
    if ($insert) {
       
        $("input[name='" + $insert + "']").val($result);
    }
    return $result;

}
function return_price_json2($item, $insert, $debug) {
    var $array = new Array();
    var title = '';
    var title2 = '';
    var price = '';
    var num='';
    var total='';
    var danwei='';
    var ks_id='';
    var kst_id='';

    var debug = '';

    $($item).each(function(index, el) {
        total=$(this).find('.pr_heji').text();//小计
        fid=$(this).find('.pr_name').attr('data-fid');//FID
        id=$(this).find('.pr_name').attr('data-id');//id
        xfname=$(this).find('.pr_name').attr('data-xfname');//类名
       
       
        $array.push(
            { 
                'fid': fid, 
                'total':  total, 
                'xfname':xfname,
                'id':id 
            }
        );
    });
    if ($array.length == '1') {
        if ($array[0]['title'] == '' || $array[0]['xfname'] == '' || $array[0]['fid'] == '' || $array[0]['id'] == '' || $array[0]['title2'] == '' || $array[0]['ks_id'] == '' || $array[0]['kst_id'] == '' || $array[0]['danwei'] == '' || $array[0]['num'] == '' || $array[0]['total'] == '' ||  $array[0]['price'] == '') {
            return false;
        }
    }
    if ($debug) {
        debug = $debug;
    }
    $result = JSON.stringify($array);
    if (debug) {
        console.log($result);
    }
    if ($insert) {
       
        $("input[name='" + $insert + "']").val($result);
    }
    return $result;

}


function return_pic_json2($item, $insert, $debug) {
    var $array = new Array();
    var name = '';
    var url = '';
    var pic = '';
    var debug = '';

    $($item).each(function(index, el) {
        url = $(this).find('.js_url').val();
        name = $(this).find('.js_name').val();
        pic = $(this).find("img").attr('data-url');
        $array.push({ 'url': url, 'path': pic, 'name': name });
    });
    if ($array.length == '1') {
        if ($array[0]['path'] == '' || $array[0]['url'] == '' || $array[0]['name'] == '') {
            return false;
        }
    }
    if ($debug) {
        debug = $debug;
    }
    $result = JSON.stringify($array);
    if (debug) {
        console.log($result);
    }
    if ($insert) {

        $($insert).val($result);
    }
    return $result;

}
$("#select_lm").click(function(event) {
    //v=$(this).val();
    // $("#select_lm_path").val(v);

});
//昨天，今天，明天
function get_date(day) {
    var today = new Date();

    var targetday_milliseconds = today.getTime() + 1000 * 60 * 60 * 24 * day;

    today.setTime(targetday_milliseconds); //注意，这行是关键代码

    var tYear = today.getFullYear();
    var tMonth = today.getMonth();
    var tDate = today.getDate();
    tMonth = doHandleMonth(tMonth + 1);
    tDate = doHandleMonth(tDate);
    return tYear + "-" + tMonth + "-" + tDate;
}

function doHandleMonth(month) {
    var m = month;
    if (month.toString().length == 1) {
        m = "0" + month;
    }
    return m;
}

function log($str) {
    console.log($str);
}
//出生年月算出年龄
function get_age(str) {
    var r = str.match(/^(\d{1,4})(-|\/)(\d{1,2})\2(\d{1,2})$/);
    if (r == null) return false;
    var d = new Date(r[1], r[3] - 1, r[4]);
    if (d.getFullYear() == r[1] && (d.getMonth() + 1) == r[3] && d.getDate() == r[4]) {
        var Y = new Date().getFullYear();
        return (Y - r[1]);
    }
    return (lang.dateerror);
}
//根据年龄算出出生年月
function get_age_date(year) {
    var dd = new Date();
    y = parseInt(dd.getFullYear());

    y = y + parseInt(year);
    return y + "-01-01";
}

$('[ data-layer="1"]').on("click", function() {
    url = $(this).attr('data-url');
    id = $(this).attr('data-uuid');
    title = $(this).attr('data-title');
    close=$(this).attr('data-close');
    if(!close)
    {
        close=true;
    }else
    {
        close=false;
    }
    w=$(this).attr('data-w');
    h=$(this).attr('data-h');
    layer.open({
        type: 2,
        title: title,
        shadeClose: close,
        shade: 0.8,
        area: [w, h],
        content: url,
        cancel: function(index) {


        }
    });
});
//自动传值
$("[data-auto-value='1']").on('change', function(event) {
    event.preventDefault();
    $cid=$(this).attr('data-auto-id');
    $v=$(this).val();
    $($cid).val($v);
});

$("[data-show-phone='1']").on('click',  function(event) {

    event.preventDefault();
    uid=$(this).attr('data-uid');
    vid=$(this).attr('data-vid');
    type=$(this).attr('data-type');
    url=$(this).attr('data-url');
    layer.confirm(lang.showphone+'？', {
      btn: [lang.ok,lang.cancel] //按钮
    }, function(){
        
        $.get(url, {uid: uid}, function(data, textStatus, xhr) {
            console.log(data);
            if(data.phone)
            {
                if(type=='input')
                {
                    $(vid).val(data.phone)
                }else
                {
                    $(vid).text(data.phone)
                }
                 layer.msg(lang.showok, {icon: 1});
                 $("[data-show-phone='1']").unbind('click');
                
            }else
            {
                layer.msg(lang.nophone);
            }   
        });
    }, function(){
     
    });
});
//价格设置
function price_chane($url, $inserid,$ytotal, $more) {

    $pic_more = 0;
    
    $more=$more || 0;

    $more_input = '';

   
    var ly = layer.open({
        type: 2,
        title: '选择价格',
        //shadeClose: true,
        shade: 0.8,
        closeBtn: 1,
        btn: ['确定', '取消'],
        area: ['80%', '80%'],
        content: $url, //iframe的url

        yes: function(index) {
            ifrmae = $("#layui-layer-iframe" + index).contents();
            list_pic = ifrmae.find(".change_price ").find('.active');
            //alert($filetype);
            $htmlstr='';
            $total=0;
            list_pic.each(function(index, el) {
                $total+=parseFloat($(this).find('.price_heji').val());
                $(this).find(".panel-footer").css('display','block');
                $htmlstr+='<div class="col-xs-6 col-sm-3 price_item">';
                $htmlstr+=$(this).html();
                $htmlstr+="</div>";



            });
           
            if($more)
            {
                $($inserid).empty.append($htmlstr);
            }else
            {

                $($inserid).append($htmlstr);
            }
            //console.log($htmlstr);
            //原来总价加现在的加个
            $yprice=$($ytotal).val();
            $ysum=parseFloat($yprice)+parseFloat($total);
            $ysum=Math.round($ysum);
            log(parseFloat($yprice));
            //验证是否为数字
            reg=/^\d+(\.\d+)?$/;
            if(!reg.test($ysum))
            {
                layer.msg("数据出错，请确认准确提交");
            }else
            {

                $($ytotal).val($ysum);
                console.log($total);
                //console.log($htmlstr);
                layer.close(index);
            }
          


        }
    });




};
function monery(){

    $('[data-price="vn"]').each(function(index, el) {
        $(this).on('focusout',function(){
            $v=$(this).val();
            $fv=accounting.formatMoney($v, { symbol: "",  format: "%s %v" ,precision:0});
            $(this).val($fv);

        });
    });
    
}
function unmonery(){
    $('[data-price="vn"]').each(function(index, el) {
        $(this).on('focus',function(){
            $v=$(this).val();
            if($v!='')
            {
                $v=accounting.unformat($v);
                $(this).val($v);
            }
          
        });
    });
}
function submonery(){
    status=0;
    $('[data-price="vn"]').each(function(index, el) {
       
            $v=$(this).val();
            $v=accounting.unformat($v);
            $(this).val($v);
            $status=1;
        
    });
    return status;
}
function showmonery(){
    $('[data-price="vnlist"]').each(function(index, el) {
            
            $v=$(this).text();
            $v=accounting.formatMoney($v, { symbol: "",  format: "%s %v" ,precision:0});
            $(this).text($v);
            
        
    });
}
function unshowmonery(){
    $('[data-price="vnlist"]').each(function(index, el) {
            
            $v=$(this).text();
            $v=accounting.unformat($v);
            $(this).text($v);
            
        
    });
}

function editmonery(){
    status=0;
    $('[data-price="vn"]').each(function(index, el) {
        $v=$(this).val();
        $fv=accounting.formatMoney($v, { symbol: "",  format: "%s %v" ,precision:0});
        $(this).val($fv);
    });
    return status;
}
//列表显示格式
showmonery();
//默认input状态，显示格式
editmonery();
//输入之后，设置格式
monery();
//点击输入原
unmonery()


$('[data-btn="handle"]').parent('a').hover(function(){
    name=$(this).find('[data-btn="handle"]').attr('data-name');
 
    layer.tips(name, $(this), {
      tips: [1, '#0FA6D8'] //还可配置颜色
    });
},function(){
    
    $(this).find('[data-btn="handle"]').show();
    
    $(this).find(".js-data-name").stop().text('');
});

$('[data-chang-value="1"] li').click(function(){
    p=$(this).parents(".input-group");
    v=$(this).text();
    p.find("input").val(v);
});
$(document).on("change","[data-set-option='1']",function(){
    name=$(this).attr('data-name');
   
    v=$(this).find("option:selected").text();
    log(v);
     $("[name='"+name+"']").val(v);
}).trigger('change');