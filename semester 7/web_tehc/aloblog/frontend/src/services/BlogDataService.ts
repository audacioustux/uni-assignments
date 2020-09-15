import axios from "@/common/axios"

class BlogDataService {
  getAll(cursor: number | null) {
    return axios.get(`/blogs`, { params: { cursor } })
  }
  commentCount(blogId: number) {
    return axios.get(`blogs/${blogId}/comments/count`)
  }
}

export default new BlogDataService()
