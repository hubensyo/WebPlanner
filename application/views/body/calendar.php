<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scheduling</title>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css' rel='stylesheet' media="print">
    <link href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css' rel='stylesheet' media="print">
    <!-- <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" /> -->
    <link rel="stylesheet" href="<?= base_url() ?>calendarassets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>calendarassets/fullcalendar/lib/main.min.css">
    <script src="<?= base_url() ?>calendarassets/js/jquery-3.6.0.min.js"></script>
    <script src="<?= base_url() ?>calendarassets/js/bootstrap.min.js"></script>
    <script src="<?= base_url() ?>calendarassets/fullcalendar/lib/main.min.js"></script>
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.css" integrity="sha512-liDnOrsa/NzR+4VyWQ3fBzsDBzal338A1VfUpQvAcdt+eL88ePCOd3n9VQpdA0Yxi4yglmLy/AmH+Lrzmn0eMQ==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.js" integrity="sha512-iusSCweltSRVrjOz+4nxOL9OXh2UA0m8KdjsX8/KUUiJz+TCNzalwE0WE6dYTfHDkXuGuHq3W9YIhDLN7UNB0w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


    <style>
        :root {
            --bs-success-rgb: 71, 222, 152 !important;
        }

        html,
        body {
            height: 100%;
            width: 100%;
            font-family: sans-serif;

        }

        .btn-info.text-light:hover,
        .btn-info.text-light:focus {
            background: #000;
        }

        table,
        tbody,
        td,
        tfoot,
        th,
        thead,
        tr {
            border-color: #ededed !important;
            border-style: solid;
            border-width: 1px !important;
        }

        .fc-daygrid-day:hover {
            background-color: #FFCCCB;
        }

        .fc-daygrid-day:active {
            background-color: #FFCCCB;
        }

        .card-header:first-child {
            background-color: #9a1a21 !important;
        }

        .btn-primary {
            color: #fff;
            background-color: #9a1a21;
        }

        .btn-primary:hover {
            color: #fff;
            background-color: #dc3545;
        }

        .fc .fc-daygrid-day-number {
            color: #000;
        }

        .fc .fc-col-header-cell-cushion {
            color: black;
        }

        .fc-h-event .fc-event-title-container {
            color: white;
            background-color: #9a1a21;
            border-color: #000;
            font-weight: bold;

        }

        .fc-daygrid-event-dot {
            color: black;
            background-color: #9a1a21;
            border-color: #000;
            font-weight: bold;

        }

        .fc-direction-ltr .fc-daygrid-event .fc-event-time {
            color: white;
            background-color: #9a1a21;
            border-color: #000;
            font-weight: bold;
        }

        .fc-timegrid-event-harness-inset .fc-timegrid-event,
        .fc-timegrid-event.fc-event-mirror,
        .fc-timegrid-more-link {
            color: white;
            background-color: #9a1a21;
            border-color: #000;
            font-weight: bold;
        }

        .fc-direction-ltr .fc-daygrid-event.fc-event-end,
        .fc-direction-rtl .fc-daygrid-event.fc-event-start {
            color: white;
            background-color: #9a1a21;
            border-color: #000;
            font-weight: bold;
        }

        .fc-theme-standard .fc-list-day-cushion {
            color: black;
            background-color: #9a1a21;
            border-color: #000;
            font-weight: bold;
        }

        .fc-direction-ltr .fc-list-day-text,
        .fc-direction-rtl .fc-list-day-side-text {
            color: white;
            font-weight: bold;
        }

        .fc-direction-ltr .fc-list-day-side-text,
        .fc-direction-rtl .fc-list-day-text {
            color: white;
            font-weight: bold;
        }

        .fc .fc-list-event-dot {
            color: black;
            background-color: #9a1a21;
            border-color: #000;
            font-weight: bold;
        }

        .fc .fc-list-event-title a {
            color: inherit;
            font-weight: bold;
        }

        .btn-danger {
            color: #fff;
            background-color: #f9ce34;
            border-color: #dc3545;
        }

        .fc-h-event .fc-event-main-frame {
            color: #fff;
            background-color: #9a1a21;
            border-color: #000;
        }

        .btn-danger {
            --bs-btn-color: #000;
            --bs-btn-bg: #f9ce34 !important;
            --bs-btn-border-color: #f9ce34 !important;
            --bs-btn-hover-color: #000;
            --bs-btn-hover-bg: #f9ce34 !important;
            --bs-btn-hover-border-color: #f9ce34 !important;
            --bs-btn-focus-shadow-rgb: 207, 57, 45;
            --bs-btn-active-color: #000;
            --bs-btn-active-bg: #f9ce34 !important;
            --bs-btn-active-border-color: #f9ce34 !important;
            --bs-btn-active-shadow: none;
            --bs-btn-disabled-color: #000;
            --bs-btn-disabled-bg: #f9ce34 !important;
            --bs-btn-disabled-border-color: #f9ce34 !important;
        }

        .fc .fc-list-day-cushion,
        .fc .fc-list-table td {
            padding: 8px 14px;
        }

        .fc-direction-ltr .fc-daygrid-event.fc-event-start,
        .fc-direction-rtl .fc-daygrid-event.fc-event-end {
            color: #fff;
            background-color: #9a1a21;
            border-color: #000;
        }
    </style>

</head>

<body class="bg-dark">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark bg-gradient" id="topNavBar">
        <div>
            <b class="text-light center">SDCA Events</b>
        </div>
        </div>
    </nav>
    <div class="container py-5" id="page-container">
        <div class="row">
            <div class="col-md-9">
                <div id="calendar"></div>
            </div>
            <div class="col-md-3">
                <div class="cardt rounded-0 shadow">
                    <div class="card-header bg-gradient bg-primary text-light" style="font-weight: bold;">
                        <h5 class="card-title" style="color: white">Add Events</h5>
                    </div>
                    <div class="card-body">
                        <div class="container-fluid">
                            <form action="<?= base_url('index.php/welcome/add_CalendarEvent'); ?>" method="post" id="schedule-form">
                                <input type="hidden" value="" name="eventID" id="eventID">
                                <div class="form-group mb-2">
                                    <label for="title" class="control-label">Events</label>
                                    <div class="col-md-12 form-group">
                                        <select class="form-control" name="eventSelect" id="eventSelect">
                                            <option value="">Add New Event</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group mb-2">
                                    <label for="title" class="control-label">Title</label>
                                    <div class="col-md-12 form-group"><input type="text" style="color: black; font-size: 15px;" id="eventTitle" class="form-control" name="title" placeholder="Title" required></div>
                                </div>
                                <div class="form-group mb-2">
                                    <label for="description" class="control-label">Description</label>
                                    <div class="col-md-12 form-group"><input type="text" style="color: black; font-size: 15px;" id="eventDescription" class="form-control" name="description" placeholder="Description" required></div>
                                </div>
                                <div class="form-group mb-2">
                                    <label for="start_datetime" class="control-label">Start</label>
                                    <div class="col-md-12 form-group"><input type="datetime-local" style="color: black; font-size: 15px;" id="eventStart" class="form-control" name="date_start" placeholder="Date Start" required></div>
                                </div>
                                <div class="form-group mb-2">
                                    <label for="end_datetime" class="control-label">End</label>
                                    <div class="col-md-12 form-group"><input type="datetime-local" style="color: black; font-size: 15px;" id="eventFinish" class="form-control" name="date_finish" placeholder="Date Finish" required></div>
                                </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="text-center">
                            <button class="btn btn-primary btn-sm rounded-0" type="submit"><i class="fa fa-save"></i> Save</button>
                            <button class="btn btn-default border btn-sm rounded-0" type="reset"><i class="fa fa-reset"></i> Cancel</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div id="schedule-calendar"></div>

    <!-- Event Details Modal -->
    <div class="modal fade" tabindex="-1" data-bs-backdrop="static" id="event-details-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-0">
                <div class="modal-header rounded-0">
                    <h5 class="modal-title">Event Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body rounded-0">
                    <div class="container-fluid">
                        <input type="hidden" value="" name="eventModalID" id="eventModalID">
                        <dl>
                            <dt class="text-muted">Title</dt>
                            <div class="col-md-12 form-group"><input type="text" style="color: black; font-size: 15px;" id="modalTitle" class="form-control" name="modalTitle"></div>
                            <dt class="text-muted">Description</dt>
                            <div class="col-md-12 form-group"><input type="text" style="color: black; font-size: 15px;" id="modalDescription" class="form-control" name="modalDescription"></div>
                            <dt class="text-muted">Start</dt>
                            <div class="col-md-12 form-group"><input type="datetime-local" style="color: black; font-size: 15px;" id="modalStart" class="form-control" name="modalStart"></div>
                            <dt class="text-muted">End</dt>
                            <div class="col-md-12 form-group"><input type="datetime-local" style="color: black; font-size: 15px;" id="modalEnd" class="form-control" name="modalEnd"></div>
                        </dl>
                    </div>
                </div>
                <div class="modal-footer rounded-0">
                    <div class="text-end">
                        <button type="button" class="btn btn-primary btn-sm rounded-0" id="edit" data-id="">Edit</button>
                        <button type="button" class="btn btn-danger btn-sm rounded-0" id="delete" data-id="">Delete</button>
                        <button type="button" class="btn btn-secondary btn-sm rounded-0" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        class PCalendar {
            constructor() {
                this.data = {};
                this.event = [];
                (async () => {
                    this.data = await this.getData();
                })()
                this.calendar;
            }
            renderEvent() {
                var this_event = [];
                var this_var = this;
                $.each(this.data, function(index, value) {
                    this_var.event.push({
                        id: value.ID,
                        title: value.title,
                        start: value.datetime_start,
                        end: value.datetime_finish
                    });
                })
                // this.event = this_event;
                console.log(this.event)
            }
            returnData() {
                console.log(this.data)
            }
            async getData() {
                return new Promise((resolve, reject) => {
                    $.ajax({
                        url: '<?= base_url() ?>index.php/welcome/fetchEvents',
                        method: 'post',
                        data: {},
                        dataType: 'json',
                        success: function($data) {
                            // console.log($data)
                            // this.data = $data;
                            resolve($data);
                        },
                        error: function(error) {
                            console.log(error)
                        }


                    })
                }).then(data => data)

                console.log(this.data)
            }

            renderCalendar() {
                this.getData()
                this.renderEvent()
                var calendarEl = document.getElementById('calendar');
                this.calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'dayGridMonth',
                    themeSystem: 'bootstrap5',
                    allDay: 'false',
                    allDaySlot: false,
                    initialView: 'dayGridMonth',
                    validRange: {
                        start: '2022-08-14',
                        end: '2023-07-24',
                    },
                    headerToolbar: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
                    },
                    events: this.event,
                    eventTimeFormat: {
                        hour: '2-digit',
                        minute: '2-digit',
                        meridiem: 'short',
                    },

                    dateClick: function(info) {
                        console.log(info.dateStr)

                        $.ajax({
                            url: '<?= base_url() ?>index.php/welcome/fetchDateClickEvent',
                            method: 'post',
                            data: {
                                date: info.dateStr
                            },
                            dataType: 'json',
                            success: function($data) {

                                var html = '<option value="">Add New Event</option>'
                                $.each($data, function(index, value) {
                                    html += `<option value="${value.ID}">${value.title}</option>`
                                })
                                $('#eventSelect').html(html)

                                console.log($data);
                            },
                            error: function(error) {
                                console.log(error)
                            }

                        })
                    },

                    eventClick: function(info) {
                        console.log(info)
                        $('#event-details-modal').modal('show');
                        $.ajax({
                            url: '<?= base_url() ?>index.php/welcome/fetchClickEventInfo',
                            method: 'post',
                            data: {
                                ID: info.event.id
                            },
                            dataType: 'json',
                            success: function($data) {
                                console.log($data)
                                $('#eventModalID').val($data.ID)
                                $('#modalTitle').val($data.title)
                                $('#modalDescription').val($data.description)
                                $('#modalStart').val($data.datetime_start)
                                $('#modalEnd').val($data.datetime_finish)
                                // console.log($data);
                            },
                            error: function(error) {
                                console.log(error)
                            }
                        })
                    }
                });
                this.calendar.render();
            }
            destroycalendar() {
                this.event = [];
                // this.calendar.destroy();
                $('#calendar').empty();
            }

        }
        var pcalendar = new PCalendar();
        $('#eventSelect').on('change', function() {
            $('#eventID').val(this.value)
            $.ajax({
                url: '<?= base_url() ?>index.php/welcome/fetchDateClickEventInfo',
                method: 'post',
                data: {
                    ID: this.value
                },
                dataType: 'json',
                success: function($data) {
                    $('#eventID').val($data.ID)
                    $('#eventTitle').val($data.title)
                    $('#eventDescription').val($data.description)
                    $('#eventStart').val($data.datetime_start)
                    $('#eventFinish').val($data.datetime_finish)
                },
                error: function(error) {
                    console.log(error)
                }

            })
        });

        $('#edit').click(function() {
            var id = $('#eventModalID').val()
            // alert(id)
            // return false;
            $.ajax({
                url: '<?= base_url() ?>index.php/welcome/updateEvents',
                method: 'post',
                data: {
                    ID: $('#eventModalID').val(),
                    title: $('#modalTitle').val(),
                    description: $('#modalDescription').val(),
                    date_start: $('#modalStart').val(),
                    date_finish: $('#modalEnd').val()
                },
                dataType: 'json',
                success: function($data) {

                    // $('#eventID').val($data.ID)
                    // $('#eventTitle').val($data.title)
                    // $('#eventDescription').val($data.description)
                    // $('#eventStart').val($data.datetime_start)
                    // $('#eventFinish').val($data.datetime_finish)
                    $('#event-details-modal').modal('hide')

                    // FullCalendar.Calendar('destroy')
                    setTimeout(() => {
                        pcalendar.destroycalendar()
                        pcalendar.renderCalendar()
                        pcalendar.returnData()
                    }, 300);

                    location.reload();

                },
                error: function(error) {
                    console.log(error)
                }

            })
        });

        $('#delete').click(function() {
            var id = $('#eventModalID').val()
            $.ajax({
                url: '<?= base_url() ?>index.php/welcome/fetchClickEventInfo',
                method: 'post',
                data: {
                    ID: id
                },
                dataType: 'json',
                success: function(data) {
                    if (data != null) {
                        console.log('sad')
                        var _conf = confirm("Are you sure to delete this scheduled event?");
                        if (_conf === true) {
                            location.href = "<?= base_url() ?>index.php/welcome/deleteEvent/" + $('#eventModalID').val();
                        }
                    } else {
                        alert("Event is undefined");
                    }
                    console.log(data)
                },
                error: function(error) {
                    console.log(error)
                }

            })
        });

        $(document).ready(function() {
            // $('#content').DataTable();
            setTimeout(() => {
                pcalendar.renderCalendar()
                pcalendar.returnData()
            }, 300);

        });

        document.addEventListener('DOMContentLoaded', function() {
            // pcalendar.renderCalendar()
            // pcalendar.returnData()

        });

        clickcalendar()
    </script>

</body>

</html>