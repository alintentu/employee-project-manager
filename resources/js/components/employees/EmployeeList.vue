<template>
  <div>
    <h2>Employees</h2>
    <ul>
      <li v-for="employee in employees" :key="employee.id">
        <p>{{ employee.name }} - {{ employee.position }}</p>
        <h4>Projects</h4>
        <ul>
          <li v-for="project in employee.projects" :key="project.id">
            {{ project.name }} - Role: {{ project.role }}
          </li>
        </ul>
      </li>
    </ul>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      employees: [],
    };
  },
  async mounted() {
    try {
      const response = await axios.get('/api/employees');
      this.employees = response.data.data;
    } catch (error) {
      console.error('Error fetching employees:', error);
    }
  },
};
</script>

<style scoped>
ul {
  list-style: none;
  padding: 0;
}
</style>
