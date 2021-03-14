<template>
  <div>
    <div class="row mb-3 mr-auto" v-if="message.user.id == authUser()">
      <div class="col-md-10 text-end">
        <div class="text-muted">{{ message.user.name }}</div>
        <div class="h4">{{ message.message }}</div>
      </div>
      <div class="col-md-1">
        <img
          :src="showProfile()"
          width="30"
          height="30"
          class="rounded-circle mt-3"
        />
      </div>
    </div>
    <div class="row mb-3 mr-auto" v-else>
      <div class="col-md-1 m-auto text-end">
        <img
          :src="showProfile()"
          width="30"
          height="30"
          class="rounded-circle"
        />
      </div>
      <div class="col-md-11">
        <div class="text-muted">{{ message.user.name }}</div>

        <div class="h4">{{ message.message }}</div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["message"],
  data() {
    return {
      profiles: [],
      theUser: "",
    };
  },
  methods: {
    showProfile() {
      axios
        .get("/chat/" + this.message.user.id + "/profile")
        .then((response) => {
          this.profiles = response.data;
        });
      return this.profiles;
    },
    authUser() {
      axios.get("/user").then((response) => {
        this.theUser = response.data;
      });
      return this.theUser;
    },
  },
};
</script>
