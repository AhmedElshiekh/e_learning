<template>
  <div id="app">
    <div class="headernav" style="">
      <!-- Start Navigation -->

      <div class="navbar_top">
        <div class="container">
          <ul>
            <li>
              <input
                type="submit"
                value="English"
                @click="handleChange('en')"
                v-if="lang2"
                class="btn langbtn"
              />
              <input
                type="submit"
                value="عربى"
                @click="handleChange('ar')"
                v-if="lang1"
                class="btn langbtn"
              />
            </li>
            <li v-if="footer.facebook != null">
              <a :href="footer.facebook">
                <svg
                  viewBox="-110 1 511 511.99996"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    d="m180 512h-81.992188c-13.695312 0-24.835937-11.140625-24.835937-24.835938v-184.9375h-47.835937c-13.695313 0-24.835938-11.144531-24.835938-24.835937v-79.246094c0-13.695312 11.140625-24.835937 24.835938-24.835937h47.835937v-39.683594c0-39.347656 12.355469-72.824219 35.726563-96.804688 23.476562-24.089843 56.285156-36.820312 94.878906-36.820312l62.53125.101562c13.671875.023438 24.792968 11.164063 24.792968 24.835938v73.578125c0 13.695313-11.136718 24.835937-24.828124 24.835937l-42.101563.015626c-12.839844 0-16.109375 2.574218-16.808594 3.363281-1.152343 1.308593-2.523437 5.007812-2.523437 15.222656v31.351563h58.269531c4.386719 0 8.636719 1.082031 12.289063 3.121093 7.878906 4.402344 12.777343 12.726563 12.777343 21.722657l-.03125 79.246093c0 13.6875-11.140625 24.828125-24.835937 24.828125h-58.46875v184.941406c0 13.695313-11.144532 24.835938-24.839844 24.835938zm-76.8125-30.015625h71.632812v-193.195313c0-9.144531 7.441407-16.582031 16.582032-16.582031h66.726562l.027344-68.882812h-66.757812c-9.140626 0-16.578126-7.4375-16.578126-16.582031v-44.789063c0-11.726563 1.191407-25.0625 10.042969-35.085937 10.695313-12.117188 27.550781-13.515626 39.300781-13.515626l36.921876-.015624v-63.226563l-57.332032-.09375c-62.023437 0-100.566406 39.703125-100.566406 103.609375v53.117188c0 9.140624-7.4375 16.582031-16.578125 16.582031h-56.09375v68.882812h56.09375c9.140625 0 16.578125 7.4375 16.578125 16.582031zm163.0625-451.867187h.003906zm0 0"
                  />
                </svg>
              </a>
            </li>
            <li v-if="footer.whatsapp != null">
              <a
                :href="'https://api.whatsapp.com/send?phone=' + footer.whatsapp"
              >
                <svg
                  id="Bold"
                  enable-background="new 0 0 24 24"
                  height="512"
                  viewBox="0 0 24 24"
                  width="512"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    d="m17.507 14.307-.009.075c-2.199-1.096-2.429-1.242-2.713-.816-.197.295-.771.964-.944 1.162-.175.195-.349.21-.646.075-.3-.15-1.263-.465-2.403-1.485-.888-.795-1.484-1.77-1.66-2.07-.293-.506.32-.578.878-1.634.1-.21.049-.375-.025-.524-.075-.15-.672-1.62-.922-2.206-.24-.584-.487-.51-.672-.51-.576-.05-.997-.042-1.368.344-1.614 1.774-1.207 3.604.174 5.55 2.714 3.552 4.16 4.206 6.804 5.114.714.227 1.365.195 1.88.121.574-.091 1.767-.721 2.016-1.426.255-.705.255-1.29.18-1.425-.074-.135-.27-.21-.57-.345z"
                  />
                  <path
                    d="m20.52 3.449c-7.689-7.433-20.414-2.042-20.419 8.444 0 2.096.549 4.14 1.595 5.945l-1.696 6.162 6.335-1.652c7.905 4.27 17.661-1.4 17.665-10.449 0-3.176-1.24-6.165-3.495-8.411zm1.482 8.417c-.006 7.633-8.385 12.4-15.012 8.504l-.36-.214-3.75.975 1.005-3.645-.239-.375c-4.124-6.565.614-15.145 8.426-15.145 2.654 0 5.145 1.035 7.021 2.91 1.875 1.859 2.909 4.35 2.909 6.99z"
                  />
                </svg>
              </a>
            </li>
            <li v-if="footer.instagram != null">
              <a :href="footer.instagram">
                <svg
                  height="511pt"
                  viewBox="0 0 511 511.9"
                  width="511pt"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    d="m510.949219 150.5c-1.199219-27.199219-5.597657-45.898438-11.898438-62.101562-6.5-17.199219-16.5-32.597657-29.601562-45.398438-12.800781-13-28.300781-23.101562-45.300781-29.5-16.296876-6.300781-34.898438-10.699219-62.097657-11.898438-27.402343-1.300781-36.101562-1.601562-105.601562-1.601562s-78.199219.300781-105.5 1.5c-27.199219 1.199219-45.898438 5.601562-62.097657 11.898438-17.203124 6.5-32.601562 16.5-45.402343 29.601562-13 12.800781-23.097657 28.300781-29.5 45.300781-6.300781 16.300781-10.699219 34.898438-11.898438 62.097657-1.300781 27.402343-1.601562 36.101562-1.601562 105.601562s.300781 78.199219 1.5 105.5c1.199219 27.199219 5.601562 45.898438 11.902343 62.101562 6.5 17.199219 16.597657 32.597657 29.597657 45.398438 12.800781 13 28.300781 23.101562 45.300781 29.5 16.300781 6.300781 34.898438 10.699219 62.101562 11.898438 27.296876 1.203124 36 1.5 105.5 1.5s78.199219-.296876 105.5-1.5c27.199219-1.199219 45.898438-5.597657 62.097657-11.898438 34.402343-13.300781 61.601562-40.5 74.902343-74.898438 6.296876-16.300781 10.699219-34.902343 11.898438-62.101562 1.199219-27.300781 1.5-36 1.5-105.5s-.101562-78.199219-1.300781-105.5zm-46.097657 209c-1.101562 25-5.300781 38.5-8.800781 47.5-8.601562 22.300781-26.300781 40-48.601562 48.601562-9 3.5-22.597657 7.699219-47.5 8.796876-27 1.203124-35.097657 1.5-103.398438 1.5s-76.5-.296876-103.402343-1.5c-25-1.097657-38.5-5.296876-47.5-8.796876-11.097657-4.101562-21.199219-10.601562-29.398438-19.101562-8.5-8.300781-15-18.300781-19.101562-29.398438-3.5-9-7.699219-22.601562-8.796876-47.5-1.203124-27-1.5-35.101562-1.5-103.402343s.296876-76.5 1.5-103.398438c1.097657-25 5.296876-38.5 8.796876-47.5 4.101562-11.101562 10.601562-21.199219 19.203124-29.402343 8.296876-8.5 18.296876-15 29.398438-19.097657 9-3.5 22.601562-7.699219 47.5-8.800781 27-1.199219 35.101562-1.5 103.398438-1.5 68.402343 0 76.5.300781 103.402343 1.5 25 1.101562 38.5 5.300781 47.5 8.800781 11.097657 4.097657 21.199219 10.597657 29.398438 19.097657 8.5 8.300781 15 18.300781 19.101562 29.402343 3.5 9 7.699219 22.597657 8.800781 47.5 1.199219 27 1.5 35.097657 1.5 103.398438s-.300781 76.300781-1.5 103.300781zm0 0"
                  />
                  <path
                    d="m256.449219 124.5c-72.597657 0-131.5 58.898438-131.5 131.5s58.902343 131.5 131.5 131.5c72.601562 0 131.5-58.898438 131.5-131.5s-58.898438-131.5-131.5-131.5zm0 216.800781c-47.097657 0-85.300781-38.199219-85.300781-85.300781s38.203124-85.300781 85.300781-85.300781c47.101562 0 85.300781 38.199219 85.300781 85.300781s-38.199219 85.300781-85.300781 85.300781zm0 0"
                  />
                  <path
                    d="m423.851562 119.300781c0 16.953125-13.746093 30.699219-30.703124 30.699219-16.953126 0-30.699219-13.746094-30.699219-30.699219 0-16.957031 13.746093-30.699219 30.699219-30.699219 16.957031 0 30.703124 13.742188 30.703124 30.699219zm0 0"
                  />
                </svg>
              </a>
            </li>
            <li v-if="footer.phone != null">
              <svg
                version="1.1"
                id="Capa_1"
                xmlns="http://www.w3.org/2000/svg"
                xmlns:xlink="http://www.w3.org/1999/xlink"
                x="0px"
                y="0px"
                viewBox="0 0 512 512"
                style="enable-background: new 0 0 512 512"
                xml:space="preserve"
              >
                <g>
                  <g>
                    <path
                      d="M366,0H146c-20.678,0-37.5,16.822-37.5,37.5v437c0,20.678,16.822,37.5,37.5,37.5h220c20.678,0,37.5-16.822,37.5-37.5v-437
			C403.5,16.822,386.678,0,366,0z M388.5,407H176c-4.142,0-7.5,3.358-7.5,7.5c0,4.142,3.358,7.5,7.5,7.5h212.5v52.5
			c0,12.407-10.093,22.5-22.5,22.5H146c-12.407,0-22.5-10.093-22.5-22.5V422H146c4.142,0,7.5-3.358,7.5-7.5
			c0-4.142-3.358-7.5-7.5-7.5h-22.5V75h265V407z M388.5,60h-265V37.5c0-12.407,10.093-22.5,22.5-22.5h220
			c12.407,0,22.5,10.093,22.5,22.5V60z"
                    />
                  </g>
                </g>
                <g>
                  <g>
                    <path
                      d="M286,30h-30c-4.142,0-7.5,3.358-7.5,7.5c0,4.142,3.358,7.5,7.5,7.5h30c4.142,0,7.5-3.358,7.5-7.5
			C293.5,33.358,290.142,30,286,30z"
                    />
                  </g>
                </g>
                <g>
                  <g>
                    <path
                      d="M256,437c-12.407,0-22.5,10.093-22.5,22.5c0,12.407,10.093,22.5,22.5,22.5s22.5-10.093,22.5-22.5
			C278.5,447.093,268.407,437,256,437z M256,467c-4.136,0-7.5-3.364-7.5-7.5s3.364-7.5,7.5-7.5s7.5,3.364,7.5,7.5
			S260.136,467,256,467z"
                    />
                  </g>
                </g>
                <g>
                  <g>
                    <circle cx="226" cy="37.5" r="7.5" />
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
              <span> {{ footer.phone }}</span>
            </li>
          </ul>
          <ul class="right_ul">
            <li v-on:click="openNav()">
              <i class="fa fa-search"></i>
            </li>
            <li class="login_click theme-bg" v-if="signinbutton">
              <a href="#" @click="showModal2 = true">
                <svg
                  version="1.1"
                  id="Capa_1"
                  xmlns="http://www.w3.org/2000/svg"
                  xmlns:xlink="http://www.w3.org/1999/xlink"
                  x="0px"
                  y="0px"
                  viewBox="0 0 512 512"
                  style="enable-background: new 0 0 512 512"
                  xml:space="preserve"
                >
                  <g>
                    <g>
                      <path
                        d="M367.57,256.909c-9.839-4.677-19.878-8.706-30.093-12.081C370.56,219.996,392,180.455,392,136C392,61.01,330.991,0,256,0
			c-74.991,0-136,61.01-136,136c0,44.504,21.488,84.084,54.633,108.911c-30.368,9.998-58.863,25.555-83.803,46.069
			c-45.732,37.617-77.529,90.086-89.532,147.743c-3.762,18.066,0.745,36.622,12.363,50.908C25.222,503.847,42.365,512,60.693,512
			H307c11.046,0,20-8.954,20-20c0-11.046-8.954-20-20-20H60.693c-8.538,0-13.689-4.766-15.999-7.606
			c-3.989-4.905-5.533-11.29-4.236-17.519c20.755-99.695,108.691-172.521,210.24-174.977c1.759,0.068,3.526,0.102,5.302,0.102
			c1.793,0,3.578-0.035,5.354-0.104c31.12,0.73,61.05,7.832,89.044,21.14c9.977,4.74,21.907,0.499,26.649-9.478
			C381.789,273.582,377.547,261.651,367.57,256.909z M260.878,231.877c-1.623-0.029-3.249-0.044-4.878-0.044
			c-1.614,0-3.228,0.016-4.84,0.046C200.465,229.35,160,187.312,160,136c0-52.935,43.065-96,96-96s96,43.065,96,96
			C352,187.299,311.555,229.329,260.878,231.877z"
                      />
                    </g>
                  </g>
                  <g>
                    <g>
                      <path
                        d="M492,397h-55v-55c0-11.046-8.954-20-20-20c-11.046,0-20,8.954-20,20v55h-55c-11.046,0-20,8.954-20,20
			c0,11.046,8.954,20,20,20h55v55c0,11.046,8.954,20,20,20c11.046,0,20-8.954,20-20v-55h55c11.046,0,20-8.954,20-20
			C512,405.954,503.046,397,492,397z"
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
                <span>
                  {{ $t("Sign Up") }}
                </span>
              </a>
            </li>
            <li class="login_click light" v-if="signinbutton">
              <a href="#" @click="showModal = true">
                <svg
                  height="512pt"
                  viewBox="0 -32 512.016 512"
                  width="512pt"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    d="m192 213.339844c-58.816406 0-106.667969-47.847656-106.667969-106.664063 0-58.816406 47.851563-106.6679685 106.667969-106.6679685s106.667969 47.8515625 106.667969 106.6679685c0 58.816407-47.851563 106.664063-106.667969 106.664063zm0-181.332032c-41.171875 0-74.667969 33.492188-74.667969 74.667969 0 41.171875 33.496094 74.664063 74.667969 74.664063s74.667969-33.492188 74.667969-74.664063c0-41.175781-33.496094-74.667969-74.667969-74.667969zm0 0"
                  />
                  <path
                    d="m368 448.007812h-352c-8.832031 0-16-7.167968-16-16v-74.667968c0-55.871094 45.460938-101.332032 101.332031-101.332032h181.335938c55.871093 0 101.332031 45.460938 101.332031 101.332032v74.667968c0 8.832032-7.167969 16-16 16zm-336-32h320v-58.667968c0-38.226563-31.105469-69.332032-69.332031-69.332032h-181.335938c-38.226562 0-69.332031 31.105469-69.332031 69.332032zm0 0"
                  />
                  <path
                    d="m496 218.675781h-181.332031c-8.832031 0-16-7.167969-16-16s7.167969-16 16-16h181.332031c8.832031 0 16 7.167969 16 16s-7.167969 16-16 16zm0 0"
                  />
                  <path
                    d="m410.667969 304.007812c-4.097657 0-8.191407-1.558593-11.308594-4.691406-6.25-6.253906-6.25-16.386718 0-22.636718l74.027344-74.027344-74.027344-74.027344c-6.25-6.25-6.25-16.382812 0-22.632812s16.382813-6.25 22.636719 0l85.332031 85.332031c6.25 6.25 6.25 16.386719 0 22.636719l-85.332031 85.332031c-3.136719 3.15625-7.234375 4.714843-11.328125 4.714843zm0 0"
                  />
                </svg>
                <span> {{ $t("login") }}</span>
              </a>
            </li>
            <li v-if="profile_show">
              <router-link to="/profile_user" tag="a" class="dropdown-item">
                <svg
                  version="1.1"
                  id="Capa_1"
                  xmlns="http://www.w3.org/2000/svg"
                  xmlns:xlink="http://www.w3.org/1999/xlink"
                  x="0px"
                  y="0px"
                  viewBox="0 0 512 512"
                  style="enable-background: new 0 0 512 512"
                  xml:space="preserve"
                >
                  <g>
                    <g>
                      <path
                        d="M437.02,330.98c-27.883-27.882-61.071-48.523-97.281-61.018C378.521,243.251,404,198.548,404,148
			C404,66.393,337.607,0,256,0S108,66.393,108,148c0,50.548,25.479,95.251,64.262,121.962
			c-36.21,12.495-69.398,33.136-97.281,61.018C26.629,379.333,0,443.62,0,512h40c0-119.103,96.897-216,216-216s216,96.897,216,216
			h40C512,443.62,485.371,379.333,437.02,330.98z M256,256c-59.551,0-108-48.448-108-108S196.449,40,256,40
			c59.551,0,108,48.448,108,108S315.551,256,256,256z"
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

                <span>{{ $t("Profile") }}</span>
              </router-link>
            </li>
            <li v-if="profile_show">
              <a class="dropdown-item" href="#" @click="postLogout">
                <svg
                  height="493pt"
                  viewBox="-15 -35 493.33522 493"
                  width="493pt"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    d="m412.902344-1.105469h-167.617188c-27.550781 0-50.074218 22.824219-50.074218 50.371094v44.515625c0 6.898438 5.59375 12.488281 12.492187 12.488281s12.488281-5.589843 12.488281-12.488281v-44.515625c.035156-13.890625 11.203125-25.191406 25.09375-25.390625h167.617188c13.777344 0 24.617187 11.617188 24.617187 25.390625v322.980469c.164063 13.691406-10.800781 24.921875-24.492187 25.082031h-167.738282c-13.835937-.050781-25.039062-11.25-25.097656-25.082031v-43.585938c0-6.902344-5.589844-12.492187-12.488281-12.492187s-12.492187 5.589843-12.492187 12.492187v43.585938c.074218 27.625 22.449218 49.996094 50.074218 50.0625h167.617188c27.496094-.101563 49.707031-22.484375 49.597656-49.984375v-323.058594c0-27.546875-22.046875-50.371094-49.597656-50.371094zm0 0"
                  />
                  <path
                    d="m42.871094 223.71875h295.601562c6.898438 0 12.492188-5.59375 12.492188-12.492188 0-6.894531-5.59375-12.488281-12.492188-12.488281h-298.375l64.082032-74.074219c4.519531-5.253906 3.957031-13.167968-1.246094-17.734374-5.191406-4.539063-13.078125-4.011719-17.613282 1.175781v.007812l-80.773437 93.035157c-2.976563 2.449218-4.652344 6.136718-4.54296875 9.984374.11718775 3.855469 2.00781275 7.441407 5.12890575 9.707032l80.78125 80.78125c4.878907 4.878906 12.789063 4.878906 17.660157 0 4.816406-4.726563 4.890625-12.453125.167969-17.269532-.054688-.050781-.109376-.105468-.167969-.160156zm0 0"
                  />
                </svg>
                <span>{{ $t("Logout") }}</span>
              </a>
            </li>
          </ul>
        </div>
      </div>
      <nav class="navbar navbar-expand-md">
        <hr />
        <div class="container">
          <a class="nav-brand">
            <router-link to="/" tag="li" exact>
              <img :src="$api_url + global_info.logo" class="logo" />
            </router-link>
          </a>
          <button
            class="navbar-toggler"
            type="button"
            data-toggle="collapse"
            data-target="#collapsibleNavbar"
          >
            <div class="mk-css-icon-menu">
              <i class="fa fa-bars"></i>
            </div>
          </button>
          <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <div class="right_div">
              <ul class="nav navbar-nav ul_list">
                <li>
                  <router-link to="/Courses" tag="a">{{
                    $t("Courses")
                  }}</router-link>
                </li>
                <li>
                  <router-link to="/Classes" tag="a">{{
                    $t("Group Classes")
                  }}</router-link>
                </li>
                <li>
                  <router-link to="/Instructors" tag="a"
                    >{{ $t("Our Teachers") }}
                  </router-link>
                </li>
                <li>
                  <router-link to="/aboutus" tag="a">
                    {{ $t("About Us") }}
                  </router-link>
                </li>
                <li>
                  <router-link to="/Contact_Us" tag="a">{{
                    $t("Contact us")
                  }}</router-link>
                </li>
              </ul>
              <ul class="nav navbar-nav ul_sign">
                <!-- <li class="login_click light" v-if="signinbutton">
                  <a href="#" @click="showModal = true">Sign in</a>
                </li>
                <li class="login_click theme-bg" v-if="signinbutton">
                  <a href="#" @click="showModal2 = true">Sign up</a>
                </li>
                <li v-if="profile_show">
                  <div class="dropdown">
                    <button
                      class="btn btn-secondary dropdown-toggle"
                      type="button"
                      id="dropdownMenu"
                      data-bs-toggle="dropdown"
                      aria-expanded="true"
                    >
                      <i class="fa fa-user"></i>
                    </button>
                    <ul
                      id="ul_form_droupdown"
                      class="dropdown-menu"
                      aria-labelledby="dropdownMenu"
                    >
                      <li>
                        <router-link
                          to="/profile_user"
                          tag="a"
                          class="dropdown-item"
                        >
                          My Profile
                        </router-link>
                      </li>
                      <li>
                        <a
                          class="dropdown-item"
                          onclick="return ajudaUpload();"
                          href="#"
                          v-on:click="postLogout"
                          >Logout</a
                        >
                      </li>
                    </ul>
                  </div>
                </li> -->
                <li class="login_click theme-bg theme-bg-privet">
                  <a href="#" @click="check_login">{{ $t("Private Class") }}</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </nav>
      <!-- End Navigation -->
    </div>
    <div class="headernav_mobile" style="">
      <div class="container">
        <div class="col-lg-12">
          <a class="nav-brand">
            <router-link to="/" tag="li" exact>
              <img :src="$api_url + global_info.logo" class="logo" />
            </router-link>
          </a>
          <button
            class="navbar-toggler"
            type="button"
            data-toggle="collapse"
            data-target="#collapsibleNavbar2"
          >
            <div class="mk-css-icon-menu">
              <i class="fa fa-bars"></i>
            </div>
          </button>
        </div>
        <div class="col-lg-12" style="text-align: center">
          <button
            class="login_click theme-bg theme-bg-privet"
            id="theme-bg-privet"
          >
            <a href="#" @click="showprived = true">{{ $t("Private Class") }}</a>
          </button>
        </div>
        <div class="collapse" id="collapsibleNavbar2">
          <div class="right_div">
            <ul class="nav navbar-nav ul_list">
              <li>
                <router-link to="/aboutus" tag="a">
                  {{ $t("About Us") }}
                </router-link>
              </li>
              <li>
                <router-link to="/Courses" tag="a"
                  >{{ $t("Courses") }}
                </router-link>
              </li>
              <li>
                <router-link to="/Classes" tag="a"
                  >{{ $t("Group Classes") }}
                </router-link>
              </li>
              <li>
                <router-link to="/Instructors" tag="a"
                  >{{ $t("Our Teachers") }}
                </router-link>
              </li>
              <li>
                <router-link to="/Contact_Us" tag="a">{{
                  $t("Contact us")
                }}</router-link>
              </li>
            </ul>
            <ul class="nav navbar-nav ul_sign">
              <li class="login_click light" v-if="signinbutton">
                <a href="#" @click="showModal = true">{{ $t("login") }}</a>
              </li>
              <li class="login_click theme-bg" v-if="signinbutton">
                <a href="#" @click="showModal2 = true">{{ $t("Sign up") }}</a>
              </li>
              <li v-if="profile_show">
                <div class="dropdown">
                  <button
                    class="btn btn-secondary dropdown-toggle"
                    type="button"
                    id="dropdownMenu"
                    data-bs-toggle="dropdown"
                    aria-expanded="true"
                    v-on:click="isHidden2 = !isHidden2"
                  >
                    <i class="fa fa-user"></i>
                  </button>
                  <ul
                    class="dropdown-menu"
                    aria-labelledby="dropdownMenu"
                    v-if="!isHidden2"
                  >
                    <li>
                      <router-link
                        to="/profile_user"
                        tag="a"
                        class="dropdown-item"
                      >
                        {{ $t("My Profile") }}
                      </router-link>
                    </li>
                    <li>
                      <a
                        class="dropdown-item"
                        href="#"
                        v-on:click="postLogout"
                        >{{ $t("Logout") }}</a
                      >
                    </li>
                  </ul>
                </div>
              </li>
              <li class="login_click">
                <input
                  type="submit"
                  value="English"
                  @click="handleChange('en')"
                  v-if="lang2"
                  class="btn langbtn"
                />
                <input
                  type="submit"
                  value="عربى"
                  @click="handleChange('ar')"
                  v-if="lang1"
                  class="btn langbtn"
                />
              </li>
            </ul>
          </div>
        </div>
      </div>
      <!-- End Navigation -->
    </div>
    <div class="clearfix"></div>
    <router-view />

     <v-footer>
      <!-- <Footer/> -->
      <footer>
        <div class="background_footer">
          <div class="row items ">
              <div class="col-md-6 animation_left">
                <div class="animation_left">
                  <img :src="$api_url + global_info.logo" class="logo" />
                </div>
                
              </div>
              <div class="col-md-6">
                <ul style="text-align: center; padding-top: 10px">
                  <li>
                    <a href="#"
                      ><img src="./assets/images/imagesicon1.png"
                    /></a>
                  </li>
                  <li>
                    <a href="#"
                      ><img src="./assets/images/imagesicon2.png"
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
            <div class="row">
              <div class="col-lg-6" style="text-align: center">
                <p style="font-size: 18px">
                  {{
                    $t(
                      "@Copyright 2021 Troom: All Rights Reserved Developed by"
                    )
                  }}
                  <a class="text-primary" href="https://aisent.net/">Aisent</a>
                </p>
              </div>
              <div class="col-lg-6">
                <p style="font-size: 18px">
                  <router-link class="text-white m-5" to="/privacy" tag="a">{{
                    $t("privacy")
                  }}</router-link>
                </p>
              </div>
            </div>
        </div>
      </footer>
      
    </v-footer>

    <section class="sign_in" id="SignIn" v-if="showModal">
      <div class="info">
        <i class="fa fa-close close" id="close" @click="showModal = false"></i>
        <div class="imglogo">
          <img :src="$api_url + global_info.logo" class="logo" />
        </div>
        <p class="p_2">
          {{
            $t(
              "you want a site to learn the English language better and easier"
            )
          }}
        </p>
        <form @submit="postDataSignin" method="post">
          <input
            type="email"
            name="email"
            :placeholder="$t('Email')"
            v-model="loginposts.email"
          />
          <div class="showpass">
            <a @click="changeType()"><i class="fa fa-eye"></i></a>
            <input
              :type="filedType"
              name="Password"
              :placeholder="$t('Password')"
              v-model="loginposts.password"
            />
          </div>

          <span v-if="error != null" style="display: block; color: red">
            {{ error }}
          </span>
          <input type="submit" name="" :value="$t('login')" />
          <div class="row row_div">
            <!-- <div class="col-lg-6">
              <a
                href="#"
                id="forget"
                @click="
                  (showModal3 = true), (showModal = false), (showModal2 = false)
                "
                ><p>Forget Password</p></a
              >
            </div> -->
            <div class="col-lg-6">
              <a
                href="#"
                id="signup_link"
                @click="
                  (showModal2 = true), (showModal = false), (showModal3 = false)
                "
                ><p>{{ $t("Create a new account") }}</p></a
              >
            </div>
          </div>
        </form>
      </div>
    </section>

    <section class="sign_in" id="SignUp" v-if="showModal2">
      <div class="info">
        <i
          class="fa fa-close close"
          id="close2"
          @click="showModal2 = false"
        ></i>
        <div class="imglogo">
          <img :src="$api_url + global_info.logo" class="logo" />
        </div>
        <p class="p_2">
          {{
            $t(
              "you want a site to learn the English language better and easier"
            )
          }}
        </p>
        <form @submit="postDataSignup">
          <input
            type="text"
            name=""
            :placeholder="$t('Full Name')"
            v-model="register.name"
          />
          <input
            type="text"
            name=""
            :placeholder="$t('Email')"
            v-model="register.email"
          />
          <input
            type="password"
            name=""
            :placeholder="$t('Password')"
            v-model="register.password"
          />
          <input
            type="password"
            name=""
            :placeholder="$t('Confirm Password')"
            v-model="register.password_confirmation"
          />
          <vue-tel-input
            v-model="register.phone"
            mode="international"
            autofocus="true"
            autocomplete="true"
            required
            country-changed
          >
          </vue-tel-input>

          <span v-if="error != null" style="display: block; color: red">
            {{ error }}
          </span>
          <div class="row_div">
            <input
              type="submit"
              name=""
              :value="$t('Register')"
              @click="register.type = 'student'"
            />
          </div>
        </form>
      </div>
    </section>

    <section class="sign_in" id="forget_pass1" v-if="showModal3">
      <div class="info">
        <i
          class="fa fa-close close"
          id="close3"
          @click="showModal3 = false"
        ></i>
        <div class="imglogo">
          <img :src="$api_url + global_info.logo" class="logo" />
        </div>
        <p class="p_1">Forget Your Password?</p>
        <p class="p_2">
          Enter your email or phone number and recover your account
        </p>
        <input type="phone" name="" placeholder="Phone" />
        <input type="submit" name="" value="دخول" />
        <a href="#" @click="(showemail = true), (showModal3 = false)"
          >Forget Phone Number</a
        >
      </div>
    </section>
    <section class="sign_in" id="forget_pass" v-if="showModal4 == true">
      <div class="info">
        <i
          class="fa fa-close close"
          id="close3"
          @click="showModal4 = false"
        ></i>
        <div class="imglogo">
          <img :src="$api_url + global_info.logo" class="logo" />
        </div>
        <p class="p_1">{{ $t("code ?") }}</p>
        <p class="p_2">{{ $t("must be 6 number") }}</p>

        <form @submit="verificationfun(user_key, code_number)">
          <input
            type="text"
            name=""
            placeholder="xxx xxx"
            maxlength="6"
            minlength="6"
            required
            v-model="code_number"
          />
          <input type="submit" name="" value="send" />
        </form>
        <a href="#" @click="resendVerifyCode(user_key)">{{ $t("resent") }}</a>
      </div>
    </section>
    <section class="sign_in" v-if="showemail">
      <div class="info">
        <i class="fa fa-close close" id="close3" @click="showemail = false"></i>
        <div class="imglogo">
          <img src="./assets/images/logo.png" class="logo" />
        </div>
        <p class="p_1">Forget Phone Number?</p>
        <p class="p_2">
          Enter your email or phone number and recover your account
        </p>
        <input type="email" name="" placeholder="Email" />
        <input type="submit" name="" value="دخول" />
      </div>
    </section>

    <section class="sign_in" id="privet_class" v-if="showprived">
      <div class="info">
        <i
          class="fa fa-close close"
          id="close3"
          @click="showprived = false"
        ></i>
        <!-- <span>Prived Class</span>
        <hr style="    margin: 0px;"> -->
        <div class="time_input">
          <label>{{ $t("Choose Teatcher :-") }}</label>
          <select
            aria-placeholder="Choose Teatcher"
            v-model="privetClass.teacher_id"
            @change="coursesofTeaacher(privetClass.teacher_id)"
          >
            <option value="" disabled>{{ $t("Choose Teacher") }}</option>
            <option
              v-for="teacher in teachers"
              v-bind:key="teacher.key"
              :value="teacher.key"
            >
              {{ teacher.name }}
            </option>
          </select>
        </div>
        <div class="time_input">
          <label>{{ $t("Choose Courses :-") }}</label>
          <select
            aria-placeholder="Choose Teatcher"
            v-model="privetClass.course_id"
          >
            <option value="" disabled>{{ $t("Choose Courses") }}</option>
            <option
              v-for="Courseteacher in coursesTeaacher"
              v-bind:key="Courseteacher.key"
              :value="Courseteacher.key"
            >
              {{ Courseteacher.name }}
            </option>
          </select>
        </div>

        <div class="">
          <label>{{ $t("Enter the appropriate Date :-") }}</label>
          <input
            type="date"
            name=""
            value="time"
            v-model="privetClass.start_date"
          />
          <div class="time_input">
            <label>{{ $t("Saturday") }}</label>
            <input type="time" name="" v-model="privetClass.sat" />
          </div>
          <div class="time_input">
            <label>{{ $t("Sunday") }}</label>
            <input type="time" name="" v-model="privetClass.sun" />
          </div>
          <div class="time_input">
            <label>{{ $t("Monday") }}</label>
            <input type="time" name="" v-model="privetClass.mon" />
          </div>
          <div class="time_input">
            <label>{{ $t("Tuesday") }}</label>
            <input type="time" name="" v-model="privetClass.tue" />
          </div>
          <div class="time_input">
            <label>{{ $t("Wednesday") }}</label>
            <input type="time" name="" v-model="privetClass.wed" />
          </div>
          <div class="time_input">
            <label>{{ $t("Thursday") }}</label>
            <input type="time" name="" v-model="privetClass.thu" />
          </div>
          <div class="time_input">
            <label>{{ $t("Friday") }}</label>
            <input type="time" name="" v-model="privetClass.fri" />
          </div>

          <div class="time_input">
            <label>{{ $t("Note : -") }}</label>

            <textarea v-model="privetClass.note"> </textarea>
          </div>
        </div>

        <input type="submit" name="" :value="$t('ok')" @click="classRequest" />
      </div>
    </section>

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
    <!----------------------------------scrooltop-------------------->
    <div id="scrollToTop" @click="toTop">
      <svg
        fill="#ffffff"
        height="48"
        viewBox="0 0 24 24"
        width="48"
        xmlns="http://www.w3.org/2000/svg"
      >
        <path d="M7.41 15.41L12 10.83l4.59 4.58L18 14l-6-6-6 6z" />
        <path d="M0 0h24v24H0z" fill="none" />
      </svg>
    </div>
    <vueSimpleSpinner id="loading" v-if="isLoading == true"></vueSimpleSpinner>
  </div>
</template>
<script>
import axios from "axios";
import vueSimpleSpinner from "vue-simple-spinner";
//import loadingscreen from 'vuejs-loading-screen';

import Vue from "vue";
import VueTelInput from "vue-tel-input";
import "vue-tel-input/dist/vue-tel-input.css";
import VueI18n from "vue-i18n";
import Tawk from 'vue-echo';
// import Footer from "./components/Footer";
// import Tawk from 'vue-tawk';

Vue.use(Tawk, {
    tawkSrc: 'https://embed.tawk.to/610fb065649e0a0a5cd01b1b/1fciki4dc'
})

Vue.use(VueI18n);

Vue.use(VueTelInput);

// import VuePhoneNumberInput from "vue-phone-number-input";
// import "vue-phone-number-input/dist/vue-phone-number-input.css";
export default {
  name: "app",

  components: {
    vueSimpleSpinner,
    // Footer
  },
  data: function () {
    return {
      website_name:null,
      loginposts: {
        email: null,
        password: null,
      },
      register: {
        name: null,
        email: null,
        password: null,
        password_confirmation: null,
        phone: null,
        type: null,
      },
      isHidden: true,
      isHidden2: true,
      showModal: false,
      footer: {
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
      showModal2: false,
      showModal3: false,
      showModal4: false,
      showemail: false,
      signinbutton: true,
      profile_show: false,
      filedType: "password",
      login: null,
      error: null,
      token: "{{ csrf_token() }}",
      profile: null,
      global_info: null,
      name_title: null,
      drop_out: true,
      code_number: null,
      user_key: 0,
      check: null,
      lang: "ar",
      showprived: false,
      teachers: null,
      coursesTeaacher: [],
      privetClass: {
        teacher_id: null,
        course_id: null,
        note: null,
        sat: null,
        sun: null,
        mon: null,
        tue: null,
        wed: null,
        thu: null,
        fri: null,
      },
      lang1: false,
      lang2: true,
      isLoading: true,
      categoriesFilter: [],
    };
  },
//   metaInfo() {
//         return {
//             title: `${this.$route.meta.title}`
//         }
//     },
  mounted() {
    //    if (this.show) {
    //   this.show = false;
    // } else {
    //   setTimeout(function () {
    //     document.getElementById("loading").classList.add("hide");
    //     setTimeout(function () {
    //       document.getElementById("loading").classList.add("esconder");
    //     }, 1000);
    //   }, 2000);
    // }
    setTimeout(() => {
      this.isLoading = false;
    }, 3000);

    if (localStorage.getItem("lang") == "ar") {
      this.lang1 = false;
      this.lang2 = true;
    }
    if (localStorage.getItem("lang") == "en") {
      this.lang2 = false;
      this.lang1 = true;
    }
    axios
      .post(this.$api_url + "api/check?token=" + localStorage.getItem("token"))
      .then((response) => {
        this.check = response.data.data;
        if (this.check.token_work != true) {
          localStorage.removeItem("token");
          this.signinbutton = true;
          this.profile_show = false;
        } else {
          this.signinbutton = false;
          this.profile_show = true;
        }
      });
    axios
      .get(this.$api_url + "api/global?lang=" + localStorage.getItem("lang"))
      .then((response) => {
        this.global_info = response.data.data;
        // console.log("this.global");
        // console.log(this.global_info.logo);
        // this.$route.meta.title = this.global_info.website_name;
        // this.website_name = this.global_info.website_name;
        // console.log(this.$route.meta.title);
      });

    axios
      .get(this.$api_url + "api/footer?lang=" + localStorage.getItem("lang"))
      .then((response) => {
        this.footer = response.data.data;
        // console.log(this.footer);
        this.show = true;
      })
      .catch(() => {
        this.show = true;
      });

    axios
      .get(this.$api_url + "api/teachers?lang=" + localStorage.getItem("lang"))
      .then((response) => {
        this.teachers = response.data.data;
        // console.log("this.teachers");
        // console.log(this.teachers);
      });
    axios
      .get(
        this.$api_url +
          "api/categoriesFilter?lang=" +
          localStorage.getItem("lang")
      )
      .then((response) => {
        this.categoriesFilter = response.data.data;
        // console.log(this.categoriesFilter);
      });
  },
  watch: {
    // $route: {
    //     immediate: true,
    //     handler(to,from) {
    //         document.title = to.name_title;
    //     }
    // },

    $route(to) {
      document.title = this.global_info.website_name +' - '+ to.meta.title || this.global_info.website_name;
    },
  },
  computed: {
    pageTitle: function () {
      return this.global_info.website_name;
    },
  },
  created() {
    document.title = this.global_info.website_name;
  },
  head: {
    link: [
      {
        rel: "icon",
        // href: require("./assets/logo.png"),
        // href: require("https://demo1.aisent.net/logo/logo-white4.png"),
        href: 'https://demo1.aisent.net/logo/logo-white4.png',
      },
    ],
  },
  methods: {
    handleChange: function (la) {
      localStorage.setItem("lang", la);
      window.location.reload();
    },
    handleScroll: function () {
      if (this.scTimer) return;
      this.scTimer = setTimeout(() => {
        this.scY = window.scrollY;
        clearTimeout(this.scTimer);
        this.scTimer = 0;
      }, 100);
    },
    toTop: function () {
      window.scrollTo({
        top: 0,
        behavior: "smooth",
      });
    },
    changeType: function () {
      this.filedType = this.filedType == "password" ? "text" : "password";
    },
    postDataSignin: function (e) {
      axios
        .post(this.$api_url + "api/login", this.loginposts)
        .then((response) => {
          localStorage.setItem("token", response.data.data.access_token);
          console.warn(response);
          this.profile = response;
          this.showModal = false;
          this.signinbutton = false;
          this.profile_show = true;
          this.$fire({
            title: "Successed Login",
            type: "success",
          }).then(() => {
            location.reload();
          });
        })
        .catch((error) => {
          if (error.response.data.data != null) {
            this.showModal = false;
            this.showModal4 = true;
            this.user_key = error.response.data.data.user_key;
          } else {
            this.error = error.response.data.massage;
          }
        });
      e.preventDefault();
    },
    postDataSignup: function (e) {
      // console.log("this.register.type");
      // console.log(this.register.type);
      this.register.phone;
      axios
        .post(this.$api_url + "api/register", this.register)
        .then((response) => {
          // localStorage.setItem("token", response.data.data.access_token);
          console.warn(response);
          // console.log(response);
          this.showModal2 = false;
          this.signinbutton = false;
          axios
            .post(this.$api_url + "api/login", this.register)
            .then((response) => {
              localStorage.setItem("token", response.data.data.access_token);
              console.warn(response);
              this.profile = response;
              this.showModal = false;
              this.signinbutton = false;
              this.profile_show = true;
              this.$fire({
                title: "Successed Login",
                type: "success",
              }).then(() => {
                location.reload();
              });
            })
            .catch((error) => {
              if (error.response.data.data != null) {
                this.showModal = false;
                this.showModal4 = true;
                this.user_key = error.response.data.data.user_key;
              } else {
                this.error = error.response.data.massage;
              }
            });
          // location.reload();
        })
        .catch((error) => {
          this.error = error.response.data.massage;
        });
      e.preventDefault();
    },
    postLogout: function (e) {
      axios
        .post(
          this.$api_url + "api/logout?token=" + localStorage.getItem("token")
        )
        .then(() => {
          localStorage.removeItem("token");
          // console.log(response);
          this.showModal2 = false;
          this.signinbutton = true;
          this.profile_show = false;
          this.$fire({
            title: "Successed Logout",
            type: "success",
          }).then(() => {
            location.reload();
          });
        });
      e.preventDefault();
    },
    verificationfun: function (user_key, code) {
      // console.log("user_key" + user_key);
      // console.log("code_number" + code);
      if (user_key != 0) {
        axios
          .post(this.$api_url + "api/verification/" + user_key, {
            code: code,
          })
          .then((response) => {
            console.warn(response);
            // console.log(response);
            this.showModal4 = false;
            this.showModal = false;
            this.signinbutton = false;
            this.profile_show = true;
          });
      }
    },
    resendVerifyCode: function (user_key) {
      // console.log("user_key" + user_key);
      axios
        .post(this.$api_url + "api/resendVerifyCode/" + user_key)
        .then((response) => {
          console.warn(response);
          // console.log(response);
          this.showModal4 = false;
          this.profile_show = true;
          this.$fire({
            title: "has been sent",
            type: "success",
          });
        })
        .catch((error) => {
          console.warn(error);
        });
    },
    check_login: function () {
      if (localStorage.getItem("token") != null) {
        this.showprived = true;
      } else {
        this.$fire({
          title: "You must Login",
          type: "error",
        });
      }
    },
    coursesofTeaacher: function (key_Teacher) {
      axios
        .get(
          this.$api_url +
            "api/courseFromTeacher/" +
            key_Teacher +
            "?token=" +
            localStorage.getItem("token")
        )
        .then((response) => {
          this.coursesTeaacher = response.data.data;
          console.warn(response);
          // console.log(response);
          // console.log("coursesTeaacher");
          // console.log(this.coursesTeaacher);
        })
        .catch((error) => {
          console.warn(error);
        });
    },
    classRequest: function () {
      // console.log("privetClass");
      // console.log(this.privetClass);
      axios
        .post(
          this.$api_url +
            "api/classRequest?token=" +
            localStorage.getItem("token"),
          this.privetClass
        )
        .then((response) => {
          console.warn(response);
          // console.log(response);
          this.showprived = false;

          this.$fire({
            title: "Successed",
            type: "success",
          });
        })
        .catch((error) => {
          console.warn(error);
        });
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
      //  // console.log("this.arrayfillter");
      //  // console.log(this.arrayfillter);
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

<style lang="scss">
html:lang(ar) * {
  direction: rtl;
  .headernav .navbar_top,
  .contactus h1,
  .profile .body_profile .profile_items,
  .single_instructor .single_instructor_caption h4,
  .body_profile .viewer_detail_wraps .form-groups,
  .courses_page .row_bottom > div .pragraph,
  .courses .row_bottom > div .pragraph {
    text-align: right;
  }
  .courses_page .row_top p {
    float: right;
  }
  .headernav .navbar_top .right_ul,
  .nav.ul_sign {
    float: left;
  }
  .nav.ul_list {
    text-align: right;
    padding-right: 0px;
  }
  .courses .slick-slider .slick-track,
  .courses .slick-slider .slick-list {
    direction: ltr;
  }
  .courses_page .part .ul_profile,
  .courses .part .ul_profile {
    text-align: right;
    padding: 0px;
  }
  .courses_page .part .ul_clock,
  .courses .part .ul_clock {
    text-align: left;
    direction: ltr;
  }
  .animation_left {
    text-align: right;
    padding-right: 20px;
  }
  #popup-placement .modal-body {
    text-align: left;
    padding: 0px;
    padding-left: 33px;
    direction: ltr;
  }

  .about .work h2,
  .about .work p {
    text-align: right;
    padding-right: 10px;
  }
  .course_detiles .sec_detiles_course .sec_detiles_course_left .buy_ul {
    float: left;
    direction: ltr;
  }
  .course_detiles .sec_detiles_course .sec_detiles_course_left {
    text-align: right;
  }

  .lessons .lectures_lists div {
    text-align: right;
  }
  .lessons .lectures_lists_title {
    margin-right: 0pxs;
  }
  .course_detiles .div_title {
    text-align: right;
    padding-right: 90px;
    padding-left: 0px;
  }
  .profile #change_pass {
    margin-left: 10px;
  }
  .body_profile .caption {
    text-align: right;
  }
  .profile .classes h5,
  .body_profile .dashboard_container_body {
    text-align: right;
  }
  .lesson_myclass_student .add_course .up,
  .create_course .add_course .up,
  .show_course .add_course .up,
  .lesson_mycourse_show .add_course .up,
  .show_lesson .add_course .up,
  .edit_lesson .add_course .up,
  .add_lesson .add_course .up,
  .edit_course .add_course .up,
  .lesson_myclass .add_course .up,
  .lesson_myclass_student .add_course .up {
    text-align: right;
  }
  #privet_class label {
    text-align: right;
  }

  .profile .vti__dropdown {
    left: auto;
    right: 5px;
    bottom: 0px;
  }
  .profile .vti__input {
    text-align: left;
    direction: ltr;
  }
  .lessons .lectures_lists .next {
    text-align: left;
    display: block;
  }
  header .carousel-inner .carousel-item .word {
    width: 76%;
    text-align: right;
  }
  header .carousel-inner .carousel-item .word a i {
    margin-left: 0px;
    margin-right: 15px;
  }
  .sec_detiles_course {
    text-align: right;
  }
  .close_ar {
    position: absolute;
    left: 10px;
  }
  .courses_page .row_bottom > div .pragraph,
  .courses .row_bottom > div .pragraph {
    padding-right: 10px;
  }
  .classes .pragraph,
  .profile .dashboard_container_body .margin_used .pragraph {
    padding-left: 0px;
    text-align: right;
    padding-right: 20px;
  }
  .classes_detiles .sec_detiles_course_lesson {
  }
  .classes .info_lecture {
    float: left;
  }
  .classes .info_teatcher,
  .profile .dashboard_container_body .margin_used .info_teatcher {
    float: right;
  }
  // .second_page .section_second_page{
  //     text-align: left;
  // }
  #popup-materiers {
    text-align: right;
  }
  .profile .body_profile .itemul_profile li a i {
    margin-left: 10px;
  }
  .classes .foot_lecture {
    direction: ltr;
  }
  .sec_detiles_course .edu_wraper p {
    padding-right: 60px;
    padding-left: 0px;
  }
  .headernav_mobile .ul_sign button,
  .headernav_mobile .nav.ul_sign .theme-bg,
  .headernav_mobile .nav.ul_sign .light,
  .nav.ul_sign {
    text-align: center;
  }

  #Modaledite .btn-close {
    left: 18px;
    position: absolute;
  }
  #Modaledite .modal-body {
    text-align: right;
  }
  .courses_page .row_top .ul_filtter {
    float: left;
  }
  .courses_page .row_top .a_button {
    direction: ltr;
  }
  .fillter_nav .sidenav {
    right: 0px;
    left: auto;
  }
  .fillter_nav form ul {
    text-align: right;
  }
  .fillter_nav form .search_button {
    left: 19px;
    right: auto;
  }
  .fillter_nav .sidenav .closebtn {
    right: auto;
    left: -70px;
  }
  .profile .margin_used .scoremodel {
    right: auto;
    left: 0px;
  }
  #Modalescore .modal-body,
  #Modalescore p,
  #Modalescore,
  #Modalescore .modal-body div {
    direction: ltr;
  }
  .Instructorspage_div .h4{
    text-align: right;
  }
  .Instructorspage_div .row{
    direction: rtl;
  }
}
</style>
