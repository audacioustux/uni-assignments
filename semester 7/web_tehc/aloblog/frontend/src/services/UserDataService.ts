import axios from "@/common/axios"

class UserDataService {
  get(id: number) {
    return axios.get(`/users/${id}`)
  }
}

export default new UserDataService()
