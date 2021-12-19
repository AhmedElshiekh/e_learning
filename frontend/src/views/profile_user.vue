<template>
  <div class="profile_user">
    <div class="profile">
      <div class="body_profile">
        <div class="row div_up" style="padding: 0px">
          <div class="col-lg-3 profile_items">
            <div class="d-user-avater">
              <div class="img_profile">
                <img
                  :src="$api_url + profile_user.image"
                  v-if="profile_user.image"
                />
                <img
                  v-if="!profile_user.image"
                  src="..//assets/images/user-3.png"
                />
                <div
                  class="top"
                  data-bs-toggle="modal"
                  data-bs-target="#Modaledite"
                >
                  <i class="fa fa-edit"></i>
                </div>
              </div>
              <h4>{{ profile_user.name }}</h4>
              <p style="color: #bf751b" v-if="profile_user.placementTest">
                the last placementTest rate
                {{ profile_user.placementTest.rate }}%
              </p>
              <p style="color: #bf751b" v-if="profile_user.placementTest">
                the last placementTest score
                {{ profile_user.placementTest.score }}/{{
                  profile_user.placementTest.total
                }}
              </p>
              <span>{{ profile_user.country }}</span>
            </div>
            <ul class="itemul_profile">
              <li>
                <a
                  v-on:click="
                    (showedite = true),
                    (showCourses = false),
                    (showClasses = false),
                    (showPrivetClasses = false)
                  "
                  ><i class="fa fa-heart"></i>{{ $t("My Profile") }}</a
                >
              </li>
              <li>
                <a
                  v-on:click="
                    (showedite = false),
                      (showCourses = true),
                      (showClasses = false),
                      (showPrivetClasses = false)
                  "
                  ><i class="fa fa-clone"></i>{{ $t("My Courses") }}
                </a>
              </li>
              <li>
                <a
                  v-on:click="
                    (showedite = false),
                      (showCourses = false),
                      (showClasses = true),
                      (showPrivetClasses = false)
                  "
                  ><i class="fa fa-users"></i>{{ $t("My Classes") }}</a
                >
              </li>
              <li>
                <a
                  v-on:click="
                    (showedite = false),
                      (showCourses = false),
                      (showClasses = false),
                      (showPrivetClasses = true)
                  "
                  ><i class="fa fa-users"></i>{{ $t("Private Classes") }}</a
                >
              </li>
            </ul>
          </div>
          <div class="col-lg-9">
            <div class="dashboard_container_body p-4" v-if="showedite">
              <div class="viewer_detail_wraps">
                <div class="caption">
                  <h3>{{ $t("Edit Information") }}</h3>
                  <div class="viewer_header">
                    <h4>{{ profile_user.country }}</h4>
                    <hr />

                    <form @submit="editedetiles" method="post">
                      <div class="form-group">
                        <label>{{ $t("Your Name:-") }}</label>
                        <input
                          type="text"
                          class="form-control"
                          id="Name"
                          aria-describedby="Name"
                          placeholder="Name"
                          v-model="edit.name"
                        />
                      </div>
                      <div class="form-group">
                        <label>{{ $t("Email:-") }}</label>
                        <input
                          type="email"
                          class="form-control"
                          placeholder="Email"
                          v-model="edit.email"
                        />
                      </div>
                      <div class="form-group">
                        <label>{{ $t("Phone:-") }}</label>
                        <vue-tel-input
                          v-model="edit.phone"
                          mode="international"
                          autofocus="true"
                          autocomplete="true"
                          required
                          country-changed
                        >
                        </vue-tel-input>
                      </div>
                      <div>
                        <div class="form-group" v-if="changepassword == true">
                          <label>
                            {{ $t("old Password") }}
                          </label>
                          <input
                            type="Password"
                            class="form-control"
                            :placeholder="$t('old Password')"
                            v-model="edit.oldPassword"
                            required
                          />
                        </div>
                        <div class="form-group" v-if="changepassword == true">
                          <label>
                            {{ $t("New password") }}
                          </label>
                          <input
                            type="Password"
                            class="form-control"
                            :placeholder="$t('New password')"
                            v-model="edit.newPassword"
                            required
                          />
                        </div>
                        <div class="form-group" v-if="changepassword == true">
                          <label>
                            {{ $t("New Password Confirmation") }}
                          </label>
                          <input
                            type="Password"
                            class="form-control"
                            :placeholder="$t('New Password Confirmation')"
                            v-model="edit.newPassword_confirmation"
                            required
                          />
                        </div>
                      </div>
                      <a
                        class="btn btn-primary"
                        id="change_pass"
                        @click="changepassword = true"
                        >{{ $t("Change Password") }}</a
                      >
                      <input
                        type="submit"
                        name=""
                        :value="$t('Edit')"
                        class="btn btn-primary"
                      />
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <div
              class="dashboard_container_body p-4 classes"
              v-if="showCourses"
            >
              <h5>{{ $t("My Courses") }}</h5>
              <hr />
              <div
                class="margin_used"
                v-for="myCourse in myCourses"
                v-bind:key="myCourse.key"
              >
                <div class="part">
                  <router-link
                    :to="{
                      name: 'course_detiles',
                      params: {
                        key_course: myCourse.key,
                        slug_course: myCourse.slug,
                      },
                    }"
                    tag="a"
                  >
                    <div class="part_img">
                      <img :src="$api_url + myCourse.image" />
                    </div>
                    <div class="pragraph">
                      <h4>{{ myCourse.name }}</h4>
                      <p>
                        {{ myCourse.short_description }}
                      </p>
                      <!-- <div class="cources_price">
                      ${{ myCourse.discountPrice }}
                      <div class="less_offer" style="color: green">
                        ${{ myCourse.price }}
                      </div>
                    </div> -->

                      <p class="p1" style="color: #ff9800">
                        {{ myCourse.level }}
                      </p>
                      <!-- <ul class="info_teatcher">
                        <li><img :src="$api_url + myCourse.teacher_img" /></li>
                        <li>{{ myCourse.teacher }}</li>
                      </ul> -->
                      <a
                        href="#"
                        v-for="teacher in myCourse.teachers"
                        v-bind:key="teacher.key"
                      >
                        <img
                          :src="$api_url + teacher.image"
                          class="img-fluid img_teacher"
                          v-if="teacher.image"
                          alt
                        />
                        <img
                          v-if="!teacher.image"
                          src="..//assets/images/user-3.png"
                          class="img-fluid img_teacher"
                          alt
                        />
                        <h3
                          class="edu_title"
                          v-if="myCourse.teachers.length == 1"
                          style="
                            font-size: 16px;
                            margin: 0px;
                            display: inline-block;
                          "
                        >
                          {{ teacher.name }}
                        </h3>
                      </a>
                      <div class="clearfix"></div>
                    </div>
                  </router-link>
                  <a
                    class="scoremodel"
                    data-bs-toggle="modal"
                    data-bs-target="#Modalescore"
                    @click="score(myCourse.placement, myCourse.exam)"
                    >your score</a
                  >
                </div>
                <div class="clearfix"></div>
              </div>
            </div>
            <div class="dashboard_container_body p-4" v-if="showClasses">
              <h5 style="font-size: 20px">{{ $t("My Classes") }}</h5>
              <hr />
              <!-- Row -->
              <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                  <div class="dashboard_container">
                    <div class="">
                      <div class="table-responsive">
                        <table class="table">
                          <thead class="thead-dark">
                            <tr>
                              <th scope="col">{{ $t("Teacher") }}</th>
                              <th scope="col">{{ $t("Courses") }}</th>
                              <th scope="col">{{ $t("Lessons") }}</th>
                              <th scope="col">{{ $t("Next Lesson") }}</th>
                              <th scope="col">{{ $t("Action") }}</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr
                              v-for="myClasse in myclasses"
                              v-bind:key="myClasse.key"
                            >
                              <td scope="row">
                                <p
                                  v-for="teacher in myClasse.teachers"
                                  v-bind:key="teacher.key"
                                >
                                  {{ teacher.name }}
                                </p>
                              </td>
                              <td>{{ myClasse.name }}</td>
                              <td>
                                <span class="payment_status inprogress">{{
                                  myClasse.lessons
                                }}</span>
                              </td>
                              <td>{{ myClasse.lessonTime }}</td>
                              <!-- <td>
                              <span
                                class="payment_status inprogress"
                                v-if="myClasse.lessonTime != null"
                                >{{ myClasse.lessonTime }}</span
                              >
                              <span
                                class="payment_status inprogress"
                                v-if="myClasse.lessonTime == null"
                                >--:--:--</span
                              >
                            </td> -->
                              <td>
                                <div class="dash_action_link">
                                  <router-link
                                    :to="{
                                      name: 'lesson_myclass_student',
                                      params: {
                                        key_classe: myClasse.key,
                                      },
                                    }"
                                    tag="a"
                                    class="view"
                                    >{{ $t("show") }}</router-link
                                  >
                                </div>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /Row -->
            </div>
            <div class="dashboard_container_body p-4" v-if="showPrivetClasses">
              <h5 style="font-size: 20px">{{ $t("Private Classes") }}</h5>
              <hr />
              <!-- Row -->
              <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                  <div class="dashboard_container">
                    <div class="">
                      <div class="table-responsive">
                        <table class="table">
                          <thead class="thead-dark">
                            <tr>
                              <th scope="col">{{ $t("Teacher") }}</th>
                              <th scope="col">{{ $t("Courses") }}</th>
                              <th scope="col">{{ $t("Lessons") }}</th>
                              <th scope="col">{{ $t("Next Lesson") }}</th>
                              <th scope="col">{{ $t("Action") }}</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr
                              v-for="myPrivateClasse in myPrivateClasses"
                              v-bind:key="myPrivateClasse.key"
                            >
                              <td scope="row">{{ myPrivateClasse.teacher }}</td>
                              <td>{{ myPrivateClasse.name }}</td>
                              <td>
                                <span class="payment_status inprogress">{{
                                  myPrivateClasse.lessons
                                }}</span>
                              </td>
                              <td>{{ myPrivateClasse.lessonTime }}</td>
                              <!-- <td>
                              <span
                                class="payment_status inprogress"
                                v-if="myClasse.lessonTime != null"
                                >{{ myClasse.lessonTime }}</span
                              >
                              <span
                                class="payment_status inprogress"
                                v-if="myClasse.lessonTime == null"
                                >--:--:--</span
                              >
                            </td> -->
                              <td>
                                <div class="dash_action_link">
                                  <router-link
                                    :to="{
                                      name: 'lesson_myprivetclass_student',
                                      params: {
                                        key_classe: myPrivateClasse.key,
                                      },
                                    }"
                                    tag="a"
                                    class="view"
                                    >{{ $t("show") }}</router-link
                                  >
                                </div>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /Row -->
            </div>
          </div>
        </div>
      </div>
      <div class="clearfix"></div>
    </div>
    <div
      class="modal fade"
      id="Modalescore"
      tabindex="-1"
      aria-labelledby="ModalediteLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">My Score</h5>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
              aria-label="Close"
            ></button>
          </div>
          <div class="modal-body">
            <div class="">
              <h4>Placement test</h4>
              <p>your score :- {{ placement.score }} / {{ placement.total }}</p>
              <p>percentage:- {{ placement.rate }} %</p>
              <hr />
            </div>
            <div class="">
              <h4>final exam</h4>
              <p>your score :- {{ exam.score }} / {{ exam.total }}</p>
              <p>percentage:- {{ exam.rate }} %</p>
            </div>
          </div>
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-secondary"
              data-bs-dismiss="modal"
            >
              {{ $t("close") }}
            </button>
          </div>
        </div>
      </div>
    </div>
    <div
      class="modal fade"
      id="Modaledite"
      tabindex="-1"
      aria-labelledby="ModalediteLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">
              {{ $t("Upload Image:-") }}
            </h5>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
              aria-label="Close"
            ></button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <div class="upload-btn-wrapper">
                <input
                  type="file"
                  ref="file"
                  class="file_upload_profile"
                  @change="handleFileUpload"
                />
                <button class="btn file_upload_btn">
                  {{ $t("Image") }} <i class="fa fa-image"></i>
                </button>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-secondary"
              data-bs-dismiss="modal"
            >
              {{ $t("close") }}
            </button>
            <button
              type="button"
              class="btn btn-primary"
              @click="editedetileimage"
            >
              {{ $t("Save changes") }}
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import axios from "axios";
import Vue from "vue";
import VueTelInput from "vue-tel-input";
import "vue-tel-input/dist/vue-tel-input.css";
Vue.use(VueTelInput);
export default {
  name: "profile_user",
  data: function () {
    return {
      showedite: true,
      changepassword: false,
      showCourses: false,
      showClasses: false,
      profile_user: null,
      myCourses: null,
      myclasses: null,
      edit: {
        name: null,
        email: null,
        phone: null,
        oldPassword: null,
        newPassword: null,
        newPassword_confirmation: null,
        img: {
          lastModified: null,
          lastModifiedDate: null,
          name: null,
          size: null,
          type: null,
          webkitRelativePath: null,
        },
      },
      showPrivetClasses: false,
      myPrivateClasses: [],
      placement: [],
      exam: [],
      Modalescore: false,
    };
  },
  mounted: function () {
    if (localStorage.getItem("token") != null) {
      axios
        .get(
          this.$api_url +
            "api/myAccount" +
            "?lang=" +
            localStorage.getItem("lang") +
            "&token=" +
            localStorage.getItem("token")
        )
        .then((response) => {
          this.profile_user = response.data.data;
          console.log("this.profile_user");
          console.log(this.profile_user);
          this.edit.name = this.profile_user.name;
          this.edit.email = this.profile_user.email;
          this.edit.phone = this.profile_user.phone;
          console.log(this.edit);
          if (this.profile_user.type == "student") {
            /*********************api/myCourses*************/
            axios
              .get(
                this.$api_url +
                  "api/myCourses" +
                  "?lang=" +
                  localStorage.getItem("lang") +
                  "&token=" +
                  localStorage.getItem("token")
              )
              .then((response) => {
                this.myCourses = response.data.data;
              });
            /*********************api/myClasses*************/
            axios
              .get(
                this.$api_url +
                  "api/myClasses" +
                  "?lang=" +
                  localStorage.getItem("lang") +
                  "&token=" +
                  localStorage.getItem("token")
              )
              .then((response) => {
                this.myclasses = response.data.data;
                console.log("this.myClasses ");
                console.log(this.myclasses);
              });
            /*********************api/myClasses*************/
            axios
              .get(
                this.$api_url +
                  "api/myPrivateClasses" +
                  "?lang=" +
                  localStorage.getItem("lang") +
                  "&token=" +
                  localStorage.getItem("token")
              )
              .then((response) => {
                this.myPrivateClasses = response.data.data;
                console.log("this.myClasses " + this.myPrivateClasses);
                console.log(this.myPrivateClasses);
              });
          } else if (this.profile_user.type == "teacher") {
            window.location.href = "/profile";
          }
        });
    } else {
      this.$router.back();
    }
  },
  methods: {
    handleFileUpload: function (e) {
      this.edit.img = e.target.files[0];
    },
    // fileSelected: function (event) {
    //   const file = event.target.files.item(0);
    //   const reader = new FileReader();
    //   reader.addEventListener("load", this.imageLoaded);
    //   reader.readAsDataURL(file);
    // },
    // imageLoaded: function (event) {
    //   this.image = event.target.result;

    // },
    // upload() {
    //   // axios upload base64
    //   // axios.post('/upload',{image:this.image});

    //   const form = new FormData();
    //   form.append(this.file, this.file.name);
    // },
    editedetiles: function (e) {
      axios
        .post(
          this.$api_url +
            "api/studentEditProfile?lang=" +
            localStorage.getItem("lang") +
            "&token=" +
            localStorage.getItem("token"),
          {
            name: this.edit.name,
            email: this.edit.email,
            phone: this.edit.phone,
            oldPassword: this.edit.oldPassword,
            newPassword: this.edit.newPassword,
            newPassword_confirmation: this.edit.newPassword_confirmation,
            //   img: this.edit.img,
            //  config: { headers: {'Content-Type': 'multipart/form-data' }},
          }
        )
        .then((response) => {
          console.warn(response);
          console.log(response);

          this.$fire({
            title: "Successed Edit",
            type: "success",
          }).then(() => {
            location.reload();
          });
        })
        .catch((error) => {
          this.error = error;
        });
      e.preventDefault();
    },
    editedetileimage: function (e) {
      let fd = new FormData();

      fd.append("img", this.edit.img);

      console.log("image");
      console.log(this.fd);
      axios
        .post(
          this.$api_url +
            "api/userEditAvatar?token=" +
            localStorage.getItem("token"),
          fd
          // {
          //   headers: {'Content-Type': 'multipart/form-data' }
          // }
        )
        .then((response) => {
          console.warn(response);
          console.log(response);

          this.$fire({
            title: "Successed Edit",
            type: "success",
          }).then(() => {
            location.reload();
          });
        })
        .catch((error) => {
          this.error = error;
        });
      e.preventDefault();
    },
    score: function (placement, exam) {
      this.placement = placement;
      this.exam = exam;
      this.Modalescore = true;
      console.log(this.Modalescore);
    },
  },
};
</script>
