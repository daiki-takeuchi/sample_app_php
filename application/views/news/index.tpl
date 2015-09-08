{extends file='templates/application.tpl'}

{block name=title}
    {{$title}}
{/block}

{block name=main_contents}
    <h1>ニュース一覧</h1>
    <div class="row">
        <div class="col-md-12">
            <div class="list-group">
                {foreach from=$news item=news_item}
                    <a class="list-group-item" href="{site_url}news/{$news_item['id']}">
                        <h4 class="list-group-item-heading">
                            {$news_item['title']|escape}
                        </h4>

                        <p class="list-group-item-text">
                            {$news_item['text']|escape|nl2br|strip:""}
                        </p>
                    </a>
                {/foreach}
            </div>
            {$pagination}
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <a class="btn btn-primary" href="{site_url}news/create">ニュース登録</a>
        </div>
    </div>
{/block}