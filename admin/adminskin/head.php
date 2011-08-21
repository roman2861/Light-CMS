<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script src="http://js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
<script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />
<title><?=$pagename?> - Админцентр</title>
<link href="styles/layout.css" rel="stylesheet" type="text/css" />
<link href="styles/wysiwyg.css" rel="stylesheet" type="text/css" />
<!-- Theme Start -->
<link href="themes/blue/styles.css" rel="stylesheet" type="text/css" />
<!-- Theme End -->
    <script type="text/javascript" SRC="http://dwpe.googlecode.com/svn/trunk/_shared/EnhanceJS/enhance.js"></script>	
    <script type='text/javascript' SRC="http://dwpe.googlecode.com/svn/trunk/charting/js/excanvas.js"></script>
	<script type='text/javascript' SRC="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
    <script type='text/javascript' SRC="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.6/jquery-ui.min.js"></script>
<script type='text/javascript' src='scripts/jquery.form.js'></script>
    
    <!--[if IE 6]>
    <script type='text/javascript' src='scripts/png_fix.js'></script>
    <script type='text/javascript'>
      DD_belatedPNG.fix('img, .notifycount, .selected');
    </script>
    <![endif]-->
    <script type="text/javascript">
// prepare the form when the DOM is ready 
$(document).ready(function() { 
    // bind form using ajaxForm 
    $('#form').ajaxForm({ 
        // target identifies the element(s) to update with the server response 
        target: '#otvet', 
 
        // success identifies the function to invoke when the server response 
        // has been received; here we apply a fade-in effect to the new content 
        success: function() { 
            $('#otvet').fadeIn('slow'); 
        } 
    }); 
});
</script>
</head>
<body id="homepage">
	<div id="header">
    	<a href="index.php" title=""><img SRC="images/cp_logo.png" alt="Control Panel" class="logo" /></a>
</div>