{extends file='templates/application.tpl'}

{block name=title}
    {'404 Page Not Found'}
{/block}

{block name=main_contents}
    <div class="container not_found">
        <h1>404 Page Not Found</h1>
        <p>The page you requested was not found.</p>
    </div>
{/block}