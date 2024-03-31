<div class="tab-pane fade show active" id="post" role="tabpanel" aria-labelledby="post-tab">
    <!-- Content for Post tab -->
    <div class="form-group">
        <label for="post-title">Title</label>
        <input type="text" class="form-control @error('post_title') is-invalid @enderror" id="post-title"
            placeholder="Enter title" value="{{ $product->title }}" readonly>
        <input type="hidden" name="post_title" value="{{ $product->title }}">
    </div>

    <div class="form-group">
        <label for="post-description">Description</label>
        <textarea class="aiz-text-editor form-control @error('post_description') is-invalid @enderror" id="post-description"
         rows="3" placeholder="Enter description">{!! $product->description !!}</textarea>
        <input type="hidden" name="post_description" value="{{ $product->description }}">
    </div>
</div>

<div class="tab-pane fade" id="media" role="tabpanel" aria-labelledby="media-tab">

    <div class="form-group">
        <div class="input-group" data-toggle="aizuploader" data-type="image" data-multiple="true">
            <div class="input-group-prepend">
                <div class="input-group-text bg-soft-secondary font-weight-medium">
                    {{ translate('Browse') }}</div>
            </div>
            <div class="form-control file-amount">{{ translate('Choose File') }}</div>
            <input type="hidden" name="photos" value="{{ $product->img }}" class="selected-files">
        </div>
        <div class="file-preview box sm">
        </div>
        <small
            class="text-muted">{{ translate('These images are visible in product details page gallery. Use 600x600 sizes images.') }}</small>

    </div>
</div>

<div class="tab-pane fade" id="link" role="tabpanel" aria-labelledby="link-tab">
    <!-- Content for Link tab -->
    <div class="form-group">
        <label for="url">URL</label>
        <input type="text" class="form-control @error('url') is-invalid @enderror" id="url" readonly
            placeholder="Enter URL" value="{{ $product->url }}">
        <input type="hidden" name="url" value="{{ $product->url }}">
    </div>
</div>
