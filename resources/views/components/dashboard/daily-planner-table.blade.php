@props(['tasks'])

<div>
    <h2>Daily planner ({{ now()->toDateString() }})</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Task Name</th>
                <th>Todo</th>
                <th>Due Date</th>
                <th>Due Time</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            @unless ($tasks->isEmpty())
                @foreach ($tasks as $key => $task)
                    @if (auth()->id() == $task->todo->user_id)
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
                        </tr>
                    @endif
                @endforeach
            @else
                <tr>
                    <td colspan="7">No task available for today</td>
                </tr>
            @endunless
        </tbody>
    </table>

</div>
