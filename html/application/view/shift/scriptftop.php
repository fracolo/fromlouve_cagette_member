<script>
$(document).ready(function(){
	$( ".subscribeftop" ).click(function() {
		var clicked_button = $(this);
		var data = {
		    date_begin: clicked_button.data( "date_begin" ),
		    shift_id: clicked_button.data( "shift_id" ),
		    shift_ticket_id: clicked_button.data( "shift_ticket_id" )
		};

		if(confirm("Confirmez-vous votre inscription au service suivant : "+ clicked_button.data( "date_begin_formated" )))
		 {
		 	clicked_button.val('Traitement en cours...');
			$.getJSON("/shift/subscribeftopshift/", data, function (result) {
				if(result.errno=="-1")
				{
					alert('Vous ètes déjà inscrit sur ce service ou vous avez dépassé votre quota quotidien de service');
				}
				else
				{
					alert('Votre inscription a été prise en compte, elle sera visible lors de votre prochaine connexion ');
				}
				clicked_button.val('Inscrit');
			});

		}

	}); 





}); 




</script>