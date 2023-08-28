<template>
  <div class="card">
    <div class="card-header pb-0">
      <h6>Danh sách giảng viên</h6>
    </div>
    <div class="card-body px-0 pt-0 pb-2">
      <div class="table-responsive p-0">
        <table class="table align-items-center mb-0">
          <thead>
            <tr>
              <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Giảng viên</th>
              <th
                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2"
              >Học hàm, học vị</th>
              <th
                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
              >Employed</th>
              <th class="text-secondary opacity-7"></th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>
                <div class="d-flex px-2 py-1">
                  <div>
                    <img
                      src="../../assets/img/team-2.jpg"
                      class="avatar avatar-sm me-3"
                      alt="user1"
                    />
                  </div>
                  <div class="d-flex flex-column justify-content-center">
                    <h6 class="mb-0 text-sm">Nguyễn Phúc Lộc</h6>
                    <p class="text-xs text-secondary mb-0">loc.nguyen456789@gmail.com</p>
                  </div>
                </div>
              </td>
              <td>
                <p class="text-xs font-weight-bold mb-0"></p>
                <p class="text-xs text-secondary mb-0">Cử nhân/kỹ sư</p>
              </td>
             
              <td class="align-middle text-center">
                <span class="text-secondary text-xs font-weight-bold">23/04/18</span>
              </td>
              <td class="align-middle">
                <a
                  href="javascript:;"
                  class="text-secondary font-weight-bold text-xs"
                  data-toggle="tooltip"
                  data-original-title="Edit user"
                >Chỉnh sửa</a>
              </td>
            </tr>
            
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "giangvien-table",
};
</script>
