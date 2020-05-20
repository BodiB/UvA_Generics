<!DOCTYPE html>
<html>
<head>
<link rel='stylesheet' href='css.css'>
<script src="mem.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
<body>
<ul class="rate-statement">
<li>
	<input type="radio" id="-3" name="rating" value="-3" onclick="this.form.submit()" />
	<label for="-3">Strongly disagree</label>
</li>
<li><input type="radio" id="-2" name="rating" value="-2" onclick="this.form.submit()" /><label for="-2">Disagree</label></li><li><input type="radio" id="-1" name="rating" value="-1" onclick="this.form.submit()" /><label for="-1">Somewhat disagree</label></li><li><input type="radio" id="0" name="rating" value="0" onclick="this.form.submit()" /><label for="0">Neither agree nor disagree</label></li><li><input type="radio" id="1" name="rating" value="1" onclick="this.form.submit()" /><label for="1">Somewhat agree</label></li><li><input type="radio" id="2" name="rating" value="2" onclick="this.form.submit()" /><label for="2">Agree</label></li><li><input type="radio" id="3" name="rating" value="3" onclick="this.form.submit()" /><label for="3">Strongly agree</label></li></ul>
</body>
</html>