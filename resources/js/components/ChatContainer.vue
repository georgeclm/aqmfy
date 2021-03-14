<template>
  <div class="container" style="width: 65%">
    <div class="row justify-content-between align-items-baseline">
      <div class="col-md-10 text-center mb-3">
        <chat-roomselect
          v-if="currentRoom.id"
          :rooms="chatRooms"
          :currentRoom="currentRoom"
          v-on:roomchanged="setRoom($event)"
        />
      </div>
      <div class="col-md-2">
        <a href="/chat/create/room" class="btn btn-outline-success"
          >Create Room</a
        >
      </div>
      <hr />
    </div>
    <message-container :messages="messages" />
    <input-message :room="currentRoom" v-on:messagesent="getMessages()" />
  </div>
</template>

<script>
import ChatRoomselect from "./ChatRoomselect.vue";
import InputMessage from "./InputMessage.vue";
import MessageContainer from "./MessageContainer";
export default {
  components: {
    MessageContainer,
    InputMessage,
    ChatRoomselect,
  },
  data: function () {
    return {
      chatRooms: [],
      currentRoom: [],
      messages: [],
    };
  },
  watch: {
    currentRoom(val, oldVal) {
      if (oldVal.id) {
        this.disconnect(oldVal);
      }
      this.connect();
    },
  },
  methods: {
    connect() {
      if (this.currentRoom.id) {
        let vm = this;
        this.getMessages();
        window.Echo.private("chat." + this.currentRoom.id).listen(
          "NewChatMessage",
          (e) => {
            vm.getMessages();
          }
        );
      }
    },
    disconnect(room) {
      window.Echo.leave("chat." + room.id);
    },
    getRooms() {
      axios
        .get("/chat/rooms")
        .then((response) => {
          this.chatRooms = response.data;
          this.setRoom(response.data[0]);
        })
        .catch((error) => {
          console.log(error);
        });
    },
    setRoom(room) {
      this.currentRoom = room;
      this.getMessages();
    },
    getMessages() {
      axios
        .get("chat/room/" + this.currentRoom.id + "/messages")
        .then((response) => {
          this.messages = response.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
  created() {
    this.getRooms();
  },
};
</script>
