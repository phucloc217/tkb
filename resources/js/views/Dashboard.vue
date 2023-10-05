<template>
  <div class="row me-0 ps-1">
    <div class="col-12 p-1">
      <div class="card p-3">
        <div class="card-body p-1">
          <FullCalendar :options="calendarOptions" ref="calendar" />
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import FullCalendar from '@fullcalendar/vue3'
import interactionPlugin from '@fullcalendar/interaction'
import timeGridPlugin from '@fullcalendar/timegrid'
import viLocale from '@fullcalendar/core/locales/vi'
export default {

  name: "dashboard-default",
  data() {
    var vm = this
    return {

      user_id: window.sessionStorage.getItem('userID'),
      calendarOptions: {
        plugins: [timeGridPlugin, interactionPlugin],
        initialView: 'timeGridWeek',
        headerToolbar: [

        ],
        events: []
        ,
        locale: viLocale,
        slotMinTime: "07:30:00",
        slotMaxTime: "17:00:00",
        eventMinHeight: 30,
        allDaySlot: false,
        height: 500,
        editable: true,
        droppable: true,
        eventColor: '#ed8936',
        eventTextColor: 'white',
        businessHours: {
          daysOfWeek: [1, 2, 3, 4, 5, 6],
          startTime: '07:30',
          endTime: '16:15',
        },
        hiddenDays: [0],
        eventContent: function (arg) {
          let italicEl = document.createElement('div')
          italicEl.classList.add("item-event-tkb")
          italicEl.innerHTML = arg.timeText + "<br/>" + '<b>' + arg.event._def.title + "</b>" + "<br/>" + "Phòng: " + arg.event._def.extendedProps.phong
          let arrayOfDomNodes = [italicEl]
          return { domNodes: arrayOfDomNodes }
        },
        dateClick: function (date, jsEvent, view) {

        },
        eventClick: function (info) {

        }
      }
    }
  },
  components: {
    FullCalendar
  },
  methods: {
     getLichHoc() {
      let _THIS = this
      let calendarApi = this.$refs.calendar.getApi()

      calendarApi.addEventSource( this.API_URL + "/getngayhocbygv/" + this.user_id)
      calendarApi.refetchEvents()
    }
  },
  mounted() {
    this.getLichHoc();
  }
};
</script>
