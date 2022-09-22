export default class fetchData{
    constructor(method, route, data){
      this._url =  new URL("http://localhost:8889/api/index.php"),
      this._url.search = route,
      this._method = method,
      this._data = data
    }
  
    async query(){
      if(this._method=='GET'||this._method=='DELETE'){
        return fetch(this._url, {
          method: this._method,
          credentials: "include",
          methode: "cors",
        })
          .then((response) => response.json())
      }else{
        return fetch(this._url, {
          method: this._method,
          credentials: "include",
          methode: "cors",
          body: JSON.stringify(this._data)
        })
          .then((response) => response.json())
      }
    }
  }