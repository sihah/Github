<style>
.col_1 {
	background-color: #FFFACD; 
}
.col_2 {
	background-color: #FAFAD2; 
}
.col_3 {
	background-color: #FFEFD5; 
}
.col_4 {
	background-color: #FFE4B5; 
}
</style>
<?php
/*
*Print an associative array as an ASCII table. For example let’s say you have this array:

array(
    array(
        'Name' => 'Trixie',
        'Color' => 'Green',
        'Element' => 'Earth',
        'Likes' => 'Flowers'
        ),
    array(
        'Name' => 'Tinkerbell',
        'Element' => 'Air',
        'Likes' => 'Singning',
        'Color' => 'Blue'
        ),
    array(
        'Element' => 'Water',
        'Likes' => 'Dancing',
        'Name' => 'Blum',
        'Color' => 'Pink'
        ),
);

And expect this output:


+----------+---------+---------+----------+
| Name     | Color   | Element |  Likes   |
+----------+---------+---------+----------+
| Trixie   | Green   | Earth   | Flowers  |
| Tinker   | Blue    | Air     | Singing  |
| Blum     | Pink    | Water   | Dancing  |
+----------+---------+---------+----------+

Can you color each column in a different color?
Please provide a fully unittest covered functionality.
*/
 
const X_SPACE = 1;
const Y_SPACE = 0;
const JOINING_CHAT = '+';
const X_LINE = '-'; //character to use in X line
const Y_LINE = '|'; //character to use in Y line
 
$table_data = array(
	array(
		'Name' => 'Trixie',
		'Color' => 'Green',
		'Element' => 'Earth',
		'Likes' => 'Flowers'
	),
	array(
		'Name' => 'Tinkerbell',
		'Element' => 'Air',
		'Likes' => 'Singing',
		'Color' => 'Blue'
	),
	array(
		'Element' => 'Water',
		'Likes' => 'Dancing',
		'Name' => 'Blum',
		'Color' => 'Pink'
	),
);
 
function draw_table($table_data){
	 
	$nl = "\n";
	$columns_headers = columns_headers($table_data); 
	$columns_lengths = columns_lengths($table_data, $columns_headers); 
	$row_separator = row_seperator($columns_lengths);
	$row_spacer = row_spacer($columns_lengths);
	$row_headers = row_headers($columns_headers, $columns_lengths);
	 
	echo '<pre>';
	 
	echo $row_separator . $nl; //top row separator line
	echo $row_headers . $nl; // print table title
	echo $row_separator . $nl; //2nd row separator line
	echo str_repeat($row_spacer . $nl, Y_SPACE);
	foreach($table_data as $row_cells)
	{
		$row_cells = row_cells($row_cells, $columns_headers, $columns_lengths);
		echo $row_cells . $nl;
		echo str_repeat($row_spacer . $nl, Y_SPACE);
	}
	echo $row_separator . $nl;
	 
	echo '</pre>';
 
}
 
function columns_headers($table_data){
	return array_keys(reset($table_data));
}
 
function columns_lengths($table_data, $columns_headers){
	$lengths = [];
		foreach($columns_headers as $header)
		{
			$header_length = strlen($header);
			$max = $header_length;
			foreach($table_data as $row)
			{
				$length = strlen($row[$header]);
				if($length > $max)
				$max = $length;
			}
			 
			if(($max % 2) != ($header_length % 2))
			$max += 1;
			 
			$lengths[$header] = $max;
		}
	 
	return $lengths;
}
 
function row_seperator($columns_lengths){
	$row = '';
	$x = 1;
	foreach($columns_lengths as $column_length)
	{
		$row .= '<span class="col_'.$x.'">'.JOINING_CHAT . str_repeat(X_LINE, (X_SPACE * 2) + $column_length).'</span>';
		$x += 1;
	}
	$row .= JOINING_CHAT ;
	 
	return $row;
}

function print_col($column_length) {
	return JOINING_CHAT . str_repeat(X_LINE, (X_SPACE * 2) + $column_length);
}

function row_spacer($columns_lengths){
	$row = '';
		foreach($columns_lengths as $column_length)
		{
			$row .= Y_LINE . str_repeat(' ', (X_SPACE * 2) + $column_length);
		}
		$row .= Y_LINE;
		 
	return $row;
}
 
function row_headers($columns_headers, $columns_lengths){
	$row = '';
	$x = 1;
	foreach($columns_headers as $header)
	{			
		$row .= '<span class="col_'.$x.'">'.Y_LINE . str_pad($header, (X_SPACE * 2) + $columns_lengths[$header] , ' ', STR_PAD_BOTH).'</span>' ;
		$x += 1;
	}
	$row .= Y_LINE;
	 
	return $row;
}
 
function row_cells($row_cells, $columns_headers, $columns_lengths){
	$row = '';
	$x = 1;
	foreach($columns_headers as $header)
	{
		$row .= '<span class="col_'.$x.'">'.Y_LINE . str_repeat(' ', X_SPACE) . str_pad($row_cells[$header], X_SPACE + $columns_lengths[$header], ' ', STR_PAD_RIGHT).'</span>';
		$x += 1;
	}
	$row .= Y_LINE;
	 
	return $row;
}
 
draw_table($table_data);
?>