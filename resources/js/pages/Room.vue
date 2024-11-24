<script setup>
import ListUser from '../components/ListUser.vue'
import SharedRoom from '../components/SharedRoom.vue'
import axios from 'axios'
import { onBeforeMount, ref, getCurrentInstance, nextTick } from 'vue'
import { useRoute } from 'vue-router'

const route = useRoute()
const currentRoom = ref({})
const messages = ref([])
const usersOnline = ref([])
const instance = getCurrentInstance();
const rootData = instance.appContext.app._instance.proxy;

onBeforeMount(() => {
  getMessages()
  const index = rootData.rooms.findIndex(item => item.id === parseInt(route.params.roomId))
  if (index > -1) {
    currentRoom.value = rootData.rooms[index]
  }
})

const getMessages = async () => {
  try {
    const response = await axios.get(`/messages?room_id=${route.params.roomId}`)
    messages.value = response.data
    scrollToBottom(false)
  } catch (error) {
    console.log(error)
  }
}

const saveMessage = async (content) => {
  try {
    const response = await axios.post('/messages', {
      room_id: parseInt(route.params.roomId),
      content
    })
    messages.value.push(response.data.message)
    scrollToBottom()
  } catch (error) {
    console.log(error)
  }
}

const scrollToBottom = (animate = true) => {
  const element = document.getElementById('shared_room')

  nextTick(() => { // run after Vue finishes updating the DOM
    element.scrollTo({
      top: element.scrollHeight, // Scroll to the bottom
      behavior: animate ? 'smooth' : 'instant', // Smooth scrolling
    });
  })
}
</script>

<template>
  <div class="row justify-content-center h-100">
    <div class="col-md-8 chat">
      <SharedRoom :messages="messages" :currentRoom="currentRoom" @saveMessage="saveMessage" />
    </div>
    <div class="col-md-4 chat">
      <ListUser :usersOnline="usersOnline" />
    </div>
  </div>
</template>

<style></style>