<x-app-layout>
    @php
        $title = 'Dashboard';
    @endphp

    <x-header-title :title='$title' />

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <!-- Daily planner Table-->
                                <x-dashboard.daily-planner-table :tasks='$tasks' />
                                <br>
                                <!-- Use'stask details Table-->
                                <x-dashboard.todo-task-list-table :todos='$todos' />
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
