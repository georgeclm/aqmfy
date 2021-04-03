<template>
  <div class="mb-4">
    <button :class="classText" @click="followUser" v-text="buttonText"></button>
  </div>
</template>

<script>
export default {
  props: ["favorite", "route"],

  data: function () {
    return {
      status: this.favorite,
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
      return this.status ? "Remove from wishlist" : "Add to wishlist";
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
