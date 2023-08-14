import { defineStore } from 'pinia'

export default defineStore('auth', {
  state: () => ({
    user:[]
  }),
  
  actions: {
    setUser(data) {
      this.user=data
    },
  },
})