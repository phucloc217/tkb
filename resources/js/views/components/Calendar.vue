
<template>
  <div class="row">
    <div class="col-12">
      <div class="card p-3">
        <div class="card-header pb-3 d-flex align-items-center">
          <div class="col-8">
            <h6>Xếp thời khóa biểu</h6>
            <input type="hidden" id="ngayhoc" v-model="ngayhoc">
          </div>

          <div class="col-4">

            <select name="lophoc" id="" class="form-select" v-model="id_lophoc" @change="changeEventsSource">
              <option v-for="lophoc in listLopHoc" :value="lophoc.id">{{ lophoc.id }}</option>
            </select>
          </div>

        </div>
        <div class="card-body px-0 pt-0 pb-2">
          <FullCalendar :options="calendarOptions" ref="calendar" />
        </div>
      </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Thêm lịch học ngày </h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">

            <div class="">
              <label for="example-text-input" class="form-control-label">Môn học</label>
              <select name="tenlop" id="tenlop" class="form-select" v-model="id_mh">
                <option v-for="monhoc in listMonHoc" :value="monhoc.id" class="">{{ monhoc.tenmh }} - {{ monhoc.name }}
                </option>
              </select>

            </div>
            <div class="">
              <label for="example-text-input" class="form-control-label">Buổi</label>
              <select name="buoihoc" id="buoihoc" class="form-select">
                <option value="7:30:00" class="">Sáng</option>
                <option value="13:00:00" class="">Chiều</option>
              </select>

            </div>
            <div class="">
              <label for="example-text-input" class="form-control-label">Phòng học</label>
              <select name="buoihoc" id="buoihoc" class="form-select">
                <option v-for="phonghoc in listPhongHoc" :value="phonghoc.id">{{ phonghoc.tenphong }} - {{ phonghoc.succhua }}</option>
              </select>

            </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
            <button type="button" class="btn btn-primary" @click="btnLuu">Lưu</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<style scoped>
.item-event-tkb {
  padding-left: 30px;
  display: flex;
  justify-content: center;
  align-items: center;
}
</style>
<script>
import FullCalendar from '@fullcalendar/vue3'
import interactionPlugin from '@fullcalendar/interaction'
import timeGridPlugin from '@fullcalendar/timegrid'
import viLocale from '@fullcalendar/core/locales/vi'
import axios from 'axios'
import { toast } from 'vue3-toastify';
import 'vue3-toastify/dist/index.css';
import ArgonButton from "@/components/ArgonButton.vue";
import Swal from 'sweetalert2'
import 'sweetalert2/src/sweetalert2.scss'
import AddEventModal from "./AddEventModal.vue"
import moment from 'moment';
export default {
  components: {
    FullCalendar,
    ArgonButton,
    AddEventModal
  },
  data() {
    var vm = this
    return {
      form: {
        start: null,
        end: null,
        id_monhoc: null,

      },
      id_mh: null,
      id_lophoc: '',
      ngayhoc: '',
      start: '',
      listMonHoc: null,
      listLopHoc: null,
      listPhongHoc:null,
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
          italicEl.innerHTML = arg.timeText + "<br/>" + '<b>' + arg.event._def.title + "</b>" + "<br/>" + "Gv: " + arg.event._def.extendedProps.description
          let arrayOfDomNodes = [italicEl]
          return { domNodes: arrayOfDomNodes }
        },
        dateClick: function (date, jsEvent, view) {
          vm.showModal(date)
        },
        eventClick: function (info) {
          Swal.fire({
            title: 'Xóa lịch ',
            text: "Bạn sẽ không thể hoàn tác thao tác này",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Xóa',
            confirmButtonColor: '#00FFFF',
            cancelButtonText: 'Đóng',
            reverseButtons: true
          }).then((result) => {
            if (result.isConfirmed) {
              vm.deleteEvent(info.event)
            }
          })
        }
      }

    }
  },
  methods: {
    showModal(date) {
      if (this.id_lophoc != "") {
        let ngayhoc = moment(date.date).format('DD/MM/YYYY')
        this.ngayhoc = ngayhoc
        // console.log(date.date < Date.now())
        $("#exampleModalLabel").text("Thêm lịch học ngày " + this.ngayhoc)
        $("#ngayhoc").val(ngayhoc)
        let modal = bootstrap.Modal.getOrCreateInstance(document.getElementById('exampleModal'))
        modal.show();
      }
    },
    async postNgayHoc() {
      let _THIS = this
      await axios.post(this.API_URL + '/ngayhoc', this.form)
        .then(function (response) {
          toast.success("Thêm thành công", { theme: 'colored' })
          _THIS.changeEventsSource()
        }).
        catch(function (err) {
          toast.error(err.response.data.message, { theme: 'colored' })
        })
    },
    btnLuu() {
      if (this.id_lophoc == "" || this.id_lophoc == null) return;
      this.form.id_monhoc = this.id_mh
      let time = $("#ngayhoc").val();
      let gio = $("#buoihoc").val();
      gio = gio.split(":")
      let bd = moment(time, "DD-MM-YYYY HH:mm:ss").set({ hour: gio[0], minute: gio[1], second: 0, millisecond: 0 })
      this.form.start = bd.toISOString(true)
      let kt = bd.add(3, 'hours').add(15, 'minutes')
      this.form.end = kt.toISOString(true)
      this.postNgayHoc();
    },
    async getLopHoc() {
      let _THIS = this
      await axios.get(this.API_URL + '/lophoc')
        .then(function (response) {
          _THIS.listLopHoc = response.data
        })
        .catch(function (err) {
          if(err.data!=null)
          toast.error("Không thể lấy danh sách lớp học", { theme: 'colored' })
        });
    },
    async changeEventsSource() {
      let _THIS = this
      let calendarApi = this.$refs.calendar.getApi()
      var events = calendarApi.getEventSources()
      events.forEach(event => {
        event.remove()
      })
      await this.getMonHoc()
      this.listMonHoc.forEach(element => {
        calendarApi.addEventSource(this.API_URL + "/ngayhoc/" + element.id)
      });
      calendarApi.refetchEvents()
    },
    async getMonHoc() {
      let _THIS = this
      await axios.get(this.API_URL + '/monhoc/' + this.id_lophoc)
        .then(function (response) {
          _THIS.listMonHoc = response.data
        })
        .catch(function (err) {
          toast.error("Không thể lấy danh sách môn học", { theme: 'colored' })
        });
    },
    async deleteEvent(event) {
      let _THIS = this
      let id = event._def.publicId
      await axios.delete(this.API_URL+'/ngayhoc/'+id,{ data: { id: id } })
        .then(function (respone) {
          Swal.fire(
            'Xóa thành công!',
            'Lịch học đã được xóa.',
            'success'
          )
          event.remove()
        })
        .catch(function (err){
          Swal.fire(
            'Đã xảy ra lỗi!',
            'Không thể xóa lịch học',
            'error'
          )
          return 0;
        })
    },
    async getPhongHoc() {
      let _THIS = this
      await axios.get(this.API_URL + '/phonghoc/' + this.id_lophoc)
        .then(function (response) {
          _THIS.listPhongHoc = response.data
        })
        .catch(function (err) {
          toast.error("Không thể lấy danh sách phòng học", { theme: 'colored' })
        });
    },
  },
  mounted() {
    this.getLopHoc();
  }
}
</script>

