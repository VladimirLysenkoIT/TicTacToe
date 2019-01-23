<?php 
	if ($game->getCurrentPlayer()) { ?>
	   Ход делает игрок
	   <div class="icon icon_player<?php echo $game->getCurrentPlayer(); ?>"></div>
<?php
 	} 
   	
	if ($game->getWinner()) { ?>
		Победил игрок  
	    <div class="icon icon_player<?php echo $game->getWinner(); ?>"></div> !
<?php
	}
?>