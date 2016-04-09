<nav class="navbar navbar-default navbar-fixed-top navbar-inverse" xmlns="http://www.w3.org/1999/html">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" id="logo" href="{site_url}">ロゴ</a>

            <!--トグルボタン-->
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#nav-content">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>

        <div id="nav-content" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="{site_url}"><span class="glyphicon glyphicon-home"></span>　ホーム</a></li>
                {if isset($smarty.session.is_logged_in) && $smarty.session.is_logged_in === 1}
                    <li><a href="{site_url}news"><span class="glyphicon glyphicon-globe"></span>　ニュース</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                           aria-haspopup="true" aria-expanded="false">
                            <span class="glyphicon glyphicon-user"></span>　{$smarty.session.user.name}
                            <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="{site_url}users/edit/{$smarty.session.user.id}">
                                    <span class="glyphicon glyphicon-pencil"></span>　編集</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="{site_url}logout"><span class="glyphicon glyphicon-log-out"></span>　ログアウト</a></li>
                        </ul>
                    </li>
                {else}
                    <li><a href="{site_url}users/create"><span class="glyphicon glyphicon-plus-sign"></span>　ユーザー登録</a></li>
                    <li><a href="#loginModal" data-toggle="modal"><span class="glyphicon glyphicon-log-in"></span>　ログイン</a></li>
                {/if}
            </ul>
        </div>
    </div>
</nav>

<div class="modal" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel">
    <div class="modal-dialog" role="document">
        <form action="{site_url}login" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="loginModalLabel">ログイン</h4>
                </div>
                <div class="modal-body">
                    {include file='pages/login_fields.tpl'}
                </div>
                <div class="modal-footer">
                    <div class="row">
                        <div class="col-md-6 col-md-offset-1">
                            <button type="submit" name="submit" class="btn btn-primary">ログイン</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>