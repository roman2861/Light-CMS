Комментарии:
{foreach from=$comments item=item}

<p class="meta">Опубликовал: <em>{if !empty($item.email) }<a href="mailto:{$item.email}">
{$item.author}</a>{else} {$item.author} {/if}</em> Дата:<em>{$item.date} </em></p>
	<div class="entry">
	<p>{$item.text}</p>

			</div>
            <hr>
        {foreachelse}
    <br />Их нет пока
{/foreach}
		 
	