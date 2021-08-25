<template>
  <div class="edit_course">
    <div class="courses_page" id="courses_page">
      <div class="cont_div">
        <h1>Edit <span>Course</span></h1>
        <hr class="top_hr" />
        <div class="add_course">
          <div class="container">
            <div class="row up">
              <h3>{{ slug_mycourse }}</h3>
              <hr />
              <div class="category_divs">
                <div class="row">
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="category">Select Main Category*</label>
                      <select
                        name="category"
                        id="category"
                        class="custom-select form-control auto-save"
                        required
                        v-model="updateCourse.category"
                        value="updateCourse.category"
                      >
                        <option value="">select</option>
                        <option
                          v-for="main_categorie in main_categories"
                          v-bind:key="main_categorie.key"
                          :value="main_categorie.key"
                          class="custom-select form-control auto-save"
                          @click="subCategory_fun(main_categorie.key)"
                        >
                          {{ main_categorie.name }}
                        </option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-3 mb-2">
                    <div class="form-group">
                      <label for="subCategory">Sub Category*</label>
                      <select
                        name="subCategory"
                        id="subCategory"
                        class="custom-select form-control auto-save"
                        required
                        v-model="updateCourse.subCategory"
                        value="updateCourse.subCategory"
                      >
                        <option value="">select</option>
                        <option
                          :value="subCategoryone.key"
                          v-for="subCategoryone in subCategory"
                          v-bind:key="subCategoryone.key"
                          @click="Category_fun(subCategoryone.key)"
                        >
                          {{ subCategoryone.name }}
                        </option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-3 mb-2">
                    <div class="form-group">
                      <label for="Category">Category*</label>
                      <select
                        name="category_id"
                        id="category_id"
                        class="custom-select form-control auto-save"
                        required
                        v-model="updateCourse.category_id"
                        value="dataCourse.category_id"
                      >
                        <option
                          v-for="Category in Categories"
                          v-bind:key="Category.key"
                          :value="Category.key"
                        >
                          {{ Category.name }}
                        </option>
                      </select>
                    </div>
                  </div>
                  <!-- <div class="col-md-3 mb-2">
                      <label
                        >Add Category<span class="d-inline-block d-sm-none"
                          >Category</span
                        ></label
                      >
                      <button
                        type="button"
                        class="btn btn-block btn-outline-primary add_class"
                        data-toggle="modal"
                        data-target="#productCategory"
                      >
                        <i class="fa fa-plus"></i>
                      </button>
                    </div> -->
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="name">Name*</label>
                      <input
                        type="text"
                        name="name"
                        class="form-control"
                        id="name"
                        placeholder="Enter name"
                        required
                        v-model="updateCourse.name"
                      />
                    </div>
                  </div>
                </div>
                <div class="row">
                  <!-- <div class="col-md-3 mb-2">
                      <div class="form-group">
                        <label for="">Course Type*</label>
                        <select
                          name="courseType"
                          class="custom-select form-control auto-save"
                          required
                          v-model="updateCourse.courseType"
                        >
                          <option value="">Select Type</option>
                          <option value="live">Live</option>
                          <option value="recorded">Recorded</option>
                        </select>
                      </div>
                    </div> -->
                  <div class="col-md-3 mb-2">
                    <div class="form-group">
                      <label for="">Level Course*</label>
                      <select
                        name="level"
                        id="level"
                        class="custom-select form-control auto-save"
                        required
                        v-model="updateCourse.level"
                        data-parsley-group="order"
                        data-parsley-required
                        value="updateCourse.level"
                      >
                        <option
                          v-for="level in levels"
                          v-bind:key="level.key"
                          :value="level.key"
                        >
                          {{ level.name }}
                        </option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="price">Price*</label>
                      <input
                        type="text"
                        name="price"
                        class="form-control"
                        id="price"
                        placeholder="Enter price"
                        v-model="updateCourse.price"
                      />
                    </div>
                  </div>

                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="discount">Discount Price</label>
                      <input
                        type="text"
                        name="discount"
                        class="form-control"
                        id="discount"
                        placeholder="Enter discount"
                        v-model="updateCourse.discount"
                      />
                    </div>
                  </div>
                </div>
                <!-- <div class="row">
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="start_date">Discount Start Date</label>
                      <input
                        type="date"
                        name="start_date"
                        class="form-control"
                        id="start"
                        placeholder="Enter start_date"
                        v-model="createCourse.start_date"
                        :value="dataCourse.discountPrice"
                      />
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="end_date">Discount End Date</label>
                      <input
                        type="date"
                        name="end_date"
                        class="form-control"
                        id="end_date"
                        placeholder="Enter end_date"
                        v-model="createCourse.end_date"
                      />
                    </div>
                  </div>
                </div> -->

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="sh_desc">Short Description</label>
                      <textarea
                        rows="6"
                        cols="60"
                        maxlength="60"
                        class="form-control"
                        name="sh_desc"
                        required
                        v-model="updateCourse.sh_desc"
                        value="updateCourse.sh_desc"
                        style="height: 130px"
                      ></textarea>
                    </div>
                  </div>

                  <div class="col-md-4 col-lg-6">
                    <div class="form-group">
                      <label for="desc">desc</label>
                      <textarea
                        class="form-control summernote summernote"
                        name="desc"
                        id="desc"
                        rows="6"
                        cols="60"
                        maxlength="60"
                        v-model="updateCourse.desc"
                        value="updateCourse.desc"
                        style="height: 130px"
                      >
                      </textarea>
                    </div>
                  </div>
                </div>
                <!-- <div class="row">
                  <div class="col-md-4 col-lg-6">
                    <div class="form-group">
                      <label for="desc"
                        >What will students learn in your course?</label
                      >
                      <textarea
                        class="form-control summernote"
                        id="summernote"
                        v-model="createCourse.contact"
                        name="contact"
                        rows="6"
                        cols="60"
                        maxlength="60"
                        :value="dataCourse.description"
                      ></textarea>
                    </div>
                  </div>
                  <div class="col-md-4 col-lg-6">
                    <div class="form-group">
                      <label for="desc"
                        >Are there any course requirements or
                        prerequisites?</label
                      >
                      <textarea
                        class="form-control summernote"
                        id="summernote"
                        value=""
                        name="prerequisite"
                        rows="6"
                        cols="60"
                        maxlength="60"
                        v-model="createCourse.prerequisite"
                      ></textarea>
                    </div>
                  </div>
                </div> -->
                <div class="row">
                  <div class="col-6">
                    <div class="form-group">
                      <label for="img">Upload Image</label>
                      <input
                        type="file"
                        required
                        @change="fileSelected"
                        class="file_upload"
                      />
                    </div>
                    <div class="form-group" id="imgPreview">
                      <img v-if="image" :src="image" class="img-fluid" />
                      <img
                        v-if="!image"
                        :src="$api_url + dataCourse.image"
                        class="img-fluid"
                      />
                    </div>
                  </div>
                  <!-- <div class="col-6">
                    <label for="my-select">Select Placement Test</label>
                    <select
                      class="form-control mt-2"
                      name="placementTest"
                      v-model="createCourse.placementTest"
                    >
                      <option>none</option>
                      <option value="1">Toefl Plecement Test</option>
                    </select>
                  </div> -->
                </div>

                <div class="card-action">
                  <input
                    type="submit"
                    class="btn btn-success float-right"
                    value="Create Course"
                    @click="inform_course_create"
                  />
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
export default {
  name: "edit_course",
  data: function () {
    return {
      image: "",
      updateCourse: {
        category: null,
        subCategory: null,
        category_id: null,
        discount: null,
        start_date: null,
        end_date: null,
        name: null,
        sh_desc: null,
        desc: null,
        courseType: "Recorded",
        level: null,
        prerequisite: null,
        contact: null,
        placementTest: null,
        img: null,
        price: null,
      },
      levels: null,
      main_categories: null,
      subCategory: null,
      Categories: null,
      dataCourse: null,
    };
  },
  created() {
    this.key_mycourse = this.$route.params.key_mycourse;
    this.slug_mycourse = this.$route.params.slug_mycourse;
    this.image_mycourse = this.$route.params.image_mycourse;
  },
  mounted: function () {
    if (this.key_mycourse == undefined) {
      this.$router.back();
    }
    if (localStorage.getItem("token") != null) {
      axios
        .get(
          this.$api_url +
            "api/dataCourse/" +
            this.key_mycourse +
            "?token=" +
            localStorage.getItem("token")
        )
        .then((response) => {
          this.dataCourse = response.data.data;
          console.log("my dataCourse");
          console.log(this.dataCourse);
          this.updateCourse.price = this.dataCourse.price;
          this.updateCourse.discount = this.dataCourse.discountPrice;
          this.updateCourse.sh_desc = this.dataCourse.short_description;
          this.updateCourse.desc = this.dataCourse.description;
          this.updateCourse.name = this.dataCourse.name;
          this.updateCourse.category = this.dataCourse.mainCategory;
          this.updateCourse.subCategory = this.dataCourse.subCategory;
          this.updateCourse.category_id = this.dataCourse.category;
          this.updateCourse.level = this.dataCourse.level;
        });
      /***mainCategory***** */
      axios
        .get(
          this.$api_url +
            "api/mainCategory" +
            "?token=" +
            localStorage.getItem("token")
        )
        .then((response) => {
          this.main_categories = response.data.data;
          console.log("my main_categories");
          console.log(this.main_categories);
        });
      /*****levels*****/
      axios
        .get(
          this.$api_url +
            "api/levels" +
            "?token=" +
            localStorage.getItem("token")
        )
        .then((response) => {
          this.levels = response.data.data;
          console.log("my levels");
          console.log(this.levels);
        });
    }
  },
  methods: {
    fileSelected: function (event) {
      const file = event.target.files.item(0);
      const reader = new FileReader();
      reader.addEventListener("load", this.imageLoaded);
      reader.readAsDataURL(file);
    },
    imageLoaded: function (event) {
      this.image = event.target.result;
      this.updateCourse.img = this.image;
    },
    upload() {
      // axios upload base64
      // axios.post('/upload',{image:this.image});

      const form = new FormData();
      form.append(this.file, this.file.name);
    },
    inform_course_create: function () {
      console.log("this.updateCourse");
      console.log(this.updateCourse);

      axios
        .post(
          this.$api_url +
            "api/updateCourse/" +
            this.key_mycourse +
            "?token=" +
            localStorage.getItem("token"),
          this.updateCourse
        )
        .then((response) => {
          console.warn(response);
          console.log(response);
        });
    },
    subCategory_fun: function (categories_key) {
      axios
        .get(
          this.$api_url +
            "api/subCategory/" +
            categories_key +
            "?token=" +
            localStorage.getItem("token")
        )
        .then((response) => {
          this.subCategory = response.data.data;
          console.log("my subCategory");
          console.log(this.subCategory);
        });
    },
    Category_fun: function (categories_key) {
      axios
        .get(
          this.$api_url +
            "api/subCategory/" +
            categories_key +
            "?token=" +
            localStorage.getItem("token")
        )
        .then((response) => {
          this.Categories = response.data.data;
          console.log("my Categories");
          console.log(this.Categories);
        });
    },
  },
};
</script>
