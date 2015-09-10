<nav class="navbar navbar-default navbar-fixed-top navbar-inverse">
    <div class="container-fluid">
        <a id="logo" href="{site_url}">ロゴ</a>

        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="{site_url}"><span class="glyphicon glyphicon-home"></span>　ホーム</a></li>
                {if isset($smarty.session.is_logged_in) && $smarty.session.is_logged_in === 1}
                    <li><a href="{site_url}news"><span class="glyphicon glyphicon-globe"></span>　ニュース</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                           aria-haspopup="true" aria-expanded="false">
                            <span class="glyphicon glyphicon-menu-hamburger"></span>　{$smarty.session.user.name}
                            <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">編集</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="{site_url}logout">ログアウト</a></li>
                        </ul>
                    </li>
                {else}
                    <li><a href="{site_url}login"><span class="glyphicon glyphicon-user"></span>　ログイン</a></li>
                {/if}
            </ul>
        </div>
    </div>
</nav>