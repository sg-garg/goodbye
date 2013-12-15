<style>
#nonav				{cursor:pointer;}
.tooltip			{margin:8px;padding:8px;border:1px solid #0a0f32;background-color: #e3e65a;position: absolute;z-index: 2;}
</style>
<span id="nonav"><img src="img/nav-block.jpg" alt="Navigation" height="32" width="606" border="0"></span>
<script type="text/javascript">
$(document).ready(function() {var changeTooltipPosition = function(event) {var tooltipX = event.pageX - 8;var tooltipY = event.pageY + 8;$('div.tooltip').css({top: tooltipY, left: tooltipX});};
var showTooltip = function(event) {$('div.tooltip').remove();
$('<div class="tooltip">You must fill out all required information on this page.</div>')
.appendTo('body');changeTooltipPosition(event);};
var hideTooltip = function() {$('div.tooltip').remove();};$("span#nonav").bind({mousemove : changeTooltipPosition,mouseenter : showTooltip,mouseleave: hideTooltip});
});
</script>