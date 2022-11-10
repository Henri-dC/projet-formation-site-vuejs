class User {
  constructor(id, firstName, lastName, isAdmin, email) {
    (this._id = id),
      (this._firstName = firstName),
      (this._lastName = lastName),
      (this._isAdmin = isAdmin),
      (this._email = email);
  }
}
export { User };
