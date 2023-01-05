{{-- Hidden Adding Modal    --}}
<div class="modal fade" id="insertModal" tabindex="-1" role="dialog" aria-labelledby="insertTaskModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="insertTaskModal">Adding New Task</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="taskAddingForm">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="taskName">Task Name
                                    <input type="text" name="taskName" value="" class="form-control">
                                </label>

                                <input type="hidden" name="taskId" value="" class="form-control">
                                <label for="dueDate"> Due Date
                                    <input type="date" id="dueDate" name="dueDate"
                                           value="{{ date('Y-m-d') }}"
                                           min="{{ date('Y-m-d') }}" max="{{ now()->addMonths(7)->format('Y-m-d') }}">
                                </label>
                                <div class="" id="sysMsg" style="color: red"></div>
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-success" value="Submit">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>