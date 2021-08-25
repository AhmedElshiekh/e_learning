<template>
  <div class="exam">
    {{ exam }}
  </div>
</template>

<script>
export default {
  props: ["exam"],
  name: "exam",
  data: function () {
    return {};
  },
  mounted: {
    //   if(this.courseDetails.placementTest == null){
    // axios
    //   .get(this.$api_url + "api/goToExam/" + this.courseDetails.exam +"?token="+localStorage.getItem("token"))
    //   .then((response) => {
    //     this.goToExam = response.data.data;
    //     console.log("goToExam");
    //     console.log(this.goToExam);
    //     this.isModalexam = true;
    //     });
    //     }
  },
};
</script>
