$(document).ready(function () {

    //Sort table
    $("#tasksMain").tablesorter();

    // DataTables initialisation
    let table = $('#tasksMain').DataTable();

    // Load Adding Task modal
    $("[name='btn_add_task']").click(function () {
        $('#insertModal').modal('show');
    });

    // Adding Task
    $("#taskAddingForm").submit(function (event) {
        event.preventDefault();

        let $form = $(this);
        let $inputs = $form.find("input, select, button, textarea");
        let serializedData = $form.serialize();
        $inputs.prop("disabled", true);
        let request = $.ajax({
            url: addTaskUrl,
            type: "post",
            data: serializedData
        });

        request.done(function (response, textStatus, jqXHR) {
            location.reload();
        });

        request.fail(function (data) {
            let response = JSON.parse(data.responseText);
            $('#sysMsg').text(response.errors.taskName.toString());
        });

        request.always(function () {
            $inputs.prop("disabled", false);
        });

    });

    // Load Edit modal
    $("[name='taskEdit']").click(function () {
        let dueDate = $(this).parents("tr").find(".tdate").text();
        const taskId = $(this).val();
        const taskName = $(this).parents("tr").find(".tname").text();
        $("[name='taskId']").val(taskId);
        $("[name='taskName']").val(taskName);
        $("#dueDateUpdate").val(moment(dueDate).format("YYYY-MM-DD"));
        $('#updateModal').modal('show');
    });

    // Edit Task
    $("#taskUpdateForm").submit(function (event) {
        event.preventDefault();
        const $form = $(this);
        const $inputs = $form.find("input, select, button, textarea");
        const serializedData = $form.serialize();
        $inputs.prop("disabled", true);

        let request = $.ajax({
            url: updateTaskUrl,
            type: "post",
            data: serializedData
        });

        request.done(function (response, textStatus, jqXHR) {
            console.log(response)
            location.reload();
        });

        request.fail(function (data) {
            let response = JSON.parse(data.responseText);
            $('#updateTaskSysMsg').text(response.errors.taskName.toString());
        });

        request.always(function () {
            $inputs.prop("disabled", false);
        });
    });


    // Deleting Task
    $("[name='taskDelete']").click(function () {
        let dueDate = $(this).parents("tr").find(".tdate").text();
        const taskId = $(this).val();
        event.preventDefault();

        // Checking Date restriction
        const CurrentDate = new Date();
        dueDate = new Date(dueDate);
        const millisecondsPerDay = 24 * 60 * 60 * 1000;
        const daysDiff = Math.floor((dueDate - CurrentDate) / millisecondsPerDay);

        if ((dueDate < CurrentDate) || (daysDiff <= 5)) {
            alert('Deleting task is not allowed , Task Due-Date needs to be more then 6 Days from today ')
            return false;
        }
        if (!confirm("Are you sure you want to delete this task?")) {
            return false;
        }
        const request = $.ajax({
            url: deleteTaskUrl,
            type: "post",
            data: {
                id: taskId
            },
        });

        request.done(function (response, textStatus, jqXHR) {
            location.reload();
        });

        request.fail(function (jqXHR, textStatus, errorThrown) {
            console.error(
                "The following error occurred: " +
                textStatus, errorThrown
            );
        });
    });

    calculateColumn(3);
    daterRange(table);
    statusFilter(table);

    function statusFilter(table) {
        let select = $('#statusFilter')
            .on('change', function () {
                let val = $(this).val();

                table.column(3)
                    .search(val ? '^' + $(this).val() + '$' : val, true, false)
                    .draw();
            });
    }

    function daterRange(table) {
        // Create date inputs
        let minDate, maxDate;

        minDate = new DateTime($('#min'), {
            format: 'YYYY-MM-DD'
        });
        maxDate = new DateTime($('#max'), {
            format: 'YYYY-MM-DD'
        });

        // Re-filter the table
        $('#min, #max').on('change', function () {
            table.draw();
        });

        $.fn.dataTable.ext.search.push(
            function (settings, data, dataIndex) {
                let min = minDate.val();
                let max = maxDate.val();
                let date = new Date(data[2]);

                return (min === null && max === null) ||
                    (min === null && date <= max) ||
                    (min <= date && max === null) ||
                    (min <= date && date <= max);

            }
        );
    }


    function calculateColumn(index) {
        let remaining = 0;
        let completed = 0;
        let total = 0;

        $('table tr').each(function () {
            let value = $('td', this).eq(index).text();
            if (value !== '' && value.length !== 0) {
                if (value === 'Active') {
                    remaining += 1;
                } else {
                    completed += 1;
                }
            }
        });
        total = remaining + completed;

        $("#remaining").append(remaining);
        $("#completed").append(completed);
        $("#total").append(total);
    }
});