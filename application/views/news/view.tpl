{extends file='templates/application.tpl'}

{block name=title}
    {{$title}}
{/block}

{block name=jumbotron}
    <header id="news_title" class="jumbotron">
        <div class="container">
            <h1>{$news_item['title']|escape}</h1>
            <div class="right">{$news_item['created_at']}</div>
            <div class="right">{$author|escape}</div>
        </div>
    </header>
{/block}
{block name=main_contents}
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    {$news_item['text']|escape|nl2br}
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <a class="btn btn-primary" href="{site_url}news">一覧に戻る</a>
            <a class="btn btn-primary" href="{site_url}news/edit/{$news_item['id']}">編集</a>
            <a class="btn btn-danger" href="{site_url}news/delete/{$news_item['id']}">削除</a>
        </div>
    </div>
{/block}