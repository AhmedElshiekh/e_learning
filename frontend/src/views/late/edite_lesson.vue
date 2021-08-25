<template>
  <div class="edit_lesson">
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

                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="name  ">Chapter*</label>
                      <select
                        name="chapter_id"
                        class="form-control"
                        id="name"
                        required
                      >
                        <option value="">Select Chapter</option>
                        <option value="4" selected>Unit 01</option>
                        <option value="5">Unit 02</option>
                      </select>
                    </div>
                  </div>
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
  </div>
</template>

<script>
// import axios from "axios";
export default {
  name: "edit_lesson",
  data: function () {
    return {};
  },
  methods: {
    chooseFiles: function () {
      document.getElementById("fileUpload").click();
    },
  },
};
</script>
