<template>
  <div class="card">
    <div class="card-header pb-0">
      <div class="d-flex align-items-center"> <h6>Danh sách giảng viên</h6>
      <router-link to="/themgiangvien" class="btn btn-sm btn-success ms-auto" color="success" >Thêm Giảng viên</router-link>
      </div>
     
    </div>
    <div class="card-body px-0 pt-0 pb-2">
      <div class="table-responsive p-0">
        <table class="table align-items-center mb-0">
          <thead>
            <tr>
              <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Giảng viên</th>
              <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Học hàm, học vị</th>
              <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Số điện thoại
              </th>
              <th class="text-secondary opacity-7"></th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="giangvien, index  in listGiangVien">
              <td>
                <div class="d-flex px-2 py-1">
                  <div>
                    <img src="../../assets/img/team-2.jpg" class="avatar avatar-sm me-3" alt="user1" />
                  </div>
                  <div class="d-flex flex-column justify-content-center">
                    <h6 class="mb-0 text-sm">{{ giangvien.name }}</h6>
                    <p class="text-xs text-secondary mb-0">{{ giangvien.email }}</p>
                  </div>
                </div>
              </td>
              <td>
                <p class="text-xs font-weight-bold mb-0">{{  giangvien.hocham == 'GS' ? 'Giáo sư' : giangvien.hocham == 'PSG' ? "Phó giáo sư":""}}</p>
                <p class="text-xs text-secondary mb-0">{{ giangvien.hocvi == 'CN' ? 'Cử nhân / Kỹ sư':giangvien.hocvi=='THS'?'Thạc sĩ':'Tiến sĩ' }}</p>
              </td>

              <td class="align-middle text-center">
                <span class="text-secondary text-xs font-weight-bold">{{ giangvien.sdt }}</span>
              </td>
              <td class="align-middle">
                <router-link :to="{name: 'Update Giảng Viên', params: {id: giangvien.id}}" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip"
                  data-original-title="Edit user">Chỉnh sửa </router-link>
              </td>
            </tr>

          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script>
import { toast } from 'vue3-toastify';
import 'vue3-toastify/dist/index.css';
import ArgonButton from "@/components/ArgonButton.vue";
export default {

  name: "giangvien-table",
  components:{
    ArgonButton,
  },
  data() {
    return {
      listGiangVien: null,
    }
  },
  methods: {
    async getGiangVien() {
      let _THIS = this;
      await axios.get(this.API_URL + '/user')
        .then(function (response) {
          _THIS.listGiangVien = response.data
        })
        .catch(function (err) {
          // console.log(err)
          toast.error("Đã xảy ra lỗi", { theme: 'colored' })
        });
    },
  },
  mounted() {
    this.getGiangVien();
  }
};
</script>
