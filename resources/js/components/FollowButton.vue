<template>
  <div class="col-sm-2">
    <button :class="classText" @click="followUser" v-text="buttonText"></button>
  </div>
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
        this.className = "btn btn-outline-secondary";
        var classdata = this.className;
        return classdata;
      } else {
        this.className = "btn btn-outline-primary";
        var classdata = this.className;
        return classdata;
      }
    },
  },
};
</script>
