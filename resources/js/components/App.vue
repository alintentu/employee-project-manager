<template>
  <div>
    <h1>Employee Project Manager</h1>
    <EmployeeList />
  </div>
</template>

<script>
import EmployeeList from './employees/EmployeeList.vue';

export default {
  components: {
    EmployeeList
  }
};
</script>
