<template>
  <div class="grid grid-cols-2">
    <div class="h4">{{ selected.name }} Chat</div>
    <div>
      <select
        v-model="selected"
        @change="$emit('roomchanged', selected)"
        class="form-select form-select-sm float-right"
      >
        <option v-for="(room, index) in rooms" :key="index" :value="room">
          {{ room.name }}
        </option>
      </select>
    </div>
  </div>
</template>

<script>
export default {
  props: ["rooms", "currentRoom"],
  data: function () {
    return {
      selected: "",
    };
  },
  created() {
    this.selected = this.currentRoom;
  },
};
</script>
