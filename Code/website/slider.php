<script>
        $('input').on('change', function() {
            alert($(this).val());
        })

    </script>
<div class="slider_container" id="slider">
        Not at all
        <input type="range" min=<?php echo $data['scale_min']; ?> max=<?php echo $data['scale_max']; ?> value=<?php echo ceil(($data['scale_max']-$data['scale_min'])/2)+$data['scale_min']; ?> step="1" list="tickmarks" id="rangeInput" name="rangeInput" oninput="output.value = rangeInput.value">
        Certainly
        <output id="output" for="rangeInput"><?php echo ceil(($data['scale_max']-$data['scale_min'])/2)+$data['scale_min']; ?></output> <!-- Just to display selected value -->
    </div>
