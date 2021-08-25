<template>
  <div class="profile">
    <div class="body_profile">
      <div class="row div_up" style="padding: 0px">
        <div class="col-lg-3 profile_items">
          <div class="d-user-avater">
            <div class="img_profile">
                <img
                  src="..//assets/images/user-3.png"
                  v-if="profile.image == null"
                />
                <img
                  :src="$api_url + profile.image"
                  v-if="profile.image != null"
                />
                <div
                  class="top"
                  data-bs-toggle="modal"
                  data-bs-target="#Modaledite"
                >
                  <i class="fa fa-edit"></i>
                </div>
              </div>
            <h4>{{ profile.name }}</h4>
            <span>{{ profile.country }}</span>
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
                  ><i class="fa fa-users"></i>{{ $t("Privet Classes") }}</a
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
                  <h4>{{ profile.country }}</h4>
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
                        s
                        autocomplete="true"
                        required
                        country-changed
                      >
                      </vue-tel-input>
                    </div>

                    <div>
                      <div class="form-group">
                        <input
                          type="Password"
                          class="form-control"
                          :placeholder="$t('old Password')"
                          v-model="edit.oldPassword"
                          required
                          v-if="changepassword == true"
                        />
                      </div>
                      <div class="form-group">
                        <input
                          type="Password"
                          class="form-control"
                          :placeholder="$t('New password')"
                          v-model="edit.newPassword"
                          required
                          v-if="changepassword == true"
                        />
                      </div>
                      <div class="form-group">
                        <input
                          type="Password"
                          class="form-control"
                          :placeholder="$t('New password')"
                          v-model="edit.newPassword_confirmation"
                          required
                          v-if="changepassword == true"
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
            style="text-align: left"
          >
            <h5>{{$t("My Courses") }}</h5>
            <hr />
            <!-- <router-link
              to="/create_course"
              class="btn btn-success Create_Course"
              tag="button"
              >Create Course
            </router-link> -->
            <div
              class="margin_used"
              v-for="myCourse in myCourses"
              v-bind:key="myCourse.key"
            >
              <div class="part">
                <div class="part_img">
                  <img :src="$api_url + myCourse.image" />
                  <div class="action">
                    <router-link
                      :to="{
                        name: 'showCourse',
                        params: {
                          key_mycourse: myCourse.key,
                          slug_mycourse: myCourse.slug,
                          image_mycourse: myCourse.image,
                        },
                      }"
                      class="btn btn-success Create_Course i2"
                      tag="a"
                      ><i class="fa fa-eye"></i
                    ></router-link>
                    <!-- 
                    <router-link
                       :to="{
                        name:'edit_course',
                        params: {
                          key_mycourse: myCourse.key,
                          slug_mycourse: myCourse.slug,
                          image_mycourse: myCourse.image,
                        },
                      }"
                      class="btn btn-success Create_Course i3"
                      tag="a"
                      ><i class="fa fa-pencil"></i>
                    </router-link>

                    <a class="btn btn-success Create_Course i1"
                      ><i class="fa fa-trash"></i>
                    </a>-->
                  </div>
                </div>
                <div class="pragraph">
                  <h3>{{ myCourse.name }}</h3>
                  <p>
                    {{ myCourse.short_description }}
                  </p>
                  <!-- <div class="cources_price">
                    ${{ myCourse.discountPrice }}
                    <div class="less_offer" style="color: green">
                      ${{ myCourse.price }}
                    </div>
                  </div> -->

                  <p class="p1" style="color: #ff9800">{{ myCourse.level }}</p>
                  <!-- <ul class="info_teatcher">
                    <li><img :src="$api_url + myCourse.teacher_img" /></li>
                    <li>{{ myCourse.teacher }}</li>
                  </ul> -->
                  <div class="clearfix"></div>
                </div>
              </div>
              <div class="clearfix"></div>
            </div>
          </div>
          <div class="dashboard_container_body p-4" v-if="showClasses">
            <h5 style="font-size: 20px">{{$t("My Classes")}}</h5>
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
                            <!-- <th scope="col">{{ $t("Teacher") }}</th> -->
                            <th scope="col">{{$t("Courses")}}</th>
                            <th scope="col">{{$t("Lessons")}}</th>
                            <th scope="col">{{$t("Next Lesson")}}</th>
                            <th scope="col">{{$t("Action")}}</th>
                          </tr>
                        </thead>
                        <tbody>
                         <tr 
                            v-for= "myClasse in myClasses"
                            v-bind:key = "myClasse.key"
                          >
                            <td>{{myClasse.name}}</td>
                            <td>{{ myClasse.lessons }}</td>
                            <td>
                              <span
                                class="payment_status inprogress"
                                >{{ myClasse.lessonTime }}</span
                              >
                            </td>
                            <td>
                              <div class="dash_action_link">
                                <router-link
                                  :to="{
                                    name: 'lesson_myclass',
                                    params: {
                                      key_classe: myClasse.key,
                                    },
                                  }"
                                  class="view"
                                  >{{$t("show")}}</router-link
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
              <h5 style="font-size: 20px">{{ $t("Privet Classes") }}</h5>
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
                              <!-- <th scope="col">{{ $t("Teacher") }}</th> -->
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
                              <!-- <td scope="row">{{ myPrivateClasse.teacher }}</td> -->
                              <td>{{ myPrivateClasse.name }}</td>
                              <td>
                                <span
                                  class="payment_status inprogress"
                                  >{{ myPrivateClasse.lessons }}</span
                                >
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
                                      name: 'lesson_myprivetclass',
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
            <h5 class="modal-title" id="exampleModalLabel">{{ $t("Upload Image:-") }}</h5>
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
                 class="file_upload_profile "
                 @change="handleFileUpload" />
                <button class="btn file_upload_btn">{{$t('Image')}} <i class="fa fa-image"></i></button>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-secondary"
              data-bs-dismiss="modal"
            >
              {{$t('close')}}
            </button>
            <button type="button" class="btn btn-primary"  @click="editedetileimage">{{$t('Save changes')}}</button>
          </div>
        </div>
      </div>
    </div>
  
    <footer>
      <div class="background_footer">
        <div class="row items">
            <div class="col-md-6 animation_left">
              <div class="animation_left">
                <img :src="$api_url + global_info.logo" class="logo" />
              </div>
              <ul style="text-align: left">
                <li>
                  <p style="font-size: 18px">
                    {{
                      $t(
                        "@Copyright2021 Troom: All Rights Reserved Developed by asient.net"
                      )
                    }}
                  </p>
                </li>
              </ul>
            </div>
            <div class="col-md-6">
              <ul style="text-align: center; padding-top: 10px">
                <li>
                  <a href="#"
                    ><img src="..//assets/images/imagesicon1.png"
                  /></a>
                </li>
                <li>
                  <a href="#"
                    ><img src="..//assets/images/imagesicon2.png"
                  /></a>
                </li>
              </ul>
              <ul class="icon">
                <li v-if="footer.facebook != null">
                  <a :href="footer.facebook">
                    <i class="fa fa-facebook"></i>
                  </a>
                </li>
                <li v-if="footer.youtube != null">
                  <a :href="footer.youtube">
                    <i class="fa fa-youtube"></i>
                  </a>
                </li>
                <li v-if="footer.twitter != null">
                  <a :href="footer.twitter">
                    <i class="fa fa-twitter"></i>
                  </a>
                </li>
                <li v-if="footer.whatsapp != null">
                  <a :href="'https://api.whatsapp.com/send?phone='+footer.whatsapp">
                    <i class="fa fa-whatsapp"></i>
                  </a>
                </li>
                <li v-if="footer.instagram != null">
                  <a :href="footer.instagram">
                    <i class="fa fa-instagram"></i>
                  </a>
                </li>
              </ul>
            </div>
          </div>
      </div>
    </footer>

  </div>
</template>
<script>
import axios from "axios";
import Vue from "vue";
import VueTelInput from "vue-tel-input";
import "vue-tel-input/dist/vue-tel-input.css";

Vue.use(VueTelInput);

export default {
  name: "profile",
  data: function () {
    return {
      showedite: true,
      showCourses: false,
      image: "",
      showClasses: false,
      profile: null,
      myCourses: null,
      myClasses: null,
      footer:{
        address: null,
        email: null,
        facebook: null,
        instagram: null,
        linkedin: null,
       location: null,
       phone: null,
       twitter: null,
      whatsapp: null,
      youTube: null,
      },
      edit: {
        name: null,
        email: null,
        phone: null,
        oldPassword: null,
        newPassword: null,
        newPassword_confirmation: null,
        img: null,
      },
      changepassword: false,
        showPrivetClasses: false,
      myPrivateClasses:[],
      global_info: null,
    };
  },
  mounted: function () { 
    axios
      .get(this.$api_url + "api/global?lang=" + localStorage.getItem("lang"))
      .then((response) => {
        this.global_info = response.data.data;
      });
    if (localStorage.getItem("token") != null) {
      axios
        .get(
          this.$api_url +
            "api/myAccount?lang=" +
            localStorage.getItem("lang") +
            "&token=" +
            localStorage.getItem("token")
        )
        .then((response) => {
          this.profile = response.data.data;
          console.log(this.profile);
          this.edit.name = this.profile.name;
          this.edit.email = this.profile.email;
          this.edit.phone = this.profile.phone;
        });
      /*********************api/myCourses*************/
      axios
        .get(
          this.$api_url +
            "api/myCourses?lang=" +
            localStorage.getItem("lang") +
            "&token=" +
            localStorage.getItem("token")
        )
        .then((response) => {
          this.myCourses = response.data.data;
          console.log("my courses");
          console.log(this.myCourses);
        });
      /*********************api/myCourses*************/
      axios
        .get(
          this.$api_url +
            "api/myClasses?lang=" +
            localStorage.getItem("lang") +
            "&token=" +
            localStorage.getItem("token")
        )
        .then((response) => {
          this.myClasses = response.data.data;
          console.log("myClasses");
          console.log(this.myClasses);
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
                console.log("this.myPrivateClasses " + this.myPrivateClasses);
                console.log(this.myPrivateClasses);
              });
    } else {
      this.$router.back();
    }
    axios.get(this.$api_url + "api/footer").then((response) => {
      this.footer = response.data.data;
      console.log(this.footer);
    });
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
    //   this.edit.img = this.image;
    // },
    // upload() {
    //   // axios upload base64
    //   // axios.post('/upload',{image:this.image});

    //   const form = new FormData();
    //   form.append(this.file, this.file.name);
    // },
    editedetiles: function (e) {
      console.log("image");
      console.log(this.edit.img);
      axios
        .post(
          this.$api_url +
            "api/teacherEditProfile?lang=" +
            localStorage.getItem("lang") +
            "&token=" +
            localStorage.getItem("token"),
          {
            headers: { "Content-Type": "multipart/form-data" },
            name: this.edit.name,
            email: this.edit.email,
            phone: this.edit.phone,
            oldPassword: this.edit.oldPassword,
            newPassword: this.edit.newPassword
          }
        )
        .then((response) => {
          // localStorage.setItem("token", response.data.data.access_token);
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
          this.$fire({
            title: "error",
            type: "error",
          });
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
            localStorage.getItem("token"),fd
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
            // location.reload();
          });
        })
        .catch((error) => {
          this.error = error;
        });
      e.preventDefault();
    },
  },
};
</script>
