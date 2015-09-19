{extends file='templates/application.tpl'}

{block name=title}
    {'User Not Found'}
{/block}

{block name=main_contents}
    <div class="container not_found">
        <h1>User Not Found</h1>
        <p>The user you requested was not found.</p>
    </div>
{/block}