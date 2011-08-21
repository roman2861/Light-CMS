		</div>

</div></div>
<script type="text/javascript" src="templates/{$theme}/js/jquery.autoheight.js"></script>
<div class="content">
{foreach from=$news item=item}
<div class="sidecontent">
		<div class="ctop"><a href="posts_{$item.id}_1.html">{$item.name}</a></div>
			<div class="ccon">
           {$item.text}
		</div>
</div>
        {foreachelse}
    Ничего не найдено
{/foreach}