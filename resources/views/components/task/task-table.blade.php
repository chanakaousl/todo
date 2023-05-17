@props(['tasks'])

<div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Todo</th>
                <th>Due Date</th>
                <th>Due Time</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            @unless ($tasks->isEmpty())
                @foreach ($tasks as $key => $task)
                    @php
                        $cls = 'badge badge-warning';
                        $msg = 'Incomplete';
                        if ($task->status == 1) {
                            $cls = 'badge badge-success';
                            $msg = 'Complete';
                        }
                        
                        $overdue = '';
                        $trClss = '';
                        if ($task->overdue_date != null) {
                            $overdue = 'Overdue';
                            $trClss = 'table-warning';
                        }
                    @endphp
                    <tr class='{{ $trClss }}'>
                        <th scope="row">{{ ++$key }}</th>
                        <td>{{ $task->name }}</td>
                        <td>{{ $task->todo->name }}</td>
                        <td>{{ $task->due_date_format }}</td>
                        <td>{{ $task->due_time_format }}</td>

                        <td><span class="{{ $cls }}">{{ $msg }}</span> <span
                                class="badge badge-pill badge-info">{{ $overdue }}</span></td>
                        <td>
                            <a href="{{ route('task.edit', $task->id) }}" class="btn btn-primary me-1 mb-1 btn-sm"
                                type="button" title="Edit Task">Edit</a>

                            <form method="post" action="{{ route('task.status', $task->id) }}" style="display: inline">
                                @csrf
                                @method('put')
                                <button class="btn btn-success me-1 mb-1 btn-sm" type="submit"
                                    title="Change Status">Status</button>
                            </form>

                            <button type="button" class="btn btn-danger me-1 mb-1 btn-sm" data-toggle="modal"
                                data-target="#deleteModal" onclick="deleteTodo({{ $task->id }})" title="Delete Task">
                                Delete
                            </button>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="7">No data available</td>
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
                url: "{{ route('task.delete.modal') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method: "GET",
                data: {
                    task_id: id
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
