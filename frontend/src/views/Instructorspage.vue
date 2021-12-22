<template>
  <div class="Instructorspage">
    <div
      class="courses_page classes_page Instructorspage_div"
      id="courses_page"
    >
      <div class="clearfix"></div>
      <div class="row">
        <div class="container">
          <div class="col-lg-9">
            <section class="classes_page">
              <div class="cont_div">
                <h4 class="h4">{{ $t("My Courses") }}</h4>

                <div class="row row_bottom">
                  <div
                    class="col-lg-6 col-md-6"
                    v-for="item in pageOfItems2"
                    :key="item.id"
                  >
                    <div class="part">
                      <router-link
                        :to="{
                          name: 'course_detiles',
                          params: {
                            key_course: item.key,
                            slug_course: item.slug,
                            image_course: item.image,
                          },
                        }"
                        tag="a"
                      >
                        <img :src="$api_url + item.image" class="img_course" />
                        <div class="pragraph">
                          <h4>{{ item.name }}</h4>
                          <p>{{ item.short_description }}</p>
                          <hr />
                          <!-- <ul class="ul_profile">
                      <li>
                        <a
                          href="#"
                          v-for="teacher in item.teachers"
                          v-bind:key="teacher.key"
                        >
                          <img
                            :src="$api_url + teacher.image"
                            class="img-fluid"
                            alt
                          />
                          <span
                            class="edu_title"
                            v-if="item.teachers.length == 1"
                          >
                            {{ teacher.name }}
                          </span>
                        </a>
                      </li>
                      <li>
                        <router-link to="/profile" tag="a">
                          {{ item.teacher }}</router-link
                        >
                      </li>
                    </ul> -->
                          <ul class="ul_clock">
                            <li><i class="fa fa-bar-chart"></i></li>
                            <li>{{ item.level }}</li>
                          </ul>
                        </div>
                        <p
                          class="education_ratting"
                          v-if="item.discountPrice != 0"
                        >
                          {{currency}} {{ item.discountPrice }}
                          <span class="education_ratting2">
                            {{currency}} {{ item.price }}
                          </span>
                        </p>

                        <p
                          class="education_ratting"
                          v-if="item.discountPrice == 0"
                        >
                          {{currency}} {{ item.price }}
                        </p>
                      </router-link>
                    </div>
                  </div>

                  <div class="pt-10" style="margin-top: 20px">
                    <jw-pagination
                      :items="Instructor_info.courses"
                      :pageSize="2"
                      @changePage="onChangePage2"
                    ></jw-pagination>
                  </div>
                  <div style="clear: both"></div>
                </div>
              </div>
              <div style="clear: both"></div>
            </section>
            <div class="clearfix"></div>

            <section class="classes classes_page">
              <div class="cont_div">
                <h4 class="h4">{{ $t("My Live Courses") }}</h4>
                <div class="row parts_sections">
                  <div
                    class="col-lg-6 margin_used"
                    v-for="item in pageOfItems"
                    :key="item.id"
                  >
                    <router-link
                      :to="{
                        name: 'classes_detiles',
                        params: {
                          key_classes: item.key,
                          slug_classe: item.slug,
                          image_classe: item.image,
                        },
                      }"
                      tag="a"
                    >
                      <div class="part">
                        <div class="part_img">
                          <img :src="$api_url + item.image" />
                        </div>
                        <div class="pragraph">
                          <h4>{{ item.name }}</h4>
                          <p>{{ item.short_description }}</p>

                          <div class="cources_price">
                            <span v-if="item.discountPrice != null"
                              >{{currency}} {{ item.discountPrice }}
                            </span>
                            <div
                              class="less_offer"
                              style="color: green"
                              v-if="item.discountPrice != null"
                            >
                              {{currency}} {{ item.price }}
                            </div>
                            <span
                              class="cources_price"
                              v-if="item.discountPrice == null"
                              >{{currency}} {{ item.price }}</span
                            >
                          </div>

                          <p class="p1">{{ item.category }}</p>
                          <!-- <p class="p2">monday &nbsp;&nbsp;<span>01 mar 21</span></p> -->
                          <p class="p2">{{ item.start_time }}</p>
                          <!-- <p class="p3"><span>03:00 PM - 04:00 PM</span></p> -->
                          <p class="p3">
                            <span>{{ item.level }}</span>
                          </p>
                          <ul class="info_teatcher">
                            <li>
                              <a
                                href="#"
                                v-for="teacher in item.teachers"
                                v-bind:key="teacher.key"
                              >
                                <img
                                  :src="$api_url + teacher.image"
                                  class="img-fluid"
                                  alt
                                />
                                <span
                                  class="edu_title"
                                  v-if="item.teachers.length == 1"
                                >
                                  {{ teacher.name }}
                                </span>
                              </a>
                            </li>
                          </ul>

                          <div class="clearfix"></div>
                        </div>
                      </div>
                    </router-link>
                  </div>
                  <div class="pt-3">
                    <jw-pagination
                      :items="Instructor_info.liveCourses"
                      :pageSize="2"
                      @changePage="onChangePage"
                    ></jw-pagination>
                  </div>
                </div>
              </div>
            </section>
          </div>
          <div class="col-lg-3">
            <div class="cont_div">
              <img
                class="pro_img img-fluid w100"
                :src="$api_url + Instructor_info.image"
                alt="7.jpg"
              />
              <h5>
                {{ Instructor_info.name }}
              </h5>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--------------------------------end classes---------->
    <!--------------------------------start nav left---------->

    <!--------------------------------end nav left---------->
  </div>
</template>
<script>
import axios from "axios";
export default {
  name: "Instructorspage",
  data: function () {
    return {
      currency: this.$currency,
      Instructor_info: null,
      pageOfItems: [],
      pageOfItems2: [],
    };
  },
  created() {
    this.key_instructor = this.$route.params.key_instructor;
  },
  mounted: function () {
    axios
      .get(
        this.$api_url +
          "api/instructor/" +
          this.key_instructor +
          "?lang=" +
          localStorage.getItem("lang")
      )
      .then((response) => {
        this.Instructor_info = response.data.data;
        console.log("this.Instructor_info");
        console.log(this.Instructor_info);
      });
  },
  methods: {
    onChangePage(pageOfItems) {
      // update page of items
      this.pageOfItems = pageOfItems;
    },
    onChangePage2(pageOfItems2) {
      // update page of items
      this.pageOfItems2 = pageOfItems2;
    },
  },
};
</script>
