<?php
/**
 * GG_Captcha class
 *
 * @package com.grandpa-george
 * @author Derrin Evers
 */
class GG_Captcha {
	
	//Constants
	const min_inputs 								= 3;							// Minimum number of inputs to display.
													
	//Private properties				 			
	private $available_shapes						= array(
																'square',
																'circle',
																'triangle',
																'diamond'
															);
													
	private $nouns									= array('able', 'achieve', 'acoustics', 'action', 'activity', 'actor', 'advice', 'aftermath', 'afternoon', 'afterthought', 'airplane', 'airport', 'alarm', 'anger', 'animal', 'answer', 'apparel', 'apple', 'appliance', 'arithmetic', 'arm', 'army', 'aunt', 'badge', 'bait', 'ball', 'balloon', 'banana', 'baseball', 'basket', 'basketball', 'bat', 'bath', 'battle', 'bead', 'beam', 'bean', 'beast', 'bed', 'bedroom', 'beef', 'beetle', 'beggar', 'beginner', 'believe', 'bike', 'bird', 'birthday', 'bomb', 'book', 'boot', 'border', 'boundary', 'boy', 'brain', 'branch', 'bread', 'breakfast', 'brick', 'brother', 'brush', 'bubble', 'bucket', 'bun', 'bushes', 'butter', 'cabbage', 'cable', 'cactus', 'cake', 'calculator', 'calendar', 'camp', 'can', 'cannon', 'cap', 'caption', 'car', 'carpenter', 'cast', 'cat', 'cattle', 'cave', 'celery', 'cellar', 'cemetery', 'cent', 'channel', 'cherries', 'cherry', 'chicken', 'children', 'chin', 'circle', 'clam', 'class', 'cloth', 'clover', 'club', 'coach', 'coast', 'cobweb', 'coil', 'corn', 'cow', 'cracker', 'crate', 'crayon', 'cream', 'creator', 'creature', 'crib', 'crook', 'crow', 'crowd', 'crown', 'cub', 'cup', 'dad', 'daughter', 'day', 'deer', 'desk', 'dime', 'dinner', 'dirt', 'dock', 'doctor', 'dog', 'doll', 'donkey', 'downtown', 'dress', 'drug', 'drum', 'dust', 'earthquake', 'education', 'eggnog', 'elbow', 'eye', 'face', 'family', 'fan', 'fang', 'father', 'faucet', 'feast', 'feather', 'feet', 'field', 'fifth', 'fight', 'finger', 'fireman', 'flag', 'flavor', 'flesh', 'flock', 'flower', 'fog', 'food', 'frame', 'friction', 'frog', 'fruit', 'fuel', 'furniture', 'galley', 'game', 'gate', 'geese', 'ghost', 'giraffe', 'girl', 'glove', 'glue', 'goldfish', 'goose', 'governor', 'grade', 'grain', 'grandfather', 'grandmother', 'grape', 'grass', 'guide', 'guitar', 'gun', 'hair', 'haircut', 'hall', 'hat', 'health', 'heart', 'heat', 'hen', 'hill', 'hobbies', 'holiday', 'home', 'honey', 'hook', 'hope', 'horn', 'horse', 'hose', 'hot', 'hydrant', 'icicle', 'idea', 'income', 'island', 'jail', 'jam', 'jar', 'jeans', 'jellyfish', 'joke', 'judge', 'juice', 'kiss', 'kite', 'kitten', 'laborer', 'lace', 'ladybug', 'lake', 'lamp', 'language', 'lawyer', 'lettuce', 'light', 'linen', 'loaf', 'lock', 'locket', 'lumber', 'lunch', 'lunchroom', 'magic', 'maid', 'mailbox', 'man', 'map', 'marble', 'mask', 'meal', 'meat', 'men', 'mice', 'milk', 'minister', 'mint', 'mitten', 'mom', 'money', 'month', 'moon', 'morning', 'mother', 'mountain', 'music', 'name', 'nest', 'north', 'nose', 'notebook', 'number', 'oatmeal', 'ocean', 'owl', 'pail', 'pan', 'pancake', 'parent', 'park', 'partner', 'passenger', 'patch', 'pear', 'pen', 'pencil', 'pest', 'pet', 'pickle', 'picture', 'pie', 'pig', 'plane', 'plant', 'plantation', 'plastic', 'playground', 'pleasure', 'plot', 'pocket', 'poison', 'police', 'pollution', 'popcorn', 'pot', 'queen', 'quicksand', 'quiet', 'quilt', 'rabbit', 'railway', 'rain', 'rainstorm', 'rake', 'rat', 'recess', 'reward', 'riddle', 'rifle', 'river', 'road', 'robin', 'rock', 'room', 'rose', 'route', 'sack', 'sail', 'scale', 'scarecrow', 'scarf', 'scene', 'scent', 'sea', 'seashore', 'seed', 'shape', 'sheet', 'shoe', 'shop', 'show', 'sidewalk', 'sink', 'sister', 'skate', 'slave', 'sleet', 'smoke', 'snail', 'snake', 'snow', 'soap', 'soda', 'sofa', 'son', 'song', 'space', 'spark', 'spoon', 'spot', 'spy', 'squirrel', 'stage', 'star', 'station', 'step', 'stew', 'stove', 'stranger', 'straw', 'stream', 'street', 'string', 'sugar', 'suit', 'summer', 'sun', 'sweater', 'swing', 'table', 'tank', 'team', 'temper', 'tent', 'territory', 'test', 'texture', 'thread', 'thrill', 'throat', 'throne', 'tiger', 'title', 'toad', 'toe', 'toes', 'toothbrush', 'toothpaste', 'town', 'trail', 'tramp', 'tray', 'treatment', 'tree', 'trick', 'trip', 'tub', 'turkey', 'twig', 'uncle', 'underwear', 'vacation', 'van', 'vase', 'vegetable', 'veil', 'vein', 'vest', 'visitor', 'volcano', 'volleyball', 'voyage', 'water', 'wealth', 'weather', 'week', 'wheel', 'wilderness', 'wing', 'winter', 'wish', 'woman', 'women', 'wood', 'wool', 'wren', 'wrench', 'wrist', 'writer', 'yard', 'year', 'zebra' );
	private $colors									= array('000000', '000033', '000066', '000099', '0000CC', '0000FF', '003300', '003333', '003366', '003399', '0033CC', '0033FF', '006600', '006633', '006666', '006699', '0066CC', '0066FF', '009900', '009933', '009966', '009999', '0099CC', '0099FF', '00CC00', '00CC33', '00CC66', '00CC99', '00CCCC', '00CCFF', '00FF00', '00FF33', '00FF66', '00FF99', '00FFCC', '00FFFF', '330000', '330033', '330066', '330099', '3300CC', '3300FF', '333300', '333333', '333366', '333399', '3333CC', '3333FF', '336600', '336633', '336666', '336699', '3366CC', '3366FF', '339900', '339933', '339966', '339999', '3399CC', '3399FF', '33CC00', '33CC33', '33CC66', '33CC99', '33CCCC', '33CCFF', '33FF00', '33FF33', '33FF66', '33FF99', '33FFCC', '33FFFF', '660000', '660033', '660066', '660099', '6600CC', '6600FF', '663300', '663333', '663366', '663399', '6633CC', '6633FF', '666600', '666633', '666666', '666699', '6666CC', '6666FF', '669900', '669933', '669966', '669999', '6699CC', '6699FF', '66CC00', '66CC33', '66CC66', '66CC99', '66CCCC', '66CCFF', '66FF00', '66FF33', '66FF66', '66FF99', '66FFCC', '66FFFF', '990000', '990033', '990066', '990099', '9900CC', '9900FF', '993300', '993333', '993366', '993399', '9933CC', '9933FF', '996600', '996633', '996666', '996699', '9966CC', '9966FF', '999900', '999933', '999966', '999999', '9999CC', '9999FF', '99CC00', '99CC33', '99CC66', '99CC99', '99CCCC', '99CCFF', '99FF00', '99FF33', '99FF66', '99FF99', '99FFCC', '99FFFF', 'CC0000', 'CC0033', 'CC0066', 'CC0099', 'CC00CC', 'CC00FF', 'CC3300', 'CC3333', 'CC3366', 'CC3399', 'CC33CC', 'CC33FF', 'CC6600', 'CC6633', 'CC6666', 'CC6699', 'CC66CC', 'CC66FF', 'CC9900', 'CC9933', 'CC9966', 'CC9999', 'CC99CC', 'CC99FF', 'CCCC00', 'CCCC33', 'CCCC66', 'CCCC99', 'CCCCCC', 'CCCCFF', 'CCFF00', 'CCFF33', 'CCFF66', 'CCFF99', 'CCFFCC', 'CCFFFF', 'FF0000', 'FF0033', 'FF0066', 'FF0099', 'FF00CC', 'FF00FF', 'FF3300', 'FF3333', 'FF3366', 'FF3399', 'FF33CC', 'FF33FF', 'FF6600', 'FF6633', 'FF6666', 'FF6699', 'FF66CC', 'FF66FF', 'FF9900', 'FF9933', 'FF9966', 'FF9999', 'FF99CC', 'FF99FF', 'FFCC00', 'FFCC33', 'FFCC66', 'FFCC99', 'FFCCCC', 'FFCCFF', 'FFFF00', 'FFFF33', 'FFFF66', 'FFFF99', 'FFFFCC', 'FFFFFF');
													
	private $input_html_array 						= array();
	                                    			
	private $salt									= "123456789";
	private $encrypt_type							= "md5";
													
	public $shapes									= array();
	                                    			
	public $num_inputs								= 3;							// Number of inputs to display for captcha
	public $image_loc								= 'image.php';					// Same directory as file using class
	public $image_size								= 180;							// Width and Height of images
													
	public $js_loc									= 'gg_captcha.js';				// Location of the required Javascript file
	public $js_click_handler						= 'captchaClickHandler';		// The name of the Javascript function that will be called on the click event of the Captcha images
	public $js_clear_checkboxes_handler				= 'captchaCheckboxLoadHandler';	// The name of the Javascript function that will be called when the images load
	
	
	/*
		TODO $container_prefix and $container_sufix have not been implemented yet. Are they even needed???
	*/
	
	public $container_prefix						= '';
	public $container_suffix						= '';
	public $container_id							= 'captcha';					// The id the container div element will have
	public $container_class 						= '';							// The class the container div element will have
													
	public $for_id_prefix							= '';
	public $for_id_suffix							= '';
													
	public $label_tag								= 'label';
	public $label_style 							= 'float:left; padding:5px;';
	// public $label_style 							= 'padding:5px;';
	public $label_class 							= '';
													
	public $label_text_tag							= 'span';
	public $label_text_style 						= 'display:none;';
	public $label_text_class 						= '';
													
	public $image_tag								= 'img/';
	public $image_tag_class 						= '';
													
	public $input_tag								= 'input/';
	public $input_type								= 'checkbox';
	public $input_name								= 'captcha';
	public $input_class 							= '';
	public $input_style 							= 'display:none;';
	// public $input_style 							= '';
													
	private $selected_styles						= 'opacity:.5;';
													
	private $submit_array							= array();
	private $error_msg								= '';
	
	private $error_text['could_not_find_captcha']	= 'Could not find Captcha input.';
	private $error_text['too_few_selected']			= 'Too few items selected in Captcha.';
	private $error_text['too_many_selected']		= 'Too many items selected in Captcha.';
	private $error_text['did_not_match']			= 'The items selected did not match.';
	
	function __construct() {
		// Nothing to see here...
	}
	
	//Setters
	
	public function setNumInputs($num) {
		if($num >= self::min_inputs) $this->num_inputs = $num;
	}
	
	public function setColors($colors) {
		//Expects an array of HEX colors.
		//Array count should be at least one greater than $this->num_images
		$this->colors				= $colors;
	}
	
	public function setShapes($shapes = array()) {
		//Expects an array of shape strings
		$this->shapes				= $shapes;
	}
	
	public function setImageLoc($loc) {
		$this->image_loc			= $loc;
	}
	
	public function setInputName($name) {
		$this->input_name			= $name;
	}
	
	//Public Methods
	
	public function dumpObject($what = 'all') {
		switch($what) {
			case 'all':
				
				echo "\n<strong>" . __FILE__ . " Line: " . __LINE__ . "</strong>\n";
				echo "\n<pre style=\"text-align:left; line-height:1.1em;\">\n";
				print_r($this);
				echo "</pre>\n";
			
				break;
				
			case 'validation':
			
				echo "\n<strong>Items Submitted:</strong>\n";
				echo "\n<pre style=\"text-align:left; line-height:1.1em;\">\n";
				print_r($this->submit_array);
				echo "</pre>\n";
				
				echo "\n<strong>Error Message:</strong>\n";
				echo "\n<pre style=\"text-align:left; line-height:1.1em;\">\n";
				print_r($this->error_msg);
				echo "</pre>\n";
				
				break;
				
			default:
				
				echo "\n<strong>" . __FILE__ . " Line: " . __LINE__ . "</strong>\n";
				echo "\n<pre style=\"text-align:left; line-height:1.1em;\">\n";
				print_r($this);
				echo "</pre>\n";
			
				break;
		}
		
		
	}
	
	public function removeColors($colors) {
		foreach($colors as $i => $color) {
			$item_to_remove	= array_search($color, $this->colors);
			unset($this->colors[$item_to_remove]);
		}
	}
	
	public function buildHTML() {
		
		if($this->checkForSufficientNumColors()) {
			$this->shuffleArrays();
			
			//Set up captcha instance variables.
			$dup_shape	 					= array_rand($this->available_shapes); 			// Pick a shape to use twice
			$dup_color	 					= array_rand($this->colors); 					// Pick a color to use twice
			$dup_pos						= rand(0, count($this->available_shapes) - 1); 	// Pick a random spot for the duplicate item
			
			// Loop through all the available shapes
			foreach($this->available_shapes as $i => $shape) {
				// Push HTML string into array so it can easily be shuffled
				$this->input_html_array[]						= $this->buildInputHTML($shape, $this->colors[$i], $this->nouns[$i]);
				// If the duplicate position is the same as $i push a second HTML string into the array
				if($dup_pos == $i) $this->input_html_array[]	= $this->buildInputHTML($shape, $this->colors[$i], $this->nouns[$i], true);
				
			}
			
			shuffle($this->input_html_array);
			
			$final_html						 = '<div id="' . $this->container_id . '" class="' . $this->container_class . '">' . "\n";
			$final_html						.= $this->buildSelectedScript();
			
			foreach($this->input_html_array as $j => $input) {
				$final_html						.= $input;
			}
			
			$final_html						.= '</div>' . "\n";
			
			return $final_html;
		}
		
	}
	
	public function validate($method_array, $callback, $args = array()) {
		
		$input_name = $this->input_name;
		
		if(isset($method_array[$input_name])) {
			$this->submit_array 		= $method_array[$input_name];
			if(count($this->submit_array) == 2) {
				if($this->submit_array[0] == $this->submit_array[1]) {
					$callback($args);
				}
				else {
					$this->error_msg			= $this->error_text['did_not_match'];
				}
			}
			else {
				if(count($this->submit_array) > 2) {
					$this->error_msg			= $this->error_text['too_many_selected'];
				}
				else {
					$this->error_msg			= $this->error_text['too_few_selected'];
				}
			}
		}
		else {
			$this->error_msg			= $this->error_text['could_not_find_captcha'];
		}
		
		
		
	}
	
	//Private Methods
	
	private function checkForSufficientNumColors() {
		if(count($this->available_shapes) <= count($this->colors)) {
			return true;
		}
		return false;
	}
	private function shuffleArrays() {
		shuffle($this->available_shapes);
		shuffle($this->nouns);
		shuffle($this->colors);
	}
	
	private function buildInputHTML($shape, $color, $value, $dup = false) {
		
		if($dup == true) {
			$dup_suffix			= '_';
			//$value				= strrev($value);
		}
		else {
			$dup_suffix			= '';
		}
		
		$time_id					= time();
		
		if(strpos($this->label_tag, '/') != true) {
			$label_html				= "\t" . '<' . str_replace('/', '', $this->label_tag) . ' for="' . $this->for_id_prefix . $value . '_' . $time_id . '_' . $dup_suffix . $this->for_id_suffix . '" style="' . $this->label_style . '" class="' . $this->label_class . '" onClick="' . $this->js_click_handler . '(this, \'' . $this->container_id . '\');">' . "\n";
			if(strpos($this->label_text_tag, '/') != true) {
				$label_html				.= "\t\t" . '<' . str_replace('/', '', $this->label_text_tag) . ' style=" ' . $this->label_text_style . '">' . $value . '</' . str_replace('/', '', $this->label_text_tag) . '>' . "\n";
			}
			else {
				$label_html				.= "\t\t" . '<' . str_replace('/', '', $this->label_text_tag) . ' style=" ' . $this->label_text_style . '" />' . "\n";
			}
			$label_html				.= "\t\t" . '<img class="captcha_image" src="' . $this->image_loc . '?s=' . $shape . '&c=' . $color . '&w=' . $this->image_size . '" alt="' . $value . '" rel="' . $this->for_id_prefix . $value . '_' . $time_id . '_' . $dup_suffix . $this->for_id_suffix . '" onLoad="' . $this->js_clear_checkboxes_handler . '(this);" />' . "\n";
			$label_html		 		.= "\t" . '</' . str_replace('/', '', $this->label_tag) . '>' . "\n";
		}
		else {
			$label_html				= "\t" . '<' . str_replace('/', '', $this->label_tag) . ' for="' . $this->for_id_prefix . $value . '_' . $time_id . '_' . $dup_suffix . $this->for_id_suffix . '" style="' . $this->label_style . '" class="' . $this->label_class . '" />' . "\n";
		}
		
		$return 		 	=  $label_html;
		$return 			.= "\t" . '<input type="' . $this->input_type . '" name="' . $this->input_name . '[]" id="' . $this->for_id_prefix . $value . '_' . $time_id . '_' . $dup_suffix . $this->for_id_suffix . '" value="' . $value . '" style="' . $this->input_style . '" class="' . $this->input_class . '" />' . "\n";
		
		return $return;
		
	}
	
	private function buildSelectedScript() {
		$return				 = '<script type="text/javascript" src="' . $this->js_loc . '"></script>' . "\n";
		
		return $return;
	}
	
	private function encrypt($value) {
		
	}
	
}
?>
