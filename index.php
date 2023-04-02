<!DOCTYPE html>
<html>
<head>
	<title>Website Scraper with Google Search and Dorking</title>
</head>
<body>
	<form method="post" action="scraper.php">
		<label for="url">Enter URL:</label>
		<input type="text" name="url" id="url">
		<br><br>
		<label for="dork">Select Google Dork:</label>
		<select name="dork" id="dork">
			<option value="site">Site Search</option>
			<option value="intitle">Intitle Search</option>
			<option value="inurl">Inurl Search</option>
			<option value="intext">Intext Search</option>
		</select>
		<br><br>
		<label for="query">Enter Search Query:</label>
		<input type="text" name="query" id="query">
		<br><br>
		<input type="submit" value="Scrape">
	</form>
</body>
</html>
