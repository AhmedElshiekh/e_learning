<template>
  <div class="showCourse">
    <div class="show_course">
      <div class="courses_page" id="courses_page">
        <div class="cont_div">
          <h1>{{ $t("Show Chapters") }}</h1>
          <hr class="top_hr" />
          <div class="add_course">
            <div class="container">
              <div class="row up">
                <h3>{{ slug_mycourse }}</h3>
                <hr />
                <div class="category_divs">
                  <div class="col-lg-4">
                    <img :src="$api_url + image_mycourse" />
                  </div>
                  <div class="col-lg-8">
                    <div class="card-head-row card-tools-still-right">
                      <h4 class="card-title">{{ $t("Chapters/Unit") }}</h4>
                    </div>
                    <!-- <a
                    type=""
                    style="color: #fff"
                    class="btn btn-primary float-right"
                    data-toggle="modal"
                    data-target="#productCategory"
                    >Add Chapter</a
                  > -->
                  </div>
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="table-responsive table-hover table-sales">
                          <table id="table" class="table">
                            <thead>
                              <th>#</th>
                              <th>{{ $t("Name") }}</th>
                              <th>{{ $t("Description") }}</th>
                              <th>{{ $t("Action") }}</th>
                            </thead>

                            <tbody>
                              <tr
                                v-for="(Chapter, index) in allChapter"
                                v-bind:key="Chapter.key"
                              >
                                <td>{{ index + 1 }}</td>
                                <td>{{ Chapter.name }}</td>
                                <td>{{ Chapter.description }}</td>
                                <td>
                                  <router-link
                                    :to="{
                                      name: 'lesson_mycourse_show',
                                      params: {
                                        key_chapter: Chapter.key,
                                      },
                                    }"
                                    class="btn btn-success btn-xs text-white"
                                    tag="a"
                                    ><i class="fa fa-eye"></i>
                                    {{ $t("lessons") }}</router-link
                                  >

                                  <!-- <a
                                  href="#"
                                  class="btn btn-info btn-xs text-white"
                                  data-toggle="modal"
                                  data-target="#updateChapter"
                                >
                                  <i class="fa fa-edit"></i>Edit
                                </a> -->
                                </td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
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
                <label for="description">{{ $t("Description") }} </label>
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

    <div
      class="modal fade"
      id="updateChapter"
      tabindex="-1"
      role="dialog"
      aria-labelledby="updateChapter"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="updateBlogCategory">
              {{ $t("Edit Chapter") }}
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
            <form
              method="POST"
              action=""
              enctype="multipart/form-data"
              file="true"
            >
              <input
                type="hidden"
                name="_token"
                value="uS7z9QfbfE8VDYR8KXGXz01yoAfva6iUPkxlbqcz"
              />
              <input type="hidden" name="_method" value="PUT" />
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
  name: "showCourse",
  data: function () {
    return {
      image: "",
      allChapter: null,
    };
  },
  created() {
    this.key_mycourse = this.$route.params.key_mycourse;
    this.slug_mycourse = this.$route.params.slug_mycourse;
    this.image_mycourse = this.$route.params.image_mycourse;
  },
  mounted: function () {
    if (this.key_mycourse == null || localStorage.getItem("token") == null) {
      this.$router.back();
    }

    axios
      .get(
        this.$api_url +
          "api/allChapter/" +
          this.key_mycourse +
          "?lang=" +
          localStorage.getItem("lang") +
          "&token=" +
          localStorage.getItem("token")
      )
      .then((response) => {
        this.allChapter = response.data.data;
        // console.log("my allChapter");
        // console.log(this.allChapter);
      });
  },
};
</script>
