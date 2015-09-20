{extends file='templates/application.tpl'}
{block name=title}
    {$title}
{/block}
{block name=main_contents}
    <h1>{$title}</h1>
    <form method="post" action="" accept-charset="utf-8">
        {include file='users/user_fields.tpl'}
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <input type="submit" name="submit" class="btn btn-primary" value="登録"/>
                <a class="btn btn-primary" href="{site_url}">ホームに戻る</a>
            </div>
        </div>
    </form>
{/block}