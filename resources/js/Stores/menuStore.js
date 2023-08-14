import { defineStore } from 'pinia'

export default defineStore('menuStore', {
  state: () => ({
    nav:false,
    navmobile:false,
  }),
  
  actions: {
    setNav() {
      this.nav=!this.nav
    },
    setNavMobile() {
      this.navmobile=!this.navmobile
    },
  },
})