{{-- Hidden Update Modal    --}}
<div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="updateTaskModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateTaskModal">Task Update</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form  id="taskUpdateForm">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Task Name:</label>
                                <input type="text" name="taskName" value="" class="form-control">
                                <input type="hidden" name="taskId" value="" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="dueDateUpdate">Due Date</label>
                                <input type="date" id="dueDateUpdate" name="dueDateUpdate"
                                       value="{{ date('Y-m-d') }}"
                                       min="{{ date('Y-m-d') }}" max="{{ now()->addMonths(7)->format('Y-m-d') }}">
                            </div>
                            <div class="form-group">
                                <label for="statusUpdate">New Status</label>
                                <select class="form-control" id="statusUpdate" name="statusUpdate">
                                    <option value="0">Active</option>
                                    <option value="1">Completed</option>
                                </select>
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