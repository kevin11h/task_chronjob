$(document).ready(function () {
  var d = new Date();
    datas = d.getFullYear();
    $(document).on('click','.fc-button-group',function () {
        year = $('.fc-left').find('h2').text();
        datas = year.slice(-4);

    })


$('#calendar').fullCalendar({
    editable: true,
    eventLimit: true, // allow "more" link when too many events
    events: function (start, end, timezone, callback) {
        $.ajax({
            url: '/calendar',
            dataType: 'json',
            success: function (data) {
                var events = [];
                for (var i = 0; i < data.length; i++) {
                    if (data[i].birthday != null) {
                        //
                        day = (data[i].birthday).substring(4);

                        if (data[i].status == 1) {
                            events.push({
                                title: data[i].name,
                                //
                                start:datas+day,
                            });
                        }
                    }
                }
                console.log(events);
                callback(events);
            }
        });

    }


})
})