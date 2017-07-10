(function($){
    $.fn.extend({
        setOption:function(option_val){
            this.each(function(){
                $this = $(this);
                var opt = $this.children("option[value='" + option_val + "']");
                var val = opt.val();
                var ind = $this.find('option').index(opt);
                $this.next('.bootstrap-select').find('li').removeClass('selected');
                $this.next('.bootstrap-select').find('li:eq('+ ind +')').addClass('selected');
                $this.next('.bootstrap-select').find('.filter-option').text(opt.text());
                $this.val(val);
            });
        },
        setCheck:function(check_val){
             this.each(function(){
                $this = $(this);
                if(check_val == 1 || check_val=='ACTIVO'){
                    $this.attr('checked',true);
                }else{
                    $this.attr('checked',false);
                }
            });
        },
        setNewOption:function(option_val,option_text){
            this.each(function(){
                $this = $(this);
                $this.append("<option value='" + option_val + "'>" + option_text + "</option>");
                var opt = $this.children("option:last");
                var ind = $this.find('option').index(opt);
                $this.next().find('div.dropdown-menu').children('ul').append('<li rel=" '+ ind + '" class=""><a tabindex="0" class="" style=""><span class="text">' + option_text + '</span><i class="fa fa-ok icon-ok check-mark"></i></a></li>');
                $this.next('.bootstrap-select ul.dropdown-menu').find('li:eq('+ ind +')').addClass('selected active');
                $this.next('.bootstrap-select').find('.filter-option').text(option_text);
                $this.val(option_val);
            });
        }
    });
})(jQuery)