<?php

namespace ThemeCore\Classes;

class Weights{
	protected $products;

	public function __construct($products){
		$this -> products = $products;
	}

	public function get_diversity(){
		$weights = [];
		foreach($this -> products as $i => $product){
			$w = $product -> get_weight();
			if(array_search($w, $weights) === false){
				$weights[] = $w;
			}
		}

		return $weights;
	}
}