<template>
  <div class="container mt-4">
    <h1 class="text-center mb-4">Upload CSV File</h1>
    <form @submit.prevent="uploadFile" class="mb-4">
      <div class="mb-3">
        <label for="file" class="form-label">Choose a CSV file:</label>
        <input type="file" class="form-control" id="file" @change="handleFileUpload" accept=".csv" />
      </div>
      <button type="submit" class="btn btn-primary" :disabled="!selectedFile">Upload</button>
    </form>

    <div v-if="tableData.length" class="mt-4">
      <h2 class="mb-3">Preview of Uploaded File</h2>
      <table class="table table-bordered table-striped">
        <thead class="table-dark">
          <tr>
            <th v-for="(header, index) in tableHeaders" :key="index">{{ header }}</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(row, rowIndex) in tableData" :key="rowIndex">
            <td v-for="(cell, cellIndex) in row" :key="cellIndex">{{ cell }}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      selectedFile: null,
      tableData: [],
      tableHeaders: [],
    };
  },
  methods: {
    handleFileUpload(event) {
      const file = event.target.files[0];
      if (file.type !== "text/csv") {
        alert("Only CSV files are allowed.");
        this.selectedFile = null;
        this.tableData = [];
        this.tableHeaders = [];
        return;
      }
      this.selectedFile = file;
      this.previewFile(file);
    },
    previewFile(file) {
      const reader = new FileReader();
      reader.onload = (event) => {
        const csvContent = event.target.result;
        const rows = csvContent.split("\n").filter((row) => row.trim() !== "");
        this.tableHeaders = rows[0].split(",");
        this.tableData = rows.slice(1).map((row) => row.split(","));
      };
      reader.readAsText(file);
    },
    uploadFile() {
      const formData = new FormData();
      formData.append("file", this.selectedFile);

      axios.post("http://localhost/file-management-api/upload.php", formData).then((response) => {
        if (response.data.error) {
          alert(response.data.error);
        } else {
          alert("File uploaded successfully");
        }
      });
    },
  },
};
</script>
