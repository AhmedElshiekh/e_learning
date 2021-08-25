<template>
  <div class="lesson_mycourse_show">
    <div class="courses_page" id="courses_page">
      <div class="cont_div">
        <h1>{{ $t("Show Lesson") }}</h1>
        <hr class="top_hr" />
        <div class="add_course">
          <div class="container">
            <div class="row up">
              <div class="category_divs">
                <div class="col-lg-12">
                  <!-- <router-link
                    to="/add_lesson"
                    tag="a"
                    class="btn btn-primary float-right"
                    >Add Chapter</router-link
                  > -->
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-10">
                      <div class="table-responsive table-hover table-sales">
                        <table id="table" class="table">
                          <thead>
                            <th>#</th>
                            <th>{{ $t("Topic") }}</th>
                            <th>{{ $t("Objective") }}</th>
                            <th>{{ $t("Action") }}</th>
                          </thead>

                          <tbody>
                            <tr>
                              <td>{{ allLesson.key }}</td>
                              <td>{{ allLesson.name }}</td>
                              <td v-html="allLesson.objective"></td>
                              <td>
                                <router-link
                                  :to="{
                                    name: 'show_lesson',
                                    params: {
                                      key_lesson: allLesson.key,
                                      video_lesson: allLesson.video,
                                      summary_lesson: allLesson.summary,
                                      name_lesson: allLesson.name,
                                    },
                                  }"
                                  class="btn btn-success btn-xs text-white"
                                >
                                  <i class="fa fa-eye"></i> {{ $t("Show") }}
                                </router-link>

                                <!-- <router-link
                                  to="/edit_lesson"
                                  class="btn btn-info btn-xs text-white"
                                >
                                  Edit
                                </router-link>

                                <a class="btn btn-danger btn-xs text-white">
                                  <i class="fa fa-trash"></i>
                                </a> -->
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                    <div class="col-md-1"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div
      class="modal fade"
      id="productCategory"
      tabindex="-1"
      role="dialog"
      aria-labelledby="productCategory"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="BlogCategory">
              {{ $t("Add Chapter") }}
            </h5>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form method="POST" enctype="multipart/form-data" file="true">
              <input
                type="hidden"
                name="_token"
                value="uS7z9QfbfE8VDYR8KXGXz01yoAfva6iUPkxlbqcz"
              />
              <input type="hidden" name="course_id" value="8" />
              <div class="form-group">
                <label for="name"> {{ $t("Name") }}</label>
                <input type="text" name="name" class="form-control" />
              </div>
              <div class="form-group">
                <label for="description"> {{ $t("Description") }}</label>
                <textarea name="description" class="form-control"></textarea>
              </div>
              <button type="submit" class="btn btn-primary float-right">
                {{ $t("Save") }}
              </button>
            </form>
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
export default {
  name: "lesson_mycourse_show",
  data: function () {
    return {
      allLesson: null,
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
      global_info: null,
    };
  },
  created() {
    this.key_chapter = this.$route.params.key_chapter;
  },
  mounted: function () {
    console.log(this.key_chapter);
    axios
      .get(this.$api_url + "api/global?lang=" + localStorage.getItem("lang"))
      .then((response) => {
        this.global_info = response.data.data;
      });
    if (this.key_chapter == null) {
      this.$router.back();
    }
    axios
      .get(
        this.$api_url +
          "api/dataLesson/" +
          this.key_chapter +
          "?lang=" +
          localStorage.getItem("lang") +
          "&token=" +
          localStorage.getItem("token")
      )
      .then((response) => {
        this.allLesson = response.data.data;
        console.log("my allLesson");
        console.log(this.allLesson);
      });
    axios
      .get(this.$api_url + "api/footer?lang=" + localStorage.getItem("lang"))
      .then((response) => {
        this.footer = response.data.data;
        console.log(this.footer);
      });
  },
};
</script>
