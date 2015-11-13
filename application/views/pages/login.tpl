{extends file='templates/application.tpl'}
{block name=title}
    {'Login | サンプルアプリケーション'}
{/block}
{block name=main_contents}
    <h1>{'ログインページ'}</h1>
    <form method="post" action="" accept-charset="utf-8">
        {include file='pages/login_fields.tpl'}
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <input type="submit" name="submit" class="btn btn-primary" value="ログイン"/>
            </div>
        </div>
    </form>
{/block}