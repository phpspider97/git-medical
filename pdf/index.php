<!doctype html>
<HTML>
<HEAD>
<TITLE>Convert HTML to multi-page Pdf</TITLE>
<link href="assets/css/style.css" type="text/css" rel="stylesheet" />
</HEAD>
<BODY>
	<div id="container">
		<div class="link-container">
			<select id="convertion-type">
    			<option value="split">Split HTML to Multi-Page PDF</option>
    			<option value="">Add HTML to PDF Page</option>
			</select>
			<button class="btn-convert">Convert
				HTML to PDF</button>
		</div>
		<div class="single-html-block">
			<div id="html-template">
				<?php require_once __DIR__ . '/Template/html-template.php'; ?>
			</div>

			<div id="html-template1">
			<?php require_once __DIR__ . '/Template/html-template1.php'; ?>
			</div>

			<div id="html-template2">
				<?php require_once __DIR__ . '/Template/html-template2.php'; ?>
			</div>

		</div>
	</div>

</BODY>
<script src="https://code.jquery.com/jquery-2.1.3.js"></script>
<script
	src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.3/jspdf.min.js"></script>
<script src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>

<script src="assets/js/convert.js"></script>
</HTML>