<template>
  <div class="lesson_myclass">
    <div class="courses_page" id="courses_page">
      <div class="cont_div">
        <h1>{{ $t("Show Lesson") }}</h1>
        <hr class="top_hr" />
        <div class="add_course">
          <div class="container">
            <div class="row up">
              <h3>{{ $t("lesson Detiels") }}</h3>
              <hr />
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
                        <table
                          id="table"
                          class="table"
                          style="text-align: center"
                        >
                          <thead style="text-align: center">
                            <th style="text-align: center">#</th>
                            <th style="text-align: center">{{ $t("name") }}</th>
                            <th style="text-align: center">{{ $t("date") }}</th>
                            <th style="text-align: center">{{ $t("day") }}</th>
                            <th style="text-align: center">{{ $t("time") }}</th>
                            <th style="text-align: center">
                              {{ $t("status") }}
                            </th>
                            <th style="text-align: center">
                              {{ $t("Action") }}
                            </th>
                          </thead>

                          <tbody>
                            <tr
                              v-for="(Lesson, index) in allLesson"
                              v-bind:key="Lesson.key"
                              :class="{
                                background_tr: Lesson.date == Date.now(),
                              }"
                            >
                              <td>{{ index + 1 }}</td>
                              <td>{{ Lesson.name }}</td>
                              <td v-html="Lesson.date"></td>
                              <td v-html="Lesson.day"></td>
                              <td v-if="Lesson.time != null">
                                {{ Lesson.time }}
                              </td>
                              <td v-if="Lesson.time == null">--:--:--</td>
                              <td>{{ Lesson.status }}</td>
                              <td>
                                <a
                                  class="btn btn-success btn-xs text-white"
                                  v-if="
                                    Lesson.meeting != false &&
                                    Lesson.status != 'finished'
                                  "
                                  @click="meeting_show(Lesson.key)"
                                >
                                  <i class="fa fa-zoom-in"></i>
                                  {{ $t("attend class") }}
                                </a>
                                <a
                                  class="btn btn-success btn-xs text-white"
                                  v-if="
                                    Lesson.status != 'finished' &&
                                    Lesson.meeting != false
                                  "
                                  @click="finished(Lesson.key)"
                                >
                                  <i class="fa fa-zoom-in"></i>
                                  {{ $t("Commplete") }}
                                </a>
                                <a
                                  class="btn btn-xs text-white"
                                  style="background: brown"
                                  v-if="
                                    Lesson.meeting == false &&
                                    Lesson.date != timestamp &&
                                    Lesson.status != 'finished'
                                  "
                                >
                                  <i class="fa fa-zoom-in"></i>
                                  {{ $t("Create Class") }}
                                </a>
                                <a
                                  class="btn btn-success btn-xs text-white"
                                  v-if="
                                    Lesson.meeting == false &&
                                    Lesson.status != 'finished'
                                  "
                                  @click="create_zoom(Lesson.key)"
                                >
                                  <i class="fa fa-zoom-in"></i>
                                  {{ $t("Create Class") }}
                                </a>
                                <a
                                  class="btn btn-success btn-xs text-white"
                                  v-if="Lesson.status == 'finished'"
                                >
                                  <i class="fa fa-check"></i>
                                </a>
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
    <!-- <div
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
            <h5 class="modal-title" id="BlogCategory">Add Chapter</h5>
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
                <label for="name"> Name</label>
                <input type="text" name="name" class="form-control" />
              </div>
              <div class="form-group">
                <label for="description"> Description</label>
                <textarea name="description" class="form-control"></textarea>
              </div>
              <button type="submit" class="btn btn-primary float-right">
                Save
              </button>
            </form>
          </div>
        </div>
      </div>
    </div> -->

  </div>
</template>

<script>
import axios from "axios";
export default {
  name: "lesson_myclass",
  data: function () {
    return {
      allLesson: null,
      meetingshow: null,
      create_meeting_info: null,
      zoomCredential: null,
    };
  },
  created() {
    this.key_classe = this.$route.params.key_classe;
    this.name_classe = this.$route.params.name_classe;
    const today = new Date();
     let date;
    if (today.getMonth() < 10) {
      if (today.getDate() < 10) {
        date =
          today.getFullYear() + "-0" + (today.getMonth() + 1) + today.getDate();
      } else {
        date =
          today.getFullYear() +
          "-0" +
          (today.getMonth() + 1) +
          "-0" +
          today.getDate();
      }
    }
    if (today.getMonth() > 10) {
      if (today.getDate() > 10) {
        date = today.getFullYear() + (today.getMonth() + 1) + today.getDate();
      } else {
        date =
          today.getFullYear() +
          (today.getMonth() + 1) +
          "-0" +
          today.getDate();
      }
    }
    const dateTime = date;
    this.timestamp = dateTime;
    console.log(this.timestamp);
  },
  mounted: function () {
    console.log(this.key_classe);

    if (this.key_classe == null) {
      this.$router.back();
    }
    axios
      .get(
        this.$api_url +
          "api/classLesson/" +
          this.key_classe +
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
  methods: {
    create_zoom: function (lesson_key) {
      console.log("lesson_key" + lesson_key);
      axios
        .post(
          this.$api_url +
            "api/startMeeting?lang=" +
            localStorage.getItem("lang") +
            "&token=" +
            localStorage.getItem("token"),
          {
            lesson_key: lesson_key,
          }
        )
        .then((response) => {
          console.warn(response);
          this.create_meeting_info = response.data.data;
          console.log(this.create_meeting_info);
          this.push_func(
            this.create_meeting_info.nickname,
            this.create_meeting_info.meetingID,
            this.create_meeting_info.password,
            this.create_meeting_info.role
          );
          this.$fire({
            title: "Successed Create Zoom",
            type: "success",
          });
        })
        .catch((error) => {
          this.error = error;
        });
    },
    meeting_show: function (lesson_key) {
      axios
        .get(
          this.$api_url +
            "api/showMeeting/" +
            lesson_key +
            "?lang=" +
            localStorage.getItem("lang") +
            "&token=" +
            localStorage.getItem("token")
        )
        .then((response) => {
          this.meetingshow = response.data.data;
          console.log("my meeting_show");
          console.log(this.meetingshow);
          this.push_func(
            this.meetingshow.nickname,
            this.meetingshow.meetingID,
            this.meetingshow.password,
            this.meetingshow.role
          );
        });
    },

    push_func: function (nickname, meetingId, password, role) {
      axios
        .get(
          this.$api_url +
            "api/zoomCredential?lang=" +
            localStorage.getItem("lang") +
            "&token=" +
            localStorage.getItem("token")
        )
        .then((response) => {
          this.zoomCredential = response.data.data;
          this.$router.push({
            name: "Meeting",
            params: {
              api_key: this.zoomCredential.api_key,
              api_secret: this.zoomCredential.api_secret,
              nickname: nickname,
              meetingId: meetingId,
              password: password,
              role: role,
            },
            props: {
              default: true,
            },
          });
        });
    },

    finished: function (lesson_key) {
      axios
        .get(
          this.$api_url +
            "api/finishMeeting/" +
            lesson_key +
            "?lang=" +
            localStorage.getItem("lang") +
            "&token=" +
            localStorage.getItem("token")
        )
        .then((response) => {
          console.log(response.data.data);
          axios
            .get(
              this.$api_url +
                "api/classLesson/" +
                this.key_classe +
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
        });
    },
  },
};
</script>
