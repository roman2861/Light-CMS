{foreach from=$news item=item}
<div id="content">
			<div class="post">
				<h2 class="title"><a href="#">{$item.title)</a></h2>
				<div style="clear: both;">&nbsp;</div>
				<div class="entry">
{$item.text)
					<p class="links"><a href="posts_{$item.id}_1.html" class="links">�����...</a>&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;������������: {$item.comments}&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;����������: {$item.views}</p>
				</div>
			</div>
        {foreachelse}
    ������ �� �������
{/foreach}