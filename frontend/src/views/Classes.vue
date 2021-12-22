<template>
  <div class="Class">
    <!--------------------------------start classes ---------->
    <div class="Classes">
      <div class="courses_page classes_page" id="courses_page">
        <div class="cont_div">
          <h1>
            {{ $t("All classes") }}
          </h1>
          <hr class="top_hr" />
          <div class="row_top">
            <p>
              {{ $t("We found") }} {{ classes.length }}
              {{ $t("courses for you") }}
            </p>
            <ul class="ul_filtter">
              <li>
                <a class="btn a_button" v-on:click="openNav()">
                  {{ $t("Show Filter") }}
                  <i class="fa fa-arrow-circle-right"></i>
                </a>
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
        </div>
      </div>
      <div class="clearfix"></div>
      <section class="classes classes_page">
        <div class="container">
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
            <div class="pb-0 pt-3">
              <jw-pagination
                :items="classes"
                :pageSize="6"
                @changePage="onChangePage"
              ></jw-pagination>
            </div>
          </div>
        </div>
      </section>
    </div>
    <div class="clearfix"></div>

    <!-- <footer>
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
                <a href="#"><img src="..//assets/images/imagesicon1.png" /></a>
              </li>
              <li>
                <a href="#"><img src="..//assets/images/imagesicon2.png" /></a>
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
                <a
                  :href="
                    'https://api.whatsapp.com/send?phone=' + footer.whatsapp
                  "
                >
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
    </footer> -->

    <!--------------------------------end classes---------->
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
  name: "Class",
  props: {
    msg: String,
  },
  data: function () {
    return {
      currency: this.$currency,
      pageOfItems: [],
      classes: [],
      //   footer: {
      //     address: null,
      //     email: null,
      //     facebook: null,
      //     instagram: null,
      //     linkedin: null,
      //     location: null,
      //     phone: null,
      //     twitter: null,
      //     whatsapp: null,
      //     youTube: null,
      //   },
      //   global_info: null,
      categoriesFilter: [],
    };
  },
  mounted: function () {
    // axios
    //   .get(this.$api_url + "api/global?lang=" + localStorage.getItem("lang"))
    //   .then((response) => {
    //     this.global_info = response.data.data;
    //   });
    axios
      .get(
        this.$api_url + "api/liveCourses?lang=" + localStorage.getItem("lang")
      )
      .then((response) => {
        this.classes = response.data.data;
        console.log("this.classes");
        console.log(this.classes);
      });
    // axios
    //   .get(this.$api_url + "api/footer?lang=" + localStorage.getItem("lang"))
    //   .then((response) => {
    //     this.footer = response.data.data;
    //     console.log(this.footer);
    //   });
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
<style>
a {
  cursor: pointer;
}
.pagination {
  justify-content: center;
  flex-wrap: wrap;
}
</style>
