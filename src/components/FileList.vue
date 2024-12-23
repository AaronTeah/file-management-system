<template>
  <div class="container mt-4">
    <h1 class="text-center mb-4">Uploaded Files</h1>
    <table class="table table-bordered table-striped">
      <thead class="table-dark">
        <tr>
          <th>#</th>
          <th>File Name</th>
          <th>Description</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(file, index) in files" :key="file.id">
          <td>{{ index + 1 }}</td>
          <td>{{ file.file_name }}</td>
          <td>{{ file.description || "No description available" }}</td>
          <td>
            <button class="btn btn-danger btn-sm" @click="deleteFile(file.id, index)">Delete</button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      files: [],
    };
  },
  mounted() {
    // Fetch the file list when the component is mounted
    this.fetchFiles();
  },
  methods: {
    // Fetch the latest file list from the server
    fetchFiles() {
      axios
        .get("http://localhost/file-management-api/files.php")
        .then((response) => {
          this.files = response.data;
        })
        .catch((error) => {
          console.error("Error fetching files:", error);
          alert("Failed to fetch files. Please try again.");
        });
    },

    // Delete a file
    deleteFile(id, index) {
      if (!confirm("Are you sure you want to delete this file?")) return;

      axios
        .delete(`http://localhost/file-management-api/delete.php`, { params: { id } })
        .then((response) => {
          if (response.status === 200) {
            alert(response.data.message);

            // Immediately remove the file from the list
            this.files.splice(index, 1);
          } else {
            alert("Unexpected response. Please try again.");
          }
        })
        .catch((error) => {
          console.error("Error deleting file:", error);

          if (error.response) {
            alert(error.response.data.error || "Failed to delete file.");
          } else {
            alert("Network error. Please check your connection.");
          }
        });
    },
  },
};
</script>
