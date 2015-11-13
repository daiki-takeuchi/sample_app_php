<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <div class="form-group">
            <label for="email">メールアドレス</label>
            <div class='input-group'>
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-envelope"></span>
                        </span>
                <input type="text" class="form-control" name="email" placeholder="メールアドレス"
                       value="{if isset($post['email'])}{$post['email']}{/if}">
            </div>
        </div>
        <div class="form-group">
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
