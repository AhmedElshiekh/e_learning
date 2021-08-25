<template>
  <div class="Instructors">
    <div class="courses_page classes_page" id="courses_page">
      <div class="cont_div">
        <h1>
          {{ $t("All Instructors") }}
        </h1>
        <hr class="top_hr" />
        <div class="row_top">
          <p>{{ $t("We found") }} {{ Instructors_all.length }} {{ $t("courses for you") }}</p>
        </div>
      </div>
    </div>
    <div class="clearfix"></div>
    <div class="col-lg-12">
      <div
        class="col-lg-6"
        style="margin-bottom: 20px"
         v-for="item in pageOfItems"
        :key="item.id"
      >
        <router-link
            :to="{
            name: 'Instructorspage',
            params: {
                key_instructor: item.key,
            },
            }"
            tag="a"
        >
         <div class="single_instructor row">
          <div class="single_instructor_thumb col-lg-4">
            <a href="#"
              ><img :src="$api_url + item.image" class="img-fluid" alt=""
            /></a>
          </div>
          <div class="single_instructor_caption col-lg-8">
            <h4>{{ item.name }}</h4>
            <p>{{ item.qualifications }}</p>
            <ul class="social_info">
              <li v-if="item.facebook != null">
                <a :href="item.facebook"
                  ><i class="fa fa-facebook"></i
                ></a>
              </li>
              <li v-if="item.whatsApp != null">
                <a :href="item.whatsApp"
                  ><i class="fa fa-whatsapp"></i
                ></a>
              </li>
            </ul>
          </div>
         </div>
        </router-link>
      </div>

                  <div class="pt-3" style="margin: 20px;">
                    <jw-pagination
                      :items="Instructors_all"
                      :pageSize="6"
                      @changePage="onChangePage"
                    ></jw-pagination>
                  </div>
    </div>
    <div class="clearfix"></div>
    <!--------------------------------end classes---------->
    <!--------------------------------start nav left---------->

    <!--------------------------------end nav left---------->

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
  name: "Instructors",
  data: function () {
    return {
      Instructors_all: null,
      pageOfItems: [],
      instructorfa: "https://web.whatsapp.com/",
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
  mounted: function () {
    axios
      .get(this.$api_url + "api/global?lang=" + localStorage.getItem("lang"))
      .then((response) => {
        this.global_info = response.data.data;
      });
    axios
      .get(
        this.$api_url + "api/instructors?lang=" + localStorage.getItem("lang")
      )
      .then((response) => {
        this.Instructors_all = response.data.data;
        console.log(this.Instructors_all);
      });
    axios
      .get(this.$api_url + "api/footer?lang=" + localStorage.getItem("lang"))
      .then((response) => {
        this.footer = response.data.data;
        console.log(this.footer);
      });
  },
  methods: {
    onChangePage(pageOfItems) {
      // update page of items
      this.pageOfItems = pageOfItems;
    },
  },
};
</script>
