x<template>
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


  </div>
</template>

<script>
import axios from "axios";
export default {
  name: "lesson_mycourse_show",
  data: function () {
    return {
      allLesson: null,
    };
  },
  created() {
    this.key_chapter = this.$route.params.key_chapter;
  },
  mounted: function () {

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
    
  },
};
</script>
