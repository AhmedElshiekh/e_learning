import Vue from "vue";
import VueRouter from "vue-router";
import Home from "../views/Home.vue";

Vue.use(VueRouter);

const routes = [
  {
    path: "/",
    name: "Home",
    component: Home,
    meta:{title: 'home'},
  },
  {
    path: "/aboutus",
    name: "aboutus",
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    meta:{title: 'about us'},
    component: () =>
      import(/* webpackChunkName: "about" */ "../views/About.vue"),
  },
  {
    path: "/Courses",
    name: "Courses",
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    meta:{title: 'Courses'},
    component: () =>
      import(/* webpackChunkName: "about" */ "../views/Courses.vue"),
  },
  {
    path: "/Classes",
    name: "Classes",
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    meta:{title: 'Classes'},
    component: () =>
      import(/* webpackChunkName: "about" */ "../views/Classes.vue"),
  },
  {
    path: "/Instructors",
    name: "Instructors",
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    meta:{title: 'Instructors'},
    component: () =>
      import(/* webpackChunkName: "about" */ "../views/Instructors.vue"),
  },
  {
    path: "/Contact_Us",
    name: "Contact_Us",
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    meta:{title: 'Contact Us'},
    component: () =>
      import(/* webpackChunkName: "about" */ "../views/ContactUs.vue"),
  },
  {
    path: "/profile",
    name: "profile",
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    meta:{title: 'profile'},
    component: () =>
      import(/* webpackChunkName: "about" */ "../views/profile.vue"),
  },
  {
    path: "/course_detiles/:key_course/:slug_course",
    name: "course_detiles",
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    // meta:{title: "Course :slug_course"},
    component: () =>
      import(/* webpackChunkName: "about" */ "../views/course_detiles.vue"),
  },
  {
    path: "/profile_user",
    name: "profile_user",
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    meta:{title: 'profile_user'},
    component: () =>
      import(/* webpackChunkName: "about" */ "../views/profile_user.vue"),
  },
  {
    path: "/classes_detiles/:key_classes/:slug_classe/:image_classe",
    name: "classes_detiles",
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    // meta:{title: "Class :slug_classe"},
    component: () =>
      import(/* webpackChunkName: "about" */ "../views/classes_detiles.vue"),
  },
  // {
  //   path: "/create_course",
  //   name: "create_course",
  //   // route level code-splitting
  //   // this generates a separate chunk (about.[hash].js) for this route
  //   // which is lazy-loaded when the route is visited.
  //   component: () =>
  //     import(/* webpackChunkName: "about" */ "../views/create_course.vue"),
  // },
  {
    path: "/showCourse/:key_mycourse/:slug_mycourse/:image_mycourse",
    name: "showCourse",
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    meta:{title: 'Course'},
    component: () =>
      import(/* webpackChunkName: "about" */ "../views/showCourse.vue"),
  },
  // {
  //   path: "/edit_course/:slug_mycourse",
  //   name: "edit_course",
  //   // route level code-splitting
  //   // this generates a separate chunk (about.[hash].js) for this route
  //   // which is lazy-loaded when the route is visited.
  //   component: () =>
  //     import(/* webpackChunkName: "about" */ "../views/edit_course.vue"),
  // },
  {
    path: "/lesson_mycourse_show/:key_chapter",
    name: "lesson_mycourse_show",
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    meta:{title: 'Course lesson'},
    component: () =>
      import(
        /* webpackChunkName: "about" */ "../views/lesson_mycourse_show.vue"
      ),
  },
  {
    path: "/show_lesson/:key_lesson/:name_lesson",
    name: "show_lesson",
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    meta:{title: 'lesson'},
    component: () =>
      import(/* webpackChunkName: "about" */ "../views/show_lesson.vue"),
  },
  // {
  //   path: "/edite_lesson",
  //   name: "edite_lesson",
  //   // route level code-splitting
  //   // this generates a separate chunk (about.[hash].js) for this route
  //   // which is lazy-loaded when the route is visited.
  //   component: () =>
  //     import(/* webpackChunkName: "about" */ "../views/edite_lesson.vue"),
  // },

  // {
  //   path: "/add_lesson",
  //   name: "add_lesson",
  //   // route level code-splitting
  //   // this generates a separate chunk (about.[hash].js) for this route
  //   // which is lazy-loaded when the route is visited.
  //   component: () =>
  //     import(/* webpackChunkName: "about" */ "../views/add_lesson.vue"),
  // },

  {
    path: "/lesson_myclass/:key_classe",
    name: "lesson_myclass",
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    meta:{title: 'class lesson'},
    component: () =>
      import(/* webpackChunkName: "about" */ "../views/lesson_myclass.vue"),
  },

  {
    path: "/Meeting",
    name: "Meeting",
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    meta:{title: 'meeting'},
    component: () =>
      import(/* webpackChunkName: "about" */ "../views/Meeting.vue"),
  },

  {
    path: "/lesson_myclass_student/:key_classe",
    name: "lesson_myclass_student",
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    meta:{title: 'lesson class'},
    component: () =>
      import(
        /* webpackChunkName: "about" */ "../views/lesson_myclass_student.vue"
      ),
  },

  {
    path: "/lesson_myprivetclass_student/:key_classe",
    name: "lesson_myprivetclass_student",
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    meta:{title: 'lesson privet class'},
    component: () =>
      import(
        /* webpackChunkName: "about" */ "../views/lesson_myprivetclass_student.vue"
      ),
  },

  {
    path: "/lesson_myprivetclass/:key_classe",
    name: "lesson_myprivetclass",
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    meta:{title: 'courses'},
    component: () =>
      import(
        /* webpackChunkName: "about" */ "../views/lesson_myprivetclass.vue"
      ),
  },
  {
    path: "/search_fillter/:search_name",
    name: "search_fillter",
    // meta:{title: 'courses'},
    component: () =>
      import(/* webpackChunkName: "about" */ "../views/search_fillter.vue"),
  },
  {
    path: "/Instructorspage/:key_instructor",
    name: "Instructorspage",
    meta:{title: 'Instructorspage'},
    component: () =>
      import(/* webpackChunkName: "about" */ "../views/Instructorspage.vue"),
  },
];

const router = new VueRouter({
  mode: "history",
  base: process.env.BASE_URL,
  routes,
});

export default router;
