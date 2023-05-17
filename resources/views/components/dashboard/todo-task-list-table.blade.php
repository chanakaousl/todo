@props(['todos'])
<div>
    <h2>Your All Tasks Details</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Todo</th>
                <th>Task</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            @unless ($todos->isEmpty())
                @foreach ($todos as $key => $todo)
                    <tr>
                        <td scope="row">{{ ++$key }}</td>
                        <td>{{ $todo->name }}</td>
                        <td>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Due Date</th>
                                        <th>Due Time</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @unless ($todo->tasks->isEmpty())
                                        @foreach ($todo->tasks as $task)
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
                                                <td>{{ $task->name }}</td>
                                                <td>{{ $task->due_date_format }}</td>
                                                <td>{{ $task->due_time_format }}</td>
                                                <td><span class="{{ $cls }}">{{ $msg }}</span> <span
                                                        class="badge badge-pill badge-info">{{ $overdue }}</span></td>
                                            </tr>
                                        @endforeach
                                    @endunless
                                </tbody>
                            </table>
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
</div>
