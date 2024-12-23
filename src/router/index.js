import { createRouter, createWebHistory } from "vue-router";
import FileList from "@/components/FileList.vue";
import UploadFile from "@/components/UploadFile.vue";

const routes = [
  { path: "/", component: FileList },
  { path: "/upload", component: UploadFile },
];

const router = createRouter({
  history: createWebHistory(), // Use Web History API for navigation
  routes,
});

export default router;
