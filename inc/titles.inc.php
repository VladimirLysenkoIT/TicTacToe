<?php 
	if ($game->getCurrentPlayer()) { ?>
	   Move
	   <div class="icon icon_player<?php echo $game->getCurrentPlayer(); ?>"></div>
<?php
 	} 
   	
	if ($game->getWinner()) { ?>
		Winner:
	    <div class="icon icon_player<?php echo $game->getWinner(); ?>"></div> !
<?php
	}
?>