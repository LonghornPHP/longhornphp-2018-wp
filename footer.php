</div><!-- #content -->

<footer class="site-footer" role="contentinfo">
    <div class="container">
    	<div class="site-info">
            <?php the_field('footer_text', 'options'); ?>
    	</div>
    </div>
</footer>

<?php wp_footer(); ?>

<script>
    jQuery(document).ready(function($) {
        if (typeof TitoWidget !== 'undefined') {
            TitoWidget.buildWidgets();
        }
    });
</script>

<!-- https://developers.google.com/speed/docs/insights/OptimizeCSSDelivery -->
<script>
  var loadDeferredStyles = function() {
    var addStylesNode = document.getElementById("deferred-styles");
    var replacement = document.createElement("div");
    replacement.innerHTML = addStylesNode.textContent;
    document.body.appendChild(replacement)
    addStylesNode.parentElement.removeChild(addStylesNode);
  };
  var raf = window.requestAnimationFrame || window.mozRequestAnimationFrame ||
      window.webkitRequestAnimationFrame || window.msRequestAnimationFrame;
  if (raf) raf(function() { window.setTimeout(loadDeferredStyles, 0); });
  else window.addEventListener('load', loadDeferredStyles);
</script>

</body>
</html><?php
