<template>
  <div class="show_lesson">
    <div class="courses_page" id="courses_page">
      <div class="cont_div">
        <h1>{{ $t("Show Lesson") }}</h1>
        <hr class="top_hr" />
        <div class="add_course">
          <div class="container">
            <div class="row up">
              <div class="category_divs">
                <div class="col-lg-2"></div>
                <div class="col-lg-8">
                  <div>
                    <iframe
                      id="video"
                      :src="$api_url + 'uploads/' + video_lesson"
                    ></iframe>
                  </div>
                  <div>
                    <hr />
                    <h3>{{ name_lesson }}</h3>
                    <p v-html="summary_lesson"></p>
                  </div>
                </div>
                <div class="col-lg-2"></div>
              </div>
            </div>
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
  name: "show_lesson",
  data: function () {
    return {
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
    this.key_lesson = this.$route.params.key_lesson;
    this.video_lesson = this.$route.params.video_lesson;
    this.summary_lesson = this.$route.params.summary_lesson;
    this.name_lesson = this.$route.params.name_lesson;
  },
  mounted: function () {
    axios
      .get(this.$api_url + "api/global?lang=" + localStorage.getItem("lang"))
      .then((response) => {
        this.global_info = response.data.data;
      });
    if (this.key_lesson == null) {
      this.$router.back();
    }

    axios
      .get(this.$api_url + "api/footer?lang=" + localStorage.getItem("lang"))
      .then((response) => {
        this.footer = response.data.data;
        console.log(this.footer);
      });
  },
};
</script>
