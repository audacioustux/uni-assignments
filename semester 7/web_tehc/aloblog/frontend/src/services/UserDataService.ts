import axios from "@/common/axios"

interface UserCreateCred {
  username: string
  email: string
  password: string
}
interface Credential {
  username: string
  password: string
}
class UserDataService {
  get(id: number) {
    return axios.get(`/users/${id}`)
  }
  create(values: UserCreateCred) {
    return axios.post("/users", values)
  }
  login(creds: Credential) {
    return axios.post("/login", creds)
  }
}

export default new UserDataService()
