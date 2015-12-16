$(function(){
	var $nav=$('#nav');
	$nav.find('input[type=checkbox]').removeAttr('name').change(function(e){
		if($(e.target).attr('checked')){
			$('#nav').find('#search1 .error').hide();
			$(e.target).parent().parent().find('input[type=number],select').removeAttr('disabled').attr('required',true);
		}else {
			$(e.target).parent().parent().find('input,select').each(function(){
				if(this!==e.target){
					$(this).attr('disabled',true).removeAttr('required');
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
	$nav.find('#search2 form').submit(function (e) {
		if($(e.target).find('input[type=text]').val()){
			return true;
		}else{
			$('#nav').find('#search2 .error').show();
			return false;
		}
	});
	$nav.find('#search2 input[type=text]').change(function (e) {
		var $nav=$('#nav');
		if($(e.target).val()){
			$nav.find('#search2 .error').hide();
			$nav.find('#search2 input[type=submit]').removeAttr('disabled');
		}
	});
	$('#EstateEstateKeywordType').removeAttr('name').change(function(e){
		$(e.target).parent().find('input[type=text]').attr('name',$(e.target).val());
	}).trigger('change');
	$('.check input[type=hidden]').remove();
});
