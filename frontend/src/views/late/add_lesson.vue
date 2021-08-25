<template>
  <div class="add_lesson">
    <div class="courses_page" id="courses_page">
      <div class="cont_div">
        <h1>Edit <span>Course</span></h1>
        <hr class="top_hr" />
        <div class="add_course">
          <div class="container up">
            <div class="card-body">
              <form>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="img">Upload Video</label>
                      <div id="uploader-video">
                        <div
                          id="uploader-video-container"
                          class="controls uploader"
                        >
                          <div class="filelist"></div>
                          <div class="upload-actions">
                            <input id="fileUpload" type="file" hidden />
                            <a
                              class="btn btn-primary btn-browse"
                              @click="chooseFiles()"
                            >
                              <i class="fa fa-file"></i> Browse
                            </a>
                          </div>

                          <div
                            class="uploaded row"
                            style="margin-top: 10px"
                          ></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="name  ">Topic*</label>
                      <input
                        type="text"
                        name="topic"
                        class="form-control"
                        id="name"
                        placeholder="Enter Topic  "
                        value="aslkdj"
                        required
                      />
                    </div>
                  </div>

                  <div class="col-md-6"></div>
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="sh_desc  ">Objective </label>
                      <textarea
                        rows="6"
                        cols="60"
                        class="form-control summernote"
                        name="objective"
                        id="desc"
                        required
                      >
                                          lksadj
                                        </textarea
                      >
                    </div>
                  </div>

                  <div class="col-md-4 col-lg-6">
                    <div class="form-group">
                      <label for="desc">Summary</label>

                      <textarea
                        rows="6"
                        cols="60"
                        class="form-control summernote"
                        name="objective"
                        id="desc"
                        required
                      >
                                          lksadj
                                        </textarea
                      >
                    </div>
                  </div>

                  <div class="col-md-4 col-lg-6">
                    <div class="form-group">
                      <label for="material">Material</label>
                      <div class="form-group">
                        <label for="img">Upload Attachment</label>
                        <div
                          id="uploader-material"
                          data-options='{"flash_swf_url":"\/js\/Moxie.swf","silverlight_xap_url":"\/js\/Moxie.xap","url":"https:\/\/education.aisent.net\/admin\/lessons\/upload","filters":{"runtimes":"html5,flash,silverlight,html4","chunk_size":"50kb","max_file_size":"2Gb","mime_types":[{"title":"Material files","extensions":"pdf,docx,xlsx,pptx3,jpg,png"}],"dragdrop":true},"multi_selection":true,"multipart_params":{"_token":"uS7z9QfbfE8VDYR8KXGXz01yoAfva6iUPkxlbqcz"},"browse_button":"uploader-material-pickfiles","container":"uploader-material-container"}'
                          data-autostart="1"
                          data-uploadbtn="uploader-material-upload"
                        >
                          <div
                            id="uploader-material-container"
                            class="controls uploader"
                          >
                            <div class="filelist"></div>
                            <div class="upload-actions">
                              <input id="fileUpload" type="file" hidden />
                              <a
                                class="btn btn-primary btn-browse"
                                @click="chooseFiles()"
                              >
                                <i class="fa fa-file"></i> Browse
                              </a>
                            </div>

                            <div
                              class="uploaded row"
                              style="margin-top: 10px"
                            ></div>
                          </div>
                          <div
                            class="uploaded row"
                            style="margin-top: 10px"
                          ></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="card-action">
                  <input
                    type="submit"
                    class="btn btn-success float-right"
                    value="Update"
                  />
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <footer>
      <div class="background_footer">
        <div class="row items">
          <div class="col-md-12">
            <div class="col-md-6 animation_left">
              <div class="row" animation_left>
                <img src="..//assets/images/logo2.png" class="logo" />
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
                <li>
                  <a :href="footer.facebook">
                    <i class="fa fa-facebook"></i>
                  </a>
                </li>
                <li>
                  <a :href="footer.youtube">
                    <i class="fa fa-youtube"></i>
                  </a>
                </li>
                <li>
                  <a :href="footer.twitter">
                    <i class="fa fa-twitter"></i>
                  </a>
                </li>
                <li>
                  <a :href="footer.whatsapp">
                    <i class="fa fa-whatsapp"></i>
                  </a>
                </li>
                <li>
                  <a :href="footer.instagram">
                    <i class="fa fa-instagram"></i>
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </footer>
  </div>
</template>

<script>
import axios from "axios";
export default {
  name: "add_lesson",
  data: function () {
    return {
      footer: null,
    };
  },
  mounted: function () {
    if (localStorage.getItem("token") != null) {
      this.showModal = false;
      this.signinbutton = false;
      this.profile_show = true;
    }
    axios.get(this.$api_url + "api/footer").then((response) => {
      this.footer = response.data.data;
      console.log(this.footer);
    });
  },
  methods: {
    chooseFiles: function () {
      document.getElementById("fileUpload").click();
    },
  },
};
</script>
