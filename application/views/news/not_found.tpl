{extends file='templates/application.tpl'}

{block name=title}
    {'News Not Found'}
{/block}

{block name=main_contents}
    <div class="container not_found">
        <h1>News Not Found</h1>
        <p>The news you requested was not found.</p>
    </div>
{/block}