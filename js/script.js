// JavaScript Document
$(function(){
	
	$('#mais').click(function(){
		
		var next = $('#lista').children('li').length + 1;
		
		$('#lista').append('<li>' + 
                '<label>Idioma</label>' + 
                    '<div class="styled-select-lista">' +
                        '<select name="lingua_alternativa' + next + '" required>' + 
                            '<option value="0">Selecione um Idioma</option>' +
                            '<option value="1">Alemão</option>' +
                            '<option value="2">Árabe</option>' +
                            '<option value="3">Basco</option>' +
                            '<option value="4">Coreano</option>' +
                            '<option value="5">Croata</option>' +
                            '<option value="6">Dinamarquês</option>' +
                            '<option value="7">Espanhol</option>' +
                            '<option value="8">Francês</option>' +
                            '<option value="9">Grego</option>' +
                            '<option value="10">Hebraico</option>' +
                            '<option value="11">Hindi</option>' +
                            '<option value="12">Holandês</option>' +
                            '<option value="13">Húngaro</option>' +
                            '<option value="14">Inglês</option>' +
                            '<option value="15">Italiano</option>' +
                            '<option value="16">Japonês</option>' +
                            '<option value="17">Javanês</option>' +
                            '<option value="18">Mandarim</option>' +
                            '<option value="19">Norueguês</option>' +
                            '<option value="20">Persa</option>' +
                            '<option value="21">Polaco</option>' +
                            '<option value="22">Português</option>' +
                            '<option value="23">Romeno</option>' +
                            '<option value="24">Russo</option>' +
                            '<option value="25">Sueco</option>' +
                            '<option value="26">Tailandês</option>' +
                            '<option value="27">Tcheco</option>' +
                            '<option value="28">Turco</option>' +
                            '<option value="29">Ucraniano</option>' +
                            '<option value="30">Vietnamita</option>' +
                        '</select>' +
                    '</div>' +
                '<ol>' +
                    '<li>' +
                        '<div>' +
                            '<input type="radio" name="fluencia' + next + '" value="1" id="basico" style="margin:5px" required />' +
                            '<label for="basico">Básico</label>' +
                        '</div>' +
                    '</li>' +
                    '<li>' +
                        '<div>' +
                            '<input type="radio" name="fluencia' + next + '" value="2" id="intermediario" style="margin:5px" />' +
                            '<label for="intermediario">Intermediário</label>' +
                        '</div>' +
                    '</li>' +
                    '<li>' +
                        '<div>' +
                            '<input type="radio" name="fluencia' + next + '" value="3" id="avancado" style="margin:5px" />' +
                            '<label for="avancado">Avançado</label>' +
                        '</div>' +
                    '</li>' +
                '</ol>' +
        '</li>');
		
		$('input[name="quantidade_idiomas"]').val(next);
		
		
		return false;
	});
	
});


