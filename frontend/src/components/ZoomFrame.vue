<template>
  <div class="iframe-container">
    <meta charset="utf-8" />
    <link
      type="text/css"
      rel="stylesheet"
      href="https://dmogdx0jrul3u.cloudfront.net/1.3.7/css/bootstrap.css"
    />
    <link
      type="text/css"
      rel="stylesheet"
      href="https://dmogdx0jrul3u.cloudfront.net/1.3.7/css/react-select.css"
    />

    <meta name="format-detection" content="telephone=no" />
  </div>
</template>
<script>
// import {ZoomMtg} from "zoomus-jssdk";
import { ZoomMtg } from "@zoomus/websdk";
// import axios from 'axios';

ZoomMtg.setZoomJSLib("https://source.zoom.us/1.9.6/lib", "/av");
ZoomMtg.preLoadWasm();
ZoomMtg.prepareJssdk();

export default {
  name: "ZoomFrame",
  data: function () {
    return {
      src: "",
      meetConfig: {},
      signature: {},
      credential: null,
    };
  },
  props: {
    nickname: String,
    meetingId: String,
    password: String,
    role: String,
    api_key: String,
    api_secret: String,
  },
  created: function () {
    // Meeting config object
    this.meetConfig = {
      apiKey: this.api_key,
      apiSecret: this.api_secret,
      meetingNumber: this.meetingId,
      userName: this.nickname,
      passWord: this.password,
      leaveUrl: "/profile_user",
      role: this.role,
    };

    // Generate Signature function
    this.signature = ZoomMtg.generateSignature({
      meetingNumber: this.meetConfig.meetingNumber,
      apiKey: this.meetConfig.apiKey,
      apiSecret: this.meetConfig.apiSecret,
      role: this.meetConfig.role,
      success: function (res) {
        // eslint-disable-next-line
        console.log("success signature: " + res);
      },
    });
    // join function
    ZoomMtg.init({
      leaveUrl: "profile_user",
      isSupportAV: true,
      success: () => {
        ZoomMtg.join({
          meetingNumber: this.meetConfig.meetingNumber,
          userName: this.meetConfig.userName,
          signature: this.signature,
          apiKey: this.meetConfig.apiKey,
          //   userEmail: "ahmedel.sh50@gmail.com",
          passWord: this.meetConfig.passWord,
          success: function () {
            // eslint-disable-next-line
            // console.log("join meeting success");
          },
          error: function (res) {
            // eslint-disable-next-line
            console.log(res);
          },
        });
      },
      error: function (res) {
        console.log(res);
      },
    });
  },

  mounted: function () {},
};
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped></style>
