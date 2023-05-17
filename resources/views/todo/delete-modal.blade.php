<form method="post" action="{{ route('todo.destroy', $todo) }}" class="p-6">
    @csrf
    @method('delete')

    <h2 class="text-lg font-medium text-gray-900">
        {{ __('Are you sure you want to delete your data?') }}
    </h2>

    <p class="mt-1 text-sm text-gray-600">
        {{ __('Once your data are deleted, all of its resources and data will be permanently deleted.') }}
    </p>
    <div class="mt-6 flex justify-end">
        <button class="btn btn-primary me-1 mb-1 btn-sm" type="button" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-danger me-1 mb-1 btn-sm">Delete</button>

    </div>
</form>
