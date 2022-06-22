<form method="post" action="{{ route('departments.update', $department) }}">
    @csrf
    @method('put')
    <div class="modal fade text-left" id="ModalEdit{{ $department->id }}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Change Department Name</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="text" class="form-control" value="{{ $department->name }}"
                           name="name">
                    <br>
                    <button type="submit" class="btn btn-primary">Change Department</button>
                </div>
            </div>
        </div>
    </div>
</form>

