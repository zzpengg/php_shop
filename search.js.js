$(document).ready(function()
{
	$('#search_box').keyup(function() 
	{
		var value = $(this).val();

		if(value != '')
		{
			$('#search_result').show();
			$.post('search_auto.php', {value : value}, function(data)
			{
				$('#search_result').html(data);
			});
		}
		else
		{
			$('#search_result').hide();
		}
	});
});