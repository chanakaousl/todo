<x-app-layout>
    @php
        $title = 'Task List';
    @endphp

    <x-header-title :title='$title' />

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <x-responsive-nav-link :href="route('task', $task->todo->id)">
                    {{ __('Back') }}
                </x-responsive-nav-link>

                <div class="p-6 text-gray-900">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <!-- Show flash message -->
                                <x-flash-message />
                                <p>Update Task Details</p>

                                <!-- New Todo Form -->
                                <form method="POST" action="{{ route('task.update', $task->id) }}" enctype="multipart/form-data">
                                    @csrf
                                    @method('put')
                                    <input type="hidden" name="task_id" id="task_id" value="{{ $task->id }}">
                                    <div class="row mb-3">
                                        <label for="inputName" class="col-sm-2 col-form-label">Todo</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" name="todo" id="todo"
                                                value="{{ $task->todo->name }}" disabled>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputName" class="col-sm-2 col-form-label">Task Name</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" name="name" id="name"
                                                value="{{ $task->name }}">
                                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputDescription" class="col-sm-2 col-form-label">Due Date</label>
                                        <div class="col-sm-6">
                                            <input type="date" class="form-control" name="due_date" id="due_date"
                                                value="{{ $task->due_date }}">
                                            <x-input-error :messages="$errors->get('due_date')" class="mt-2" />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputDescription" class="col-sm-2 col-form-label">Due Time</label>
                                        <div class="col-sm-6">
                                            <input type="time" class="form-control" name="due_time" id="due_time"
                                                value="{{ $task->due_time }}">
                                            <x-input-error :messages="$errors->get('due_time')" class="mt-2" />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label"></label>
                                        <div class="col-sm-2 col-form-label col-sm-offset-4 col-sm-4">
                                            <button type="submit" class="btn btn-success">Save</button>
                                            <button type="reset" class="btn btn-warning">Refesh</button>
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
