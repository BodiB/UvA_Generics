<?php
function make_dropdown($var_name, $id, $img)
{
    $files = scandir('img');
    echo '<select class="image_edit" id="'.$var_name.'-'.$id.'" name="'.$var_name.'"">';
    foreach ($files as $key => $value) {
        if ($key >= 2) {
            $string = 'img/'.$value;
            if (strcmp(trim($string), trim($img)) == 0) {
                echo '<option id="'.$var_name.'-'.$id.'" value="'.$value.'" selected>'.explode(".", $value)[0].'</option>';
            } else {
                echo '<option id="'.$var_name.'-'.$id.'" value="'.$value.'">'.explode(".", $value)[0].'</option>';
            }
        }
    }
    echo '</select>';
}
