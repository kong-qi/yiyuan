(function($) {    
    $.fn.popmenu = function(options) {
    var defaults=
    {
        data:'',
        split_char: ','
        , placement: 'bottom'
        , menu: '<ul class="popmenu list-group"></ul>'
        , item: '<li class="list-group-item"><a href="javascript:;"></a></li>'
        , autocomplete : false
    }
    var opts = $.extend(defaults, options);
    var $data=opts.data || this.attr('data');
   
    return this.each(function(){
        var $this=$(this);
        var $menu=$(opts.menu).appendTo('body');
     
        
        if (!opts.autocomplete) {
            $this.attr('autocomplete','off');
        }
        $.each($data.split(opts.split_char), function(i, n){
                        i = $(opts.item).attr('data-value', n);
                        i.find('a').html(n);
                        i.appendTo($menu);
        });
        $this.bind('click',function(e){
            if ($.trim($data) == '') {
                   return;
               }
            var pos = $.extend({}, $this.offset(), {
               height: $this[0].offsetHeight
            });
            var _top;
            var _left;
            var _width = $this.outerWidth()-2;
            switch (opts.placement) {
                  case 'top':
                      _left = pos.left;
                      _top = pos.top - $menu.outerHeight();
                  break;
                  case 'left':
                      _left = pos.left - _width -2;
                      _top = pos.top;
                  break;
                  case 'bottom':
                      _left = pos.left;
                      _top = pos.top + pos.height;
                  break;
                  case 'right':
                      _left = pos.left + _width +2;
                      _top = pos.top;
                  break;
            }
            $menu.css({
                    top: _top
                    , left: _left
                    , width: _width
            });
            e.stopPropagation();
            $menu.toggle();
        });
        $menu.find('li').bind('click',function() {
            $this.val($(this).text());
        });
        $(document).click(function(e) {
            $menu.hide();
        });
    });
}
})(jQuery);