$(function(){
	$(".valor").change(function(){
		$(this).val(format($(this).val()));
	});
});


function format(input)
{
	var num = input.toString().replace(/\./g,'');
    if(!isNaN(num)){
        num = num.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g,'$1.');
        num = num.split('').reverse().join('').replace(/^[\.]/,'');
        return num;
    }
    return '';
}