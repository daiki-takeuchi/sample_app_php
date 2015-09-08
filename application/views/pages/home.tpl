{extends file='templates/application.tpl'}

{block name=title}
    {'ホーム | サンプルアプリケーション'}
{/block}

{block name=jumbotron_h2}
    {'ホーム'}
{/block}

{block name=jumbotron}
    {include file='templates/jumbotron.tpl'}
{/block}

{block name=main_contents}
    <div class="container home">
        <h1>ようこそホームへ！</h1>

        <div class="row">
            <div class="col-lg-4">
                <img class="img-circle" src="{site_url}assets/images/Penguins.jpg" width="180" height="180">

                <h2>ペンギン</h2>

                <p>ペンギン　ペンギン　ペンギン　ペンギン　ペンギン　ペンギン　ペンギン　ペンギン</p>

                <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <img class="img-circle" src="{site_url}assets/images/Koala.jpg" width="180" height="180">

                <h2>こあら</h2>

                <p>こあら　こあら　こあら　こあら　こあら　こあら　こあら　こあら</p>

                <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <img class="img-circle" src="{site_url}assets/images/Tulips.jpg" width="180" height="180">

                <h2>チューリップ</h2>

                <p>チューリップ　チューリップ　チューリップ　チューリップ　チューリップ</p>

                <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
            </div>
        </div>
    </div>
{/block}