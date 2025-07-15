<template>
  <div class="fixed bottom-5 right-5 z-[9999]">
    <!-- Chat Window -->
    <transition
      enter-active-class="transition ease-out duration-200"
      enter-from-class="transform opacity-0 scale-95"
      enter-to-class="transform opacity-100 scale-100"
      leave-active-class="transition ease-in duration-150"
      leave-from-class="transform opacity-100 scale-100"
      leave-to-class="transform opacity-0 scale-95"
    >
      <div v-if="isOpen" class="w-80 sm:w-96 h-[60vh] sm:h-[70vh] max-h-[700px] bg-white rounded-2xl shadow-2xl flex flex-col overflow-hidden border">
        <!-- Header -->
        <div class="bg-gradient-to-r from-blue-500 to-indigo-600 p-4 text-white flex justify-between items-center shadow-md">
          <div>
            <h3 class="font-bold text-lg">HappyCare Assistant</h3>
            <p class="text-xs text-blue-100">Online</p>
          </div>
          <button @click="toggleChat" class="text-white hover:text-gray-200 focus:outline-none">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
        </div>

        <!-- Messages -->
        <div class="flex-1 p-4 overflow-y-auto" ref="messagesContainer">
          <div v-for="(message, index) in messages" :key="index" class="mb-4">
            <div :class="message.type === 'user' ? 'flex justify-end' : 'flex'">
              <div
                :class="{
                  'bg-blue-500 text-white rounded-t-xl rounded-l-xl': message.type === 'user',
                  'bg-gray-200 text-gray-800 rounded-t-xl rounded-r-xl': message.type === 'bot',
                  'w-full bg-transparent': message.type === 'hospital_list' || message.type === 'tourism_list'
                }"
                class="py-2 px-4 max-w-xs sm:max-w-sm"
              >
                <p v-if="message.type === 'bot'" class="text-sm whitespace-pre-wrap">{{ message.message }}</p>

                <!-- Hospital & Tourism List Card View -->
                <div v-if="(message.type === 'hospital_list' || message.type === 'tourism_list') && message.data">
                   <p class="text-sm text-gray-700 mb-3">{{ message.message }}</p>
                  <div class="space-y-3">
                    <div 
                      v-for="item in message.data" 
                      :key="item.name"
                      class="bg-white border rounded-lg shadow-sm overflow-hidden"
                    >
                        <img :src="item.image" :alt="item.name" class="w-full h-32 object-cover">
                        <div class="p-3">
                            <h4 class="font-bold text-gray-800">{{ item.name }}</h4>
                            
                            <!-- Hospital Specific Info -->
                            <div v-if="message.type === 'hospital_list'" class="text-xs text-gray-600 mt-1">
                                <p><i class="fas fa-map-marker-alt w-4"></i> {{ item.address }}</p>
                                <p><i class="fas fa-phone w-4"></i> {{ item.phone }}</p>
                                <p><i class="fas fa-star w-4 text-yellow-500"></i> {{ item.rating }}/5</p>
                                <p><i class="fas fa-first-aid w-4 text-red-500"></i> IGD 24 Jam: {{ item.emergency }}</p>
                            </div>
                            
                            <!-- Tourism Specific Info -->
                            <div v-if="message.type === 'tourism_list'" class="text-xs text-gray-600 mt-1">
                                <p><i class="fas fa-map-marker-alt w-4"></i> {{ item.location }}</p>
                                <p><i class="fas fa-tag w-4"></i> {{ item.category }}</p>
                                <p><i class="fas fa-star w-4 text-yellow-500"></i> {{ item.rating }}/5</p>
                                <p><i class="fas fa-money-bill w-4"></i> {{ item.price }}</p>
                            </div>

                            <a :href="item.url" target="_blank" class="text-xs inline-block mt-2 px-3 py-1 bg-blue-500 text-white rounded-full hover:bg-blue-600 transition-colors">
                                Lihat Detail
                            </a>
                        </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
           <div v-if="isLoading" class="flex">
              <div class="py-2 px-4 max-w-xs sm:max-w-sm bg-gray-200 text-gray-800 rounded-t-xl rounded-r-xl">
                  <div class="flex items-center space-x-2">
                      <div class="w-2 h-2 bg-gray-500 rounded-full animate-pulse"></div>
                      <div class="w-2 h-2 bg-gray-500 rounded-full animate-pulse" style="animation-delay: 0.2s;"></div>
                      <div class="w-2 h-2 bg-gray-500 rounded-full animate-pulse" style="animation-delay: 0.4s;"></div>
                  </div>
              </div>
          </div>
        </div>

        <!-- Input -->
        <div class="p-3 bg-white border-t">
          <div class="flex items-center bg-gray-100 rounded-full px-2">
            <input 
              type="text" 
              v-model="userInput"
              @keyup.enter="sendMessage"
              placeholder="Ketik pesan..."
              class="flex-1 bg-transparent border-none focus:ring-0 py-3 px-2 text-sm"
            >
            <button @click="sendMessage" :disabled="isLoading || !userInput.trim()" class="p-2 text-blue-500 rounded-full hover:bg-blue-100 disabled:text-gray-400 disabled:hover:bg-transparent transition-colors">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                <path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z" />
              </svg>
            </button>
          </div>
        </div>
      </div>
    </transition>

    <!-- Toggle Button -->
    <button @click="toggleChat" class="bg-gradient-to-r from-blue-500 to-indigo-600 text-white w-16 h-16 rounded-full shadow-2xl flex items-center justify-center focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transform hover:scale-110 transition-transform">
      <transition
        enter-active-class="transition ease-out duration-200"
        enter-from-class="transform opacity-0 rotate-45 scale-75"
        enter-to-class="transform opacity-100 rotate-0 scale-100"
        leave-active-class="transition ease-in duration-150"
        leave-from-class="transform opacity-100 rotate-0 scale-100"
        leave-to-class="transform opacity-0 -rotate-45 scale-75"
        mode="out-in"
      >
        <svg v-if="!isOpen" key="chat" xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd" d="M18 10c0 3.866-3.582 7-8 7a8.841 8.841 0 01-4.083-.98L2 17l1.102-3.102A6.932 6.932 0 012 10c0-3.866 3.582-7 8-7s8 3.134 8 7zM4.773 14.23A6.996 6.996 0 0010 15a5 5 0 005-5c0-2.761-2.239-5-5-5S5 7.239 5 10c0 .88.232 1.696.64 2.408l.386.666-1.102 3.102 3.102-1.102.666.386z" clip-rule="evenodd" />
        </svg>
        <svg v-else key="close" xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
        </svg>
      </transition>
    </button>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: 'Chatbot',
  data() {
    return {
      isOpen: false,
      messages: [],
      userInput: '',
      isLoading: false
    };
  },
  watch: {
    isOpen(newValue) {
      if (newValue && this.messages.length === 0) {
        this.getInitialGreeting();
      }
    }
  },
  methods: {
    toggleChat() {
      this.isOpen = !this.isOpen;
    },
    scrollToBottom() {
      this.$nextTick(() => {
        const container = this.$refs.messagesContainer;
        if (container) {
          container.scrollTop = container.scrollHeight;
        }
      });
    },
    async getInitialGreeting() {
      if (this.isLoading) return;
      this.isLoading = true;
      try {
        const response = await axios.get('/api/chatbot/greeting');
        this.messages.push(response.data);
      } catch (error) {
        this.messages.push({
          type: 'bot',
          message: 'Gagal memuat. Maaf ya, coba lagi nanti.'
        });
      } finally {
        this.isLoading = false;
        this.scrollToBottom();
      }
    },
    async sendMessage() {
      if (!this.userInput.trim() || this.isLoading) return;
      
      const userMessage = { type: 'user', message: this.userInput };
      this.messages.push(userMessage);
      const messageToSend = this.userInput;
      this.userInput = '';
      this.scrollToBottom();

      this.isLoading = true;
      
      try {
        const response = await axios.post('/api/chatbot/message', { message: messageToSend });
        this.messages.push(response.data);
      } catch (error) {
        this.messages.push({
          type: 'bot',
          message: 'Maaf, terjadi kesalahan di server kami. Coba lagi nanti.'
        });
      } finally {
        this.isLoading = false;
        this.scrollToBottom();
      }
    },
  }
};
</script> 