<template>
  <div class="Courses">
    <div>
      <div class="courses_page" id="courses_page">
        <div class="cont_div">
          <h1>{{ $t("All Courses") }}</h1>
          <hr class="top_hr" />
          <div class="row_top col-lg-12">
            <p>
              {{ $t("We found") }} {{ courses.length }}
              {{ $t("courses for you") }}
            </p>
            <ul class="ul_filtter">
              <li>
                <a class="btn a_button" v-on:click="openNav()"
                  >{{ $t("Show Filter") }}
                  <i class="fa fa-arrow-circle-right"></i
                ></a>
              </li>
              <li>
                <div class="dropdown">
                  <button
                    class="btn btn-secondary dropdown-toggle"
                    type="button"
                    id="dropdownMenuButton"
                    data-toggle="dropdown"
                    aria-haspopup="true"
                    aria-expanded="false"
                  >
                    Dropdown button
                  </button>
                  <div
                    class="dropdown-menu"
                    aria-labelledby="dropdownMenuButton"
                  >
                    <a class="dropdown-item" href="#">Popular Courses</a>
                    <a class="dropdown-item" href="#">Recent Courses</a>
                    <a class="dropdown-item" href="#">Featured Courses</a>
                  </div>
                </div>
              </li>
            </ul>
          </div>
          <div style="clear: both"></div>
          <div class="row row_bottom">
            <div
              class="col-lg-4 col-md-6"
              v-for="item in pageOfItems"
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
                  <p class="education_ratting" v-if="item.discountPrice != 0">
                    AED {{ item.discountPrice }}
                    <span class="education_ratting2"> AED {{ item.price }} </span>
                  </p>

                  <p class="education_ratting" v-if="item.discountPrice == 0">
                    AED {{ item.price }}
                  </p>
                </router-link>
              </div>
            </div>

            <div class="pb-0 pt-3">
              <jw-pagination
                :items="courses"
                :pageSize="6"
                @changePage="onChangePage"
              ></jw-pagination>
            </div>
            <div style="clear: both"></div>
          </div>
          <div style="clear: both"></div>
          <div class="col-lg-12">
            <nav aria-label="Page navigation example">
              <ul class="pagination">
                <li class="page-item">
                  <a class="page-link" href="#" aria-label="Previous">
                    <span aria-hidden="true" style="color: #ff9800"
                      >&laquo;</span
                    >
                    <span class="sr-only" style="color: #ff9800">Previous</span>
                  </a>
                </li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link" href="#">4</a></li>
                <li class="page-item"><a class="page-link" href="#">5</a></li>
                <li class="page-item"><a class="page-link" href="#">6</a></li>
                <li class="page-item"><a class="page-link" href="#">7</a></li>
                <li class="page-item">
                  <a class="page-link" href="#" aria-label="Next">
                    <span aria-hidden="true" style="color: #ff9800"
                      >&raquo;</span
                    >
                    <span class="sr-only" style="color: #ff9800">Next</span>
                  </a>
                </li>
              </ul>
            </nav>
          </div>
        </div>
      </div>
    </div>

    <!--------------------------------end courses_page---------->
    <!--------------------------------start nav left---------->
    <div class="fillter_nav">
      <div id="mySidenav" class="sidenav" style="300px">
        <a href="javascript:void(0)" class="closebtn" v-on:click="closeNav()"
          >&times;</a
        >
        <form class="form_group">
          <input
            type="text"
            :placeholder="$t('search')"
            name="search"
            class="search"
            v-model="search_name"
          />
          <button class="search_button" @click="gotosearch">
            <i class="fa fa-search"></i>
          </button>
          <h4>{{ $t("Categories") }}</h4>
          <ul>
            <li
              v-for="(category, index1) in categoriesFilter"
              :key="category.id"
            >
              <label
                data-toggle="collapse"
                :data-target="'#demo' + index1"
                class="checkbox-custom-label"
              >
                <i class="fa fa-caret-down"></i> {{ category.name }}
              </label>
              <ul class="subcategory">
                <li
                  v-for="subCategoryone in category.subCategory"
                  :key="subCategoryone.id"
                  class="collapse"
                  :id="'demo' + index1"
                  data-toggle=""
                >
                  <i class="fa fa-caret-down"></i> {{ subCategoryone.name }}
                  <ul class="subsubcategory" id="subdemo1">
                    <li
                      v-for="endCategoryone in subCategoryone.endCategory"
                      :key="endCategoryone.id"
                    >
                      <input
                        id="a-5"
                        class="checkbox-custom"
                        type="checkbox"
                        @click="gotofillter(endCategoryone.key)"
                      />{{ endCategoryone.name }}
                    </li>
                  </ul>
                </li>
              </ul>
            </li>
          </ul>
        </form>
      </div>
    </div>
    <!--------------------------------end nav left---------->
  </div>
</template>
<script>
import axios from "axios";
export default {
  name: "Classes",
  props: {
    msg: String,
  },
  data: function () {
    return {
      pageOfItems: [],
      courses: [],

      categoriesFilter: [],

      search_name: null,
      arr1: [],
      arr2: [],
      arrayfillter: [],
    };
  },
  mounted: function () {
    axios
      .get(this.$api_url + "api/courses?lang=" + localStorage.getItem("lang"))
      .then((response) => {
        this.courses = response.data.data;
      });

    axios
      .get(
        this.$api_url +
          "api/categoriesFilter?lang=" +
          localStorage.getItem("lang")
      )
      .then((response) => {
        this.categoriesFilter = response.data.data;
        console.log(this.categoriesFilter);
      });
  },
  methods: {
    onChangePage(pageOfItems) {
      // update page of items
      this.pageOfItems = pageOfItems;
    },
    openNav() {
      function myFunction(x) {
        if (x.matches) {
          // If media query matches
          document.getElementById("mySidenav").style.paddingLeft = "15px";
          document.getElementById("mySidenav").style.width = "70%";
          document.getElementById("headernav").style.marginLeft = "70%";
          document.getElementById("submit").css("right", "55px");
        } else {
          document.getElementById("mySidenav").style.paddingLeft = "15px";
          document.getElementById("mySidenav").style.width = "350px";
          document.getElementById("headernav").style.marginLeft = "350px";
          document.getElementById("submit").css("right", "35px");
        }
      }
      var x = window.matchMedia("(max-width: 1000px)");
      myFunction(x);
      x.addListener(myFunction);
    },
    closeNav() {
      document.getElementById("mySidenav").style.paddingLeft = "0px";
      document.getElementById("mySidenav").style.width = "0px";
      document.getElementById("headernav").style.marginLeft = "0px";
      document.getElementById("submit").css("right", "0px");
    },
    gotosearch: function () {
      this.$router.push({
        name: "search_fillter",
        params: {
          search_name: this.search_name,
        },
        props: {
          default: true,
        },
      });
    },
    gotofillter: function (key) {
      // let i=0;
      // for (var x = 0; x < this.arr1.length; x++) {
      //   if(this.arr2[x] == true)
      //   {
      //      this.arrayfillter[i++] = this.arr1[x];
      //    }
      // }
      //  console.log("this.arrayfillter");
      //  console.log(this.arrayfillter);
      this.$router.push({
        name: "search_fillter",
        params: {
          search_name: key,
        },
        props: {
          default: true,
        },
      });
    },
  },
};
</script>
