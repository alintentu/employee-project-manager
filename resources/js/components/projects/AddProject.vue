<template>
  <div>
    <h2>Add New Project</h2>
    <form @submit.prevent="submitProject">
      <div>
        <label for="name">Project Name:</label>
        <input v-model="form.name" id="name" required />
      </div>
      <div>
        <label for="description">Description:</label>
        <textarea v-model="form.description" id="description"></textarea>
      </div>
      <button type="submit">Add Project</button>
    </form>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      form: {
        name: '',
        description: '',
      },
    };
  },
  methods: {
    async submitProject() {
      try {
        await axios.post('/api/projects', this.form);
        this.$emit('project-added');
        this.form.name = '';
        this.form.description = '';
      } catch (error) {
        console.error('Error adding project:', error);
      }
    },
  },
};
</script>

<style scoped>
form div {
  margin-bottom: 10px;
}
</style>
