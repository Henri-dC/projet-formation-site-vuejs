class Article {
  constructor(id, title, picture, content, category, author) {
    (this._id = id),
      (this._title = title),
      (this._picture = picture),
      (this._content = content),
      (this._category = category),
      (this._author = author);
  }
}

class User {
  constructor(id, firstName, lastName) {
    (this._id = id), (this._firstName = firstName), (this._lastName = lastName);
  }
}

var current_user = {};
