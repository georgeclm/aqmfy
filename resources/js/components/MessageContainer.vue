<template>
  <div class="d-flex flex-column-reverse scrollablemessage">
    <div v-for="(message, index) in messages" :key="index">
      <message-item :message="message" />
    </div>
  </div>
</template>

<script>
import MessageItem from "./MessageItem.vue";
export default {
  components: { MessageItem },
  props: ["messages"],
};
</script>
