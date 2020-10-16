const option_sheldom = ['tijeras', 'papel', 'roca', 'lagarto', 'Spock'];

//funcion que realiza la peticion post atraves de ajax para valida la partida de sheldon
$('.button-sheldon').on('click',function () {

	/*Inicio de inputs para el request*/
	const option_player_sheldon = $(this).data("id");

	const player_id = $("#player_id").val();

	const game_id = $("#game_id").val();

	const option_browser = getOptionRandomSheldon(option_sheldom);
	//console.log("option_browser", option_browser);
	

  	let _url     = '/registrar-partida-sheldon';
   	let _token   = $('meta[name="csrf-token"]').attr('content');
   	/*fin de inputs para el request*/

   	//peticion ajax
   	$.ajax({

        url: _url,
        type: "POST",
        data: {
          option_1: option_player_sheldon,
          option_2: option_browser,
          player_id: player_id,
          game_id: game_id,
          _token: _token
        },
        success: function(response) {
        	/*si no tenemos problemas en el registro de un score de un jugador se procede a 
				1. mostrar modal qcon los resultados de la partida de sheldon
				2. Actualiza el score del jugador
				3. Actualiza la lista de los mejores jugadores
        	*/
            if(response.code == 200) {
            	
            	modalMatchSheldon(response, option_player_sheldon, option_browser);
            	scorePlayer(response);
            	sixBestPlayer(response.data.six_best_players);
	            
            }

        },
        error: function(response) {
        	console.log(response.responseJSON.errors)
        }
      });
});


/*Funcion que retorna un item randomicamente de un array*/
getOptionRandomSheldon = function (list) {
  return list[Math.floor((Math.random()*list.length))];
}

/*Funcion que muestra el modal con los resultados de la partida de sheldon*/
modalMatchSheldon = function(data_match , option_player_sheldon, option_browser){
	
	$("#message-match-sheldon").text(data_match.message);
	$("#option-1").val(option_player_sheldon);
	$("#option-2").val(option_browser);

	if (data_match.data.rule_sheldon.validation_win_match){
		$('#rule-show-sheldon').show("slow");
		$("#rule-sheldon").val(option_player_sheldon +' gana a ' + option_browser);
	}else if (!data_match.data.rule_sheldon.validation_win_match &&  option_player_sheldon != option_browser) {
		$('#rule-show-sheldon').show("slow");
		$("#rule-sheldon").val(option_player_sheldon +' no gana a ' + option_browser);
	}else{
		$('#rule-show-sheldon').hide("slow");
		$("#rule-sheldon").val(' ');
	}


	$('#exampleModalCenter').modal('show');
}

/*Actualiza el score del jugador*/
scorePlayer = function(data_match){
	$("#score-player").val(data_match.data.score_player.score);
}

/*Actualiza la lista de los mejores jugadores de sheldon*/
sixBestPlayer = function (six_best_players){
	
	var best_players_code_html = '';
	for (var i = 0; i < six_best_players.length; i++) {
		best_players_code_html += '<li class="list-group-item d-flex justify-content-between align-items-center">' +
							six_best_players[i].player_name +
							'<span class="badge badge-primary badge-pill">'+ six_best_players[i].score +'</span>'+
							'</li>';
	}

	$('#list-best-players').html(best_players_code_html);
}