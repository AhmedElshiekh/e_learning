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


  </div>
</template>

<script>
// import axios from "axios";
export default {
  name: "show_lesson",
  data: function () {
    return {};
  },
  created() {
    this.key_lesson = this.$route.params.key_lesson;
    this.video_lesson = this.$route.params.video_lesson;
    this.summary_lesson = this.$route.params.summary_lesson;
    this.name_lesson = this.$route.params.name_lesson;
  },
  mounted: function () {

    if (this.key_lesson == null) {
      this.$router.back();
    }
  },
};
</script>
