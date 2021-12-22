<template>
  <div class="search_fillter">
    <!--------------------------------start classes ---------->
    <div>
      <div class="courses_page classes_page" id="courses_page">
        <div class="cont_div">
          <h1>
            {{ $t("results") }}
          </h1>
          <hr class="top_hr" />
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
                  <span v-if="item.type == 'recorded'" id="classe_type">{{
                    $t("live Classe")
                  }}</span>
                  <span v-if="item.type == 'live'" id="course_type">{{
                    $t("Course")
                  }}</span>
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
                            v-if="teacher.image" 
                            :src="$api_url + teacher.image"
                            class="img-fluid"
                            alt
                          />
                          <img
                            v-if="!teacher.image"
                            src="..//assets/images/user-3.png"
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
            placeholder="Search.."
            name="search"
            class="search"
          />
          <button type="submit" class="search_button" id="submit">
            <i class="fa fa-search"></i>
          </button>
          <h4>{{ $t("Categories") }}</h4>
          <ul>
            <li>
              <label
                data-toggle="collapse"
                data-target="#demo7"
                class="checkbox-custom-label"
              >
                <i class="fa fa-caret-down"></i> القراءه للمبتدئن</label
              >
              <ul class="subcategory">
                <li
                  class="collapse"
                  id="demo7"
                  data-toggle=""
                  data-target="#subdemo1"
                >
                  <i class="fa fa-caret-down"></i> القراءه1
                  <ul class="subsubcategory" id="subdemo1">
                    <li>
                      <input
                        id="a-5"
                        class="checkbox-custom"
                        type="checkbox"
                      />القراء2
                    </li>
                    <li>
                      <input
                        id="a-5"
                        class="checkbox-custom"
                        type="checkbox"
                      />القراء2
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
  name: "search_fillter",
  props: {
    msg: String,
  },
  data: function () {
    return {
      currency: this.$currency,
      pageOfItems: [],
      classes: [],
    };
  },
  mounted: function () {
    this.search_name = this.$route.params.search_name;
    console.log("search_name");
    console.log(this.search_name);

    axios
      .post(this.$api_url + "api/search?lang=" + localStorage.getItem("lang"), {
        search: this.search_name,
      })
      .then((response) => {
        this.classes = response.data.data;
        console.log("this.classes");
        console.log(this.classes);
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
