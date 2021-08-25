<template>
  <div class="home">
    <!-- ============================================================== -->
    <header>
      <div
        id="carouselExampleControls"
        class="carousel slide"
        data-ride="carousel"
      >
        <div class="carousel-inner">
          <div
            class="carousel-item"
            v-for="(slider, index) in sliders"
            v-bind:key="slider.key"
            :class="{ active: index === 0 }"
          >
            <img
              class="d-block w-100"
              :src="$api_url + slider.image"
              alt="First slide"
            />
            <div class="lig_out"></div>
            <div class="word">
              <h2 :style="{'text-align':slider.direction}" >{{ slider.name }}</h2>
              <p :style="{'text-align':slider.direction, 'text':slider.direction}" >{{ slider.paragraph }}</p>
              <a
                :href="slider.btn_url"
                class="btn button_carousel"
                v-if="slider.btn_name != ''"
                :style="{'text-align':slider.direction}"
              >
                <span>{{ slider.btn_name }} </span>
                <i class="fa fa-chevron-down"></i>
                <!-- <i class="fa fa-chevron-left" v-if= "localStorage.getItem('lang') == 'ar'"></i> -->
              </a>
            </div>
          </div>
        </div>
        <a
          class="carousel-control-prev"
          href="#carouselExampleControls"
          role="button"
          data-slide="prev"
        >
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a
          class="carousel-control-next"
          href="#carouselExampleControls"
          role="button"
          data-slide="next"
        >
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
    </header>
    <!-------------------start section services------------>
    <section class="services">
      <div class="container">
        <div class="col-md-12 classes_bottom">
          <div
            class="col-md-4 col-xs-12 classess"
            v-for="feature in features"
            v-bind:key="feature.key"
          >
            <div class="col-xs-3 classp">
              <img :src="$api_url + feature.image" class="background" />
            </div>
            <div class="col-xs-9 classp">
              <p>
                <span>{{ feature.name }}</span>
                {{ feature.description }}
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>
    <div style="clear: both"></div>
    <!--------------------------------start section courses---------->
    <!--------------------------------start section courses---------->
    <section class="courses">
      <div class="container">
        <h2>{{ $t("Our Courses") }}</h2>
        <hr class="top_hr" />
        <div class="row">
          <div class="col-lg-12">
            <Slick
              v-bind="sliderOptions"
              class="carousel slide"
              ref="slick"
              :slidesToShow="3"
            >
              <div
                class="holder center"
                v-for="categ in categories"
                v-bind:key="categ.key"
              >
                <img src="..//assets/images/troom2.png"  class="background" />
                <div class="div_in_sections">
                  <img :src="$api_url + categ.image" />
                  <p>{{ categ.name }}</p>
                </div>
              </div>
            </Slick>
          </div>
        </div>
        <div class="row_bottom" v-if="this.courses != null">
          <div class="row">
            <div
              class="col-lg-4 col-md-6"
              v-for="(course, index) in courses"
              v-bind:key="course.key"
            >
              <div class="part" v-if="index < 6">
                <router-link
                  :to="{
                    name: 'course_detiles',
                    params: {
                      key_course: course.key,
                      slug_course: course.slug,
                    },
                  }"
                  tag="a"
                >
                  <img :src="$api_url + course.image" class="img_course" />
                  <div class="pragraph">
                    <h4>{{ course.name }}</h4>
                    <p>{{ course.short_description }}</p>
                    <hr />
                    <!-- <ul class="ul_profile">
                      <li>
                        <a
                          href="#"
                          v-for="teacher in course.teachers"
                          v-bind:key="teacher.key"
                        >
                          <img
                            :src="$api_url + teacher.image"
                            class="img-fluid"
                            alt
                          />
                          <span
                            class="edu_title"
                            v-if="course.teachers.length == 1"
                          >
                            {{ teacher.name }}
                          </span>
                        </a>
                      </li>
                      <li>
                        <router-link to="/profile" tag="a">
                          {{ course.teacher }}</router-link
                        >
                      </li>
                    </ul> -->
                    <ul class="ul_clock">
                      <li><i class="fa fa-bar-chart"></i></li>
                      <li>{{ course.level }}</li>
                    </ul>
                  </div>
                  <p
                    class="education_ratting"
                    v-if="
                      course.discountPrice != 0
                    "
                  >
                    ${{ course.discountPrice }}
                    <span class="education_ratting2">
                      ${{ course.price }}
                    </span>
                  </p>

                  <p
                    class="education_ratting"
                    v-if="
                      course.discountPrice == 0
                    "
                  >
                    ${{ course.price }}
                  </p>
                </router-link>
              </div>
            </div>
          </div>
          <div class="clearfix"></div>
        </div>
        <div class="col-lg-12">
          <router-link to="/Courses" tag="li" class="btn View_all">{{
            $t("View All")
          }}</router-link>
        </div>
      </div>
    </section>
    <div class="clearfix"></div>
    <!--------------------------------end section courses---------->
    <!--------------------------------start section counter---------->
    <section class="counter">
      <div class="div_counter">
        <div class="container">
          <div class="row counter_divs">
            <div class="col-md-3">
              <p class="count">{{ analysis.courses }}</p>
              <hr />
              <h4>{{ $t("course") }}</h4>
            </div>
            <div class="col-md-3">
              <p class="count">{{ analysis.classes }}</p>
              <hr />
              <h4>{{ $t("classe") }}</h4>
            </div>
            <div class="col-md-3">
              <p class="count">{{ analysis.strudents }}</p>
              <hr />
              <h4>{{ $t("strudent") }}</h4>
            </div>
            <div class="col-md-3">
              <p class="count">{{ analysis.teachers }}</p>
              <hr />
              <h4>{{ $t("teacher") }}</h4>
            </div>
          </div>
        </div>
      </div>
    </section>
    <div class="clearfix"></div>
    <!--------------------------------end section counter---------->
    <!--------------------------------start section classes---------->
    <section class="classes" v-if="this.classes != null">
      <div class="container">
        <h2>{{ $t("Upcoming Live Classes") }}</h2>
        <hr class="top_hr" />
        <div
          class="col-lg-12 margin_used"
          v-for="(classe, index) in classes"
          v-bind:key="classe.key"
        >
          <router-link
            :to="{
              name: 'classes_detiles',
              params: {
                key_classes: classe.key,
                slug_classe: classe.slug,
                image_classe: classe.image,
              },
            }"
            tag="a"
          >
            <div class="part" v-if="index < 3">
              <div class="part_img">
                <img :src="$api_url + classe.image" />
              </div>
              <div class="pragraph">
                <h4>{{ classe.name }}</h4>
                <p>{{ classe.short_description }}</p>
                <div class="cources_price">
                  <span v-if="classe.discountPrice != null"
                    >${{ classe.discountPrice }}
                  </span>
                  <div
                    class="less_offer"
                    style="color: green"
                    v-if="classe.discountPrice != null"
                  >
                    ${{ classe.price }}
                  </div>
                  <span
                    class="cources_price"
                    v-if="classe.discountPrice == null"
                    >${{ classe.price }}</span
                  >
                </div>

                <p class="p1">{{ classe.category }}</p>
                <!-- <p class="p2">monday &nbsp;&nbsp;<span>01 mar 21</span></p> -->
                <p class="p2">{{ classe.start_time }}</p>
                <p class="p3">
                  <span>{{ classe.level }}</span>
                </p>
                <ul class="info_teatcher">
                  <li>
                    <a
                      href="#"
                      v-for="teacher in classe.teachers"
                      v-bind:key="teacher.key"
                    >
                      <img
                        :src="$api_url + teacher.image"
                        class="img-fluid"
                        alt
                      />
                      <span
                        class="edu_title"
                        v-if="classe.teachers.length == 1"
                      >
                        {{ teacher.name }}
                      </span>
                    </a>
                  </li>
                </ul>

                <ul class="info_lecture">
                  <li>
                    <div class="foot_lecture">
                      <i class="fa fa-fast-forward" aria-hidden="true"></i>
                      {{ $t("See more") }}
                    </div>
                  </li>
                </ul>
                <div class="clearfix"></div>
              </div>
            </div>
          </router-link>
        </div>
        <div class="clearfix"></div>
        <div class="col-lg-12">
          <a class="btn View_all">
            <router-link to="/Classes" tag="li">{{
              $t("View All")
            }}</router-link>
          </a>
        </div>
      </div>
    </section>
    <div class="clearfix"></div>
    <!--------------------------------end section classes---------->
    <!--------------------------------start section testing---------->
    <section class="testing">
      <div class="div_counter">
        <div class="container">
          <div class="row">
            <h2>{{ $t("Test Yor English Skills") }}</h2>
            <div class="test_english">
              <button class="btn" @click="placementTest(examkey)">
                {{ $t(" Take a placement test") }}
              </button>
            </div>
          </div>
        </div>
      </div>
    </section>
    <div class="clearfix"></div>
    <!--------------------------------end section testing---------->
    <!--------------------------------start section instructors---------->
    <section class="instructors">
      <div class="container">
        <h2>{{ $t("Our Instructors") }}</h2>
        <hr class="top_hr" />
        <div class="row">
          <div class="col-md-12">
            <Slick
              class="responsiveSlider"
              v-bind="sliderOptions"
              ref="slick"
              :slidesToShow="4"
            >
              <div
                class="holder center"
                v-for="teacher in teachers"
                v-bind:key="teacher.key"
              >
                <router-link
                    :to="{
                    name: 'Instructorspage',
                    params: {
                        key_instructor: teacher.key,
                    },
                    }"
                    tag="a"
                >
                <div class="instructor_wrap">
                  <div class="instructor_thumb">
                    <a tabindex="0"
                      ><img
                        :src="$api_url + teacher.image"
                        class="img-fluid"
                        alt=""
                    /></a>
                  </div>
                  <div class="instructor_caption">
                    <h4>
                      <!-- <a href="instructor-detail.html" tabindex="0">
                        {{ teacher.name }}</a
                      > -->
                    </h4>
                    <!--- career teacher not do---->
                    <span>{{ teacher.career }}</span>
                  </div>
                </div>
                </router-link>
              </div>
            </Slick>
            <div class="col-lg-12">
              <a class="btn View_all" @click="chack_login" style="color: white">
                {{ $t("join our team") }}
              </a>
            </div>
          </div>
        </div>
        <div class=""></div>
      </div>
    </section>

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

    <div class="clearfix"></div>

    <div
      class="modal fade show"
      id="popup-placement"
      tabindex="-1"
      role="dialog"
      v-if="isModaleplacement == true"
      aria-labelledby="myModalLabel"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <span style="position: absolute; left: 12px">{{
              goToExam.title
            }}</span>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
              @click="isModaleplacement = false"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="frist_page" v-if="frist_page == true">
                <!-- <div class="pass" v-if="resultfinishExam.pass != false">
                  <h4><i class="fa fa-check"></i></h4>
                  <h4>You passed the exam</h4>
                </div>
                <div class="notpass" v-if="resultfinishExam.pass == false">
                  <h4><i class="fa fa-exclamation-triangle"></i></h4>
                  <h4>You didn't pass the exam</h4>
                </div> -->
                <h4>
                  {{ $t("title :") }} <span>{{ resultfinishExam.title }}</span>
                </h4>
                <h3>
                  {{ $t("score :") }}
                  <p>درجاتك</p>
                  <span
                    >{{ resultfinishExam.score }} /
                    {{ resultfinishExam.total }}</span
                  >
                  <p>Your score</p>
                </h3>
                <hr />
                <h4>
                  percentage : <span>{{ resultfinishExam.rate }}%</span>
                </h4>
                <button
                  class="btn btn-success"
                  @click="(isModaleplacement = false), (frist_page = false)"
                >
                  {{ $t("ok") }}
                </button>
              </div>
              <div class="second_page" v-if="second_page == true">
                <div class="row">
                  <div class="timer">
                    <span>Time:</span>
                    <VueCountdown
                      :time="goToExam.time * 60 * 1000"
                      v-slot="{ minutes, seconds }"
                    >
                      {{ minutes }} : {{ seconds }}
                    </VueCountdown>
                  </div>
                  <div
                    class="section_second_page"
                    v-for="(section, index) in goToExam.sections"
                    v-bind:key="section.key"
                    v-show="arryexamform[index]"
                  >
                    <h2>{{ section.title }}</h2>
                    <div
                      class=""
                      v-for="(qui, ind) in section.questions"
                      v-bind:key="qui.key"
                    >
                      <p>{{ qui.question }}</p>

                      <div class="anser_parent">
                        <div
                          class="ans"
                          v-for="ans in qui.answers"
                          v-bind:key="ans.key"
                        >
                          <input
                            v-bind:value="ans.key"
                            type="radio"
                            v-model="sections[index].questions[ind].answer"
                          />

                          <label>{{ ans.answer }}</label>
                        </div>
                      </div>
                      <hr />
                    </div>
                    <div class="" v-if="index != goToExam.sections_count - 1">
                      <button
                        class="btn btn-success"
                        @click="arryexamformindex(index)"
                      >
                        {{$t("Next")}}
                      </button>
                    </div>
                    <div
                      class="col-lg-12"
                      v-if="index == goToExam.sections_count - 1"
                    >
                      <input
                        type="submit"
                        value="check"
                        class="btn btn-success"
                        @click="check3(placementtest.exam_key)"
                      />
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <section class="sign_in" id="SignUp" v-if="showModal2teacher">
      <div class="info">
        <i
          class="fa fa-close close"
          id="close2"
          @click="showModal2teacher = false"
        ></i>
        <div class="imglogo">
          <img src="..//assets/images/logo.png" class="logo" />
        </div>
        <p class="p_2">
          {{
            $t(
              "you want a site to learn the English language better and easier"
            )
          }}
        </p>
        <form @submit="postDataSignup">
          <input
            type="text"
            name=""
            placeholder="Full Name"
            v-model="register.name"
          />
          <input
            type="text"
            name=""
            placeholder="Email"
            v-model="register.email"
          />
          <input
            type="password"
            name=""
            placeholder="password"
            v-model="register.password"
          />
          <input
            type="password"
            name=""
            placeholder="Confirm Password"
            v-model="register.password_confirmation"
          />
          <input
            required
            placeholder="Enter Mobile Number"
            type="tel"
            v-model="register.phone"
          />

          <span v-if="error != null" style="display: block; color: red">
            {{ error }}
          </span>
          <div class="row_div">
            <input
              type="submit"
              name=""
              value="Register"
              @click="register.type = 'teacher'"
            />
          </div>
        </form>
      </div>
    </section>
    <section class="sign_in" id="forget_pass" v-if="showModal4 == true">
      <div class="info">
        <i
          class="fa fa-close close"
          id="close3"
          @click="showModal4 = false"
        ></i>
        <div class="imglogo">
          <img src="..//assets/images/logo.png" class="logo" />
        </div>
        <p class="p_1">{{ $t("code ?") }}</p>
        <p class="p_2">{{ $t("must be 6 number") }}</p>

        <form @submit="verificationfun(user_key, code_number)">
          <input
            type="text"
            name=""
            placeholder="xxx xxx"
            maxlength="6"
            minlength="6"
            required
            v-model="code_number"
          />
          <input type="submit" name="" value="send" />
        </form>
        <a href="#" @click="resendVerifyCode(user_key)">{{ $t("resent") }}</a>
      </div>
    </section>
  </div>
</template>
<script>
import axios from "axios";
import Slick from "slick-vuejs";

import VueCountdown from "@chenfengyuan/vue-countdown";
export default {
  name: "home",
  components: { Slick, VueCountdown },
  data: function () {
    return {
      register: {
        name: null,
        email: null,
        password: null,
        password_confirmation: null,
        phone: null,
        type: null,
      },
      showModal2teacher: false,
      sliders: [],
      features: [],
      courses: [],
      analysis: [],
      categories: [],
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
      classes:[],
      teachers:[],
      sliderOptions: {
        dots: false,
        infinite: true,
        speed: 300,
        slidesToShow: 3,
        slidesToScroll: 3,
        responsive: [
          {
            breakpoint: 768,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 2,
              infinite: true,
              dots: false,
              arrows: true,
            },
          },

          {
            breakpoint: 480,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1,
            },
          },
        ],
      },
      placementtest: null,
      isModaleplacement: false,
      second_page: true,
      arryexamform: [],
      sections: [],
      goToExam: null,
      error: null,
      code_number: null,
      user_key: 0,
      showModal4: false,
      // listsection: "",
      examkey: null,
      global_info: null,
    };
  },
  mounted: function () {
    axios
      .get(this.$api_url + "api/global?lang=" + localStorage.getItem("lang"))
      .then((response) => {
        this.global_info = response.data.data;
        console.log("this.global");
        console.log(this.global_info.logo);
        this.$route.meta.title = this.global_info.website_name;
        console.log(this.$route.meta.title);
      });

    axios
      .get(this.$api_url + "api/slider?lang=" + localStorage.getItem("lang"))
      .then((response) => {
        this.sliders = response.data.data;
        console.log(this.sliders);
      });
    axios
      .get(this.$api_url + "api/features?lang=" + localStorage.getItem("lang"))
      .then((response) => {
        this.features = response.data.data;
      });
    axios
      .get(this.$api_url + "api/analysis?lang=" + localStorage.getItem("lang"))
      .then((response) => {
        this.analysis = response.data.data;
      });
    axios
      .get(this.$api_url + "api/courses?lang=" + localStorage.getItem("lang"))
      .then((response) => {
        this.courses = response.data.data;
      });
    axios
      .get(
        this.$api_url + "api/liveCourses?lang=" + localStorage.getItem("lang")
      )
      .then((response) => {
        this.classes = response.data.data;
        console.log("this.classes");

        console.log(this.classes);
      });
    axios
      .get(
        this.$api_url + "api/categories?lang=" + localStorage.getItem("lang")
      )
      .then((response) => {
        this.categories = response.data.data;
        console.log("categories");
        console.log(this.categories);
      });
    axios
      .get(
        this.$api_url + "api/categories?lang=" + localStorage.getItem("lang")
      )
      .then((response) => {
        this.categories = response.data.data;
      });
    axios
      .get(this.$api_url + "api/teachers?lang=" + localStorage.getItem("lang"))
      .then((response) => {
        this.teachers = response.data.data;
        console.log(this.teachers);
      });
    axios
      .get(this.$api_url + "api/footer?lang=" + localStorage.getItem("lang"))
      .then((response) => {
        this.footer = response.data.data;
        console.log(this.footer);
      });
    if (localStorage.getItem("token") != null) {
      axios
        .get(
          this.$api_url +
            "api/placementTest?lang=" +
            localStorage.getItem("lang") +
            "&token=" +
            localStorage.getItem("token")
        )
        .then((response) => {
          this.placementtest = response.data.data;

          console.log("placementtest");
          console.log(this.placementtest);
          this.examkey = this.placementtest.exam_key;
        });
    }
  },
  methods: {
    placementTest(exam_key) {
      if (exam_key != null) {
        axios
          .get(
            this.$api_url +
              "api/goToExam/" +
              exam_key +
              "?token=" +
              localStorage.getItem("token")
          )
          .then((response) => {
            this.goToExam = response.data.data;

            this.$fire({
              title: "title : " + this.goToExam.title,
              html: "<p>time: " + this.goToExam.time + " minute  </p>",
              // // +"<p>sections:-</p>" +
              // this.listsection,
              type: "question",
              confirmButtonText: "Start",
            }).then(() => {
              this.isModaleplacement = true;
              this.second_page = true;
              this.frist_page = false;
              this.timerequest(this.goToExam.time, exam_key);
            });

            for (var i = 0; i < this.goToExam.sections_count; i++) {
              this.sections.push({
                section: this.goToExam.sections[i].key,
                questions: [],
              });

              // this.listsection =
              //   "<p>" + this.goToExam.sections[i].title + "</p>";

              if (i == 0) {
                this.arryexamform[i] = true;
              } else {
                this.arryexamform[i] = false;
              }
            }
            for (var x = 0; x < this.goToExam.sections_count; x++) {
              for (
                var i2 = 0;
                i2 < this.goToExam.sections[x].questions.length;
                i2++
              ) {
                this.sections[x].questions.push({
                  question: this.goToExam.sections[x].questions[i2].key,
                  answer: null,
                });
              }
            }
          });
      } else {
        this.$fire({
          title: "You Must Login",
          type: "error",
        });
      }
    },

    check3: function (exam_key) {
      axios
        .post(
          this.$api_url +
            "api/finishExam?lang=" +
            localStorage.getItem("lang") +
            "&token=" +
            localStorage.getItem("token"),
          {
            exam_key: exam_key,
            result: JSON.stringify(this.sections),
          }
        )
        .then((response) => {
          this.resultfinishExam = response.data.data;
          this.resultfinishExam.rate = parseInt(this.resultfinishExam.rate);
          console.log("resultfinishExam rate" + this.resultfinishExam.rate);
          this.second_page = false;
          this.frist_page = true;
        });
      this.sections = [];
      this.arryexamform = [];
    },

    timerequest: function (m, exam_key) {
      setTimeout(() => {
        if (this.isModaleplacement == true) {
          this.check3(exam_key);
        }
      }, m * 60 * 1000);
    },

    arryexamformindex: function (i) {
      if (this.arryexamform.length == i) {
        this.second_page = false;
      } else {
        var c = i + 1;
        for (var x = 0; x < this.arryexamform.length; x++) {
          this.arryexamform[x] = false;
          if (x == c) {
            this.arryexamform[x] = true;
          }
        }
        console.log("arryexamform", this.arryexamform);
        this.second_page = false;
        this.second_page = true;
        return 0;
      }
    },
    examsections: function (exam) {
      axios
        .get(
          this.$api_url +
            "api/goToExam/" +
            exam +
            "?lang=" +
            localStorage.getItem("lang") +
            "&token=" +
            localStorage.getItem("token")
        )
        .then((response) => {
          this.goToExam = response.data.data;

          console.log("goToExam");
          console.log(this.goToExam);
          this.exam_key = this.goToExam.key;
          this.$fire({
            title: "title : " + this.goToExam.title,
            text2: "title : " + this.goToExam.title,
            text:
              "time: " +
              this.goToExam.time +
              " minute  " +
              "sections_count: " +
              this.goToExam.sections_count,
            type: "question",
          }).then(() => {
            this.isModalexam = true;
            this.second_page = true;
            this.timerequest(this.goToExam.time);
          });
          console.log(
            "this.goToExam.sections_count",
            this.goToExam.sections_count
          );
          for (var i = 0; i < this.goToExam.sections_count; i++) {
            this.sections.push({
              section: this.goToExam.sections[i].key,
              questions: [],
            });

            if (i == 0) {
              this.arryexamform[i] = true;
            } else {
              this.arryexamform[i] = false;
            }
          }

          console.log("sections", this.sections);
          for (var x = 0; x < this.goToExam.sections_count; x++) {
            for (
              var i2 = 0;
              i2 < this.goToExam.sections[x].questions.length;
              i2++
            ) {
              this.sections[x].questions.push({
                question: this.goToExam.sections[x].questions[i2].key,
                answer: null,
              });
            }
          }
        });
    },

    postDataSignup: function (e) {
      console.log("this.register.type");
      console.log(this.register.type);
      axios
        .post(this.$api_url + "api/register", this.register)
        .then((response) => {
          // localStorage.setItem("token", response.data.data.access_token);
          console.warn(response);
          console.log(response);
          this.showModal2 = false;
          this.signinbutton = false;
          axios
            .post(this.$api_url + "api/login", this.register)
            .then((response) => {
              localStorage.setItem("token", response.data.data.access_token);
              console.warn(response);
              this.profile = response;
              this.showModal = false;
              this.signinbutton = false;
              this.profile_show = true;
              location.reload();
            })
            .catch((error) => {
              if (error.response.data.data != null) {
                this.showModal2teacher = false;
                this.showModal4 = true;
                this.user_key = error.response.data.data.user_key;
              } else {
                this.error = error.response.data.massage;
              }
            });
          // location.reload();
        })
        .catch((error) => {
          this.error = error.response.data.massage;
        });
      e.preventDefault();
    },
    verificationfun: function (user_key, code) {
      console.log("user_key" + user_key);
      console.log("code_number" + code);
      if (user_key != 0) {
        axios
          .post(this.$api_url + "api/verification/" + user_key, {
            code: code,
          })
          .then((response) => {
            console.warn(response);
            console.log(response);
            this.showModal4 = false;
            this.showModal = false;
            this.signinbutton = false;
            this.profile_show = true;
          });
      }
    },
    resendVerifyCode: function (user_key) {
      console.log("user_key" + user_key);
      axios
        .post(this.$api_url + "api/resendVerifyCode/" + user_key)
        .then((response) => {
          console.warn(response);
          console.log(response);
          this.showModal4 = false;
          this.profile_show = true;

          this.$fire({
            title: "has been sent",
            type: "success",
          });
        })
        .catch((error) => {
          console.warn(error);
        });
    },
    chack_login: function () {
      if (localStorage.getItem("token") == null) {
        this.showModal2teacher = true;
      } else {
        this.$fire({
          title: "you are already login",
          type: "error",
        });
      }
    },
  },
};
</script>
