<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <div class="from-group">
            <label for="email">メールアドレス</label>
            <div class='input-group'>
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-envelope"></span>
                        </span>
                <input type="text" class="form-control" name="email" placeholder="メールアドレス"
                       value="{if isset($smarty.session.user.email)}{$smarty.session.user.email}{/if}">
            </div>
        </div>
        <div class="from-group">
            <label for="name">名前</label>
            <div class='input-group'>
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-user"></span>
                        </span>
                <input type="text" class="form-control" name="name" placeholder="名前"
                       value="{if isset($smarty.session.user.name)}{$smarty.session.user.name}{/if}">
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
        <div class="from-group">
            <label for="password_confirmation">パスワードの確認</label>
            <div class='input-group'>
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-lock"></span>
                        </span>
                <input type="password" class="form-control" name="password_confirmation" placeholder="パスワードの確認"
                       value="">
            </div>
        </div>
    </div>
</div>
