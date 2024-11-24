<script setup>
import { onMounted, ref, computed } from "vue";
import { Tooltip } from "bootstrap";

const props = defineProps({
  message: {
    type: Object,
    required: true,
  },
});

const $el = ref(null);


onMounted(() => {
  // only find in this component HTML using $el
  const tooltipTriggerList = $el.value.querySelectorAll(
    '[data-bs-toggle="tooltip"]'
  );
  [...tooltipTriggerList].map(
    (tooltipTriggerEl) => new Tooltip(tooltipTriggerEl)
  );
});

const createdAt = computed(() => {
  const d = new Date(props.message.created_at);
  return d.toLocaleString();
});

</script>

<template>
  <div ref="$el">
    <div class="d-flex justify-content-end mb-4" v-if="message.user.id === $root.user.id">
      <div class="msg_container_send" data-bs-toggle="tooltip" data-bs-placement="top" :title="createdAt">
        {{ message.content }}
      </div>
      <div class="img_cont_msg" data-bs-toggle="tooltip" data-bs-placement="top"
        :title="`${message.user.name} (${message.user.email})`">
        <img src="/images/current_user.jpg" class="rounded-circle user_img_msg">
      </div>
    </div>
    <div class="d-flex justify-content-start mb-4" v-else>
      <div class="img_cont_msg" data-bs-toggle="tooltip" data-bs-placement="top"
        :title="`${message.user.name} (${message.user.email})`">
        <img src="/images/other_user.jpg" class="rounded-circle user_img_msg">
      </div>
      <div class="msg_container" data-bs-toggle="tooltip" data-bs-placement="top" :title="createdAt">
        {{ message.content }}
      </div>
    </div>
  </div>
</template>



<style></style>