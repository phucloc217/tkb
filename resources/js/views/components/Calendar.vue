<template>
  <div class="row">
    <div class="col-10">
      <div class="card p-3">
        <div class="card-header pb-0">
          <h6>Xếp thời khóa biểu</h6>

        </div>
        <div class="card-body px-0 pt-0 pb-2">
          <FullCalendar :options="calendarOptions" />
        </div>
      </div>
    </div>
    <div class="col-2">
      <div class="card p-3">
        <div class="card-header pb-0">
          <h6>Môn học</h6>

        </div>
        <div class="card-body px-0 pt-0 pb-2">
          <div id="containerEl">
            <div class="item-class btn btn-sm btn-primary" data-event='{ "title": "my event", "duration": "02:00" }'>Tin
              học - Thầy Lộc</div>
            <div class="item-class btn btn-sm btn-primary" data-event='{ "title": "my event", "duration": "02:00" }'>Quản
              trị mạng 1</div>
          </div>

        </div>
      </div>
    </div>
  </div>
</template>

<script>
import FullCalendar from '@fullcalendar/vue3'
import dayGridPlugin from '@fullcalendar/daygrid'
import interactionPlugin, { Draggable } from '@fullcalendar/interaction'
import timeGridPlugin from '@fullcalendar/timegrid'
import viLocale from '@fullcalendar/core/locales/vi'
export default {
  components: {
    FullCalendar // make the <FullCalendar> tag available
  },
  data() {
    return {
      calendarOptions: {
        plugins: [timeGridPlugin, interactionPlugin],
        initialView: 'timeGridWeek',
        headerToolbar: [

        ],
        events: [
          
        ],
        locale: viLocale,
        slotMinTime: "07:30:00",
        slotMaxTime: "17:00:00",
        eventMinHeight: 30,
        allDaySlot: false,
        height: 500,
        editable: true,
        droppable: true,
        businessHours: {
          daysOfWeek: [1, 2, 3, 4,5,6],
          startTime: '07:30', 
          endTime: '16:15', 
        }
      }
    }
  },
  methods: {
    handleDateClick: function (arg) {
      alert('date click! ' + arg.dateStr)
    }
  },
  mounted() {
    let containerEl = document.getElementById('containerEl');
    new Draggable(containerEl, {
      itemSelector: '.item-class',
      eventData: function (eventEl) {
        return {
          title: eventEl.innerText,
          duration: '03:15'
        };
      }
    });
  }
}
</script>

