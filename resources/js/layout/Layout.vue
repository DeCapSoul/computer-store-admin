<template>
  <div :class="classObj" class="layout-wrapper">
    <!--left side-->
    <Sidebar v-if="settings.showLeftMenu" class="sidebar-container" />
    <!--right container-->
    <div class="main-container">
      <Navbar v-if="settings.showTopNavbar" />
      <TagsView v-if="settings.showTagsView" />
      <AppMain />
    </div>
  </div>
</template>
<script>
export default {
  name: 'Layout'
}
</script>

<script setup>
import { Sidebar, Navbar, AppMain, TagsView } from './components'
import { appStore } from '@/store/app'

const useAppStore = appStore()
const opened = computed(() => {
  return useAppStore.sidebar.opened
})

const settings = computed(() => {
  return useAppStore.settings
})
const classObj = computed(() => {
  return {
    closeSidebar: !opened.value,
    hideSidebar: !settings.value.showLeftMenu
  }
})
//import ResizeHook to   listen  page size that   open or close
import ResizeHook from './hook/ResizeHandler'
ResizeHook()
</script>

<style lang="scss" scoped>
.main-container {
  min-height: 100%;
  transition: margin-left 0.28s;
  margin-left: $sideBarWidth;
  position: relative;
}
.sidebar-container {
  transition: width 0.28s;
  width: $sideBarWidth !important;
  background-color: $menuBg;
  height: 100%;
  position: fixed;
  font-size: 0;
  top: 0;
  bottom: 0;
  left: 0;
  z-index: 1001;
  overflow: hidden;
}
.closeSidebar {
  .sidebar-container {
    width: 54px !important;
  }
  .main-container {
    margin-left: 54px !important;
  }
}
.hideSidebar {
  .sidebar-container {
    width: 0 !important;
  }
  .main-container {
    margin-left: 0;
  }
}
</style>
