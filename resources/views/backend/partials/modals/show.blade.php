<!-- Modal-->
<div class="modal fade" id="{{ isset($id) ? $id : showModal}}" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mb-0" id="modalLabel">{{isset($title) ? $title : 'Show Product'}}</h5>
            </div>
            <div class="modal-body">
                <!-- Card body -->
                <!-- Input groups with icon -->
                @isset($body)
                    {!! $body !!}
                @endisset
            </div>
            @isset($footer)
                <div class="modal-footer {{ $footer_class ?? '' }}">
                    {!! $footer !!}
                </div>
            @endisset
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
