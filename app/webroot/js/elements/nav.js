$(function(){
	$('#nav').find('input[type=checkbox]').removeAttr('name').change(function(e){
		if($(e.target).attr('checked')){
			$(e.target).parent().parent().find('input[type=number],select').removeAttr('disabled').attr('required',true);
		}else {
			$(e.target).parent().parent().find('input,select').each(function(){
				if(this!==e.target){
					$(this).attr('disabled',true).removeAttr('required');
				}
			});
		}
	});
	$('#EstateEstateKeywordType').removeAttr('name').change(function(e){
		$(e.target).parent().find('input[type=text]').attr('name',$(e.target).val());
	}).trigger('change');
	$('.check input[type=hidden]').remove();
});
