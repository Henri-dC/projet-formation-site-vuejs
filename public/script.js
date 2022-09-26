class Article {
  constructor(id, title, picture, content, author, author_Id, category_id) {
    (this._id = id),
      (this._title = title),
      (this._picture = picture),
      (this._content = content),
      (this._author = author),
      (this._author_Id = author_Id),
      (this._category_id = category_id);
  }

  setArticleId(id) {
    this._id = id;
  }

  setPicture(picture) {
    this._picture = picture;
  }
}

class User {
  constructor(id, firstName, lastName, isAdmin) {
    (this._id = id),
      (this._firstName = firstName),
      (this._lastName = lastName),
      (this._isAdmin = isAdmin);
  }
}

var current_user = {};

class fetchData {
  constructor(method, route, data) {
    (this._url = new URL("http://localhost:8889/api/index.php")),
      (this._url.search = route),
      (this._method = method),
      (this._data = data);
  }

  async query() {
    if (this._method === "GET" || this._method === "DELETE") {
      return fetch(this._url, {
        method: this._method,
        credentials: "include",
        mode: "cors",
      }).then((response) => response.json());
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
