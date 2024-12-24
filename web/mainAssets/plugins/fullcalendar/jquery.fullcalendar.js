!function ($) {
    "use strict"; var CalendarApp = function () {
        this.$body = $("body")
        this.$calendar = $('#calendar'), this.$event = ('#calendar-events div.calendar-events'), this.$categoryForm = $('#add_new_even t form'), this.$extEvents = $('#calendar-events'), this.$modal = $('#my_event'), this.$saveCategoryBtn = $('.save-category'), this.$calendarObj = null
    }; CalendarApp.prototype.onDrop = function (eventObj, date) {
        var $this = this; var originalEventObject = eventObj.data('eventObject'); var $categoryClass = eventObj.attr('data-class'); var copiedEventObject = $.extend({}, originalEventObject); copiedEventObject.start = date; if ($categoryClass)
            copiedEventObject['className'] = [$categoryClass]; $this.$calendar.fullCalendar('renderEvent', copiedEventObject, true); if ($('#drop-remove').is(':checked')) { eventObj.remove(); }


    }, CalendarApp.prototype.onEventClick = function (calEvent, jsEvent, view) {
        var $this = this;

        console.log(calEvent.start);
        var form = $("<form></form>"); form.append("<label>Modifier L'evenement</label>"); form.append("<div class='input-group'><input class='form-control' type=text value='" + calEvent.title + "' /><span class='input-group-append'><button type='submit' class='btn btn-success'><i class='fa fa-check'></i> Save</button></span></div>"); $this.$modal.modal({ backdrop: 'static' }); $this.$modal.find('.delete-event').show().end().find('.save-event').hide().end().find('.modal-body').empty().prepend(form).end().find('.delete-event').unbind('click').click(function () { $this.$calendarObj.fullCalendar('removeEvents', function (ev) { return (ev._id == calEvent._id); }); $this.$modal.modal('hide'); }); $this.$modal.find('form').on('submit', function () { calEvent.title = form.find("input[type=text]").val(); $this.$calendarObj.fullCalendar('updateEvent', calEvent); $this.$modal.modal('hide'); return false; });
    }, CalendarApp.prototype.onSelect = function (start, end, allDay) {

        //  $this.$modal.modal({ backdrop: 'static' });

        $('#add_event').modal('show');
        $this.$calendarObj.fullCalendar('unselect');


    }, CalendarApp.prototype.enableDrag = function () { $(this.$event).each(function () { var eventObject = { title: $.trim($(this).text()) }; $(this).data('eventObject', eventObject); $(this).draggable({ zIndex: 999, revert: true, revertDuration: 0 }); }); }
    CalendarApp.prototype.init = function (data) {
        this.enableDrag(); var date = new Date(); var d = date.getDate(); var m = date.getMonth(); var y = date.getFullYear(); var form = ''; var today = new Date($.now());
        console.log(data);
        // var defaultEvents = { title: 'Reunion semestre' };



        var $this = this; $this.$calendarObj = $this.$calendar.fullCalendar({
            locale: 'fr', slotDuration: '00:15:00', minTime: '08:00:00', maxTime: '19:00:00', defaultView: 'month', handleWindowResize: true,
            header: { left: 'prev,next today', center: 'title', right: 'month,agendaWeek,agendaDay' },

            events: [
                {
                  title: 'Événement 1',
                  start: '2023-09-1',
                  end: '2023-09-12'
                },
                {
                  title: 'Événement 2',
                  start: '2023-09-15',
                  end: '2023-09-17'
                },
                // Ajoutez d'autres événements ici
              ], editable: true, droppable: true, locale: "fr", eventLimit: true, selectable: true, drop: function (date) { $this.onDrop($(this), date); }, select: function (start, end, allDay) { $this.onSelect(start, end, allDay); },
            eventClick: function (calEvent, jsEvent, view) {
                $this.onEventClick(calEvent, jsEvent, view);

            }
        });
        //  this.$saveCategoryBtn.on('click', function () {
        //     var categoryName = $this.$categoryForm.find("input[name='category-name']").val(); var categoryColor = $this.$categoryForm.find("select[name='category-color']").val(); if (categoryName !== null && categoryName.length != 0) {
        //         $this.$extEvents.append('<div class="calendar-events" data-class="bg-' + categoryColor + '" style="position: relative;"><i class="fa fa-circle text-' + categoryColor + '"></i>' + categoryName + '</div>')
        //         $this.enableDrag();
        //     }
        // });
    }, $.CalendarApp = new CalendarApp, $.CalendarApp.Constructor = CalendarApp
}(window.jQuery), function ($) {
    "use strict";
  


}(window.jQuery);