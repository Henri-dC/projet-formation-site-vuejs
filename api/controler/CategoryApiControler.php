<?php

class CategoryApiControler {
  private CategoryRepository $_categoryRepo;

  public function __construct() {
    $this->_categoryRepo = new CategoryRepository();
  }

  public function proceedCreateCategory(Request $request){
    $data = $request->getData();
    $category = new Category();
    $category->setName($data['name']);
    $request = $this->_categoryRepo->createCategory($category);
    $response = new Response();
    $response->setHttpStatusCode(HttpStatusCode::OK);
  
    return $response;
  }

  public function proceedGetCategories(){
    $category = $this->_categoryRepo->getCategories();
    $response = new Response();
    $response->setData($category);
    $response->setHttpStatusCode(HttpStatusCode::OK);

    return $response;

  }
}

?>