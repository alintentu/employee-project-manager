<template>
  <div>
    <h2>Projects</h2>
    <ul>
      <li v-for="project in projects" :key="project.id">
        <span>{{ project.name }}</span>
        <button @click="viewProjectDetails(project.id)">View Details</button>
      </li>
    </ul>
    <ProjectDetails v-if="selectedProject" :project-id="selectedProject" @close="selectedProject = null" />
  </div>
</template>

<script>
import axios from 'axios';
import ProjectDetails from './ProjectDetails.vue';

export default {
  data() {
    return {
      projects: [],
      selectedProject: null,
    };
  },
  components: {
    ProjectDetails,
  },
  methods: {
    async fetchProjects() {
      try {
        const response = await axios.get('/api/projects');
        this.projects = response.data.data;
      } catch (error) {
        console.error('Error fetching projects:', error);
      }
    },
    viewProjectDetails(projectId) {
      this.selectedProject = projectId;
    },
  },
  mounted() {
    this.fetchProjects();
  },
};
</script>

<style scoped>
ul {
  list-style: none;
  padding: 0;
}
button {
  margin-left: 10px;
}
</style>
