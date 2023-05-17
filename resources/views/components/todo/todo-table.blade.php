@props(['todos'])

<div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            @unless ($todos->isEmpty())
                @foreach ($todos as $key => $todo)
                    <tr>
                        <th scope="row">{{ ++$key }}</th>
                        <td>{{ $todo->name }}</td>
                        <td>{{ Str::substr($todo->description, 0, 50) }}</td>
                        <td>
                            <a href="{{ route('todo.edit', $todo->id) }}" class="btn btn-primary me-1 mb-1 btn-sm"
                                type="button" title="Edit Todo">Edit</a>
                            <a href="{{ route('task', $todo->id) }}" class="btn btn-success me-1 mb-1 btn-sm" type="button"
                                title="Assigning and Viewing Tasks">Task</a>
                            <button type="button" class="btn btn-danger me-1 mb-1 btn-sm" data-toggle="modal"
                                data-target="#deleteModal" onclick="deleteTodo({{ $todo->id }})" title="Delete Todo"
                                style="display: inline">
                                Delete
                            </button>

                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="4">No data available</td>
                </tr>
            @endunless
        </tbody>
    </table>

    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="deleteModalLabel">Delete Confirmation</h1>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">
                            ×
                        </span>
                    </button>
                </div>
                <div class="modal-body" id="modal-body">
                </div>
            </div>
        </div>
    </div>

</div>

@push('js')
    <script>
        function deleteTodo(id) {
            $.ajax({
                url: "{{ route('todo.delete.modal') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method: "GET",
                data: {
                    todo_id: id
                },
                dataType: 'html',
                success: function(response) {
                    $("#modal-body").html(response);
                },
                error: function(xhr, status, error) {
                    // Handle any errors that occurred during the request
                    console.error(error);
                }
            });
        }
    </script>
@endpush
