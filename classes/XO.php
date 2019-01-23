<?php
class XO {
    private $field_width = 3;
    private $field_height = 3;
    private $count_for_win = 3;

    private $field = [];
    private $winner_cells = [];

    private $current_player = 1;
    private $winner = null;
    
    /**
     * Обрабатывает ход. Ставит в указанные координаты
     * символ текущего игрока.
     * Передаёт ход другому игроку, а в случае победы
     * опреляет победителя.
     */
    public function doStep($x, $y) {
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
     * Делает поиск выигравшей комбинации, проходя по всему полю и проверяя
     * 4 направления (горизонталь, вертикаль и 2 диагонали).
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
     * Проверяет выигрышную комбинацию
     * Если выигрыш - запоминает победителя
     * и комбинацию в массив winner_cells.
     * 
     * @param $start_X 
     * @param $start_Y
     * @param $d_X направление, в котором искать комбинацию
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