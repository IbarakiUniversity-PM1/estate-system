$(function(){
	$('#nav').find('input[type=checkbox]').removeAttr('id').change(function(e){
		if($(e.target).attr('checked')){
			$(e.target).parent().parent().find('input,select').removeAttr('disabled');
		}else {
			$(e.target).parent().parent().find('input,select').each(function(){
				if(this!==e.target){
					$(this).attr('disabled',true);
				}
			});
		}
	});
	$('#EstateEstateKeywordType').change(function(e){
		$(e.target).parent().find('input').attr('name',$(e.target).val());
	});
});
