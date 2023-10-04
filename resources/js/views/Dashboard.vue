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
    return {
      calendarOptions: {
        plugins: [timeGridPlugin, interactionPlugin],
        initialView: 'timeGridWeek',
        headerToolbar: [

        ],
        events: {
        },
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
          italicEl.innerHTML = arg.timeText + "<br/>" + '<b>' + arg.event._def.title + "</b>" + "<br/>" + "Gv: " + arg.event._def.extendedProps.description + "<br/>" + "Phòng: " + arg.event._def.extendedProps.phong
          let arrayOfDomNodes = [italicEl]
          return { domNodes: arrayOfDomNodes }
        },
        dateClick: function (date, jsEvent, view) {
          // vm.showModal(date)
        },
        eventClick: function (info) {
          // Swal.fire({
          //   title: 'Xóa lịch ',
          //   text: "Bạn sẽ không thể hoàn tác thao tác này",
          //   icon: 'warning',
          //   showCancelButton: true,
          //   confirmButtonText: 'Xóa',
          //   confirmButtonColor: '#00FFFF',
          //   cancelButtonText: 'Đóng',
          //   reverseButtons: true
          // }).then((result) => {
          //   if (result.isConfirmed) {
          //     vm.deleteEvent(info.event)
          //   }
          // })
        }
      }
    }
  },
  components: {
    FullCalendar
  },
};
</script>
