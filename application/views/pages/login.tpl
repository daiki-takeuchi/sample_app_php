{extends file='templates/application.tpl'}
{block name=title}
    {'Login | サンプルアプリケーション'}
{/block}
{block name=main_contents}
    <h1>{'ログインページ'}</h1>
    <form method="post" action="" accept-charset="utf-8">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="from-group">
                    <label for="email">メールアドレス</label>
                    <div class='input-group'>
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-envelope"></span>
                        </span>
                        <input type="text" class="form-control" name="email" placeholder="メールアドレス"
                               value="{if isset($post['email'])}{$post['email']}{/if}">
                    </div>
                </div>
                <div class="from-group">
                    <label for="password">パスワード</label>
                    <div class='input-group'>
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-lock"></span>
                        </span>
                        <input type="password" class="form-control" name="password" placeholder="パスワード"
                               value="">
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <input type="submit" name="submit" class="btn btn-primary" value="ログイン"/>
            </div>
        </div>
    </form>
{/block}