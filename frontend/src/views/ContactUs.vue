<template>
  <div class="Contact_Us">
    <section class="contactus">
      <div class="container">
        <div class="row">
          <div class="col-lg-6">
            <h1>{{ $t("CONTACT US") }}</h1>
            <hr class="top_hr" />
            <br />
            <form @submit="postcontact" method="post">
              <div class="form-group">
                <input
                  type="text"
                  name=""
                  :placeholder="$t('Your Name')"
                  class="form-control"
                  v-model="mess.name"
                  v-if="emailtoken != false"
                />
              </div>
              <div class="form-group">
                <input
                  type="email"
                  name="" 
                  :placeholder="$t('Your Email')"
                  class="form-control"
                  v-if="emailtoken != false"
                  v-model="mess.email"
                />
              </div>
              <div class="form-group">
                <input
                  type="text"
                  name=""
                  :placeholder="$t('Your Phone')"
                  class="form-control"
                  v-if="emailtoken != false"
                  v-model="mess.phone"
                />
              </div>
              <div class="form-group">
                <textarea
                  type="text"
                  name=""
                  :placeholder="$t('Message')"
                  v-model="mess.note"
                  class="form-control"
                ></textarea>
              </div>
              <span v-if="error != null" style="display: block; color: red">
                {{ error }}
              </span>
              <div class="col-lg-12" style="text-align: right">
                <input type="submit" class="submit" :value="$t('submit')" />
                <i class="fa fa-arrow-right"></i>
              </div>

              <div style="clear: both"></div>
            </form>
          </div>
          <div class="col-lg-6 google_map">
            <div class="mapouter">
              <div class="gmap_canvas">
                <iframe
                  width="100%"
                  height="100%"
                  id="gmap_canvas"
                  src="https://maps.google.com/maps?q=Swift%20Rooms%20LLC%20-%202020%20Experience%20Centre%20(opening%20soon)!&t=&z=13&ie=UTF8&iwloc=&output=embed"
                  frameborder="0"
                  scrolling="no"
                  marginheight="0"
                  marginwidth="0"
                ></iframe
                ><a href="https://123movies-to.org"></a><br />
                <a href="https://www.embedgooglemap.net"
                  >embedded maps google</a
                >
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  
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
  name: "Contact_Us",
  data: function () {
    return {
      contact_Us: null,
      mess: {
        name: null,
        email: null,
        phone: null,
        note: null,
      },
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
      error: null,
      emailtoken: true,
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
      .get(this.$api_url + "api/contactUs?lang=" + localStorage.getItem("lang"))
      .then((response) => {
        this.contact_Us = response.data.data;
        console.log("this.contact_Us");
        console.log(this.contact_Us);
      });
    axios
      .get(this.$api_url + "api/footer?lang=" + localStorage.getItem("lang"))
      .then((response) => {
        this.footer = response.data.data;
      });

    if (localStorage.getItem("token") != null) {
      this.emailtoken = false;
    }
  },
  methods: {
    postcontact: function (e) {
      if (localStorage.getItem("token") != null) {
        axios
          .post(
            this.$api_url +
              "api/sendMessage?lang=" +
              localStorage.getItem("lang") +
              "&token=" +
              localStorage.getItem("token"),
            {
              note: this.mess.note,
            }
          )
          .then((response) => {
            console.log(response);
            this.$fire({
              title: "Successed contactus",
              type: "success",
            });
          })
          .catch((error) => {
            this.error = error.response.data.massage;
          });
      } else {
        axios
          .post(this.$api_url + "api/sendMessage", {
            name: this.mess.name,
            email: this.mess.email,
            phone: this.mess.phone,
            note: this.mess.note,
          })
          .then((response) => {
            console.log(response);
            this.$fire({
              title: "Successed contactus",
              type: "success",
            });
          })
          .catch((error) => {
            this.error = error;
          });
      }
      e.preventDefault();
      console.log(this.contact_Us);
    },
  },
};
</script>
