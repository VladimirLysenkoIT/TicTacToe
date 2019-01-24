<?php
$width = $game->getFieldWidth();
$height = $game->getFieldHeight();
$field = $game->getField();
$winner_cells = $game->getWinnerCells();
?>

<div class="TicTacToe_field">
    <?php for($y=0; $y < $height; $y++) { ?>
        <div class="TicTacToe_row">
            <?php for($x=0; $x < $width; $x++) {
                $player = isset($field[$x][$y])? $field[$x][$y]: null;
                $winner = isset($winner_cells[$x][$y]);
                $class = ($player? " player" . $player: "") . ($winner? " winner": "");
                ?>
                <div class="TicTacToe_cell<?php echo $class ?>">
                    <?php if(!$player) { ?>
                        <a href="?action=step&amp;x=<?php echo $x ?>&amp;y=<?php echo $y ?>"></a>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
    <?php } ?>
</div>
<br/><a href="?action=newGame">New game</a>