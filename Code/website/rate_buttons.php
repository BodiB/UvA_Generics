<?php
$_SESSION['data'] = $data;
$difference = abs($data['scale_min']-$data['scale_max'])+1;
if ($difference%2 == 0) {
    // Should not possible, but catch it anyways.
    $difference = $difference - 1;
    $blocks = range($data['scale_min'], $data['scale_max']-1);
} else {
    $blocks = range($data['scale_min'], $data['scale_max']);
}
?>
<script>
	$(document).ready(function(){
		$(".rate-statement li").css({"width":"<?php echo((840-(count($blocks)*30))/count($blocks)); ?>px", "font-size": "<?php echo min(20, (((800-(count($blocks)*35))/count($blocks))/3.5)); ?>px"});
	});
</script>
<ul class="rate-statement">
<?php
$center = ($data['scale_max']+$data['scale_min'])/2;
$agreement = [$data['scale_min']=>"Strongly disagree", $center=>"Neutral", $data['scale_max']=>"Strongly agree"];
foreach ($blocks as $key => $value) {
    echo '<li>';
    echo '<input type="radio" id="'.$value.'" name="rating" value="'.$value.'" onclick="this.form.submit()" />';
    if (array_key_exists($value, $agreement)) {
        echo '<label for="'.$value.'">'.$agreement[$value].'</label>';
    } else {
        echo '<label for="'.$value.'"></label>';
    }
    echo '</li>';
}


?>
</ul>
