<?php
	class Automata {
		public $num_cells = 64;
		public $generations = 32;
		private $cells = array();
		public $output_array = array();


		function __construct($random) {
			if ($random == "random") {
				$this->cells = $this->seed("random");
			} else {
				$this->cells = $this->seed("order");
			}
			$this->grow();
		}

		private function center() {
			if($this->num_cells %2 == 0) {
				return ($this->num_cells / 2) - 1;
			} else {
				return ($this->num_cells / 2);
			}
		}

		private function seed($random) {
			$arr = array();
			if ($random == "order") { //ordered output one seed in the center
				$arr = array_fill(0, $this->num_cells, False);
				$arr[$this->center()] = True;
			} else { //random array of booleans
				for($i = 0; $i < $this->num_cells; $i++) {
					$arr[$i] = mt_rand(0,1) == 1;
				}
			}
			return $arr;
		}

		/*private function print_cells() {
			foreach ($this->cells as $cell) {
				if($cell == True) {
					$this->output_string .= "<i class='fa fa-circle'></i>";
				} else {
					$this->output_string .= "<i class='fa fa-circle-o'></i>";
				}
			}
			$this->output_string .= "<br />";
		}*/

		private function divide() {
			$new_cells = array();
			for($a = 0; $a < count($this->cells); $a++) {
				if($a == 0) {
					$last_cell = False;
				} else {
					$last_cell = $this->cells[$a - 1];
				}

				if($a == count($this->cells) - 1) {
					$next_cell = False;
				} else {
					$next_cell = $this->cells[$a + 1];
				}

				if(($last_cell == True) && ($next_cell == False)) {
					$new_cells[$a] = True;
				} elseif(($last_cell == False) && ($next_cell == True)) {
					$new_cells[$a] = True;
				} else {
					$new_cells[$a] = False;
				}
			}
			$this->cells = $new_cells;
		}

		private function grow() {
			for($n; $n < $this->generations; $n++) {
				$this->output_array[] = $this->cells;
				$this->divide();
			}
		}
	}

	$pattern = new Automata("random");

	echo json_encode($pattern->output_array);
?>