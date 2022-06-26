<?php
class SubcategoryController
{
    public function __construct()
    {
        $db = new Databaseconnection;
        $this->conn = $db->conn;
    }

    public function create($inputdata)
    {
        $data = "'" . implode("','", $inputdata) . "'";
        // echo $data;
        $subcategoryQuery = "INSERT INTO subcategory (name, category_id, url, description, created_on) VALUES ($data)";
        $result = $this->conn->query($subcategoryQuery);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function index()
    {
        $getsubCategories = "SELECT * FROM subcategory";
        $result = $this->conn->query($getsubCategories);
        if ($result) {
            return $result;
        } else {
            return false;
        }
    }

    public function edit($id)
    {
        $getsubCategories = "SELECT * FROM subcategory WHERE id = '$id' LIMIT 1";
        $result = $this->conn->query($getsubCategories);
        if ($result->num_rows == 1) {
            $data = $result->fetch_assoc();
            return $data;
        } else {
            return false;
        }
    }

    public function update($inputData, $subcategory_id)
    {
        $name = $inputData['subcategoryname'];
        $subcat_url =  $inputData['subcategoryurl'];
        $catid =  $inputData['parentcategory'];
        $subcat_description =  $inputData['subcategorydescription'];
        $updatesubCatgeory = "UPDATE subcategory SET name = '$name', category_id ='$catid', url ='$subcat_url', description = '$subcat_description' WHERE id = '$subcategory_id'";
        $result = $this->conn->query($updatesubCatgeory);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function delete($subcategory_id)
    {
        $deletesubCategory = "DELETE FROM subcategory WHERE id ='$subcategory_id'";
        $result = $this->conn->query($deletesubCategory);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function showcategory($category_id, $categoryshow)
    {
        $showCategory = "UPDATE category SET status = '$categoryshow' WHERE id = '$category_id'";
        $result = $this->conn->query($showCategory);
        // echo $result;
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function checksubCategoryurlexist($subcategoryurl)
    {

        $counter = 1;
        $newLink = $subcategoryurl;
        do {
            $checksubcategoryurlexist = "SELECT url FROM subcategory WHERE url = '$newLink'";
            $result = $this->conn->query($checksubcategoryurlexist);
            if ($result->num_rows > 0) {
                $newLink = $subcategoryurl . '-' . $counter;
                $counter++;
            } else {
                break;
            }
        } while (1);

        return $newLink;
    }
}
