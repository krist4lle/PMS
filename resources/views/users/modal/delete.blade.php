<form method="post" action="{{ route('users.destroy', $user) }}">
    @csrf
    @method('delete')
    <div class="modal fade text-left" id="ModalDelete{{ $user->id }}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content bg-danger">
                <div class="modal-header">
                    <h4 class="modal-title">
                        Are You sure to fire
                        <em>{{ $user->first_name }} {{ $user->last_name }}</em> ?
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <button type="submit" class="btn btn-outline-light">Fire User</button>
                </div>
            </div>
        </div>
    </div>
</form>

