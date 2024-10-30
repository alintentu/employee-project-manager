<template>
  <div>
    <h2>Employee List</h2>
    <ul>
      <li v-for="employee in employees" :key="employee.id">{{ employee.name }}</li>
    </ul>
  </div>
</template>

<script>
export default {
  data() {
    return {
      employees: []
    };
  },
  mounted() {
    this.fetchEmployees();
  },
  methods: {
    async fetchEmployees() {
      try {
        const response = await this.$axios.get('/api/employees');
        this.employees = response.data;
      } catch (error) {
        console.error("Error fetching employees:", error);
      }
    }
  }
};
</script>
