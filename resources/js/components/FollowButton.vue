<template>
  <button :class="classText" @click="followUser" v-text="buttonText"></button>
</template>

<script>
export default {
  props: ["follows", "route"],

  data: function () {
    return {
      status: this.follows,
      className: "",
    };
  },

  methods: {
    followUser() {
      axios
        .post(this.route)
        .then((response) => {
          this.status = !this.status;
        })
        .catch((errors) => {
          if (errors.response.status == 401) {
            window.location = "/login";
          }
        });
    },
  },

  computed: {
    buttonText() {
      return this.status ? "Following" : "Follow";
    },
    classText() {
      if (this.status) {
        this.className = "profile__contact-btn btn btn-lg btn-block btn-danger";
        var classdata = this.className;
        return classdata;
      } else {
        this.className = "profile__contact-btn btn btn-lg btn-block btn-info";
        var classdata = this.className;
        return classdata;
      }
    },
  },
};
</script>
