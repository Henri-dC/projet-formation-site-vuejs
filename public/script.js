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
  constructor(id, firstName, lastName, isAdmin, email) {
    (this._id = id),
      (this._firstName = firstName),
      (this._lastName = lastName),
      (this._isAdmin = isAdmin),
      (this._email = email);
  }
}

var current_user = {};
