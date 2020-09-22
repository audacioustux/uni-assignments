import axios from "@/common/axios"

interface Blog {
  content: string
  title: string
  thumbnail: string | undefined
  state: string
}
class BlogDataService {
  get(id: number) {
    return axios.get(`/blogs/${id}`)
  }
  getAll(cursor: number | null, q?: string) {
    console.log(cursor)
    return axios.get(`/blogs`, { params: { cursor, q } })
  }
  commentCount(blogId: number) {
    return axios.get(`blogs/${blogId}/comments/count`)
  }
  create(values: Blog) {
    return axios.post("/blogs", values)
  }
}

export default new BlogDataService()
