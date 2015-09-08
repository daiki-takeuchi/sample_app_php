<div class="row">
    <div class="col-md-12">
        <div class="from-group">
            <label for="title">タイトル</label>
            <input type="text" class="form-control" name="title" placeholder="タイトルを入力して下さい。"
                   value="{if isset($news_item['title'])}{$news_item['title']}{/if}">
        </div>
        <div class="from-group">
            <label for="text">内容</label>
            <textarea class="form-control" name="text" rows="3"
                      placeholder="ニュースの内容を入力して下さい。">{if isset($news_item['text'])}{$news_item['text']}{/if}</textarea>
        </div>
    </div>
</div>
