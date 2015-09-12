{extends file='templates/application.tpl'}

{block name=title}
    {{$title}}
{/block}

{block name=main_contents}
    <h1>ユーザー情報</h1>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    {$user_item['name']|escape}
                </div>
                <div class="panel-body">
                    {$user_item['email']|escape|nl2br|strip:""}
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <a class="btn btn-primary" href="{site_url}">ホームに戻る</a>
            <a class="btn btn-primary" href="{site_url}users/edit/{$user_item['id']}">編集</a>
        </div>
    </div>
{/block}