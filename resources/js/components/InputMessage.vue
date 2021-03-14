<template>
  <div class="d-flex py-3">
    <div class="col-md-10 pl-2">
      <input
        type="text"
        class="form-control"
        placeholder="Say Something..."
        required
        v-model="message"
        @keyup.enter="sendMessage()"
      />
    </div>
    <div class="col-md-2">
      <button
        type="submit"
        class="btn btn-outline-primary"
        @click="sendMessage()"
      >
        Send
      </button>
    </div>
  </div>
</template>

<script>
export default {
  props: ["room"],
  data: function () {
    return {
      message: "",
    };
  },
  methods: {
    sendMessage() {
      if (this.message == "") {
        return;
      }
      axios
        .post("/chat/room/" + this.room.id + "/message", {
          message: this.message,
        })
        .then((response) => {
          if (response.status == 201) {
            this.message = "";
            this.$emit("messagesent");
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
};
</script>
