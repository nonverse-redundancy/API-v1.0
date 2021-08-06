import axios from "axios";

class validate {
  constructor() {
    // API server validator location
    this.apiurl = `http://${process.env.REACT_APP_API_LOCATION}/`;
    this.validatorurl = "http://api.nonverse.test/client/validator/";

    // Config
    axios.defaults.withCredentials = true;
  }

  async #csrf() {
    await axios.get(`${this.apiurl}sanctum/csrf-cookie`);
  }

  error() {
    if (this.name.error || this.email.error || this.phone.error) {
      return true;
    }
    return false;
  }

  name(data, compare) {
    this.name.error = false;
    if (compare) {
      if (data === compare) {
        return (this.name.error = false);
      }
    }
    const count = data.match(/(\w+)/g);
    if (count.length < 2) {
      this.name.error = "First and last names are required";
    } else if (count.length > 2) {
      this.name.error = "Only first and last name can be entered";
    } else {
      this.name.error = false;
    }
  }

  async email(data, compare, unique) {
    this.email.error = false;
    if (compare) {
      if (data === compare) {
        return (this.email.error = false);
      }
    }
    await this.#csrf();
    await axios
      .post(`${this.validatorurl}email?${unique ? "args=unique" : ""}`, {
        email: data,
      })
      .then((response) => {
        switch (response.data) {
          case "The email field is required.":
            this.email.error = "An email is required";
            break;
          case "The email must be a valid email address.":
            this.email.error = "Invalid email";
            break;
          case "The email has already been taken.":
            this.email.error = "This email is taken";
            break;
          default:
        }
        //console.log(this.email.error);
      })
      .catch((e) => {
        this.email.error = "Unable to validate email";
      });
  }

  async phone(data, compare) {
    this.phone.error = false;
    if (compare) {
      if (data === compare) {
        return (this.phone.error = false);
      }
    }
    await this.#csrf();
    await axios
      .post(`${this.validatorurl}phone`, {
        phone: data,
      })
      .then((response) => {
        switch (response.data) {
          case "The phone field is required.":
            this.phone.error = false;
            break;
          case "The phone format is invalid.":
            this.phone.error = "Phone number is invalid";
            break;
          case "The phone must be at least 10 characters.":
            this.phone.error = "Phone number is invalid";
            break;
          default:
        }
      })
      .catch((e) => {
        this.phone.error = "Unable to validate phone number";
      });
  }
}

export default new validate();
