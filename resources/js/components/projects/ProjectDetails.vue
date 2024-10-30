<template>
  <div>
    <h3>Project Details</h3>
    <p><strong>Name:</strong> {{ project.name }}</p>
    <p><strong>Description:</strong> {{ project.description }}</p>
    <h4>Employees</h4>
    <ul>
      <li v-for="employee in project.employees" :key="employee.id">
        {{ employee.name }} - {{ employee.role }}
      </li>
    </ul>
    <button @click="$emit('close')">Close</button>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  props: {
    projectId: {
      type: Number,
      required: true,
    },
  },
  data() {
    return {
      project: {},
    };
  },
  async mounted() {
    try {
      const response = await axios.get(`/api/projects/${this.projectId}`);
      this.project = response.data.data;
    } catch (error) {
      console.error('Error fetching project details:', error);
    }
  },
};
</script>

<style scoped>
button {
  margin-top: 15px;
}
</style>
