		</div>

</div></div>
<div class="content">
{foreach from=$news item=item}
<div class="sidecontent">
		<div class="ctop"><a href="posts_{$item.id}_1.html">{$item.title}</a></div>
			<div class="ccon">
           {$item.text}
		</div>
		<div class="cinfo"> ������������: {$item.comments}</div>
  <div class="cinfo">����������: {$item.views}</div>
		<div class="cinfo" style="float: right;"><a href="posts_{$item.id}_1.html" class="links">�����...</a></div>
</div>
        {foreachelse}
    ������ �� �������
{/foreach}