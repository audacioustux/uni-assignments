import axios from "@/common/axios"

class BlogDataService {
  get(id: number) {
    return axios.get(`/blogs/${id}`)
  }
  getAll(cursor: number | null) {
    return axios.get(`/blogs`, { params: { cursor } })
  }
  commentCount(blogId: number) {
    return axios.get(`blogs/${blogId}/comments/count`)
  }
}

export default new BlogDataService()
