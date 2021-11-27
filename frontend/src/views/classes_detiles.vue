<template>
  <div class="classes_detiles course_detiles">
    <!-- ============================================================== -->
    <header>
      <img src="..//assets/images/background1.jpg" class="img" />
      <div class="div_title">
        <h1>{{ classDetails.name }}</h1>
        <p>
          {{ classDetails.short_description }}
        </p>
        <ul>
          <li>{{ classDetails.category }}</li>
          <li>{{ classDetails.subCategory }}</li>
        </ul>
      </div>
    </header>
    <!--------------------------------start section courses---------->
    <section class="sec_detiles_course">
      <div class="container">
        <div class="col-lg-12">
          <div class="sec_detiles_course_left">
            <h2>{{ classDetails.name }}</h2>
            <ul class="buy_ul">
              <li
                v-if="
                  classDetails.discountPrice != 0 &&
                  classDetails.discountPrice != null
                "
              >
                <span>${{ classDetails.discountPrice }}</span>
                <p>${{ classDetails.price }}</p>
              </li>
              <li
                v-if="
                  classDetails.discountPrice == 0 ||
                  classDetails.discountPrice == null
                "
              >
                ${{ classDetails.price }}
              </li>
              <li v-if="classDetails.owner == false">
                <a class="btn" @click="checkBuy(classDetails.key)">{{
                  $t("Buy Now")
                }}</a>
              </li>
            </ul>
          </div>
          <!-- <div class="sec_detiles_course_left col-lg-6"></div> -->
          <div class="sec_detiles_course_lesson edu_wraper">
            <div class="class_design">
              <img :src="$api_url + image_classe" class="img_courses" />
            </div>
            <div class="lessons">
              <a
                href="#"
                v-for="teacher in classDetails.teachers"
                v-bind:key="teacher.key"
              >
                <img :src="$api_url + teacher.image" class="img-fluid" alt />
                <h3 class="edu_title" v-if="classDetails.teachers.length == 1">
                  {{ teacher.name }}
                </h3>
              </a>
              <p
                v-for="lesson in classDetails.lessons"
                v-bind:key="lesson.key"
                style="font-size: 17px"
              >
                <i class="fa fa-check" style="color: green"> </i
                >{{ lesson.name }}
              </p>
            </div>
            <div class="clearfix"></div>
          </div>
          <!-- ============================ Course overview ================================== -->
          <div class="overview" v-show="key == 1">
            <div class="row">
              <div class="edu_wraper">
                <h4 class="edu_title">{{ $t("Course Overview") }}</h4>
                <p v-html="classDetails.description"></p>
                <h6>{{ $t("Requirements") }}</h6>
                <div v-html="classDetails.requirements"></div>

                <h4 class="edu_title">{{ $t("What you will learn") }}</h4>
                <div class="row" v-html="classDetails.WhatWillLearn"></div>
              </div>
            </div>
            <div style="clear: both"></div>
            <div style="clear: both"></div>
          </div>
          <!-- Instructor Detail -->
          <!-- <div
            class="tab-pane instructor"
            role="tabpanel"
            aria-labelledby="instructor-tab"
            v-show="key == 3"
          >
            <div class="single_instructor">
              <div class="single_instructor_thumb">
                <a href="#"
                  ><img
                    v-for="teacher in classDetails.teachers"
                    v-bind:key="teacher.key"
                    :src="$api_url + teacher.image"
                    class="img-fluid"
                    alt=""
                />
                </a>
              </div>
              <div class="single_instructor_caption">
                <h4>
                  <a href="#">{{ classDetails.teacher.name }}</a>
                </h4>
                <p>
                  {{ classDetails.teacher.qualifications }}
                </p>
                <ul class="social_info">
                  <li>
                    <a :href="classDetails.teacher.facebook"
                      ><i class="fa fa-facebook"></i
                    ></a>
                  </li>
                  <li>
                    <a :href="classDetails.teacher.whatsApp"
                      ><i class="fa fa-instagram"></i
                    ></a>
                  </li>
                </ul>
              </div>
            </div>
          </div> -->
        </div>
      </div>
      <div style="clear: both"></div>
    </section>
    <div style="clear: both"></div>

    <!-- <footer>
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
    </footer> -->
    <div
      class="modal fade show"
      id="popup-paypal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="myModalLabel"
      v-if="isModalVisible == true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">PayPal</h5>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
              @click="isModalVisible = false"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div v-if="srclink != null">
              <iframe :src="srclink.link" frameborder="0"> </iframe>
            </div>
          </div>
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-secondary"
              @click="isModalVisible = false"
            >
              Close
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import axios from "axios";
// import PaypalPage from "@/components/Paypal.vue";
export default {
  name: "classes_detiles",
  // components: { PaypalPage },
  data: function () {
    return {
      key: "1",
      classDetails: null,
      owner_find: true,
      isModalVisible: false,
      srclink: null,
      deleteClicked: false,
      //   global_info: null,
      //   footer: {
      //     address: null,
      //     email: null,
      //     facebook: null,
      //     instagram: null,
      //     linkedin: null,
      //     location: null,
      //     phone: null,
      //     twitter: null,
      //     whatsapp: null,
      //     youTube: null,
      //   },
    };
  },
  created() {
    this.key_classes = this.$route.params.key_classes;
    this.image_classe = this.$route.params.image_classe;
  },
  mounted: function () {
    // console.log(this.key_classes);
    // console.log(this.image_classe);  axios
    //   .get(this.$api_url + "api/global?lang=" + localStorage.getItem("lang"))
    //   .then((response) => {
    //     this.global_info = response.data.data;
    //   });

    if (this.key_classes == null) {
      this.$router.back();
    }
    if (localStorage.getItem("token") != null) {
      axios
        .get(
          this.$api_url +
            "api/liveCourseDetails/" +
            this.key_classes +
            "?lang=" +
            localStorage.getItem("lang") +
            "&token=" +
            localStorage.getItem("token")
        )
        .then((response) => {
          this.classDetails = response.data.data;

          console.log("this.courseDetails");
          console.log(this.classDetails);
        });
    } else {
      console.log("wellcom");
      axios
        .get(
          this.$api_url +
            "api/liveCourseDetails/" +
            this.key_classes +
            "?lang=" +
            localStorage.getItem("lang")
        )
        .then((response) => {
          this.classDetails = response.data.data;
        });
    }

    // axios.get(this.$api_url + "api/footer").then((response) => {
    //   this.footer = response.data.data;
    //   console.log(this.footer);
    // });
  },
  methods: {
    checkBuy: function (keyclasse) {
      console.log("the key is" + keyclasse);
      if (localStorage.getItem("token") != null) {
        this.isModalVisible = true;
        axios
          .get(
            this.$api_url +
              "api/payment/" +
              keyclasse +
              "?lang=" +
              localStorage.getItem("lang") +
              "&token=" +
              localStorage.getItem("token")
          )
          .then((response) => {
            this.srclink = response.data.data;
            console.log("this.srclink");
            console.log(this.srclink);
          });
      } else {
        this.$fire({
          title: "login or register",
          type: "error",
        });
        this.showModal = true;
        this.$router.back();
      }
    },
    onClick() {
      this.deleteClicked = true;
    },
  },
};
</script>
