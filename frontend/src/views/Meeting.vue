<template>
  <div class="meeting">
    <div class="container-zoom">
      <ZoomFrame
        :nickname="nickname"
        :meetingId="meetingId"
        :password="password"
        :role="role"
        :api_key="api_key"
        :api_secret="api_secret"
      />
    </div>
  </div>
</template>

<script>
import ZoomFrame from "../components/ZoomFrame.vue";
export default {
  name: "meeting",
  data: function () {
    return {
      nickname: "",
      meetingId: "",
      password: "",
      role: "",
    };
  },
  components: {
    ZoomFrame,
  },
  created: function () {
    this.api_key = this.$route.params.api_key;
    this.api_secret = this.$route.params.api_secret;
    this.nickname = this.$route.params.nickname;
    this.meetingId = this.$route.params.meetingId;
    this.password = this.$route.params.password;
    this.role = this.$route.params.role;

    console.log("api_key");
    if (this.nickname == null) {
      this.$router.back();
    }
  },
  mounted: function () {},
};
</script>

<style>
.container-zoom {
  width: 70%;
  height: 100%;
}
</style>
