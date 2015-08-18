<?php
session_start();
include_once("include_files/html.inc.php");
Header_Html();

?>
<main class="page-main">
	<div class="row">
		<div class="small-12 column content">
			<div id="block-603" class="clearfix cb cb-textarea">
				<h1>Add Temperature</h1>
				<form action="addtemps.php">
						<div>
							<label for="Station">Station:</label>
							<select name="Station" id="Station">
				<option value='1'>1849</option>
				<option value='2'>Bean and Creamery</option>
				<option value='3'>Buckingham Bakery</option>
				<option value='4'>Buona Cucina</option>
				<option value='5'>Capital City Pizza</option>
				<option value='6'>Delicious</option>
				<option value='7'>Fired Up</option>
				<option value='8'>Global Kitchen</option>
				<option value='9'>Great Greens</option>
				<option value='11'>Maki-Mono</option>
				<option value='10'>Qué Rico</option>
							</select>
						</div>
						<div>
							<label for="Item">Item:</label>
							<select name="Item" id="Item">
				<option value='2'>Mac 'n Cheese</option>			</select>
						</div>
						<div>
							<label for="Unit">Unit:</label>
							<select name="Unit" id="Unit">
				<option value='17'>Carson's Market</option><option value='13'>Four Lakes Central Production</option><option value='12'>Four Lakes Market</option><option value='19'>Gordon Central Production</option><option value='18'>Gordon Cook Chill</option><option value='20'>Gordon Market</option><option value='16'>Liz's Market</option><option value='15'>Newell's Deli</option><option value='14'>Rheta's Market</option>			</select>
						</div>
						<div>
							<label for="Temp">Temp:</label>
							<input type="text" name="Temp" id="Temp">
						</div>
						<div>
							<input type="submit">
						</div>
					</form>
			</div>
		</div>
	</div>
</main>
</body>
</html>