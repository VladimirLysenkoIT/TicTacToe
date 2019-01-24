<?php
class TicTacToe {
    private $field_width = 3;
    private $field_height = 3;
    private $count_for_win = 3;

    private $field = [];
    private $winner_cells = [];

    private $current_player = 1;
    private $winner = null;
    
    /**
     * The treatment of move.
     * The symbol of the current player is inserted in the specified coordinates.
     * Passes the move to another player, and in case of victory determines the winner.
     */
    public function move($x, $y) {
        if(
            $this->current_player
            && 
            $x >= 0 && $x < $this->field_width
            &&
            $y >= 0 && $y < $this->field_height
            &&
            empty($this->field[$x][$y]))
        {
                $current = $this->current_player;

                $this->field[$x][$y] = $current;
                $this->current_player = ($current == 1) ? 2 : 1;
                
                $this->checkWinner();
        }
    }
    
    /**
     * Searches for the winning combination, passing around the field and checking
     * 4 directions (horizontal, vertical and 2 diagonals).
     */
    private function checkWinner() {
        for($y = 0; $y < $this->field_height; $y++) {
            for($x = 0; $x < $this->field_width; $x++) {
                $this->checkLine($x, $y, 1, 0);
                $this->checkLine($x, $y, 1, 1);
                $this->checkLine($x, $y, 0, 1);
                $this->checkLine($x, $y, -1, 1);
            }
        }
        if($this->winner) {
            $this->current_player = null;
        }
    }
    
    /**
     * Checks the winning combination
     * If a player won - remembers the winner
     * and the combination in array $winner_cells.
     * 
     * @param $start_X 
     * @param $start_Y
     * @param $d_X the direction in which to search for a combination
     * @param $d_Y
     */
    private function checkLine($start_X, $start_Y, $d_X, $d_Y) {
        $x = $start_X;
        $y = $start_Y;
        $field = $this->field;
        $value = isset($field[$x][$y])? $field[$x][$y]: null;
        $cells = [];
        $found_winner = false;
        if($value) {
            $cells[] = [$x, $y];
            $found_winner = true;
            for($i=1; $i < $this->count_for_win; $i++) {
                $x += $d_X;
                $y += $d_Y;
                $value2 = isset($field[$x][$y])? $field[$x][$y]: null;
                if($value2 == $value) {
                    $cells[] = [$x, $y];
                } else {
                    $found_winner = false;
                    break;
                }
            }
        }
        if($found_winner) {
            foreach($cells as $cell) {
                $this->winner_cells[$cell[0]][$cell[1]] = $value;
            }
            $this->winner = $value;
        }
    }

    public function getCurrentPlayer() { return $this->current_player; }

    public function getWinner()        { return $this->winner; }

    public function getField()         { return $this->field; }

    public function getWinnerCells()   { return $this->winner_cells; }

    public function getFieldWidth()    { return $this->field_width; }

    public function getFieldHeight()   { return $this->field_height; }
}