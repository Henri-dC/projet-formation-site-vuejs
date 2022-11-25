class fetchData {
  constructor(method, route, data) {
    (this._url = new URL("https://www.tontonriton.com/api/index.php")),
      (this._url.search = route),
      (this._method = method),
      (this._data = data);
  }

  async query() {
    /*Methods GET and DELETE without data */
    if (this._method === "GET" || this._method === "DELETE") {
      return fetch(this._url, {
        method: this._method,
        credentials: "include",
        mode: "cors",
      }).then((response) => response.json());
      /*Methods PUT and POST with data */
    } else {
      return fetch(this._url, {
        method: this._method,
        credentials: "include",
        mode: "cors",
        body: JSON.stringify(this._data),
      }).then((response) => response.json());
    }
  }
}

export { fetchData };
