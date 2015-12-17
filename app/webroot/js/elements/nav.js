$(function(){
	var $nav=$('#nav');
	$nav.find('input[type=checkbox]').removeAttr('name').change(function(e){
		if($(e.target).attr('checked')){
			$('#nav').find('#search1 .error').hide();
			$(e.target).parent().parent().find('input[type=number],select').removeAttr('disabled');
		}else {
			$(e.target).parent().parent().find('input,select').each(function(){
				if(this!==e.target){
					$(this).attr('disabled',true);
				}
			});
		}
	});
	$nav.find('#search1 form').submit(function (e) {
		if($(e.target).find('input:checked').length==0){
			$('#nav').find('#search1 .error').show();
			return false;
		}else{
			return true;
		}
	});
	$('#EstateEstateKeywordType').removeAttr('name').change(function(e){
		$(e.target).parent().find('input[type=text]').attr('name',$(e.target).val());
	}).trigger('change');
	$('.check input[type=hidden]').remove();
});
