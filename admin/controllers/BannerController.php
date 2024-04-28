<?php
class BannerController
{
    public function __construct()
    {
        $db = new Databaseconnection;
        $this->conn = $db->conn;
    }

    public function create($inputdata)
    {
        $data = "'" . implode("','", $inputdata) . "'";
        $uploadbanner = "INSERT INTO banners (name, heading, image, description, link, text) VALUES ($data)";
        $result = $this->conn->query($uploadbanner);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function index()
    {
        $sql = "SELECT * FROM banners";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            return $result;
        } else {
            return false;
        }
    }

    public function edit($id)
    {
        $sql = "SELECT * FROM banners WHERE id ='$id' LIMIT 1";
        $result = $this->conn->query($sql);
        if ($result->num_rows == 1) {
            $data = $result->fetch_assoc();
            return $data;
        } else {
            return false;
        }
    }

    public function update($inputData, $banner_id)
    {
        $banner_name =  $inputData['banner_name'];
        $banner_heading =  $inputData['banner_heading'];
        $main_image =  $inputData['main_image'];
        $banner_description =  $inputData['banner_description'];
        $banner_url =  $inputData['banner_url'];
        $bannerbtn_text =  $inputData['bannerbtn_text'];

        $sql = "UPDATE banners SET name ='$banner_name',heading = '$banner_heading',";
        if (!empty($main_image)) {
            $sql .= "image ='$main_image' ,";
        }
        $sql .= "description = '$banner_description', link ='$banner_url', text = '$bannerbtn_text' WHERE id ='$banner_id'";
        $result = $this->conn->query($sql);
        //  echo $result;
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
}
