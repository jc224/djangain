<script>
    document.addEventListener('DOMContentLoaded', function () {
            calendar();
    });


    function calendar(){
            

    var calendar = new FullCalendar.Calendar(calendarEl, {
        locale: 'fr',
        headerToolbar: {
        left: 'prev,next',
        center: 'title',
        right: 'dayGridMonth,dayGridWeek,dayGridDay'
      },
    
        initialDate: new Date(),
        editable: true,
        selectable: true,
        businessHours: true,
        dayMaxEvents: true, // allow "more" link when too many events
        events: data,
    });

    calendar.render();
    }
</script>