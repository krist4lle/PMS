<form method="post" action="{{ route('issues.update', $issue) }}">
    @csrf
    @method('put')
    <div class="modal fade text-left" id="Modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Issue</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <label for="title">Title</label>
                    @error('title')
                    <div class="alert alert-danger mt-2" role="alert">
                        {{ $message }}
                    </div>
                    @enderror
                    <input type="text" class="form-control" id="title" name="title" value="{{ $issue->title }}">
                    <br>
                    <label for="description">Description</label>
                    @error('description')
                    <div class="alert alert-danger mt-2" role="alert">
                        {{ $message }}
                    </div>
                    @enderror
                    <textarea class="form-control" name="description"
                              id="description">{{ $issue->description }}</textarea>
                    <br>
                    <label for="assignee">Assignee</label>
                    @error('assignee')
                    <div class="alert alert-danger mt-2" role="alert">
                        {{ $message }}
                    </div>
                    @enderror
                    <select name="assignee" id="assignee" class="form-control">
                        <option value="">Choose Assignee</option>
                        <option value="{{ $manager->id }}" {{ $manager->id == old('assignee') ? 'selected' : '' }}>
                            {{ $manager->first_name }} {{ $manager->last_name }} -
                            "{{ $manager->position->title }}"
                        </option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ $user->id == $issue->assignee->id ? 'selected' : '' }}>
                                {{ $user->first_name }} {{ $user->last_name }} -
                                "{{ $user->position->title }}"
                            </option>
                        @endforeach
                    </select>
                    <br>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
    </div>
</form>

