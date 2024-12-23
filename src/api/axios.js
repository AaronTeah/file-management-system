import axios from 'axios';

const apiClient = axios.create({
  baseURL: 'http://localhost/file-management-api',
  headers: {
    'Content-Type': 'application/json',
  },
});

export default apiClient;
