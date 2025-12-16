let AppointmentService = {
    init: function() {
        AppointmentService.getAllAppointments();
    },

    getAllAppointments: function() {
        RestClient.get("appointments", function(data) {
            Utils.datatable("appointments-table", [
                { data: "client_name", title: "Client Name" },
                { data: "artist_name", title: "Artist" },
                { data: "date", title: "Date" },
                { data: "time", title: "Time" },
                { data: "service", title: "Service" },
                {
                    title: "Actions",
                    render: function(data, type, row) {
                        const rowStr = encodeURIComponent(JSON.stringify(row));
                        return `
                            <div class="d-flex justify-content-center gap-2 mt-3">
                                <button class="btn btn-primary" onclick="AppointmentService.openEditModal('${row.id}')">Edit</button>
                                <button class="btn btn-danger" onclick="AppointmentService.openConfirmationDialog(decodeURIComponent('${rowStr}'))">Delete</button>
                            </div>
                        `;
                    }
                }
            ], data, 10);
        });
    },

    addAppointment: function(appointment) {
        RestClient.post("appointments", appointment, function() {
            toastr.success("Appointment added successfully");
            AppointmentService.getAllAppointments();
            AppointmentService.closeModal();
        });
    },

    editAppointment: function(appointment) {
        RestClient.patch("appointments/" + appointment.id, appointment, function() {
            toastr.success("Appointment updated successfully");
            AppointmentService.getAllAppointments();
            AppointmentService.closeModal();
        });
    },

    deleteAppointment: function() {
        const id = $("#delete_appointment_id").val();
        RestClient.delete("appointments/" + id, null, function() {
            toastr.success("Appointment deleted successfully");
            AppointmentService.getAllAppointments();
            AppointmentService.closeModal();
        });
    },

    openAddModal: function() {
        $("#addAppointmentModal").show();
    },

    openEditModal: function(id) {
        $("#editAppointmentModal").show();
        RestClient.get("appointments/" + id, function(data) {
            $('input[name="client_name"]').val(data.client_name);
            $('select[name="artist_id"]').val(data.artist_id);
            $('input[name="date"]').val(data.date);
            $('input[name="time"]').val(data.time);
            $('input[name="service"]').val(data.service);
            $('input[name="id"]').val(data.id);
        });
    },

    openConfirmationDialog: function(appointment) {
        appointment = JSON.parse(appointment);
        $("#deleteAppointmentModal").modal("show");
        $("#delete-appointment-body").html("Do you want to delete appointment for: " + appointment.client_name + "?");
        $("#delete_appointment_id").val(appointment.id);
    },

    closeModal: function() {
        $("#addAppointmentModal").hide();
        $("#editAppointmentModal").hide();
        $("#deleteAppointmentModal").modal("hide");
    }
};
