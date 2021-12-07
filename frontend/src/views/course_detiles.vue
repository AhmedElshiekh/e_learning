<template>
  <div class="course_detiles">
    <!-- ============================================================== -->
    <header>
      <img src="..//assets/images/background1.jpg" class="img" />
      <div class="div_title">
        <h1>{{ courseDetails.name }}</h1>
        <p>{{ courseDetails.short_description }}</p>
        <ul>
          <li>{{ courseDetails.category }}</li>
          <li>{{ courseDetails.subCategory }}</li>
        </ul>
      </div>
    </header>
    <!--------------------------------start section courses---------->
    <section class="sec_detiles_course">
      <div class="col-lg-12">
        <div class="info_page">
          <div class="sec_detiles_course_left col-lg-12">
            <h2 v-if="lessonShow.name != null">{{ lessonShow.name }}</h2>
            <h2 v-if="lessonShow.name == null"><br /></h2>
            <ul class="buy_ul" v-if="courseDetails.owner == false">
              <li
                v-if="
                  courseDetails.price != null &&
                  courseDetails.price != 0 &&
                  courseDetails.discountPrice != 0 &&
                  courseDetails.discountPrice != null
                "
              >
                <span>${{ courseDetails.discountPrice }}</span>
                <p>${{ courseDetails.price }}</p>
              </li>
              <li
                v-if="
                  courseDetails.price != null &&
                  courseDetails.price != 0 &&
                  (courseDetails.discountPrice == 0 ||
                    courseDetails.discountPrice == null)
                "
              >
                $ {{ courseDetails.price }}
              </li>
              <li>
                <a class="btn" @click="checkBuy(courseDetails.key)">{{
                  $t("Buy Now")
                }}</a>
              </li>
            </ul>
          </div>

          <div class="clearfix"></div>
          <div class="row">
            <div class="sec_detiles_course_left col-lg-6">
              <div class="clearfix"></div>
              <div class="img_div">
                <div class="property_video">
                  <div class="thumb">
                    <!-- <iframe
                      id="video"
                      :src="$api_url + 'uploads/' + lessonShow.video"
                      v-if="
                        lessonShow.video != null && lessonShow.prevTest == null &&
                        isModalexam != true
                      "
                      allowfullscreen
                    ></iframe> -->
                    <video-player
                      class="video-player-box"
                      ref="videoPlayer"
                      :options="{
                        language: 'en',
                        playbackRates: [0.5, 0.7, 1.0, 1.5, 2.0],
                        sources: [
                          {
                            type: 'video/mp4',
                            src: $api_url + 'uploads/' + lessonShow.video,
                          },
                        ],
                        controls: true,
                        controlBar: {
                          timeDivider: true,
                          durationDisplay: true,
                          fullscreenToggle: true,
                        },
                      }"
                      @play="onPlayerPlay($event)"
                      @pause="onPlayerPause($event)"
                      @ended="onPlayerEnded($event)"
                      @waiting="onPlayerWaiting($event)"
                      @playing="onPlayerPlaying($event)"
                      @loadeddata="onPlayerLoadeddata($event)"
                      @timeupdate="onPlayerTimeupdate($event)"
                      @canplay="onPlayerCanplay($event)"
                      @canplaythrough="onPlayerCanplaythrough($event)"
                      @statechanged="playerStateChanged($event)"
                      @ready="playerReadied"
                    ></video-player>
                    <!-- displayCurrentQuality: true -->
                    <img
                      class="pro_img img-fluid w100"
                      :src="$api_url + image_course"
                      v-if="lessonShow.video == null"
                      alt="7.jpg"
                    />
                    <!-- <div class="overlay_icon">
                    <div class="bb-video-box">
                      <div class="bb-video-box-inner">
                        <div class="bb-video-box-innerup">
                          <a
                            href=""
                            data-toggle="modal"
                            data-target="#popup-video"
                            class="theme-cl"
                            ><i class="fa fa-play"></i
                          ></a>
                        </div>
                      </div>
                    </div>
                  </div>-->
                  </div>
                </div>
              </div>
            </div>
            <div class="sec_detiles_course_left col-lg-6">
              <!-- Curriculum Detail -->
              <div class="lessons">
                <a
                  href="#"
                  v-for="teacher in courseDetails.teachers"
                  v-bind:key="teacher.key"
                >
                  <router-link
                    :to="{
                      name: 'Instructorspage',
                      params: {
                        key_instructor: teacher.key,
                      },
                    }"
                    tag="a"
                  >
                    <img
                      @mouseover="showTeacherName(teacher.key)"
                      @mouseleave="hideTeacherName(teacher.key)"
                      v-if="teacher.image"
                      :src="$api_url + teacher.image"
                      class="img-fluid"
                      alt
                    />
                    <img
                      @mouseover="showTeacherName(teacher.key)"
                      @mouseleave="hideTeacherName(teacher.key)"
                      v-if="!teacher.image"
                      src="..//assets/images/user-3.png"
                      class="img-fluid"
                      alt
                    />
                    <h3
                      :id="'teacherName_' + teacher.key"
                      style="display: none"
                      v-if="courseDetails.teachers.length != 0"
                    >
                      {{ teacher.name }}
                    </h3>
                  </router-link>
                </a>

                <div class="wrapper center-block">
                  <div
                    class="panel-group"
                    id="accordion"
                    role="tablist"
                    aria-multiselectable="true"
                  >
                    <div
                      class="panel panel-default"
                      v-for="chapter in courseDetails.chapters"
                      v-bind:key="chapter.key"
                    >
                      <div class="panel-heading" role="tab">
                        <h4 class="panel-title">
                          <a
                            class="collapsed"
                            role="button"
                            data-toggle="collapse"
                            data-parent="#accordion"
                            :href="'#collapseone' + chapter.name"
                            aria-expanded="false"
                            :aria-controls="'collapseone' + chapter.name"
                            >{{ chapter.name }}</a
                          >
                        </h4>
                      </div>
                      <div
                        :id="'collapseone' + chapter.name"
                        class="panel-collapse collapse show"
                        role="tabpanel"
                        aria-labelledby="headingTwo"
                      >
                        <div class="panel-body">
                          <ul
                            class="lectures_lists"
                            v-for="(Lesson, index) in chapter.LessonsList"
                            v-bind:key="Lesson.key"
                          >
                            <li>
                              <div class="lectures_lists_title">
                                <span v-if="courseDetails.owner == false">
                                  <a
                                    @click="
                                      getsecond_lesson(
                                        Lesson.key,
                                        courseDetails.owner
                                      )
                                    "
                                  >
                                    <i
                                      class="fa fa-play"
                                      v-if="index == 0"
                                      style="color: green"
                                    ></i>
                                    <i class="fa fa-lock" v-if="index != 0"></i>
                                    {{ $t("Lesson:") }} {{ index + 1 }}
                                    {{ Lesson.name }}
                                  </a>
                                </span>

                                <span v-if="courseDetails.owner == true">
                                  <a
                                    @click="
                                      getsecond_lesson(
                                        Lesson.key,
                                        courseDetails.owner
                                      )
                                    "
                                    v-if="courseDetails.owner == true"
                                  >
                                    <i class="fa fa-play"></i>
                                    {{ $t("Lesson:") }} {{ index + 1 }}
                                    {{ Lesson.name }}
                                  </a>
                                </span>
                              </div>

                              <div
                                class="lectures_lists_title"
                                v-if="
                                  courseDetails.currentLessonKey ==
                                    Lesson.key && key_lesson == null
                                "
                              >
                                <span class="material">
                                  <a
                                    data-toggle="modal"
                                    data-target="#popup-materiers"
                                  >
                                    <i class="fa fa-download"></i>
                                    {{ $t("Material") }}
                                  </a>
                                </span>
                              </div>

                              <div
                                class="lectures_lists_title"
                                v-if="
                                  key_lesson != null && key_lesson == Lesson.key
                                "
                              >
                                <span class="material">
                                  <a
                                    data-toggle="modal"
                                    data-target="#popup-materiers"
                                  >
                                    <i class="fa fa-download"></i>
                                    {{ $t("Material") }}
                                  </a>
                                </span>
                              </div>
                              <span class="material next">
                                <button
                                  href="#"
                                  class="btn"
                                  style="background: #54c0eb; color: white"
                                  data-toggle="modal"
                                  data-target="#popup-lesson"
                                  v-if="
                                    courseDetails.currentLessonKey ==
                                      Lesson.key && key_lesson == null
                                  "
                                >
                                  <!--&&
                                index + 1 != chapter.LessonsList.length-->
                                  {{ $t("Next") }}
                                </button>
                                <button
                                  href="#"
                                  class="btn"
                                  style="background: #54c0eb; color: white"
                                  data-toggle="modal"
                                  data-target="#popup-lesson"
                                  v-if="
                                    key_lesson != null &&
                                    key_lesson == Lesson.key
                                  "
                                >
                                  <!--&&
                                index + 1 != chapter.LessonsList.length-->
                                  {{ $t("Next") }}
                                </button>
                              </span>
                            </li>
                          </ul>

                          <ul
                            v-if="chapter.quiz != false"
                            class="lectures_lists"
                          >
                            <li
                              class="lectures_lists_title quize_list"
                              @click="funcQuize(chapter.key)"
                            >
                              <div
                                class="lectures_lists_title"
                                style="padding: 5px 20px"
                              >
                                <i class="fa fa-question-circle"></i>
                                {{ $t("Quiz") }}
                              </div>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </div>

                    <div class="panel panel-default">
                      <div class="panel-heading" role="tab">
                        <h4 class="panel-title">
                          <a
                            class="collapsed"
                            role="button"
                            data-toggle="collapse"
                            data-parent="#accordion"
                            href="collapseoneexam"
                            aria-expanded="false"
                            aria-controls="collapseoneexam"
                            >{{ $t("Exam about this course") }}</a
                          >
                        </h4>
                      </div>
                      <div
                        id="collapseoneexam"
                        class="panel-collapse collapse show"
                        role="tabpanel"
                        aria-labelledby="headingTwo"
                      >
                        <div class="panel-body">
                          <ul class="lectures_lists">
                            <li
                              v-if="courseDetails.exam != null"
                              class="lectures_lists_title quize_list"
                            >
                              <div
                                class="lectures_lists_title"
                                style="padding: 5px 20px"
                                @click="examsections(courseDetails.exam)"
                              >
                                <i class="fa fa-question-circle"></i>
                                {{ $t("Exam") }}
                              </div>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div style="clear: both"></div>
          <!-- ============================ Course overview ================================== -->

          <div class="overview">
            <!-- Overview -->
            <div class="row">
              <div class="edu_wraper">
                <h4 class="edu_title">{{ $t("objective") }}</h4>
                <div
                  class="row"
                  v-html="lessonShow.objective"
                  v-if="lessonShow.objective != null"
                ></div>
              </div>
            </div>
            <div style="clear: both"></div>
          </div>
          <div class="overview">
            <!-- Overview -->
            <div class="row">
              <div class="edu_wraper">
                <h4 class="edu_title">{{ $t("Course Overview") }}</h4>
                <p v-html="courseDetails.description"></p>
                <h6>{{ $t("Requirements") }}</h6>
                <div v-html="courseDetails.requirements"></div>
                <h4 class="edu_title">{{ $t("What you will learn") }}</h4>
                <div class v-html="courseDetails.WhatWillLearn"></div>
              </div>
            </div>
            <div style="clear: both"></div>
          </div>
        </div>
      </div>
      <div style="clear: both"></div>
    </section>
    <div style="clear: both"></div>

    <!-- Modal -->
    <div
      class="modal fade"
      id="popup-lesson"
      v-show="isModalVisible2"
      tabindex="-1"
      role="dialog"
      aria-labelledby="myModalLabel"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <span style="font-size: 15px">{{ $t("summary") }}</span>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div
            class="modal-body"
            v-html="lessonShow.summary"
            v-if="lessonShow.summary != null"
          ></div>
          <div class="modal-footer">
            <button
              v-if="lessonShow.exam != false"
              class="button closepopuplesson closes btn btn-success"
              data-dismiss="modal"
              aria-label="Close"
              @click="
                getsecond_lesson_exam(courseDetails.owner, lessonShow.key),
                  (closepopuplesson = false)
              "
            >
              {{ $t("Quiz") }}
            </button>
            <button
              class="close btn btn-success closepopuplesson"
              data-dismiss="modal"
              aria-label="Close"
              @click="
                getsecond_lesson(lessonShow.nextLesson, courseDetails.owner),
                  (closepopuplesson = false)
              "
              v-if="lessonShow.exam == false"
            >
              {{ $t("Next Lesson") }}
            </button>
            <!-- <button
            class="close btn btn-success closepopuplesson"
              data-dismiss="modal"
               style="background: #54c0eb; color: white"
              aria-label="Close"
              data-toggle="modal"
              data-target="#popup-examChapter"
              @click="closepopuplesson = false"
              v-if="lessonShow.prevTest != null">
                  NExt2

            </button>-->
          </div>
        </div>
      </div>
    </div>
    <div
      class="modal fade"
      id="popup-materiers"
      tabindex="-1"
      role="dialog"
      aria-labelledby="myModalLabel"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <span style="font-size: 15px">{{ $t("Download Material") }}</span>
            <button
              type="button"
              class="close_ar close"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <a title="ImageName" @click="downloadWithVueResource" href="#">
              <p>
                <svg
                  version="1.1"
                  id="Capa_1"
                  xmlns="http://www.w3.org/2000/svg"
                  xmlns:xlink="http://www.w3.org/1999/xlink"
                  x="0px"
                  y="0px"
                  viewBox="0 0 56 56"
                  style="
                    enable-background: new 0 0 56 56;
                    height: 46px;
                    display: block;
                  "
                  xml:space="preserve"
                >
                  <g>
                    <path
                      style="fill: #e9e9e0"
                      d="M36.985,0H7.963C7.155,0,6.5,0.655,6.5,1.926V55c0,0.345,0.655,1,1.463,1h40.074
		c0.808,0,1.463-0.655,1.463-1V12.978c0-0.696-0.093-0.92-0.257-1.085L37.607,0.257C37.442,0.093,37.218,0,36.985,0z"
                    />
                    <polygon
                      style="fill: #d9d7ca"
                      points="37.5,0.151 37.5,12 49.349,12 	"
                    />
                    <path
                      style="fill: #cc4b4c"
                      d="M19.514,33.324L19.514,33.324c-0.348,0-0.682-0.113-0.967-0.326
		c-1.041-0.781-1.181-1.65-1.115-2.242c0.182-1.628,2.195-3.332,5.985-5.068c1.504-3.296,2.935-7.357,3.788-10.75
		c-0.998-2.172-1.968-4.99-1.261-6.643c0.248-0.579,0.557-1.023,1.134-1.215c0.228-0.076,0.804-0.172,1.016-0.172
		c0.504,0,0.947,0.649,1.261,1.049c0.295,0.376,0.964,1.173-0.373,6.802c1.348,2.784,3.258,5.62,5.088,7.562
		c1.311-0.237,2.439-0.358,3.358-0.358c1.566,0,2.515,0.365,2.902,1.117c0.32,0.622,0.189,1.349-0.39,2.16
		c-0.557,0.779-1.325,1.191-2.22,1.191c-1.216,0-2.632-0.768-4.211-2.285c-2.837,0.593-6.15,1.651-8.828,2.822
		c-0.836,1.774-1.637,3.203-2.383,4.251C21.273,32.654,20.389,33.324,19.514,33.324z M22.176,28.198
		c-2.137,1.201-3.008,2.188-3.071,2.744c-0.01,0.092-0.037,0.334,0.431,0.692C19.685,31.587,20.555,31.19,22.176,28.198z
		 M35.813,23.756c0.815,0.627,1.014,0.944,1.547,0.944c0.234,0,0.901-0.01,1.21-0.441c0.149-0.209,0.207-0.343,0.23-0.415
		c-0.123-0.065-0.286-0.197-1.175-0.197C37.12,23.648,36.485,23.67,35.813,23.756z M28.343,17.174
		c-0.715,2.474-1.659,5.145-2.674,7.564c2.09-0.811,4.362-1.519,6.496-2.02C30.815,21.15,29.466,19.192,28.343,17.174z
		 M27.736,8.712c-0.098,0.033-1.33,1.757,0.096,3.216C28.781,9.813,27.779,8.698,27.736,8.712z"
                    />
                    <path
                      style="fill: #cc4b4c"
                      d="M48.037,56H7.963C7.155,56,6.5,55.345,6.5,54.537V39h43v15.537C49.5,55.345,48.845,56,48.037,56z"
                    />
                    <g>
                      <path
                        style="fill: #ffffff"
                        d="M17.385,53h-1.641V42.924h2.898c0.428,0,0.852,0.068,1.271,0.205
			c0.419,0.137,0.795,0.342,1.128,0.615c0.333,0.273,0.602,0.604,0.807,0.991s0.308,0.822,0.308,1.306
			c0,0.511-0.087,0.973-0.26,1.388c-0.173,0.415-0.415,0.764-0.725,1.046c-0.31,0.282-0.684,0.501-1.121,0.656
			s-0.921,0.232-1.449,0.232h-1.217V53z M17.385,44.168v3.992h1.504c0.2,0,0.398-0.034,0.595-0.103
			c0.196-0.068,0.376-0.18,0.54-0.335c0.164-0.155,0.296-0.371,0.396-0.649c0.1-0.278,0.15-0.622,0.15-1.032
			c0-0.164-0.023-0.354-0.068-0.567c-0.046-0.214-0.139-0.419-0.28-0.615c-0.142-0.196-0.34-0.36-0.595-0.492
			c-0.255-0.132-0.593-0.198-1.012-0.198H17.385z"
                      />
                      <path
                        style="fill: #ffffff"
                        d="M32.219,47.682c0,0.829-0.089,1.538-0.267,2.126s-0.403,1.08-0.677,1.477s-0.581,0.709-0.923,0.937
			s-0.672,0.398-0.991,0.513c-0.319,0.114-0.611,0.187-0.875,0.219C28.222,52.984,28.026,53,27.898,53h-3.814V42.924h3.035
			c0.848,0,1.593,0.135,2.235,0.403s1.176,0.627,1.6,1.073s0.74,0.955,0.95,1.524C32.114,46.494,32.219,47.08,32.219,47.682z
			 M27.352,51.797c1.112,0,1.914-0.355,2.406-1.066s0.738-1.741,0.738-3.09c0-0.419-0.05-0.834-0.15-1.244
			c-0.101-0.41-0.294-0.781-0.581-1.114s-0.677-0.602-1.169-0.807s-1.13-0.308-1.914-0.308h-0.957v7.629H27.352z"
                      />
                      <path
                        style="fill: #ffffff"
                        d="M36.266,44.168v3.172h4.211v1.121h-4.211V53h-1.668V42.924H40.9v1.244H36.266z"
                      />
                    </g>
                  </g>
                  <g></g>
                  <g></g>
                  <g></g>
                  <g></g>
                  <g></g>
                  <g></g>
                  <g></g>
                  <g></g>
                  <g></g>
                  <g></g>
                  <g></g>
                  <g></g>
                  <g></g>
                  <g></g>
                  <g></g>
                </svg>

                {{ $t("lesson material") }}
              </p>
            </a>
          </div>
          <div class="modal-footer">
            <button
              class="btn btn-success"
              data-dismiss="modal"
              aria-label="Close"
            >
              {{ $t("close") }}
            </button>
          </div>
        </div>
      </div>
    </div>
    <div
      class="modal show"
      id="popup-examChapter"
      tabindex="-1"
      role="dialog"
      v-if="isModalexamChapter == true"
      aria-labelledby="myModalLabel"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-body">
            <div class="row">
              <h1>{{ $t("Quiz Chapter:") }}</h1>
              <hr />
              <div
                v-for="(quiz, index) in quizChapter"
                v-bind:key="quiz.key"
                class="div_qution"
              >
                <p>{{ quiz.question }} ?</p>

                <div class="anser_parent">
                  <div
                    class="ans"
                    v-for="answers in quiz.answers"
                    v-bind:key="answers.key"
                  >
                    <input
                      v-bind:value="answers.key"
                      type="radio"
                      v-model="sortKey[index]"
                    />

                    <label>{{ answers.answer }}</label>
                  </div>

                  <h5 v-html="arraycolor[index]" :v-if="arraycolor != []"></h5>
                </div>
                <hr />
              </div>

              <input
                type="submit"
                value="check"
                class="btn btn-success"
                v-if="button_return == false"
                @click="check"
              />
              <button
                @click="go_return(key_lesson)"
                v-if="button_return == true"
                class="return btn"
                style="display: none"
              >
                {{ $t("return") }}
              </button>

              <button
                v-if="button_return == true"
                class="btn btn-success"
                @click="rel"
              >
                <i class="fa fa-redo"></i>{{ $t("agin") }}
              </button>
              <a v-if="run == true" class="return btn" style="display: none"
                >jj</a
              >
            </div>
          </div>
        </div>
      </div>
    </div>

    <div
      class="modal show"
      id="popup-examlesson"
      tabindex="-1"
      role="dialog"
      v-if="isModalexamlesson == true"
      aria-labelledby="myModalLabel"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-body">
            <div class="row">
              <h1>Quiz lesson</h1>
              <hr />
              <div v-for="(quiz, index) in quizLesson" v-bind:key="quiz.key">
                <h5>{{ quiz.question }}</h5>
                <div class="anser_parent">
                  <div
                    class="ans"
                    v-for="answers in quiz.answers"
                    v-bind:key="answers.key"
                  >
                    <input
                      v-bind:value="answers.key"
                      type="radio"
                      v-model="sortKey2[index]"
                    />

                    <label>{{ answers.answer }}</label>
                  </div>
                </div>
                <hr />
                <h5 v-html="arraycolor2[index]" :v-if="arraycolor2 != []"></h5>
              </div>

              <input
                type="submit"
                value="check"
                class="btn btn-success"
                v-if="button_return2 == false"
                @click="check2(courseDetails.owner)"
              />
              <button
                @click="go_return(key_lesson)"
                v-if="button_return2 == true"
                class="return btn"
                style="display: none"
              >
                {{ $t("return") }}
              </button>

              <button
                v-if="button_return2 == true"
                class="btn btn-success"
                @click="rel"
              >
                <i class="fa fa-redo"></i>{{ $t("agin") }}
              </button>
              <a v-if="run2 == true" class="return btn" style="display: none">
                jj
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div
      class="modal show"
      id="popup-exam"
      tabindex="-1"
      role="dialog"
      v-if="isModalexam == true"
      aria-labelledby="myModalLabel"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <span style="position: absolute; left: 12px">{{
              goToExam.title
            }}</span>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="frist_page" v-if="frist_page == true">
                <h4>
                  title : <span>{{ resultfinishExam.title }}</span>
                </h4>
                <h3>
                  {{ $t("score :") }}
                  <p>درجاتك</p>
                  <span
                    >{{ resultfinishExam.score }} /
                    {{ resultfinishExam.total }}</span
                  >
                  <p>Your score</p>
                </h3>
                <hr />
                <h4>
                  percentage : <span>{{ resultfinishExam.rate }}%</span>
                </h4>
                <button
                  class="btn btn-success"
                  @click="(isModalexam = false), (frist_page = false)"
                >
                  {{ $t("ok") }}
                </button>
              </div>
              <div class="second_page" v-if="second_page == true">
                <div class="row">
                  <div class="timer">
                    <span>Time:</span>
                    <VueCountdown
                      :time="goToExam.time * 60 * 1000"
                      v-slot="{ minutes, seconds }"
                    >
                      {{ minutes }} : {{ seconds }}
                    </VueCountdown>
                  </div>
                  <div
                    class="questions_and_ans"
                    v-for="(section, index) in goToExam.sections"
                    v-bind:key="section.key"
                    v-show="arryexamform[index]"
                  >
                    <h2>{{ section.title }}</h2>
                    <div
                      class=""
                      v-for="(qui, ind) in section.questions"
                      v-bind:key="qui.key"
                    >
                      <p>{{ qui.question }}</p>
                      <div class="anser_parent">
                        <div
                          class="ans"
                          v-for="ans in qui.answers"
                          v-bind:key="ans.key"
                        >
                          <input
                            v-bind:value="ans.key"
                            type="radio"
                            v-model="sections[index].questions[ind].answer"
                          />

                          <label>{{ ans.answer }}</label>
                        </div>
                      </div>
                    </div>

                    <div class="" v-if="index != goToExam.sections_count - 1">
                      <button
                        class="btn btn-success"
                        @click="arryexamformindex(index)"
                      >
                        {{ $t("Next") }}
                      </button>
                    </div>
                    <div
                      class="col-lg-12"
                      v-if="index == goToExam.sections_count - 1"
                    >
                      <input
                        type="submit"
                        value="check"
                        class="btn btn-success"
                        v-if="button_return2 == false"
                        @click="check3()"
                      />
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
      class="modal fade show"
      id="popup-paypal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="myModalLabel"
      v-if="isModalVisible == true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">PayPal</h5>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
              @click="isModalVisible = false"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div v-if="srclink != null">
              <iframe :src="srclink.link" frameborder="0"></iframe>
            </div>
          </div>
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-secondary"
              @click="isModalVisible = false"
            >
              {{ $t("Close") }}
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import axios from "axios";
// import exam from "../components/exam.vue";
import VueCountdown from "@chenfengyuan/vue-countdown";
export default {
  name: "course_detiles",
  components: { VueCountdown },
  data: function () {
    return {
      key: "1",
      courseDetails: null,
      lessonShow: {
        exam: null,
        key: null,
        material: null,
        name: null,
        nextLesson: null,
        objective: null,
        summary: null,
        video: null,
        prevTest: null,
      },
      owner_find: true,
      isModalVisible: false,
      srclink: null,
      closepopuplesson: false,
      isModalVisible2: false,
      isModalexamChapter: false,
      isModalexamlesson: false,
      someProperty: 1,
      quizChapter: null,
      answercorrect: [],
      sortKey: [],
      button_return: false,
      arraycolor: [],
      run: false,
      counter: 0,
      resultcorrect: null,
      result: 1,
      key_chapter: null,
      quizLesson: null,
      answercorrect2: [],
      sortKey2: [],
      button_return2: false,
      arraycolor2: [],
      run2: false,
      counter2: 0,
      resultcorrect2: null,
      result2: 1,
      goToExam: null,
      isModalexam: null,
      frist_page: false,
      second_page: true,
      arryexamform: [],
      sections: [],
      exam_key: null,
      resultfinishExam: null,
      listsection: "",
    };
  },
  created() {
    this.key_course = this.$route.params.key_course;
    this.slug_course = this.$route.params.slug_course;
    this.key_lesson = this.$route.params.key_lesson;
    this.image_course = this.$route.params.image_course;
  },
  mounted: function () {
    // console.log(this.key_course);

    // console.log(" localStorage.getItem('lang')");
    // console.log(localStorage.getItem("lang"));

    if (!this.key_course) {
      this.$router.back();
    }
    if (localStorage.getItem("token") != null) {
      axios
        .get(
          this.$api_url +
            "api/courseDetails/" +
            this.key_course +
            "?lang=" +
            localStorage.getItem("lang") +
            "&token=" +
            localStorage.getItem("token")
        )
        .then((response) => {
          this.courseDetails = response.data.data;

          // console.log("this.courseDetails");
          // console.log(this.courseDetails);
          //////////////lesson///////////////////////////
          if (
            this.courseDetails.currentLessonKey != null &&
            this.key_lesson == null
          ) {
            axios
              .get(
                this.$api_url +
                  "api/lessonShow/" +
                  this.courseDetails.currentLessonKey +
                  "?lang=" +
                  localStorage.getItem("lang") +
                  "&token=" +
                  localStorage.getItem("token")
              )
              .then((response) => {
                this.lessonShow = response.data.data;
                // console.log("this.lessonShow");
                // console.log(this.lessonShow);
                if (this.lessonShow.prevTest != null) {
                  this.$fire({
                    title: "You Must ",
                    text: "solve Quiz About the before Chapter",
                    type: "question",
                  }).then(() => {
                    axios
                      .get(
                        this.$api_url +
                          "api/quizChapter/" +
                          this.lessonShow.prevTest +
                          "?lang=" +
                          localStorage.getItem("lang") +
                          "&token=" +
                          localStorage.getItem("token")
                      )
                      .then((response) => {
                        this.quizChapter = response.data.data;
                        // console.log("this.quizChapter");
                        // console.log(this.quizChapter);
                      });
                    this.isModalexamChapter = true;
                  });
                }
                this.key_lesson = null;
              });
          } else if (this.key_lesson != null) {
            axios
              .get(
                this.$api_url +
                  "api/lessonShow/" +
                  this.key_lesson +
                  "?lang=" +
                  localStorage.getItem("lang") +
                  "&token=" +
                  localStorage.getItem("token")
              )
              .then((response) => {
                this.lessonShow = response.data.data;
                // console.log("this.lessonShow");
                // console.log(this.lessonShow);
                if (this.lessonShow.prevTest != null) {
                  this.$fire({
                    title: "You Must ",
                    text: "solve Quiz About the before Chapter",
                    type: "question",
                  }).then(() => {
                    axios
                      .get(
                        this.$api_url +
                          "api/quizChapter/" +
                          this.lessonShow.prevTest +
                          "?lang=" +
                          localStorage.getItem("lang") +
                          "&token=" +
                          localStorage.getItem("token")
                      )
                      .then((response) => {
                        this.quizChapter = response.data.data;
                        // console.log("this.quizChapter");
                        // console.log(this.quizChapter);
                      });
                    this.isModalexamChapter = true;
                  });
                }
              });
          } else {
            this.$fire({
              title: "not have lesson",
              type: "error",
            });
            // console.log("this.lessonShow");
            // console.log(this.lessonShow);
            this.$router.back();
          }
          if (
            this.courseDetails.placementTest != null &&
            this.courseDetails.owner == true
          ) {
            axios
              .get(
                this.$api_url +
                  "api/goToExam/" +
                  this.courseDetails.placementTest +
                  "?lang=" +
                  localStorage.getItem("lang") +
                  "&token=" +
                  localStorage.getItem("token")
              )
              .then((response) => {
                this.goToExam = response.data.data;

                // console.log("goToExam");
                // console.log(this.goToExam);
                this.exam_key = this.goToExam.key;

                this.$fire({
                  title: "title : " + this.goToExam.title,
                  html: "<p>time: " + this.goToExam.time + " minute  </p>",
                  // +
                  // "<p>sections:-</p>" +
                  // this.listsection,
                  type: "question",
                  confirmButtonText: "Start",
                }).then(() => {
                  this.isModalexam = true;
                  this.timerequest(this.goToExam.time);
                });
                // console.log(
                //   "this.goToExam.sections_count",
                //   this.goToExam.sections_count
                // );
                for (var i = 0; i < this.goToExam.sections_count; i++) {
                  this.sections.push({
                    section: this.goToExam.sections[i].key,
                    questions: [],
                  });

                  this.listsection =
                    "<p>" + this.goToExam.sections[i].title + "</p>";
                  if (i == 0) {
                    this.arryexamform[i] = true;
                  } else {
                    this.arryexamform[i] = false;
                  }
                }

                for (var x = 0; x < this.goToExam.sections_count; x++) {
                  for (
                    var i2 = 0;
                    i2 < this.goToExam.sections[x].questions.length;
                    i2++
                  ) {
                    this.sections[x].questions.push({
                      question: this.goToExam.sections[x].questions[i2].key,
                      answer: null,
                    });
                  }
                }
              });
          }
        });
    } else {
      axios
        .get(
          this.$api_url +
            "api/courseDetails/" +
            this.key_course +
            "?lang=" +
            localStorage.getItem("lang") +
            "&token=" +
            localStorage.getItem("token")
        )
        .then((response) => {
          this.courseDetails = response.data.data;
          // // console.log("this.courseDetails");
          // // console.log(this.courseDetails);
          //////////////lesson///////////////////////////
          if (this.courseDetails.currentLessonKey != null) {
            axios
              .get(
                this.$api_url +
                  "api/lessonShow/" +
                  this.courseDetails.currentLessonKey +
                  "?lang=" +
                  localStorage.getItem("lang")
              )
              .then((response) => {
                this.lessonShow = response.data.data;
                // console.log("this.lessonShow");
                // console.log(this.lessonShow);
                if (this.lessonShow.prevTest != null) {
                  this.$fire({
                    title: "You Must ",
                    text: "solve Quiz About the before Chapter",
                    type: "question",
                  }).then(() => {
                    axios
                      .get(
                        this.$api_url +
                          "api/quizChapter/" +
                          this.lessonShow.prevTest +
                          "?lang=" +
                          localStorage.getItem("lang") +
                          "&?token=" +
                          localStorage.getItem("token")
                      )
                      .then((response) => {
                        this.quizChapter = response.data.data;
                        // console.log("this.quizChapter");
                        // console.log(this.quizChapter);
                      });
                    this.isModalexamChapter = true;
                  });
                }
              });
          } else {
            this.$fire({
              title: "not have lesson",
              type: "error",
            });
            // console.log("this.lessonShow");
            // console.log(this.lessonShow);
            this.$router.back();
          }
        });
    }
  },
  methods: {
    getsecond_lesson: function (second_lesson, owner_course) {
      // console.log("your key" + second_lesson);
      if (localStorage.getItem("token") != null) {
        if (owner_course == true) {
          //////////////lesson///////////////////////////
          axios
            .get(
              this.$api_url +
                "api/lessonShow/" +
                second_lesson +
                "?lang=" +
                localStorage.getItem("lang") +
                "&token=" +
                localStorage.getItem("token")
            )
            .then((response) => {
              this.lessonShow = response.data.data;
              // console.log("this.lessonShow2");
              // console.log(this.lessonShow);
              this.courseDetails.currentLessonKey = this.lessonShow.key;
              this.key_lesson = this.lessonShow.key;
              if (this.lessonShow.prevTest != null) {
                this.$fire({
                  title: "You Must ",
                  text: "solve Quiz About the before Chapter",
                  type: "question",
                }).then(() => {
                  axios
                    .get(
                      this.$api_url +
                        "api/quizChapter/" +
                        this.lessonShow.prevTest +
                        "?lang=" +
                        localStorage.getItem("lang") +
                        "&token=" +
                        localStorage.getItem("token")
                    )
                    .then((response) => {
                      this.quizChapter = response.data.data;
                      // console.log("this.quizChapter");
                      // console.log(this.quizChapter);
                    });
                  this.isModalexamChapter = true;
                });
              }
            });
        } else {
          this.$fire({
            title: "please buy Course first",
            type: "error",
          });
        }
      } else {
        this.$fire({
          title: "login or register",
          type: "error",
        });
        this.showModal = true;
      }
    },
    getsecond_lesson_exam: function (owner_course, keylesson) {
      if (localStorage.getItem("token") != null) {
        if (owner_course == true) {
          this.isModalVisible2 = false;
          this.isModalVisible = false;
          this.isModalexamlesson = true;
          this.$fire({
            title: "You Must ",
            text: "solve Quiz About the this lesson",
            type: "question",
          }).then(() => {
            axios
              .get(
                this.$api_url +
                  "api/quizLesson/" +
                  keylesson +
                  "?lang=" +
                  localStorage.getItem("lang") +
                  "&token=" +
                  localStorage.getItem("token")
              )
              .then((response) => {
                this.quizLesson = response.data.data;
                // console.log("this.quizLesson");
                // console.log(this.quizLesson);
              });
            axios
              .get(
                this.$api_url +
                  "api/footer?lang=" +
                  localStorage.getItem("lang")
              )
              .then((response) => {
                this.footer = response.data.data;
              });
          });
        } else {
          this.$fire({
            title: "please buy Course first",
            type: "error",
          });
        }
      } else {
        this.$fire({
          title: "login or register",
          type: "error",
        });
      }
    },
    checkBuy: function (keycourse) {
      // console.log("the key is" + keycourse);
      if (localStorage.getItem("token") != null) {
        this.isModalVisible = true;
        axios
          .get(
            this.$api_url +
              "api/payment/" +
              keycourse +
              "?lang=" +
              localStorage.getItem("lang") +
              "&token=" +
              localStorage.getItem("token")
          )
          .then((response) => {
            this.srclink = response.data.data;
            // console.log("this.srclink");
            // console.log(this.srclink);
            if (this.show) {
              document.getElementById("loading").classList.remove("hide");
            } else {
              setTimeout(function () {
                document.getElementById("loading").classList.add("hide");
                setTimeout(function () {
                  document.getElementById("loading").classList.add("esconder");
                }, 2000);
              }, 3000);
            }
          });
      } else {
        this.$fire({
          title: "login or register",
          type: "error",
        });
        this.showModal = true;
      }
    },
    check: function () {
      for (var i = 0; i < this.quizChapter.length; i++) {
        if (this.sortKey[i] == this.quizChapter[i].correct_answer) {
          this.run = true;
          this.counter++;
          this.arraycolor[
            i
          ] = `<p style='color:green;font-size: 19px;width: 100%;padding: 10px 0px;'><i class='fa fa-check'></i>correct answer</p>`;
        } else {
          this.button_return = true;
          this.arraycolor[
            i
          ] = `<p style='color:red;font-size: 19px;width: 100%;padding: 10px 0px;'><i class='fa fa-times'></i>un correct answer</p>`;
        }
      }
      // console.log("counter" + this.counter);
      if (this.counter == this.quizChapter.length) {
        var chapterKey = this.key_chapter;
        if (this.lessonShow.prevTest != null) {
          chapterKey = this.lessonShow.prevTest;
        }
        axios
          .post(
            this.$api_url +
              "api/resultQuiz?lang=" +
              localStorage.getItem("lang") +
              "&token=" +
              localStorage.getItem("token"),
            {
              result: this.result,
              chapter_key: chapterKey,
            }
          )
          .then((response) => {
            this.resultcorrect = response.data.data;
            // console.log("this.resultcorrect");
            // console.log(this.resultcorrect);

            this.isModalexamChapter = false;
            this.$fire({
              title: "You have successfully passed the test",
              type: "success",
            });
          });

        this.counter = 0;
      }
    },
    check2: function (owner_course) {
      for (var i = 0; i < this.quizLesson.length; i++) {
        if (this.sortKey2[i] == this.quizLesson[i].correct_answer) {
          this.run2 = true;
          this.counter2++;
          this.arraycolor2[
            i
          ] = `<p style='color:green;font-size: 19px;text-align: center;'><i class='fa fa-check'></i>correct answer</p>`;
        } else {
          this.button_return2 = true;
          this.arraycolor2[
            i
          ] = `<p style='color:red;font-size: 19px;text-align: center;'><i class='fa fa-times'></i>un correct answer</p>`;
        }
      }
      if (this.counter2 == this.quizLesson.length) {
        // console.log(this.lessonShow.nextLesson);
        axios
          .post(
            this.$api_url +
              "api/resultQuiz?lang=" +
              localStorage.getItem("lang") +
              "&token=" +
              localStorage.getItem("token"),
            {
              result: this.result2,
              lesson_key: this.lessonShow.nextLesson,
            }
          )
          .then((response) => {
            this.resultcorrect2 = response.data.data;
            // console.log("this.resultcorrect2");
            // console.log(this.resultcorrect2);
            this.getsecond_lesson(this.lessonShow.nextLesson, owner_course);
            this.isModalexamlesson = false;
            this.$fire({
              title: "You have successfully passed the test",
              type: "success",
            });
            this.counter2 = 0;
            this.arraycolor2 = [];
          });
      }
    },
    check3: function () {
      // console.log("sections", JSON.stringify(this.sections));
      axios
        .post(
          this.$api_url +
            "api/finishExam?lang=" +
            localStorage.getItem("lang") +
            "&token=" +
            localStorage.getItem("token"),
          {
            exam_key: this.exam_key,
            result: JSON.stringify(this.sections),
          }
        )
        .then((response) => {
          this.resultfinishExam = response.data.data;
          this.resultfinishExam.rate = parseInt(this.resultfinishExam.rate);
          // console.log("resultfinishExam rate" + this.resultfinishExam.rate);
          this.second_page = false;
          this.frist_page = true;
        });
      this.sections = [];
      this.arryexamform = [];
    },
    rel: function () {
      location.reload();
    },
    funcQuize: function (key_chapter) {
      this.key_chapter = key_chapter;
      this.$fire({
        title: "You Must ",
        text: "solve Quiz About the before Chapter",
        type: "question",
      }).then(() => {
        axios
          .get(
            this.$api_url +
              "api/quizChapter/" +
              key_chapter +
              "?lang=" +
              localStorage.getItem("lang") +
              "&token=" +
              localStorage.getItem("token")
          )
          .then((response) => {
            this.quizChapter = response.data.data;
            // console.log("this.quizChapter");
            // console.log(this.quizChapter);
          });
        this.isModalexamChapter = true;
      });
    },
    timerequest: function (m) {
      setTimeout(() => {
        if (this.isModalexam == true) {
          this.check3();
        }
      }, m * 60 * 1000);
    },

    arryexamformindex: function (i) {
      if (this.arryexamform.length == i) {
        this.second_page = false;
      } else {
        var c = i + 1;
        for (var x = 0; x < this.arryexamform.length; x++) {
          this.arryexamform[x] = false;
          if (x == c) {
            this.arryexamform[x] = true;
          }
        }
        // console.log("arryexamform", this.arryexamform);
        this.second_page = false;
        this.second_page = true;
        return 0;
      }
    },
    examsections: function (exam) {
      axios
        .get(
          this.$api_url +
            "api/goToExam/" +
            exam +
            "?lang=" +
            localStorage.getItem("lang") +
            "&token=" +
            localStorage.getItem("token")
        )
        .then((response) => {
          this.goToExam = response.data.data;

          // console.log("goToExam");
          // console.log(this.goToExam);
          this.exam_key = this.goToExam.key;
          for (var i = 0; i < this.goToExam.sections_count; i++) {
            this.sections.push({
              section: this.goToExam.sections[i].key,
              questions: [],
            });

            this.listsection = "<p>" + this.goToExam.sections[i].title + "</p>";
            if (i == 0) {
              this.arryexamform[i] = true;
            } else {
              this.arryexamform[i] = false;
            }
          }
          this.$fire({
            title: "title : " + this.goToExam.title,
            html: "<p>time: " + this.goToExam.time + " minute  </p>",
            // "<p>sections:-</p>"
            //   +
            //   this.listsection,
            // type: "question",
            confirmButtonText: "Start",
          }).then(() => {
            this.isModalexam = true;
            this.second_page = true;
            this.timerequest(this.goToExam.time);
          });
          // console.log(
          //     "this.goToExam.sections_count",
          //     this.goToExam.sections_count
          //   );

          // console.log("sections", this.sections);
          for (var x = 0; x < this.goToExam.sections_count; x++) {
            for (
              var i2 = 0;
              i2 < this.goToExam.sections[x].questions.length;
              i2++
            ) {
              this.sections[x].questions.push({
                question: this.goToExam.sections[x].questions[i2].key,
                answer: null,
              });
            }
          }
        });
    },

    downloadWithVueResource() {
      axios
        .get(this.$api_url + "uploads/" + this.lessonShow.material, {
          responseType: "blob",
        })
        .then((response) => {
          const blob = new Blob([response.data], {
            type: "application/png/jpg",
          });
          const link = document.createElement("a");
          link.href = URL.createObjectURL(blob);
          link.download = this.$api_url + "uploads/" + this.lessonShow.material;
          link.click();
          URL.revokeObjectURL(link.href);
        })
        .catch
        // console.error
        ();
    },
    hideTeacherName(teacherKey) {
      var id = "teacherName_" + teacherKey;
      var teacherName = document.getElementById(id);
      teacherName.style.display = "none";
    },
    showTeacherName(teacherKey) {
      var id = "teacherName_" + teacherKey;
      var teacherName = document.getElementById(id);
      teacherName.style.display = "inline flow-root";
    },
  },
};
</script>
