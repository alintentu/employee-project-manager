<template>
  <div>
    <h1>Employee Project Management</h1>
    <nav>
      <button @click="view = 'project-list'">Projects</button>
      <button @click="view = 'add-project'">Add Project</button>
    </nav>
    <component :is="viewComponent" @project-added="view = 'project-list'" />
  </div>
</template>

<script>
import ProjectList from './projects/ProjectList.vue';
import AddProject from './projects/AddProject.vue';

export default {
  data() {
    return {
      view: 'project-list', // Track which component to show
    };
  },
  computed: {
    viewComponent() {
      return this.view === 'add-project' ? AddProject : ProjectList;
    },
  },
};
</script>

<style>
/* Basic styling for navigation */
nav {
  margin-bottom: 20px;
}
button {
  margin-right: 10px;
}
</style>
