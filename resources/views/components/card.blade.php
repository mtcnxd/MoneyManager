<div class="card border-custom shadow-sm">
    <div class="card-body">
        <div class="align-items-center row">
            <div class="col">
                <h6 class="card-title mb-3 text-muted text-uppercase fs-7">
                    {{ $card_title }}
                </h6>
                <div class="card-subtitle">
                    <div style="display: flex; justify-content: space-between;" class="mb-2">
                        <div>Last invest amount:</div>
                        <div><span class="text-muted">{{ $card_content_1 }}</span></div>
                    </div>
                    <div style="display: flex; justify-content: space-between;" class="mb-2">
                        <div>Last invest date:</div>
                        <div><span class="text-muted">{{ $card_content_2 }}</span></div>
                    </div>
                    <div style="display: flex; justify-content: space-between;" class="mb-2">
                        <div>Total invest amount:</div>
                        <div><span class="text-muted">{{ $card_content_3 }}</span></div>
                    </div>
                    <div style="display: flex; justify-content: space-between;" class="mt-4">
                        <div></div>
                        <div><a href="{{ $card_link }}" class="btn btn-sm btn-primary">Details</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>													
</div>