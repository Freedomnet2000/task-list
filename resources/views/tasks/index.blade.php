@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">{{ __('Tasks') }}</div>
                    <div class="container">
                        <div class="row">
                            <div class="col-sm">
                                <button type="button" class="btn btn-primary">
                                    Tasks Remaining <span class="badge badge-light" id="remaining"></span>
                                </button>
                            </div>
                            <div class="col-sm">
                                <button type="button" class="btn btn-primary">
                                    Tasks completed <span class="badge badge-light" id="completed"></span>
                                </button>
                            </div>
                            <div class="col-sm">
                                <button type="button" class="btn btn-primary">
                                    Total Tasks <span class="badge badge-light" id="total"></span>
                                </button>
                            </div>
                        </div>
                        <br>

                        <div class="form-row">
                            <div class="col-sm">
                                <div class="col">

                                    <label for="min" class="col-form-label">From Date: </label>
                                </div>
                                <input type="text" id="min" name="min">
                                <i class="fa fa-calendar" aria-hidden="true"></i>
                            </div>
                            <div class="col-sm">
                                <div class="col">

                                    <label for="max" class="col-form-label">To Date: </label>
                                </div>
                                <input type="text" id="max" name="max">
                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                </input>

                            </div>
                            <div class="col-sm">
                                <label for="statusFilter" class="col-form-label">Show Status:</label>
                                <div class="col">
                                    <select class="custom-select custom-select-sm" id="statusFilter">
                                        <option selected value="">All</option>
                                        <option value="active">Active</option>
                                        <option value="completed">Completed</option>
                                    </select>
                                </div>
                            </div>

                        </div>
                        <br>
                        <div class="row">
                            <div class="col-sm">
                                <button type="button" name="btn_add_task" id="btn_add_task" class="btn btn-secondary"
                                        data-card-widget="add">
                                    Add New Task <i class="fa fa-edit"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="tasksMain" class="table table-responsive-sm table-striped tablesorter">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Due Date</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($tasks as $task)
                                @if($task->status === 0)
                                    @php
                                        $taskStatus = 'Active'
                                    @endphp
                                @else
                                    @php
                                        $taskStatus = 'Completed'
                                    @endphp
                                @endif
                                <tr>
                                    <td class="tid">{{ $task->id }}</td>
                                    <td class="tname">{{ $task->name }}</td>
                                    <td class="tdate">{{ date('Y-m-d', strtotime($task->due_date))  }}</td>
                                    <td class="tid">{{ $taskStatus }}</td>
                                    <td>
                                        <button type="button" name="taskEdit" id="btn_{{ $task->id }}"
                                                class="btn btn-tool" data-card-widget="remove" value="{{ $task->id }}">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button type="button" name="taskDelete" id="btn_{{ $task->id }}"
                                                class="btn btn-tool" data-card-widget="remove" value="{{ $task->id }}">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('tasks.new')
    @include('tasks.update')

    <script>
        const addTaskUrl = '{{ route('task.add') }}';
        const updateTaskUrl = '{{ route('task.update') }}';
        const deleteTaskUrl = '{{ route('task.delete') }}';

    </script>
    <script src="{{ asset('js/tasksHandler.js') }}"></script>

@endsection


