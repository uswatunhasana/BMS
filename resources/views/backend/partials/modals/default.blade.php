<!-- Modal Dialog -->
<div class="modal fade" id="{{ isset($id) ? $id : addModal}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog {{ $class ?? '' }} modal-dialog-centered ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addDataLabel">{{isset($title) ? $title : 'Add Data'}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form role="form" method="POST" action="{{ isset($action) ? $action : '' }}" id="{{ isset($type) ? $type : store }}" @isset($enctype) enctype="multipart/form-data" @endisset>
                @csrf
                @method('post')
                <div class="modal-body">
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
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="{{ isset($button) ? $button.'Button' : 'addButton'}}">{{ $button ?? 'Add Data' }}</button>
                </div>
            </form>
        </div>
    </div>
</div>