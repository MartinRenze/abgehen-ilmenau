<?php

	$noMenu = "";
	$noMenu = $_GET["noMenu"];
	if($noMenu != "true") {
	?>
		<hr />
		<ul class="menuFooter">
			<li class="<?php if($page=="impressum") echo "active"; ?>"><a href="index.php?page=impressum">Impressum</a></li>
			<li class="floatRight">&copy; 2015</li>
		</ul>
	<?php } ?>
		
		</div>	
<!-- Piwik -->
<script type="text/javascript">
  var _paq = _paq || [];
  _paq.push(['trackPageView']);
  _paq.push(['enableLinkTracking']);
  (function() {
    var u="//abgehen-ilmenau.byethost32.com/piwik/";
    _paq.push(['setTrackerUrl', u+'piwik.php']);
    _paq.push(['setSiteId', 1]);
    var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
    g.type='text/javascript'; g.async=true; g.defer=true; g.src=u+'piwik.js'; s.parentNode.insertBefore(g,s);
  })();
</script>
<noscript><p><img src="//abgehen-ilmenau.byethost32.com/piwik/piwik.php?idsite=1" style="border:0;" alt="" /></p></noscript>
<!-- End Piwik Code -->

	</body>
</html>
