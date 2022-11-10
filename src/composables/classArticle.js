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

export { Article };
