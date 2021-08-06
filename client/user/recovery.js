import axios from "axios";

class recovery {
  constructor() {
    // Recovery server location (Should be same as Auth)
    this.recoveryurl = `http://${process.env.REACT_APP_API_LOCATION}/`;

    // Default recovery variables
    this.connected = false;
    this.email = false;
    this.phone = false;

    // Config
    axios.defaults.withCredentials = true;
  }

  async #csrf() {
    await axios.get(`${this.recoveryurl}sanctum/csrf-cookie`);
  }

  // Reset recovery variables
  #reset() {
    this.email = false;
    this.phone = false;
  }

  // Get user recovery data
  async get() {
    this.#reset();
    await this.#csrf();
    await axios
      .get(`${this.recoveryurl}user/recovery/contact`)
      .then((response) => {
        this.email = response.data.email;
        this.phone = response.data.phone;
      })
      .catch((e) => {
        //
      });
  }

  // Update user recovery data
  async update(uuid, data) {
    await this.#csrf();
    await axios
      .post(`${this.recoveryurl}user/recovery/contact`, {
        email: data.email,
        phone: data.phone,
      })
      .then((response) => {
        this.update.error = false;
        this.update.status = 200;
      })
      .catch((e) => {
        console.log(e);
        this.update.error = "Something Went Wrong";
        this.update.status = 500;
      });
  }
}

export default new recovery();
